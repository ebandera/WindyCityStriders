@extends('pages.app')

@section('content')
    <div id="wrapper">



        <!-- START BLOG -->

        <div class="content-wrapper clear">

            <div class="section-title">

                <h1 class="title">Blog <span>We dont just run! We also BLOG about it!</span></h1>

            </div><!--END SECTION TITLE-->

            <div id="inner-content" class="blog1">
                @foreach($blogs as $blog)
                <div class="post">

                    <div class="post-info">
                        <div class="date"><span class="month">{{ date_format($blog->created_at,'F') }} </span><span class="day">{{date_format($blog->created_at,'d')}} </span><span class="month">{{date_format($blog->created_at,'Y')}}&nbsp;{{$blog->created_at->diffForHumans()}}</span></div>
                        <div class="comments"><a href="#"><span>{{ $blog->blog_child->count() }}</span> comments</a>
                        </div><!--END POST-INFO-->

                        <div class="post-content">

                            <div class="post-media">
                                <a href="#"><img src=" {{ $blog->image_url }}" alt="" width="600" /></a>
                            </div><!--END POST-MEDIA-->

                            <div class="post-title">
                                <h2 class="title"><a href="">{{ $blog->heading }}</a></h2>
                            </div><!--END POST-TITLE-->

                            <div class="post-meta">
                                <ul>
                                    <li><span>Posted by</span> <a href="#">{{ $blog->user->name}}</a></li>

                                </ul>
                            </div><!--END POST-META-->

                            <p>{{ $blog->html_text }} </p>
                            <p><a href="/blog/{{ $blog->id }}" class="more-link">View This Blog Only</a></p>

                        </div><!--END POST-CONTENT -->

                    </div><!--END POST-->
                    @foreach($blog->blog_child as $reply)
                    <div class="postIndent">

                        <div class="post-info">
                            <div class="date"><span class="month">{{ date_format($reply->created_at,'F') }} </span><span class="day">{{date_format($reply->created_at,'d')}} </span><span class="month">{{date_format($blog->created_at,'Y')}} (reply)&nbsp;{{$reply->created_at->diffForHumans()}}</span></div>


                            <div class="post-content">



                                <div class="post-meta">
                                    <ul>
                                        <li><span>Posted by</span> <a class="black" href="#">{{ $reply->user->name}}</a></li>

                                    </ul>
                                </div><!--END POST-META-->

                                <p>{{ $reply->html_text }} </p>
                                <p></p>

                            </div><!--END POST-CONTENT -->

                        </div><!--END POST-INFO-->
                    </div><!--END POST

                    @endforeach
                </div>
                @endforeach

            </div><!--END INNER CONTENT>



        </div><!--END CONTENT-WRAPPER-->



    </div><!--END WRAPPER-->

@endsection