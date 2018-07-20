@extends('frontend.include.layout')
@section('title','Home')
@section('content')
<div class="banner">
	<div class="container">
		<div class="banner-matter">
			<h1>Get active get running<span>push your limits</h1>
			<div class="out">
				<a href="single.html" class="find">FIND OUT MORE </a>
				<a href="single.html" class="shop">SHOP</a>
				<div class="clearfix"> </div>
			</div>
		</div>	
		</div>
	</div>

<div class="content">
	<div class="sport-your">
<!-- requried-jsfiles-for owl -->
							<link href="{{asset('/public/frontend/css/owl.carousel.css')}}" rel="stylesheet">
							    <script src="{{asset('/public/frontend/js/owl.carousel.js')}}"></script>
							        <script>
									    $(document).ready(function() {
									      $("#owl-demo").owlCarousel({
									        items : 5,
									        lazyLoad : true,
									        autoPlay : true,
									        navigation : true,
									        navigationText :  true,
									        pagination : false,
									      });
									    });
									  </script>
							 <!-- //requried-jsfiles-for owl -->

		<!-- start content_slider -->
		<div class="line1">
	
		</div>
		<div id="example1">
		<div id="owl-demo" class="owl-carousel text-center">
			<div class="item">
				<a href="single.html" title="image" rel="title1">
					<img class="img-responsive " src="{{asset('/public/frontend/images/pic.jpg')}}" alt="">
				<div class="run">
					<i> </i>
					<p>RUNNING</p>
				</div>
				</a>
			</div>
			<div class="item">
				<a href="single.html" title="image" rel="title1">
					<img class="img-responsive " src="{{asset('/public/frontend/images/pic1.jpg')}}" alt="">
				<div class="run">
					<i class="foot-in"> </i>
					<p>FOOTBALL</p>
				</div>
				</a>
			</div>
			<div class="item">
				<a href="single.html" title="image" rel="title1">
					<img class="img-responsive " src="{{asset('/public/frontend/images/pic2.jpg')}}" alt="">
				<div class="run">
				<i class="cycling"> </i>
				<p>CYCLING</p>
				</div>
				</a>
			</div>
			<div class="item">
				<a href="single.html" title="image" rel="title1">
					<img class="img-responsive " src="{{asset('/public/frontend/images/pic3.jpg')}}" alt="">
				<div class="run">
				<i class="fitness"> </i>
				<p>FITNESS</p>
				</div>
				</a>
			</div>
			<div class="item">
				<a href="single.html" title="image" rel="title1">
					<img class="img-responsive " src="{{asset('/public/frontend/images/pic4.jpg')}}" alt="">
				<div class="run">
				<i class="tennis"> </i>
				<p>TENNIS</p>
				</div>
				</a>
			</div>
			<div class="item">
				<a href="single.html" title="image" rel="title1">
					<img class="img-responsive " src="{{asset('/public/frontend/images/pic.jpg')}}" alt="">
				<div class="run">
				<i> </i>
				<p>RUNNING</p>
				</div>
				</a>
			</div>
			<div class="item">
				<a href="single.html" title="image" rel="title1">
					<img class="img-responsive " src="{{asset('/public/frontend/images/pic1.jpg')}}" alt="">
				<div class="run">
					<i class="foot-in"> </i>
					<p>FOOTBALL</p>
				</div>
				</a>
			</div>
			<div class="item">
				<a href="single.html" title="image" rel="title1">
					<img class="img-responsive " src="{{asset('/public/frontend/images/pic2.jpg')}}" alt="">
				<div class="run">
				<i class="cycling"> </i>
				<p>CYCLING</p>
				</div>
				</a>
			</div>
			<div class="item">
				<a href="single.html" title="image" rel="title1">
					<img class="img-responsive " src="{{asset('/public/frontend/images/pic3.jpg')}}" alt="">
				<div class="run">
				<i class="fitness"> </i>
				<p>FITNESS</p>
				</div>
				</a>
			</div>
			<div class="item">
				<a href="single.html" title="image" rel="title1">
					<img class="img-responsive " src="{{asset('/public/frontend/images/pic4.jpg')}}" alt="">
				<div class="run">
				<i class="tennis"> </i>
				<p>TENNIS</p>
				</div>
				</a>
			</div>
			<div class="item">
				<a href="single.html" title="image" rel="title1">
					<img class="img-responsive " src="{{asset('/public/frontend/images/pic.jpg')}}" alt="">
				<div class="run">
				<i> </i>
				<p>RUNNING</p>
				</div>
				</a>
			</div>
		</div>
		</div>
		<h6 class="your-in">Your sport</h6>
		<div class="line2">
	
		</div>
	</div>
		<!--//sreen-gallery-cursual---->
	<div class="content-grids">
	
	<div class="col-md-4 content-grid">
		<a href="single.html" class="lot"><img class="img-responsive " src="{{asset('/public/frontend/images/sh.png')}}" alt=""></a>
		<div class="shoe">
			<p>Nike 3.0 V4 Men Grey Royal
			Blue with White</p>
			<label>$67.99</label>
			<a href="single.html">find a store</a>
		</div>
		<div class="clearfix"> </div>
		<b class="plus-in">+</b>
	</div>
	<div class="col-md-4 content-grid">
		<a href="single.html" class="lot"><img class="img-responsive " src="{{asset('/public/frontend/images/sh1.png')}}" alt=""></a>
		<div class="shoe">
			<p>Nike 3.0 V4 Men Grey RoyalBlue with White</p>
			<label>$67.99</label>
			<a href="single.html">find a store</a>
		</div>		
		<div class="clearfix"> </div>
		<b class="plus-in">+</b>
	</div>
	<div class="col-md-4 content-grid">
		<a href="single.html" class="lot"><img class="img-responsive " src="{{asset('/public/frontend/images/sh2.png')}}" alt=""></a>
		<div class="shoe">
			<p>Nike 3.0 V4 Men Grey RoyalBlue with White</p>
			<label>$67.99</label>
			<a href="single.html">find a store</a>
		</div>
		
		<div class="clearfix"> </div>
		<b class="plus-in">+</b>
	</div>
	
	<div class="clearfix"> </div>
	</div>
	<!---->
	<div class="content-top">
		<div class="col-md-4 top-content">
			<a href="single.html"><img class="img-responsive " src="{{asset('/public/frontend/images/pi.jpg"')}} alt=""></a>
		</div>
		<div class="col-md-4 top-content">
			<a href="single.html"><img class="img-responsive " src="{{asset('/public/frontend/images/pi1.jpg')}}" alt=""></a>
		</div>
		<div class="col-md-4 top-content">
			<a href="single.html"><img class="img-responsive " src="{{asset('/public/frontend/images/pi2.jpg')}}" alt=""></a>
		</div>
		
		<div class="clearfix"> </div>
	</div>
	<div class="content-bottom">
		<div class="col-md-8 bottom-content">
			<script src="{{asset('/public/frontend/js/responsiveslides.min.js')}}"></script>
					<script>
						$(function () {
						  $("#slider").responsiveSlides({
							auto: true,
							speed: 500,
							namespace: "callbacks",
							pager: false,
							 nav:true,
						  });
						});
					</script>
					<div class="slider">
						<div class="callbacks_container">
						  <ul class="rslides" id="slider">
							<li>
							  <img src="{{asset('/public/frontend/images/vi.jpg')}}" alt="">
							  
							</li>
							<li>
							  <img src="{{asset('/public/frontend/images/v2.jpg')}}" alt="">
								
							</li>
							<li>
							  <img src="{{asset('/public/frontend/images/vi.jpg')}}" alt="">
							  
							</li>
						  </ul>
					  </div>
					  <div class="london">
						<h5>London Marathon 2013</h5>
						<p>24/2013 - 6Mins</p>
					  </div>
					</div>

		</div>
		<div class="col-md-4 bottom-grid">
		<h4>Latest Sport News</h4>
			<div class="news">
				<span>25/07</span>
				<p>Sporting wonders have come so thick and fast since last summer that we decided it... time </p>
				<div class="foot">
					<label>football</label>
					<ul class="eye ">
						<li><span><i> </i>315</span></li>
						<li><a href="#"><i class="comment"> </i> 3</a></li>
					</ul>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="news">
				<span>25/07</span>
				<p>Sporting wonders have come so thick and fast since last summer that we decided it... time </p>
				<div class="foot">
					<label>football</label>
					<ul class="eye ">
						<li><span><i> </i>315</span></li>
						<li><a href="#"><i class="comment"> </i> 3</a></li>
					</ul>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="news">	
				<span>25/07</span>
				<p>Sporting wonders have come so thick and fast since last summer that we decided it... time </p>
				<div class="foot">
					<label>football</label>
					<ul class="eye ">
						<li><span><i> </i>315</span></li>
						<li><a href="#"><i class="comment"> </i> 3</a></li>
					</ul>
					<div class="clearfix"> </div>
				</div>
			</div>
			<a href="#" class="view">view all articles</a>
		</div>
	<div class="clearfix"> </div>
	</div>
</div>	
@endsection