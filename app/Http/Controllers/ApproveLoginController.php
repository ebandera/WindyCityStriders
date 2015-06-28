<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ApproveLoginController extends Controller {

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $unapprovedUsers = User::where('approved','=','0')->get();
        $sdh= $this->sdh->getData();
        return view('adminpages.approvelogin',compact('sdh','unapprovedUsers'));
    }



}
