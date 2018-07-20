<div class="footer">
	<div class="col-md-3 footer-left">
		<h4>Sports</h4>
		<div class="run-top">
			<ul class="run-grid">
				<li><a href="product.html">RUNNING</a></li>
				<li><a href="product.html">CYCLING</a></li>
				<li><a href="product.html">TRIATHLON</a></li>
				<li><a href="product.html">FITNESS</a></li>
				<li><a href="product.html">TENNIS</a></li>
				<li><a href="product.html">MORE SPORTS</a></li>
			</ul>
			<ul class="run-grid">
				<li><a href="product.html">STYLE</a></li>
				<li><a href="product.html">SPECIAL</a></li>
				<li><a href="product.html">BRAND EVENTS</a></li>
			</ul>
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="col-md-3 footer-left left-footer">
		<h4>Latest</h4>
		<div class="run-top top-run">
			<ul class="run-grid">
				<li><a href="#">News & Events</a></li>
				<li><a href="#">Community</a></li>
				<li><a href="#">Videos</a></li>
				<li><a href="single.html">Shopping</a></li>
				<li><a href="#">Sponsorships</a></li>
				<li><a href="#">more sports</a></li>
			</ul>
			<ul class="run-grid">
				<li><a href="#">Clubs and Training</a></li>
				<li><a href="contact.html">Event Map</a></li>
				<li><a href="#">Challange the world</a></li>
			</ul>
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="col-md-2 footer-left left-footer">
		<h4>Your Account</h4>
		<ul class="run-grid-in">
			<li><a href="account.html">Login</a></li>
			<li><a href="#">My Sports</a></li>
			<li><a href="#">My Events</a></li>
		</ul>
	</div>
	<div class="col-md-4 footer-left left-footer">
		<ul class="social-in">
			<li><a href="#"><i> </i></a></li>
			<li><a href="#"><i class="youtube"> </i></a></li>
			<li><a href="#"><i class="facebook"> </i></a></li>
			<li><a href="#"><i class="twitter"> </i></a></li>
		</ul>
		<div class="letter">
			<h5>NEWSLETTER</h5>
			<span>in the next article</span>
			<h6>NRL: five things we learned this weekend</h6>
			<p>In support of suburban games; Warriors rip</p>
			<a href="register.html" class="sign">SIGN UP AND GET MORE</a>
			<p class="footer-class"> © 2015 Sport All Rights Reserved | Template by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
		</div>

	</div>
	<div class="clearfix"> </div>
</div>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$('.add-cart').on('click',function(){

		pro_id = $(this).attr('data-index');
		count = $('#checkout').attr('data-index');
		size = ' ';

		$.ajax({
			type: 'POST',
			url: '{{ route('frontend.cart.add_cart') }}',
			data: {'pro_id':pro_id,'count':count,'size':size},
			success: function(data) {
				if(data == 'overlimit') {// khi trong kho k đủ số lượng để cung cấp cho người mua
					alert("This product's quantity don't enough!!");
				} else {
					total = data.split('---');
					total = data.split('-');
					console.log(total);
					vt = data.indexOf('---');
					data = data.substring(vt,data.length);
					$('#cart_quantity').html(total[1]);
					$('#checkout').attr('data-index',total[1]);// attr này ở header giỏ hàng
					$('button[name=process]').attr('data-index',total[1]); // attribute của nút process to buy trong checkout
					if(parseInt(count) == parseInt(total[1])) /*Khi thêm 2 sản phẩm trùng nhau thì xóa cái củ đi thêm cái mới vô với số lượng tăng lên 1*/
					{
						$('#'+total[2]).remove();
						alert('this product had in your cart');
					} 
					console.log(total[2]);
					$('#cart_show').append(data);
					$('.total').html(total[0]);
				}
				
			}
		})
	})

	$('.cart').on('click',function(){
		pro_id = $(this).attr('data-index');
		size = $(this).parent().find('select[name=size]').val();
		qty = $(this).parent().find('input[name=qty]').val();
		count = $('#checkout').attr('data-index');

		$.ajax({
			type: 'POST',
			url: '{{ route('frontend.cart.add_cart') }}',
			data: {'pro_id':pro_id,'size':size,'qty':qty,'count':count},
			success: function(data) {
				console.log(data);
				if(data == 'overlimit') { //khi sp61 lượng trong kho không đủ
					alert("This product's quantity don't enough!!");
				} else {
					total = data.split('---');
					total = data.split('-');
					console.log(total);
					vt = data.indexOf('---');
					data = data.substring(vt,data.length);
					$('#cart_quantity').html(total[1]);//html số của giỏ hàng
					$('#checkout').attr('data-index',total[1]);//attr hiển thị của giỏ hàng
					$('button[name=process]').attr('data-index',total[1]); // attribute của nút process to buy trong checkout
					if(parseInt(count) == parseInt(total[1])) /*Khi thêm 2 sản phẩm trùng nhau thì xóa cái củ đi thêm cái mới vô với số lượng tăng lên 1*/
					{
						$('#'+total[2]).remove();
						alert('this product had in your cart');
					} 
					console.log(total[2]);
					$('#cart_show').append(data);
					$('.total').html(total[0]);
				}

			}
		})


	})
</script>
<script type="text/javascript">
	$("[data-toggle=popover]").popover({
		html: true, 
		content: function() {
			return $('#popover-content').html();
		}
	});

</script>

</body>
</html>