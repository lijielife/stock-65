<?php 

    header('Access-Control-Allow-Origin: *');
    ob_start();
    error_reporting(E_ALL); 
    ini_set('display_errors', 'off');
    header('Content-Type: text/html; charset=UTF-8');  
    session_start(); 
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
    <link rel="stylesheet" href="css/modal.css">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(".btn-info").on('click', function() {
            var opcion = ;
        });
    </script>
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
    <script type="text/javascript">

        $(function(){
                
            var values = new Array();
            
            $(document).on('change', '.form-group-multiple-selects .input-group-multiple-select:last-child select', function(){
                
                var selectsLength = $('.form-group-multiple-selects .input-group-multiple-select select').length;
                var optionsLength = ($(this).find('option').length)-1;

                
                if(selectsLength < optionsLength){
                    var sInputGroupHtml = $(this).parent().html();
                    var sInputGroupClasses = $(this).parent().attr('class');
                    $(this).parent().parent().append('<div class="'+sInputGroupClasses+'">'+sInputGroupHtml+'</div>');  
                }
                
                updateValues();
                
            });
            
            $(document).on('change', '.form-group-multiple-selects .input-group-multiple-select:not(:last-child) select', function(){
                
                updateValues();
                
            });
            
            $(document).on('click', '.input-group-addon-remove', function(){
                $(this).parent().remove();
                updateValues();
            });
            
            function updateValues()
            {
                values = new Array();
                $('.form-group-multiple-selects .input-group-multiple-select select').each(function(){
                    var value = $(this).val();
                    if(value != 0 && value != ""){
                        values.push(value);
                    }
                });
                
                $('.form-group-multiple-selects .input-group-multiple-select select').find('option').each(function(){
                    var optionValue = $(this).val();
                    var selectValue = $(this).parent().val();
                    if(in_array(optionValue,values)!= -1 && selectValue != optionValue)
                    {
                        $(this).attr('disabled', 'disabled');
                    }
                    else
                    {
                        $(this).removeAttr('disabled');
                    }
                });
            }
            
            function in_array(needle, haystack){
                var found = 0;
                for (var i=0, length=haystack.length;i<length;i++) {
                    if (haystack[i] == needle) return i;
                    found++;
                }
                return -1;
            }
        });
    </script>
</head>
<body>

<div id="wrap" class="text-center">

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
                    <a href="#" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#myModal"><b>+</b> Crear Venta</a>
                        <tr>
                            <th style="display: none;" class="text-center">ID</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Lugar</th>
                            <th class="text-center">Hora</th>
                            <th class="text-center">Telefono</th>
                            <th class="text-center">Comentario</th>
                            <th class="text-center">Productos</th>
                            <th class="text-center">Action</th>
                        </tr>
                </thead>
                <?php 
                    mysql_set_charset('utf8');
                    //seleccionar todas las ventas del sistema
                    $idventas = 'SELECT id_ventas FROM ventas';
                    require_once 'mysqlConnection.php'; //Archivo para realizar las conexiones.     
                    $result= @mysql_query($idventas);
                    if ($result == FALSE) { die(@mysql_error()); }
                    while($row = mysql_fetch_array($result)){
                        $count = 0;                  
                        $productos = 'SELECT id_ventas, id_producto, cantidad, cliente, telefono, lugar, fecha, hora, comentarios, marca, nombre
                        FROM desc_venta
                        INNER JOIN ventas ON desc_venta.id_venta = ventas.id_ventas
                        INNER JOIN productos ON desc_venta.id_producto = productos.id
                        WHERE ventas.id_ventas='.$row['id_ventas'].' 
                        ORDER BY id_ventas';
                        require_once 'mysqlConnection.php'; //Archivo para realizar las conexiones.     
                        $result2= @mysql_query($productos);
                        if ($result2 == FALSE) { die(@mysql_error()); }
                        while($row2 = mysql_fetch_array($result2)){  
                            if (strtoupper($row2['marca']) == "LIFESTYLES"){
                                $row2['marca'] = "[LF]";
                            }                
                            if ($count == 0){
                                $count = 1;
                                echo '
                                    <tr>
                                    <td style="display: none;">'.$row2['id_ventas'].'</td>
                                    <td style="text-align: left">'.strtoupper($row2['cliente']).'</td>
                                    <td style="text-align: left">'.$row2['fecha'].'</td>
                                    <td style="text-align: left">'.$row2['lugar'].'</td>
                                    <td style="text-align: left">'.$row2['hora'].'</td>
                                    <td style="text-align: left">'.$row2['telefono'].'</td>
                                    <td style="text-align: left">'.$row2['comentarios'].'</td>
                                    <td style="text-align: left"><strong>'.strtoupper($row2['marca']).'</strong> '.strtoupper($row2['nombre']).': <strong>'.$row2['cantidad'].'</strong><br>';
                            }
                            else{
                                echo '<strong>'.strtoupper($row2['marca']).'</strong> '.strtoupper($row2['nombre']).': <strong>'.$row2['cantidad'].'</strong><br>';
                            }
                        }
                        echo '</td>';
                         echo '</td>
                                <td class="">
                                    <a class="btn btn-info btn-xs" href="editarventa.php">
                                        <span class="glyphicon glyphicon-edit"></span> Editar</a>
                                    <a class="btn btn-success btn-xs" href="venta.php">
                                        <span class="glyphicon glyphicon-thumbs-up"></span> Vendido</a> 
                                    <a href="cancelarventa.php" class="btn btn-danger btn-xs">
                                        <span class="glyphicon glyphicon-remove"></span> Cancelado</a>
                                </td>
                            </tr>  
                        ';
                    }
                    
                 ?>
                              
            </table>
        </div>
    </div>

<!-- MODAL CREAR VENTA -->
  <!-- Button trigger modal -->

</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="container" style="margin-top:60px;">
    <div class="row">
      <div class="col-sm-12 text-center">
        <h1>Crear nueva venta !</h1>
        <hr>
        <input type="hidden" name="count" value="1" />
        <a class="btn btn-primary btn-lg" id="botonCrearVenta" style="margin-bottom: 30px;"><b>Crear Venta</b></a> 
        <div class="control-group" id="fields">
            <div class="controls" id="profs">
                <div class="row">
        <div class="col-sm-12">
        </div>
        <form action="formulario.php" method="post" accept-charset="utf-8">
        <!-- panel preview -->
        <div class="col-sm-5">
            <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">
                    <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">Lugar</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lugar" name="lugar">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">Fecha</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="fecha" name="fecha">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hora" class="col-sm-3 control-label">Hora</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="hora" name="hora">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tel" class="col-sm-3 control-label">Telefono</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="telefono" name="telefono">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Comentarios</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="3" id="comentarios" name="comentarios"></textarea>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                        </div>
                    </div>
                </div>
            </div>            
        </div> <!-- / panel preview -->
        <div class="col-sm-7">
            <div class="form-group form-group-multiple-selects col-xs-12">
                <div class="input-group input-group-multiple-select col-xs-12">
                    <select class="form-control" name="values[]">
                        <option value="">Select one</option>

                        <?php 

                            $sqlSyntax= 'SELECT id,marca,nombre FROM productos ORDER BY nombre ASC';
                            require_once 'mysqlConnection.php'; //Archivo para realizar las conexiones.     
                            mysql_set_charset('utf8');
                            $result= @mysql_query($sqlSyntax);
                            $count = 0;
                            if ($result == FALSE) { die(@mysql_error()); }

                            while($row = mysql_fetch_array($result)){
                                $count = $count + 1;
                                echo '<option value="'.$row['id'].'">'.$row['marca'].' '.$row['nombre'].'</option>';
                            }
                         ?>

                    </select>
                    <span class="input-group-addon input-group-addon-remove">
                        <span class="glyphicon glyphicon-remove"></span>
                    </span>
                    <input type="text" style="width: 60px;" name="option[]" class="form-control" maxlength="4">
                </div>
            </div>
            <input type="submit" value="submit">
        </form>
        </div>
    </div>
</div>
    </div>
  </div>
</div>
</div>
</body>
</html> 