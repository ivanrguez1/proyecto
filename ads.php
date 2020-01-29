<?php

require_once("assets/php/bbdd.php");
session_start();

// Si no está logado como administrador, se expulsa...
/*
if ($_SESSION['nick'] != 'admin') {
    header('Location: index.php');
}
*/

// Si no se realiza ninguna acción, se cargan los registros y se muestra este mensaje
$mensaje = "Consulta Finalizada";

// Procedimiento para la Eliminación
if (isset($_POST['envio']) && $_POST['envio']=="Eliminar") {
    $id = $_POST['id'];
    $sqlDELETE = "DELETE FROM anuncios WHERE idAnuncio = '".$id."'";

    ejecutarAccion($sqlDELETE);
    $mensaje = "Eliminación Realizada";
}


// Muestra el elemento a Eliminar y muestra el mensaje de Preparado para Eliminar...
if (isset($_GET['action']) && $_GET['action']==1 ){
    $id = $_GET['id'];
    $sqlSELECTDELETE = "SELECT direccion FROM anuncios WHERE idAnuncio='".$id."'";

    $resultadoSELECTDELETE = ejecutarConsulta($sqlSELECTDELETE);
    $direccion = "";
    while($registro = mysqli_fetch_array($resultadoSELECTDELETE)) {
        $direccion = $registro['direccion'];
    }
    $mensaje = "Preparado para Eliminar el anuncio de dirección ".$direccion;
}

// Muestra el elemento a Actualizar y muestra el mensaje de Preparado para Actualizar...
if (isset($_GET['action']) && $_GET['action']==2 ){
    $id = $_GET['id'];
    $sqlSELECTUPDATE = "SELECT * FROM anuncios WHERE idAnuncio='".$id."'";

    $resultadoSELECTUPDATE = ejecutarConsulta($sqlSELECTUPDATE);
    $mensaje = "Preparado para actualizar el anuncio";
}

// Procedimiento para la Actualización
if (isset($_POST['envio']) && $_POST['envio']=="Modificar") {

    $id = $_POST['id'];
    $direccion = $_POST['direccion'];
    $codpostal = $_POST['codpostal'];
    $precio = $_POST['precio'];
    $superficie = $_POST['superficie'];
    $numhabitaciones = $_POST['numhabitaciones'];
    $numaseos = $_POST['numaseos'];
    $comentarios = $_POST['comentarios'];

    $sqlUPDATE = "UPDATE anuncios 
                    SET 
                    direccion='".$direccion ."',
                    codPostal='".$codpostal ."',
                    precio='".$precio ."',
                    superficie='".$superficie ."',
                    numHabitaciones='".$numhabitaciones ."',
                    numAseos='".$numaseos ."',
                    comentarios='".$comentarios ."'
                    WHERE idAnuncio = '".$id."'";

    ejecutarAccion($sqlUPDATE);
    $mensaje = "Modificación Realizada";
}

// Carga de elementos en la página con un SELECT
// 1º Saco la ID del usuario que está logado
$sql = "SELECT idUsuario FROM usuarios WHERE nick='".$_SESSION['nick']."'";
$resultado = ejecutarConsulta($sql);
while($registro = mysqli_fetch_array($resultado)) {
    $idUsuario = $registro['idUsuario'];
}
// 2º Saco los anuncios del usuario logado
$sql = "SELECT * FROM anuncios WHERE idUsuario='".$idUsuario."'";
$resultado = ejecutarConsulta($sql);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin - Extras</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/best-carousel-slide-1.css">
    <link rel="stylesheet" href="assets/css/best-carousel-slide.css">
    <link rel="stylesheet" href="assets/css/Blog---Recent-Posts-1.css">
    <link rel="stylesheet" href="assets/css/Blog---Recent-Posts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
    <script src="assets/js/theme.js"></script>

    <script type="text/javascript" language="javascript" src="assets/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

</head>

<body>
    <?php
    if (isset($_SESSION['correo'])) {
        include "./header-logged.php";
    } else {
        include "./header.html";
    }
    ?>

    <main class="page faq-page">
    <script>

    $(document).ready(function() {
        $('#mitabla').DataTable( {

            "order": [[1, 'asc']],
            "lengthMenu": [[5, 10, -1], [5, 10, "Todos"]],
            "pagingType": "full_numbers",    // Se añaden los botones Primero y último   
        } );
    } );

    </script>
        <section>
            <div class="block-heading">
                <h2 class="text-info text-center mt-5">Anuncios del usuario</h2>
            <div>
                
            </div>

            <div class="container">
            <?php
                // Presento los datos en la tabla de JQuery DataTable
                    echo '<table id="mitabla" class="table table-striped table-bordered" style="width:80%; margin:auto">';
                    echo "<thead>";
                    echo "<tr>";
                        echo "<th> Dirección </th>";
                        echo "<th> Codigo postal </th>";
                        echo "<th> Precio </th>";
                        echo "<th> Superficie </th>";
                        echo "<th> Nº Hab </th>";
                        echo "<th> Nº Aseos </th>";
                        echo "<th> Comentarios </th>";
                        echo "<th> Eliminar </th>";
                        echo "<th> Modificar </th>";
                    echo "</tr>";
                    echo "</thead>";    
                    while($registro = mysqli_fetch_array($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $registro['direccion'] . "</td>";
                        echo "<td>" . $registro['codPostal'] . "</td>";
                        echo "<td>" . $registro['precio'] . "</td>";
                        echo "<td>" . $registro['superficie'] . "</td>";
                        echo "<td>" . $registro['numHabitaciones'] . "</td>";
                        echo "<td>" . $registro['numAseos'] . "</td>";
                        echo "<td>" . $registro['comentarios'] . "</td>";
                        echo "<td><a href='ads.php?action=1&id=" . $registro['idAnuncio'] . "'>Eliminar</a></td>";
                        echo "<td><a href='ads.php?action=2&id=" . $registro['idAnuncio'] . "'>Modificar</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>"; 
                    mysqli_free_result($resultado);
                ?>
                <p>&nbsp;
                <!-- Mensajes del servidor en función de la acción a arealizar-->
                <p id="mensajes" class="alert alert-success"><?php
                    echo $mensaje;
                ?>

                    <?php 
                    // Presento el formulario para Eliminar si se pulsa el enlace de Eliminar
                    if (isset($_GET['action']) && $_GET['action']==1 ){
                    ?>
                    <form action="ads.php" method="post" enctype="multipart/form-data">

                        <fieldset class="shadow pl-3 pt-1 mb-2 pb-1 mt-auto">
                            <legend class="pt-auto pb-2">ELIMINAR ANUNCIO</legend>
                            <div>
                                <label>¿Realmente desea eliminar el anuncio de direción <?php echo $direccion; ?>?</label>
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
                            <legend class="pt-auto pb-2">MODIFICAR ANUNCIO</legend>
                            <legend class="pt-auto pb-2">IMPORTANTE! las fotos y los extras no son modificables</legend>
                            <div>
                                
                                <?php 
                                    while($registro = mysqli_fetch_array($resultadoSELECTUPDATE)) {
                                        echo "<input type='hidden' name='id' value='".$registro['idAnuncio']."'>";
                                        echo "<div>";
                                        echo "<label class='labelAlineado'>Dirección</label>";
                                        echo "<input type='text' name='direccion' value='".$registro['direccion']."'>";
                                        echo "</div>";
                                        echo "<div>";
                                        echo "<label class='labelAlineado'>Código Postal</label>";
                                        echo "<input type='text' name='codpostal' value='".$registro['codPostal']."'>";
                                        echo "</div>";
                                        echo "<div>";
                                        echo "<label class='labelAlineado'>Precio</label>";
                                        echo "<input type='text' name='precio' value='".$registro['precio']."'>";
                                        echo "</div>";
                                        echo "<div>";
                                        echo "<label class='labelAlineado'>Superficie</label>";
                                        echo "<input type='text' name='superficie' value='".$registro['superficie']."'>";
                                        echo "</div>";
                                        echo "<div>";
                                        echo "<label class='labelAlineado'>Nº Habitaciones</label>";
                                        echo "<input type='number' name='numhabitaciones' value='".$registro['numHabitaciones']."'>";
                                        echo "</div>";
                                        echo "<div>";
                                        echo "<label class='labelAlineado'>Nº Aseos</label>";
                                        echo "<input type='number' name='numaseos' value='".$registro['numAseos']."'>";
                                        echo "</div>";
                                        echo "<label class='labelAlineado'>Comentarios</label>";
                                        echo "<input type='textarea' name='comentarios' value='".$registro['comentarios']."'>";
                                        echo "</div>";
                                    }
                                ?> 
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