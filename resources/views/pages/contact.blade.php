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
                        $('#bra-map').bra_google_map({location: '5713 S Moody, Chicago, IL 60638', zoom: 12});
                    });

                </script>
                <p><strong>Contact info</strong><br />
                    Address: P.O. Box 52161 Casper, WY<br />
                    Email: <a href="#"> email@windycitystriders.com</a></p>

            </div><!--END ONE-HALF-->


            <div class="one-half last">

                <h3 class="title">Send us a message</h3>

                <form action="./sendMessage" id="contact-form" class="form" method="get">
                    <ul>
                        <li>
                            <p><strong>Name</strong> <em>(*)</em></p>
                            <input name="name" type="text" class="requiredField" />
                        </li>

                        <li>
                            <p><strong>E-mail</strong> <em>(*)</em></p>
                            <input name="email" type="text" class="requiredField email" />
                        </li>

                        <li>
                            <p><strong>URL</strong> <em>(Optional)</em></p>
                            <input name="url" type="text" />
                        </li>

                        <li>
                            <p><strong>Message</strong> <em>(*)</em></p>
                            <textarea name="message" rows="20" cols="30" class="requiredField"></textarea>
                        </li>

                        <li class="submit-button">
                            <input name="submit" id="submitted" value="Send Message" class="submit" type="submit" />
                        </li>
                    </ul>
                </form><!--END CONTACT FORM-->

            </div><!--END ONE-HALF LAST-->

        </div><!--END CONTENT-WRAPPER-->

        <!-- END CONTACT -->

    </div><!--END WRAPPER-->


@endsection