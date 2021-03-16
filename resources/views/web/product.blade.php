@extends('layouts.web')

@section('title', $product->name)

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/lightslider/lightslider.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lightgallery/lightgallery.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="container margin_30_20">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mb-4">
				<ul id="lightgallery-product">
					@forelse($product->images as $image)
					<li href="{{ image_exist('/admins/img/products/', $image->image, false, false) }}" data-thumb="{{ image_exist('/admins/img/products/', $image->image, false, false) }}">
						<img src="{{ image_exist('/admins/img/products/', $image->image, false, false) }}" alt="{{ $product->name }}" />
					</li>
					@empty
					<li href="{{ image_exist('/admins/img/products/', 'image.jpg', false, false) }}" data-thumb="{{ image_exist('/admins/img/products/', 'image.jpg', false, false) }}">
						<img src="{{ image_exist('/admins/img/products/', 'image.jpg', false, false) }}" alt="{{ $product->name }}" />
					</li>
					@endforelse
				</ul>
			</div>

			<div class="col-lg-6">
				<h3>{{ $product->name }} @if($product->discount>0)<span class="badge badge-danger rounded-pill text-white px-2 ml-2">{{ "-".$product->discount."%" }}</span>@endif</h3>
				@if($product->discount==0)
				<p class="h4 text-dark font-weight-bold">{{ "$".number_format($product->price, 2, ",", ".") }}</p>
				@else
				<div class="d-flex justify-content-start">
					<p class="h4 text-dark font-weight-bold mr-3">{{ "$".number_format($product->price-(($product->price*$product->discount)/100), 2, ",", ".") }}</p>
					<p class="h4 text-danger font-weight-bold"><del>{{ "$".number_format($product->price, 2, ",", ".") }}</del></p>
				</div>
				@endif
				<p class="text-left text-dark">Categoría: <a href="{{ route('web.shop', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a></p>
				<div class="row">
					<div class="col-xl-6 col-lg-12 col-md-6 col-12">
						<div class="form-group">
							<label class="col-form-label">Cantidad</label>
							<div class="product-qty">
								<input type="text" class="form-control text-center qty-max number" placeholder="Introduzca una cantidad" min="1" max="{{ $product->qty }}" value="1" price="{{ $product->price }}" discount="{{ $product->discount }}" id="product-qty-cart">
							</div>
						</div>
					</div>

					<div class="col-12 mt-3">
						<div class="row">
							<div class="col-xl-6 col-lg-12 col-md-6 col-12">
								<a class="btn_1 gradient full-width text-white mr-3 mb-3" id="product-add-cart" slug="{{ $product->slug }}"><span id="price-product-add-cart">@if($product->discount==0){{ "$".number_format($product->price, 2, ",", ".") }}@else{{ "$".number_format($product->price-(($product->price*$product->discount)/100), 2, ",", ".") }}@endif</span> Agregar al carrito</a>
							</div>

							<div class="col-xl-6 col-lg-12 col-md-6 col-12">
								<a href="{{ route('web.shop') }}" class="btn_1 full-width mb-3">Seguir Comprando</a>
							</div>	
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<p class="h3 font-weight-bold">Descripción</p>
				<p>{{ $product->description }}</p>
			</div>
		</div>
	</div>
</div>

<div class="container margin_30_20">
	<div class="container">
		<div class="col-12 text-center">
			<h2 class="mb-4">Productos Relacionados</h2>
		</div>		
	</div>
	<div class="container">
		<div class="row">
			@foreach($products as $product)
			<div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
				@include('web.partials.product', ['product' => $product])
			</div>
			@endforeach
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/admins/vendor/lazyload/lazyload.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/lightslider/lightslider.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/lightgallery/lightgallery.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/lightgallery/lg-thumbnail.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/lightgallery/lg-fullscreen.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/lightgallery/lg-zoom.js') }}"></script>
<script src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection