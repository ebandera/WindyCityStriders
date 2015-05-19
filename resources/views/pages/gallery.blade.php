@extends('pages.app')

@section('content')

    <div id="wrapper">

        <!-- START GALLERY -->

        <div class="content-wrapper clear">

            <div class="section-title">

                <h1 class="title">GALLERY<span> check out some photos</span></h1>



            </div><!--END SECTION TITLE-->
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> <!-- 33 KB -->

            <script type="text/javascript" src="/javascript/gallery.js"></script>

            <div class="fotorama"
                 data-nav="thumbs">
                @foreach($galleryItems As $galleryItem)
                    <img src="{{$galleryItem->image_url}}" />
                @endforeach

            </div>

        </div><!--END CONTENT-WRAPPER-->
    </div><!--END WRAPPER-->

@endsection