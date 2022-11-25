@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
		   @include('include.message')

		   @foreach ($images as $image)
				<div class="card">
					<div class="card-header">
						@if ($image->user->avatar)
							<img src="{{ route('user.avatar',['filename'=>$image->user->avatar]) }}" alt="mdo" width="32" height="32" class="rounded-circle align-middle">
						@endif
						<strong class="ml-2 align-middle">{{ $image->user->name.' '.$image->user->surname }}</strong>
					</div>

					<div class="card-body">
					</div>
				</div>
		   @endforeach
		</div>
	</div>
</div>
@endsection
