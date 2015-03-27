<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

	//
    public function blog()
    {
        return $this->hasMany('App\Blog');
    }


}
