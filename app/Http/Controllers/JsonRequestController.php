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
use Carbon\Carbon;


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

    public function deleteCarousel()
    {
        $input= Request::all();
        $itemId=$input['itemId'];

        $deletedItem=CarouselItem::find($itemId);
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
