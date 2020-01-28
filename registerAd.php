<?php
require_once("assets/php/bbdd.php");
session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: login.php');
}

$errors = array();

if (isset($_POST['envio'])) {

    // Toda la lógica PHP de Alta del anuncio (tablas anuncios y anuncios_extras)
    $tipoVivienda = $_POST['tipoVivienda'];
    $tipoAnuncio = $_POST['tipoAnuncio'];
    $precio = $_POST['precio'];
    $superficie = $_POST['superficie'];
    $direccion = $_POST['direccion'];
    $codPostal = $_POST['codPostal'];
    $numHabitaciones = $_POST['numHabitaciones'];
    $numAseos = $_POST['numAseos'];
    $consumo = $_POST['consumo'];
    $emisiones = $_POST['emisiones'];
    $comentarios = $_POST['comentarios'];
    $extras = $_POST['extras'];

    $idUsuario = $_SESSION['idUsuario'];

    if (empty($precio)) {
        array_push($errors, "¡El precio es obligatorio!");
    }
    if (empty($superficie)) {
        array_push($errors, "¡La superficie es obligatoria!");
    }

    if (empty($direccion)) {
        array_push($errors, "¡La dirección es obligatoria!");
    }

    if (empty($codPostal)) {
        array_push($errors, "¡El código postal es obligatorio!");
    }

    //Checkeo de errores en fotos

    $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/upocasa/assets/img/ads/' . $_SESSION['nick'] . '/';
    $relativeTargetDir = 'assets/img/ads/' . $_SESSION['nick'] . '/';
    for ($i = 1; $i < 6; $i++) {
        $fileName = time() . basename($_FILES["foto" . $i]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if (!empty($_FILES["foto" . $i]["name"])) {
            $allowTypes = array('jpg', 'png', 'jpeg');
            if (!in_array($fileType, $allowTypes)) {
                array_push($errors, "¡Lo siento, solo se permiten fotos de tipo JPG, JPEG, PNG.!");
                if (($_FILES["foto" . $i]["size"]) > 2048000) {
                    array_push($errors, "¡El máximo tamaño de las fotos es de 2MB!");
                }
            }
        }
    }


    if (count($errors) == 0) {

        // Rellenamos los datos de la tabla anuncios
        $sql = "INSERT INTO anuncios 
    (idUsuario, idTipoAnuncio, idTipoVivienda, precio, 
    superficie, direccion, codPostal, numHabitaciones, 
    numAseos, consumo, emisiones, comentarios)
    VALUES
    ('" . $idUsuario . "','" . $tipoAnuncio . "','" . $tipoVivienda . "','" . $precio . "',
    '" . $superficie . "','" . $direccion . "','" . $codPostal . "','" . $numHabitaciones . "',
    '" . $numAseos . "','" . $consumo . "','" . $emisiones . "','" . $comentarios . "')";

    $idAnuncio = ejecutarAccion($sql);

        // Rellenamos los datos de la tabla anuncios_extras
        $sql = "INSERT INTO anuncios_extras (idAnuncio, idExtra)
    VALUES ";
        for ($i = 0; $i < count($extras) - 1; $i++) {
            $sql .= "('" . $idAnuncio . "','" . $extras[$i] . "'),";
        }
        $sql .= "('" . $idAnuncio . "','" . $extras[count($extras) - 1] . "');";

    ejecutarAccion($sql);

        // ----------------------------------------------------------
        // Subida de fotos a carpeta personal y registrado en BD
        // Recurso: https://www.codexworld.com/upload-store-image-file-in-database-using-php-mysql/


        for ($i = 1; $i < 6; $i++) {
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            if (!empty($_FILES["foto" . $i]["name"])) {
                // Upload file to server
                if (move_uploaded_file($_FILES["foto" . $i]["tmp_name"], $targetFilePath)) {
                    $sql = "INSERT INTO fotos (idAnuncio, urlFoto" . $i . ") VALUES ('" . $idAnuncio . "','" . $relativeTargetDir . time() . "')";
                    ejecutarAccion($sql);
                } else {
                    array_push($errors, "¡Vaya no se ha podido subir las fotos, anuncio creado sin fotos. Contacte con el administrador!");
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Alta de Anuncio - UPOCASA</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/best-carousel-slide-1.css">
    <link rel="stylesheet" href="assets/css/best-carousel-slide.css">
    <link rel="stylesheet" href="assets/css/Blog---Recent-Posts-1.css">
    <link rel="stylesheet" href="assets/css/Blog---Recent-Posts.css">
    <!--<link rel="stylesheet" href="assets/css/divider-text-middle.css">-->
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
                    <h2 class="text-info text-center mt-5">Alta de Anuncio</h2>
                </div>
                <div>

                    <form action="#" method="post" enctype="multipart/form-data">
                        <?php include('errors.php'); ?>
                        <fieldset class="shadow pl-3 pb-1 pt-auto bg-white mb-2 mt-5">
                            <legend class="">Carga de imágenes</legend>
                            <input type="file" class="pt-2 pb-2 w-100" name="foto1">
                            <input type="file" class="pt-2 pb-2 w-100" name="foto2">
                            <input type="file" class="pt-2 pb-2 w-100" name="foto3">
                            <input type="file" class="pt-2 pb-2 w-100" name="foto4">
                            <input type="file" class="pt-2 pb-2 w-100" name="foto5">
                            <br><br>
                            <div class="info">
                                <p>&emsp;Por defecto la <strong>primera</strong> imagen corresponde a la foto de
                                    <strong>portada</strong></p>
                            </div>
                        </fieldset>
                        <br>
                        <fieldset class="shadow pl-3 pt-1 mb-2 pb-1 mt-auto">
                            <legend class="pt-auto pb-2">Características del inmueble</legend>
                            <div>
                                <label class="labelAlineado">Tipo de Vivienda:&nbsp;</label>
                                <select name="tipoVivienda">
                                    <option value="1" selected>Vivienda</option>
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
                                    <input class="form-check-input" type="radio" name="tipoAnuncio" value="1" checked>
                                    <label class="form-check-label">Vendo</label>
                                </div>
                                <div class="form-check form-check-inline d-inline">
                                    <input class="form-check-input" type="radio" name="tipoAnuncio" value="2">
                                    <label class="form-check-label">Alquilo</label>
                                </div>
                                <div class="form-check form-check-inline d-inline">
                                    <input clasfiles="form-check-input" type="radio" name="tipoAnuncio" value="3">
                                    <label class="form-check-label">Comparto</label>
                                </div>
                                <div class="form-check form-check-inline d-inline">
                                    <input class="form-check-input" type="radio" name="tipoAnuncio" value="4">
                                    <label class="form-check-label">Vacacional</label>
                                </div>
                            </div>
                            <div>
                                <label class="labelAlineado">Precio (€):&nbsp;</label>
                                <input type="number" name="precio" min="1" placeholder="Precio Inmueble">
                            </div>
                            <div>
                                <label class="labelAlineado">Superficie (m²):&nbsp;</label>
                                <input type="number" name="superficie" min="1" placeholder="Superficie"
                                    step="0.01">&nbsp;

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
                                <input type="number" name="numHabitaciones" min="0" max="6"
                                    placeholder="Número de habitaciones" value="0">&nbsp;

                            </div>
                            <div>
                                <label class="labelAlineado">Nº Baños:&nbsp;</label>
                                <input type="number" name="numAseos" min="0" max="4" placeholder="Número de baños"
                                    value="0">&nbsp;

                            </div>
                        </fieldset>
                        <br>
                        <fieldset class="shadow p-2 mb-auto mb-2 mt-auto">
                            <legend>Certificado energético</legend>
                            <div>
                                <label class="labelAlineado labelAlineadoCertificado">Escala eficiencia
                                    consumo:&nbsp;</label>
                                <select name="consumo">
                                    <option value="A" selected="">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                    <option value="G">G</option>
                                </select>
                            </div>
                            <div>
                                <label class="labelAlineado labelAlineadoCertificado">Escala eficiencia
                                    emisiones:&nbsp;</label>
                                <select name="emisiones">
                                    <option value="A" selected="">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                    <option value="G">G</option>
                                </select>
                            </div>
                        </fieldset>
                        <br>
                        <p>
                            <legend class="shadow-none p-2 pb-auto mb-4 mt-auto ">Comentarios del Inmueble
                                <span style="font-size: 1rem; font-weight: 400;">: &nbsp; </span>
                                <textarea rows="5" cols="100" name="comentarios"
                                    class="bg-white shadow-lg w-100 h-auto border-secondary pt-auto mt-2"></textarea>
                                <span style="font-size: 1rem; font-weight: 400;">&nbsp; &nbsp;</span>
                            </legend>
                        </p>
                        <div>
                        </div>
                        <fieldset class="shadow pl-3 mb-2 text-left bg-white pr-5 pb-4 pt-1 mt-n5">
                            <legend>Extras</legend>
                            <div id="divExtras" class="d-flex flex-nowrap justify-content-between flex-row">
                                <div class="h-100 shadow w-25 text-center ml-3 p-3">
                                    <label class="labelAlineado">Extras Finca:&nbsp;</label>
                                    <select multiple="multiple" name="extras[]">
                                        <option value="1" selected="">Garaje privado</option>
                                        <option value="2">Trastero</option>
                                        <option value="3">Ascensor</option>
                                        <option value="4">Parking comunitario</option>
                                        <option value="5">Servicio de portería</option>
                                        <option value="6">Videoportero</option>
                                    </select>
                                </div>
                                <br>
                                <div class="p-3 w-25 shadow text-center">
                                    <label class="labelAlineado">Extras Básicos:&nbsp;</label>
                                    <select multiple="multiple" name="extras[]">
                                        <option value="7" selected="">Aire acondicionado</option>
                                        <option value="8">Armarios</option>
                                        <option value="9">Calefacción</option>
                                        <option value="10">Parquet</option>
                                        <option value="11">Cocina Office</option>
                                        <option value="12">Suite con baño</option>
                                        <option value="13">Amueblado</option>
                                        <option value="14">Electrodomésticos</option>
                                        <option value="15">Horno</option>
                                        <option value="16">Lavadora</option>
                                        <option value="17">Microondas</option>
                                        <option value="18">Nevera</option>
                                        <option value="19">TV</option>
                                        <option value="20">Internet</option>
                                        <option value="21">Puerta Blindada</option>
                                        <option value="22">Lavadero</option>
                                        <option value="23">No Amueblado</option>
                                    </select>
                                </div>
                                <br>
                                <div class="shadow p-3 w-25 text-center">
                                    <label class="labelAlineado">Otros Extras:</label>
                                    <label style="font-size: 1rem;">&nbsp;</label>
                                    <span style="font-size: 1rem; font-weight: 400;"> </span>
                                    <select multiple="multiple" name="extras[]">
                                        <option value="24" selected="">Jardín Privado</option>
                                        <option value="25">Terraza</option>
                                        <option value="26">Zona Comunitaria</option>
                                        <option value="27">Patio</option>
                                        <option value="28">Piscina</option>
                                        <option value="29">Balcón</option>
                                        <option value="30">Zona Deportiva</option>
                                        <option value="31">Zona Infantil</option>
                                        <option value="32">Piscina Comunitaria</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <br><br><br>
                        <input class="btn btn-primary btn-block" type="submit" value="Enviar" name="envio"></input>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script type="text/javascript">
    $('select[name="extras[]"] option').mousedown(function(e) {
        e.preventDefault();
        $(this).prop('selected', !$(this).prop('selected'));
        return false;
    });
    </script>
    <?php include "./footer.html" ?>
</body>

</html>