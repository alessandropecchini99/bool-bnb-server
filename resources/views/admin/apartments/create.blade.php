@extends('admin.layouts.base')

@vite(['resources/js/tomtom-autocomplete.js'])

@section('content')

	<div class="container mt-3 mb-3">
		<h2>Create Apartment</h2>
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<div class="row">
				<div class="col form-group">
					<label for="name">New Apartment Name:</label>
					<input type="text" class="form-control" id="name" name="name" placeholder="New Apartment name" required>
				</div>
			</div>
			<hr class="mt-4">

			<div class="row">
				<div class="col form-group" id="ms-input-wrap-address">
					<label for="address" id="address-label">Search Address: </label>
					<!--    TOM TOM INPUT    -->
				</div>
                <!-- Hidden input fields for latitude and longitude -->
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
			</div>

			<div class="row mt-3">
				<div class="col form-group">
					<label for="street">Street:</label>
					<input type="text" id="street" class="form-control" name="street" placeholder="Street" required>
				</div>

				<div class=" col form-group">
					<label for="city">City:</label>
					<input type="text" id="city" class="form-control" name="city" placeholder="City" required>
				</div>

				<div class="col form-group">
					<label for="zip">ZIP:</label>
					<input type="text" id="zip" class="form-control" name="zip" placeholder="ZIP" required>
				</div>
			</div>


			<div class="row mt-3">
				<div class="col form-group">
					<label for="rooms">Rooms:</label>
					<input type="number" class="form-control" id="rooms" name="rooms" placeholder="Rooms" required>
				</div>

				<div class="col form-group">
					<label for="beds">Beds:</label>
					<input type="number" class="form-control" id="beds" name="beds" placeholder="Beds" required>
				</div>

				<div class="col form-group">
					<label for="bathrooms">Bathrooms:</label>
					<input type="number" class="form-control" id="bathrooms" name="bathrooms" placeholder="Bathrooms" required>
				</div>

				<div class="col form-group">
					<label for="square_meters">Square Meters:</label>
					<input type="number" class="form-control" id="square_meters" name="square_meters" placeholder="Square meters"
						required>
				</div>
			</div>

			<hr class="mt-4">
			<div class="form-group">
				<label>Services:</label><br>
				<div class="row row-cols-2 row-cols-sm-3 row-cols-md-4">
					@foreach ($services as $service)
						<div class="p-2 col d-flex justify-content-center">
							<label class="checkbox-inline d-flex flex-row justify-content-start ms-checkbox-label">
								<input type="checkbox" name="services[]" value="{{ $service['id'] }}"
									class="h-100 d-flex align-items-center ms-custom-checkbox">
								<span class="ms-3 ms-icon-wrap d-flex align-items-center">
									<i style="color: #9153a9" class="fs-icon {{ $service['icon'] }}"></i>
									<span class="ms-3 name">
										{{ $service['name'] }}
									</span>
								</span>
							</label>
						</div>
					@endforeach
				</div>
			</div>

			<div class="form-group mt-3">
				<label for="images">Upload Images (min 5):</label>
				<input type="file" class="form-control-file" id="images" name="images[]" accept="image/*" multiple required>
			</div>

			<div class="d-flex gap-1 mt-3">
				<a class="btn btn-secondary" href="{{ route('admin.apartments.index') }}">Back</a>
				<button type="submit" class="btn myBtnPurple" style="background-color: #485ba1; color: white;">Create Apartment</button>
			</div>
		</form>
	</div>

	<link rel="stylesheet" type="text/css"
		href="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.12/SearchBox.css" />
	<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.18.0/services/services-web.min.js"></script>
	<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.12/SearchBox-web.js"></script>

@endsection
