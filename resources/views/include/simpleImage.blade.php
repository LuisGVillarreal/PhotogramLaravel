<div class="col mb-4">
	<div class="card">
		<a href="{{ route('image.detail',['id'=>$image->id]) }}">
			<img src="{{ route('image.file',['filename'=>$image->image_path]) }}" class="img-fluid">
		</a>
		  <div class="card-footer">
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

			<a href="{{ route('image.detail',['id'=>$image->id]) }}" class="btn btn-primary ml-md-2" type="button"><i class="bi bi-chat"></i>&nbsp;Comments&nbsp;({{ count($image->comments) }})</a>
		</div>
	</div>
</div>