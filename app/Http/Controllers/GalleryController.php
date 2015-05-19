<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GalleryItem;
use App\Gallery;
use Illuminate\Http\Request;
use App\Blog;

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


        $galleryItems = galleryItem::where('gallery_id',$galleryId)->get();

        $sdh= $this->sdh->getData();
        return view('pages.gallery',compact('galleryItems','sdh'));
        //

    }
    public function adminmain()
    {


        //$galleryItems = galleryItem::all();
        $galleries = gallery::all();
        $sdh= $this->sdh->getData();
        return view('pages.gallerymain',compact('galleries','sdh'));
        //

    }

}
