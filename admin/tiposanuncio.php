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
    $tipo = $_POST['tipo'];
    $sqlINSERT = "INSERT INTO tiposAnuncio (tipoAnuncio) VALUES ('".$tipo."')";

    ejecutarAccion($sqlINSERT);
    $mensaje = "Inserción Realizada";
}

// Procedimiento para la Eliminación
if (isset($_POST['envio']) && $_POST['envio']=="Eliminar") {
    $id = $_POST['id'];
    $sqlDELETE = "DELETE FROM tiposAnuncio WHERE idTipoAnuncio = '".$id."'";

    ejecutarAccion($sqlDELETE);
    $mensaje = "Eliminación Realizada";
}


// Muestra el elemento a Eliminar y muestra el mensaje de Preparado para Eliminar...
if (isset($_GET['action']) && $_GET['action']==1 ){
    $id = $_GET['id'];
    $sqlSELECTDELETE = "SELECT * FROM tiposAnuncio WHERE idTipoAnuncio='".$id."'";

    $resultadoSELECTDELETE = ejecutarConsulta($sqlSELECTDELETE);
    $tipo = "";
    while($registro = mysqli_fetch_array($resultadoSELECTDELETE)) {
        $tipo = $registro['tipoAnuncio'];
    }
    $mensaje = "Preparado para Eliminar el tipo ".$tipo;
}

// Muestra el elemento a Actualizar y muestra el mensaje de Preparado para Actualizar...
if (isset($_GET['action']) && $_GET['action']==2 ){
    $id = $_GET['id'];
    $sqlSELECTUPDATE = "SELECT * FROM tiposAnuncio WHERE idTipoAnuncio='".$id."'";

    $resultadoSELECTUPDATE = ejecutarConsulta($sqlSELECTUPDATE);
    $tipo = "";
    while($registro = mysqli_fetch_array($resultadoSELECTUPDATE)) {
        $tipo = $registro['tipoAnuncio'];
    }
    $mensaje = "Preparado para actualizar el tipo ".$tipo;
}

// Procedimiento para la Actualización
if (isset($_POST['envio']) && $_POST['envio']=="Modificar") {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];

    $sqlUPDATE = "UPDATE tiposAnuncio SET tipoAnuncio='".$tipo ."' WHERE idTipoAnuncio = '".$id ."'";

    ejecutarAccion($sqlUPDATE);
    $mensaje = "Modificación Realizada";
}



// Carga de elementos en la página con un SELECT
$sql = "SELECT * FROM tiposAnuncio";
$resultado = ejecutarConsulta($sql);
$numRegistros = mysqli_num_rows($resultado);



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin - Tipos de Anuncio</title>
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

    include "../header-admin-logged.php";
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
                <h2 class="text-info text-center mt-5">Administración - Tipos de Anuncio</h2>
            <div>
                
            </div>

            <div class="container">
            <?php
                    echo '<table id="mitabla" class="table table-striped table-bordered" style="width:60%; margin:auto">';
                    echo "<thead>";
                    echo "<tr>";
                        echo "<th> idExtra </th>";
                        echo "<th> Extra </th>";
                        echo "<th> Eliminar </th>";
                        echo "<th> Modificar </th>";
                    echo "</tr>";
                    echo "</thead>";    
                    while($registro = mysqli_fetch_array($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $registro['idTipoAnuncio'] . "</td>";
                        echo "<td>" . $registro['tipoAnuncio'] . "</td>";
                        echo "<td><a href='tiposanuncio.php?action=1&id=" . $registro['idTipoAnuncio'] . "'>Eliminar Tipo</a></td>";
                        echo "<td><a href='tiposanuncio.php?action=2&id=" . $registro['idTipoAnuncio'] . "'>Modificar Tipo</a></td>";
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
                            <legend class="pt-auto pb-2">INSERTAR TIPO ANUNCIO</legend>
                            <div>
                                <label class="labelAlineado">Tipo de anuncio:&nbsp;</label>
                                <input type="text" name="tipo" placeholder="Tipo">
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
                    <form action="tiposanuncio.php" method="post" enctype="multipart/form-data">

                        <fieldset class="shadow pl-3 pt-1 mb-2 pb-1 mt-auto">
                            <legend class="pt-auto pb-2">ELIMINAR TIPO DE ANUNCIO</legend>
                            <div>
                                <label>¿Realmente desea eliminar el tipo <?php echo $tipo; ?>?</label>
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
                            <legend class="pt-auto pb-2">MODIFICAR TIPO DE ANUNCIO</legend>
                            <div>
                                <label class="labelAlineado">Tipo de anuncio:&nbsp;</label>
                                <input type="text" name="tipo" value="<?php echo $tipo; ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
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
    <?php include "../footer.php" ?>
</body>

</html>