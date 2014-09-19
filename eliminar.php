<?php
    ob_start();
    header('Content-Type: text/html; charset=UTF-8'); 
    error_reporting(E_ALL); 
    ini_set('display_errors', 'Off');

    require_once 'mysqlConnection.php';

    $id = $_POST['id'];
    #echo $_POST['busqueda'];

    mysql_query("SET NAMES 'utf8'");
    $sqlSyntax = "DELETE FROM productos WHERE id = $id";
    mysql_query($sqlSyntax) or die(mysql_error());

?>