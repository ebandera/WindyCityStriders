<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Blog;
use App\Page;
use Illuminate\Http\Request;

class AboutController extends Controller {


    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $blogs = Page::where('title','=','About')->first()->blog;
        $footerBlogs = Blog::all()->take(3);
        return view('pages.about',compact('blogs','footerBlogs'));
    }
    public function admin()
    {
        $blogs = Page::where('title','=','About')->first()->blog;
        $footerBlogs = Blog::all()->take(3);
        return view('adminpages.about',compact('blogs','footerBlogs'));
    }

}