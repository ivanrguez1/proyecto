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

function ejecutarConsulta ($sql) {
    $conexion = conectarBBD ();
    $resultado = mysqli_query($conexion, $sql);
    $conexion->close();
    return $resultado;
}

function ejecutarAccion ($sql) {
    $conexion = conectarBBD ();
    mysqli_query($conexion, $sql);
    $insertID = mysqli_insert_id($conexion);
    $conexion->close();
    return $insertID;
}



function devolverId ($correo) {
    $sql = "SELECT idUsuario FROM usuarios WHERE correo = '".$correo."'";
    $resultado = ejecutarConsulta ($sql);
    $registro = mysqli_fetch_assoc($resultado);
    $id = $registro['idUsuario'];
    return $id;
}