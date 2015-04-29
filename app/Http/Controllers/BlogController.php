<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Blog;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BlogController extends Controller {

	//
    public function index()
    {
        // return "gallery Item";

        //$blogs = Blog::all();

        $blogs = Page::where('title','=','Blog')->first()->blog->where('blog_level','primary');
        //$userName = Blog::find(2)->user->first_name;
        //echo $userName;exit();

        $footerBlogs = Blog::all()->take(3);
        return view('pages.blog',compact('blogs','footerBlogs'));
        //

    }
    public function member()
    {
        // return "gallery Item";

        //$blogs = Blog::all();

        $blogs = Page::where('title','=','Blog')->first()->blog;
        //$userName = Blog::find(2)->user->first_name;
        //echo $userName;exit();

        $footerBlogs = Blog::all()->take(3);
        return view('adminpages.memberblog',compact('blogs','footerBlogs'));
        //

    }
    public function admin()
    {
        // return "gallery Item";

        //$blogs = Blog::all();

        $blogs = Page::where('title','=','Blog')->first()->blog;
        //$userName = Blog::find(2)->user->first_name;
        //echo $userName;exit();

        $footerBlogs = Blog::all()->take(3);
        return view('adminpages.blog',compact('blogs','footerBlogs'));
        //

    }
    public function show($id)
    {
        // return "gallery Item";

        //$blogs = Blog::all();
        echo $id;

        $blog = Blog::find($id);//this will return the actual object, but the view is expecting a collection

        $blogs=new Collection();
        $blogs[] = $blog;

        $footerBlogs = Blog::all()->take(3);
        return view('pages.blog',compact('blogs','footerBlogs'));
        //

    }


}
