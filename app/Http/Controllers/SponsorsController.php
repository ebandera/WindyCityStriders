<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Blog;
use App\Page;

use Illuminate\Http\Request;

class SponsorsController extends Controller {

    public function index()
    {
        $page = Page::where('title','=','Sponsors')->first();
        $blogs = $page->sponsors;
        $headerBlog = $page->sponsorHeading;
        //dd($headerBlog);
        $sdh= $this->sdh->getData();


        return view('pages.sponsors',compact('blogs','sdh','headerBlog'));
    }

    public function admin()
    {
        $page = Page::where('title','=','Sponsors')->first();
        $blogs = $page->sponsors;
        $headerBlog = $page->sponsorHeading;

        //dd($headerBlog);
        $sdh= $this->sdh->getData();


        return view('adminpages.sponsors',compact('blogs','sdh','headerBlog'));
    }

}
