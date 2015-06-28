@extends('pages.app')

@section('content')

    <div id="wrapper">

        <!-- START GALLERY -->

        <div class="content-wrapper clear">

            <div class="section-title">

                <h1 class="title">GALLERY<span> Choose Gallery</span></h1>



            </div><!--END SECTION TITLE-->

            <div class="container">
                <div id="ca-container" class="ca-container">
                    <div class="ca-wrapper">
                        @foreach($galleries as $gallery)
                        <div class="ca-item">
                            <div class="ca-item-main">
                                <h5>{{$gallery->title}}</h5>
                                <a href="gallery/{{$gallery->id}}"><img src="{{$gallery->image_url}}"></a>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>






        </div><!--END CONTENT-WRAPPER-->
    </div><!--END WRAPPER-->


    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <!-- the jScrollPane script -->
    <script type="text/javascript" src="js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="js/jquery.contentcarousel.js"></script>
    <script type="text/javascript">
        $('#ca-container').contentcarousel();
    </script>
@endsection