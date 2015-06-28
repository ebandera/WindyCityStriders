@extends('pages.app')

@section('content')

    <div id="wrapper">

        <!-- START ABOUT -->

        <div class="content-wrapper clear">
            <div class="myareacontainer" >
                <div class="datagrid"><table id="resultsTable">
                        <thead><tr><th>Name</th><th>Email</th><th>Type</th><th>Action</th></tr></thead>
                        <tfoot><tr><td colspan="4"><div id="paging"></div></tr></tfoot>
                        <tbody>
                        @if($unapprovedUsers!=null)
                            @foreach($unapprovedUsers as $index=>$unapprovedUser)
                                <tr @if($index%2==1) class="alt"@endif>
                                    <td>{{$unapprovedUser->name}}</td>
                                    <td>{{$unapprovedUser->email}}</td>
                                    <td>@if($unapprovedUser->user_profile=='admin')
                                        <input type="radio" name = "type{{$unapprovedUser->id}}" value="admin" checked /> Administrator<br>
                                        <input type="radio" name = "type{{$unapprovedUser->id}}" value="member" /> Member</td>
                                        @else
                                        <input type="radio" name = "type{{$unapprovedUser->id}}" value="admin" /> Administrator<br>
                                        <input type="radio" name = "type{{$unapprovedUser->id}}" value="member" checked/> Member</td>
                                    @endif


                                    <td><input type="button" value="approve" onclick="ApproveUser({{$unapprovedUser->id}})"/>
                                        <input type="button" value="erase" onclick="EraseUser({{$unapprovedUser->id}})"/>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table></div>



            </div>

            </div><!--END CONTENT-WRAPPER-->

            <!-- END ABOUT -->

        </div><!--END WRAPPER-->

@endsection