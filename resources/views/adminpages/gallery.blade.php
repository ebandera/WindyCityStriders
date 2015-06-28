@extends('pages.app')

@section('content')

    <div id="wrapper">

        <!-- START GALLERY -->

        <div class="content-wrapper clear">

            <div class="section-title">

                <h1 class="title">GALLERY<span> check out some photos</span></h1>



            </div><!--END SECTION TITLE-->
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> <!-- 33 KB -->
            <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
            <script type="text/javascript" src="/javascript/gallery.js"></script>

            <div class="fotorama"
                 data-nav="thumbs">
                @foreach($galleryItems As $galleryItem)
                    <img src="{{$galleryItem->image_url}}" />
                @endforeach

            </div>

        </div><!--END CONTENT-WRAPPER-->
    </div><!--END WRAPPER-->
    <form id="eventUploadForm" method="POST" ENCTYPE="multipart/form-data" action="/updateGalleryData">


        <div class="myareacontainer" >
            <div class="content-wrapper clear">


                <div class="one-half">
                    <h3>Gallery Details</h3>
                    <div class="one-third last" >
                        Title
                    </div>
                    <div class="two-third last" >

                        <input id="galleryTitle" name="galleryTitle" type = "text" value="{{$gallery->title}}"/>
                    </div>
                    <div class="one-third last" >
                        Tile Preview
                    </div>
                    <div class="two-third last">
                        <img style = "width:150px;height:150px" id="adminEventImage" src="{{$gallery->image_url}}" />
                        <br>
                    </div>
                    <div class="one-third last" >
                        Update Tile<br>

                    </div>
                    <div class="two-third last" >

                        <input type="file" id='fileUploadGalleryTileImage' name="fileUploadGalleryTileImage" class="adminFile" />
                        <input type="submit" class="adminMyButton2"  name="fileGalleryBtn" value="Update Tile Image"  />
                        <input type="hidden" id="galleryId" name = "galleryId" value="{{$gallery->id}}" />
                        <input type="hidden" name="_token" value = "{{ csrf_token() }}" />
                        <hr>
                    </div>



                    <h3>Associated Event</h3>
                    <div id="datepickerContainer">
                        <label for="fromGallery">From</label>
                        <input type="text" id="fromGallery" name="fromGallery">
                        <label for="toGallery">To</label>
                        <input type="text" id="toGallery" name="toGallery">
                    </div>
                        <input type="button" class="adminMyButton2" value="Refine List By Dates" onclick="searchEventsByDateRangeForGallery()" />
                        <br><br>
                        <select id="adminEventDropdown" class="adminSelectDropdownEvent" >
                            @if(count($eventList)>1)
                            <option value="none">No Event</option>
                            @endif
                            @foreach($eventList as $eventListItem)
                                <option value="{{$eventListItem->id}}">{{ date_format($eventListItem->event_date, "m/d/Y") . ' - ' . $eventListItem->event_name }}</option>
                            @endforeach



                        </select>
                        <hr>

                    <div >

                        <input type="button" class="adminMyButton2" value="Save Edits" onclick="SaveGalleryEdits()" />
                        <input type="button" class="adminMyButton2" value="Delete Gallery"  onclick="DeleteGallery()" />

                        <br><br><br>
                    </div>






                </div>
                <div class="one-half last adminHomeCarouselControls">
                    <h3>Gallery Images</h3>


                    <input type = "text" id="galleryCaption" name="galleryCaption" />
                    <input type="button" class="adminMyButton5" value="Save Updated Caption" onclick="SaveGalleryCaption()" />
                        <img id="adminGalleryImage" src="/img/slideshow.png" />
                        <br><br>


                    <div>



                    </div>
                    <h3>Image List</h3>(Click Preview)
                    <select id="adminGalleryListbox" class="adminSelectListboxGallery" size="5">

                        @foreach($galleryItems as $galleryItem)
                            <option value="{{$galleryItem->id}}" data-image="{{$galleryItem->image_url}}" data-caption="{{$galleryItem->caption}}">{{$galleryItem->caption}}</option>
                        @endforeach

                    </select>
                    <hr>
                    <input type="file" id='fileUploadGalleryImage' name="fileUploadGalleryImage" class="adminFile"/>
                    <input type="submit" class="adminMyButton2"  name="fileGalleryBtn" value="Upload Image"  />
                    <input type="button" class="adminMyButton2" value="Delete Selected Image" onclick="DeleteGalleryItem()" />






                </div>

            </div>
        </div>
    </form>
    <script>


        $('#adminGalleryListbox').change(function(){

            $('#adminGalleryImage').attr('src',$('#adminGalleryListbox option:selected').data('image'));
            $('#galleryCaption').val($('#adminGalleryListbox option:selected').data('caption'));
        });

        $(function() {

            $( "#fromGallery" ).datepicker({

                changeMonth: true,
                numberOfMonths: 1,
                onClose: function( selectedDate ) {
                    $( "#toGallery" ).datepicker( "option", "minDate", selectedDate );
                }
            });
            var today = new Date();
            var range = today.addYears(1);

            $( "#fromGallery").val('{{date_format($begDate, "m/d/Y")}}');

            $( "#toGallery" ).datepicker({
                changeMonth: true,
                numberOfMonths: 1,
                onClose: function( selectedDate ) {
                    $( "#fromGallery" ).datepicker( "option", "maxDate", selectedDate );
                }
            });

            $( "#toGallery").val('{{date_format($endDate, "m/d/Y")}}');





        });



    </script>

@endsection