@extends('pages.app')

@section('content')

    <div id="wrapper">

        <!-- START GALLERY -->

        <div class="content-wrapper clear">

            <div class="section-title">

                <h1 class="title">GALLERY<span> check out some photos</span></h1>



            </div><!--END SECTION TITLE-->
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> <!-- 33 KB -->

            <script type="text/javascript" src="Gallery/js/gallery.js"></script>

            <div class="fotorama"
                 data-nav="thumbs">
                <img src="/img/slideshow.png">
                <img src="/img/gallery1.jpeg">
                <img src="/img/gallery2.jpeg">
                <img src="/img/gallery3.jpg">
                <img src="/img/gallery4.jpg">
                <img src="/img/gallery5.jpg">
                <img src="/img/gallery6.jpg">
                <img src="/img/gallery7.jpg">
            </div>

        </div><!--END CONTENT-WRAPPER-->
    </div><!--END WRAPPER-->

@endsection