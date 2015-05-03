<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GalleryItem;
use Illuminate\Http\Request;
use App\Blog;

class GalleryController extends Controller {

	//


    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {


        $galleryItems = galleryItem::all();

        $sdh= $this->sdh->getData();
        return view('pages.gallery',compact('galleryItems','sdh'));
            //

    }

}
