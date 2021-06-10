@extends('app')

@section('content')
<style>
#chartdiv {
  width: 100%;
  height: 500px;
  border: 1px solid #ddd;
}

</style>
<link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">

<div class="" style="height: 100px; background:var(--purple-primary);">
		
</div>
<section>
	<div class="row p-3">
		<div class="col-md-12 pl-5 pr-5 pt-5">
			<h5><b>COMENTARIOS TOTALES POR COMISIÓN</b></h5>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label">Comisión</label>
						<!--Actualmente solo están estos dos roles-->
						<select class="form-control input-materialize" id="comision">
							<option value="0">Selecciona una comisión</option>
							<!-- muestra todas las comisiones que se mandan desde el backend-->
							<?php foreach ($comisiones as $key => $value) {
								echo '<option value="'.$value->id_comision.'">'.$value->nombre_comision.'</option>';
							}?>
							
						</select>
					</div>

				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="row">
							<div class="col">
						
								Fecha inicial: <input id="fecha_inicial" width="276" />
							</div>
							<div class="col">
	        					Fecha final: <input id="fecha_final" width="276" />
	        				</div>
        				</div>
						
					</div>
					
				</div>
				<div class="col-md-2  m-auto">
					<button class="btn btn-purple" id="filtrar_grafica">FILTRAR</button>
				</div>
				
			</div>
			<div id="chartdiv"></div>
		</div>
	</div>
</section>

@endsection
<!--sección de los scripts-->
@section('scripts')
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="{{ asset('js/datepicker.js') }}" defer></script>
<script src="{{ asset('js/datepicker.es.min.js') }}" defer></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		var SITEURL = '{{URL::to('')}}'; 
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		
		//PARA ARMAR LO DE SELECTOR DE RANGO DE FECHAS
		var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#fecha_inicial').datepicker({
            uiLibrary: 'bootstrap4',
             locale: 'es-es',
             format: 'yyyy-mm-dd',
            iconsLibrary: 'fontawesome',
            maxDate: function () {
                return $('#fecha_final').val();
            }
        });
        $('#fecha_final').datepicker({
            uiLibrary: 'bootstrap4',
             locale: 'es-es',
             format: 'yyyy-mm-dd',
            iconsLibrary: 'fontawesome',
            minDate: function () {
                return $('#fecha_inicial').val();
            }
        });

	});
</script>
<script type="text/javascript">
	var SITEURL = '{{URL::to('')}}'; 
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	//función que realiza la gráfica de los comentarios
	function grafica_comentarios(infolej, comentarios){
		am4core.ready(function() {

		// Themes begin
		am4core.useTheme(am4themes_animated);
		// Themes end

		// Create chart instance
		var chart = am4core.create("chartdiv", am4charts.XYChart);

		// Add data
		

		var info_comentarios = comentarios;
		chart.data = info_comentarios;
		console.log(chart.data);
		chart.legend = new am4charts.Legend();
		chart.legend.position = "right";

		// Create axes
		var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "comision";
		categoryAxis.title.text = "Comisiones";

		categoryAxis.renderer.grid.template.location = 0;

		var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
		valueAxis.min = 0;
		valueAxis.renderer.grid.template.opacity = 0;
		valueAxis.renderer.ticks.template.strokeOpacity = 0.5;
		valueAxis.renderer.ticks.template.stroke = am4core.color("#495C43");
		valueAxis.title.text = "Comentarios totales por INFOLEJ";
		valueAxis.renderer.ticks.template.length = 10;
		valueAxis.renderer.line.strokeOpacity = 0.5;
		valueAxis.renderer.baseGrid.disabled = true;
		valueAxis.renderer.minGridDistance = 40;

		// Create series
		function createSeries(field, name) {
		  var series = chart.series.push(new am4charts.ColumnSeries());
		  series.dataFields.valueX = field;
		  series.dataFields.categoryY = "comision";
		  series.stacked = true;
		  series.name = name;
		  series.columns.template.tooltipText = "{name}: {valueX} comentarios totales";
		  series.tooltip.pointerOrientation = "vertical";

		  
		  var labelBullet = series.bullets.push(new am4charts.LabelBullet());
		  labelBullet.locationX = 0.5;
		  labelBullet.label.text = "{valueX}";
		  labelBullet.label.fill = am4core.color("#fff");
		}

		console.log(infolej);
		if(infolej.length >0){
			for (var i = 0; i < infolej.length; i++) {
				//console.log(info_comisiones[i]);
				createSeries(infolej[i],infolej[i]);
			}
		}
		

		}); // end am4core.ready()
	}
	//Función que obtiene la informacion de la gráfica de los comentarios
	function get_graficas(){
		$("#preloader").css("display", "block");
		var id = $("#comision option:selected").val();
		var fi = $("#fecha_inicial").val();
		var ff = $("#fecha_final").val();
		$.ajax({
			url: SITEURL + "/configuraciones/get_data_graficas/"+id+"/"+fi+"/"+ff,
			type: "get",
			dataType : 'json',
			
			success: function (data) {
				if(data.status == "200"){
					

					grafica_comentarios(data.infolej, data.comentarios);
					

				}else if (data.status == "422"){
					var error = data.msg;
					var mensaje = "";
					for (var i in error) {
						var error_msg = error[i];
						mensaje = mensaje + error_msg+"<br>";
					}
					bootbox.alert(mensaje);
				}else{
					bootbox.alert("¡Error al obtener la información del expediente!");
				}
			},
			error: function (data) {
				console.log('Error:', data);
				bootbox.alert("¡Error al obtener la información del expediente!");
			},
			complete: function(){
				setTimeout(function() {
					$("#preloader").fadeOut(500);
				},200);
			}
		});
	}
	//Por default obtiene la gráfica
	get_graficas();

	//Acción que se ejecuta cuando da click en filtrar
	$("#filtrar_grafica").on("click", function(){
		get_graficas();
	});

	
</script>
@endsection
