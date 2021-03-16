@component('mail::message')
{{-- Greeting --}}
@if (!empty($greeting))
# {{ $greeting }}
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}
@endforeach

@component('mail::table')
| N° | Producto | Cantidad |
|:--:|:--------:|:--------:|
@foreach($order->items as $item)
| {{ $loop->iteration }} | {{ $item->product()->withTrashed()->first()->name }}@if(!is_null($item->size()->withTrashed()->first())){{ " (".$item->size()->withTrashed()->first()->name.")" }}@endif @foreach($item->complements()->withTrashed()->get() as $complement) {{ " + ".$complement->name }} @endforeach | {{ $item->qty }} |
@endforeach
| Total: | | {{ "$".number_format($order->total, 2, ",", ".") }} |
@endcomponent

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>
{{ config('app.name') }}
@endif
@endcomponent
