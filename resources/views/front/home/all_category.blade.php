@include('front.common.header')
<?php 
$slug = isset($vendor->slug) ? $vendor->slug :'';

?>

<header class="app-header bg-primary">
	<a href="javascript:history.go(-1)" class="btn-header"><i class="fa fa-arrow-left"></i></a>
    <div class="header-right">  </div>
</header> <!-- section-header.// -->
<main class="app-content">

<div class="bg-primary  text-center padding-x padding-bottom">
    <h3 class="title-page text-white">All Category</h3>
    <p class="text-white-50">{{$all_count_product}} products</p>
</div>

<section class="padding-around">

<ul class="row">
    <?php if(!empty($coupon_Categories) && count($coupon_Categories) > 0){
        foreach($coupon_Categories as $cat){
            $imgUrl = asset('public/assets/front/images/noimage.png');
            if(!empty($cat->img)){
                $imgUrl = $cat->img;
            }
        ?>
    <li class="col-6">
        <a href="{{url($slug.'/coupons/'.$cat->id)}}" class="btn-icontop-lg">
            <span class="icon"> <img src="{{$imgUrl}}" alt=""> </span>
            <span class="text text-truncate"> {{$cat->name}} </span>
        </a>
    </li>
   <?php }}else{?>
    <div class="d-md-flex align-items-md-center height-100vh--md">
                        <div class="container text-center space-2 space-3--lg">
                            <div class="w-md-80 w-lg-60 text-center mx-md-auto">
                                <div class="mb-5">
                                    <span class="u-icon u-icon--secondary u-icon--lg rounded-circle mb-4">
                                        <!-- <span class="fa fa-shopping-bag u-icon__inner"></span> -->
                                        <img src="{{asset('public/assets/img/empty_category.png')}}" width="330px" height="230px">
                                    </span>
                                    <h1 class="h2">Category currently empty</h1>
                                    <p></p>
                                </div>
                                
                            </div>
                        </div>
                    </div>

   <?php }?>
</ul>



</section>


</main>
	@include('front.common.footer')
	