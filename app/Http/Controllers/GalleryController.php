<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller {

	//
    public function index()
    {
       // return "gallery Item";
        echo "new";
        $galleryItems = galleryItem::all();


        return view('gallery',compact('galleryItems'));
            //

    }

}
