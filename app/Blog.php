<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class Blog extends Model {

	//
    public function user() {

        return $this->belongsTo('App\User');


    }
    public function page() {
        return $this->belongsTo('App\Page');
    }
    public function blog()
    {
        return $this->belongsTo('App\Blog');
    }
    public function blog_child()
    {
        return $this->hasMany('App\Blog');
    }


}
