<?php

    ob_start();
    header('Content-Type: text/html; charset=UTF-8'); 
    error_reporting(E_ALL); 
    ini_set('display_errors', 'Off');

    require_once 'mysqlConnection.php';

    $marca = $_POST['marca'];
    $id = $_POST['id'];
    $producto = $_POST['producto'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $imagen = $_POST['imagen'];
    if ($imagen == ''){
        $sqlSyntax = "INSERT INTO productos (marca, nombre, total, descripcion) VALUES ($marca,'$producto','$cantidad','$descripcion')";
    }
    else {
        $sqlSyntax = "INSERT INTO productos (marca, nombre, total, imagen, descripcion) VALUES ($marca,'$producto','$cantidad','$imagen','$descripcion')";
    }
    
    mysql_query("SET NAMES 'utf8'");
    $result = @mysql_query($sqlSyntax);
    if ($result == FALSE) { die(@mysql_error());

    echo $sqlSyntax;
?>