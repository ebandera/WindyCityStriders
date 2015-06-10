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
                <P><a href="/gallery">See Pictures of This Event</a></P>
                <P><a href="{{ $calendarItem->event_info_path }}">Link for more details</a></P>
                <P><a href="{{ $calendarItem->event_results_path }}">Results</a></P>
            </div>
            <div class="event-img span4">
                <img src="{{ $calendarItem->event_img_url }}" alt="race"/>
            </div>
            <div class="event-details2 span11">
                <p>Secondary details</p>
            </div>
        </div> <!--END EVENT-BAR-->
    </div> <!--END CONTAINER BOOTSTRAP-->
    <br><br><br>
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
                <form id="carouselUploadForm" method="POST" ENCTYPE="multipart/form-data" action="../uploadCarouselItem">

                    <h5>Filter By Date</h5>
                    <div id="datepickerContainer">
                        <label for="from">From</label>
                        <input type="text" id="from" name="from">
                        <label for="to">To</label>
                        <input type="text" id="to" name="to">
                    </div>
                    <input type="button" class="adminMyButton2"  value="Search" onclick="searchEventsByDateRange()" />
                    <hr>


                    <input type="button" class="adminMyButton2"  value="Delete"  />
                    <input type="button" class="adminMyButton2"  onclick="EditEvent()" value="Edit"  />

                    <input type="hidden" name="_token" value = "{{ csrf_token() }}" />
                </form>
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

                    <input id="eventName" type = "text" />
                </div>
                <div class="one-third last" >
                    Date
                </div>
                <div class="two-third last" >

                    <input id="eventDate" type = "text" />
                </div>
                <div class="one-third last" >
                   Where
                </div>
                <div class="two-third last" >

                    <textarea id="eventWhere" rows="3" class="mycarouseladmincaption"></textarea>
                </div>
                <div class="one-third last" >
                    Description
                </div>
                <div class="two-third last" >

                    <textarea id="eventDescription" rows="3" class="mycarouseladmincaption"></textarea>
                </div>
                <div class="one-third last" >
                    Address <br>(for google maps)
                </div>
                <div class="two-third last" >

                    <textarea id="eventAddress"rows="1" class="mycarouseladmincaption"></textarea>
                </div>
                <div class="one-third last" >
                    Information Doc (flyer)<br>
                    Already Posted: <input type="checkbox" id="eventInfoDoc" disabled />
                </div>
                <div class="two-third last" >

                    <input type="file" id='fileUpload1' name="fileUpload1" class="adminFile"/>
                    <input type="submit" class="adminMyButton2"  value="upload File"  />
                </div>
                <div class="one-third last" >
                    Results Upload<br>
                    Already Posted: <input type="checkbox" id="eventResults" disabled />
                </div>
                <div class="two-third last" >
                    <input type = "hidden" id="eventId" value="" />
                    <input type="file" id='fileUpload1' name="fileUpload1" class="adminFile"/>
                    <input type="submit" class="adminMyButton2"  value="upload File"  />
                </div>






            </div>
            <div class="one-half last adminHomeCarouselControls">
                <form id="carouselUploadForm" method="POST" ENCTYPE="multipart/form-data" action="../uploadCarouselItem">

                    <div class="adminHomeCarouselImage">
                        <img id="adminEventImage" src="/img/slideshow.png" />
                    </div>
                    <hr>
                    <h3>Event Image</h3>
                    <input type="file" id='fileUpload1' name="fileUpload1" class="adminFile"/>
                    <input type="submit" class="adminMyButton2"  value="upload File"  />
                    <input type="hidden" name="_token" value = "{{ csrf_token() }}" />
                    <hr>
                    <input type="button" class="adminMyButton2"  onclick="AddEvent()" value="Add New"  />
                    <input type="button" class="adminMyButton2"  onclick="SaveEvent()" value="Save Edits"  />

                </form>
            </div>
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
        });
    </script>
@endsection