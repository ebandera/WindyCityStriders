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

                <?php $index=0; ?>
                @foreach($board as $member)
                    @if($index==0) <div class="one-half">
                    @elseif($index==1) <div class="one-half last">
                    @elseif($index%3==1) <div class="one-third last">
                    @else <div class="one-third">@endif
                    <img src="{{ $member->image_url }}" alt="" />

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


            </div><!--END CONTENT-WRAPPER-->

            <!-- END ABOUT -->

        </div><!--END WRAPPER-->
@endsection