@extends('pages.basicapp')

@section('content')
    <div id="wrapper">

        <!-- START HOME -->

        <div class="content-wrapper clear">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading basicFontHeading">Reset Password</div><br>
                            <div class="panel-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form class="form-horizontal" role="form" method="POST" action="/password/reset">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group">
                                        <label class="basicFont">E-Mail Address</label>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="basicFont">Password</label>
                                        <div class="col-md-6">
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="basicFont">Confirm Password</label>
                                        <div class="col-md-6">
                                            <input type="password" class="form-control" name="password_confirmation">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="basicFont">
                                            <button type="submit" class="btn btn-primary">
                                                Reset Password
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
