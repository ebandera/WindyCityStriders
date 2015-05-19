<?php
/**
 * Created by PhpStorm.
 * User: ericbandera
 * Date: 5/2/15
 * Time: 11:37 AM
 */

namespace App;
use Auth;




class ScreenDataHelper {


    public $footerBlogs,$theUser,$theAddress;

    function __construct()
    {

    }
    function getData()
    {
        $this->footerBlogs=Blog::all()->take(3);
        $this->getUser();
        $this->getAddress();
        return $this;
    }
    function getCarouselImages()
    {
        return CarouselItem::all();
    }

    private function getUser()
    {
        if(Auth::user()!=null)
        {
            $this->theUser=Auth::user();

        }
        //var_dump(Auth::user());exit();
        //var_dump($this->theUser);exit();


    }
    private function getAddress()
    {
        $page_id = Page::where('title','Contact')->first()->id;
        $this->theAddress=Blog::where('page_id',$page_id)->first()->html_text;
    }


}