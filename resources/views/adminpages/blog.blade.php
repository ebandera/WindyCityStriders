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

                            <div class="adminBloagImage">
                                <img id="adminBlogImageId" src="" />
                            </div>



                        </div>
                        <form id="blogUploadForm" method="POST" ENCTYPE="multipart/form-data" action="../uploadBlogItem">
                        <div class="one-third last">

                                <h3>Add Image (optional)</h3>
                                <input type="file" id="fileUpload2" name="fileUpload2" class="adminFile"/>
                                <input type="submit" class="adminMyButton1"  value="Post Blog" />

                                <input type="button" id="adminHomeCarouselDeleteItem" onclick="CancelBlogEntry()" class="adminMyButton1" value = "Cancel" />
                                <input type="hidden" name="_token" value = "{{ csrf_token() }}" />



                        </div>
                        <div class="one">

                            <h3>New Blog</h3>
                            <input type="text" id="adminBlogHeadingId" name="adminBlogHeading" class="" />
                            <textarea id="adminBlogEntry" name="adminBlogEntry" rows="1" class="myBlogEntry"></textarea>


                        </div>
                        </form>
                    </div>
                </div>
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
                                    <form>
                                        <input class="adminMyButton4" type="button" onclick="StartCommentEntry({{$blog->id}})" value="Add Comment" />
                                        <input class="adminMyButton4" type="button" onclick="DeleteComment({{$blog->id}})"value="Delete Blog" />
                                        <input class="adminMyButton4" type="button" onclick="MoveBlogUp({{$blog->id}})" value="Move Up" />
                                        <input class="adminMyButton4" type="button" onclick="PromoteToHomePage({{$blog->id}})" value="Send To Homepage" />
                                    </form>
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
    <script>
        $('#fileUpload2').change(function(){
            alert('hello');
         var tmppath = URL.createObjectURL(event.target.files[0]);
          $('#adminBlogImageId').attr('src',tmppath);

        });
    </script>

@endsection