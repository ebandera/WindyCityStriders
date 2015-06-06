@extends('pages.app')

@section('content')

    <div id="wrapper">

        <!-- START ABOUT -->

        <div class="content-wrapper clear">

            <div class="myareacontainer" >
            <div class="section-title">

                <h1 class="title">CWCS <span>all here to promote the sport of running</span></h1>

            </div><!--END SECTION TITLE-->

            @foreach($blogs as $index=>$blog)
                @if ($index+1==count($blogs))
                    <div class="one-third last">
                        <h3 class="title">{{ $blog->heading }}</h3>
                        <p>{{ $blog->html_text }}</p>
                    </div><!--END ONE-THIRD-->
                @else
                    <div class="one-third">
                        <h3 class="title">{{ $blog->heading }}</h3>
                        <p>{{ $blog->html_text }}</p>
                    </div><!--END ONE-THIRD-->
                @endif



            @endforeach
            </div>
            <hr>
            <h1 align="center" class="title">Newsletter</h1>
            <div class="myareacontainer" >
                <div class="newsletter">

                    @foreach($newsletter as $theNewsletter)
                        <img src = "{{$theNewsletter->image_url}}" />
                    @endforeach
                </div>
            </div> <!--END MYAREACONTAINER-->
            <hr>


        </div><!--END CONTENT-WRAPPER-->

        <!-- END ABOUT -->

    </div><!--END WRAPPER-->

@endsection