<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model {

	//
    public static function retreiveCompleteYearlist($currentYear)
    {
        //get minimum
        $record=BoardMember::whereRaw('year = (select min(`year`) from board_members)')->first();
       if($record!=null)
       {
           $min=$record->year;
       }
       else{
           $min=$currentYear;
       }
        $years = array();
        for($i=$min;$i<=$currentYear+1;$i++)
        {
            $years[]=$i;
        }
        //dd($years);
        return $years;
    }
    public static function sortCustom($boardMemberCollection)
    {
       // usort($boardMemberCollection,
         //   function ($a,$b) {
           //     if ($a->postion == 'PRESIDENT') {
             //       return 1;
       //         } elseif ($a->position == 'VICE PRESIDENT' && $b->position != 'PRESIDENT') {
         //           return 1;
             //   } elseif ($a->position == 'TREASURER' && $b->position != 'PRESIDENT' && $b->position != 'VICE PRESIDENT') {
           //         return 1;
            //    } else {
            //        return -1;
            //    }
         //   });

        $boardMemberCollection->sort(
            function ($a,$b) {

                if ($a->position == 'PRESIDENT') {
                    return -1;
                } elseif ($a->position == 'VICE PRESIDENT' && $b->position != 'PRESIDENT') {

                    return -1;
                } elseif ($a->position == 'TREASURER' && $b->position != 'PRESIDENT' && $b->position != 'VICE PRESIDENT') {

                    return -1;
                }elseif ($a->position == 'SECRETARY' && $b->position != 'PRESIDENT' && $b->position != 'VICE PRESIDENT' && $b->position != 'TREASURER'){
                    return 0;
                }
                else {

                    return 1;
                }
            }

        );



      //
    }


}
