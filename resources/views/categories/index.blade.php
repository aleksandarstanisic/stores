@extends('layouts.dashboard')

@php
	$i = 1; // Sluzi kao inkrement za redni broj radnje
@endphp

@section('content')
	@if(!count($categories))
		<div class="h1 text-center my-5">
			<h2>Nemate nijednu kategoriju</h2>
			<p class="h3">Morate imati makar jednu kategoriju da bi napravili proizvod</p>
			<a href="{{ route('categories.create') }}" class="">Napravite kategoriju</a>
		</div>
	@else
		<div class="container">
			<h2 class="h1 text-center my-4">Vase kategorije</h2>
			<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-default">
					<tr>
						<th class="w-50p">#</th>
						<th class="text-center">Kategorija</th>
						<th class="text-center">Nadkategorija</th>
						<th class="text-center w-100p">Proizvodi</th>
						<th class="text-center w-100p">Izmeni</th>
						<th class="text-center w-100p">Izbrisi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $category)
						<tr>
							<td>{{ $i++ }}</td>

							<td class="text-center h3"><a href="{{ route('categories.show', [$store->id, $category->id]) }}">{{ $category->name }}</a></td>

							@if($category->parent)
								<td class="text-center h4"><a href="{{ route('categories.show', [$store->id, $category->parent->id]) }}">{{ $category->parent->name or '' }}</a></td>
							@else
								<td class="text-center h4"><i class="fa fa-ban" aria-hidden="true"></i></td>
							@endif

							<td class="text-center">
								<a href="{{ route('categories.products', [$store->id, $category->id]) }}" class="btn btn-primary">
									<i class="fa fa-archive" aria-hidden="true"></i>
								</a>
							</td>

							<td class="text-center">
								<a href="{{ route('categories.edit', [$store->id, $category->id]) }}" class="btn btn-primary">
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</a>
							</td>

							<td class="text-center">
								<form method="post" action="{{ route('categories.destroy', [$store->id, $category->id]) }}" >
									{{ csrf_field() }}
									<input type="hidden" name="_method" value="delete">
									<button type="submit" class="btn btn-danger">
										<i class="fa fa-trash" aria-hidden="true"></i>
									</button>
								</form>
							</td>

						</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		</div>
	@endif

@endsection