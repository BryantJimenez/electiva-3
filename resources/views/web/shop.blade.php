@extends('layouts.web')

@section('title', 'Tienda')

@section('links')
<link href="{{ asset('/web/css/template/home.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/listing.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="container margin_30_20">			
	<div class="row">
		<aside class="col-lg-3" id="sidebar_fixed">
			<form action="{{ route('web.shop') }}" method="GET">
				<div class="row">
					<div class="form-group col-12">
						<p class="font-weight-bold mb-2">Categorías</p>
						<select class="form-control" name="category">
							<option value="">Todas las categorías</option>
							@foreach($categories as $category)
							<option @if(isset($search['category']) && !is_null($search['category']) && $search['category']==$category->slug) selected @endif value="{{ $category->slug }}">{{ $category->name }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<hr class="my-1">

				<div class="row">
					<div class="form-group col-12">
						<p class="font-weight-bold mb-2">Precio</p>
						<input class="form-control int min" type="text" name="min" placeholder="Precio Min" value="@if(isset($search['min']) && !is_null($search['min'])){{ $search['min'] }}@endif">
					</div>

					<div class="form-group col-12">
						<input class="form-control int max" type="text" name="max" placeholder="Precio Max" value="@if(isset($search['max']) && !is_null($search['max'])){{ $search['max'] }}@endif">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-12">
						<button type="submit" class="btn_1 outline full-width">Buscar</button>
					</div>
				</div>
			</form>
		</aside>

		<div class="col-lg-9">
			<div class="row">
				<div class="col-12">
					<h2 class="title_small">{{ $products->count() }} Resultados</h2>
				</div>

				@forelse($products as $product)
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
					@include('web.partials.product', ['product' => $product])
				</div>
				@empty
				<div class="col-12">
					<p class="h3 text-center text-danger">No hay ningún resultado</p>
				</div>
				@endforelse

				<div class="col-12 d-flex justify-content-center">
					{{ $pagination->links() }}
				</div>
			</div>
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