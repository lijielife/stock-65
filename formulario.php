<?php 
    
    header('Access-Control-Allow-Origin: *');
    ob_start();
    ini_set('display_errors', 'on');
    header('Content-Type: text/html; charset=UTF-8');  
    session_start(); 

	$id_dsc = rand (1, 99999);

	$cliente = $_POST['nombre'];
	$telefono = $_POST['telefono'];
	$lugar = $_POST['lugar'];
	$fecha = $_POST['fecha'];
	$hora = $_POST['hora'];
	$comentarios = $_POST['comentarios'];	
	if ($comentarios == "") {
		$comentarios = "--";
	}

	//por cada elemento a vender, se llenan las tablas descripccion_venta
	foreach ($_POST['values'] as $index => $val) {
		$cantidad = intval($_POST['option'][$index]);
		$idProducto = $val; //id del producto
		if($idProducto != ""){

            //update de las cantidades
            $actualizarcantidades = "UPDATE productos SET reservado=reservado+".$cantidad." WHERE id=".$idProducto;
            require_once 'mysqlConnection.php'; //Archivo para realizar las conexiones.     
         	mysql_set_charset('utf8');
            $result2= @mysql_query($actualizarcantidades);
            if ($result2 == FALSE) { 
            	$_SESSION['error'] = @mysql_error();
				header('Location: crearventa.php');
				exit();
            }
		}
	} 

	//insert de la venta
	$sqlSyntax= "INSERT INTO ventas (cliente, telefono, lugar, fecha, hora, comentarios) VALUES('$cliente','$telefono','$lugar','$fecha','$hora','$comentarios')";
	require_once 'mysqlConnection.php'; //Archivo para realizar las conexiones.     
    mysql_set_charset('utf8');
    $result= @mysql_query($sqlSyntax);
    if ($result == FALSE) { die(@mysql_error()); }

    //Obtener id venta recienmente creada
    $selecID= 'SELECT id_ventas FROM ventas ORDER BY id_ventas DESC LIMIT 1';
	require_once 'mysqlConnection.php'; //Archivo para realizar las conexiones.     
    mysql_set_charset('utf8');
    $result= @mysql_query($selecID);
    if ($result == FALSE) { die(@mysql_error()); }
    $row = mysql_fetch_array($result);
    $idVentas = intval($row['id_ventas']);

	foreach ($_POST['values'] as $index => $val) {
		$cantidad = intval($_POST['option'][$index]);
		$idProducto = $val; //id del producto
		if($idProducto != ""){
			$crearDescVenta= "INSERT INTO desc_venta (id_dsc, id_venta, id_producto, cantidad) VALUES ('$id_dsc', '$idVentas', '$idProducto', '$cantidad')";
            require_once 'mysqlConnection.php'; //Archivo para realizar las conexiones.     
         	mysql_set_charset('utf8');
            $result= @mysql_query($crearDescVenta);
            if ($result == FALSE) { die(@mysql_error()); }
		}
	}
	$_SESSION['error'] = "";
	header('Location: crearventa.php');
?>