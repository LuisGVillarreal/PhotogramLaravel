@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
				<div class="card mb-3">
					<div class="card-header">
						@if ($image->user->avatar)
							<img src="{{ route('user.avatar',['filename'=>$image->user->avatar]) }}" alt="mdo" width="32" height="32" class="rounded-circle align-middle">
						@endif
						<strong class="ml-2 align-middle">{{ $image->user->name.' '.$image->user->surname }}</strong>
					</div>

					<div class="card-body p-0">
						<img src="{{ route('image.file',['filename'=>$image->image_path]) }}" class="img-fluid">
					</div>
					<div class="card-footer">
						<strong>{{ '@'.$image->user->nick }}</strong>
						<p class="m-0 mb-1">{{ $image->description }}</p>
						<button type="button" class="btn btn-outline-danger"><i class="bi bi-heart"></i>&nbsp;Like</button>
						<button class="btn btn-primary ml-md-2" type="button"><i class="bi bi-chat"></i>&nbsp;Comments&nbsp;({{ count($image->comments) }})</button>
					</div>
				</div>
		</div>
	</div>
</div>
@endsection