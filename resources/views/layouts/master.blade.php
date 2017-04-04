@extends('layouts.base')


@section('stylesheet')
<link rel="stylesheet" href="{{ asset('css/sticky.css') }}">
@endsection

@section('body')

	@include('partials.header')
	
	<div class="content">
		@yield('content')
	</div>

	@include('partials.footer')
	
@endsection