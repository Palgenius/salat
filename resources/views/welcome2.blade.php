<!DOCTYPE html>
<html>
<head>
	<title>Prayer</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
				<h2 class="text-center"> 12:45 </h2>
				<h2 class="text-center"> 1441/01/26 | 2019/08/27 </h2>
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
			/*axios.get('https://jsonplaceholder.typicode.com/todos/1')
			  .then(function (response) {
			    // handle success
			    console.log(response.data);
			  })
			  .catch(function (error) {
			    // handle error
			    console.log(error);
			  })
			  .finally(function () {
			    
			  });*/
		});
	</script>
</body>



</html>
