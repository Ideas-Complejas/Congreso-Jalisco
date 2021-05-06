@extends('app')

@section('content')

<div class="header--container">
	<div class="header-img-container"  style="background-image: url('{{asset('img/jalisco-hemiciclo.jpg')}}');">
		<div class="container h-100">
			<div class="row h-100 justify-content-center align-items-center">
				<div class=" col-md-8 header-text-content">
					<h1 class="title--header">Conoce a tus diputados</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<section>
	<div class="container container--title-diputados">
		<h3 class="title--diputados">Grupos parlamentarios</h3>
		<p class="subtext--diputados">Identifica quien es el representante de tu distrito electoral de manera fácil y rápida.
		</p>
	</div>

	<div class="container-cards-diputados">
		<?php if($partidos){
			foreach ($partidos as $key => $value) {?>
				 <div>
					<h5 class="title--partido">{{$value->partido}}</h5>
					<div class="border-line"></div>
				</div>
				<?php if($value->diputados){

					echo '<div class="row mb-5">';
					foreach($partidos[$key]->diputados as $key_d =>$value_d){?>
					   
						<div class="col-lg-4 col-md-6 mb-3">
							<div class="card mb-3 card-perfil-diputado" style="max-width: 540px;">
								<div class="row no-gutters">
									<div class="col-md-5">
										<div style="background-image: url('{{$value_d->fotos}}');"
											class="img-cards-diputados img-bg"></div>
									</div>
									<div class="col-md-7">
										<div class="card-body h-100">
											<div class="content-name-diputado">
												<div class="content--name-diputado">
													
														<span><i class="fas fa-circle icon-circle color-pan"></i></span>
														<p class="text-name-diputado">{{$value_d->nombre}} {{$value_d->apellido_pat}} {{$value->apellido_m}}</p>
													
												</div>
												<p class="card-text text-tipo-diputado">{{$value_d->distrito}}</p>
											</div>
											
											<div class="content--button-perfil">
												<a href="{{ url('perfil_diputado') }}/{{$value_d->id_diputado}}" class="button-detalle">ver perfil<i
														class="fas fa-chevron-right"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					<?php } echo "</div>";
				}?>

			   
			<?php }
		}?>
		
		

		
	   
	</div>
</section>

@endsection
