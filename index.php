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

    $result= @mysql_query($sqlSyntax);
    if ($result == FALSE) { die(@mysql_error()); }
?>

<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<html lang="es">
<head>
	<title>Stock Preservativos >> Importadora DP</title>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" type="image/x-icon" href="img/ico.png" />
	<!-- Latest compiled and minified CSS -->
    
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/responsiveslides.css">
	<link rel="stylesheet" href="css/stock.css">
    <link rel="stylesheet" href="css/style-desktop.css" />
    <link rel="stylesheet" href="css/style.css" />


	<!-- Latest compiled and minified JavaScript -->

	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-1.11.1.min.js"></script>

	<script src="js/responsiveslides.min.js"></script>

	<script>
	  $(function() {
	    $(".rslides").responsiveSlides();
	  });
	</script>

</head>


<script type="text/javascript">
</script>

<body>

<!-- NAV BAR -->
<nav id="nav" style="margin-bottom: 20px;">
    <ul class="container">
        <li><a href="#top">Arriba</a></li>
        <li><a href="#first">ir al Stock</a></li>
    </ul>
</nav>

<div class="container-fluid" style="background-color:#e8e8e8; padding: 0px;">
<div class="container container-pad" id="property-listings">

<!-- CARRUSEL -->

	<ul class="rslides" id="slider1" style="max-width: 1170px; max-height: 600px; margin: 0 auto; margin-bottom: 0px; margin-top: 30px;">	
        <li><img src="img/promo.png" alt=""></li>
	   <li><img src="img/skyn_promo.png" alt=""></li>
	</ul>


<!-- DESPLIEGE DE STOCK -->

        <div class="row" style=" margin-top: 0px; margin-bottom: 0px; padding 0;">
          <div class="col-md-12">
            <h1></h1>
          </div>
        </div>
        <div class="row visible-xs" style="width: 80px; height: 80px; margin: 0 auto; margin-top: 0px; margin-bottom: 20px;">
            <a href="#first"><i><img src="img/flecha.png" width="80"></i></a>
        </div>
        <div class="row" id="first">
        <?php 

            $count = 0;
            $count2 = 0;
            while($row = mysql_fetch_array($result)){
            if ($row['disponible'] == 0){
                $row['disponible'] = "AGOTADO";
            }
            if ($count == 0){
                $count = 1;
                if ($count2 == 0){
                    echo '<div id="" class="col-sm-6">';   
                }
            }
            else if ($count == 1){
                if ($count2 == 0) {
                    echo '<div class="col-sm-6">';
                }
            }
            if ($count2 < 3) {
                $count2 = $count2 + 1;
                echo '
                <!-- Begin Listing-->
                <div id="stock"class="brdr bgc-fff pad-10 box-shad btm-mrg-20 property-listing">
                    <div class="media">
                        <a class="pull-left" href="#" target="_parent">
                        <img alt="image" class="img-responsive" width="720" height="540" src="img/productos/'.$row['imagen'].'"></a>

                        <div class="clearfix visible-sm"></div>

                        <div class="media-body fnt-smaller">
                            <a href="#" target="_parent"></a>

                            <h4 class="media-heading">
                                    <div target="_parent" style="color:black; font-size: 20px;">'.strtoupper($row['marca']).' <STRONG style="color: black;">'.strtoupper($row['nombre']).'</STRONG> <strong class="pull-right hidden-md  "></strong></div></h4>


                            <p style="margin-bottom: 20px; margin-top:10px; color: black;">  
                                '.$row['descripcion'].'
                            </p class="visible-xs"><span><strong class="pull-right" style="font-size: 20px; color: black;">STOCK: <span style="color:orange;">'.$row['disponible'].'</span></strong></span>
                        </div>
                    </div>
                </div><!-- End Listing-->
                ';
            }
            if ($count2 == 3){
                $count2 = 0;
                $count = 1;
                echo '
                </div><!-- End col -->
                ';
            }
        }
         ?>
    </div><!-- End row -->
            </div><!-- End container -->        
</div>

</body>
</html>




