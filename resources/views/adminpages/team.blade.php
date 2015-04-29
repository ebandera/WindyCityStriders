@extends('pages.app')

@section('content')

    <div id="wrapper">

        <!-- START ABOUT -->

        <div class="content-wrapper clear">
            <div class="myareacontainer" >
                <div class="section-title">

                    <h1 class="title">BOARD MEMBERS <span>all here to promote the sport of running</span></h1>

                    <div class="divider-border"></div>
                    <div class="clear"></div>

                    <!--	<h3 class="title">Meet the team</h3>-->

                    @if(count($board)>2)

                            <div class="one-half team">
                                <img src="{{ $board[0]->image_url }}" alt="" />
                                <div class="arrow"></div>
                                <div class="team-member-info">
                                    <ul>
                                        <li><h2>{{ $board[0]->name }}</h2></li>
                                        <li><h3>{{ $board[0]->position }}</h3></li>
                                    </ul>
                                    <p>{{ $board[0]->description }}</p>
                                    <ul class="social-personal">
                                        <li><a href="{{ $board[0]->twitter_link }}">Twitter</a><span>/</span></li>
                                        <li><a href="{{ $board[0]->facebook_link }}">Facebook</a></li>
                                    </ul>
                                </div><!--END TEAM-MEMBER-INFO-->
                            </div><!--END ONE-THIRD-->

                            <div class="one-half team last">
                                <img src="{{ $board[1]->image_url }}" alt="" />
                                <div class="arrow"></div>
                                <div class="team-member-info">
                                    <ul>
                                        <li><h2>{{ $board[1]->name }}</h2></li>
                                        <li><h3>{{ $board[1]->position }}</h3></li>
                                    </ul>
                                    <p>{{ $board[1]->description }}</p>
                                    <ul class="social-personal">
                                        <li><a href="{{ $board[1]->twitter_link }}">Twitter</a><span>/</span></li>
                                        <li><a href="{{ $board[1]->facebook_link }}">Facebook</a></li>
                                    </ul>
                                </div><!--END TEAM-MEMBER-INFO-->
                            </div><!--END ONE-THIRD LAST-->


                    @endif
                    @if(count($board)>2)
                        @for($i=2;$i<count($board);$i++)
                            @if($i%3==1)
                                <div class="one-third team last">
                                    <img src="{{ $board[$i]->image_url }}" alt="" />
                                    <div class="arrow"></div>
                                    <div class="team-member-info">
                                        <ul>
                                            <li><h2>{{ $board[$i]->name }}</h2></li>
                                            <li><h3>{{ $board[$i]->position }}</h3></li>
                                        </ul>
                                        <p>{{ $board[$i]->description }}</p>
                                        <ul class="social-personal">
                                            <li><a href="{{ $board[$i]->twitter_link }}">Twitter</a><span>/</span></li>
                                            <li><a href="{{ $board[$i]->facebook_link }}">Facebook</a></li>
                                        </ul>
                                    </div><!--END TEAM-MEMBER-INFO-->
                                </div><!--END ONE-THIRD LAST-->
                            @else
                                <div class="one-third team">
                                    <img src="{{ $board[$i]->image_url }}" alt="" />
                                    <div class="arrow"></div>
                                    <div class="team-member-info">
                                        <ul>
                                            <li><h2>{{ $board[$i]->name }}</h2></li>
                                            <li><h3>{{ $board[$i]->position }}</h3></li>
                                        </ul>
                                        <p>{{ $board[$i]->description }}</p>
                                        <ul class="social-personal">
                                            <li><a href="{{ $board[$i]->twitter_link }}">Twitter</a><span>/</span></li>
                                            <li><a href="{{ $board[$i]->facebook_link }}">Facebook</a></li>
                                        </ul>
                                    </div><!--END TEAM-MEMBER-INFO-->
                                </div><!--END ONE-THIRD LAST-->
                            @endif

                        @endfor

                    @endif
                </div>

            </div><!--END MYAREACONTAINER-->

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
                                <textarea id="adminCorouselTextarea" rows="1" class="mycarouseladmincaption"></textarea>
                            </div>
                            <div class="one-third last" >
                                <form>
                                    <input type="button" class="adminMyButton1" value = "Save Edits" />
                                    <input type="button" class="adminMyButton1" value = "Delete Item" />
                                </form>
                            </div>
                        </div>


                    </div>
                    <div class="one-third last adminHomeCarouselControls">
                        <form>
                            <h3>Uploaded Carousel Images</h3>
                            <select id="adminCarouselListbox" class="adminSelectListbox" size="5">
                                <option data-image="/img/slideshow.png" data-caption="This is a place for a brief description." value="1">Item one</option>
                                <option data-image="/img/runningSlideShow.jpg" data-caption="It can be anysize or backround" value="2">Item two</option>
                                <option data-image="/img/runningSlideShow2.jpg" data-caption="or nothing at all" value="3">Item three</option>
                            </select>
                            <hr>
                            <h3>Add New</h3>
                            <input type="file" class="adminFile"/>
                            <input type="button" class="adminMyButton2" value="upload File" />
                        </form>
                    </div>
                </div>
            <!-- END ABOUT -->

        </div><!--END CONTENTWRAPPER-->
    </div> <!--END WRAPPER
@endsection