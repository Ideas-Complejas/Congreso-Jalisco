@extends('app')

@section('content')

<div class="header--container">
	<div class="header-img-container" style="background-image: url('{{asset('img/portada.png')}}');">
		<div class="container h-100">
			<div class="row h-100 justify-content-center align-items-center">
				<div class=" col-md-8 header-text-content">
					<h1 class="title--header">Perfil de diputado(a)</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="container-seccion">
	<div class="mt-5 mb-5">
		<div class="row">
			<div class="col-md-4">
				<div style="background-image: url('{{$diputado->fotos}}');" class="img-perfil-diputado img-bg">
				</div>
			</div>
			<div class="col-md-8">
				<div class="content--name-diputado">
					<p class="text-name-diputado-perfil">Dip. {{$diputado->nombre}} {{$diputado->apellido_pat}} {{$diputado->apellido_m}}</p>
				</div>
				<div class="content-datos-diputado">
					<p class="partido-diputado--perfil">
						<span><i class="fas fa-circle icon-circle color-pan"></i></span>
						{{$diputado->partido}}
					</p>
					
				</div>
				<div class="content-datos-diputado">
					<div class="text-datos-diputados">
						<span>Teléfono:</span>
						<p>{{$diputado->tel}}</p>
					</div>
					<div class="text-datos-diputados">
						<span>Extensión:</span>
						<p>{{$diputado->ext}}</p>
					</div>
				</div>
				<div class="content-datos-diputado">
					<div class="text-datos-diputados">
						<span>Correo:</span>
						<p>{{$diputado->correo_electronico}}</p>
					</div>
					<div class="text-datos-diputados">
						<span>Ubicación:</span>
						<p>{{$diputado->oficina}}</p>
					</div>
				</div>
				<div class="content-datos-diputado">
					<span class="tipo-diputado--perfil">Representación:</span>
					<p>{{$diputado->distrito}} <br> {{$diputado->municipios}}</p>
				</div>
				<a href="{{$diputado->link_perfil}}" target="_blanck"><button type="button" class=" mt-5 mb-5 btn btn-purple float-left"></i> Ver detalle</button> </a>
			</div>

		</div>
	</div>

	
</section>


@endsection
