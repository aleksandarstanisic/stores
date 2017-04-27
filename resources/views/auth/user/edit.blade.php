@extends('layouts.master')


@section('content')

<div class="container">
	<div class="row">
		<div class="col-lg mt-4">
			<p class="h2 text-center">Izmenite podatke</p>

			<form action="{{ route('user.update') }}" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="patch">

				<div class="form-group">
					<label for="changeUsername">Username</label>
					<input type="text" name="username" class="form-control" id="changeUsername" value="{{ $user->username }}">
				</div>

				<div class="form-group">
					<label for="changeEmail">Email</label>
					<input type="text" name="email" class="form-control" id="changeEmail" value="{{ $user->email }}">
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-warning btn-block">Izmeni podatke</button>
				</div>

			</form>

		</div>

		<div class="col-lg mt-4">
			<p class="h2 text-center">Izmenite lozinku</p>

			<form action="{{ route('user.updatePassword') }}" method="post">
				<input type="hidden" name="_method" value="patch">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="oldPassword">Stara</label>
					<input type="password" name="old_password" class="form-control" id="oldPassword" placeholder="Stari password" required>
				</div>

				<div class="form-group">
					<label for="newPassword">Password</label>
					<input type="password" name="password" class="form-control" id="newPassword" placeholder="Novi password" required>
				</div>

				<div class="form-group">
					<label for="newPasswordConfirmed">Ponovi</label>
					<input type="password" name="password_confirmation" class="form-control" id="newPasswordConfirmed" placeholder=" Ponovi password" required>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-warning btn-block">Izmeni podatke</button>
				</div>

			</form>

		</div>

		<div class="col-12 mt-4">
			<form action="{{ route('user.destroy') }}" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="delete">
				<button type="submit" class="btn btn-danger btn-block" id="profileDelete" disabled>Izbrisi profil</button>
				<button type="button" class="btn btn-danger btn-block" id="enableProfileDelete">Dupli klik da omogucite brisanje</button>
			</form>
		</div>

	</div>
</div>

@endsection