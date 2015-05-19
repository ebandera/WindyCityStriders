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
@endsection