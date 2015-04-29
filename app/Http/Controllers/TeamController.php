<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BoardMember;
use App\Blog;
use Illuminate\Http\Request;
class TeamController extends Controller {



    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $year = date('Y');
        //echo $year;exit();
        $board = BoardMember::where('year','=',$year)->get();
        //var_dump($board);
        $footerBlogs = Blog::all()->take(3);
        return view('pages.team',compact('board','footerBlogs'));
    }

    public function admin()
    {
        $year = date('Y');
        //echo $year;exit();
        $board = BoardMember::where('year','=',$year)->get();
        //var_dump($board);
        $footerBlogs = Blog::all()->take(3);
        return view('adminpages.team',compact('board','footerBlogs'));
    }
}