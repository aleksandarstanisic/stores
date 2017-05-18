@extends('layouts.shopping')

@section('content')
	<div class="container">

			<p class="h1 text-center p-3">Vasa korpa</p>

		@if(count($products))
			<ul class="list-unstyled">
				@foreach($products as $product)
					<div class="media m-2 border-1 p-3">
						<div class="container">
							<div class="row">

								<div class="col-12 col-sm-6 col-md-6 d-flex">
									<img class="d-flex align-self-center mr-3" src="{{ $product->images()->first() ?? 'https://placehold.it/65x65' }}" alt="">
									<div class="media-body">
										<a href="{{ route('shopping.product', [$user->slug, $store->slug, $product->slug]) }}">
											<h5 class="mt-0">{{ $product->name }}</h5>
										</a>
									</div>
								</div>

								<div class="col-6 col-sm-3">
									<div class="mx-4">
										{{ $product->price * $product->pivot->amount }} din.
									</div>
								</div>

								<div class="col-6 col-sm-3">
									<div>
										<form action="{{ route('cart.store', [$user->slug, $store->slug, $product->slug]) }}" method="post" class="form-inline">
											{{ csrf_field() }}
											<select name="amount" class="custom-select">

												@for($i = 1; $i <= 20; $i++)
													<option value="{{ $i }}" {{ ($i === $product->pivot->amount) ? 'selected' : '' }}>{{ $i }}</option>
												@endfor

											</select>
											<button type="submit" class="btn btn-warning ml-2">Izmeni</button>
										</form>
									</div>
								</div>

							</div>
						</div>
					</div>
				@endforeach
			</ul>

			{{-- <form action="{{ route('order.store') }}" method="post"> --}}
			<form action="{{ route('buyer.orders.store', [$store->user->slug, $store->slug]) }}" method="post">
				{{ csrf_field() }}
				<button type="submit" class="btn btn-warning btn-block btn-lg">Naruci</button>
			</form>

		@else
			<h3>Korpa je prazna</h3>

		@endif

	</div>


@endsection