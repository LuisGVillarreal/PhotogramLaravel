@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
           @include('include.message')
			<div class="card">
				<div class="card-header">{{ __('Set up my account') }}</div>

				<div class="card-body">
					<form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
						@csrf

						<div class="form-group row">
							<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

							<div class="col-md-6">
								<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

								@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

							<div class="col-md-6">
								<input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ Auth::user()->surname }}" required autocomplete="surname" autofocus>

								@error('surname')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="nick" class="col-md-4 col-form-label text-md-right">{{ __('Nickname') }}</label>

							<div class="col-md-6">
								<input id="nick" type="text" class="form-control @error('nick') is-invalid @enderror" name="nick" value="{{ Auth::user()->nick }}" required autocomplete="nick" autofocus>

								@error('nick')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>

							<div class="col-md-6">
								<input id="avatar" type="file" class="form-control p-1 @error('avatar') is-invalid @enderror" name="avatar" autocomplete="avatar">
								@error('avatar')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 offset-md-4">
								@if (Auth::user()->avatar)
									{{-- <img src="{{ url('/user/avatar/'.Auth::user()->avatar) }}" height="50"> --}}
									<img src="{{ route('user.avatar',['filename'=>Auth::user()->avatar]) }}" height="50">
								@endif
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('Save') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection