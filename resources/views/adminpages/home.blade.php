@extends('pages.app')

@section('content')
	<div id="wrapper">

		<!-- START HOME -->
        <div class="myslideshowcontainer" >
		    <div class="content-wrapper clear">

			    <div class="section-title text-align-center">

				    <h1 class="title">WINDY CITY STRIDERS</h1>
				    <h3 class="title">CASPERS RUNNING CLUB IN THE HEART OF WYOMING</h3>

			    </div><!--END SECTION TITLE-->


			    <div class="slideshow-container">

				    <div class="flexslider" id="index-slider">
					    <ul class="slides">
						    <li>
							    <a href="#"><img src="/img/slideshow.png" alt="" /></a>
							    <p class="flex-caption">This is a place for a brief description.</p>
						    </li>
						    <li>
							    <a href="#"><img src="/img/runningSlideShow.jpg" alt="" /></a>
							    <p class="flex-caption">It can be anysize or backround</p>
						    </li>
						    <li>
							    <a href="#"><img src="/img/runningSlideShow2.jpg" alt="" /></a>
							    <p class="flex-caption">or nothing at all</p>
						    </li>
					    </ul><!--END UL SLIDES-->

				    </div><!--END FLEXSLIDER-->

			    </div><!--END SLIDESHOW-CONTAINER-->
            </div> <!-- END MYSLIDESHOWCONTAINER-->
        </div> <!-- END MYSLIDESHOWCONTAINER-->
       <h1 align="center"class="title">Modify Carousel</h3>
        <div class="myslideshowcontainer" >
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
        </div>

        <div class="myslideshowcontainer">
            <div class="content-wrapper clear">
		    <ul class="grid one-third services">
			    <li>
				    <div>
					    <h2>Calendar</h2>
					    <img src="img/events.png" alt="" />
					    <p>This will be the calendar link with image</p>
                    </div>
			    </li>
		    </ul>
		    <ul class="grid one-third services">
			    <li>
				    <div>
					    <h2>Results</h2>
					    <img src="img/results.jpeg" alt="" />
					    <p>This will be the results link with image</p>
				    </div>
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
        </div>

		<div class="divider-border"></div>



		</div><!-- END CONTENT-WRAPPER -->

		<!-- END HOME -->

	</div><!-- END WRAPPER -->
@endsection
