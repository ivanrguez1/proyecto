<?php

require_once("../assets/php/bbdd.php");
session_start();

// Si no está logado como administrador, se expulsa...
if ($_SESSION['nick'] != 'admin') {
    header('Location: ../index.php');
}

// Si no se realiza ninguna acción, se cargan los registros y se muestra este mensaje
$mensaje = "Consulta Finalizada";

// Procedimiento para la inserción
if (isset($_POST['envio']) && $_POST['envio']=="Insertar") {
    $nombre = $_POST['nombre'];
    $nick = $_POST['nick'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    // El password se encripta
    $password = password_hash($password, PASSWORD_DEFAULT);


    $sqlINSERT = "INSERT INTO usuarios (nombre, nick, correo, clave) 
                VALUES ('".$nombre."','".$nick."','".$correo."','".$password."')";

    ejecutarAccion($sqlINSERT);
    $mensaje = "Inserción Realizada";
}

// Procedimiento para la Eliminación
if (isset($_POST['envio']) && $_POST['envio']=="Eliminar") {
    $id = $_POST['id'];
    $sqlDELETE = "DELETE FROM usuarios WHERE idUsuario = '".$id."'";

    ejecutarAccion($sqlDELETE);
    $mensaje = "Eliminación Realizada";
}


// Muestra el elemento a Eliminar y muestra el mensaje de Preparado para Eliminar...
if (isset($_GET['action']) && $_GET['action']==1 ){
    $id = $_GET['id'];
    $sqlSELECTDELETE = "SELECT * FROM usuarios WHERE idUsuario='".$id."'";

    $resultadoSELECTDELETE = ejecutarConsulta($sqlSELECTDELETE);
    $nick = "";
    while($registro = mysqli_fetch_array($resultadoSELECTDELETE)) {
        $nick = $registro['nick'];
    }
    $mensaje = "Preparado para Eliminar el usuario cuyo Nick es ".$nick;
}

// Muestra el elemento a Actualizar y muestra el mensaje de Preparado para Actualizar...
if (isset($_GET['action']) && $_GET['action']==2 ){
    $id = $_GET['id'];
    $sqlSELECTUPDATE = "SELECT * FROM usuarios WHERE idUsuario='".$id."'";

    $resultadoSELECTUPDATE = ejecutarConsulta($sqlSELECTUPDATE);
    $nombre = "";
    $nick  = "";
    $correo = "";
    while($registro = mysqli_fetch_array($resultadoSELECTUPDATE)) {
        $nombre  = $registro['nombre'];
        $nick  = $registro['nick'];
        $correo  = $registro['correo'];
    }
    $mensaje = "Preparado para actualizar el usuario cuyo nick es ".$nick;
}

// Procedimiento para la Actualización
if (isset($_POST['envio']) && $_POST['envio']=="Modificar") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $nick = $_POST['nick'];
    $correo = $_POST['correo'];

    $sqlUPDATE = "UPDATE usuarios 
                    SET nombre='".$nombre ."' ,
                    nick='".$nick ."',
                    correo='".$correo ."'
                    WHERE idUsuario = '".$id ."'";

    ejecutarAccion($sqlUPDATE);
    $mensaje = "Modificación Realizada";
}



// Carga de elementos en la página con un SELECT
$sql = "SELECT * FROM usuarios";
$resultado = ejecutarConsulta($sql);
$numRegistros = mysqli_num_rows($resultado);



?>
<!DOCTYPE html>
<html lang="es">

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin - Usuarios</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/best-carousel-slide-1.css">
    <link rel="stylesheet" href="../assets/css/best-carousel-slide.css">
    <link rel="stylesheet" href="../assets/css/Blog---Recent-Posts-1.css">
    <link rel="stylesheet" href="../assets/css/Blog---Recent-Posts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="../assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="../assets/css/smoothproducts.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="../assets/js/smoothproducts.min.js"></script>
    <script src="../assets/js/theme.js"></script>

    <script type="text/javascript" language="javascript" src="../assets/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

</head>

<body>
    <?php

    include "header-admin-logged.php";
    ?>

    <main class="page faq-page">
    <script>
    /* Para tan pocos registros no merece la pena JQuery DataTable
    $(document).ready(function() {
        $('#mitabla').DataTable( {

            "order": [[1, 'asc']],
            "lengthMenu": [[10, 20, -1], [10, 20, "Todos"]],
            "pagingType": "full_numbers",    // Se añaden los botobes Primero y último   
        } );
    } );
    */
    </script>
        <section>
            <div class="block-heading">
                <h2 class="text-info text-center mt-5">Administración - Usuarios</h2>
            <div>
                
            </div>

            <div class="container">
            <?php
                    echo '<table id="mitabla" class="table table-striped table-bordered" style="width:80%; margin:auto">';
                    echo "<thead>";
                    echo "<tr>";
                        echo "<th> idUsuario </th>";
                        echo "<th> nombre </th>";
                        echo "<th> nick </th>";
                        echo "<th> correo </th>";
                        echo "<th> Eliminar </th>";
                        echo "<th> Modificar </th>";
                    echo "</tr>";
                    echo "</thead>";    
                    while($registro = mysqli_fetch_array($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $registro['idUsuario'] . "</td>";
                        echo "<td>" . $registro['nombre'] . "</td>";
                        echo "<td>" . $registro['nick'] . "</td>";
                        echo "<td>" . $registro['correo'] . "</td>";
                        echo "<td><a href='usuarios.php?action=1&id=" . $registro['idUsuario'] . "'>Eliminar</a></td>";
                        echo "<td><a href='usuarios.php?action=2&id=" . $registro['idUsuario'] . "'>Modificar</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>"; 
                    mysqli_free_result($resultado);
                ?>
                <p>&nbsp;
                <!-- Mensajes del servidor en función de la acción a realizar-->
                <p id="mensajes" class="alert alert-success"><?php
                    echo $mensaje;
                ?>

                    <?php 
                        // Al cargar la página o pulsar en [Consultar] se muestran los elementos y se prepara para INSERTAR
                    if (!isset($_GET['action'])) {
                    ?>
                    <form action="#" method="post" enctype="multipart/form-data">

                        <fieldset class="shadow pl-3 pt-1 mb-2 pb-1 mt-auto">
                            <legend class="pt-auto pb-2">INSERTAR USUARIO</legend>
                            <div>
                                <label class="labelAlineado">Nombre:&nbsp;</label>
                                <input type="text" name="nombre" placeholder="Nombre">
                            </div>
                            <div>
                                <label class="labelAlineado">Nick:&nbsp;</label>
                                <input type="text" name="nick" placeholder="Nick">
                            </div>
                            <div>
                                <label class="labelAlineado">Correo:&nbsp;</label>
                                <input type="text" name="correo" placeholder="Correo">
                            </div>
                            <div>
                                <label class="labelAlineado">Password:&nbsp;</label>
                                <input type="text" name="password" placeholder="La clave se mostrará">
                            </div>
                        </fieldset>
                        <br>
                        <input class="btn btn-primary btn-block" type="submit" value="Insertar" name="envio"></input>
                    </form>
                    <?php }
                    ?>

                    <?php 
                    // Presento el formulario para Eliminar si se pulsa el enlace de Eliminar
                    if (isset($_GET['action']) && $_GET['action']==1 ){
                    ?>
                    <form action="usuarios.php" method="post" enctype="multipart/form-data">

                        <fieldset class="shadow pl-3 pt-1 mb-2 pb-1 mt-auto">
                            <legend class="pt-auto pb-2">ELIMINAR USUARIO</legend>
                            <div>
                                <label>¿Realmente desea eliminar el usuario cuyo nick es <?php echo $nick; ?>?</label>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                            </div>
                        </fieldset>
                        <br>
                        <input class="btn btn-primary btn-block" type="submit" value="Eliminar" name="envio"></input>
                        <input class="btn btn-primary btn-block" type="submit" value="Consultar" name="envio"></input>
                    </form>
                    <?php }
                    ?>

                    <?php 
                    // Presento el formulario para Modificar si se pulsa el enlace para Modificar
                    if (isset($_GET['action']) && $_GET['action']==2 ){
                    ?>
                    <form action="#" method="post" enctype="multipart/form-data">

                        <fieldset class="shadow pl-3 pt-1 mb-2 pb-1 mt-auto">
                            <legend class="pt-auto pb-2">MODIFICAR USUARIO</legend>
                            <div>
                                <label class="labelAlineado">Nombre:&nbsp;</label>
                                <input type="text" name="nombre" value="<?php echo $nombre; ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                            </div>
                            <div>
                                <label class="labelAlineado">Nick:&nbsp;</label>
                                <input type="text" name="nick" value="<?php echo $nick; ?>">
                            </div>
                            <div>
                                <label class="labelAlineado">Correo:&nbsp;</label>
                                <input type="text" name="correo" value="<?php echo $correo; ?>">
                            </div>
                        </fieldset>
                        <br>
                        <input class="btn btn-primary btn-block" type="submit" value="Modificar" name="envio"></input>
                        <input class="btn btn-primary btn-block" type="submit" value="Consultar" name="envio"></input>
                    </form>
                    <?php }
                    ?>
            </div>
        </section>
    </main>
    <?php include "footer.php" ?>
</body>

</html>