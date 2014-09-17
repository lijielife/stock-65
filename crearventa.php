<?php 

    header('Access-Control-Allow-Origin: *');
    ob_start();
    error_reporting(E_ALL); 
    ini_set('display_errors', 'on');
    header('Content-Type: text/html; charset=UTF-8');  
    session_start(); 


    $sqlSyntax= 'SELECT * FROM productos';

    require_once 'mysqlConnection.php'; //Archivo para realizar las conexiones.     
    mysql_set_charset('utf8');

?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin - Crear Venta</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="img/ico.png" />
    <!-- Latest compiled and minified CSS -->
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/crearventa.css">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {   
            var sideslider = $('[data-toggle=collapse-side]');
            var sel = sideslider.attr('data-target');
            var sel2 = sideslider.attr('data-target-2');
            sideslider.click(function(event){
                $(sel).toggleClass('in');
                $(sel2).toggleClass('out');
            });
        });
    </script>
</head>
<body>


<header role="banner" class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle pull-left"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="navbar-inverse side-collapse in">
          <nav role="navigation" class="navbar-collapse">
            <ul class="nav navbar-nav">
              <li><a href="crearventa.php">Crear Venta</a></li>
              <li><a href="agregarproducto.php">Agregar Producto</a></li>
              <li><a href="verstock.php">Ver Stock</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </header>

   <div class="container">
		<div class="row col-md-12 custyle">
    		<table class="table table-striped custab">
    			<thead>
					<a href="#" class="btn btn-primary btn-xs pull-right"><b>+</b> Crear Venta</a>
        				<tr>
				            <th>ID</th>
				            <th>Nombre</th>
				            <th>Fecha</th>
				            <th>Lugar</th>
				            <th>Hora</th>
				            <th>Telefono</th>
				            <th>Comentario</th>
				            <th>Productos</th>
				            <th class="text-center">Action</th>
				        </tr>
    			</thead>
			            <tr>
			                <td>1</td>
			                <td>Diego Muñoz</td>
			                <td>Martes 17</td>
			                <td>Metro Ñuble</td>
			                <td>17:00</td>
			                <td>89863731</td>
			                <td>asdf</td>
			                <td>
			                	Lifestyles Tuxedo: 6 <br>
			                	Lifestyles Ribbed Pleasure: 7

			                </td>
			                <td class="text-center">
			                	<a class='btn btn-info btn-xs' href="editarventa.php">
			                		<span class="glyphicon glyphicon-edit"></span> Editar</a>
			                	<a class='btn btn-success btn-xs' href="venta.php">
			                		<span class="glyphicon glyphicon-thumbs-up"></span> Vendido</a> 
	                			<a href="cancelarventa.php" class="btn btn-danger btn-xs">
		                			<span class="glyphicon glyphicon-remove"></span> Cancelado</a>
                			</td>
			            </tr>
			            
    		</table>
    	</div>
	</div>


</body>
</html>	