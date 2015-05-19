@extends('pages.app')

@section('content')
    <div id="wrapper">

        <!-- START CONTACT -->

        <div class="content-wrapper clear">

            <div class="section-title">

                <h1 class="title">Contact us <span>and lets run!</span></h1>

            </div><!--END SECTION TITLE-->

            <div class="one-half">

                <h3 class="title">Contact information</h3>

                <div id="bra-map" class="google-map"></div><br />
                <script>
                    $(document).ready(function() {
                        $('#bra-map').bra_google_map({location: '{{$sdh->theAddress}}', zoom: 12});
                    });

                </script>
                <p><strong>Contact info</strong><br />
                    {{$sdh->theAddress}}<br />
                    Email: <a href="#"> email@windycitystriders.com</a></p>

            </div><!--END ONE-HALF-->


            <div class="one-half last">

                <h3 class="title">Update Address Information</h3>

                <form action="./sendMessage" id="contact-form" class="form" method="get">
                    <ul>
                        <li>
                            <p><strong>Address</strong> <em>(*)</em></p>
                            <input name="address" id="address" type="text" class="requiredField" />
                        </li>



                        <li class="submit-button">
                            <input name="submit" id="submitted" value="Update" class="submit" type="button" onclick="UpdateAddress()" />
                        </li>
                    </ul>
                </form><!--END CONTACT FORM-->

            </div><!--END ONE-HALF LAST-->

        </div><!--END CONTENT-WRAPPER-->

        <!-- END CONTACT -->

    </div><!--END WRAPPER-->


@endsection