@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			@include('include.message')
				<div class="card mb-3">
					<div class="card-header d-flex align-items-center justify-content-between">
						<div>
							@if ($image->user->avatar)
								<img src="{{ route('user.avatar',['filename'=>$image->user->avatar]) }}" alt="mdo" width="32" height="32" class="rounded-circle align-middle">
							@endif
							<a href="{{ route('profile', ['id' => $image->user->id]) }}" class="link-dark">
								<strong class="ml-2 text-dark">{{ $image->user->name.' '.$image->user->surname }}</strong>
								<span class="text-muted ml-1">{{ '@'.$image->user->nick }}</span>
							</a>&nbsp;
								{{ ' · '.\FormatTime::LongTimeFilter($image->created_at) }}
						</div>
						@if (Auth::user() && Auth::user()->id == $image->user->id)
							<div class="dropdown">
							  <button class="btn btn-light" type="button" data-toggle="dropdown" aria-expanded="false">
							    <i class="bi bi-three-dots"></i>
							  </button>
							  <div class="dropdown-menu dropdown-menu-right">
							    <a class="dropdown-item" href="#">Edit</a>
							    <a class="dropdown-item" href="{{ route('image.delete', ['id' => $image->id]) }}">Delete</a>
							  </div>
							</div>
						@endif
					</div>

					<div class="card-body p-0">
						<img src="{{ route('image.file',['filename'=>$image->image_path]) }}" class="img-fluid">
					</div>
					<div class="card-footer">
						<p class="m-0 mb-1">{{ $image->description }}</p>

						@php $user_like = false; @endphp
						@foreach ($image->likes as $like)
							@if ($like->user->id == Auth::user()->id)
								@php $user_like = true; @endphp
							@endif
						@endforeach
						@if ($user_like)
							<button type="button" class="btn btn-dislike btn-danger" data-id="{{ $image->id }}"><i class="bi bi-heart"></i>&nbsp;Like&nbsp;({{ count($image->likes) }})</button>
						@else
							<button type="button" class="btn btn-like btn-outline-danger" data-id="{{ $image->id }}"><i class="bi bi-heart"></i>&nbsp;Like&nbsp;({{ count($image->likes) }})</button>
						@endif

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
						<div class="d-flex w-100 mb-1 align-items-center">
							<h5 class="flex-grow-1">{{ '@'.$comment->user->nick }}</h5>
							<small class="text-muted mr-2">{{ \FormatTime::LongTimeFilter($comment->created_at) }}</small>
							@if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
								<a href="{{ route('comment.delete', ['id'=>$comment->id]) }}" class="btn btn-outline-danger py-0 px-1"><i class="bi-x-lg"></i></a>
							@endif
						</div>
						<p class="mb-1">{{ $comment->content }}</p>
					</div>
					@endforeach
				</div>
	</div>
</div>
@endsection