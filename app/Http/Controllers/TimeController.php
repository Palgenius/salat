<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TimeController extends Controller
{

    public function index(){
        $config= [];
        if(Storage::disk('local')->exists('config.json'))
            $config= json_decode(Storage::disk('local')->get('time.json'));

        return view('setTime')->with(compact('config'));

    }

    public function submit(Request $request){
      //2019-09-10T04:04
       if($request->input('time')) {
           $tz = 'GMT+3';
           $t = new  Carbon($request->input('time'));
           $n = Carbon::now($tz);

           $d = $t->diffInMinutes($n . '');
           $request['type'] = 'add';
           if ($t->addMinute($d)->diffInMinutes($n . '') == 0) {
               $request['type'] = 'sub';
           }
           $request['deference'] = $d;
       }
        Storage::disk('local')->put('time.json',json_encode($request->all()));

        // return response()->json($request->all());
        return response('<script type="text/javascript"> alert("تمت العملية بنجاح"); 
window.location.replace("'.route('time').'");  </script>');
    }
}
