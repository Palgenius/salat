<!DOCTYPE html>
<html>
<head>
	<title>Prayer</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/howler.min.js') }}"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<!-- Optional theme -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}">
<link rel="stylesheet" href="{{ asset('font/style.css') }}">

    <style type="text/css">
		.list-times{
			list-style: none;
    		text-align: center;
		}
		.list-times li .name{
			color: red;
		    font-size: 3em;
		    padding-right: 10%;
            float: right;
		}
		.list-times li .time{
			color: blue;
		    font-size: 3em;
		    padding-right: 10%;
            float: left;
		}
		.prayer-times{
			line-height: 4;
		}
        body{
            background: url('http://localhost/salat/public/img/bg.png');
            background-size: cover;
            font-family:'Tajawal Regular' !important;
            font-weight: Bold !important;
            font-size:18px !important;
        }
        #ctime, #hijri, #melady{
            color: white;
            font-weight: Bold !important;
        }
	</style>


</head>
<body>
	<div class="container">
		<div class='row'>
			<div class="col-lg-5" style="background-color: azure; opacity: 0.8; box-shadow: 0px 2px 10px #888888;">
				<h2 class="text-center prayer-times"> مواقيت الصلاة </h2>
				<ul class="list-times">
					<li>
						<span class="name"> الفجر </span>
						<span class="time"> 04:51 </span>
					</li>
					<li>
						<span class="name"> الفجر </span>
						<span class="time"> 04:51 </span>
					</li>
					<li>
						<span class="name"> الفجر </span>
						<span class="time"> 04:51 </span>
					</li>
					<li>
						<span class="name"> الفجر </span>
						<span class="time"> 04:51 </span>
					</li>
					<li>
						<span class="name"> الفجر </span>
						<span class="time"> 04:51 </span>
					</li>
					<li>
						<span class="name"> الفجر </span>
						<span class="time"> 04:51 </span>
					</li>
				</ul>
			</div>
			<div class="col-lg-7">
				<h1 class="text-center" id="ctime"> </h1>
				<h1 class="text-center"> <span id="hijri"></span> | <span id="melady"></span></h1>
				<div  id = 'area'>

				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			// alert('from jquery');
			setInterval(function () {
                axios.get("{{ route('salat') }}")
                .then(function (response) {
                    // handle success
                    //console.log(response.data);
                    if(response.data.carbon.hour>12)
                    $("#ctime").text((response.data.carbon.hour-12)+':'+response.data.carbon.minute+':'+response.data.carbon.second);
                    else
                    $("#ctime").text(response.data.carbon.hour+':'+response.data.carbon.minute+':'+response.data.carbon.second);

                    $("#hijri").text(response.data.hijri);
                    $("#melady").text(formatDate(response.data.carbon.formatted));
                    $(".list-times li").remove();
                    $.each(response.data.ar_times,function(index, item) {
                        $(".list-times").append('<li><span class="time">' +((item.value.length<5)?"0":"")+item.value+ '</span><span class="name">'+ item.key +'</span></li>');
                    });
                    if( response.data.eqamaAfter){
                        $("#area").append('<div class="text-center" style="background-color: azure; opacity: 0.8; box-shadow: 0px 2px 10px #888888;" >' +
                            '<span  class="name" > '+response.data.eqamaAfter.key+'الوقت المتبقي لاقامة الصلاة '+'</span>'+
                            '<span  class="name" > '+((response.data.eqamaAfter.type=='s')? 'ثانية ' : 'دقيقة ' )+response.data.eqamaAfter.value+'</span>'+
                            '</div>');
                    }

                    if( response.data.adanAfter){
                        $("#area").append('<div class="text-center" style="background-color: azure; opacity: 0.8; box-shadow: 0px 2px 10px #888888;" >' +
                            '<span  class="name" > '+response.data.adanAfter.key+'الوقت المتبقي لصلاة '+'</span>'+
                            '<span  class="name" > '+((response.data.adanAfter.type=='s')? 'ثانية ' : 'دقيقة ' )+response.data.eqamaAfter.value+'</span>'+
                            '</div>');
                    }
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {

                });
            }, 10000);
            azan();
		});

function formatDate(date) {
    date=new Date(date);
  var monthNames = [
    "يناير", "فبر اير", "مارس",
    "أبريل", "مايو", "يونيو", "يوليو",
    "أغسطس", "سبتمبر", "أكتوبر",
    "نوفيمبر", "ديسمبر"
  ];

  var day = date.getDate();
  var monthIndex = date.getMonth();
  var year = date.getFullYear();

  return day + ' ' + monthNames[monthIndex] + ' ' + year;
}

function azan(){
    var sound = new Howl({
      src: ['{{ asset("mp3/a.mp3") }}'],
      volume: 0.5,
      onend: function () {
      //  alert('Finished!');
      }
    });
    sound.play()
}
	</script>
</body>



</html>
