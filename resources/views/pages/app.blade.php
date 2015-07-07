<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="xsrf-token" content="<?php $encrypter= app('Illuminate\Encryption\Encrypter'); echo $encrypter->encrypt(csrf_token());?>" >
	<title>Windy City Striders</title>

	<!--<link href="css/app.css" rel="stylesheet">-->
	<link href="/css/flexslider.css" rel="stylesheet">

	<link rel="stylesheet" href="/css/main.css" type="text/css" media="screen" />
	<link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
    <link href="/css/style.css" rel="stylesheet">
    <!--CAROUSEL CSS -->
    <link rel="stylesheet" type="text/css" href="/css/carouselstyle.css" />
    <!--GALLERY CSS-->
    <link rel="stylesheet" type="text/css" href="/css/gallery.css" media="screen" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> <!-- 33 KB -->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script type="text/javascript" src="/javascript/google_map_plugin.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>




	<script type="text/javascript" src="/javascript/header.js"></script>
	<script type="text/javascript" src="/javascript/jquery.flexslider.js"></script>


    <script type="text/javascript" src="/javascript/jquery.easing.1.3.js"></script>
    <!-- the jScrollPane script-->
    <script type="text/javascript" src="/javascript/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="/javascript/jquery.contentcarousel.js"></script>

   <script type="text/javascript" src="/javascript/custom.js"></script>





	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>


		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body id="top">

<!-- START HEADER -->

<div id="header-wrapper">

	<div class="header clear">

		<div id="logo">
			<a href="/home"><img src="/img/bannerLOGO.png" alt="" /></a>
		</div><!--END LOGO-->

		<div id="primary-menu">

			<ul class="menu">
				<li><a href="/home" class="">Home</a>
				</li>
				<li><a href="/about">About</a>
					<ul>
						<li><a href="/team">Meet the board</a></li>
						<li><a href="/join">Join Us</a></li>
					</ul>
				</li>
                <li><a href="#" class="">Content</a>
                    <ul>
                        <li><a href="/gallerymain">Gallery</a>
                        <li><a href="/calendar">Calendar</a>
                        <li><a href="/results">Results</a>
                        <li><a href="/sponsors">Sponsors</a>
                    </ul>


				</li>
				<li><a href="/blog">Blog</a>
					<ul>
                        @foreach($sdh->footerBlogs as $footerBlog)
                            <li><a href="/blog/{{$footerBlog->id}}">{{$footerBlog->heading}}</a>	</li>
                        @endforeach

					</ul>
				</li>
				<li><a href="/contact">Contact</a>
				</li>
                @if ($sdh->theUser)
                <li><a href="#">{{$sdh->theUser->name}}</a>
                    <ul>
                        <li><a href="/auth/logout">Logout</a></li>
                        @if($sdh->theUser->user_profile=='admin')
                            <li><a href="/approveLogin">Manage Requests</a></li>
                            <li><a href="/systemSettings">System Settings</a></li>
                        @endif
                        <!--<li><a href="/password/reset">Reset Password</a></li>-->

                    </ul>
                </li>
                @else
                <li><a href="/auth/login">Login</a>
                    <ul>
                        <li><a href="/auth/register">Register</a></li>


                    </ul>
                </li>
                @endif</a>

			</ul><!--END UL-->

		</div><!--END PRIMARY MENU-->

	</div><!--END HEADER-->

</div><!--END HEADER-WRAPPER-->

<!-- END HEADER -->
	@yield('content')
<!--START FOOTER -->

<div id="footer">

	<div id="footer-content">

		<div id="footer-top" class="clear">

			<div class="one-fourth">
				<h3>About us</h3>
				<p>We Promote all things running.</p><br />
				<p>PO Box 52161, Casper, WY 82605<br />

				<ul class="social-bookmarks">
					<li class="twitter"><a href="#">twitter</a></li>
					<li class="facebook"><a href="#">facebook</a></li>
					<li class="dribbble"><a href="#">dribbble</a></li>
					<li class="rss"><a href="#">rss</a></li>
					<li class="flickr"><a href="#">flickr</a></li>
				</ul><!--END SOCIAL-BOOKMARKS-->
			</div><!--END ONE-FOURTH-->


			<div class="one-fourth">
				<h3>Latest posts</h3>

				<ul>
					@foreach($sdh->footerBlogs as $footerBlog)
						<li><a href="/blog/{{$footerBlog->id}}">{{$footerBlog->heading}}</a>	</li>
					@endforeach
				</ul><!--END UL-->
			</div><!--END ONE-FOURTH-->


			<div class="one-fourth">
				<h3>Latest tweets</h3>
				<ul>
					<li><a href="#">This will be a tweet</a></li>
					<li><a href="#">Another tweet</a></li>
					<li><a href="#">Again tweeting</a></li>
					<li><a href="#">This will be a tweet</a></li>
					<li><a href="#">This will be a tweet</a></li>
					<li><a href="#">This will be a tweet</a></li>
				</ul>
				<div class="tweets"></div><!--END TWEETS-->
			</div><!--END ONE-FOURTH-->


			<div class="one-fourth last">
				<h3>Flickr or Instagram Stream </h3>
				<ul>
					<li><a href="#">This will be a photostream</a></li>
					<li><a href="#">Another stream</a></li>
					<li><a href="#">Again streaming</a></li>
					<li><a href="#">This will be a stream</a></li>
					<li><a href="#">This will be a photostream</a></li>
					<li><a href="#">This will be a flickr photostream</a></li>
				</ul>
				<div class="photostream flickr_list_footer"></div><!--END PHOTOSTREAM FLICKR_LIST-->
			</div><!--END ONE-FOURTH LAST-->

		</div><!--END FOOTER-TOP-->


		<div id="footer-bottom" class="clear">

			<div class="one-half">
				<p>Copyright &copy; 2015 Windy City Striders</p>
			</div><!--END ONE-HALF-->

			<div class="one-half text-align-right last">
				<p>Socialize with us on <a href="#">Twitter</a>, <a href="#">Facebook</a></p>
			</div><!--END ONE-HALF TRIGGER-FOOTER LAST-->

		</div><!--END FOOTER-BOTTOM-->

	</div><!--END FOOTER-CONTENT-->

</div><!--END FOOTER-->

<!-- END FOOTER -->

</body>
</html>
