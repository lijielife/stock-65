<?php 
	ob_start();
    header('Content-Type: text/html; charset=UTF-8'); 
    error_reporting(E_ALL); 
    ini_set('display_errors', 'Off');

    require_once 'mysqlConnection.php';

    $id = $_POST['id'];

    mysql_query("SET NAMES 'utf8'");

    $productos = 'SELECT id_ventas, id_producto, cantidad, cliente, telefono, lugar, fecha, hora, comentarios, marca, nombre
                        FROM desc_venta
                        INNER JOIN ventas ON desc_venta.id_venta = ventas.id_ventas
                        INNER JOIN productos ON desc_venta.id_producto = productos.id
                        WHERE ventas.id_ventas='.$_POST['id'].' ORDER BY id_ventas';

    require_once 'mysqlConnection.php'; //Archivo para realizar las conexiones.     
    
    $result= @mysql_query($productos);
    if ($result == FALSE) { die(@mysql_error()); }
    while($row = mysql_fetch_array($result)){ 
    	$sqlSyntax = 'UPDATE productos SET reservado=reservado-'.$row['cantidad'] WHERE id='.$row['id_producto'];
    }              

    //se borra la tabla ventas
	$sqlSyntax = 'DELETE FROM ventas WHERE id_ventas ='.$id;
    $result= @mysql_query($sqlSyntax);
    if ($result == FALSE) { die(@mysql_error()); }

    //se borran todos los ventas descr
    $sqlSyntax = 'DELETE FROM desc_venta WHERE id_venta ='.$id;
    $result= @mysql_query($sqlSyntax);
    if ($result == FALSE) { die(@mysql_error()); }

 ?>