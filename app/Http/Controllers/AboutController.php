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
        $sdh= $this->sdh->getData();
        $blogs = Page::where('title','=','About')->first()->blog;

        return view('pages.about',compact('blogs','sdh'));
    }
    public function admin()
    {
        $blogs = Page::where('title','=','About')->first()->blog;
        $sdh= $this->sdh->getData();
        return view('adminpages.about',compact('blogs','sdh'));
    }

}