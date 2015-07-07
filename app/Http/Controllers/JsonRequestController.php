<?php namespace App\Http\Controllers;




use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CarouselItem;
use App\Blog;
use App\Page;
use App\Event;
use App\BoardMember;
use Auth;
use App\ImageTool;
use App\ResultItem;
use Carbon\Carbon;
use App\GalleryItem;
use App\Gallery;
use App\User;
use App\SystemSetting;



use Request;


class JsonRequestController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    function __construct()
    {

    }
	public function updateCarousel()
	{
        $input= Request::all();

        $itemId=$input['itemId'];
        $caption=$input['caption'];

        $updatedItem=CarouselItem::find($itemId);
        $updatedItem->caption=$caption;
        $success= $updatedItem->save();

        if($success) {
            return $caption;
        }
        else
        {
            return 'false';
        }
	}
    public function updateAddress()
    {
        $input= Request::all();


        $html_text=$input['html_text'];

        $page_id=Page::where('title','Contact')->first()->id;
        $updatedItem = Blog::where('page_id',$page_id)->first();

        $updatedItem->html_text=$html_text;
        $success= $updatedItem->save();

        if($success) {
            return $html_text;
        }
        else
        {
            return 'false';
        }
    }

    public function updateTeam()
    {
        $input= Request::all();
        //return(var_dump($input));
        $name = $input['name'];
        $description = $input['description'];
        $position = $input['position'];
        $twitter = $input['twitter'];
        $facebook = $input['facebook'];
        $year = $input['year'];
        $id = $input['id'];



        $updatedItem = BoardMember::find($id);
        $updatedItem->name = $name;
        $updatedItem->year = $year;
        $updatedItem->position = $position;
        $updatedItem->description = $description;
        $updatedItem->twitter_link=$twitter;
        $updatedItem->facebook_link=$facebook;

        $success= $updatedItem->save();

        if($success) {
            return 'true';
        }
        else
        {
            return 'false';
        }
    }

    public function deleteTeam()
    {
        $input= Request::all();

        $id = $input['id'];



        $deletedItem = BoardMember::find($id);
        $this->deleteFile($deletedItem->image_url);

        $success= $deletedItem->delete();


        if($success) {
            return 'true';
        }
        else
        {
            return 'false';
        }
    }

    public function deleteCarousel()
    {
        $input= Request::all();
        $itemId=$input['itemId'];

        $deletedItem=CarouselItem::find($itemId);

        $this->deleteFile($deletedItem->image_url);
        $success= $deletedItem->delete();


        if($success) {
            return 'true';
        }
        else
        {
            return 'false';
        }
    }
    public function uploadCarouselItem()
    {
        $input= Request::all();

        $file=$input['fileUpload1'];
        $user_id=Auth::user()->id;
       $date = new \DateTime();
        $timestampString = $date->getTimestamp();
        $ext = $file->getClientOriginalExtension();
        $newFilename = $user_id . '_carousel_' . $timestampString . '.' . $ext;
        $oldFilename = $file->getClientOriginalName();
        $tempPath = $file->getRealPath();
        $newImage = new ImageTool($tempPath);
        $newImage->modifyToOptimalSize(955, 355, 200, 200, 200); //op width,height ,r,g,b



        if($file->isValid())
        {
            $file->move('img/usercontent',$newFilename);
            $this->insertCarouselItem($newFilename,$oldFilename);
        }
        return redirect('home');
    }

    public function uploadNewsletter()
    {
        $input= Request::all();

        $file=$input['fileUpload4'];
        //make new file name
        $user_id=Auth::user()->id;
        $date = new \DateTime();
        $timestampString = $date->getTimestamp();
        $ext = $file->getClientOriginalExtension();
        $newFilename = $user_id . '_newsletter_' . $timestampString . '.' . $ext;

        //get newsletter record
        $page_id=Page::where('title','About')->first()->id;
        $oldNewsletter = Blog::where('page_id',$page_id)->where('heading','newsletter')->first();
        //dd($oldNewsletter);

        if($file->isValid())
        {
            if($ext=='pdf'||$ext=='jpg'||$ext='png')
            {
                $file->move('img/usercontent',$newFilename);

                $this->deleteOldNewsletterFile($oldNewsletter);
                $oldNewsletter->image_url='/img/usercontent/' . $newFilename;
                $oldNewsletter->save();
            }

        }
        return redirect('adminabout');
    }
    public function getEventsForDateRange()
    {
        $input= Request::all();
        $to = $input['to'];
        $from = $input['from'];
        $carbonTo = new Carbon($to);
        $carbonFrom = new Carbon($from);
        $events = Event::whereBetween('event_date', array($carbonFrom, $carbonTo))->orderBy('event_date')->get();
        return json_encode($events);

    }
    public function getEventFromId()
    {
        $input= Request::all();
        $id = $input['id'];
        $event = Event::find($id);
        return json_encode($event);

    }

    public function updateEvent()
    {
        $input= Request::all();
        $id = $input['id'];
        $eventName = $input['eventName'];
        $eventDate = $input['eventDate'];
        //convert the string to a carbon date so that it can be used with sql
        $eventDate = new Carbon($eventDate);
        $eventWhere = $input['eventWhere'];
        $eventDescription = $input['eventDescription'];
        $eventAddress = $input['eventAddress'];
        $eventWebUrl = $input['eventWebUrl'];
        $event = Event::find($id);
        $event->event_name=$eventName;
        $event->event_date=$eventDate;
        $event->event_place_text=$eventWhere;
        $event->event_details=$eventDescription;
        $event->event_address=$eventAddress;
        $event->event_url_path=$eventWebUrl;
        $success= $event->save();

        if($success) {
            return 'true';
        }
        else
        {
            return 'false';
        }

    }
    public function updateEventData()
    {
        $input= Request::all();
        $submitButton = $input['fileEventBtn'];
        $returnUrl='admincalendar';
        switch($submitButton)
        {
            Case 'Upload Info':
                $returnUrl=$this->updateEventInfo($input);

                break;
            Case 'Upload Results':
                $returnUrl=$this->updateEventResults($input);
                break;
            Case 'Upload Image':
                $returnUrl=$this->updateEventImage($input);
                break;
        }
        return redirect($returnUrl);
        //dd($submitButton);

    }
    private function updateEventInfo($input)
    {

        //first verify that the file object is populated
        if (isset($input['fileUploadInfo']))
        {
            $file=$input['fileUploadInfo'];
            $eventId = $input['eventId'];


            $updatedEvent = Event::find($eventId);

            //dd($updatedEvent);

            //make new file name
            $user_id=Auth::user()->id;
            $date = new \DateTime();
            $timestampString = $date->getTimestamp();
            $ext = $file->getClientOriginalExtension();
            $newFilename = $user_id . '_eventInfo_' . $timestampString . '.' . $ext;

            if($file->isValid())
            {
                if($ext=='pdf'||$ext=='jpg'||$ext='png'||'doc'||'docx')
                {
                    $file->move('img/usercontent',$newFilename);
                    if($updatedEvent->event_info_path!='')
                    {
                        $this->deleteFile($updatedEvent->event_info_path);
                    }

                    $updatedEvent->event_info_path='/img/usercontent/' . $newFilename;
                    $updatedEvent->save();
                }

            }
            return "admincalendar/editEvent/" . $eventId;


        }


    }
    private function updateEventResults($input)
    {
        // $input= Request::all();
        //first verify that the file object is populated
        if (isset($input['fileUploadResults']))
        {
            $file=$input['fileUploadResults'];
            $eventId = $input['eventId'];



            $ext = $file->getClientOriginalExtension();


            //need to validate file type to be pdf or word .doc or .docx

            //get newsletter record
            $page_id=Page::where('title','About')->first()->id;
            $oldNewsletter = Blog::where('page_id',$page_id)->where('heading','newsletter')->first();
            //dd($oldNewsletter);

            if($file->isValid())
            {
                if($ext=='xls'||$ext=='xlsx')
                {
                    $fileName = $file->getRealPath();
                    $resultsArray = $this->getResultsArrayFromXLSX($fileName);
                    $success = $this->insertResults($resultsArray,$eventId);

                }

            }
            return "admincalendar/editEvent/" . $eventId;

        }
    }

    public function updateBulkEvents()
    {
        $input= Request::all();
        if (isset($input['fileUploadBulkEvents'])) {

            $file = $input['fileUploadBulkEvents'];
            $ext = $file->getClientOriginalExtension();
            if ($file->isValid()) {
                if ($ext == 'xls' || $ext == 'xlsx') {
                    $fileName = $file->getRealPath();
                    $eventsArray = $this->getEventArrayFromXLSX($fileName);
                    $success = $this->insertEventsFromBulk($eventsArray);

                }

            }
        }
    }
    private function getResultsArrayFromXLSX($inputFileName)
    {
        $PHPExcel=config('app.PHPExcelIOFactory');
       // dd($PHPExcel);
        include_once($PHPExcel);


        //  Read your Excel workbook
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFileName);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
        //for ($row = 2; $row <= $highestRow; $row++){
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A2:D' . $highestRow,
                NULL,
                TRUE,
                TRUE);
            //  Insert row data array into your database of choice here
        //}
        return $rowData;

    }
    private function getEventArrayFromXLSX($inputFileName)
    {
        $PHPExcel=config('app.PHPExcelIOFactory');

        include_once($PHPExcel);


        //  Read your Excel workbook
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFileName);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
        //for ($row = 2; $row <= $highestRow; $row++){
        //  Read a row of data into an array
        $rowData = $sheet->rangeToArray('A2:D' . $highestRow);
        //  Insert row data array into your database of choice here
        //}
        return $rowData;
    }
    private function insertEventsFromBulk($eventsArray)
    {
        //delete all results with a specific event id
        //var_dump($resultsArray);

       // dd($eventsArray);
        foreach($eventsArray As $index=>$event)
        {
            $theEvent=null;
            $theDate=null;
            $theDate = Carbon::createFromFormat('m/d/Y',$event[0]);
           // var_dump($event[0]);
            $theDate->setTime(0,0,0);
            $theEvent = Event::where('event_date','=',$theDate)->first();
         // dd($theEvent);
            // var_dump($result);
            if($theEvent == null)
            {
                $newEvent = new Event();

                $newEvent->event_date = $theDate;
                $newEvent->event_name = (isset($event[1]))?$event[1]:'';
                $newEvent->event_place_text = (isset($event[2]))?$event[2]:'';
                $newEvent->event_details = (isset($event[3]))?$event[3]:'';
               // dd($newEvent);
                $newEvent->event_img_url='';
                $newEvent->event_address='';
                $newEvent->event_info_path='';
                $newEvent->event_url_path='';
                $newEvent->event_results_path='';
                $newEvent->save();
            }
            else
            {
                $theEvent->event_name=(isset($event[1]))?$event[1]:'';
                $theEvent->event_place_text = (isset($event[2]))?$event[2]:'';
                $theEvent->event_details = (isset($event[3]))?$event[3]:'';
                $theEvent->save();
            }

        }

        return redirect('admincalendar');

    }
    public function exportResultsToExcel($eventId)
    {
        $event = Event::find($eventId);
        $eventName = $event->event_name;
        $results =  $event->resultItems;
        //dd($results);
        $PHPExcel=config('app.PHPExcelBase');
        $PHPExcelWriter=config('app.PHPExcelWriter');
       // dd($PHPExcel);
        /** PHPExcel */
        include_once($PHPExcel);
        /** PHPExcel_Writer_Excel2007 */
        include_once($PHPExcelWriter);
        //dd($PHPExcelWriter);

        // Create new PHPExcel object
        //echo date('H:i:s') . " Create new PHPExcel object\n";
        $objPHPExcel = new \PHPExcel();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$eventName.'.xlsx"');
        header('Cache-Control: max-age=0');
        // Set properties
       // echo date('H:i:s') . " Set properties\n";
        $objPHPExcel->getProperties()->setCreator("WindyCityStridersSite");
        $objPHPExcel->getProperties()->setLastModifiedBy("WindyCityStridersSite");
        $objPHPExcel->getProperties()->setTitle("Results");
        $objPHPExcel->getProperties()->setSubject("Results");
        $objPHPExcel->getProperties()->setDescription("Results");

        $objPHPExcel->setActiveSheetIndex(0);
        $sheet=$objPHPExcel->getActiveSheet();
        $sheet->SetCellValue('A1','Placement');
        $sheet->SetCellValue('B1','Runner');
        $sheet->SetCellValue('C1','Time');
        $sheet->SetCellValue('D1','Pace');

        foreach($results as $index=>$result)
        {
            $rowNumber = $index +2;
            $sheet->SetCellValue('A' . $rowNumber, $result->placement);
            $sheet->SetCellValue('B' . $rowNumber, $result->runner);
            $sheet->SetCellValue('C' . $rowNumber, $result->time);
            $sheet->SetCellValue('D' . $rowNumber, $result->pace);

        }
        $styleArray = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 14
            ],
            'fill' => [
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '4466FF')
            ]
        ];
       // $sheet->getStyle('A1:D1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('4466FF');
        //$sheet->getStyle('A1:D1')->getFont()->setSize(14)->setBold(true);//setColor(\PHPExcel_Style_Color::COLOR_WHITE);
        $sheet->getStyle('A1:D1')->applyFromArray($styleArray);
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        // Rename sheet
       // echo date('H:i:s') . " Rename sheet\n";
        $objPHPExcel->getActiveSheet()->setTitle('Results');


// Save Excel 2007 file
       // echo date('H:i:s') . " Write to Excel2007 format\n";
       // $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        // We'll be outputting an excel file
        //header('Content-type: application/vnd.ms-excel');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// It will be called file.xls
        //header('Content-Disposition: attachment; filename="file.xlsx"');
        $objWriter->save('php://output');

// Echo done
       // echo date('H:i:s') . " Done writing file.\r\n";


    }
    private function insertResults($resultsArray,$eventId)
    {
        //delete all results with a specific event id
        //var_dump($resultsArray);

        ResultItem::where('event_id',$eventId)->delete();
        foreach($resultsArray As $index=>$result)
        {
           // var_dump($result);
            $newResult = new ResultItem();
            $newResult->event_id=$eventId;
            $newResult->placement = $result[0];
            $newResult->runner = $result[1];
            $newResult->time=$result[2];
            $newResult->pace=$result[3];
            $newResult->save();
        }

        $event=Event::find($eventId);
        $event->event_results_path='/results/' . $eventId;
        $event->save();
       // dd('end');


    }
    private function updateEventImage($input)
    {
        //first verify that the file object is populated
        if (isset($input['fileUploadImage']))
        {
            $file=$input['fileUploadImage'];
            $eventId = $input['eventId'];


            $updatedEvent = Event::find($eventId);


            //make new file name
            $user_id=Auth::user()->id;
            $date = new \DateTime();
            $timestampString = $date->getTimestamp();
            $ext = $file->getClientOriginalExtension();
            $newFilename = $user_id . '_eventImage_' . $timestampString . '.' . $ext;
            $tempPath = $file->getRealPath();
            $newImage = new ImageTool($tempPath);
            $newImage->modifyToOptimalSize(400, 300, 200, 200, 200); //op width,height ,r,g,b

            if($file->isValid())
            {
                if($ext=='pdf'||$ext=='jpg'||$ext='png')
                {
                    $file->move('img/usercontent',$newFilename);
                    if($updatedEvent->event_img_url!='')
                    {
                        $this->deleteFile($updatedEvent->event_img_url);
                    }

                    $updatedEvent->event_img_url='/img/usercontent/' . $newFilename;
                    $updatedEvent->save();
                }

            }
            return "admincalendar/editEvent/" . $eventId;


        }

    }
    public function addEvent()
    {


        $eventDate = new Carbon();

        $event = new Event();
        $event->event_date=$eventDate;
        $event->event_name='default name';
        $event->event_img_url='';
        $event->event_place_text='default place';
        $event->event_address='default address';
        $event->event_details='default description';
        $event->event_url_path='';
        $event->event_info_path='';
        $event->event_results_path='';

        $success= $event->save();

        if($success) {
            return json_encode($event);
        }
        else
        {
            return 'false';
        }

    }
    public function deleteEvent()
    {
        $input= Request::all();
        $id = $input['id'];
        $event = Event::find($id);
        if($event->event_img_url!='')
        {
            $this->deleteFile($event->event_img_url);
        }
        if($event->event_info_path!='')
        {
            $this->deleteFile($event->event_info_path);
        }
        $success= $event->delete();

        if($success) {
            return 'true';
        }
        else
        {
            return 'false';
        }
    }
    private function deleteOldNewsletterFile($oldNewsletter)
    {
        //get the page ID of the about page

        $image_url='';
        if($oldNewsletter!=null) {
            $image_url = $oldNewsletter->image_url;
            $fileexists= $this->deleteFile($image_url);


        }
        echo $image_url;

    }

    private function deleteFile($filePath)
    {
        echo $filePath;
        $filePath='.'.$filePath;
        if(file_exists($filePath))
        {
            unlink($filePath);
            echo 'exists';
            return true;
        }
        else
        {
            echo 'notexists';
            return false;
        }

    }

    public function uploadBlogItem()
    {
        $input= Request::all();
        $heading=$input['adminBlogHeading'];
        $html_text = $input['adminBlogEntry'];
        $user_id=Auth::user()->id;
        $date = new \DateTime();
        $timestampString = $date->getTimestamp();
        if(isset($input['fileUpload2']))
        {
            //there is a selected file
            $file=$input['fileUpload2'];
            $ext = $file->getClientOriginalExtension();
            $newFilename = $user_id . '_blog_' . $timestampString . '.' . $ext;

            $tempPath = $file->getRealPath();
            $newImage = new ImageTool($tempPath);
            $newImage->modifyToOptimalSize(600, 350, 200, 200, 200);
            if($file->isValid())
            {
                $file->move('img/usercontent',$newFilename);
                $outputArray= array('heading'=>$heading,'html_text'=>$html_text,'image_url'=>'/img/usercontent/' . $newFilename);
                $this->insertBlog($outputArray);
            }
        }
        else
        {
            $outputArray= array('heading'=>$heading,'html_text'=>$html_text,'image_url'=>'' );
            $this->insertBlog($outputArray);
        }

        return redirect('blog');
    }

    public function uploadTeamImage()
    {
        $input= Request::all();
        if(isset($input['fileUpload3'])) {
            $file = $input['fileUpload3'];
            $user_id = Auth::user()->id;
            $date = new \DateTime();
            $timestampString = $date->getTimestamp();
            $ext = $file->getClientOriginalExtension();
            $newFilename = $user_id . '_board_' . $timestampString . '.' . $ext;
            $oldFilename = $file->getClientOriginalName();
            $tempPath = $file->getRealPath();
            $newImage = new ImageTool($tempPath);
            $newImage->modifyToOptimalSize(200, 280, 200, 200, 200); //op width,height ,r,g,b


            if ($file->isValid()) {
                $file->move('img/usercontent', $newFilename);
                $this->insertBoardMember($newFilename);
            }
        }
        return redirect('team');
    }
    private function insertCarouselItem($newFilename,$oldFilename)
    {



        $insertItem= new CarouselItem();
        $insertItem->reference_name = $oldFilename;
        $insertItem->image_url = '/img/usercontent/' . $newFilename;
        $insertItem->caption = 'default';
        $insertItem->sort_order= CarouselItem::where('sort_order', '>', '1')->max('sort_order')+1;

        $success=$insertItem->save();


        if($success) {
            return true;
        }
        else
        {
            return false;
        }
    }

    private function insertBoardMember($newFileName)
    {
        $insertItem = new BoardMember();
        $insertItem->name='New User';
        $insertItem->year='2015';
        $insertItem->position='BOARD MEMBER';
        $insertItem->image_url='/img/usercontent/' . $newFileName;
        $insertItem->description='';
        $insertItem->twitter_link='';
        $insertItem->facebook_link='';
        $insertItem->sort_order='1';

        $success=$insertItem->save();
        if($success) {
            return true;
        }
        else
        {
            return false;
        }



    }



    public function updateAbout()
    {
        $input= Request::all();
        $itemId=$input['itemId'];
        $heading=$input['heading'];
        $html_text=$input['html_text'];
        $updatedItem=Blog::find($itemId);
        $updatedItem->heading=$heading;
        $updatedItem->html_text=$html_text;
        $success=$updatedItem->save();
        if($success) {
            return json_encode(array('heading'=>$heading,'html_text'=>$html_text));
        }
        else
        {
            return 'false';
        }

    }
    public function insertBlog($input=null)
    {
        if($input==null) {   //to support direct post
            $input = Request::all();
        }
        $heading=$input['heading'];
        $html_text=$input['html_text'];
        $image_url=$input['image_url'];
        $insertItem= new Blog;
        $insertItem->heading=$heading;
        $insertItem->html_text=$html_text;
        $insertItem->image_url=$image_url;
        $insertItem->page_id = Page::where('title','=','Blog')->first()->id;
        $insertItem->user_id=Auth::user()->id;
        $insertItem->blog_level='primary';
        $insertItem->image_position='top';
        $carbon = new Carbon();
        $insertItem->expiration_date=$carbon->now()->addYears(1);
        $insertItem->sort_order= Blog::where('page_id','=',$insertItem->page_id)->max('sort_order') + 1;
        $success=$insertItem->save();


        if($success) {
            return json_encode(array('heading'=>$heading,'html_text'=>$html_text,'image_url'));
        }
        else
        {
            return 'false';
        }

    }

    public function insertComment()
    {
        $input= Request::all();

        $heading='';
        $html_text=$input['html_text'];
        $image_url='';
        $insertItem= new Blog;
        $insertItem->heading=$heading;
        $insertItem->html_text=$html_text;
        $insertItem->image_url=$image_url;
        $insertItem->page_id = Page::where('title','=','Blog')->first()->id;
        $insertItem->user_id=Auth::user()->id;
        $insertItem->blog_level='reply';
        $insertItem->blog_id=$input['blog_id'];
        $insertItem->image_position='top';
        $carbon = new Carbon();
        $insertItem->expiration_date=$carbon->now()->addYears(1);
        $insertItem->sort_order= Blog::where('page_id','=',$insertItem->page_id)->max('sort_order') + 1;
        $success=$insertItem->save();


        if($success) {
            return json_encode(array('heading'=>$heading,'html_text'=>$html_text,'image_url'));
        }
        else
        {
            return 'false';
        }

    }
    public function deleteComment()
    {
        $input= Request::all();
        $id = $input['id'];
        $theReplyToBeDeleted = Blog::find($id);
        $success=$theReplyToBeDeleted->delete();



        if($success) {
            return 'true';
        }
        else
        {
            return 'false';
        }

    }

    public function moveBlogUp()
    {
        $input= Request::all();
        $itemId=$input['id'];
        $itemToMoveUp = Blog::find($itemId);
        $page_id = $itemToMoveUp->page_id;
        $sort_order = $itemToMoveUp->sort_order;
        $itemToSwitchWith = Blog::where('page_id','=',$page_id)->where('sort_order', '>', $sort_order)->where('blog_level','=','primary')->orderBy('sort_order','asc')->first();
        $success1=false;
        $success2=false;
        if($itemToSwitchWith!=null) {
            $new_sort_order = $itemToSwitchWith->sort_order;
            $itemToMoveUp->sort_order = $new_sort_order;
            $success1 = $itemToMoveUp->save();
            $itemToSwitchWith->sort_order = $sort_order;
            $success2 = $itemToSwitchWith->save();
        }
        if($success1&&$success2) {
            return 'true';
        }
        else
        {
            return 'false';
        }

    }

    public function promoteToHomepage()
    {
        $input= Request::all();
        $itemId=$input['id'];
        $itemToPromote = Blog::find($itemId);
        $itemToPromote->page_id = Page::where('title','=','Home')->first()->id;
        $itemToPromote->save();

    }
    public function removeFromHomepage()
    {
        $input= Request::all();
        $itemId=$input['id'];
        $itemToPromote = Blog::find($itemId);
        $itemToPromote->page_id = Page::where('title','=','Blog')->first()->id;
        $itemToPromote->save();

    }

    public function getResultsFromEventId()
    {
        $input = Request::all();
        $eventId = $input['eventId'];
       // echo $eventId;
        $results = Event::find($eventId)->resultItems;
        return json_encode($results);

    }

    public function saveGalleryCaption()
    {

        $input= Request::all();
        $id = $input['id'];
        $caption=$input['caption'];
        $galleryItem=GalleryItem::find($id);
        $galleryItem->caption=$caption;
        $galleryItem->save();
        return 'true';

        //dd($submitButton);
    }

    public function saveGalleryEdits()
    {

        $input= Request::all();
        $id = $input['id'];
        $title = $input['title'];
        $event_id=$input['event_id'];
        $gallery=Gallery::find($id);
        $gallery->title=$title;
        if($event_id!='none')
        {
            $gallery->event_id=$event_id;
            //$event=Event::find($event_id);
            //$event->
        }
        else
        {
            $gallery->event_id=null;
        }
        $gallery->save();
        return 'true';

        //dd($submitButton);
    }

    public function deleteGalleryItem()
    {
        $input= Request::all();
        $id = $input['id'];
        $galleryItem = GalleryItem::find($id);
        $oldFilePath = $galleryItem->image_url;
        $fileIsDeleted = $this->deleteFile($oldFilePath);
        $galleryItem->delete();



    }
    public function deleteGallery()
    {
        $input=Request::all();
        $id = $input['id'];
        $gallery = Gallery::find($id);
        if($gallery->galleryItems->count()>0)
        {
            return 'Items Remaining';
        }
        else
        {
            $gallery->delete();
        }



    }
    public function updateGalleryData()
    {
        $input= Request::all();
        $submitButton = $input['fileGalleryBtn'];

        //dd($submitButton);
        $returnUrl='admingallery';
        switch($submitButton)
        {
            Case 'Upload Image':
                $returnUrl=$this->insertGalleryItemImage($input);

                break;
            Case 'Update Tile Image':
                $returnUrl=$this->updateGalleryTileImage($input);
                break;

        }
        return redirect($returnUrl);
    }
    private function updateGalleryTileImage($input)
    {

        if (isset($input['fileUploadGalleryTileImage']))
        {

            $file=$input['fileUploadGalleryTileImage'];
            $galleryId = $input['galleryId'];
            $gallery = Gallery::find($galleryId);


            //make new file name
            $user_id=Auth::user()->id;
            $date = new \DateTime();
            $timestampString = $date->getTimestamp();
            $ext = $file->getClientOriginalExtension();
            $newFilename = $user_id . '_galleryTileImage_' . $timestampString . '.' . $ext;
            $tempPath = $file->getRealPath();
            $newImage = new ImageTool($tempPath);
            $newImage->modifyToOptimalSize(300, 300, 255, 255, 255); //op width,height ,r,g,b

            if($file->isValid())
            {
                if($ext=='gif'||$ext=='jpg'||$ext='png'||$ext='jpeg')
                {
                    $file->move('img/usercontent',$newFilename);
                    if($gallery->image_url!='')
                    {
                        $this->deleteFile($gallery->image_url);
                    }

                    $gallery->image_url='/img/usercontent/' . $newFilename;
                    $gallery->save();
                }

            }
            return "admingallery/" . $galleryId;


        }


    }
    private function insertGalleryItemImage($input)
    {
        if (isset($input['fileUploadGalleryImage']))
        {
            $file=$input['fileUploadGalleryImage'];
            $galleryId = $input['galleryId'];
            $galleryItem = New GalleryItem();
            $galleryItem->caption='default caption';
            $galleryItem->sort_order=0;
            $galleryItem->gallery_id = $galleryId;


            //make new file name
            $user_id=Auth::user()->id;
            $date = new \DateTime();
            $timestampString = $date->getTimestamp();
            $ext = $file->getClientOriginalExtension();
            $newFilename = $user_id . '_galleryItem_' . $timestampString . '.' . $ext;
            $tempPath = $file->getRealPath();
            $newImage = new ImageTool($tempPath);
            //$newImage->modifyToOptimalSize(400, 400, 255, 255, 255); //op width,height ,r,g,b

            if($file->isValid())
            {
                if($ext=='gif'||$ext=='jpg'||$ext='png'||$ext='jpeg')
                {
                    $file->move('img/usercontent',$newFilename);

                    $galleryItem->image_url='/img/usercontent/' . $newFilename;
                    $galleryItem->save();
                }

            }
            return "admingallery/" . $galleryId;


        }
    }

    public function approveUser()
    {
        $input= Request::all();
        $id = $input['id'];
        $user_profile = $input['user_profile'];
        $user = User::find($id);
        $user->approved=1;
        $user->user_profile=$user_profile;
        $user->save();


    }

    public function deleteUser()
    {
        $input= Request::all();
        $id = $input['id'];

        $user = User::find($id);

        $user->delete();


    }
    public function saveSponsorEdits()
    {
        $input= Request::all();
        $id = $input['id'];
        $heading = $input['heading'];
        $html_text = $input['html_text'];
        $html_text = str_replace('http://','',$html_text);
        $html_text = str_replace('https://','',$html_text);
        $sponsor = Blog::find($id);
        $sponsor->heading=$heading;
        $sponsor->html_text=$html_text;
        $sponsor->save();


    }
    public function deleteSponsor()
    {
        $input= Request::all();
        $id = $input['id'];
        $sponsor = Blog::find($id);
        $filePathForImage = $sponsor->image_url;
        $this->deleteFile($filePathForImage);
        $sponsor->delete();
    }
    public function updateSponsorHeading()
    {
        $input= Request::all();

        $heading = $input['heading'];


        $page_id = Page::where('title','=','Sponsors')->first()->id;
        $user_id = Auth::user()->id;
        Blog::where('heading','=','sponsors')->delete();

        $sponsor = new Blog();
        $sponsor->user_id = $user_id;
        $sponsor->page_id = $page_id;
        $sponsor->blog_level = 'primary';
        $sponsor->heading = 'sponsors';
        $sponsor->html_text = $heading; //this is confusing, but the html_text is the heading content of the sponsors page
        $carbon=new Carbon();
        $sponsor->expiration_date=$carbon->now()->addYears(1);

        $sponsor->save();
    }
    public function uploadSponsorImage()
    {
        $input= Request::all();
        if (isset($input['fileUploadSponsorImage']))
        {
            $file=$input['fileUploadSponsorImage'];
            //will need
            $page_id = Page::where('title','=','Sponsors')->first()->id;
            $user_id = Auth::user()->id;
            $sponsor = New Blog();
            $sponsor->user_id = $user_id;
            $sponsor->page_id = $page_id;
            $sponsor->blog_level = 'primary';
            $sponsor->heading = 'New Sponsor';
            $sponsor->html_text = '';
            $sponsor->sort_order= Blog::where('page_id','=',$sponsor->page_id)->max('sort_order') + 1;




            //make new file name

            $date = new \DateTime();
            $timestampString = $date->getTimestamp();
            $ext = $file->getClientOriginalExtension();
            $newFilename = $user_id . '_sponsor_' . $timestampString . '.' . $ext;
            $tempPath = $file->getRealPath();
            $newImage = new ImageTool($tempPath);
            $newImage->modifyToOptimalSize(350, 100, 255, 255, 255,'left'); //op width,height ,r,g,b,position

            if($file->isValid())
            {
                if($ext=='gif'||$ext=='jpg'||$ext='png'||$ext='jpeg')
                {
                    $file->move('img/usercontent',$newFilename);

                    $sponsor->image_url='/img/usercontent/' . $newFilename;
                    $sponsor->save();
                }

            }
            return redirect("adminsponsors") ;


        }
    }
    public function moveSponsorUp()
    {
        $input= Request::all();
        $id = $input['id'];
        $itemToMoveUp = Blog::find($id);
        $page_id = $itemToMoveUp->page_id;
        $sort_order = $itemToMoveUp->sort_order;
        $itemToSwitchWith = Blog::where('page_id','=',$page_id)->where('sort_order', '>', $sort_order)->where('heading','<>','sponsors')->orderBy('sort_order','asc')->first();
        $success1=false;
        $success2=false;
        if($itemToSwitchWith!=null) {
            $new_sort_order = $itemToSwitchWith->sort_order;
            $itemToMoveUp->sort_order = $new_sort_order;
            $success1 = $itemToMoveUp->save();
            $itemToSwitchWith->sort_order = $sort_order;
            $success2 = $itemToSwitchWith->save();
        }
    }
    public function moveSponsorDown()
    {
        $input= Request::all();
        $id = $input['id'];
        $itemToMoveUp = Blog::find($id);
        $page_id = $itemToMoveUp->page_id;
        $sort_order = $itemToMoveUp->sort_order;
        $itemToSwitchWith = Blog::where('page_id','=',$page_id)->where('sort_order', '<', $sort_order)->where('heading','<>','sponsors')->orderBy('sort_order','desc')->first();
        $success1=false;
        $success2=false;
        if($itemToSwitchWith!=null) {
            $new_sort_order = $itemToSwitchWith->sort_order;
            $itemToMoveUp->sort_order = $new_sort_order;
            $success1 = $itemToMoveUp->save();
            $itemToSwitchWith->sort_order = $sort_order;
            $success2 = $itemToSwitchWith->save();
        }
    }
    public function updateSystemSettings()
    {
        $input= Request::all();
        $settings = $input['settings'];
        $decodedSettings = json_decode($settings);
        //dd($decodedSettings);
        foreach($decodedSettings as $setting)
        {
            $updatedItem = SystemSetting::where('key','=',$setting[0])->first();
            $updatedItem->value=$setting[1];
            $updatedItem->save();
        }

    }
    public function saveJoinTextEdits()
    {
        $input= Request::all();
        $html_text=$input['html_text'];
        $pageId = Page::where('title', '=','Join')->first()->id;
        $joinHtmlTextBlog = Blog::where('page_id','=',$pageId)->where('heading','=','joinText')->first();
        $joinHtmlTextBlog->html_text=$html_text;
        $joinHtmlTextBlog->save();

    }
    public function uploadMembershipForm()
    {
        $input= Request::all();
        if (isset($input['fileUploadMembershipForm']))
        {
            $file=$input['fileUploadMembershipForm'];
            //will need
            $pageId = Page::where('title', '=','Join')->first()->id;
            $membershipForm = Blog::where('page_id','=',$pageId)->where('heading','=','joinForm')->first();

            $user_id = Auth::user()->id;

            $membershipForm->user_id = $user_id;

           //make new file name

            $date = new \DateTime();
            $timestampString = $date->getTimestamp();
            $ext = $file->getClientOriginalExtension();
            $newFilename = $user_id . '_membershipForm_' . $timestampString . '.' . $ext;



            if($file->isValid())
            {
                if($ext=='pdf')
                {
                    $file->move('img/usercontent',$newFilename);

                    $this->deleteFile($membershipForm->image_url);
                    $membershipForm->image_url='/img/usercontent/' . $newFilename;
                    $membershipForm->save();
                }

            }
            return redirect("adminjoin") ;


        }
    }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
