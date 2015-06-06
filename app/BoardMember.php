<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model {

	//
    public static function retreiveCompleteYearlist($currentYear)
{
    //get minimum
    $record=BoardMember::whereRaw('year = (select min(`year`) from board_members)')->first();
    $min=$record->year;
    $years = array();
    for($i=$min;$i<=$currentYear;$i++)
    {
        $years[]=$i;
    }
    //dd($years);
    return $years;
}

}
