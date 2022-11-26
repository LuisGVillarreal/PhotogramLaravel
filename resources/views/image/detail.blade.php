@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			@include('include.message')
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
						{{ ' | '.\FormatTime::LongTimeFilter($image->created_at) }}
						<p class="m-0 mb-1">{{ $image->description }}</p>
						<button type="button" class="btn btn-outline-danger"><i class="bi bi-heart"></i>&nbsp;Like</button>
						<button class="btn btn-primary ml-md-2" type="button" disabled><i class="bi bi-chat"></i>&nbsp;Comments&nbsp;({{ count($image->comments) }})</button>
						<hr>
						<form class="row mt-3" method="post" action="{{ route('comment.save') }}">
							@csrf
							<input type="hidden" name="image_id" value="{{ $image->id }}">
							<div class="col mb-2">
								<label for="content" class="form-label">Comment</label>
								<textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="2" required></textarea>
								@error('content')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-outline-primary">Submit</button>
							</div>
						</form>
					</div>
				</div>
				<hr>
				<div class="list-group">
					@foreach ($image->comments as $comment)
					<div class="list-group-item list-group-item-action">
						<div class="d-flex w-100 justify-content-between">
							<h5 class="mb-1">{{ '@'.$comment->user->nick }}</h5>
							<small class="text-muted">{{ \FormatTime::LongTimeFilter($comment->created_at) }}</small>
						</div>
						<p class="mb-1">{{ $comment->content }}</p>
					</div>
					@endforeach
				</div>
		</div>
	</div>
</div>
@endsection