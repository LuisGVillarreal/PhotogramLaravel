@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<h1>My Profile</h1>
			<hr>
			@foreach ($user->images as $image)
				@include('include.image', ['image' => $image])
			@endforeach
		</div>
	</div>
</div>
@endsection