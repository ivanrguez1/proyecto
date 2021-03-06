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
    $codpostal = $_POST['codpostal'];
    $municipio = $_POST['municipio'];
    $sqlINSERT = "INSERT INTO municipios VALUES ('".$codpostal."','".$municipio."')";

    ejecutarAccion($sqlINSERT);
    $mensaje = "Inserción Realizada";
}

// Procedimiento para la Eliminación
if (isset($_POST['envio']) && $_POST['envio']=="Eliminar") {
    $codpostal = $_POST['id'];
    $sqlDELETE = "DELETE FROM municipios WHERE codPostal = '".$codpostal."'";

    ejecutarAccion($sqlDELETE);
    $mensaje = "Eliminación Realizada";
}


// Muestra el elemento a Eliminar y muestra el mensaje de Preparado para Eliminar...
if (isset($_GET['action']) && $_GET['action']==1 ){
    $codpostal = $_GET['id'];
    $sqlSELECTDELETE = "SELECT * FROM municipios WHERE codPostal='".$codpostal."'";

    $resultadoSELECTDELETE = ejecutarConsulta($sqlSELECTDELETE);
    $municipio = "";
    while($registro = mysqli_fetch_array($resultadoSELECTDELETE)) {
        $municipio = $registro['nombreMunicipio'];
    }
    $mensaje = "Preparado para Eliminar el Código postal ".$codpostal." del municipio ".$municipio;
}

// Muestra el elemento a Actualizar y muestra el mensaje de Preparado para Actualizar...
if (isset($_GET['action']) && $_GET['action']==2 ){
    $codpostal = $_GET['id'];
    $sqlSELECTUPDATE = "SELECT * FROM municipios WHERE codPostal='".$codpostal."'";

    $resultadoSELECTUPDATE = ejecutarConsulta($sqlSELECTUPDATE);
    $municipio = "";
    while($registro = mysqli_fetch_array($resultadoSELECTUPDATE)) {
        $municipio = $registro['nombreMunicipio'];
    }
    $mensaje = "Preparado para actualizar el Código postal ".$codpostal." del municipio ".$municipio;
}

// Procedimiento para la Actualización
if (isset($_POST['envio']) && $_POST['envio']=="Modificar") {
    $codpostal = $_POST['id'];
    $codPostalAnterior = $_POST['idAnterior'];
    $municipio = $_POST['municipio'];

    $sqlUPDATE = "UPDATE municipios 
                SET codPostal='".$codpostal ."',
                nombreMunicipio='".$municipio ."'
                 WHERE codPostal = '".$codPostalAnterior ."'";

    ejecutarAccion($sqlUPDATE);
    $mensaje = "Modificación Realizada";
}




// Carga de elementos en la página con un SELECT
$sql = "SELECT * FROM municipios LIMIT 14500,500";
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

    include "header-admin-logged.php";
    ?>

    <main class="page faq-page">
    <script>
    // Meto JQuery DataTable
    $(document).ready(function() {
        $('#mitabla').DataTable( {

            "order": [[1, 'asc']],
            "lengthMenu": [[10, 20, -1], [10, 20, "Todos"]],
            "pagingType": "full_numbers",    // Se añaden los botobes Primero y último   
        } );
    } );

    </script>
        <section>
            <div class="block-heading">
                <h2 class="text-info text-center mt-5">Administración - Municipios/Códigos postales</h2>
            <div>
                
            </div>

            <div class="container">
            <?php
                    echo '<table id="mitabla" class="table table-striped table-bordered" style="width:60%; margin:auto">';
                    echo "<thead>";
                    echo "<tr>";
                        echo "<th> Código Postal </th>";
                        echo "<th> Municipio </th>";
                        echo "<th> Eliminar </th>";
                        echo "<th> Modificar </th>";
                    echo "</tr>";
                    echo "</thead>";    
                    while($registro = mysqli_fetch_array($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $registro['codPostal'] . "</td>";
                        echo "<td>" . $registro['nombreMunicipio'] . "</td>";
                        echo "<td><a href='municipios.php?action=1&id=" . $registro['codPostal'] . "'>Eliminar</a></td>";
                        echo "<td><a href='municipios.php?action=2&id=" . $registro['codPostal'] . "'>Modificar</a></td>";
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
                            <legend class="pt-auto pb-2">INSERTAR MUNICIPIO/CODIGO POSTAL</legend>
                            <div>
                                <label class="labelAlineado">Código postal:&nbsp;</label>
                                <input type="text" name="codpostal" placeholder="Código Postal">
                            </div>
                            <div>
                                <label class="labelAlineado">Municipio:&nbsp;</label>
                                <input type="text" name="municipio" placeholder="Municipio">
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
                    <form action="municipios.php" method="post" enctype="multipart/form-data">

                        <fieldset class="shadow pl-3 pt-1 mb-2 pb-1 mt-auto">
                            <legend class="pt-auto pb-2">ELIMINAR MUNICIPIO/CODIGO POSTAL</legend>
                            <div>
                                <label>¿Realmente desea eliminar el codigo postal <?php echo $codpostal; ?>?</label>
                                <input type="hidden" name="id" value="<?php echo $codpostal; ?>">
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
                            <legend class="pt-auto pb-2">MODIFICAR MUNICIPIO/CÓDIGO POSTAL</legend>
                            <div>
                                <label class="labelAlineado">Código postal:&nbsp;</label>
                                <input type="text" name="id" value="<?php echo $codpostal; ?>">
                                <input type="hidden" name="idAnterior" value="<?php echo $codpostal; ?>">
                            </div>
                            <div>
                                <label class="labelAlineado">Municipio:&nbsp;</label>
                                <input type="text" name="municipio" value="<?php echo $municipio; ?>">
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