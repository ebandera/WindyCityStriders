@extends('pages.app')

@section('content')
    <div id="wrapper">

        <div id="wrapper">

            <!-- START BLOG -->

            <div class="content-wrapper clear">

                <div class="section-title">

                    <h1 class="title">Admin Blog <span>We dont just run! We also BLOG about it!</span></h1>
                    <form>
                        <input type="button" class="adminMyButton1" onclick="StartBlogEntry()" value="Add Post" />
                    </form>
                </div><!--END SECTION TITLE-->
                <div class="myareacontainer" id="newBlogDiv">
                    <div class="content-wrapper clear">
                        <div class="two-third">

                            <div class="adminBlogImage">
                                <img id="adminBlogImageId" src="/img/runningSlideShow2.jpg" />
                            </div>



                        </div>
                        <div class="one-third last">
                            <form>
                                <h3>Add Image (optional)</h3>
                                <input type="file" class="adminFile"/>
                                <input type="button" class="adminMyButton1" value="upload File" />
                                <input type="button" id="adminHomeCarouselSaveEdits" onclick="PostBlogEntry()" class="adminMyButton1" value = "Post Blog" />
                                <input type="button" id="adminHomeCarouselDeleteItem" onclick="CancelBlogEntry()" class="adminMyButton1" value = "Cancel" />


                            </form>
                        </div>
                        <div class="one">

                            <h3>New Blog</h3>
                            <input type="text" id="adminBlogHeadingId" class="" />
                            <textarea id="adminBlogEntry" rows="1" class="myBlogEntry"></textarea>


                        </div>
                    </div>
                </div>
                <div id="inner-content" class="blog1">
                    @foreach($blogs as $blog)
                        <div class="post">

                            <div class="post-info">
                                <div class="date"><span class="month">{{ date_format($blog->created_at,'F') }} </span><span class="day">{{date_format($blog->created_at,'d')}} </span><span class="month">{{date_format($blog->created_at,'Y')}}</span></div>
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
                                    <form>
                                        <input class="adminMyButton3" type="button" onclick="StartCommentEntry({{$blog->id}})" value="Add Comment" />
                                        <input class="adminMyButton3" type="button" value="Delete Blog" />
                                        <input class="adminMyButton3" type="button" value="Move Up" />
                                    </form>
                                    <p><a href="/blog/{{ $blog->id }}" class="more-link">View This Blog Only</a></p>

                                </div><!--END POST-CONTENT -->

                            </div><!--END POST-->
                            @foreach($blog->blog_child as $reply)
                                <div class="postIndent">

                                    <div class="post-info">
                                        <div class="date"><span class="month">{{ date_format($reply->created_at,'F') }} </span><span class="day">{{date_format($reply->created_at,'d')}} </span><span class="month">{{date_format($blog->created_at,'Y')}} (reply)</span></div>


                                        <div class="post-content">



                                            <div class="post-meta">
                                                <ul>
                                                    <li><span>Posted by</span> <a class="black" href="#">{{ $reply->user->name}}</a></li>

                                                </ul>
                                            </div><!--END POST-META-->

                                            <p>{{ $reply->html_text }} </p>
                                            <form>
                                                <input class="adminMyButton3" onclick="DeleteComment({{$reply->id}})" type="button" value="Delete Reply" />

                                            </form>
                                            <p></p>

                                        </div><!--END POST-CONTENT -->

                                    </div><!--END POST-INFO-->
                                </div><!--END POST-->


                            @endforeach
                            <div class="postIndent comment" id="newComment{{$blog->id}}">
                                <div>
                                    <h3>New Comment</h3>
                                    <textarea id="adminCommentEntry{{$blog->id}}" rows="1" class="myBlogEntry"></textarea>
                                    <input type="button"  onclick="PostCommentEntry({{$blog->id}})" class="adminMyButton1" value = "Post Comment" />
                                    <input type="button" onclick="CancelCommentEntry({{$blog->id}})" class="adminMyButton1" value = "Cancel" />

                                </div>
                            </div>

                            @endforeach







                                        </div><!--END INNER-CONTENT-->

                        </div><!--END CONTENT-WRAPPER-->

                        <!-- END BLOG -->

                </div><!--END WRAPPER-->

@endsection