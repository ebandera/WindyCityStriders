@extends('pages.app')

@section('content')
    <script type="text/javascript" src="/javascript/ckeditor/ckeditor.js"></script>
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

        <h3 align="center"class="title">Join Us Content</h3>
        <form id="joinUploadForm" method="POST" ENCTYPE="multipart/form-data" action="../uploadMembershipForm">
        <div class="myareacontainer" >
            <div class="content-wrapper clear">
               <!-- <textarea id="adminJoinText" name="adminJoinText" rows="1" class="joinText">@if(isset($joinText)){{$joinText->html_text}}@endif</textarea>-->

                <textarea name="adminJoinText" id="adminJoinText"></textarea>
                <script>
                    CKEDITOR.config.height='300';
                    CKEDITOR.replace('adminJoinText');
                    CKEDITOR.instances['adminJoinText'].setData('@if(isset($joinText)){!!$joinText->html_text!!}@endif');
                </script>
                <input class="adminMyButton1" type="button"  value="Save Edits" onclick="SaveJoinTextEdits()" />
                <input type="hidden" name="_token" value = "{{ csrf_token() }}" />
            </div>

        </div>

        <h3 align="center"class="title">Update Membership Form</h3>
        <div class="myareacontainer" >
            <div class="content-wrapper clear">
                <input type="file" id="fileUploadMembershipForm" name="fileUploadMembershipForm" class="adminFile" />
                <input class="adminMyButton1" type="submit"  value="Upload File" />
            </div>

        </div>
        </form>
        <!-- END JOIN -->

    </div><!--END WRAPPER-->


@endsection