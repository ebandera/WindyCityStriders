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
@endsection