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
						<img src="{{ route('image.file',['filename'=>$image->image_path]) }}" class="img-fluid">
					</div>
					<div class="card-footer">
					  <strong>{{ '@'.$image->user->nick }}</strong>
					  <p class="m-0">{{ $image->description }}</p>
					</div>
				</div>
		   @endforeach
		   {{ $images->links() }}
		</div>
	</div>
</div>
@endsection
