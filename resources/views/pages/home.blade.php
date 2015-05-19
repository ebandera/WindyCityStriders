@extends('pages.app')

@section('content')
	<div id="wrapper">

		<!-- START HOME -->

		<div class="content-wrapper clear">

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


			<div class="divider-border"></div>



		</div><!-- END CONTENT-WRAPPER -->

		<!-- END HOME -->

	</div><!-- END WRAPPER -->
@endsection
