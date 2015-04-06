<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BoardMember;

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
        return view('pages.team',compact('board'));
    }

}