@extends('pages.app')

@section('content')

    <div id="wrapper">

        <!-- START ABOUT -->

        <div class="content-wrapper clear">
            <div class="myareacontainer" >
                <div class="section-title">

                    <h1 class="title">CWCS <span>all here to promote the sport of running</span></h1>

                </div><!--END SECTION TITLE-->

                @foreach($blogs as $index=>$blog)
                    @if ($index+1==count($blogs))
                        <div class="one-third last">
                            <h3 class="title">{{ $blog->heading }} test</h3>
                            <p>{{ $blog->html_text }}</p>
                        </div><!--END ONE-THIRD-->
                    @else
                        <div class="one-third">
                            <h3 class="title">{{ $blog->heading }} test</h3>
                            <p>{{ $blog->html_text }}</p>
                        </div><!--END ONE-THIRD-->
                    @endif



                @endforeach

            </div> <!--END MYAREACONTAINER-->
            <hr>
            <h1 align="center" class="title">Modify About Content</h1>
                <div class="myareacontainer" >
                    <div class="content-wrapper clear">
                        <div class="two-third">

                            <div class="adminHomeCarouselImage">
                                <form>
                                    <h3>Heading:</h3>
                                    <input type="text" class="title" />
                                    <h3>Content</h3>
                                    <textarea class="adminAboutTextarea" size="10"></textarea>
                                </form>

                            </div>



                        </div>
                        <div class="one-third last adminHomeCarouselControls">
                            <form>
                                <h3>Content Items</h3>
                                <select id="adminCarouselListbox" class="adminSelectListbox" size="3">
                                    <option data-image="/img/slideshow.png" data-caption="This is a place for a brief description." value="1">Item one</option>
                                    <option data-image="/img/runningSlideShow.jpg" data-caption="It can be anysize or backround" value="2">Item two</option>
                                    <option data-image="/img/runningSlideShow2.jpg" data-caption="or nothing at all" value="3">Item three</option>
                                </select>
                                <input type="button" class="adminMyButton1" value = "Save Edits" />
                                <hr>

                            </form>
                        </div>
                    </div>

        </div><!--END CONTENT-WRAPPER-->

        <!-- END ABOUT -->

    </div><!--END WRAPPER-->

@endsection