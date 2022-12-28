@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			@include('include.message')
			<div class="card">
				<div class="card-header">
					Edit image
				</div>
				<div class="card-body">
					<form method="post" action="{{ route('image.update') }}">
						@csrf
						<input type="hidden" name="image_id" value="{{ $image->id }}">
						<div class="form-group row">
							<label for="image_path" class="col-md-3 col-form-label text-md-right">Image</label>
							<div class="col-md-7">
								<img src="{{ route('image.file',['filename'=>$image->image_path]) }}" height="100">
							</div>
						</div>

						<div class="form-group row">
							<label for="description" class="col-md-3 col-form-label text-md-right">Description</label>
							<div class="col-md-7">
								<textarea type="text" name="description" id="description" class="form-control p-1 @error('description') is-invalid @enderror" required>{{ $image->description }}</textarea>
								@error('description')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row mb-2">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('Update image') }}
								</button>
							</div>
						</div>
					</form>
					<hr>
					@if (session('tagsTemp'))
						@php
							session(['tagsImg'.$image->id => session('tagsTemp')]);
						@endphp
					@endif
					@if (session('tagsImg'.$image->id))
						<div class="col-md-6 offset-md-3  mb-2">
							<h5>AI-generated Tags</h5>
						@foreach(session('tagsImg'.$image->id) as $tag)
							<div class="row align-items-center">
								<span class="col-3 pr-0">#{{ $tag->tag->en }}</span>
								<div class="col-9 p-0">
									<div class="progress">
									  <div class="progress-bar" role="progressbar" style="width: {{ $tag->confidence }}%;" aria-valuenow="{{ $tag->confidence }}" aria-valuemin="0" aria-valuemax="100">{{ number_format($tag->confidence,1) }}%</div>
									</div>
								</div>
							</div>
						@endforeach
						</div>
					@else
						<form method="post" action="{{ route('api.tag') }}">
							@csrf
							<input type="hidden" name="image_id" value="{{ $image->id }}">
							<div class="form-group row">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-secondary">
										{{ __('Generate Tag') }}
									</button>
								</div>
							</div>
						</form>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection