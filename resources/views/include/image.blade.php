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
			    <a class="dropdown-item" href="#">Delete</a>
			  </div>
			</div>
		@endif
	</div>

	<div class="card-body p-0">
		<a href="{{ route('image.detail',['id'=>$image->id]) }}">
			<img src="{{ route('image.file',['filename'=>$image->image_path]) }}" class="img-fluid"></a>
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

			<a href="{{ route('image.detail',['id'=>$image->id]) }}" class="btn btn-primary ml-md-2" type="button"><i class="bi bi-chat"></i>&nbsp;Comments&nbsp;({{ count($image->comments) }})</a>
		</div>
	</div>