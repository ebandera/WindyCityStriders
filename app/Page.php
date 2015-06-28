<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Blog;

class Page extends Model {

	//
    public function blog()
    {
        return $this->hasMany('App\Blog')->orderBy('sort_order','desc');
    }

   //
    public function aboutContent()
    {
        return $this->hasMany('App\Blog')->where('heading','<>','newsletter');
    }
    public function newsletter()
    {
        return $this->hasMany('App\Blog')->where('heading','=','newsletter');
    }
    public function sponsors()
    {
        return $this->hasMany('App\Blog')->where('heading','<>','sponsors')->orderBy('sort_order','desc');
    }
    public function sponsorHeading()
    {
        return $this->hasOne('App\Blog')->where('heading','=','sponsors');
    }




}
