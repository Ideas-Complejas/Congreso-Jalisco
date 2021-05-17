<nav class="navbar navbar-expand-lg fixed-top fixed-navbar-light">
	<div class="container">
	<a class="navbar-brand mb-1" href="{{ url('/') }}">
		<img src="{{asset('img/logo.png')}}" alt="" style="width: 60px;">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="{{ url('/') }}">Inicio <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('comisiones') }}">Iniciativas</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('congreso') }}">Congreso</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('diputados') }}">Diputados</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ url('/datos') }}">Datos abiertos</a>
			</li>
			@guest
			@else
			
					<li class="nav-item content-user-nav dropdown min_content pr-3">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							<span class="nav-user-name">{{ Auth::user()->get_name() }} </span>
							<span class="caret"></span>
							<div class="d-inline-block">
								<i class="far fa-user" style="font-size: 0.8em"></i>
							</div>
						</a>

						<div class="dropdown-menu dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item dropdown_style" href="{{ route('configuraciones') }}">
							{{ __('Configuraciones') }}
							</a>
							<a class="dropdown-item dropdown_style" href="{{ route('logout') }}" onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
							{{ __('Cerrar sesión') }}
							</a>

							<form id="logout-form" class="dropdown_style" action="{{ route('logout') }}" method="POST" style="display: none;" autocomplete="off" autocomplete="nope">
								@csrf
							</form>

						</div>
					</li>
			@endguest
		</ul>
	</div>
	</div>
</nav>