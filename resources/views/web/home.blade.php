@extends('layouts.web')

@section('title', 'Inicio')

@section('links')
<link href="{{ asset('/web/css/template/home.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/detail-page.css') }}" rel="stylesheet">
<link href="{{ asset('/admins/vendor/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<main>
	<div class="hero_single version_2" style="background: #faf3cc @if(!is_null($banners->last())) url('{{ asset('/admins/img/banners/'.$banners->last()->image) }}') @endif center center no-repeat;">
		<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
			<div class="container">
				<div class="row justify-content-lg-start justify-content-md-center">
					<div class="col-xl-6 col-lg-8">
						<h1>Comida a domicilio o para llevar</h1>
						<p>La mejor comida al mejor precio</p>
					</div>
				</div>
			</div>
		</div>
		<div class="wave hero"></div>
	</div>
</main>

<section class="container">
	<div class="row">
		<div class="col-12">
			<div class="main_title center">
				<span><em></em></span>
				<h2>Categorías Populares</h2>
			</div>
			<div class="owl-carousel owl-theme categories_carousel">
				@foreach ($categories->where('state', '1') as $category)
				<div class="item_version_2">
					<a href="{{ route('web.shop', ['category' => $category->slug]) }}">
						<figure>
							<span>@if($category->products->count()>99){{ '99+' }}@else{{ $category->products->count() }}@endif</span>
							<img src="{{ asset('/admins/img/categories/categories.jpg') }}" data-src="{{ image_exist('/admins/img/categories/', $category->image, false, false) }}" title="{{ $category->name }}" alt="{{ $category->name }}" class="lazy">
							<div class="info">
								<h3>{{ $category->name }}</h3>
								<small>Promedio $@if($category->products->count()>0){{ number_format($category->products()->get()->values()->avg('price'), 2, ',', '.') }}@else{{ "0,00" }}@endif</small>
							</div>
						</figure>
					</a>
				</div>
				@endforeach
			</div>
			<br>
			<div class="main_title">
				<a href="{{ route('web.categories') }}">Ver Todas</a>
			</div>
		</div>
	</div>
</section>

<section class="margin_detail">
	<div class="container">
		<div class="row">
			<div class="col-12 list_menu">
				<div class="main_title center">
					<span><em></em></span>
					<h2>Mejores Productos</h2>
				</div>
				<div class="row">
					@forelse($products as $product)
					<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
						@include('web.partials.product', ['product' => $product])
					</div>
					@empty
					<div class="col-12">
						<p class="h3 text-center text-danger">No hay ningún resultado</p>
					</div>
					@endforelse
				</div>
			</div>
		</div>
	</div>
</section>

<div id="toTop"></div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/admins/vendor/lazyload/lazyload.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/owlcarousel/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-sidebar/sticky_sidebar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-kit/sticky-kit.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection