<?php

    ob_start();
    header('Content-Type: text/html; charset=UTF-8'); 
    error_reporting(E_ALL); 
    ini_set('display_errors', 'Off');

    require_once 'mysqlConnection.php';

    $agregar = $_POST['agregar'];
    $id = $_POST['id'];
    #echo $_POST['busqueda'];

    mysql_query("SET NAMES 'utf8'");
    $sqlSyntax = "SELECT total FROM productos WHERE id = $id";
    $total = mysql_query($sqlSyntax) or die(mysql_error());

    $row = mysql_fetch_assoc($total);

    $total = $row['total'];
    $newtotal = $agregar+$total;

    $sqlSyntax= "UPDATE productos SET total = $newtotal WHERE id = $id "; 
    mysql_query($sqlSyntax) or die(mysql_error());

?>