<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Faker\Provider\File;
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
	
		$weekMap = [
    0 => 'السَّبْت',
    1 => 'الْأحَدُ',
    2 => 'الْاِثْنَيْنُ',
    3 => 'الثُّلاثاء',
    4 => 'الْأَرْبِعَاءُ',
    5 => 'الْخَمِيسُ',
    6 => 'الْجمعةُ',
];








        $array=[];
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
            if(isset($config->area))$array['area']=$config->area;
            if(isset($config->backgroundPath))$array['background']=$config->backgroundPath;

        }

       $now=Carbon::now($tz);
        if(Storage::disk('local')->exists('time.json')) {
            $config = json_decode(Storage::disk('local')->get('time.json'));
            \GeniusTS\HijriDate\Hijri::setDefaultAdjustment($config->higri);
           if($config->time) {
               if ($config->type == 'add') {
                   $now=$now->addMinute($config->deference);
               }
               else{
                   $now=$now->subMinute($config->deference);
               }
           }
        }
        Date::setTranslation(new Arabic());
        $todayHijri= \GeniusTS\HijriDate\Hijri::convertToHijri($now)->format('d F o', Date::ARABIC_NUMBERS);;











        if(!array_key_exists('background',$array))$array['background']='url("http://localhost/salat/public/img/bg.png")';

        $p = new PrayerTimes(Method::METHOD_EGYPT,PrayerTimes::SCHOOL_STANDARD);
        $p->tune($imsak = 0, $fajr= $increasDicrease[0], $sunrise = $increasDicrease[1], $dhuhr =$increasDicrease[2],
            $asr = $increasDicrease[3], $maghrib = $increasDicrease[4], $sunset = 0, $isha = $increasDicrease[5], $midnight = 0);

        $times=$p->getTimesForToday(31.40,34.36,$tz,null,PrayerTimes::LATITUDE_ADJUSTMENT_METHOD_ANGLE,PrayerTimes::MIDNIGHT_MODE_STANDARD,PrayerTimes::TIME_FORMAT_12hNS);

       // $times=$p->getTimes($now->subDay(5),31.40,34.36,null,PrayerTimes::LATITUDE_ADJUSTMENT_METHOD_ANGLE,PrayerTimes::MIDNIGHT_MODE_STANDARD,PrayerTimes::TIME_FORMAT_12hNS);

        $fajr=intval(explode(':',$times['Fajr'])[0])*60 +  intval(explode(':',$times['Fajr'])[1]);
        $dhuhr=intval(explode(':',$times['Dhuhr'])[0])*60 +  intval(explode(':',$times['Dhuhr'])[1]);
        $sunrise=intval(explode(':',$times['Sunrise'])[0])*60 +  intval(explode(':',$times['Sunrise'])[1]);
        $asr=(intval(explode(':',$times['Asr'])[0])+12)*60 +  intval(explode(':',$times['Asr'])[1]);
        $maghrib=(intval(explode(':',$times['Maghrib'])[0])+12)*60 +  intval(explode(':',$times['Maghrib'])[1]);
        $isha=(intval(explode(':',$times['Isha'])[0])+12)*60 +  intval(explode(':',$times['Isha'])[1]);


        $ar_times=[
           ['key'=>'الفجر','value'=>$times['Fajr'],'integer'=>$fajr,'wait'=>$longWait],
           ['key'=>'الشروق','value'=>$times['Sunrise'],'integer'=>$sunrise,'wait'=>$longWait],
           ['key'=>'الظهر','value'=>$times['Dhuhr'],'integer'=>$dhuhr,'wait'=>$longWait],
           ['key'=>'العصر','value'=>$times['Asr'],'integer'=>$asr,'wait'=>$longWait],
           ['key'=>'المغرب','value'=>$times['Maghrib'],'integer'=>$maghrib,'wait'=>$shortWait],
           ['key'=>'العشاء','value'=>$times['Isha'],'integer'=>$isha,'wait'=>$shortWait]
        ];


       $carbon =$now->toArray();
	   $dayOfTheWeek = $carbon['dayOfWeek'];
       $array['day']= $weekMap[$dayOfTheWeek];
	   
        $array['ar_times']=$ar_times;
        $array['times']=$times;
        $array['hijri']=$todayHijri;
        $array['carbon']=$carbon;
        $timenow = $now->toArray()['hour'] * 60 +  $now->toArray()['minute'];

       // $timenow = $dhuhr+19;
       // $timenow = $fajr+45;
        
         $array['showModal']=false;
         $array['imageModal']=	"<img src=\"http://localhost/salat/public/img/dsds.png\"  width=\"100%\" height=\"100%\"> ";


        $array['tz']=$tz;

      foreach ($ar_times as $item){
             if($item['integer']-1 ==$timenow ){
                 $array['adanAfter']=['value'=>60 - $now->toArray()['second'],'type'=>'s','key'=>$item['key']];
              //  break;
             }
            if ($this->isComingEqama($item['integer'], $item['wait'], $timenow)) {
				if($dayOfTheWeek== 6 &&  $item['key']=='الظهر')
				{}else{
                $array['eqamaAfter'] = $this->calcolateEqama($item['integer'], $item['wait'], $timenow,$item['key'],$now);
				}
            }
			if ($this->adkar($item['integer'], $item['wait'], $timenow)){
				 $array['showModal']=true;
			if( $item['key']=='الفجر' || $item['key']=='المغرب'){
			  $array['imageModal']=	"<img src=\"http://localhost/salat/public/img/sab.jpg\"  width=\"100%\" height=\"100%\"> ";
			}
			
			}
		
        }
        return response()->json($array);
    }
     
	 function adkar($adan, $wiat, $timenow){
		 return $adan + $wiat + 7 <= $timenow && $adan + $wiat + 27 >  $timenow; 
		 
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
    function  calcolateEqama($adan, $wiat, $timenow,$key,$now){
        $before =   $adan+$wiat  - $timenow;
        $type='m';
        if($before==1){$before =60 - $now->toArray()['second'];
            $type='s';
        }
        return ['value'=>$before,'type'=>$type,'key'=>$key];
    }





    ////////////////

    public function admin(){
        $config= [];
        if(Storage::disk('local')->exists('config.json'))
            $config= json_decode(Storage::disk('local')->get('config.json'));

        return view('home')->with(compact('config'));
    }




    public function submit(Request $request){
        if($request->hasFile('background')){
            $name='background_'.time().'.'.$request->file('background')->extension();
            Storage::disk('site')->put($name, $request->file('background')->get());
            $request['backgroundPath']= 'url("'.route('base').Storage::disk('site')->url($name).'")';
        }
        if($request->input('options')== 'image' && $request->hasFile('image')){
            $name='area'.time().'.'.$request->file('image')->extension();
          Storage::disk('site')->put($name, $request->file('image')->get());

            $request['area']= '   <img src="'.route('base').Storage::disk('site')->url($name).'"  width="100%" height="100%"> ';
        }
        if($request->input('options')== 'video' /*&& $request->hasFile('video')*/){
            $name='area.'.$request->file('video')->extension();
          //  Storage::disk('site')->put($name, $request->file('vedio')->get());
            ////    return response($request->file('video'));
         //   $request['area']= '<video width="100%" height="100%" autoplay>   <source src="'.route('base').Storage::disk('site')->url($name).'" type="video/mp4"> </video>';

        }
        if($request->input('options')== 'text' && $request->hasFile('text')){

            $request['area']=$request->file('text')->get();
        }
       // return response(json_encode($request->all()));
      Storage::disk('local')->put('config.json',json_encode($request->all()));

     // return response()->json($request->all());
      return response('<script type="text/javascript"> alert("تمت العملية بنجاح"); 
window.location.replace("'.route('admin').'");  </script>');
    }
}
