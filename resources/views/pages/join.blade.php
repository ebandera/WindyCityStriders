@extends('pages.app')

@section('content')
    <div id="wrapper">

        <!-- START JOIN -->

        <div class="content-wrapper clear">

            <div class="section-title">

                <h1 class="title">JOIN US <span>Purpose/Benefits/Sponsors</span></h1>

            </div><!--END SECTION TITLE-->
            <div id="inner-content" class="blog1">
                @if(isset($joinText))
                    <div class="post">



                        <div class="post-content">


                            <p>{!!$joinText->html_text!!}</p>
                            <hr>

                        </div><!--END POST-CONTENT -->

                    </div><!--END POST-->
                @endif
                @if(isset($joinForm))
                    <div class="post">



                        <div class="post-content">

                            <div class="post-title">
                                <a target="_blank" href="{{ $joinForm->image_url }}"><img src="/img/pdf_icon.gif" />&nbsp;&nbsp;&nbsp;<h2 class="title" style="display:inline-block">{{ $joinForm->html_text }}</h2></a>
                            </div><!--END POST-TITLE-->
                            <div class="post-media">
                                <a target="_blank" href="{{ $joinForm->image_url }}"><img src=" {{ $joinForm->image_url }}" alt="" width="600" /></a>
                            </div><!--END POST-MEDIA-->

                            <hr>

                        </div><!--END POST-CONTENT -->

                    </div><!--END POST-->


                @endif

            </div><!--END INNER CONTENT-->


        </div><!--END CONTENT-WRAPPER-->


        <!-- END JOIN -->

    </div><!--END WRAPPER-->

@endsection