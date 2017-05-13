@extends('layouts.shopping')

@section('content')
	<div class="container">
		<div class="card my-5">
		  	<div class="card-block card-inverse card-@include('partials.status_color')">
			    <h4 class="card-title text-center h2">Porudzbina {{ $order->id }}</h4>
			    <hr>
			    <p>{{ $order->status->description }}</p>
			    <div class="d-flex flex-wrap justify-content-between">
			    	<span class="h4">{{ $order->price }} din.</span>
			    	<span class="h4">{{ $order->created_at->diffForHumans() }}</span>
			    </div>
		  	</div>
		  	<ul class="list-group list-group-flush">
		  		<li class="list-group-item text-muted">Proizvodi<span class="ml-auto">Kolicina</span></li>
		  		@foreach($order->products as $product)
					<li class="list-group-item h5">{{ $product->name }}<span class="ml-auto">{{ $product->pivot->amount }}</span></li>
		  		@endforeach
		  	</ul>
		  	@if ($order->status->name === 'u_pripremi' || $order->status->name === 'pauzirano')
		  		<div class="card-block d-flex justify-content-around">
					<form action="{{ route('buyer.orders.destroy', [$user->id, $store->id, $order->id]) }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="delete">
						<button type="submit" class="btn btn-danger">
							Odustani
						</button>
					</form>
					<form action="{{ route('buyer.orders.pause', [$user->id, $store->id, $order->id]) }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="patch">
						<button type="submit" class="btn btn-warning">
							{{ ($order->status->name === 'pauzirano') ? 'Odpauziraj' : 'Pauziraj' }} slanje
						</button>
					</form>
	  			</div>
		  	@endif
		</div>
	</div>
@endsection