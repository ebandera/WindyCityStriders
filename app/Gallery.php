<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model {

	//
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
    public function galleryItems()
    {
        return $this->hasMany('App\GalleryItem');
    }

}
