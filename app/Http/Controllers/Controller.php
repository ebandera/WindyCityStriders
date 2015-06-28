<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\ScreenDataHelper;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    protected $sdh;
    function __construct()
    {
        $this->middleware('verifyApprovedUsers');
        $this->middleware('roleHandle');
        $this->sdh= new ScreenDataHelper();

    }
}
