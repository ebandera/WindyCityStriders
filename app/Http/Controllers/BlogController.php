<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Blog;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BlogController extends Controller {

	//

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        // return "gallery Item";

        //$blogs = Blog::all();

        $blogs = Page::where('title','=','Blog')->first()->blog->where('blog_level','primary');
        //$userName = Blog::find(2)->user->first_name;
        //echo $userName;exit();

        $sdh= $this->sdh->getData();
        return view('pages.blog',compact('blogs','sdh'));
        //

    }
    public function member()
    {
        // return "gallery Item";

        //$blogs = Blog::all();

        $blogs = Page::where('title','=','Blog')->first()->blog->where('blog_level','primary');
        //$userName = Blog::find(2)->user->first_name;
        //echo $userName;exit();

        $sdh= $this->sdh->getData();
        return view('adminpages.memberblog',compact('blogs','sdh'));
        //

    }
    public function admin()
    {
        // return "gallery Item";

        //$blogs = Blog::all();

        $blogs = Page::where('title','=','Blog')->first()->blog->where('blog_level','primary');
        //$userName = Blog::find(2)->user->first_name;
        //echo $userName;exit();

        $sdh= $this->sdh->getData();
        return view('adminpages.blog',compact('blogs','sdh'));
        //

    }
    public function show($id)
    {


        $blog = Blog::find($id);//this will return the actual object, but the view is expecting a collection

        $blogs=new Collection();
        $blogs[] = $blog;

        $sdh= $this->sdh->getData();
        return view('pages.blog',compact('blogs','s'));
        //

    }


}
