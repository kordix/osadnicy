<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stat;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonImmutable;




class heroController extends Controller
{
    public function quest(){
        $id=Auth::id();

        $time = Carbon::now();
        $time2 = Carbon::now();
        $modifiedMutable = $time2->addMinutes(5);

        Stat::find($id)->update(['questTime'=>$time,'questDTime'=>$modifiedMutable,'heroQuest'=>1]);


        // $interval = Carbon::now()->diffInSeconds($time);

    }
}
