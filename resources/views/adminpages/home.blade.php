@extends('pages.app')

@section('content')
	<div id="wrapper">

		<!-- START HOME -->
        <div class="content-wrapper clear">
            <div class="myareacontainer" >


			    <div class="section-title text-align-center">

				    <h1 class="title">WINDY CITY STRIDERS</h1>
				    <h3 class="title">CASPERS RUNNING CLUB IN THE HEART OF WYOMING</h3>

			    </div><!--END SECTION TITLE-->


			    <div class="slideshow-container">

				    <div class="flexslider" id="index-slider">
					    <ul class="slides">
                            @foreach ($carouselItems as $carouselItem)
						    <li id="carouselLineItem{{$carouselItem->id}}" >
							    <a href="#"><img src="{{ $carouselItem->image_url }}" alt="" /></a>
							    <p class="flex-caption" id="carouselCaption{{ $carouselItem->id }}">{{ $carouselItem->caption }}</p>
						    </li>
                            @endforeach

					    </ul><!--END UL SLIDES-->

				    </div><!--END FLEXSLIDER-->

			    </div><!--END SLIDESHOW-CONTAINER-->
            </div> <!-- END MYAREACONTAINER-->
            <h3 align="center"class="title">Modify Carousel</h3>
            <div class="myareacontainer" >
                <div class="content-wrapper clear">
                    <div class="two-third">

                        <div class="adminHomeCarouselImage">
                            <img id="adminCarouselImage" src="/img/slideshow.png" />
                        </div>
                        <div class="adminHomeCarouselCaption">
                            <h3>caption</h3>
                            <div class="two-third last" >
                                <textarea id="adminCarouselTextarea" rows="1" class="mycarouseladmincaption"></textarea>
                            </div>
                            <div class="one-third last" >
                                <form>
                                    <input type="button" id="adminHomeCarouselSaveEdits" onclick="SaveCarouselEdits()" class="adminMyButton1" value = "Save Edits" />
                                    <input type="button" id="adminHomeCarouselDeleteItem" onclick="DeleteCarouselItem()" class="adminMyButton1" value = "Delete Item" />

                                </form>
                            </div>
                        </div>


                    </div>
                    <div class="one-third last adminHomeCarouselControls">
                        <form id="carouselUploadForm" method="POST" ENCTYPE="multipart/form-data" action="../uploadCarouselItem">
                            <h3>Uploaded Carousel Images</h3>
                            <select id="adminCarouselListbox" class="adminSelectListShort" size="5">
                                @foreach ($carouselItems as $carouselItem)
                                    <option data-image="{{$carouselItem->image_url}}" data-caption="{{$carouselItem->caption}}" value="{{$carouselItem->id}}">{{$carouselItem->reference_name}}</option>

                                @endforeach

                            </select>
                            <hr>
                            <h3>Add New</h3>
                            <input type="file" id='fileUpload1' name="fileUpload1" class="adminFile"/>
                            <input type="submit" class="adminMyButton2"  value="upload File"  />
                            <input type="hidden" name="_token" value = "{{ csrf_token() }}" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="myareacontainer" >


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
                                    <input class="adminMyButton4" type="button" onclick="RemoveFromHomePage({{$blog->id}})" value="Remove From Homepage" />
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
                    </div>
            </div> <!-- END MYAREACONTAINER-->
            <br>



            <div class="myareacontainer">
                <div class="content-wrapper clear">
                <ul class="grid one-third services">
                    <li>
                        <a href="/calendar">
                        <div>
                            <h2>Calendar</h2>
                            <img src="img/events.png" alt="" />
                            <p>This will be the calendar link with image</p>
                        </div>
                        </a>
                    </li>
                </ul>
                <ul class="grid one-third services">
                    <li>
                        <a href="/results">
                        <div>
                            <h2>Results</h2>
                            <img src="img/results.jpeg" alt="" />
                            <p>This will be the results link with image</p>
                        </div>
                        </a>
                    </li>
                </ul>
                <ul class="grid one-third services">
                    <li>
                        <div>
                            <h2>Sponsors</h2>
                            <img src="img/sponsors1.png" alt="" />
                            <p>This will be the sponsors link with image</p>
                        </div>
                    </li>
                </ul><!--END GRID SERVICES-->
                </div>
            </div><!--End myareacontainer -->
        </div><!-- END CONTENT-WRAPPER -->

		<div class="divider-border"></div>





		<!-- END HOME -->

	</div><!-- END WRAPPER -->
@endsection
