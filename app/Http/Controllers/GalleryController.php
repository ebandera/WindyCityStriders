<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GalleryItem;
use App\Gallery;
use Auth;

use Carbon\Carbon;
use App\Event;



class GalleryController extends Controller {

	//


    public function __construct()
    {
        parent::__construct();
    }

    public function index($galleryId)
    {


        $galleryItems = galleryItem::where('gallery_id',$galleryId)->get();

        $sdh= $this->sdh->getData();
        return view('pages.gallery',compact('galleryItems','sdh'));
            //

    }
    public function main()
    {


        //$galleryItems = galleryItem::all();
        //get the galleries instead
        $galleries = gallery::all();
        $sdh= $this->sdh->getData();
        return view('pages.gallerymain',compact('galleries','sdh'));
        //

    }
    public function adminindex($galleryId)
    {


        $galleryItems = GalleryItem::where('gallery_id',$galleryId)->get();
        $gallery = Gallery::find($galleryId);
        $begDate=null;
        $endDate=null;
        //if the event is alreadyselected, define strict date range for that day
        if($gallery->event_id==null)
        {

            $endDate = new Carbon();

            $endDate->setTime(0,0);
            $endDateClone = Carbon::instance($endDate);
            $begDate = $endDateClone->subYear();

        }
        else
        {
            $begDate= new Carbon($gallery->event->event_date);
            $endDate= new Carbon($gallery->event->event_date);
            $endDate->setTime(23,59);


        }

        $eventList = Event::whereBetween('event_date', array($begDate, $endDate))->orderBy('event_date')->get();


        $sdh= $this->sdh->getData();
        return view('adminpages.gallery',compact('galleryItems','sdh','gallery','begDate','endDate','eventList'));
        //

    }
    public function adminmain()
    {


        //$galleryItems = galleryItem::all();
        $galleries = gallery::all();
        $sdh= $this->sdh->getData();
        return view('adminpages.gallerymain',compact('galleries','sdh'));
        //

    }
    public function insert()
    {
        $defaultGalleryTileImage=config('app.DefaultGalleryTile');


        //make new file name
        $user_id=Auth::user()->id;
        $date = new \DateTime();
        $timestampString = $date->getTimestamp();
        $ext = pathinfo($defaultGalleryTileImage, PATHINFO_EXTENSION);
        $newFilename = $user_id . '_galleryTileImage_' . $timestampString . '.' . $ext;

        copy($defaultGalleryTileImage,'img/usercontent/' . $newFilename);
        $gallery = new gallery();
        $gallery->event_id=null;
        $gallery->title='default';
        $gallery->image_url='/img/usercontent/' . $newFilename;
        $gallery->sort_order=0;
        $gallery->save();


        return 'true';
    }

    public function saveGalleryCaption()
    {
        dd(Request);
        $input= Request::all();
        $id = $input['id'];
        $caption=$input['caption'];
        $gallery=Gallery::find($id);
        $gallery->caption=$caption;
        $gallery->save();
        return 'true';

        //dd($submitButton);
    }

}
