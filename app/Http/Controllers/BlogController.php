<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Blog;
use App\Page;
use Illuminate\Http\Request;

class BlogController extends Controller {

	//
    public function index()
    {
        // return "gallery Item";

        //$blogs = Blog::all();

        $blogs = Page::where('title','=','Blog')->first()->blog;
        //$userName = Blog::find(2)->user->first_name;
        //echo $userName;exit();


        return view('blog',compact('blogs'));
        //

    }


}
