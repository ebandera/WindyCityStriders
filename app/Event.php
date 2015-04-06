<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class Event extends Model {

    public function getDates()
    {

        $res=parent::getDates();
        array_push($res,"event_date");
        return $res;

    }//



}
