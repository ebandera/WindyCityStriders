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

    public function __construct()
    {

       parent::__construct();
    }

    public function index()
    {
        $page = Page::where('title','=','About')->first();
        $blogs = $page->aboutContent;
        $newsletter = $page->newsletter;
        $sdh= $this->sdh->getData();


        return view('pages.about',compact('blogs','sdh','newsletter'));
    }
    public function admin()
    {
        $page = Page::where('title','=','About')->first();
        $blogs = $page->aboutContent;
        $newsletter = $page->newsletter;
        $sdh= $this->sdh->getData();
        return view('adminpages.about',compact('blogs','sdh','newsletter'));
    }

}