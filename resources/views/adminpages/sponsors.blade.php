
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
    <form id="sponsorUploadForm" method="POST" ENCTYPE="multipart/form-data" action="/uploadSponsorImage">
        <h3 align="center"class="title">Modify Sponsors</h3>
        <div class="myareacontainer" >
            <div class="content-wrapper clear">
                <h3>Sponsors heading</h3>
                <textarea id="adminSponsorHeadingEntry" name="adminSponsorHeadingEntry" rows="1" class="myBlogEntry"> @if(isset($headerBlog)){{$headerBlog->html_text}}@endif</textarea>
                <input type="button" value="Update Heading" onclick="UpdateSponsorHeading()" />
            </div>
        </div>
        <div class="myareacontainer" >
            <div class="content-wrapper clear">

                <h3>Sponsor List</h3>
                <div class="one-half">

                   (Click Preview)
                    <select id="adminSponsorsListbox" class="adminSelectListboxGallery" size="5">

                        @foreach($blogs as $blog)
                            <option value="{{$blog->id}}" data-image="{{$blog->image_url}}" data-sponsor="{{$blog->heading}}" data-link="{{$blog->html_text}}">{{$blog->heading}}</option>
                        @endforeach

                    </select>
                    <hr>
                    <input type="file" id='fileUploadSponsorImage' name="fileUploadSponsorImage" class="adminFile"/>
                    <input type="submit" class="adminMyButton2"  name="fileGalleryBtn" value="Upload Sponsor Image (create new)"  />
                    <input type="button" class="adminMyButton2" value="Delete Sponsor" onclick="DeleteSponsor()" />
                    <input type="button" class="adminMyButton2" value="Move Sponsor Up" onclick="MoveSponsorUp()" />
                    <input type="button" class="adminMyButton2" value="Move Sponsor Down" onclick="MoveSponsorDown()" />
                    <input type="hidden" name="_token" value = "{{ csrf_token() }}" />






                </div>
                <div class="one-half last adminHomeCarouselControls">

                    <div style="height:200px">
                    <img id="adminSponsorImage" src="/img/slideshow.png" />
                    </div>
                    <h3>Sponsor Info</h3>
                    <div id="datepickerContainer">
                        <label for="sponsorName">Sponsor Name</label>
                        <input type="text" id="sponsorName" name="sponsorName">
                        <label for="sponsorLink">Web Address</label>
                        <input type="text" id="sponsorLink" name="sponsorLink">
                    </div>
                    <input type="button" class="adminMyButton2" value="Save Edits" onclick="SaveSponsorEdits()" />
                    <br><br>


                    <div>



                    </div>







                </div>

            </div>
        </div>
    </form>
    <script>
    $('#adminSponsorsListbox').change(function(){

    $('#adminSponsorImage').attr('src',$('#adminSponsorsListbox option:selected').data('image'));
    $('#sponsorName').val($('#adminSponsorsListbox option:selected').data('sponsor'));
    $('#sponsorLink').val($('#adminSponsorsListbox option:selected').data('link'));
    });
    </script>


@endsection