<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function conectarBBD () {
    $servidor = 'localhost';
    $usuarioServidor = 'root';
    $claveServidor = 'root';
    $bbdd = 'upocasa';

    $conexion = mysqli_connect(
        "$servidor",
        "$usuarioServidor",
        "$claveServidor",
        "$bbdd");

    if (!$conexion) {
        die("Conexión errónea: " . mysqli_connect_error());
    } else {
        return $conexion;
    }
}

function ejecutaConsulta ($sql) {
    $conexion = conectarBBD ();
    $resultado = mysqli_query($conexion, $sql);
    return $resultado;
}

