@include('front.common.header')
<main class="app-content">

<div class="bg-primary  text-center padding-x padding-bottom">
    <h3 class="title-page text-white">All Category</h3>
    <p class="text-white-50">321 products</p>
</div>

<section class="padding-around">

<ul class="row">
    <li class="col-6">
        <a href="#" class="btn-icontop-lg">
            <span class="icon"> <img src="{{asset('public/assets/front/images/icons/category-blue/cpu.svg')}}" alt=""> </span>
            <span class="text text-truncate"> Electronics </span>
        </a>
    </li>
    <li class="col-6">
        <a href="#" class="btn-icontop-lg">
            <span class="icon"> <img src="{{asset('public/assets/front/images/icons/category-blue/homeitem.svg')}}" alt=""> </span>
            <span class="text text-truncate"> Home items </span>
        </a>
    </li>
    <li class="col-6">
        <a href="#" class="btn-icontop-lg">
            <span class="icon"> <img src="{{asset('public/assets/front/images/icons/category-blue/book.svg')}}" alt=""> </span>
            <span class="text text-truncate"> Books </span>
        </a>
    </li>
    <li class="col-6">
        <a href="#" class="btn-icontop-lg">
            <span class="icon"> <img src="{{asset('public/assets/front/images/icons/category-blue/ball.svg')}}" alt=""> </span>
            <span class="text text-truncate"> Sports </span>
        </a>
    </li>
    <li class="col-6">
        <a href="#" class="btn-icontop-lg">
            <span class="icon"> <img src="{{asset('public/assets/front/images/icons/category-blue/car.svg')}}" alt=""> </span>
            <span class="text text-truncate"> Auto parts </span>
        </a>
    </li>
    <li class="col-6">
        <a href="#" class="btn-icontop-lg">
            <span class="icon"> <img src="{{asset('public/assets/front/images/icons/category-blue/shoe-lady.svg')}}" alt=""> </span>
            <span class="text text-truncate"> Shoes </span>
        </a>
    </li>
    <li class="col-6">
        <a href="#" class="btn-icontop-lg">
            <span class="icon"> <img src="{{asset('public/assets/front/images/icons/category-blue/shirt.svg')}}" alt=""> </span>
            <span class="text text-truncate"> Clothes</span>
        </a>
    </li>
    <li class="col-6">
        <a href="#" class="btn-icontop-lg">
            <span class="icon"> <i class="fa  fa-ellipsis-h"></i> </span>
            <span class="text text-truncate"> More </span>
        </a>
    </li>
</ul>
</section>


</main>



@include('front.common.footer')
