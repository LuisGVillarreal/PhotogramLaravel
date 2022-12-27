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
			    <a class="dropdown-item" href="{{ route('image.edit', ['id' => $image->id]) }}">Edit</a>
			    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteModalImg{{$image->id}}">Delete</button>
			  </div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="deleteModalImg{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="confirmModalLabel">Delete</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							Are you sure you want to delete this image?
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
							<a class="btn btn-danger" href="{{ route('image.delete', ['id' => $image->id]) }}">Yes</a>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>

	<div class="card-body p-0">
		<a href="{{ route('image.detail',['id'=>$image->id]) }}">
			<img src="{{ route('image.file',['filename'=>$image->image_path]) }}" class="img-fluid"></a>
		</div>
		<div class="card-footer">
			<p class="m-0 mb-1">{!! html_entity_decode(\HashtagLinks::getLinks($image->description) ) !!}</p>

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
