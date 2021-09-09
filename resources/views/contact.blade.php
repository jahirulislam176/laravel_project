@extends('layouts.headerfooter')
@section('main')
  <!-- Page Info -->
	<div class="page-info-section page-info">
		<div class="container">
			<div class="site-breadcrumb">
				<a href="">Home</a> /
				<span>Contact</span>
			</div>
			<img src="{{ asset('frontend/img/page-info-art.png')}}" alt="" class="page-info-art">
		</div>
	</div>
	<!-- Page Info end -->


	<!-- Page -->
	<div class="page-area contact-page">
		<div class="container spad">
			<div class="text-center">
				<h4 class="contact-title">Get in Touch</h4>
			</div>
			@if(session('Status'))
				<div class="mb-3 bg bg-success p-3">
					<h2 class="offset-3">{{ session('Status') }}</h2>

				</div>
			@endif
			<form class="contact-form" action="{{ url('message/insert') }}" method="post">
				@csrf
				<div class="mb-4">
					<h2 style="text-align:center"> Message To Admin</h2>

				</div>
				<div class="row">
					<div class="col-md-6">
						<input type="text" name="first_name" placeholder="First Name *">
					</div>

					<div class="col-md-6">
						<input type="text" name="last_name" placeholder="Last Name *">
					</div>

					<div class="col-md-6">
						<input type="text" name="phone_number" placeholder="Enter Your Phone Number">
					</div>

					<div class="col-md-6">
						<input type="email" name="email" placeholder="Enter Your Email Address">
					</div>

					<div class="col-md-12">
						<input type="text" placeholder="Subject">
						<textarea placeholder="Message" name="message"></textarea>
						<div class="text-center">
							<button class="site-btn">Send Message</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="container contact-info-warp">
			<div class="contact-card">
				<div class="contact-info">
					<h4>Shipping & Returnes</h4>
					<p>Phone:    +53 345 7953 32453</p>
					<p>Email:   yourmail@gmail.com</p>
				</div>
				<div class="contact-info">
					<h4>Informations</h4>
					<p>Phone:    +53 345 7953 32453</p>
					<p>Email:   yourmail@gmail.com</p>
				</div>
			</div>
		</div>
		<div class="map-area">
			<div class="map" id="map-canvas"></div>
		</div>
	</div>
	<!-- Page end -->
@endsection
