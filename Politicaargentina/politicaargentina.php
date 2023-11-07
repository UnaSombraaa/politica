<?php include('template/cabecera.php'); ?>


<?php 
include("config/bd.php");?>


<div class="col-md-12">
<div class="card-deck">
    <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="">
        <div class="card-body">
            <h4 class="card-title">Partidos politicos</h4>
            <a name="" id="" class="btn btn-primary" href="$partidospoliticos" role="button">Ver mas</a>
        </div>
    </div>    

    <div class="col-md-12">
<div class="card-deck">
    <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="">
        <div class="card-body">
            <h4 class="card-title">Politicos</h4>
       <a name="" id="" class="btn btn-primary" href="sentenciaSQL = $conexion->prepare(select * from partidospoliticos)" role="button">Ver mas</a>
        </div>
    </div>    

    <table class="table table-bordered">
     <thead>
        <tr>
            <th>Partido_ID</th>
            <th>NombrePartido</th>
            <th>Ideologia</th>
            <th>Aniofundacion</th>
            <th>SedeCentral</th>
            <th>LiderActual</th>
            <th>SitioWeb</th>   
        </tr>
        </thead>
        <tbody>
       

    </table>




<?php include('template/pie.php'); ?>