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
	</head>
	<body>
		<div class="modal left fade modal-buzon" id="modal-buzon" tabindex="-1" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Buzón de quejas, sugerencias y comentarios</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="mailto:suley301194@gmail.com?subject=Buzón%20Congreso%20Jalisco" method="post" enctype="text/plain">

						
							
							
							<div class="form-group">
								<label for="correo" class="col-form-label">Queja, sugerencia o comentario</label>
								<textarea type="text" class="form-control validation" minlength="5" rows="5" name="body"></textarea>
							</div>
							<input class="btn btn-purple" type="submit" value="Enviar" />
						
							
						</form>
					</div>
					
				</div>
			</div>
		</div>

		<div id="preloader">
			<div id="loader">
				<div class="spinner-grow color_preloader" role="status">
					<span class="sr-only">Loading...</span>
				</div>
				<div class="spinner-grow color_preloader" role="status">
					<span class="sr-only">Loading...</span>
				</div>
				<div class="spinner-grow color_preloader" role="status">
					<span class="sr-only">Loading...</span>
				</div>
				<div class="spinner-grow color_preloader" role="status">
					<span class="sr-only">Loading...</span>
				</div>
				<div class="spinner-grow color_preloader" role="status">
					<span class="sr-only">Loading...</span>
				</div>
				<div class="spinner-grow color_preloader" role="status">
					<span class="sr-only">Loading...</span>
				</div>
				<div class="spinner-grow color_preloader" role="status">
					<span class="sr-only">Loading...</span>
				</div>
				<div class="spinner-grow color_preloader" role="status">
					<span class="sr-only">Loading...</span>
				</div>
			</div>
		</div>
		
			@include('navbar')
		

		@yield('content')
		<a class='btn-flotante' data-toggle="modal" data-target="#modal-buzon" ><img src="{{asset('icons/mailbox.svg')}}"></i></a>

		@include('footer')
		@guest
		@else
			
		@endguest
		


		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
		<script src="{{ asset('js/jalisco.js') }}"></script>
		<script src="{{ asset('DataTables/datatables-full.js') }}" defer></script>
		<script src="{{ asset('DataTables/js/vfs_fonts.js') }}" defer></script>
		<script src="{{ asset('js/jquery.expander.js') }}" defer></script>

		@yield('scripts')
	</body>
</html>
