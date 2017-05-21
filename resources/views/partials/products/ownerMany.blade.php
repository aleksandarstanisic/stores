

	@if(!count($products))
		<div class="d-flex flex-column align-items-center justify-content-center">
			<p class="display-4 my-5">Nema proizvoda</p>
			<a href="{{ route('stores.products.create', [$store->slug]) }}" class="btn btn-primary btn-lg mt-5">Dodajte proizvod</a>
		</div>
	@else
	<div class="d-flex flex-wrap justify-content-center">
		<h2 class="text-center my-4">Proizvodi u prodavnici: "{{ $store->name }}"</h2>
		<h3 class="text-center"><a href="{{ route('stores.products.create', [$store->slug]) }}" class="btn btn-primary btn-lg">Dodaj proizvod</a></h3>

		@foreach($products as $product)
			@component('partials.products.small')
				@slot('name')
					<a href="{{ route('stores.products.show', [$product->store->slug, $product->slug]) }}">{{ $product->name }}</a>
				@endslot
				@slot('price')
					{{ $product->price }}
				@endslot
				@slot('remaining')
					{{ $product->remaining }}
				@endslot
				@slot('routes')
					<a href="{{ route('stores.products.edit', [$product->store->slug, $product->slug]) }}" class="btn btn-primary">Izmeni</a>
					<form action="{{ route('stores.products.destroy', [$product->store->slug, $product->slug]) }}" method="post">
						{{ csrf_field() }}
						{{ method_field('delete') }}
						<button type="submit" class="btn btn-danger">Izbrisi</button>
					</form>
				@endslot
			@endcomponent
		@endforeach
	</div>

	@include('partials.pagination', ['items' => $products])

	@endif

