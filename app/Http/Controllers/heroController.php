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
        $time = Carbon::now(new \DateTimeZone('Europe/Zagreb'));
        $time2 = Carbon::now(new \DateTimeZone('Europe/Zagreb'));
        $modifiedMutable = $time2->addMinutes(1);

        Stat::find($id)->update(['questTime'=>$time,'questDTime'=>$modifiedMutable,'heroQuest'=>1]);


        // $interval = Carbon::now()->diffInSeconds($time);

    }
}
