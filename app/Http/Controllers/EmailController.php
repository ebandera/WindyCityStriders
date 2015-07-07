<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\SystemSetting;
use Request;


class EmailController extends Controller {

	//
    public function contactusemail()
    {
        $input= Request::all();
        $name = $input['name'];
        $email = $input['email'];
        $url = $input['contacturl'];
        $message = $input['message'];
        //populate 2 dimensional array data
        $primaryEmailRow = SystemSetting::where('key','=','primaryWebsiteAdministratorEmail')->first();
        $primaryEmail=$primaryEmailRow->value;


        $data = [
            'name' => $name,
            'em' => $email,
            'url' => $url,
            'msg' => $message
        ];
        var_dump($data);

        \Mail::send(
            'emails.contactusemail',
            $data,
            function( $message ) use($primaryEmail)
            {
                $message->from( 'doNotReply@swcwebsolutions.com' );
                $message->to( $primaryEmail );
                $message->subject( 'Website Feedback From Windy City Striders' );
            }
        );


       return redirect('home');

    }
    public function approveuseremail()
    {
        $input= Request::all();
        $id=$input['id'];
       $user = user::find($id);
        $email = $user->email;
        $name = $user->name;


        $data = [
            'name' => $name,

        ];
        var_dump($data);

        \Mail::send(
            'emails.contactusemail',
            $data,
            function( $message ) use($email)
            {
                $message->from( 'doNotReply@swcwebsolutions.com' );
                $message->to( $email );
                $message->subject( 'Windy City Striders Account Approved!' );
            }
        );


        return redirect('approveLogin');

    }

}
