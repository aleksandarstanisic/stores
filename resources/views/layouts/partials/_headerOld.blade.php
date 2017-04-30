<nav class="navbar navbar-toggleable-sm navbar-inverse bg-inverse">

	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<a class="navbar-brand" href="{{ url('/') }}">
		<h1 class="h3 my-0 p-0 ">
			<img src="{{ asset('img/logo.png') }}" style="height: 32px;"/>
			MyStore
		</h1>
	</a>

	<div class="collapse navbar-collapse text-center" id="navbarTogglerDemo02">

		<ul class="navbar-nav mr-auto mt-2 mt-md-0">

			@foreach($links as $link)
				<li class="nav-item border-bottom-lightgrey py-2 py-sm-0">
					<a class="nav-link" href="{{ route($link->route) }}">{{ $link->name }}</a>
				</li>
			@endforeach
		</ul>

		<div>
		 	@if (Auth::check())
		 		<div class="d-flex">
			 		<a href="{{ route('user.index') }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1">{{ auth()->user()->username }}</a>
					<form action="{{ route('logout') }}" method="post">
						{{ csrf_field() }}
						<button type="submit" class="btn btn-outline-secondary my-3 my-md-0 mx-1">Logout</button>
					</form>
				</div>
	 		@else
				<a href="{{ route('login') }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Login</a>
		      	<a href="{{ route('register') }}" class="btn btn-outline-secondary my-3 my-md-0 mx-1" >Sign Up</a>
	      	@endif
		</div>

	</div>

</nav>