@extends('pages.app')

@section('content')

    <div id="wrapper">

        <!-- START ABOUT -->

        <div class="content-wrapper clear">
            <div class="myareacontainer" >
                <div class="section-title">

                    <h1 class="title">BOARD MEMBERS <span>all here to promote the sport of running</span></h1>
                    <form>
                        <br>
                        Change Year
                        <select name="adminBoardYearTop" id="adminBoardYearTop">
                            @foreach ($years as $year)
                                @if ($year==$selectedYear)
                                    <option value = "{{$year}}" selected>{{$year}}</option>
                                @else
                                    <option value = "{{$year}}">{{$year}}</option>
                                @endif

                            @endforeach
                        </select>
                    </form>

                    <div class="divider-border"></div>
                    <div class="clear"></div>

                    <!--	<h3 class="title">Meet the team</h3>-->


                    <?php $index=0; ?>
                    @foreach($board as $member)
                        @if($index==0) <div class="one-half">
                        @elseif($index==1) <div class="one-half last">
                        @elseif($index%3==1) <div class="one-third last">
                        @else <div class="one-third">@endif




                            <img src="{{ $member->image_url }}" alt="" />
                            <div class="arrow"></div>
                            <div class="team-member-info">
                                <ul>
                                    <li><h2>{{ $member->name }}</h2></li>
                                    <li><h3>{{ $member->position }}</h3></li>
                                </ul>
                                <p>{{ $member->description }}</p>
                                <ul class="social-personal">
                                    <li><a href="{{ $member->twitter_link }}">Twitter</a><span>/</span></li>
                                    <li><a href="{{ $member->facebook_link }}">Facebook</a></li>
                                </ul>
                            </div><!--END TEAM-MEMBER-INFO-->
                        </div><!--END ONE-THIRD-->
                       <?php $index+=1; ?>

                    @endforeach



                </div>

            </div><!--END MYAREACONTAINER-->

            <h3 align="center"class="title">Modify Board Members</h3>
            <div class="myareacontainer" >
                <div class="content-wrapper clear">
                    <div class="two-third">

                        <div class="adminBoardImage one-third">
                            <img id="adminBoardImage" src="" />
                        </div>
                        <div class="adminBoardCaption">
                            <h3>Name</h3>
                            <input id="adminBoardName" type="text" />
                            <h3>Description</h3>
                            <div class="one-half last" >
                                <textarea id="adminBoardTextarea" rows="1" class="adminBoardTextarea"></textarea>
                            </div>
                            <div class="one" >
                                <h3>Title</h3>
                                <select class="fullWidth" name="boardTitlesSelect" id="adminBoardPosition">
                                    <option value = "PRESIDENT">PRESIDENT</option>
                                    <option value = "VICE PRESIDENT">VICE PRESIDENT</option>
                                    <option value = "TREASURER">TREASURER</option>
                                    <option value = "SECRETARY">SECRETARY</option>
                                    <option value = "BOARD MEMBER">BOARD MEMBER</option>
                                </select>
                                <h3>year</h3>
                                <select class="fullWidth" name="adminBoardYear" id="adminBoardYear">
                                    @foreach ($years as $year)
                                        @if ($year==$selectedYear)
                                            <option value = "{{$year}}" selected>{{$year}}</option>
                                        @else
                                            <option value = "{{$year}}">{{$year}}</option>
                                        @endif

                                    @endforeach
                                </select>
                                <h3>Facebook link</h3>
                                <input class="fullWidth" id="adminBoardFacebook" type="text" /><br>
                                <h3>Twitter link</h3>
                                <input class="fullWidth" id="adminBoardTwitter" type ="text" />

                            </div>
                        </div>


                    </div>
                    <div class="one-third last adminHomeCarouselControls">
                        <form action="uploadTeamImage" method="POST" ENCTYPE="multipart/form-data" action="../uploadTeamImage">
                            <h3>Board Members</h3>
                            <select id="adminBoardListbox" class="adminSelectListbox" size="5">
                                @foreach($board as $member)
                                <option data-image="{{$member->image_url}}" data-caption="{{$member->description}}" data-facebook="{{$member->facebook_link}}" data-twitter="{{$member->twitter_link}}" data-position="{{$member->position}}" data-year="{{$member->year}}" value="{{$member->id}}">{{$member->name}}</option>
                                @endforeach

                            </select>

                            <input type="button" class="adminMyButton1" onclick="UpdateBoardMember()" value = "Save Edits" disabled />
                            <input type="button" class="adminMyButton1" value = "Delete Item" onclick="DeleteBoardMember()" disabled />

                            <hr>
                            <h3>Add New</h3>
                            <input type="file" name="fileUpload3" id="fileUpload3" class="adminFile"/>
                            <input type="submit" class="adminMyButton2" value="upload File" />
                            <input type="hidden" name="_token" value = "{{ csrf_token() }}" />
                        </form>
                    </div>
                </div>
            <!-- END ABOUT -->

        </div><!--END CONTENTWRAPPER-->
    </div> <!--END WRAPPER-->
    <script>
        $(document).ready(function($) {
            $('#adminBoardYearTop').change(function(){
                var id = $('#adminBoardYearTop option:selected').val();

                if(typeof(id)!='undefined') {
                    window.location.href = '/adminteam/' + id;
                }



            });
            $('#adminBoardListbox').change(function(){
                $('#adminBoardImage').attr('src',$('#adminBoardListbox option:selected').data('image'));
                $('#adminBoardTextarea').val($('#adminBoardListbox option:selected').data('caption'));
                // $('#adminBoardPosition').val($('#adminBoardListbox option:selected').data('position'));
                // alert($('#adminBoardListbox option:selected').data('position'));
                $('#adminBoardPosition').val($('#adminBoardListbox option:selected').data('position'));
                $('#adminBoardTwitter').val($('#adminBoardListbox option:selected').data('twitter'));
                $('#adminBoardFacebook').val($('#adminBoardListbox option:selected').data('facebook'));
                $('#adminBoardName').val($('#adminBoardListbox option:selected').text());
                $('#adminBoardYear').val($('#adminBoardListbox option:selected').data('year'));
                $('input[type="button"]').removeAttr('disabled');
                //alert($('#adminBoardListbox option:selected').data('position'));


            });
            $('#fileUpload3').change(function(){

                var tmppath = URL.createObjectURL(event.target.files[0]);
                $('#adminBoardImage').attr('src',tmppath);
                $('#adminBoardName').val('');
                $('#adminBoardTextarea').val('');
                $('#adminBoardFacebook').val('');
                $('#adminBoardTwitter').val('');
                $('input[type="button"]').attr('disabled','disabled');



            });
        });


    </script>
@endsection