@extends('emails.template')
@section('content')









        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
            <tr>
                <td align="center" valign="top">
                    <h2>Windy City Striders Website Contact from {{$name}}!</h2>
                    <table cellpadding="20" cellspacing="0" width="600" id="emailContainer">
                        <tr>
                            <th colspan = "2" style="background-color:#2233AA;color:white;border-radius:10px;">Running the the heart of Casper Wyoming!</th>
                        </tr>

                        <tr>
                            <td style="font-size:14px;font-weight:bold;color:#2233AA;font-style:italic"  align="left" valign="top" width="20%">
                                Name
                            </td>
                            <td align = "left" valign="top" width="80%">
                                {{$name}}
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:14px;font-weight:bold;color:#2233AA;font-style:italic"  align="left" valign="top" width="20%">
                                Email
                            </td>
                            <td align = "left" valign="top" width="80%">
                                {{$em}}
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:14px;font-weight:bold;color:#2233AA;font-style:italic"  align="left" valign="top" width="20%">
                               Url
                            </td>
                            <td align = "left" valign="top" width="80%">
                                {{$url}}
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:14px;font-weight:bold;color:#2233AA;font-style:italic"  align="left" valign="top" width="20%">
                                Message
                            </td>
                            <td align = "left" valign="top" width="80%">
                                {{$msg}}
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>








@endsection
