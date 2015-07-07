<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Blog;
use App\Page;


class JoinController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */

    public function index()
    {
        $sdh= $this->sdh->getData();
        $page = Page::where('title','=','Join')->first();
        $joinForm = $page->joinForm;
        $joinText = $page->joinText;

        //get header blog (page content)
       // dd($headerBlog);

        //get blogs (1 blog for the image download etc

        return view('pages.join',compact('sdh','joinForm','joinText'));
    }
    public function admin()
    {

        $sdh= $this->sdh->getData();
        $page = Page::where('title','=','Join')->first();
        $joinForm = $page->joinForm;
        $joinText = $page->joinText;
        //get header blog (page content)
        // dd($headerBlog);

        //get blogs (1 blog for the image download etc

        return view('adminpages.join',compact('sdh','joinForm','joinText'));
    }

}