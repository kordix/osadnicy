<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Stat;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        // dd(Auth::id());
    }

    public function index()
    {
        $id=Auth::id();

        return view('index2');
    }

    public function getUserId(){
        return auth()->guard('api')->user();
    }

    public function getStats(){
        $id = Auth::id();
        return $user = User::find($id)->stats()->get();
    }


    public function upgrade(Request $request){
        $id = Auth::id();

        Stat::find($id)->update($request->all());
    }


    public function updatestats(Request $request)
    {
        $id = Auth::id();
        $time = Stat::find($id)->updated_at;
        $wood = Stat::find($id)->wood;
        $woodfactor = Stat::find($id)->woodfactor;
        $stone = Stat::find($id)->stone;
        $stonefactor = Stat::find($id)->stonefactor;
        $iron = Stat::find($id)->iron;
        $ironfactor = Stat::find($id)->ironfactor;

        $interval = Carbon::now()->diffInSeconds($time);
        $woodamount = $interval * $woodfactor;
        $stoneamount = $interval * $stonefactor;
        $ironamount = $interval * $ironfactor;


        Stat::find($id) ->update([
            'wood' => $wood += $woodamount,
            'stone' => $stone += $stoneamount,
            'iron' => $iron += $ironamount,
        ]);
    }

    public function edit()
    {
        $id=Auth::id();

        $time = Stat::find($id)->updated_at;

        return view('edit', compact('time'));
    }

    public function reset(){
        $id=Auth::id();

        Stat::find($id)->update([
            'wood' => 0,
            'woodfactor'=>0.01,
            'iron'=>0,
            'ironfactor'=>0.01,
            'stone'=>0,
            'stonefactor'=>0.01,
            'ironLevel'=>1,
            'stoneLevel'=>1,
            'woodLevel'=>1
        ]);
    }
}
