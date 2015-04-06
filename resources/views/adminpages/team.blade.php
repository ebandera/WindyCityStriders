@extends('pages.app')

@section('content')

    <div id="wrapper">

        <!-- START ABOUT -->

        <div class="content-wrapper clear">

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


            </div><!--END CONTENT-WRAPPER-->

            <!-- END ABOUT -->

        </div><!--END WRAPPER-->
@endsection