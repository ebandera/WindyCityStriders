<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CarouselItem extends Model {

	//
    protected $fillable = ['reference_name', 'image_url', 'caption','sort_order'];
}
