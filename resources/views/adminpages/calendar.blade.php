@extends('pages.app')

@section('content')



    <div class="content-wrapper clear">

        <div class="section-title">
            <h1 class="title">Calendar<span> save the date and come out!</span></h1>
        </div><!--END SECTION TITLE-->
    </div><!--END CONTENT-WRAPPER-->

    <div class="container">  <!--CALENDAR CONTAINER. BOOTSTRAP!-->
        <div class="month-year-bar">
            <div class="month">
                <p><a href="/calendar/previousMonth/{{date_format($calendarItem->event_date,'Y-m')}}">&lt;</a>{{date_format($calendarItem->event_date,'F')}}<a href="/calendar/nextMonth/{{date_format($calendarItem->event_date,'Y-m')}}">&gt;</a></p>
            </div>
            <div class="year span3">
                <p><a href="/calendar/previousYear/{{date_format($calendarItem->event_date,'Y-m')}}">&lt;</a>{{date_format($calendarItem->event_date,'Y')}}<a href="/calendar/nextYear/{{date_format($calendarItem->event_date,'Y-m')}}">&gt;</a></p>
            </div>
        </div>                              <!--END MONTH-YEAR-BAR-->
        <div class="date-bar">
            @foreach($calendarMonthItems as $eventDate)
            <div class="date-cube span3">
                <a href="/calendar/{{$eventDate->id}}"><p>{{date_format($eventDate->event_date,'d')}}</p></a>
            </div>
            @endforeach
              <!--END DATE-BAR-->

        </div>
        <div class="event-bar">
            <div class="event-title span10">
                <h2>{{ $calendarItem->event_name}}</h2>
                <h4>{{ date_format($calendarItem->event_date,'l F j, Y')}}</h4>
            </div>
            <div class="event-details span7">
                <h4>{{ $calendarItem->event_place_text}}</h4>

                <p>{{ $calendarItem->event_details }}</p>
                <P>{{ $calendarItem->event_address }}</P>
                <div id="bra-map" class="google-map"></div><br />
                @if($calendarItem->event_address!='')
                <script>
                    $(document).ready(function() {
                        $('#bra-map').bra_google_map({location: '{{$calendarItem->event_address}}', zoom: 12});
                    });

                </script>
                @endif

            </div>
            <div class="event-img span4">
                @if($calendarItem->event_img_url!='')

                <img src="{{ $calendarItem->event_img_url }}" alt="race"/>
                @endif
                <hr>

                @if($calendarItem->gallery)

                <P><a href="/gallery/{{$calendarItem->gallery->id}}">Event Picture Gallery</a></P>
                @endif
                @if($calendarItem->event_info_path!='')
                    <P><a target="_blank" href="{{ $calendarItem->event_info_path }}">Event Flyer</a></P>
                @endif
                @if($calendarItem->event_url_path!='')
                    <P><a target="_blank" href="{{ $calendarItem->event_url_path }}">Website for more details</a></P>
                @endif
                @if($calendarItem->event_results_path!='')
                <P><a href="{{ $calendarItem->event_results_path }}">Results</a></P>
                @endif
            </div>
            <div class="event-details2 span11">

            </div>
        </div> <!--END EVENT-BAR-->
    </div> <!--END CONTAINER BOOTSTRAP-->
    <br><br><br>
    <form id="eventUploadForm" method="POST" ENCTYPE="multipart/form-data" action="/updateEventData">
    <div class="myareacontainer" >

        <div class="content-wrapper clear">
            <h3>Event List</h3>
            <div class="one-half">
                <select id="adminEventListbox" class="adminSelectListboxCalendar" size="5">
                    @foreach ($eventListItems As $eventListItem)
                        <option value="{{$eventListItem->id}}">{{ date_format($eventListItem->event_date, "m/d/Y") . ' - ' . $eventListItem->event_name }}</option>
                    @endforeach


                </select>





            </div>
            <div class="one-half last adminHomeCarouselControls">


                    <h5>Filter By Date</h5>
                    <div id="datepickerContainer">
                        <label for="from">From</label>
                        <input type="text" id="from" name="from" >
                        <label for="to">To</label>
                        <input type="text" id="to" name="to">

                    </div>
                    <input type="button" class="adminMyButton2"  value="Search" onclick="searchEventsByDateRange()" />
                    <hr>


                    <input type="button" class="adminMyButton2"  value="Delete" onclick="DeleteEvent()" />
                    <input type="button" class="adminMyButton2"  onclick="EditEvent()" value="Edit"  />



            </div>
        </div>
    </div>

    <div class="myareacontainer" >
        <div class="content-wrapper clear">

                <h3>Event Details</h3>
                <div class="one-half">
                    <div class="one-third last" >
                        Name
                    </div>
                    <div class="two-third last" >

                        <input id="eventName" name="eventName" type = "text" />
                    </div>
                    <div class="one-third last" >
                        Date
                    </div>
                    <div class="two-third last" >

                        <input id="eventDate" name="eventDate" type = "text" />
                    </div>
                    <div class="one-third last" >
                       Where
                    </div>
                    <div class="two-third last" >

                        <textarea id="eventWhere" name="eventWhere" rows="3" class="mycarouseladmincaption"></textarea>
                    </div>
                    <div class="one-third last" >
                        Description
                    </div>
                    <div class="two-third last" >

                        <textarea id="eventDescription" name="eventDescription" rows="3" class="mycarouseladmincaption"></textarea>
                    </div>
                    <div class="one-third last" >
                        Address <br>(for google maps)
                    </div>
                    <div class="two-third last" >

                        <textarea id="eventAddress" name="eventAddress" rows="1" class="mycarouseladmincaption"></textarea>
                    </div>
                    <div class="one-third last" >
                        Event Web Address
                    </div>
                    <div class="two-third last" >

                        <input id="eventWebUrl" name="eventWebUrl" type = "text" />
                    </div>
                    <div class="one-third last" >
                        Information Doc (flyer)<br>
                        Already Posted: <input type="checkbox" id="eventInfoDoc" disabled /><br>

                    </div>
                    <div class="two-third last" >

                        <input type="file" id='fileUploadInfo' name="fileUploadInfo" class="adminFile"/>
                        <input type="submit" class="adminMyButton2"  name="fileEventBtn" value="Upload Info"  />
                    </div>
                    <div class="one-third last" >
                        Results Upload<br> (Excel and csv only)<br>
                        Already Posted: <input type="checkbox" id="eventResults" disabled />
                        <a href = "/img/usercontent/ResultsTemplate.xlsx">Download Template</a>
                    </div>
                    <div class="two-third last" >
                        <input type = "hidden" id="eventId" name="eventId" value="" />
                        <input type="file" id='fileUploadResults' name="fileUploadResults" class="adminFile"/>
                        <input type="submit" class="adminMyButton2"  name="fileEventBtn" value="Upload Results"  />
                    </div>






                </div>
                <div class="one-half last adminHomeCarouselControls">


                        <div class="adminHomeCarouselImage">
                            <img id="adminEventImage" src="/img/slideshow.png" />
                        </div>
                        <hr>
                        <h3>Event Image</h3>
                        <input type="file" id='fileUploadImage' name="fileUploadImage" class="adminFile"/>
                        <input type="submit" class="adminMyButton2"  name="fileEventBtn" value="Upload Image"  />
                        <input type="hidden" name="_token" value = "{{ csrf_token() }}" />
                        <hr>
                        <input type="button" class="adminMyButton2"  onclick="AddEvent()" value="Add New"  />
                        <input type="button" class="adminMyButton2"  onclick="SaveEvent()" value="Save Edits"  />


                </div>

        </div>
    </div>
    </form>
    <div class="myareacontainer" >
        <div class="content-wrapper clear">

            <h3>Bulk Event Loader</h3>
            <form id="eventUploadForm" method="POST" ENCTYPE="multipart/form-data" action="/updateBulkEvents">
                <input type="hidden" name="_token" value = "{{ csrf_token() }}" />
                <input type="file" id='fileUploadBulkEvents' name="fileUploadBulkEvents" class="adminFile"/>
                <input type="submit" class="adminMyButton2"  name="fileBulkEventsBtn" value="Upload Excel File"  />

            </form>
        </div>
    </div>

    <script>
        $(function() {
            $( "#from" ).datepicker({
                changeMonth: true,
                numberOfMonths: 1,
                onClose: function( selectedDate ) {
                    $( "#to" ).datepicker( "option", "minDate", selectedDate );
                }
            });
            var today = new Date();
           var range = today.addYears(1);
           $( "#from").val(today.toFormattedString());

            $( "#to" ).datepicker({
                changeMonth: true,
                numberOfMonths: 1,
                onClose: function( selectedDate ) {
                    $( "#from" ).datepicker( "option", "maxDate", selectedDate );
                }
            });
            $( "#to").val(range.toFormattedString());
            $( "#eventDate" ).datepicker({

                changeMonth: true,
                numberOfMonths: 1,
                onClose: function( selectedDate ) {
                    $( "#to" ).datepicker( "option", "minDate", selectedDate );
                }
            });

            $('#fileUploadImage').change(function(){
                var tmppath = URL.createObjectURL(event.target.files[0]);
                $('#adminEventImage').attr('src',tmppath);
            });



            @if(isset($editingEvent))

            var eventId={{$editingEvent->id}};
            EditEvent(eventId);
            @endif
        });
    </script>
@endsection