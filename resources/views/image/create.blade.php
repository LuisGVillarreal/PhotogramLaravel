@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Upload image
				</div>
				<div class="card-body">
					<form method="post" action="" enctype="multipart/form-data">
						@csrf
						<div class="form-group row">
							<label for="image_path" class="col-md-3 col-form-label text-md-right">Image</label>
							<div class="col-md-7">
								<input type="file" name="image_path" id="image_path" class="form-control p-1 @error('image_path') is-invalid @enderror" required>
								@error('image_path')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="description" class="col-md-3 col-form-label text-md-right">Description</label>
							<div class="col-md-7">
								<textarea type="text" name="description" id="description" class="form-control p-1 @error('description') is-invalid @enderror" required></textarea>
								@error('description')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('Upload image') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection