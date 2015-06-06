<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Blog;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class HomeController extends Controller {


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
		$carouselItems = $this->sdh->getCarouselImages();
       // var_dump($carouselItems);exit();
		//return view('pages.home',compact('sdh','carouselItems'));
        $blogs = Page::where('title','=','Home')->first()->blog->where('blog_level','primary');
        //var_dump($footerBlogs);
        return view('pages.home',compact('sdh', 'carouselItems','blogs'));
	}
    public function admin()
    {

        $sdh= $this->sdh->getData();
        $carouselItems = $this->sdh->getCarouselImages();
        $blogs = Page::where('title','=','Home')->first()->blog->where('blog_level','primary');
        //var_dump($footerBlogs);
        return view('adminpages.home',compact('sdh', 'carouselItems','blogs'));
    }

}
