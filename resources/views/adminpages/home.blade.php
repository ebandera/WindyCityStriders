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
						<li>
							<a href="#"><img src="img/slideshow.png" alt="" /></a>
							<p class="flex-caption">This is a place for a brief description.</p>
						</li>
						<li>
							<a href="#"><img src="img/runningSlideShow.jpg" alt="" /></a>
							<p class="flex-caption">It can be anysize or backround</p>
						</li>
						<li>
							<a href="#"><img src="img/runningSlideShow2.jpg" alt="" /></a>
							<p class="flex-caption">or nothing at all</p>
						</li>
					</ul><!--END UL SLIDES-->

				</div><!--END FLEXSLIDER-->

			</div><!--END SLIDESHOW-CONTAINER-->


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


			<div class="divider-border"></div>



		</div><!-- END CONTENT-WRAPPER -->

		<!-- END HOME -->

	</div><!-- END WRAPPER -->
@endsection
