<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use App\Blog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Http\Request;

class CalendarController extends Controller {

   function __construct()
   {
       parent::__construct();
   }
    public function index()
    {

        $calendarItem = Event::where('event_date', '>', Carbon::now())->orderBy('event_date')->firstOrFail();
        if(!$calendarItem){exit();}
        $monthNumber = date_format($calendarItem->event_date,'m');
        $yearNumber = date_format($calendarItem->event_date,'Y');
        $timeString = $yearNumber . '-' . $monthNumber . '-01 00:00:00';


        $firstOfMonth = new Carbon($timeString);
        $firstOfMonthClone = Carbon::instance($firstOfMonth);
        $nextMonth = $firstOfMonthClone->addMonth()->subSecond();
        //echo $monthNumber,' ',$yearNumber;
        //var_dump($firstOfMonth);


        $calendarMonthItems = Event::whereBetween('event_date', array($firstOfMonth, $nextMonth))->orderBy('event_date')->get();
       // var_dump(count($calendarMonthItems));exit();
        $sdh= $this->sdh->getData();
        return view('pages.calendar',compact('calendarItem','calendarMonthItems','sdh'));
    }
    public function admin()
    {

        $calendarItem = Event::where('event_date', '>', Carbon::now())->orderBy('event_date')->firstOrFail();
        if(!$calendarItem){exit();}
        $monthNumber = date_format($calendarItem->event_date,'m');
        $yearNumber = date_format($calendarItem->event_date,'Y');
        $timeString = $yearNumber . '-' . $monthNumber . '-01 00:00:00';

        //get the events for the current month
        $firstOfMonth = new Carbon($timeString);

        $firstOfMonthClone = Carbon::instance($firstOfMonth);
        $nextMonth = $firstOfMonthClone->addMonth()->subSecond();
        $calendarMonthItems = Event::whereBetween('event_date', array($firstOfMonth, $nextMonth))->orderBy('event_date')->get();

        //to return the events for the bottom list over the next year
        $todayDate = new Carbon();

        $todayDate->setTime(0,0);
        $todayDateClone = Carbon::instance($todayDate);
        $oneYear = $todayDateClone->addYear()->subSecond();
        $eventListItems = Event::whereBetween('event_date', array($todayDate, $oneYear))->orderBy('event_date')->get();

        $sdh= $this->sdh->getData();
       //dd($calendarItem);

        return view('adminpages.calendar',compact('calendarItem','calendarMonthItems','eventListItems','sdh'));
    }
    public function selectEvent($id)
    {
        $calendarItem = Event::find($id);
        $monthNumber = date_format($calendarItem->event_date,'m');
        $yearNumber = date_format($calendarItem->event_date,'Y');
        $timeString = $yearNumber . '-' . $monthNumber . '-01 00:00:00';


        $firstOfMonth = new Carbon($timeString);
        $firstOfMonthClone = Carbon::instance($firstOfMonth);
        $nextMonth = $firstOfMonthClone->addMonth()->subSecond();
        //echo $monthNumber,' ',$yearNumber;
        //var_dump($firstOfMonth);


        $calendarMonthItems = Event::whereBetween('event_date', array($firstOfMonth, $nextMonth))->orderBy('event_date')->get();
        // var_dump(count($calendarMonthItems));exit();
        $sdh= $this->sdh->getData();
        return view('pages.calendar',compact('calendarItem','calendarMonthItems','sdh'));
    }

    public function editEvent($id)
    {

        //$calendarItem = Event::where('event_date', '>', Carbon::now())->orderBy('event_date')->firstOrFail();
        $calendarItem = Event::find($id);
        if(!$calendarItem){exit();}
        $monthNumber = date_format($calendarItem->event_date,'m');
        $yearNumber = date_format($calendarItem->event_date,'Y');
        $timeString = $yearNumber . '-' . $monthNumber . '-01 00:00:00';

        //get the events for the current month
        $firstOfMonth = new Carbon($timeString);

        $firstOfMonthClone = Carbon::instance($firstOfMonth);
        $nextMonth = $firstOfMonthClone->addMonth()->subSecond();
        $calendarMonthItems = Event::whereBetween('event_date', array($firstOfMonth, $nextMonth))->orderBy('event_date')->get();

        //to return the events for the bottom list over the next year
        $todayDate = new Carbon();

        $todayDate->setTime(0,0);
        $todayDateClone = Carbon::instance($todayDate);
        $oneYear = $todayDateClone->addYear()->subSecond();
        $eventListItems = Event::whereBetween('event_date', array($todayDate, $oneYear))->orderBy('event_date')->get();

        $editingEvent = Event::find($id);
        //dd($editingEvent);

        $sdh= $this->sdh->getData();
        return view('adminpages.calendar',compact('calendarItem','calendarMonthItems','eventListItems','sdh','editingEvent'));
    }

    public function selectEventAdmin($id)
    {
        $calendarItem = Event::find($id);
        if($calendarItem!=null)
        {


        $monthNumber = date_format($calendarItem->event_date,'m');
        $yearNumber = date_format($calendarItem->event_date,'Y');
        $timeString = $yearNumber . '-' . $monthNumber . '-01 00:00:00';


        $firstOfMonth = new Carbon($timeString);
        $firstOfMonthClone = Carbon::instance($firstOfMonth);
        $nextMonth = $firstOfMonthClone->addMonth()->subSecond();

        $calendarMonthItems = Event::whereBetween('event_date', array($firstOfMonth, $nextMonth))->orderBy('event_date')->get();

        //to return the events for the bottom list over the next year
        $todayDate = new Carbon();
        $todayDate->setTime(0,0);
        $todayDateClone = Carbon::instance($todayDate);
        $oneYear = $todayDateClone->addYear()->subSecond();
        $eventListItems = Event::whereBetween('event_date', array($todayDate, $oneYear))->orderBy('event_date')->get();
        // var_dump(count($calendarMonthItems));exit();
        $sdh= $this->sdh->getData();
        return view('adminpages.calendar',compact('calendarItem','calendarMonthItems','eventListItems','sdh'));
        }
        else
        {
            return redirect('admincalendar');
        }
    }

    public function changeTime($direction,$dateReference)
    {
        $year = substr($dateReference,0,4);
        $month = substr($dateReference,5,2);
        $op = '>=';
        $orderBy = 'ASC';
        //run some filters
        switch($direction)
        {
            case 'nextMonth':
                $month +=1;
                break;
            case 'nextYear':
                $year +=1;
                break;
            case 'previousMonth':
                //$month -=1;
                $op = '<';
                $orderBy = 'DESC';

                break;
            case 'previousYear':
                $month = '01';
                $op = '<';
                $orderBy = 'DESC';
                break;
            default:
                $month +=1;


        }
        $timeString = $year . '-' . $month . '-01 00:00:00';
       // echo $timeString;exit();
        $firstOfMonth = new Carbon($timeString);
        try
        {
            $calendarItem = Event::where('event_date', $op, $firstOfMonth)->orderBy('event_date',$orderBy)->firstOrFail();
        }
// catch(Exception $e) catch any exception
        catch(ModelNotFoundException $e)
        {
           if ($op=='>=')
           {
               $op='<';
               $orderBy = 'DESC';
           }
            else
            {
                $op='>=';
                $orderBy = 'ASC';
            }
            $calendarItem = Event::where('event_date', $op, $firstOfMonth)->orderBy('event_date',$orderBy)->firstOrFail();

        }
        //echo $op;

        if(!$calendarItem){exit();}
        $monthNumber = date_format($calendarItem->event_date,'m');
        $yearNumber = date_format($calendarItem->event_date,'Y');
        $timeString = $yearNumber . '-' . $monthNumber . '-01 00:00:00';
        $firstOfMonth = new Carbon($timeString);


        $firstOfMonthClone = Carbon::instance($firstOfMonth);
        $nextMonth = $firstOfMonthClone->addMonth()->subSecond();
        //echo $monthNumber,' ',$yearNumber;
        //var_dump($firstOfMonth);


        $calendarMonthItems = Event::whereBetween('event_date', array($firstOfMonth, $nextMonth))->orderBy('event_date')->get();
        // var_dump(count($calendarMonthItems));exit();
        $sdh= $this->sdh->getData();
        return view('pages.calendar',compact('calendarItem','calendarMonthItems','sdh'));
    }

    public function changeTimeAdmin($direction,$dateReference)
    {
        $year = substr($dateReference,0,4);
        $month = substr($dateReference,5,2);
        $op = '>=';
        $orderBy = 'ASC';
        //run some filters
        switch($direction)
        {
            case 'nextMonth':
                $month +=1;
                break;
            case 'nextYear':
                $year +=1;
                break;
            case 'previousMonth':
                //$month -=1;
                $op = '<';
                $orderBy = 'DESC';

                break;
            case 'previousYear':
                $month = '01';
                $op = '<';
                $orderBy = 'DESC';
                break;
            default:
                $month +=1;


        }
        $timeString = $year . '-' . $month . '-01 00:00:00';
        // echo $timeString;exit();
        $firstOfMonth = new Carbon($timeString);
        try
        {
            $calendarItem = Event::where('event_date', $op, $firstOfMonth)->orderBy('event_date',$orderBy)->firstOrFail();
        }
// catch(Exception $e) catch any exception
        catch(ModelNotFoundException $e)
        {
            if ($op=='>=')
            {
                $op='<';
                $orderBy = 'DESC';
            }
            else
            {
                $op='>=';
                $orderBy = 'ASC';
            }
            $calendarItem = Event::where('event_date', $op, $firstOfMonth)->orderBy('event_date',$orderBy)->firstOrFail();

        }
        //echo $op;

        if(!$calendarItem){exit();}
        $monthNumber = date_format($calendarItem->event_date,'m');
        $yearNumber = date_format($calendarItem->event_date,'Y');
        $timeString = $yearNumber . '-' . $monthNumber . '-01 00:00:00';
        $firstOfMonth = new Carbon($timeString);


        $firstOfMonthClone = Carbon::instance($firstOfMonth);
        $nextMonth = $firstOfMonthClone->addMonth()->subSecond();
        //echo $monthNumber,' ',$yearNumber;
        //var_dump($firstOfMonth);


        $calendarMonthItems = Event::whereBetween('event_date', array($firstOfMonth, $nextMonth))->orderBy('event_date')->get();

        //to return the events for the bottom list over the next year
        $todayDate = new Carbon();
        $todayDate->setTime(0,0);
        $todayDateClone = Carbon::instance($todayDate);
        $oneYear = $todayDateClone->addYear()->subSecond();
        $eventListItems = Event::whereBetween('event_date', array($todayDate, $oneYear))->orderBy('event_date')->get();
        // var_dump(count($calendarMonthItems));exit();
        $sdh= $this->sdh->getData();
        return view('adminpages.calendar',compact('calendarItem','calendarMonthItems','eventListItems','sdh'));
    }


}
