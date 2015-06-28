<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!--<link href="css/app.css" rel="stylesheet">-->
    <link href="/css/flexslider.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/main.css" type="text/css" media="screen" />
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
    <link href="/css/style.css" rel="stylesheet">

    <!-- Fonts -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="/javascript/custom.js"></script>
    <script type="text/javascript" src="/javascript/header.js"></script>
    <script type="text/javascript" src="/javascript/jquery.flexslider.js"></script>
    <script type="text/javascript" src="/javascript/google_map_plugin.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>


    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="xsrf-token" content="<?php $encrypter= app('Illuminate\Encryption\Encrypter'); echo $encrypter->encrypt(csrf_token());?>" >
	<title>Laravel</title>

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
                    </ul>


                </li>
                <li><a href="/blog">Blog</a>

                </li>
                <li><a href="/contact">Contact</a>
                </li>

                    <li><a href="/auth/login">Login</a>
                        <ul>
                            <li><a href="/auth/register">Register</a></li>
                            <li><a href="/password/reset">Reset Password</a></li>
                        </ul>
                    </li>


            </ul><!--END UL-->

        </div><!--END PRIMARY MENU-->

    </div><!--END HEADER-->

</div><!--END HEADER-WRAPPER-->
@yield('content')
<!--START FOOTER -->



<!-- END FOOTER -->

</body>
</html>
