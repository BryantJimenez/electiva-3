@extends('layouts.web')

@section('title', 'Categorías')

@section('links')
<link href="{{ asset('/web/css/template/home.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/detail-page.css') }}" rel="stylesheet">
@endsection

@section('content')

<main>
	<div class="hero_in detail_page background-image" style="background: #faf3cc url('{{ asset('/web/img/home_section_2.jpg') }}') center center no-repeat; background-size: cover;">
		<div class="wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
			<div class="container">
				<div class="main_info">
					<div class="row">
						<div class="col-12">
							<h1 class="text-center">Categorías</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<div class="container margin_30_20">			
	<div class="row">
		@foreach ($categories->where('state', '1') as $category)
		<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
			<div class="strip">
				<figure>
					<img src="{{ asset('/admins/img/categories/categories.jpg') }}" data-src="{{ image_exist('/admins/img/categories/', $category->image, false, false) }}" title="{{ $category->name }}" alt="{{ $category->name }}" class="img-fluid lazy">
					<a href="{{ route('web.shop', ['category' => $category->slug]) }}" class="strip_info">
						<small>@if($category->products->count()>99){{ '99+' }}@else{{ $category->products->count() }}@endif</small>
						<div class="item_title">
							<h3>{{ $category->name }}</h3>
							<small>Promedio $@if($category->products->count()>0){{ number_format($category->products->avg('price'), 2, ',', '.') }}@else{{ "0,00" }}@endif</small>
						</div>
					</a>
				</figure>
			</div>

		</div>
		@endforeach
	</div>		
</div>

<div id="toTop"></div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/admins/vendor/lazyload/lazyload.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-sidebar/sticky_sidebar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-kit/sticky-kit.min.js') }}"></script>
@endsection