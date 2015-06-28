
@extends('pages.app')

@section('content')

    <div id="wrapper">



        <!-- START Sponsors -->

        <div class="content-wrapper clear">

            <div class="section-title">

                <h1 class="title">Sponsors <span>Thank you so much for your continued support!</span></h1>

            </div><!--END SECTION TITLE-->

            <div id="inner-content" class="blog1">
            @if(isset($headerBlog))
                <div class="post">



                    <div class="post-content">


                        <p>{{ $headerBlog->html_text }}</p>
                        <hr>

                    </div><!--END POST-CONTENT -->

                </div><!--END POST-->
            @endif
            @foreach($blogs as $blog)
                <div class="post">



                    <div class="post-content">

                        <div class="post-media">
                            <a target="_blank" href="http://{{ $blog->html_text }}"><img src=" {{ $blog->image_url }}" alt="" width="600" /></a>
                        </div><!--END POST-MEDIA-->

                        <div class="post-title">
                            <h2 class="title">{{ $blog->heading }}</h2>
                        </div><!--END POST-TITLE-->



                        <p><a target="_blank" href="http://{{ $blog->html_text }}">{{ $blog->html_text }}</a> </p>
                        <hr>

                    </div><!--END POST-CONTENT -->

                </div><!--END POST-->


            @endforeach

            </div><!--END INNER CONTENT-->



        </div><!--END CONTENT-WRAPPER-->

                <!-- END BLOG -->

    </div><!--END WRAPPER-->



@endsection