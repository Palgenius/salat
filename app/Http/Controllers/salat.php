<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GeniusTS\HijriDate\Date;
use GeniusTS\HijriDate\Translations\Arabic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use IslamicNetwork\PrayerTimes\Method;
use IslamicNetwork\PrayerTimes\PrayerTimes;

class salat extends Controller
{
    public  function index(){

        $shortWait=10;
        $longWait=20;
        $increasDicrease=[0,-1,-1,-1,2,-1];
        $tz='GMT+3';
        if(Storage::disk('local')->exists('config.json'))
        {
            $config= json_decode(Storage::disk('local')->get('config.json'));
            $shortWait=$config->shortTime;
            $longWait=$config->longTime;
            $increasDicrease=[
                $config->Fajr,
                $config->Sunrise,
                $config->Dhuhr,
                $config->Asr,
                $config->Maghrib,
                $config->Isha];
            if(Str::startswith ($config->tz,'GMT+'))$tz=$config->tz;
        }


        $p = new PrayerTimes(Method::METHOD_EGYPT,PrayerTimes::SCHOOL_STANDARD);
        $p->tune($imsak = 0, $fajr= $increasDicrease[0], $sunrise = $increasDicrease[1], $dhuhr =$increasDicrease[2],
            $asr = $increasDicrease[3], $maghrib = $increasDicrease[4], $sunset = 0, $isha = $increasDicrease[5], $midnight = 0);

        $times=$p->getTimesForToday(31.40,34.36,$tz,null,PrayerTimes::LATITUDE_ADJUSTMENT_METHOD_ANGLE,PrayerTimes::MIDNIGHT_MODE_STANDARD,PrayerTimes::TIME_FORMAT_12hNS);

        $times=$p->getTimes(Carbon::now($tz)->subDay(5),31.40,34.36,null,PrayerTimes::LATITUDE_ADJUSTMENT_METHOD_ANGLE,PrayerTimes::MIDNIGHT_MODE_STANDARD,PrayerTimes::TIME_FORMAT_12hNS);

        $fajr=intval(explode(':',$times['Fajr'])[0])*60 +  intval(explode(':',$times['Fajr'])[1]);
        $dhuhr=intval(explode(':',$times['Dhuhr'])[0])*60 +  intval(explode(':',$times['Dhuhr'])[1]);
        $sunrise=intval(explode(':',$times['Sunrise'])[0])*60 +  intval(explode(':',$times['Sunrise'])[1]);
        $asr=(intval(explode(':',$times['Asr'])[0])+12)*60 +  intval(explode(':',$times['Asr'])[1]);
        $maghrib=(intval(explode(':',$times['Maghrib'])[0])+12)*60 +  intval(explode(':',$times['Maghrib'])[1]);
        $isha=(intval(explode(':',$times['Isha'])[0])+12)*60 +  intval(explode(':',$times['Isha'])[1]);


        $ar_times=[
           ['key'=>'الفجر ','value'=>$times['Fajr'],'integer'=>$fajr,'wait'=>$longWait],
           ['key'=>'الشروق','value'=>$times['Sunrise'],'integer'=>$sunrise,'wait'=>$longWait],
           ['key'=>'الظهر ','value'=>$times['Dhuhr'],'integer'=>$dhuhr,'wait'=>$longWait],
           ['key'=>'العصر ','value'=>$times['Asr'],'integer'=>$asr,'wait'=>$longWait],
           ['key'=>'المغرب','value'=>$times['Maghrib'],'integer'=>$maghrib,'wait'=>$shortWait],
           ['key'=>'العشاء','value'=>$times['Isha'],'integer'=>$isha,'wait'=>$shortWait]
        ];


        Date::setTranslation(new Arabic());
        $todayHijri=Date::today()->format('l d F o', Date::INDIAN_NUMBERS);;
        $carbon =Carbon::now($tz)->toArray();
        $array=['ar_times'=>$ar_times,'times'=>$times,'hijri'=>$todayHijri,'carbon'=>$carbon];
        $timenow =  Carbon::now($tz)->toArray()['hour'] * 60 +  Carbon::now($tz)->toArray()['minute'];
        //$timenow = $maghrib+9;



        $array['tz']=$tz;

      foreach ($ar_times as $item){
             if($item['integer']-1 ==$timenow ){
                 $array['adanAfter']=['value'=>60 - Carbon::now($tz)->toArray()['second'],'type'=>'s','key'=>$item['key']];
                break;
             }
            if ($this->isComingEqama($item['integer'], $item['wait'], $timenow)) {
                $array['eqamaAfter'] = $this->calcolateEqama($item['integer'], $item['wait'], $timenow,$item['key'],$tz);
                break;
            }
        }
        return response()->json($array);
    }

    /**
     * @param $adan
     * @param $wiat
     * @param $timenow
     * @return bool
     */
    function  isComingEqama($adan, $wiat, $timenow){
       return $adan <= $timenow   && $adan + $wiat > $timenow ;
    }

    /**
     * @param $adan
     * @param $wiat
     * @param $timenow
     * @return array
     */
    function  calcolateEqama($adan, $wiat, $timenow,$key,$tz){
        $before =   $adan+$wiat  - $timenow;
        $type='m';
        if($before==1){$before =60 - Carbon::now($tz)->toArray()['second'];
            $type='s';
        }
        return ['value'=>$before,'type'=>$type,'key'=>$key];
    }


    public function admin(){
        $config= [];
        if(Storage::disk('local')->exists('config.json'))
            $config= json_decode(Storage::disk('local')->get('config.json'));

        return view('home')->with(compact('config'));
    }
    public function submit(Request $request){

       // return response(json_encode($request->all()));
      Storage::disk('local')->put('config.json',json_encode($request->all()));

      return response('<script type="text/javascript"> alert("تمت العملية بنجاح"); 
window.location.replace("'.route('admin').'");  </script>');
    }
}
