<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Blog;

class Page extends Model {

	//
    public function blog()
    {
        return $this->hasMany('App\Blog');
    }

    public function initializeAllCommonContent()
    {
        $footerBlogs = Blog::all()->take(3);

        return $footerBlogs;
    }


}
