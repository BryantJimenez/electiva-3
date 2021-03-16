@extends('layouts.web')

@section('title', 'Detalles de Compra')

@section('content')

<main>
	<div class="hero_in detail_page background-image" style="background: #faf3cc url('{{ asset('/web/img/home_section_2.jpg') }}') center center no-repeat; background-size: cover;">
		<div class="wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
			<div class="container">
				<div class="main_info">
					<div class="row">
						<div class="col-12">
							<h1 class="text-center">Detalles de la Compra</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<div class="container margin_30_20">
	<div class="row">
		<div class="col-12 mt-4">
			<div class="cart-detail p-3 p-md-4 bg-white">
				<div class="row">
					<div class="col-12">
						<p class="h4 text-serif font-weight-bold">Datos del Pedido</p>
					</div>

					<div class="col-lg-6 col-md-6 col-12">
						<p><strong>Fecha del Pedido:</strong> {{ $order->created_at->format("d-m-Y H:i a") }}</p>
					</div>

					<div class="col-lg-6 col-md-6 col-12">
						<p><strong>Teléfono:</strong> {{ $order->phone }}</p>
					</div>

					<div class="col-lg-6 col-md-6 col-12">
						<p><strong>Cantidad de Productos:</strong> {{ $order->items->sum('qty') }}</p>
					</div>

					<div class="col-lg-6 col-md-6 col-12">
						<p><strong>Estado del Pedido:</strong> {!! stateOrder($order->state) !!}</p>
					</div>

					<div class="col-lg-6 col-md-6 col-12">
						<p><strong>Tipo de Entrega:</strong> {{ typeDelivery($order->type_delivery, 0) }}</p>
					</div>

					@if($order->type_delivery==1)
					<div class="col-lg-6 col-md-6 col-12">
						<p><strong>Dirección de Envío:</strong> {{ $order->shipping->location()->withTrashed()->first()->municipality()->withTrashed()->first()->state()->withTrashed()->first()->country()->withTrashed()->first()->name.", ".$order->shipping->location()->withTrashed()->first()->municipality()->withTrashed()->first()->state()->withTrashed()->first()->name.", ".$order->shipping->location()->withTrashed()->first()->municipality()->withTrashed()->first()->name.", ".$order->shipping->location()->withTrashed()->first()->name.", ".$order->shipping->street.", casa número ".$order->shipping->house }}</p>
					</div>

					<div class="col-lg-6 col-md-6 col-12">
						<p><strong>Información Adicional de la Dirección:</strong> {{ $order->shipping->address }}</p>
					</div>
					@endif

					<div class="col-12">
						<p class="h4 text-serif font-weight-bold">Datos del Pago</p>
					</div>

					<div class="col-lg-6 col-md-6 col-12">
						<p><strong>Método de Pago:</strong> {{ methodPayment($order->payment->method) }}</p>
					</div>

					<div class="col-lg-6 col-md-6 col-12">
						<p><strong>Motivo:</strong> {{ $order->payment->subject }}</p>
					</div>

					@if(!is_null($order->payment->transfer))
					<div class="col-lg-6 col-md-6 col-12">
						<p><strong>Codigo de Referencia:</strong> {{ $order->payment->transfer->reference }}</p>
					</div>
					@endif

					<div class="col-lg-6 col-md-6 col-12">
						<p><strong>Total Pagado:</strong> {{ "$".number_format($order->payment->total, 2, ",", ".") }}</p>
					</div>

					@if(!is_null($order->coupon))
					<div class="col-lg-6 col-md-6 col-12">
						<p><strong>Descuento de Cupón:</strong> {{ $order->coupon->discount."%" }}</p>
					</div>
					@endif

					<div class="col-lg-6 col-md-6 col-12">
						<p><strong>Estado del Pago:</strong> {!! statePayment($order->payment->state) !!}</p>
					</div>

					<div class="col-12">
						<a href="{{ route('web.profile') }}" class="btn btn-dark rounded">Volver</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container margin_30_20">
	<div class="row">
		<div class="col-12 mt-4">
			<div class="cart-detail p-3 p-md-4 bg-white">
				<div class="row">
					<div class="col-12">
						<p class="h4 text-serif font-weight-bold">Productos del Pedido</p>
						<div class="cart-list">
							<table class="table">
								<thead>
									<tr class="text-center">
										<th>#</th>
										<th>Producto</th>
										<th>Cantidad</th>
										<th>Precio</th>
										<th>Descuento</th>
										<th>Subtotal</th>
									</tr>
								</thead>
								<tbody>
									@foreach($order->items as $item)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $item->product->name }}</td>
										<td>{{ $item->qty }}</td>
										<td>{{ "$".number_format($item->price, 2, ",", ".") }}</td>
										<td>{{ $item->discount."%" }}</td>
										<td>{{ "$".number_format($item->subtotal, 2, ",", ".") }}</td>
									</tr>
									@endforeach
								</tbody>
								<tfooter>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td class="text-uppercase">Envío</td>
										<td class="font-weight-bold">{{ "$".number_format($order->delivery, 2, ",", ".") }}</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td class="text-uppercase">Descuento</td>
										<td class="font-weight-bold">{{ "- $".number_format($order->discount, 2, ",", ".") }}</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td class="text-uppercase">Total</td>
										<td class="font-weight-bold">{{ "$".number_format($order->total, 2, ",", ".") }}</td>
									</tr>
								</tfooter>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/admins/vendor/lazyload/lazyload.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-sidebar/sticky_sidebar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-kit/sticky-kit.min.js') }}"></script>
@endsection