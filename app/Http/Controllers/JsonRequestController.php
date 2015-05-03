<?php namespace App\Http\Controllers;




use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CarouselItem;
use App\Blog;
use App\Page;
use Auth;
use Carbon\Carbon;

use Request;


class JsonRequestController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    function __construct()
    {

    }
	public function updateCarousel()
	{
       $input= Request::all();
        $itemId=$input['itemId'];
        $caption=$input['caption'];

        $updatedItem=CarouselItem::find($itemId);
        $updatedItem->caption=$caption;
        $success= $updatedItem->save();

        if($success) {
            return $caption;
        }
        else
        {
            return 'false';
        }
	}

    public function updateAbout()
    {
        $input= Request::all();
        $itemId=$input['itemId'];
        $heading=$input['heading'];
        $html_text=$input['html_text'];
        $updatedItem=Blog::find($itemId);
        $updatedItem->heading=$heading;
        $updatedItem->html_text=$html_text;
        $success=$updatedItem->save();
        if($success) {
            return json_encode(array('heading'=>$heading,'html_text'=>$html_text));
        }
        else
        {
            return 'false';
        }

    }
    public function insertBlog()
    {
        $input= Request::all();

        $heading=$input['heading'];
        $html_text=$input['html_text'];
        $image_url=$input['image_url'];
        $insertItem= new Blog;
        $insertItem->heading=$heading;
        $insertItem->html_text=$html_text;
        $insertItem->image_url=$image_url;
        $insertItem->page_id = Page::where('title','=','Blog')->first()->id;
        $insertItem->user_id=Auth::user()->id;
        $insertItem->blog_level='primary';
        $insertItem->image_position='top';
        $carbon = new Carbon();
        $insertItem->expiration_date=$carbon->now()->addYears(1);
        $insertItem->sort_order= Blog::where('page_id','=',$insertItem->page_id)->max('sort_order') + 1;
        $success=$insertItem->save();


        if($success) {
            return json_encode(array('heading'=>$heading,'html_text'=>$html_text,'image_url'));
        }
        else
        {
            return 'false';
        }

    }

    public function insertComment()
    {
        $input= Request::all();

        $heading='';
        $html_text=$input['html_text'];
        $image_url='';
        $insertItem= new Blog;
        $insertItem->heading=$heading;
        $insertItem->html_text=$html_text;
        $insertItem->image_url=$image_url;
        $insertItem->page_id = Page::where('title','=','Blog')->first()->id;
        $insertItem->user_id=Auth::user()->id;
        $insertItem->blog_level='reply';
        $insertItem->blog_id=$input['blog_id'];
        $insertItem->image_position='top';
        $carbon = new Carbon();
        $insertItem->expiration_date=$carbon->now()->addYears(1);
        $insertItem->sort_order= Blog::where('page_id','=',$insertItem->page_id)->max('sort_order') + 1;
        $success=$insertItem->save();


        if($success) {
            return json_encode(array('heading'=>$heading,'html_text'=>$html_text,'image_url'));
        }
        else
        {
            return 'false';
        }

    }
    public function deleteComment()
    {
        $input= Request::all();
        $id = $input['id'];
        $theReplyToBeDeleted = Blog::find($id);
        $success=$theReplyToBeDeleted->delete();



        if($success) {
            return 'true';
        }
        else
        {
            return 'false';
        }

    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
