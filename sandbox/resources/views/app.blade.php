<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Congreso Jalisco Abierto</title>

		<!-- styles -->
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
		<!--modal para lanzar el buzón-->
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
						<form id="form_buzon">
							{{ csrf_field() }}

													
							<div class="form-group">
								<label for="correo" class="col-form-label">Queja, sugerencia o comentario</label>
								<textarea type="text" class="form-control validation" minlength="5" rows="5" name="body"></textarea>
							</div>
							<!--catcha-->
							<div class="form-group">
								<label>Ingrese el código de seguridad</label>
								
								<input type="text" name="securityCode" id="securityCode" class="form-control" placeholder="Código de seguridad" required="">
								<div class="invalid-feedback">Completa el campo</div>
							</div>
							<div class="form-group col-md-12">
								<div class="row">
									<label class="p-0 col-md-12 control-label"> <img style="border: 1px solid #D3D0D0" src="{{url('/')}}/captcha.php?rand=<?php echo rand(); ?>" id='captcha'></label>

									<div class="p-0 mt-2 col-md-12">
										<a href="javascript:void(0)" id="reloadCaptcha" style="text-decoration: none; cursor: pointer;"><i class="ml-5 fas fa-redo refresh-captcha"></i>
										 <span style="color:white">Recargar codigo</span></a>
									</div>
								</div>
							</div>
							<!--fin catcha-->
						
							
						</form>
						<button id="send_buzon" class="btn btn-purple">Enviar</button>
					</div>
					
				</div>
			</div>
		</div>
		<!--diseño preloader-->
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
		<!--manda a llamar al view del navbar-->
		@include('navbar')
		
		<!-- manda a llamar todo contenido de página-->
		@yield('content')

		<!--botón flotante que al ser presionado lanza modal del buzón-->
		<a class='btn-flotante' data-toggle="modal" data-target="#modal-buzon" ><img src="{{asset('icons/mailbox.svg')}}"></i></a>
		<!--llama al view del footer-->
		@include('footer')
		
		

		<!--scripts-->
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
		<script src="{{ asset('js/jalisco.js') }}"></script>
		<script src="{{ asset('DataTables/datatables-full.js') }}" defer></script>
		<script src="{{ asset('DataTables/js/vfs_fonts.js') }}" defer></script>
		<script src="{{ asset('js/jquery.expander.js') }}" defer></script>

		<script type="text/javascript">
			$(document).ready(function(){
				var SITEURL = '{{URL::to('')}}'; 
				var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
				//Función que manda el correo cuando se confirma en el modal del buzón
				$('body').off('click',"#send_buzon");
				$('body').on('click', '#send_buzon', function () {
					var idp = $(this).attr("idp");
					var idi = $(this).attr("idi");
					
					$("#preloader").css("display", "block");
					var formulario = $("#form_buzon").serialize();

					$.ajax({
						type: "post",
						url: SITEURL + "/send_comentario",
						data:formulario,
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						success: function (data) {
							if(data.status == "200"){
								$("#modal-buzon").modal("hide");
								$('.modal-backdrop').remove();
								bootbox.alert({
									message: "¡Mensaje enviado con éxito!",
									callback: function () {
										setTimeout(function() {
											location.reload();
										},200);
									}
								});
								
							}else if (data.status == "422"){
								var error = data.msg;
								var mensaje = "";
								for (var i in error) {
									var error_msg = error[i];
									mensaje = mensaje + error_msg+"<br>";
								}
								bootbox.alert(mensaje);
							}else{
								bootbox.alert("¡Error al enviar el mensaje!");
							}
						},
						error: function (data) {
							console.log('Error:', data);
							bootbox.alert("¡Error al enviar el mensaje!");
						},
						complete: function(){
							setTimeout(function() {
								$("#preloader").fadeOut(500);
							},200);
						}
					});
					
				});
			});

			//Función que se ejecuta al dar clic en renovar el captcha
			$("#reloadCaptcha").click(function(){
	  			var captchaImage = $('#captcha').attr('src');
	  			captchaImage = captchaImage.substring(0,captchaImage.lastIndexOf("?"));
	  			captchaImage = captchaImage+"?rand="+Math.random()*1000;
	  			$('#captcha').attr('src', captchaImage);
	  		});
		</script>
		<!--en caso de que cada view de página contenga scripts aquí los anexa-->
		@yield('scripts')
	</body>
</html>
