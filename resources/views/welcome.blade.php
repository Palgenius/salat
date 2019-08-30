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
		    font-size:3.8vw;
		    padding-right: 10%;
            float: right;
		}
		.list-times li .time{
			color: blue;
		    font-size: 3.8vw;
		    padding-right: 10%;
            float: left;
		}
		.prayer-times{
			line-height: 2;
            font-size: 4vw;
		}
        body{
            background: url('http://localhost/salat/public/img/bg.png');
            background-size: cover;
            font-family:'Tajawal Regular' !important;
            font-weight: Bold !important;
            font-size:2vw !important;
        }
        #ctime, #hijri, #melady{
            color: white;
            font-size: 2.5vw;
            font-weight: Bold !important;
        }
        #ctime{
            padding-top: 5px;
            padding-bottom: 5px;
            border: 2px solid  #f8fafc;
            box-sizing: content-box;
            width: 25%;
            margin: auto;
            background-color: rgba(255,255,255,0.15);
            border-radius: 10px;
        }
        .area-element{
            font-size: 2vw;
            margin:auto;
            vertical-align:middle;
        }
        .area{
            box-sizing: content-box;
            height: 20vw;
            background-color: azure;
            opacity: 0.8;
            box-shadow: 0px 2px 10px #888888;
            text-align:center;

        }
        .div-times{
            height: 100vh;
            background-color: rgba(240,255,255,.5);
            opacity: 0.8;
            box-shadow: 0px 2px 10px #888888;
        }
        .mosque-name{
            font-size: 4em;
            color: #7c1a17;
            text-shadow: 2px 0px #f8fafc;
        }
	</style>


</head>
<body>
	<div class="container-fluid">
		<div class='row'>
			<div class="col-lg-4 div-times">
                <br>
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
            <div class="col-lg-1">
            </div>
			<div class="col-lg-6">
                <h1 class="text-center mosque-name"> مسجد بدر </h1>
				<h1 class="text-center" id="ctime"> </h1>
				<h1 class="text-center"> <span id="hijri"></span> | <span id="melady"></span></h1>
                  <br>
                    <div id='area' class="area">

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
                    $("#ctime").text(((response.data.carbon.hour>12)?(response.data.carbon.hour-12):response.data.carbon.hour)+':'+response.data.carbon.minute+':'+response.data.carbon.second
                        +((response.data.carbon.hour>12)?" م ":" ص ")
                    );
                    $("#hijri").text(response.data.hijri);
                    $("#melady").text(formatDate(response.data.carbon.formatted));
                    $(".list-times li").remove();
                    $.each(response.data.ar_times,function(index, item) {
                        $(".list-times").append('<li><span class="time">' +((item.value.length<5)?"0":"")+item.value+ '</span><span class="name">'+ item.key +'</span></li>');
                    });
                    if( response.data.eqamaAfter){
                        if(response.data.eqamaAfter.type=='s' && response.data.eqamaAfter.value == 10) azan();
                        $("#area").html(
                            '<h3  class="area-element" > '+'الوقت المتبقي لاقامة صلاة '+response.data.eqamaAfter.key+'</h3>'+
                            '<h3  class="area-element" style="color: red;"> '+((response.data.eqamaAfter.type=='s')? 'ثانية ' : 'دقيقة ' )+response.data.eqamaAfter.value+'</h3>');
                    }

                    if( response.data.adanAfter){
                        if(response.data.adanAfter.type=='s' && response.data.adanAfter.value == 10) azan();

                        $("#area").html(
                            '<h3  class="area-element" > '+'الوقت المتبقي لصلاة '+response.data.adanAfter.key+'</h3>'+
                            '<h3  class="area-element" style="color: red;"> '+((response.data.adanAfter.type=='s')? 'ثانية ' : 'دقيقة ' )+response.data.adanAfter.value+'</h3>');
                    }
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {

                });
            }, 1000);

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
