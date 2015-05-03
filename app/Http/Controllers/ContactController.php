<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Blog;

use Illuminate\Http\Request;
class ContactController extends Controller {

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
        return view('pages.contact',compact('sdh'));
    }

    public function admin()
    {
        $sdh= $this->sdh->getData();
        return view('adminpages.contact',compact('sdh'));
    }

    public function sendMessage()
    {
        return 'sending Message';
    }

}