<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Congreso Jalisco Abierto</title>

	<!-- styles  -->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/tablet.css') }}" media="(min-width: 930px)">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,400;0,600;1,700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
	<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
	<link href="{{ asset('DataTables/datatables-full.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('css/assets/css/login.css')}}">
</head>
<body>

	<div class="container-fluid">
		<div class="row" style="height: 100%">
			<div class="col-sm-6 login-section-wrapper">
				<div class="brand-wrapper">
					<img src="{{asset('img/logo.png')}}" alt="logo" class="logo">
				</div>
				<div class="login-wrapper my-auto">
					<h1 class="login-title">Iniciar sesión</h1>
					<form method="POST" action="{{ route('login') }}" onsubmit="$('#preloader').css('display', 'block');" autocomplete="off" autocomplete="nope">
						@csrf
						<div class="form-group">
							<label for="email">Usuario</label>
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="form-group mb-4">
							<label for="password">Contraseña</label>
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

							@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<input type="submit" name="login" id="login" class="btn btn-block btn-purple"  value="Login">
					</form>
					
				</div>
			</div>
			<div class="col-sm-6 px-0 d-none d-sm-block">
				<div style="background-image: url('css/assets/images/jalisco-hemiciclo.jpg');background-size: cover;background-repeat: no-repeat;background-position: center center;height: 100%"></div>
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
	<script src="{{ asset('js/jalisco.js') }}"></script>
	<script src="{{ asset('DataTables/datatables-full.js') }}" defer></script>
	<script src="{{ asset('DataTables/js/vfs_fonts.js') }}" defer></script>

</body>
</html>
