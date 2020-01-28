<?php
require_once("assets/php/bbdd.php");
session_start();

$errors = array();

if (isset($_POST['mensajeEnviado'])) {

    $mensaje = filter_var(trim($_POST['mensaje']), FILTER_SANITIZE_STRING);

    if (strlen($mensaje) < 20) {
        array_push($errors, "El mensaje debe de ser de mínimo 20 carácteres.");
    }

    $sql = "INSERT INTO mensajes(idUsuOrigen, idUsuDestino, mensaje) VALUES('" . $_SESSION['idUsuario'] . "','" . $_GET['idPropietario'] . "','" . $mensaje . "')";
    if (sizeof($errors) == 0) {
        ejecutarAccion($sql);
    }
}

if (isset($_GET['id'])) {

    // Realizamos la búsqueda en la Base de datos
    $id = $_GET['id'];
    $sql = "SELECT 
            tipoAnuncio, tipoVivienda, 
            direccion, codPostal, superficie, numHabitaciones, numAseos, comentarios, precio, consumo, emisiones
            FROM anuncios, tiposAnuncio, tiposVivienda
            WHERE anuncios.idTipoAnuncio = tiposAnuncio.idTipoAnuncio
            AND anuncios.idtipoVivienda = tiposVivienda.idtipoVivienda
            AND idAnuncio = '" . $id . "'";

    $mensaje = "Búsqueda Finalizada";
    $resultado = ejecutarConsulta($sql);
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
    <link rel="stylesheet" href="assets/css/style.css">
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
        <section class="clean-block-anuncioSeleccionado">
            <div class="containerAnuncioSeleccionado">
                <div class="block-heading">
                    <h2 class="text-info" style="text-align: center">Anuncio Seleccionado</h2>
                </div>
                <form action="#" method="post" id="formMensaje">
                    <input type="hidden" name="mensajeEnviado" value="1" />
                    <?php include('errors.php'); ?>
                </form>
                <form action="ad-search.php" method="post" class="clean-block-adSelected">
                    <div class="contentAdSelected">
                        <?php
                        while ($registro = mysqli_fetch_array($resultado)) {
                        ?>
                            <div class="form-group"><label>Precio:
                                </label><strong><?php echo " " . $registro['precio'] . "€"; ?></strong></div>
                            <div class="form-group"><label>Tipo de Anuncio:
                                </label><strong><?php echo " " . $registro['tipoAnuncio']; ?></strong></div>
                            <div class="form-group"><label>Tipo de Vivienda:
                                </label><strong><?php echo " " . $registro['tipoVivienda']; ?></strong></div>
                            <div class="form-group"><label>Descripción:
                                </label><strong><?php echo " " . $registro['comentarios']; ?></strong></div>
                            <div class="form-group"><label>Dirección:
                                </label><strong><?php echo " " . $registro['direccion']; ?></strong></div>
                            <div class="form-group"><label>Código Postal:
                                </label><strong><?php echo " " . $registro['codPostal']; ?></strong></div>
                            <div class="form-group"><label>Superficie:
                                </label><strong><?php echo " " . $registro['superficie'] . "m²"; ?></strong></div>
                            <div class="form-group"><label>Nº de Habitaciones:
                                </label><strong><?php echo " " . $registro['numHabitaciones']; ?></strong></div>
                            <div class="form-group"><label>Nº de Aseos:
                                </label><strong><?php echo " " . $registro['numAseos']; ?></strong></div>
                            <div class="form-group"><label>Escala eficiencia consumo:
                                </label><strong><?php echo " " . $registro['consumo']; ?></strong></div>
                            <div class="form-group"><label>Escala eficiencia emisiones:
                                </label><strong><?php echo " " . $registro['emisiones']; ?></strong></div>
                        <?php
                        }
                        // Liberamos el resultado del SQL
                        mysqli_free_result($resultado);
                        ?>
                    </div>
                    <?php


                    $sql = "SELECT 
                    urlFoto1, urlFoto2, 
                    urlFoto3, urlFoto4, urlFoto5
                    FROM fotos
                    WHERE idAnuncio = '" . $id . "'";

                    $resultado = ejecutarConsulta($sql);
                    $registro = mysqli_fetch_array($resultado);

                    if ($registro == NULL) {
                        echo "<input id='fotosAnuncio' style='display: none; value=''/>";
                    } else {
                        echo "<input id='fotosAnuncio' style='display: none; ' value='" . $registro['urlFoto1'] . "," . $registro['urlFoto2'] . "," . $registro['urlFoto3'] . "," . $registro['urlFoto4'] . "," . $registro['urlFoto5'] . "'/>";
                    }


                    ?>



                    <div class="carrusel">
                        <img id="imagenGrande" width="70%" height="70%" alt="Foto" />
                        <div id="divMiniaturas"></div>
                    </div>


                    <?php

                    //[0] -> Extras Finca; [1] -> Extras Básicos; [2] -> Otros Extras
                    $tiposExtras = [['Garaje Privado', 'Trastero', 'Ascensor', 'Parking Comunitario', 'Servicio de Portería', 'Videoportero'], ['Aire acondicionado', 'Armarios', 'Calefacción', 'Parquet', 'Cocina Office', 'Suite con baño', 'Amueblado', 'Electrodomésticos', 'Horno', 'Lavadora', 'Microondas', 'Nevera', 'TV', 'Internet', 'Puerta Blindada', 'Lavadero', 'No Amueblado'], ['Jardín Privado', 'Terraza', 'Zona Comunitaria', 'Patio', 'Piscina', 'Balcón', 'Zona Deportiva', 'Zona Infantil', 'Piscina Comunitaria']];
                    $extrasFinca = array();
                    $extrasBasicos = array();
                    $otrosExtras = array();

                    $sql = "SELECT extra FROM extras WHERE idExtra in (SELECT idExtra FROM anuncios_extras WHERE idAnuncio = '" . $_GET['id'] . "')";
                    $resultado = ejecutarConsulta($sql);

                    while ($registro = mysqli_fetch_array($resultado)) {

                        if (in_array($registro['extra'], $tiposExtras[0])) {
                            array_push($extrasFinca, $registro['extra']);
                        } else if (in_array($registro['extra'], $tiposExtras[1])) {
                            array_push($extrasBasicos, $registro['extra']);
                        } else {
                            array_push($otrosExtras, $registro['extra']);
                        }
                    }


                    ?>


                    <div id="divExtrasShowAd" class='row'>
                        <div class='column'>
                            <p style="text-align: center">- Extras Finca -</p>
                            <br><br>
                            <?php

                            if (sizeof($extrasFinca) > 0) {
                                echo "<ul type='circle'>";
                            }

                            for ($i = 0; $i < sizeof($extrasFinca); $i++) {
                                echo "<li>" . $extrasFinca[$i] . "</li> <br>";
                            }

                            if (sizeof($extrasFinca) > 0) {
                                echo "</ul>";
                            }
                            ?>

                        </div>
                        <div class='column'>
                            <p style="text-align: center">- Extras Básicos -</p>

                            <br><br>
                            <?php

                            if (sizeof($extrasBasicos) > 0) {
                                echo "<ul type='circle'>";
                            }

                            for ($i = 0; $i < sizeof($extrasBasicos); $i++) {
                                echo "<li>" . $extrasBasicos[$i] . "</li> <br>";
                            }

                            if (sizeof($extrasBasicos) > 0) {
                                echo "</ul>";
                            }
                            ?>

                        </div>
                        <div class='column'>
                            <p style="text-align: center">- Otros Extras -</p>

                            <br><br>
                            <?php

                            if (sizeof($otrosExtras) > 0) {
                                echo "<ul type='circle'>";
                            }

                            for ($i = 0; $i < sizeof($otrosExtras); $i++) {
                                echo "<li>" . $otrosExtras[$i] . "</li> <br>";
                            }

                            if (sizeof($otrosExtras) > 0) {
                                echo "</ul>";
                            }
                            ?>

                        </div>
                    </div>
                    <br><br>
                    <div id="divMensaje">
                        <p>¿Te interesa? Escríbele un mensaje al propietario del anuncio:</p>
                        <textarea rows="4" cols="50" id="mensaje" name="mensaje" form="formMensaje"></textarea>
                        <br>
                        <button name="btnMensajeEnviado" id="btnMensajeEnviado" form="formMensaje">Enviar
                            mensaje</button>
                    </div>
                    <?php

                    //Si el usuario logueado es el propietario -> No se puede enviar un mensaje a sí mismo.about

                    if ($_GET['idPropietario'] == $_SESSION['idUsuario']) {
                    ?>
                        <script>
                            document.getElementById('divMensaje').style.display = "none";
                        </script>
                    <?php
                    }

                    ?>

                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit" id="btnVolverABuscar">Volver a
                            Buscar</button>
                    </div>
            </div>
            </form>
            <div>
                <!-- Mensajes del servidor referentes al registro -->
                <!--<p id="mensajes" class="alert alert-success"><?php
                                                                    echo $mensaje;
                                                                    ?>
                    -->
            </div>

            </div>

        </section>
    </main>
    <?php include "./footer.html" ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/carrusel.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>