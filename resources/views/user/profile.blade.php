@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="d-flex">
				<div class="avatar mx-5">
					@if ($user->avatar)
						<img src="{{ route('user.avatar',['filename'=>$user->avatar]) }}" alt="mdo" width="150" height="150" class="rounded-circle align-middle">
					@endif
				</div>
				<div class="info">
					<h2>{{ '@'.$user->nick }}</h2>
					<p class="lead"><strong>{{ count($user->images) }}</strong> posts</p>
					<p class="">
						<strong>{{ $user->name.' '.$user->surname }}</strong><br>
						{{ 'Joined '.\FormatTime::LongTimeFilter($user->created_at) }}
					</p>
				</div>
			</div>
			<hr>
			<div class="row row-cols-1 row-cols-md-2">
				@foreach ($user->images as $image)
					@include('include.simpleImage', ['image' => $image])
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection