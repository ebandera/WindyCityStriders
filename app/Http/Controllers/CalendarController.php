<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Http\Request;

class CalendarController extends Controller {

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


        $calendarMonthItems = Event::whereBetween('event_date', array($firstOfMonth, $nextMonth))->get();
       // var_dump(count($calendarMonthItems));exit();
        //var_dump($calendarItem);exit();
        return view('pages.calendar',compact('calendarItem','calendarMonthItems'));
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
        //var_dump($calendarItem);exit();
        return view('pages.calendar',compact('calendarItem','calendarMonthItems'));
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
        echo $op;

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
        //var_dump($calendarItem);exit();
        return view('pages.calendar',compact('calendarItem','calendarMonthItems'));
    }




}
