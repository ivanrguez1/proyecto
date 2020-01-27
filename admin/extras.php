<?php

require_once("../assets/php/bbdd.php");
session_start();


if (!isset($_SESSION['correo'])) {
    header('Location: index.php');
}

$mensaje = "Consulta Finalizada";

if (isset($_POST['envio']) && $_POST['envio']=="Insertar") {
    $extra = $_POST['extra'];
    $sqlINSERT = "INSERT INTO extras (extra) VALUES ('".$extra."')";

    ejecutarAccion($sqlINSERT);
    $mensaje = "Inserción Realizada";
}

if (isset($_POST['envio']) && $_POST['envio']=="Eliminar") {
    $idExtra = $_POST['idextra'];
    $sqlDELETE = "DELETE FROM extras WHERE idExtra = '".$idExtra."'";

    ejecutarAccion($sqlDELETE);
    $mensaje = "Eliminación Realizada";
}



if (isset($_GET['action']) && $_GET['action']==1 ){
    $idExtra = $_GET['idextra'];
    $sqlSELECTDELETE = "SELECT * FROM extras WHERE idExtra='".$idExtra."'";

    $resultadoSELECTDELETE = ejecutarConsulta($sqlSELECTDELETE);
    $extra = "";
    while($registro = mysqli_fetch_array($resultadoSELECTDELETE)) {
        $extra = $registro['extra'];
    }
    $mensaje = "Preparado para Eliminar el extra ".$extra;
}


if (isset($_GET['action']) && $_GET['action']==2 ){
    $idExtra = $_GET['idextra'];
    $sqlSELECTUPDATE = "SELECT * FROM extras WHERE idExtra='".$idExtra."'";

    $resultadoSELECTUPDATE = ejecutarConsulta($sqlSELECTUPDATE);
    $extra = "";
    while($registro = mysqli_fetch_array($resultadoSELECTUPDATE)) {
        $extra = $registro['extra'];
    }
    $mensaje = "Preparado para actualizar";
}

if (isset($_POST['envio']) && $_POST['envio']=="Modificar") {
    $idextra = $_POST['idextra'];
    $extra = $_POST['extra'];

    $sqlUPDATE = "UPDATE extras SET extra='".$extra ."' WHERE idExtra = '".$idextra ."'";

    ejecutarAccion($sqlUPDATE);
    $mensaje = "Modificación Realizada";
}




$sql = "SELECT * FROM extras";
$resultado = ejecutarConsulta($sql);
$numRegistros = mysqli_num_rows($resultado);



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin - Extras</title>
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

    include "../header-logged.php";
    ?>

    <main class="page faq-page">
    <script>
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
                <h2 class="text-info text-center mt-5">Administración - Extras</h2>
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
                        echo "<td>" . $registro['idExtra'] . "</td>";
                        echo "<td>" . $registro['extra'] . "</td>";
                        echo "<td><a href='extras.php?action=1&idextra=" . $registro['idExtra'] . "'>Eliminar Extra</a></td>";
                        echo "<td><a href='extras.php?action=2&idextra=" . $registro['idExtra'] . "'>Modificar Extra</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>"; 
                    mysqli_free_result($resultado);
                ?>
                <p>&nbsp;
                <!-- Mensajes del servidor referentes al registro -->
                <p id="mensajes" class="alert alert-success"><?php
                    echo $mensaje;
                ?>

                    <?php 
                    if (!isset($_GET['action'])) {
                    ?>
                    <form action="#" method="post" enctype="multipart/form-data">

                        <fieldset class="shadow pl-3 pt-1 mb-2 pb-1 mt-auto">
                            <legend class="pt-auto pb-2">INSERTAR EXTRA</legend>
                            <div>
                                <label class="labelAlineado">Extra:&nbsp;</label>
                                <input type="text" name="extra" min="1" placeholder="extra">
                            </div>
                        </fieldset>
                        <br>
                        <input class="btn btn-primary btn-block" type="submit" value="Insertar" name="envio"></input>
                    </form>
                    <?php }
                    ?>

                    <?php 
                    // Presento el formulario para Eliminar
                    if (isset($_GET['action']) && $_GET['action']==1 ){
                    ?>
                    <form action="extras.php" method="post" enctype="multipart/form-data">

                        <fieldset class="shadow pl-3 pt-1 mb-2 pb-1 mt-auto">
                            <legend class="pt-auto pb-2">ELIMINAR EXTRA</legend>
                            <div>
                                <label>¿Realmente desea eliminar el extra <?php echo $extra; ?>?</label>
                                <input type="hidden" name="idextra" value="<?php echo $idExtra; ?>">
                            </div>
                        </fieldset>
                        <br>
                        <input class="btn btn-primary btn-block" type="submit" value="Eliminar" name="envio"></input>
                        <input class="btn btn-primary btn-block" type="submit" value="Consultar" name="envio"></input>
                    </form>
                    <?php }
                    ?>

                    <?php 
                    // Presento el formulario para Modificar
                    if (isset($_GET['action']) && $_GET['action']==2 ){
                    ?>
                    <form action="#" method="post" enctype="multipart/form-data">

                        <fieldset class="shadow pl-3 pt-1 mb-2 pb-1 mt-auto">
                            <legend class="pt-auto pb-2">MODIFICAR EXTRA</legend>
                            <div>
                                <label class="labelAlineado">Extra:&nbsp;</label>
                                <input type="text" name="extra" min="1" value="<?php echo $extra; ?>">
                                <input type="hidden" name="idextra" value="<?php echo $idExtra; ?>">
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
    <?php include "../footer.html" ?>
</body>

</html>