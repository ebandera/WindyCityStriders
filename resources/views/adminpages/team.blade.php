@extends('pages.app')

@section('content')

    <div id="wrapper">

        <!-- START ABOUT -->

        <div class="content-wrapper clear">
            <div class="myareacontainer" >
                <div class="section-title">

                    <h1 class="title">BOARD MEMBERS <span>all here to promote the sport of running</span></h1>

                    <div class="divider-border"></div>
                    <div class="clear"></div>

                    <!--	<h3 class="title">Meet the team</h3>-->

                    @if(count($board)>2)

                            <div class="one-half team">
                                <img src="{{ $board[0]->image_url }}" alt="" />
                                <div class="arrow"></div>
                                <div class="team-member-info">
                                    <ul>
                                        <li><h2>{{ $board[0]->name }}</h2></li>
                                        <li><h3>{{ $board[0]->position }}</h3></li>
                                    </ul>
                                    <p>{{ $board[0]->description }}</p>
                                    <ul class="social-personal">
                                        <li><a href="{{ $board[0]->twitter_link }}">Twitter</a><span>/</span></li>
                                        <li><a href="{{ $board[0]->facebook_link }}">Facebook</a></li>
                                    </ul>
                                </div><!--END TEAM-MEMBER-INFO-->
                            </div><!--END ONE-THIRD-->

                            <div class="one-half team last">
                                <img src="{{ $board[1]->image_url }}" alt="" />
                                <div class="arrow"></div>
                                <div class="team-member-info">
                                    <ul>
                                        <li><h2>{{ $board[1]->name }}</h2></li>
                                        <li><h3>{{ $board[1]->position }}</h3></li>
                                    </ul>
                                    <p>{{ $board[1]->description }}</p>
                                    <ul class="social-personal">
                                        <li><a href="{{ $board[1]->twitter_link }}">Twitter</a><span>/</span></li>
                                        <li><a href="{{ $board[1]->facebook_link }}">Facebook</a></li>
                                    </ul>
                                </div><!--END TEAM-MEMBER-INFO-->
                            </div><!--END ONE-THIRD LAST-->


                    @endif
                    @if(count($board)>2)
                        @for($i=2;$i<count($board);$i++)
                            @if($i%3==1)
                                <div class="one-third team last">
                                    <img src="{{ $board[$i]->image_url }}" alt="" />
                                    <div class="arrow"></div>
                                    <div class="team-member-info">
                                        <ul>
                                            <li><h2>{{ $board[$i]->name }}</h2></li>
                                            <li><h3>{{ $board[$i]->position }}</h3></li>
                                        </ul>
                                        <p>{{ $board[$i]->description }}</p>
                                        <ul class="social-personal">
                                            <li><a href="{{ $board[$i]->twitter_link }}">Twitter</a><span>/</span></li>
                                            <li><a href="{{ $board[$i]->facebook_link }}">Facebook</a></li>
                                        </ul>
                                    </div><!--END TEAM-MEMBER-INFO-->
                                </div><!--END ONE-THIRD LAST-->
                            @else
                                <div class="one-third team">
                                    <img src="{{ $board[$i]->image_url }}" alt="" />
                                    <div class="arrow"></div>
                                    <div class="team-member-info">
                                        <ul>
                                            <li><h2>{{ $board[$i]->name }}</h2></li>
                                            <li><h3>{{ $board[$i]->position }}</h3></li>
                                        </ul>
                                        <p>{{ $board[$i]->description }}</p>
                                        <ul class="social-personal">
                                            <li><a href="{{ $board[$i]->twitter_link }}">Twitter</a><span>/</span></li>
                                            <li><a href="{{ $board[$i]->facebook_link }}">Facebook</a></li>
                                        </ul>
                                    </div><!--END TEAM-MEMBER-INFO-->
                                </div><!--END ONE-THIRD LAST-->
                            @endif

                        @endfor

                    @endif
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
                                    <option value = "VICE-PRESIDENT">VICE-PRESIDENT</option>
                                    <option value = "TREASURER">TREASURER</option>
                                    <option value = "SECRETARY">SECRETARY</option>
                                    <option value = "BOARD MEMBER">BOARD MEMBER</option>
                                </select>
                                <h3>year</h3>
                                <select class="fullWidth" name="adminBoardYear" id="adminBoardYear">
                                    <option value = "2010">2010</option>
                                    <option value = "2011">2011</option>
                                    <option value = "2012">2012</option>
                                    <option value = "2013">2013</option>
                                    <option value = "2014">2014</option>
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
                                <option data-image="{{$member->image_url}}" data-caption="{{$member->description}}" data-facebook="{{$member->facebook_link}}" data-twitter="{{$member->twitter_link}}" data-position="{{$member->position}}" value="{{$member->id}}">{{$member->name}}</option>
                                @endforeach
                            </select>

                            <input type="button" class="adminMyButton1" onclick="UpdateBoardMember()" value = "Save Edits" />
                            <input type="button" class="adminMyButton1" value = "Delete Item" />

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
    </div> <!--END WRAPPER
@endsection