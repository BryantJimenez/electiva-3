<div class="strip">
	<figure>
		@if($product->discount>0)
		<span class="ribbon off">{{ "-".$product->discount."%" }}</span>
		@endif
		<img src="{{ image_exist('/admins/img/template/', 'image.jpg') }}" data-src="@if(isset($product->images[0])){{ image_exist('/admins/img/products/', $product->images[0]->image) }}@else{{ image_exist('/admins/img/template/', 'image.jpg') }}@endif" class="img-fluid lazy" alt="{{ $product->name }}">
		<a href="{{ route('web.product', ['slug' => $product->slug]) }}" class="strip_info">
			<small>{{ $product->category->name }}</small>
			<div class="item_title">
				<h3>{{ $product->name }}</h3>
				@if($product->discount==0)
				<small>{{ "$".number_format($product->price, 2, ",", ".") }}</small>
				@else
				<span class="mr-3">{{ "$".number_format($product->price-(($product->price*$product->discount)/100), 2, ",", ".") }}</span>
				<span class="text-danger"><del>{{ "$".number_format($product->price, 2, ",", ".") }}</del></span>
				@endif
			</div>
		</a>
	</figure>
</div>