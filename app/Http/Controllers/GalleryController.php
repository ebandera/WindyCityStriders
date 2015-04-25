<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GalleryItem;
use Illuminate\Http\Request;
use App\Blog;

class GalleryController extends Controller {

	//
    public function index()
    {
       // return "gallery Item";
        echo "new";
        $galleryItems = galleryItem::all();

        $footerBlogs = Blog::all()->take(3);
        return view('pages.gallery',compact('galleryItems','footerBlogs'));
            //

    }

}
