<?php 
$page = '';
$slug = isset($vendor->slug) ? $vendor->slug :'';
$vendor_id = isset($vendor->id) ? $vendor->id :'';
$segments_arr = request()->segments();
$seg1 = isset($segments_arr[0]) ? $segments_arr[0] :'';
$seg2 = isset($segments_arr[1]) ? $segments_arr[1] :'';
$seg3 = isset($segments_arr[2]) ? $segments_arr[2] :'';


if($seg1 == $slug){
	$page = 'home';
}if($seg2 == 'cart'){
	$page = 'cart';
}
if($seg2 == 'profile'){
	$page = 'profile';
}
if($seg2 == 'search'){
	$page = 'search';
}
if($seg2 == 'all-category'){
	$page = 'all-category';
}
if($seg2 == 'purchase'){
	$page = 'purchase';
}
if($seg2 == 'winer-list'){
	$page = 'winer-list';
}
if($seg2 == 'offers'){
	$page = 'offers';
}
if($seg2 == 'merchant'){
	$page = 'merchant';
}
$url = url('/').'/'.$slug;

?>
<nav class="nav-bottom">
	<a href="{{$url}}" class="nav-link <?php if($page == 'home')echo "active"?>">
		<img src="{{asset('public/assets/img/home.png')}}" height="23px" width="28px"><span class="text">Home</span>
	</a>

	<!-- <a href="{{url($slug.'/all-category')}}" class="nav-link <?php //if($page == 'category')echo "active"?>">
		<i class="icon fa fa-th"></i><span class="text">Categories</span>
	</a> -->

	<a href="{{url($slug.'/purchase')}}" class="nav-link <?php if($page == 'purchase')echo "active"?>">
		<img src="{{asset('public/assets/img/purchase.jpg')}}" height="23px" width="28px"><span class="text">Purchase</span>
	</a>
	
<!-- 	<a href="{{$url.'/search'}}" class="nav-link <?php if($page == 'search')echo "active"?>">
		<i class="icon fa fa-search"></i><span class="text">Search</span>
	</a> -->

	<a href="{{$url.'/winer-list'}}" class="nav-link <?php if($page == 'winer-list')echo "active"?>">
		<img src="{{asset('public/assets/img/winner.png')}}" height="23px" width="28px">
		<span class="text">Winner List</span>
	</a>
	<a href="{{$url.'/offers'}}" class="nav-link <?php if($page == 'offers')echo "active"?>">
		<img src="{{asset('public/assets/img/offers.png')}}" height="23px" width="28px"><span class="text">Offers</span>
	</a>


	<a href="{{$url.'/cart'}}" class="nav-link <?php if($page == 'cart')echo "active"?>">
		<i class="icon fa fa-shopping-cart"></i><span class="text">Cart</span>
	</a>



	<a href="{{$url.'/merchant'}}" class="nav-link <?php if($page == 'merchant')echo "active"?>">
		<img src="{{asset('public/assets/img/merchant.png')}}" height="23px" width="28px"><span class="text">Merchant</span>
	</a>
	

	<!-- <a href="{{$url.'/profile'}}" class="nav-link <?php //if($page == 'profile')echo "active"?>">
		<i class="icon fa fa-user"></i><span class="text">Profile</span>
	</a> -->
</nav> <!-- nav-bottom -->


</div> 
<!-- =============== screen-wrap end.// =============== -->



</body>
</html>

<script type="text/javascript">
	function add_to_cart(slug,coupon_id){
		var user_id = '<?php echo isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :''?>';
		var url = '<?php echo url('account/login')?>';
		var segments_arr = '<?php echo url('account/login?referer=').$seg1.'/'.$seg2.'/'.$seg3?>';
		if(user_id ==''){
			window.location.href = segments_arr;
		}
		var _token = '{{ csrf_token() }}';

		$.ajax({
			url: "{{ url('/add_to_cart') }}",
			type: "POST",
			data: {slug:slug,coupon_id:coupon_id},
			dataType:"JSON",
			headers:{'X-CSRF-TOKEN': _token},
			cache: false,

			success: function(resp){
				if(resp.status){
					alert(resp.message);
					$('#add_cart'+coupon_id).hide();
					$('#go_cart'+coupon_id).toggle(0);
				}else{
					alert(resp.message);
				}

			}
		});
	}
</script>
<script>
	function wcqib_refresh_quantity_increments() {
		jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
			var c = jQuery(b);
			c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
		})
	}
	String.prototype.getDecimals || (String.prototype.getDecimals = function() {
		var a = this,
		b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
		return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
	}), jQuery(document).ready(function() {
		wcqib_refresh_quantity_increments()
	}), jQuery(document).on("updated_wc_div", function() {
		wcqib_refresh_quantity_increments()
	}), jQuery(document).on("click", ".plus, .minus", function() {
		var a = jQuery(this).closest(".quantity").find(".qty"),
		b = parseFloat(a.val()),
		c = parseFloat(a.attr("max")),
		d = parseFloat(a.attr("min")),
		e = a.attr("step");
		b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
	});
</script>

<script type="text/javascript">
	function qty_minus(cart_id,coupon_id,vendor_id){
		var user_id = '<?php echo isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :''?>';
		var url = '<?php echo url('account/login')?>';
		var segments_arr = '<?php echo url('account/login?referer=').$seg1.'/'.$seg2.'/'.$seg3?>';
		if(user_id ==''){
			window.location.href = segments_arr;
		}
		var _token = '{{ csrf_token() }}';

		$.ajax({
			url: "{{ url('/cart_minus') }}",
			type: "POST",
			data: {cart_id:cart_id,coupon_id:coupon_id,vendor_id:vendor_id},
			dataType:"JSON",
			headers:{'X-CSRF-TOKEN': _token},
			cache: false,

			success: function(resp){
				if(resp.status){
					$('#total').html(resp.total);
				}else{
					alert(resp.message);
				}


			}
		});
	}

	function qty_plus(cart_id,coupon_id,vendor_id){

		var user_id = '<?php echo isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :''?>';
		var url = '<?php echo url('account/login')?>';
		var segments_arr = '<?php echo url('account/login?referer=').$seg1.'/'.$seg2.'/'.$seg3?>';
		if(user_id ==''){
			window.location.href = segments_arr;
		}
		var _token = '{{ csrf_token() }}';

		$.ajax({
			url: "{{ url('/cart_plus') }}",
			type: "POST",
			data: {cart_id:cart_id,coupon_id:coupon_id,vendor_id:vendor_id},

			dataType:"JSON",
			headers:{'X-CSRF-TOKEN': _token},
			cache: false,

			success: function(resp){
				if(resp.status){
					$('#total').html(resp.total);
				}else{
					alert(resp.message);
				}

			}
		});
	}

	function delete_cart_item(cart_id,coupon_id,vendor_id){
		if(confirm('Are You Sure to delete this Cart Item')){
			var user_id = '<?php echo isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :''?>';
			var url = '<?php echo url('account/login')?>';
			var segments_arr = '<?php echo url('account/login?referer=').$seg1.'/'.$seg2.'/'.$seg3?>';
			if(user_id ==''){
				window.location.href = segments_arr;
			}
			var _token = '{{ csrf_token() }}';

			$.ajax({
				url: "{{ url('/delete_cart_item') }}",
				type: "POST",
				data: {cart_id:cart_id,coupon_id:coupon_id,vendor_id:vendor_id},

				dataType:"JSON",
				headers:{'X-CSRF-TOKEN': _token},
				cache: false,

				success: function(resp){
					if(resp.status){

						location.reload();

					}

				}
			});
		}else{
			return false;
		}
	}

</script>



<script type="text/javascript">
	$("#secrch_keyword").keyup(function(){

		var secrch_keyword = $('#secrch_keyword').val();
		var vendor_id = '<?php echo $vendor_id?>';
		if(vendor_id ==''){
			return false;
		}else{
			var _token = '{{ csrf_token() }}';

			$.ajax({
				url: "{{ url('/search-coupons') }}",
				type: "POST",
				data: {secrch_keyword:secrch_keyword,vendor_id:vendor_id},

				dataType:"HTML",
				headers:{'X-CSRF-TOKEN': _token},
				cache: false,

				success: function(resp){
					$('#search_suggetion').html(resp);

				}
			});
		}
	});
</script>

<script type="text/javascript">
	function cancel_order(order_id){

		if(confirm('Are You Want To Cancel This Order')){
			var _token = '{{ csrf_token() }}';
			$.ajax({
				url: "{{ url('/cancel-order') }}",
				type: "POST",
				data: {order_id:order_id},
				dataType:"JSON",
				headers:{'X-CSRF-TOKEN': _token},
				cache: false,

				success: function(resp){
					if(resp.status){
						location.reload();

					}

				}
			});
		}
	}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>


<script type="text/javascript">
	function test()

	{ 
		//alert('hiii');

		$("#homemodal").trigger('click'); 
	 }
$(document).ready(function(){
   setInterval(test, 10000);   
});
</script>