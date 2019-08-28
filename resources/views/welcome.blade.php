<!DOCTYPE html>
<html>
<head>
	<title>Prayer</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
	<style type="text/css">
		.list-times{
			list-style: none;
    		text-align: center;
		}
		.list-times li .name{
			color: red;
		    font-size: 3em;
		    padding-right: 10%;
            float: left;
		}
		.list-times li .time{
			color: blue;
		    font-size: 3em;
		    padding-right: 10%;
		}
		.prayer-times{
			line-height: 4;
		}
	</style>


</head>
<body>
	<div class="container">
		<div class='row'>
			<div class="col-lg-4">
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
			<div class="col-lg-8">
				<h2 class="text-center" id="ctime"> </h2>
				<h2 class="text-center"> <span id="hijri"></span> | <span id="melady"></span></h2>
				<div class="img-thumble">
					<img class="img img-responsive img-round img-thumble"
					src="abandoned-forest-hd-wallpaper-34950.jpg">
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			// alert('from jquery');
			setInterval(function () {
                axios.get('http://localhost/salat/public/salat')
                .then(function (response) {
                    // handle success
                    console.log(response.data);
                    if(response.data.carbon.hour>12)
                    $("#ctime").text((response.data.carbon.hour-12)+':'+response.data.carbon.minute+':'+response.data.carbon.second);
                    else
                    $("#ctime").text(response.data.carbon.hour+':'+response.data.carbon.minute+':'+response.data.carbon.second);

                    $("#hijri").text(response.data.hijri);
                    $("#melady").text(formatDate(response.data.carbon.formatted));
                    $(".list-times li").remove();
                    $.each(response.data.ar_times,function(index, item) {
                        $(".list-times").append('<li><span class="name">' +item.value+ '</span><span class="time">'+ item.key +'</span></li>');
                    });
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
      src: ['https://ia800709.us.archive.org/14/items/Du3a_uP_bY_mUSLEm/046--_up_by_muslem.mp3'],
      volume: 0.5,
      onend: function () {
        alert('Finished!');
      }
    });
    sound.play()
}
	</script>
</body>



</html>
