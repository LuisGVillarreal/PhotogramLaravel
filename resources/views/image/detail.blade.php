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
						{{ ' | '.\FormatTime::LongTimeFilter($image->created_at) }}
						<p class="m-0 mb-1">{{ $image->description }}</p>
						<button type="button" class="btn btn-outline-danger"><i class="bi bi-heart"></i>&nbsp;Like</button>
						<button class="btn btn-primary ml-md-2" type="button" disabled><i class="bi bi-chat"></i>&nbsp;Comments&nbsp;({{ count($image->comments) }})</button>
						<form class="row mt-3">
							<input type="hidden" name="image_id" value="{{ $image->id }}">
							<div class="col mb-2">
								<label for="content" class="form-label">Comments</label>
								<textarea class="form-control" id="content" name="content" rows="2"></textarea>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-outline-primary">Submit</button>
							</div>
						</form>
					</div>
				</div>
				<div class="list-group">
					<a href="#" class="list-group-item list-group-item-action">
						<div class="d-flex w-100 justify-content-between">
							<h5 class="mb-1">List group item heading</h5>
							<small class="text-muted">3 days ago</small>
						</div>
						<p class="mb-1">Some placeholder content in a paragraph.</p>
						<small class="text-muted">And some muted small print.</small>
					</a>
				</div>
		</div>
	</div>
</div>
@endsection