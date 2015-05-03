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
						    <li>
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
                            <textarea id="adminCorouselTextarea" rows="1" class="mycarouseladmincaption"></textarea>
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
                    <form>
                        <h3>Uploaded Carousel Images</h3>
                        <select id="adminCarouselListbox" class="adminSelectListbox" size="5">
                            @foreach ($carouselItems as $carouselItem)
                                <option data-image="{{$carouselItem->image_url}}" data-caption="{{$carouselItem->caption}}" value="{{$carouselItem->id}}">{{$carouselItem->reference_name}}</option>

                            @endforeach

                        </select>
                        <hr>
                        <h3>Add New</h3>
                        <input type="file" class="adminFile"/>
                        <input type="button" class="adminMyButton2" value="upload File" />
                    </form>
                </div>
            </div>
        </div>

        <div class="myareacontainer">
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
        </div><!-- END CONTENT-WRAPPER -->

		<div class="divider-border"></div>





		<!-- END HOME -->

	</div><!-- END WRAPPER -->
@endsection
