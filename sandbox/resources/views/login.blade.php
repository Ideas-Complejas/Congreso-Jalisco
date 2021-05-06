<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login Template</title>
	<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('css/assets/css/login.css')}}">
</head>
<body>
	<main>
		<div class="container-fluid">
			<div class="row" style="height: 100%">
				<div class="col-sm-6 login-section-wrapper">
					<div class="brand-wrapper">
						<img src="{{asset('img/logo.png')}}" alt="logo" class="logo">
					</div>
					<div class="login-wrapper my-auto">
						<h1 class="login-title">Iniciar sesión</h1>
						<form method="POST" action="{{ route('login') }}" onsubmit="$('#preloader').css('display', 'block');" autocomplete="off" autocomplete="nope">
							<div class="form-group">
								<label for="email">Usuario</label>
								<input type="email" name="user" id="user" class="form-control" placeholder="email@example.com">
							</div>
							<div class="form-group mb-4">
								<label for="password">Contraseña</label>
								<input type="password" name="password" id="password" class="form-control" placeholder="enter your passsword">
							</div>
							<input name="login" id="login" class="btn btn-block login-btn" type="button" value="Login">
						</form>
						<a href="#!" class="forgot-password-link text-center">¿Olvidaste tu contraseña?</a>
						
					</div>
				</div>
				<div class="col-sm-6 px-0 d-none d-sm-block">
					<div style="background-image: url('css/assets/images/login.jpg');background-size: cover;background-repeat: no-repeat;background-position: center center;height: 100%"></div>
				</div>
			</div>
		</div>
	</main>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
