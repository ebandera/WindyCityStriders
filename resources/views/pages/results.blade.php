
@extends('pages.app')

@section('content')

    <div class="myareacontainer" >

        <div class="content-wrapper clear">
            <h3>Results List</h3>
            <div class="one-half">
                <select id="adminResultEventListbox" class="adminSelectListboxCalendar" size="5">
                    @foreach($eventsWithResults As $eventListItem)
                        <option value="{{$eventListItem->event_id}}">{{ date_format($eventListItem->event_date, "m/d/Y") . ' - ' . $eventListItem->event_name }}</option>
                   @endforeach


                </select>





            </div>
            <div class="one-half last adminHomeCarouselControls">


                <div class="datagrid"><table id="resultsTable">
                        <thead><tr><th>Placement</th><th>Runner</th><th>Time</th><th>Pace</th></tr></thead>
                        <tfoot><tr><td colspan="4"><div id="paging"><ul><li><a href="#"><span>Export To Excel</span></a></li></ul></div></tr></tfoot>
                        <tbody>
                        @if($results!=null)
                        @foreach($results as $index=>$result)
                        <tr @if($index%2==1) class="alt"@endif>
                            <td>{{$result->placement}}</td>
                            <td>{{$result->runner}}</td>
                            <td>{{$result->time}}</td>
                            <td>{{$result->pace}}</td>
                        </tr>
                        @endforeach
                        @endif

                        </tbody>
                    </table></div>



            </div>
        </div>
    </div>
    <script>
        $('#adminResultEventListbox').change(function(){

          GetResultsFromEventId($('#adminResultEventListbox option:selected').val());

        });
    </script>



@endsection