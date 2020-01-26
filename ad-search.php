<?php
require_once("assets/php/bbdd.php");
session_start();
$mensaje = "-----";


if (isset($_POST['envio'])) {

    // Toda la lógica PHP de Alta del anuncio (tablas anuncios y anuncios_extras)
    $tipoVivienda = $_POST['tipoVivienda'];
    $tipoAnuncio = $_POST['tipoAnuncio'];
    $precio = explode(",", $_POST['precio'], 2);
    if (sizeof($precio)==1){
        $precio[1] = $precio[0];
    }
    
    $superficie = explode(",", $_POST['superficie'], 2);

    if (sizeof($superficie)==1){
        $superficie[1] = $superficie[0];
    }

    $direccion = $_POST['direccion'];
    $codPostal = $_POST['codPostal'];
    $numHabitaciones = explode(",", $_POST['numHabitaciones'], 2);

    if (sizeof($numHabitaciones)==1){
        $numHabitaciones[1] = $numHabitaciones[0];
    }
    
    $numAseos = explode(",", $_POST['numAseos'], 2);

    if (sizeof($numAseos)==1){
        $numAseos[1] = $numAseos[0];
    }

    $sql = "SELECT * FROM anuncios 
            WHERE idTipoVivienda = '" . $tipoVivienda . "' 
            AND idTipoAnuncio = '" . $tipoAnuncio . "' 
            AND (precio >= '" . $precio[0] . "' OR precio < '" . $precio[1] ."')
            AND (superficie >= '" . $superficie[0] . "' OR superficie < '" . $superficie[1] ."')
            AND direccion = '" . $direccion . "' 
            AND codPostal = '" . $codPostal . "'
            AND (numHabitaciones >= '" . $numHabitaciones[0] . "' OR numHabitaciones < '" . $numHabitaciones[1] ."')
            AND (numAseos >= '" . $numAseos[0] . "' OR numAseos < '" . $numAseos[1] ."')";

    $mensaje = "Búsqueda Finalizada";
    $resultado = ejecutaConsulta($sql);
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

    <script type="text/javascript" language="javascript" src="assets/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/jquery.range.css">
    <script src="assets/js/jquery.range.js"></script>


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
            <div class="block-heading">
                <h2 class="text-info text-center mt-5">Búsqueda de anuncios</h2>
            </div>

            <div>
                <br />
                <?php
                if (isset($_POST['envio'])) {
                    include "./ad-search-result.php";
                }
                ?>
                <p>&nbsp;
            </div>

            <div class="container">
                <!-- Mensajes del servidor referentes al registro -->
                <p id="mensajes" class="alert alert-success"><?php
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
                                    <input class="form-check-input" type="radio" name="tipoAnuncio" value="1"
                                        checked="checked">
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
                                <label class="labelAlineado" style="display: inline">Precio en € (escala
                                    1:1000):&nbsp;</label>
                                <br><br>

                                <input class="range-slider" type="hidden" name="precio" />
                                <script>
                                $('.range-slider').jRange({
                                    from: 1,
                                    to: 500,
                                    step: 25,
                                    scale: [1, 50, 100, 150, 200, 250, 300, 350, 400, 450, 500],
                                    format: '%s',
                                    width: 750,
                                    isRange: true,
                                });
                                </script>
                            </div>
                            <div>
                                <br>
                                <label class="labelAlineado">Superficie (m²):&nbsp;</label>
                                <br><br>

                                <input class="range-slider" type="hidden" name="superficie" />
                                <script>
                                $('.range-slider').jRange({
                                    from: 1,
                                    to: 400,
                                    step: 20,
                                    scale: [1, 50, 100, 150, 200, 250, 300, 350, 400],
                                    format: '%s',
                                    width: 750,
                                    isRange: true,
                                });
                                </script>
                            </div>
                            <div>
                                <br><br>
                                <label class="labelAlineado">Dirección:&nbsp;&nbsp;</label>
                                <input type="text" placeholder="Dirección" name="direccion">

                            </div>
                            <div>
                                <label class="labelAlineado">CP:&nbsp;</label>
                                <input type="text" placeholder="Código Postal" name="codPostal">
                            </div>
                            <div>
                                <label class="labelAlineado">Nº Habitaciones:&nbsp;</label>
                                <br><br>

                                <input class="range-slider" type="hidden" name="numHabitaciones" />
                                <script>
                                $('.range-slider').jRange({
                                    from: 0,
                                    to: 6,
                                    step: 1,
                                    scale: [0, 1, 2, 3, 4, 5, 6],
                                    format: '%s',
                                    width: 750,
                                    isRange: true,
                                });
                                </script>
                            </div>
                            <div>
                                <br><br>
                                <label class="labelAlineado">Nº Baños:&nbsp;</label>
                                <br><br>

                                <input class="range-slider" type="hidden" name="numAseos" />
                                <script>
                                $('.range-slider').jRange({
                                    from: 0,
                                    to: 4,
                                    step: 1,
                                    scale: [0, 1, 2, 3, 4],
                                    format: '%s',
                                    width: 750,
                                    isRange: true,
                                });
                                </script>
                                <br><br>
                            </div>
                        </fieldset>
                        <br>
                        <input class="btn btn-primary btn-block" type="submit" value="Realizar Búsqueda"
                            name="envio"></input>
                    </form>
            </div>
        </section>
    </main>
    <?php include "./footer.html" ?>
</body>

</html>