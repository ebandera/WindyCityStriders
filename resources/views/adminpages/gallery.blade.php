@extends('pages.app')

@section('content')

    <div id="wrapper">

        <!-- START GALLERY -->

        <div class="content-wrapper clear">

            <div class="section-title">

                <h1 class="title">GALLERY<span>check out some photos</span></h1>
                @foreach($galleryItems as $galleryItem)

                <table><tr><td>{{ $galleryItem->image_url }}</td><td>{{ $galleryItem->caption }}</td></tr></table>
                @endforeach


            </div><!--END SECTION TITLE-->



        </div><!--END CONTENT-WRAPPER-->

        <!-- END GALLERY -->

    </div><!--END WRAPPER-->
@endsection