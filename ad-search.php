<?php
require_once("assets/php/bbdd.php");
session_start();
$mensaje = "-----";


if(isset($_POST['envio'])) {

    // Toda la lógica PHP de Alta del anuncio (tablas anuncios y anuncios_extras)
    $tipoVivienda = $_POST['tipoVivienda'];
    $tipoAnuncio = $_POST['tipoAnuncio'];
    $precio = $_POST['precio'];
    $superficie = $_POST['superficie'];
    $direccion = $_POST['direccion'];
    $codPostal = $_POST['codPostal'];
    $numHabitaciones = $_POST['numHabitaciones'];
    $numAseos = $_POST['numAseos'];
    
    $sql = "SELECT * FROM anuncios 
            WHERE idTipoVivienda = '".$tipoVivienda."' 
            OR idTipoAnuncio = '".$tipoAnuncio."' 
            OR precio = '".$precio."' 
            OR superficie = '".$superficie."' 
            OR direccion = '".$direccion."' 
            OR codPostal = '".$codPostal."' 
            OR numHabitaciones = '".$numHabitaciones."' 
            OR numAseos = '".$numAseos."'"; 
    
    $mensaje = "Búsqueda Finalizada";
    $resultado = ejecutaConsulta ($sql);
    $numRegistros = mysqli_num_rows($resultado);
    
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - UPOCASA</title>
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
        <section>
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info text-center mt-5">Búsqueda de anuncios</h2>
                </div>

                <!-- ALEX! Habría que ponerlo bonito -->     
                <div>
                    <br />
                    <?php
                    if(isset($_POST['envio'])) {
                        echo "<table class='table'>";
                        echo "<thead>";
                        echo "<tr>";
                            echo "<th> Dirección </th>";
                            echo "<th> CodPostal </th>";
                            echo "<th> Precio </th>";
                            echo "<th> Superficie </th>";
                            echo "<th> Nº Habitaciones</th>";
                            echo "<th> Nº Baños</th>";
                        echo "</tr>";
                        echo "</thead>";    
                        while($registro = mysqli_fetch_array($resultado)) {
                            echo "<tr>";
                            echo "<td>" . $registro['direccion'] . "</td>";
                            echo "<td>" . $registro['codPostal'] . "</td>";
                            echo "<td>" . $registro['precio'] . "€ </td>";
                            echo "<td>" . $registro['superficie'] . "</td>";
                            echo "<td>" . $registro['numHabitaciones'] . "</td>";
                            echo "<td>" . $registro['numAseos'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>"; 
                        mysqli_free_result($resultado);
                    }
                    ?>
                </div>
                
                <div>
                     <!-- Mensajes del servidor referentes al registro -->
                    <p id="mensajes"><?php
                    echo $mensaje; 
                    ?>

                    <form action="#" method="post" enctype="multipart/form-data">
                        
                        <fieldset class="shadow pl-3 pt-1 mb-2 pb-1 mt-auto">
                            <legend class="pt-auto pb-2">Características del inmueble</legend>
                            <div>
                                <label class="labelAlineado">Tipo de Vivienda:&nbsp;</label>
                                <select name="tipoVivienda">
                                    <option value="1" selected="">Vivienda</option>
                                    <option value="2">Garaje</option>
                                    <option value="3">Terreno</option>
                                    <option value="4">Local Comercial</option>
                                    <option value="5">Oficina</option>
                                    <option value="6">Trastero</option>
                                </select>
                            </div>
                            <div>
                                <label class="labelAlineado">Tipo de Anuncio:&nbsp;</label>
                                <div class="form-check form-check-inline d-inline">
                                    <input class="form-check-input" type="radio" name="tipoAnuncio" value="1">
                                    <label class="form-check-label">Vendo</label>
                                </div>
                                <div class="form-check form-check-inline d-inline">
                                    <input class="form-check-input" type="radio" name="tipoAnuncio" value="2">
                                    <label class="form-check-label">Alquilo</label>
                                </div>
                                <div class="form-check form-check-inline d-inline">
                                    <input class="form-check-input" type="radio" name="tipoAnuncio" value="3">
                                    <label class="form-check-label">Comparto</label>
                                </div>
                                <div class="form-check form-check-inline d-inline">
                                    <input class="form-check-input" type="radio" name="tipoAnuncio" value="4">
                                    <label class="form-check-label">Vacacional</label>
                                </div>
                            </div>
                            <div>
                                <label class="labelAlineado">Precio (€):&nbsp;</label>
                                <input type="number" name="precio" min="1" placeholder="Precio">
                            </div>
                            <div>
                                <label class="labelAlineado">Superficie (m²):&nbsp;</label>
                                <input type="number" name="superficie" min="1" placeholder="Superficie" step="0.01">&nbsp;

                            </div>
                            <div>
                                <label class="labelAlineado">Dirección:&nbsp;&nbsp;</label>
                                <input type="text" placeholder="Dirección" name="direccion">

                            </div>
                            <div>
                                <label class="labelAlineado">CP:&nbsp;</label>
                                <input type="text" placeholder="Código Postal" name="codPostal">
                            </div>
                            <div>
                                <label class="labelAlineado">Nº Habitaciones:&nbsp;</label>
                                <input type="number" name="numHabitaciones" min="1" placeholder="Número de habitaciones">&nbsp;

                            </div>
                            <div>
                                <label class="labelAlineado">Nº Baños:&nbsp;</label>
                                <input type="number" name="numAseos" min="1" placeholder="Número de baños">&nbsp;

                            </div>
                        </fieldset>
                        <br>
                        <input class="btn btn-primary btn-block" type="submit" value="Realizar Búsqueda" name="envio"></input>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <?php include "./footer.html" ?>
</body>

</html>