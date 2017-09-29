<h1 class="text-center m-4">Porudžbine</h1>
@foreach($orders as $order)
	@component('partials.orders.small')
		@slot('status')
			{{ $order->status->name }}
		@endslot
		@slot('description')
			{{ $order->status->description }}

			<p>{{ $order->address->street_name . ' ' . $order->address->building_number}}, 
			{{ $order->address->postal_code . ' ' . $order->address->city}}</p>
		@endslot
		@slot('id')
			{{ $order->slug }}
		@endslot
		@slot('created_at')
			{{ $order->created_at->diffForHumans() }}
		@endslot
		@slot('price')
			{{ $order->price }}
		@endslot
		@slot('amount')
			{{ count($order->products) }}
		@endslot
		@slot('routes')
			<a href="{{ route('stores.orders.show', [$order->store->slug, $order->slug]) }}" class="btn btn-primary">Detaljnije</a>
			<a href="{{ route('stores.orders.edit', [$order->store->slug, $order->slug]) }}" class="btn btn-primary">Izmeni</a>
		@endslot
	@endcomponent
@endforeach