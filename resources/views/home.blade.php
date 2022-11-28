@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
		   @include('include.message')

		   @foreach ($images as $image)
				<div class="card mb-3">
					<div class="card-header">
						@if ($image->user->avatar)
							<img src="{{ route('user.avatar',['filename'=>$image->user->avatar]) }}" alt="mdo" width="32" height="32" class="rounded-circle align-middle">
						@endif
						<strong class="ml-2 align-middle">{{ $image->user->name.' '.$image->user->surname }}</strong>
					</div>

					<div class="card-body p-0">
						<a href="{{ route('image.detail',['id'=>$image->id]) }}">
						<img src="{{ route('image.file',['filename'=>$image->image_path]) }}" class="img-fluid"></a>
					</div>
					<div class="card-footer">
						<strong>{{ '@'.$image->user->nick }}</strong>
						{{ ' | '.\FormatTime::LongTimeFilter($image->created_at) }}
						<p class="m-0 mb-1">{{ $image->description }}</p>

						@php $user_like = false; @endphp
						@foreach ($image->likes as $like)
							@if ($like->user->id == Auth::user()->id)
								@php $user_like = true; @endphp
							@endif
						@endforeach
						<button type="button" class="btn btn-like @if($user_like) btn-danger @else btn-outline-danger @endif"><i class="bi bi-heart"></i>&nbsp;Like&nbsp;({{ count($image->likes) }})</button>

						<button class="btn btn-primary ml-md-2" type="button"><i class="bi bi-chat"></i>&nbsp;Comments&nbsp;({{ count($image->comments) }})</button>
					</div>
				</div>
		   @endforeach
		   {{ $images->links() }}
		</div>
	</div>
</div>
@endsection
