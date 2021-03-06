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
                            <h3 id="adminAboutTitlePresent{{$blog->id}}" class="title">{{ $blog->heading }}</h3>
                            <p id="adminAboutTextPresent{{$blog->id}}">{{ $blog->html_text }}</p>
                        </div><!--END ONE-THIRD-->
                    @else
                        <div class="one-third">
                            <h3 id="adminAboutTitlePresent{{$blog->id}}" class="title">{{ $blog->heading }}</h3>
                            <p id="adminAboutTextPresent{{$blog->id}}">{{ $blog->html_text }}</p>
                        </div><!--END ONE-THIRD-->
                    @endif



                @endforeach

            </div> <!--END MYAREACONTAINER-->
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
            <h1 align="center" class="title">Modify About Content</h1>
                <div class="myareacontainer" >
                    <div class="content-wrapper clear">
                        <div class="two-third">

                            <div class="adminHomeCarouselImage">
                                <form>
                                    <h3>Heading:</h3>
                                    <input id="adminAboutTitle" type="text" class="title" />
                                    <h3>Content</h3>
                                    <textarea id="adminAboutText" class="adminAboutTextarea" size="10"></textarea>
                                </form>

                            </div>



                        </div>
                        <div class="one-third last adminHomeCarouselControls">
                            <form id="newsletterUploadForm" method="POST" ENCTYPE="multipart/form-data" action="../uploadNewsletter">
                                <h3>Content Items</h3>
                                <select id="adminAboutListbox" class="adminSelectListShort" size="3">
                                    @foreach($blogs as $index=>$blog)
                                    <option data-heading="{{$blog->heading}}" data-caption="{{$blog->html_text}}" value="{{$blog->id}}">Item {{$index+1}}</option>
                                    @endforeach

                                </select>
                                <input type="button" class="adminMyButton1" onclick="SaveAboutEdits()" value = "Save Edits" />
                                <hr>
                                <h3>Set Newsletter</h3>
                                <input type="file" name="fileUpload4" id="fileUpload4" class="adminFile"/>
                                <input type="submit" class="adminMyButton1"  value = "Upload File" />
                                <input type="hidden" name="_token" value = "{{ csrf_token() }}" />
                            </form>

                        </div>
                    </div>

        </div><!--END CONTENT-WRAPPER-->

        <!-- END ABOUT -->

    </div><!--END WRAPPER-->

@endsection