@extends('app')

@section('content')

<div class="header--container">
	<div class="header-img-container" style="background-image: url('{{asset('img/jalisco-hemiciclo.jpg')}}');">
		<div class="container h-100">
			<div class="row h-100 justify-content-center align-items-center">
				<div class=" col-md-8 header-text-content">
					<h1 class="title--header">¿Cómo funciona tu Congreso?</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="bg-color-light">
	<div class="container container--infografia">
		<h3 class="title--infografia">EL PROCESO LEGISLATIVO</h3>
		<div class="row justify-content-end">
			<div class="col-md-6 col-lg-2 infografia-img--container">
				<img class="img-1" src="{{asset('img/paso1.png')}}" alt="">
				<div class="circle-infografia circle-1" data-aos="flip-right">
					<span class="icon-infografia icon-presentacion"></span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="content-title-presentacion" data-aos="fade-up">
					<h6 class="numero-infografia">O1</h6>
					<h5 class="title-paso-infografia">PRESENTACION DE LA INICIATIVA</h5>
					<p class="text-infografia">Una iniciativa es una propuesta que busca atender una necesidad de la
						sociedad</p>
				</div>
				<div class="content-text-presentacion" data-aos="fade-up" data-aos-delay="100">
					<p class="subtitle-paso-infografia">El Gobernador del Estado;</p>
					<p class="text-infografia">Los Diputados;
						El Supremo tribunal de Justicia del Estado;
						Los Ayuntamientos del Estado:
						El 0,05% de los ciudadanos inscriptos en el listado nominal del electores del Estado.
					</p>
				</div>
			</div>
		</div>
		<div class="row justify-content-start">
			<div class="col-md-6">
				<div class="content-title-discusion" data-aos="fade-up">
					<h6 class="numero-infografia">O2</h6>
					<h5 class="title-paso-infografia">DISCUSIÓN</h5>
					<p class="text-infografia">En esta etapa, una comisión de diputados revisa su viabilidad, elaborando
						un dictamen donde proponen al pleno del congreso su aprobación.</p>
				</div>
				<div class="content-text-discusion" data-aos="fade-up" data-aos-delay="200">
					<p class="subtitle-paso-infografia">El Gobernador del Estado;</p>
					<p class="text-infografia">El dictamen puede proponer:</p>
					<ul style="width: 80%;">
						<li class="text-infografia">Aprobar la iniciativa tal y como se planteó de un inicio</li>
						<li class="text-infografia">Aprobar la iniciativa con algunas modificaciones, o desechar la
							iniciativa</li>
					</ul>
				</div>
			</div>
			<div class="col-md-6 col-lg-2 infografia-img--container">
				<img class="img-2" src="{{asset('img/paso2.png')}}" alt="">
				<div class="circle-infografia circle-2" data-aos="flip-left">
					<span class="icon-infografia icon-discusion"></span>
				</div>
			</div>
		</div>
		<div class="row justify-content-end">
			<div class="col-md-6 col-lg-2 infografia-img--container">
				<img class="img-3" src="{{asset('img/paso3.png')}}" alt="">
				<div class="circle-infografia circle-3" data-aos="flip-right">
					<span class="icon-infografia icon-aprobacion"></span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="content-title-aprobacion" data-aos="fade-up">
					<h6 class="numero-infografia">O3</h6>
					<h5 class="title-paso-infografia">APROBACIÓN</h5>
					<p class="text-infografia">Presentando el dictamen al pleno del congreso, los diputados abren la
						discusión, algunos se expresan a favor y otros en contra.</p>
				</div>
				<div class="content-text-aprobacion" data-aos="fade-up" data-aos-delay="300">
					<p class="subtitle-paso-infografia">El Gobernador del Estado;</p>
					<p class="text-infografia">Agotada la discusión, se pone a votación la propuesta. El sentido del
						voto puede ser a favor, en contra o en abstención de lograr el mayor consenso posible.</p>
				</div>
			</div>
		</div>
		<div class="row justify-content-start">
			<div class="col-md-6">
				<div class="content-title-sancion" data-aos="fade-up">
					<h6 class="numero-infografia">O4</h6>
					<h5 class="title-paso-infografia">SANCIÓN</h5>
					<p class="text-infografia">Aquí el Gobernador del estado puede hacer observaciones sobre la
						Constitución o la viabilidad económica u operativa, entre otras.</p>
				</div>
				<div class="content-text-sancion" data-aos="fade-up" data-aos-delay="300">
					<p class="text-infografia">Si existen observaciones se regresa al congreso la minuta de ley o de
						decreto (hasta en una ocasión) para estudiar y resolver dichas observaciones.
						Si el congreso insiste en su propuesta original, el Gobernador del estado debe promulgar la ley
						o decreto.</p>
				</div>
			</div>
			<div class="col-md-6 col-lg-2 infografia-img--container">
				<img class="img-4" src="{{asset('img/paso4.png')}}" alt="">
				<div class="circle-infografia circle-4" data-aos="flip-left">
					<span class="icon-infografia icon-sancion"></span>
				</div>
			</div>
		</div>
		<div class="row justify-content-end">
			<div class="col-md-6 col-lg-2 infografia-img--container">
				<img class="img-5" src="{{asset('img/paso5.png')}}" alt="">
				<div class="circle-infografia circle-5" data-aos="flip-right">
					<span class="icon-infografia icon-promulgacion"></span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="content-title-promulgacion" data-aos="fade-up">
					<h6 class="numero-infografia">O5</h6>
					<h5 class="title-paso-infografia">PROMULGACIÓN</h5>
					<p class="text-infografia">Para que una ley o un decreto puedan ser obligatorios deben ser publicador en el Periódico Oficial del Estado de jalisco. Esta publicación le da vida al trabajo del congreso del Estado y le da formalidad a la nueva norma.</p>
				</div>
			</div>
		</div>
		<div class="row justify-content-start">
			<div class="col-md-6">
				<div class="content-title-vigencia" data-aos="fade-up">
					<h6 class="numero-infografia">O6</h6>
					<h5 class="title-paso-infografia">VIGENCIA</h5>
				</div>
				<div class="content-text-vigencia" data-aos="fade-up" data-aos-delay="200">
					<p class="subtitle-paso-infografia">¡Mision cumplida!</p>
					<p class="text-infografia">Aquí empiezan a ser obligatorias para todos, las propuestas de ley o decreto que nacieron como un simple sueño; la iniciativa legislativa</p>
				</div>
			</div>
			<div class="col-md-6 col-lg-2 infografia-img--container">
				<img class="img-6" src="{{asset('img/paso6.png')}}" alt="">
				<div class="circle-infografia circle-6" data-aos="flip-left">
					<span class="icon-infografia icon-vigencia"></span>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="container-seccion container-terminologia">
	<h3 class="title--terminologia pb-3">Terminología Legislativa</h3>

	<ul class="nav nav-pills tab-terminologia" id="pills-tab" role="tablist">
		
		<?php
		for ($i=65;$i<=90;$i++) {
			$active = "";
			$selected = "false";
			if($i == ord($letra)){
				$active = "active";
				$selected="true";
			}?>   
		 <li class="nav-item" role="presentation">
			<a class="nav-link {{$active}}" id="{{chr($i)}}-cards-tab" data-toggle="pill" href="#{{chr($i)}}-cards" role="tab"
				aria-controls="pills-{{chr($i)}}" aria-selected="{{$selected}}">{{chr($i)}}</a>
		</li>         
						 
		<?php }?>
	   
	</ul>
	<div class="tab-content" id="pills-tabContent">
	   
	   
		<?php

		for ($i=65;$i<=90;$i++) {
			$active = "";
			$selected = "false";
			if($i == ord($letra)){?>
				<div class="tab-pane fade active show" id="{{chr($i)}}-cards" role="tabpanel" aria-labelledby="pills-{{chr($i)}}-tab">
					<div class="row">
						<?php 
						
						if(isset($terminos[(string)chr($i)]) && count($terminos[(string)chr($i)])> 0){
							foreach ($terminos[(string)chr($i)] as $key => $value) {
								?>
								
								<div class="col-lg-3 col-md-6 mb-4">
									<div class="card card-terminologia--content">
										<div class="card-body">
											<h5 class="title-card-terminologia">{{$value->nombre}}</h5>
											<p class="text-card-terminologia text-justify">{{$value->definicion}}</p>
										</div>
									</div>
								</div>
								
							<?php }
						}else{
							 echo '<div class="col-lg-3 col-md-6 mb-4">
									<div class="card card-terminologia--content">
										<div class="card-body">
											<h5 class="title-card-terminologia">Sin términos</h5>
											
										</div>
									</div>
								</div>';
						}?>
					</div>
				</div>
			<?php }else{?>
			 <div class="tab-pane fade" id="{{chr($i)}}-cards" role="tabpanel" aria-labelledby="pills-{{chr($i)}}-tab">
				  <div class="row">
						<?php 
						
						if(isset($terminos[(string)chr($i)]) && count($terminos[(string)chr($i)])> 0){
							foreach ($terminos[(string)chr($i)] as $key => $value) {
								?>
								
								<div class="col-lg-3 col-md-6 mb-4">
									<div class="card card-terminologia--content">
										<div class="card-body">
											<h5 class="title-card-terminologia">{{$value->nombre}}</h5>
											<p class="text-card-terminologia">{{$value->definicion}}</p>
										</div>
									</div>
								</div>
								
							<?php }
						}else{
							echo '<div class="col-lg-3 col-md-6 mb-4">
									<div class="card card-terminologia--content">
										<div class="card-body">
											<h5 class="title-card-terminologia">Sin términos</h5>
											
										</div>
									</div>
								</div>';
						}?>
					</div>
			 </div>
		   <?php }?>   
			
						 
		<?php }?>

	</div>

</section>


<section class="container-seccion container--faq">
	<h3 class="title--terminologia">Preguntas más frecuentes</h3>
	<div class="accordion" id="accordionExample">
		<div class="card faq-card--content">
			<div class="card-header" id="headingOne">
				<h2 class="title-faq mb-0">
					<button class="btn btn-block text-left" type="button" data-toggle="collapse"
						data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						¿Cómo puedo comentar un asunto que se está discutiendo?
					</button>
				</h2>
			</div>
			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body text-faq">
					Observe las iniciativas que se encuentran en discusión, seleccione la que desee comentar y dé clic
					en el botón COMENTAR, es requerido que escriba su nombre completo y dirección de correo electrónico,
					de ser necesario adjunte un archivo con sus observaciones con extensión .PDF y dé clic sobre la
					opción “No soy un Robot”, por ultimo dé clic en el botón ENVIAR, la información proporcionada se
					enviará a los diputados de la comisión dictaminadora.
				</div>
			</div>
		</div>
		<div class="card faq-card--content">
			<div class="card-header" id="headingTwo">
				<h2 class="title-faq mb-0">
					<button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
						data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						¿Qué tipo de archivos puedo adjuntar en mi comentario?
					</button>
				</h2>
			</div>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
				<div class="card-body text-faq">
					Podrá adjuntar solo archivos con formato en .pdf.
				</div>
			</div>
		</div>
		<div class="card faq-card--content">
			<div class="card-header" id="headingThree">
				<h2 class="title-faq mb-0">
					<button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
						data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						¿Cómo saber si tomaron en cuenta mis opiniones?
					</button>
				</h2>
			</div>
			<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
				<div class="card-body text-faq">
					Cuando usted proporcionó sus comentarios, el sistema generó un número de folio que le fue enviado al
					correo que usted registró, cuando se encuentre terminado el proyecto de dictamen el sistema le
					enviará un correo donde podrá verificar si sus opiniones fueron tomadas en consideración.
				</div>
			</div>
		</div>
		<div class="card faq-card--content">
			<div class="card-header" id="headingFour">
				<h2 class="title-faq mb-0">
					<button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
						data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
						¿Cómo puedo ver el documento original que se encuentra en estudio en la comisión?
					</button>
				</h2>
			</div>
			<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
				<div class="card-body text-faq">
					Localice el número de INFOLEJ de la iniciativa que desea comentar, del lado izquierdo de la pantalla
					busque el icono de archivo. Dé clic sobre el para visualizar el archivo original.
				</div>
			</div>
		</div>

	</div>
</section>

@endsection

  