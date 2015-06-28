<?php namespace App\Http\Middleware;

use Closure;

class HandleRoles {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

        $requestedPage = $request->segment(1);
        $secondSegment = $request->segment(2);
       // var_dump($test);exit();
        $isBasePage = $this->isValidBasePageRequest($requestedPage);
        //this will handle the redirecting
        //if the user is authenticated and they are seeing a base page (that everyone can see)
        if($request->user()!=null&&$isBasePage) {
            //the prefix will determine the route if it is an authenticated user
            $prefix=$this->buildRoutePrefix($requestedPage,$request->user()->user_profile);
            if ($prefix=='') return $next($request);  //ignore redirect and authentication if they're going to public page anyways
            //this is to handle for specific blog entry views (with id)
            if ($requestedPage=='blog'&&$secondSegment!=null) return $next($request);
            //dd($prefix);
            if($prefix=='admin'&& $secondSegment!=null&&$requestedPage=='calendar')
            {

                $theFullUrl= $request->Url();
                $theNewUrl = str_replace('calendar','admincalendar',$theFullUrl);
                //dd($theFullUrl . ' ' . $theNewUrl);
                return redirect( $theNewUrl);
            }
            if($prefix=='admin'&& $secondSegment!=null&&$requestedPage=='gallery')
            {

                $theFullUrl= $request->Url();
                $theNewUrl = str_replace('gallery','admingallery',$theFullUrl);
                //dd($theFullUrl . ' ' . $theNewUrl);
                return redirect( $theNewUrl);
            }
           // dd('hello');
            return redirect( $prefix . $requestedPage);

        }
       // dd('hello1');
        //this will handle the roles based authentication
        if($isBasePage) return $next($request);  //base page, pass!
        if($request->user()!=null)  //not base page, but user is logged in, see if they have access
        {
            if($this->doesUserHaveAccess($requestedPage,$request->user()->user_profile))
            {
                return $next($request);
            }
            else
            {
                return redirect('home');
            }
        }
        return redirect('home');
	}
    private function buildRoutePrefix($page,$role) //this builds the prefix to the base page to redirect admins to adminpages etc
    {
        $prefix='';
        if($role=='member')
        {
            switch($page)
            {
                case 'blog':  //right now members are being treated like unauthenticated users except in the blog page
                    $prefix='member';
                    break;
                default:
                    $prefix='';
                    break;
            }

        }
        else if($role=='admin')
        {
            switch($page)
            {
                //if there are any pages that the admin sees the same as an unauthenticated user, a switch should be added
                default:
                    $prefix='admin';
                    break;
            }

        }
        return $prefix;

    }
    private function isValidBasePageRequest($page)
    {
        $valid=false;
        switch($page)
        {
            case 'home':
                $valid=true;
                break;
            case 'about':
                $valid=true;
                break;
            case 'team':
                $valid=true;
                break;
            case 'join':
                $valid=true;
                break;
            case 'gallery':
                $valid=true;
                break;
            case 'gallerymain':
                $valid=true;
                break;
            case 'blog':
                $valid=true;
                break;
            case 'contact':
                $valid=true;
                break;
            case 'calendar':
                $valid=true;
                break;
            case 'sponsors';
                $valid=true;
                break;
           default:
                $valid=false;
                break;
        }
        return $valid;
    }

    private function doesUserHaveAccess($page,$role)
    {
        $hasAccess=false;
        if($role=='admin') $hasAccess=true;
        if($role=='member')
        {
            switch($page)
            {
                case 'memberblog':  //right now, memberblog is the only elevated access page members have
                    $hasAccess=true;
                    break;

                default:
                    $hasAccess=false;
                    break;
            }

        }
        return $hasAccess;
    }



}
