<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
<link href="{{asset('/public/frontend/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="{{asset('/public/admin/css/font-awesome.min.css')}}">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('/public/frontend/js/jquery.min.js')}}"></script>
<!-- Custom Theme files -->
<!--theme-style-->
<link href="{{asset('/public/frontend/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Sport Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--fonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="{{asset('/public/js/myscript.js')}}"></script>

<!--//fonts-->
<link rel="stylesheet" href="{{asset('/public/frontend/css/etalage.css')}}">
<script src="{{asset('/public/frontend/js/jquery.etalage.min.js')}}"></script>
		<script>
			jQuery(document).ready(function($){

				$('#etalage').etalage({
					thumb_image_width: 300,
					thumb_image_height: 400,
					source_image_width: 900,
					source_image_height: 1200,
					show_hint: true,
					click_callback: function(image_anchor, instance_id){
						alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
					}
				});

			});
		</script>
</head>
<body> 