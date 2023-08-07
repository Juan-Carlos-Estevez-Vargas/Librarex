<?php
    // Conexión a la base de datos
    $host = "localhost";
    $bd = "librarex";
    $usuario = "root";
    $contrasenia = "";
    // $host = "localhost";
    // $bd = "id20125981_db_librarrex";
    // $usuario = "id20125981_juan_estevez";
    // $contrasenia = "q1$1Zm1MR=a%R[*7";

    try {
        $conexion = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contrasenia);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
?>