<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Blog extends Model {

	//
    use SoftDeletes;
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
