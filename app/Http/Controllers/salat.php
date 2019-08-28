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
        Date::setTranslation(new Arabic());
        $todayHijri=Date::today()->format('l d F o', Date::INDIAN_NUMBERS);;
        $carbon =Carbon::now()->toArray();
        return response()->json(['times'=>$times,'hijri'=>$todayHijri,'carbon'=>$carbon]);
    }
}
