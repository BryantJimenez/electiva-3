@extends('layouts.web')

@section('title', 'Términos y Condiciones')

@section('links')
<link href="{{ asset('/web/css/template/home.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/detail-page.css') }}" rel="stylesheet">
<link href="{{ asset('/admins/vendor/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<main>
	<div class="hero_in detail_page background-image" style="background: #faf3cc url('{{ asset('/web/img/home_section_2.jpg') }}') center center no-repeat; background-size: cover;">
		<div class="wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
			<div class="container">
				<div class="main_info">
					<div class="row">
						<div class="col-12">
							<h1 class="text-center">Términos y Condiciones de Uso</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<div class="container margin_30_40">
	<div class="row">
		<div class="col-12">
			<p>{!! $setting->terms !!}</p>
		</div>
	</div>
</div>

<div id="toTop"></div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/admins/vendor/lazyload/lazyload.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/owlcarousel/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-sidebar/sticky_sidebar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-kit/sticky-kit.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
@endsection