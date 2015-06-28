<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ResultItem;
use App\Event;

use Illuminate\Http\Request;

class ResultsController extends Controller {

	//

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $sdh= $this->sdh->getData();
        //$eventsWithResults=Event::with('resultItems')->get();
        $test=ResultItem::with('event')->get();
        $eventsWithResults = Event::join('result_items','events.id','=','result_items.event_id')->groupBy('event_id')->get();
       // dd($test2);
        $results=null;

        return view('pages.results',compact('sdh','eventsWithResults','results'));
    }

    function show($eventId)
    {
        $sdh= $this->sdh->getData();
        //$eventsWithResults=Event::with('resultItems')->get();
        $test=ResultItem::with('event')->get();
        $eventsWithResults = Event::join('result_items','events.id','=','result_items.event_id')->groupBy('event_id')->get();
        // dd($test2);
        $results=ResultItem::where('event_id',$eventId)->orderBy('placement')->get();

        return view('pages.results',compact('sdh','eventsWithResults','results'));

    }


}
