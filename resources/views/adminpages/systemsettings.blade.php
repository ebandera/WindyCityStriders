
@extends('pages.app')

@section('content')

    <div id="wrapper">



        <!-- START Sponsors -->

        <div class="content-wrapper clear">

            <div class="section-title">

                <h1 class="title">System Settings </h1>


            </div><!--END SECTION TITLE-->

            <div id="inner-content" class="blog1">
                <form id="systemSettingsForm">
                @foreach($settings as $setting)
                    <div class="one-third">{{$setting->key}}</div>
                    <div class="two-third last"><input type = "text" id="{{$setting->key}}" value="{{$setting->value}}" /></div>
                @endforeach
                    <input type="button" value="Save Edits" onclick="SaveSystemSettings()" />
                </form>
            </div><!--END INNER CONTENT-->

        </div><!--END CONTENT-WRAPPER-->

        <!-- END BLOG -->

    </div><!--END WRAPPER-->


@endsection