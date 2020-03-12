{{-- Mantenemos estandar base --}}
@extends('layout.master')

{{-- Cambiamos titulo de pagina --}}
@section('title')
  <title>Director</title>
@endsection

{{-- Incluimos los archivos a utilizar para front --}}
@section('styles')
  @include('layout.materialize') {{-- De usar materialize, incluimos desde el layout --}}
@endsection

{{-- Aqui trabajamos todo el contenido de la vista --}}
@section('body')
  {{-- Contenido --}}

<ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul>
<div class="center">
<a href="{{route('director.toma')}}" class="waves-effect waves-light btn-large"><i class="material-icons left"></i>Lista solicitudes </a>
<a href="{{route('director.bota')}}" class="waves-effect waves-light btn-large"><i class="material-icons right"></i>Lista botar</a>
<a href="{{route('director.cursos')}}" class="waves-effect waves-light btn-large"><i class="material-icons right"></i>CURSOS</a>

<div class="container">
	<div class="card-panel center">

<div align="center" style="margin-top: 30px">
	<div style="width: 500px; height: 500px">
	<canvas id="myChart" width="400" height="400"></canvas>
	</div>
</div>
</div>


<link rel = "stylesheet" type = "text/css" href = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src={{ asset('js/nav_scripts.js') }}></script>


<script>
	$(function(){
    	var ctx = $('#myChart');
    	var myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: [ 'Pendientes', 'Aceptado','Rechazado'],
		        datasets: [{
		            label: 'Estado solicitudes ',
		            data: [<?= $pendientes ?>, <?= $aceptados ?>, <?= $rechazados ?>],
		            backgroundColor: [
		            	'rgba(54, 162, 235, 0.7)', 
		                'rgba(75, 192, 192, 0.7)',           	
		                'rgba(255, 99, 132, 0.7)',
		            ],
		            borderWidth: 1
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero: true
		                }
		            }]
		        }
		    }
		});
    });
</script>
	</div>
</div>

<div class = "center">
	<a href ="{{route('director')}}" class = "btn btn"> principal</a>
</div>

@endsection



