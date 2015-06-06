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


    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $year = date('Y');
        //echo $year;exit();
        $board = BoardMember::where('year','=',$year)->get();
        $years = BoardMember::retreiveCompleteYearlist($year);
        $selectedYear = $year;
        //var_dump($board);
        $sdh= $this->sdh->getData();
        return view('pages.team',compact('board','sdh','years','selectedYear'));
    }

    public function admin()
    {
        $year = date('Y');
        //echo $year;exit();
        $board = BoardMember::where('year','=',$year)->get();
        $years = BoardMember::retreiveCompleteYearlist($year);
        $selectedYear = $year;
        //var_dump($board);
        $sdh= $this->sdh->getData();
        return view('adminpages.team',compact('board','sdh','years','selectedYear'));
    }
    public function selectYear($selectedYear)
    {
        $year = date('Y');
        //echo $year;exit();
        $board = BoardMember::where('year','=',$selectedYear)->get();
        $years = BoardMember::retreiveCompleteYearlist($year);

        //var_dump($board);
        $sdh= $this->sdh->getData();
        return view('pages.team',compact('board','sdh','years','selectedYear'));
    }

    public function adminSelectYear($selectedYear)
    {
        $year = date('Y');
        //echo $year;exit();
        $board = BoardMember::where('year','=',$selectedYear)->get();
        $years = BoardMember::retreiveCompleteYearlist($year);

        //var_dump($board);
        $sdh= $this->sdh->getData();
        return view('adminpages.team',compact('board','sdh','years','selectedYear'));
    }
}