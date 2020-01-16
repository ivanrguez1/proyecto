<?php
require_once("assets/php/bbdd.php");
session_start();
$mensaje = "-----";


if(isset($_GET['id'])) {

    // Realizamos la búsqueda en la Base de datos
    $id = $_GET['id'];
    $sql = "SELECT 
            tipoAnuncio, tipoVivienda, 
            direccion, codPostal, superficie, numHabitaciones, numAseos
            FROM anuncios, tiposAnuncio, tiposVivienda
            WHERE anuncios.idTipoAnuncio = tiposAnuncio.idTipoAnuncio
            AND anuncios.idtipoVivienda = tiposVivienda.idtipoVivienda
            AND idAnuncio = '".$id."'"; 
    
    $mensaje = "Búsqueda Finalizada";
    $resultado = ejecutaConsulta ($sql);
    $numRegistros = mysqli_num_rows($resultado);
    $mensaje = $sql;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ver Anuncio</title>
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
</head>

<body>
    <?php 
    if (isset($_SESSION['correo'])) {
        include "./header-logged.php";  
    } else {
        include "./header.html"; 
    } 
    ?>

    <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Anuncio Seleccionado</h2>
                </div>
                <!-- 
                    ALEX: La presentación es un desastre. Hay que ponerlo bonito. 
                -->
                <form action="ad-search.php" method="post">
                    <?php
                    while($registro = mysqli_fetch_array($resultado)) {
                    ?>
                    <div class="form-group"><label>Tipo de Anuncio</label><strong><?php echo $registro['tipoAnuncio']; ?></strong></div>
                    <div class="form-group"><label>Tipo de Vivienda</label><strong><?php echo $registro['tipoVivienda']; ?></strong></div>
                    <div class="form-group"><label>Dirección</label><strong><?php echo $registro['direccion']; ?></strong></div>
                    <div class="form-group"><label>Código Postal</label><strong><?php  echo $registro['codPostal']; ?></strong></div>
                    <div class="form-group"><label>Superficie</label><strong><?php echo $registro['superficie']; ?></strong></div>
                    <div class="form-group"><label>Nº de Habitaciones</label><strong><?php echo $registro['numHabitaciones']; ?></strong></div>
                    <div class="form-group"><label>Nº de Aseos</label><strong><?php echo $registro['numAseos']; ?></strong></div>
                    <?php 
                    }
                    // Liberamos el resultado del SQL
                    mysqli_free_result($resultado);
                    ?>
                    <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Volver a Buscar</button>
                    </div>
                </form>
                <div>
                <!-- Mensajes del servidor referentes al registro -->
                <p id="mensajes" class="alert alert-success" ><?php
                    echo $mensaje; 
                ?>
                </div>
            </div>
        </section>
    </main>
    <?php include "./footer.html" ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>