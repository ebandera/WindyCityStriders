<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SystemSetting;

use Illuminate\Http\Request;

class SystemSettingsController extends Controller {

	//
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $sdh= $this->sdh->getData();
        $settings = SystemSetting::all();

        return view('adminpages.systemsettings',compact('sdh','settings'));

    }

}
