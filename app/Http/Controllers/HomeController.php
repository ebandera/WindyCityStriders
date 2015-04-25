<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Blog;
use App\Page;

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
		$this->middleware('guest');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{

		$footerBlogs = Blog::all()->take(3);
		//var_dump($footerBlogs);
		return view('pages.home',compact('footerBlogs'));
	}
    public function admin()
    {

        $footerBlogs = Blog::all()->take(3);
        //var_dump($footerBlogs);
        return view('adminpages.home',compact('footerBlogs'));
    }

}
