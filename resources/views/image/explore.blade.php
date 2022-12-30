@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="d-flex justify-content-between">
				<h1>Explore @isset ($tag) #{{ $tag }} @endisset</h1>
				<form method="GET" action="{{ route('explore') }}" class="form-inline" id="formSearchExplore">
					<input type="text" class="form-control mb-2 mr-sm-2" id="searchExplore" placeholder="Search Image">

					<input type="submit" class="btn btn-primary mb-2" value="Submit">
				</form>
			</div>
			<hr>
			<div class="row row-cols-1 row-cols-md-2">
				@foreach ($images as $image)
					@include('include.simpleImage', ['image' => $image])
				@endforeach
				{{ $images->links() }}
			</div>
		</div>
	</div>
</div>
@endsection