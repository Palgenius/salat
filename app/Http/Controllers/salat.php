<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GeniusTS\HijriDate\Date;
use GeniusTS\HijriDate\Translations\Arabic;
use Illuminate\Http\Request;
use IslamicNetwork\PrayerTimes\Method;
use IslamicNetwork\PrayerTimes\PrayerTimes;

class salat extends Controller
{
    public  function index(){
        $p = new PrayerTimes(Method::METHOD_EGYPT,PrayerTimes::SCHOOL_STANDARD);
        $times=$p->getTimesForToday(31.418889,34.351667,'GMT+3',null,PrayerTimes::LATITUDE_ADJUSTMENT_METHOD_ANGLE,PrayerTimes::MIDNIGHT_MODE_STANDARD,PrayerTimes::TIME_FORMAT_12hNS);
       // $today=Carbon::now()->toDateString();
       $ar_times=[
           ['key'=>'الفجر','value'=>$times['Fajr']],
           ['key'=>'الشروق','value'=>$times['Sunrise']],
           ['key'=>'الظهر','value'=>$times['Dhuhr']],
           ['key'=>'العصر','value'=>$times['Asr']],
           ['key'=>'المغرب','value'=>$times['Maghrib']],
           ['key'=>'العشاء','value'=>$times['Isha']]
        ];
               Date::setTranslation(new Arabic());
        $todayHijri=Date::today()->format('l d F o', Date::INDIAN_NUMBERS);;
        $carbon =Carbon::now('GMT+3')->toArray();
        $array=['ar_times'=>$ar_times,'times'=>$times,'hijri'=>$todayHijri,'carbon'=>$carbon];

        $timenow = Carbon::now('GMT+3')->toArray()['hour'] * 60 +  Carbon::now()->toArray()['minute'];

            $fajr=intval(explode(':',$times['Fajr'])[0])*60 +  intval(explode(':',$times['Fajr'])[1]);
            $dhuhr=intval(explode(':',$times['Dhuhr'])[0])*60 +  intval(explode(':',$times['Dhuhr'])[1]);
            $asr=(intval(explode(':',$times['Asr'])[0])+12)*60 +  intval(explode(':',$times['Asr'])[1]);
            $maghrib=(intval(explode(':',$times['Maghrib'])[0])+12)*60 +  intval(explode(':',$times['Maghrib'])[1]);
            $isha=(intval(explode(':',$times['Isha'])[0])+12)*60 +  intval(explode(':',$times['Isha'])[1]);
        if(
            $fajr == $timenow ||  $dhuhr == $timenow ||  $asr == $timenow ||  $maghrib == $timenow ||  $isha == $timenow
            ){
            $array['adanAfter']=60 - Carbon::now('GMT+3')->toArray()['second'];
        }

        if(
            $maghrib < $timenow  &&  $maghrib+10 > $timenow
        ){
              $before = $maghrib + 10 - $timenow  ;
            if($before==1)$before =60 - Carbon::now('GMT+3')->toArray()['second'];
            $array['eqamaAfter']= $before;
        }
        if(
            $isha < $timenow  && $isha+10 > $timenow
        ){
            $before = $timenow+10 - $fajr  ;
            if($before==1)$before =60 - Carbon::now('GMT+3')->toArray()['second'];
            $array['eqamaAfter']= $before;
        }

        if(
          $fajr < $timenow  &&  $fajr+20 > $timenow
        ){
            $before = $timenow+20 - $fajr  ;
            if($before==1)$before =60 - Carbon::now('GMT+3')->toArray()['second'];
            $array['eqamaAfter']= $before;
        }

        if(

            $dhuhr < $timenow   &&  $dhuhr+20 > $timenow
        ){
            $before = $dhuhr+20 - $timenow  ;
            if($before==1)$before =60 - Carbon::now('GMT+3')->toArray()['second'];
            $array['eqamaAfter']= $before;
        }

        if(
            $asr < $timenow   && $asr + 20 > $timenow
        ){

            $before =   $asr+20  - $timenow;
            if($before==1)$before =60 - Carbon::now('GMT+3')->toArray()['second'];
            $array['eqamaAfter']= $before;
        }

        return response()->json($array);
    }
}
