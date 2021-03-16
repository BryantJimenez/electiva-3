@extends('layouts.web')

@section('title', 'Carrito')

@section('links')
<link href="{{ asset('/web/css/template/home.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/listing.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<main>
	<div class="hero_in detail_page background-image" style="background: #faf3cc url('{{ asset('/web/img/home_section_2.jpg') }}') center center no-repeat; background-size: cover;">
		<div class="wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
			<div class="container">
				<div class="main_info">
					<div class="row">
						<div class="col-12">
							<h1 class="text-center">Mi Carrito</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<div class="container margin_30_20">
	<div class="row">
		<div class="col-12">
			<div class="cart-list">
				<table class="table" id="table-cart">
					<thead>
						<tr class="text-center">
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<th>Producto</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($products as $product)
						<tr class="text-center cart-product" code="{{ $product['code'] }}">
							<td class="product-remove">
								<a href="javascript:void(0);" code="{{ $product['code'] }}">
									<span class="fa fa-times"></span>
								</a>
							</td>
							<td class="image-prod">
								<div class="img" style="background-image:url(@if(isset($product['product']->images[0])){{ image_exist('/admins/img/products/', $product['product']->images[0]->image, false, false) }}@else{{ image_exist('/admins/img/template/', 'image.jpg') }}@endif);"></div>
							</td>
							<td class="product-name">
								<h3>{{ $product['product']->name }}</h3>
							</td>
							<td class="price">@if($product['product']->discount>0){{ "$".number_format($product['product']->price-(($product['product']->price*$product['product']->discount)/100), 2, ",", ".") }}@else{{ "$".number_format($product['product']->price, 2, ",", ".") }}@endif</td>
							<td class="quantity">
								<div class="input-group mb-3">
									<input type="text" class="qty form-control" value="{{ $product['qty'] }}" min="1" max="{{ $product['product']->qty }}" code="{{ $product['code'] }}" slug="{{ $product['product']->slug }}" price="{{ $product['product']->price }}" discount="{{ $product['product']->discount }}">
								</div>
							</td>
							<td class="total" code="{{ $product['code'] }}" slug="{{ $product['product']['slug'] }}">{{ "$".$product['subtotal'] }}</td>
						</tr>
						@empty
						<tr class="text-center">
							<td class="py-3" colspan="6">No hay productos agregados al carrito</td>
						</tr>
						@endforelse

						@if(count($products)>0)
						<tr class="text-center">
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Subtotal:</td>
							<td subtotal="{{ $subtotal }}" id="subtotal-cart">{{ "$".number_format($subtotal, 2, ",", ".") }}</td>
						</tr>
						<tr class="text-center">
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Descuento:</td>
							<td discount="{{ $discount }}" percentage="@if(session()->has('coupon')){{ session('coupon')['coupon']->discount }}@else{{ 0 }}@endif" id="discount-cart">{{ "$".number_format($discount, 2, ",", ".") }}</td>
						</tr>
						<tr class="text-center">
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Total:</td>
							<td total="{{ $total }}" id="total-cart">{{ "$".number_format($total, 2, ",", ".") }}</td>
						</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 mt-5 text-right">
			<a href="{{ route('web.checkout') }}" class="btn_1 gradient text-white">Finalizar Compra</a>
		</div>
	</div>
</div>

<div id="toTop"></div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/admins/vendor/lazyload/lazyload.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-sidebar/sticky_sidebar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-kit/sticky-kit.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection