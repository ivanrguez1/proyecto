<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>FAQ - UPOCASA</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/best-carousel-slide-1.css">
    <link rel="stylesheet" href="assets/css/best-carousel-slide.css">
    <link rel="stylesheet" href="assets/css/Blog---Recent-Posts-1.css">
    <link rel="stylesheet" href="assets/css/Blog---Recent-Posts.css">
    <link rel="stylesheet" href="assets/css/divider-text-middle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
</head>

<body>
    <?php include "./header.html" ?>
    <main class="page faq-page">
        <section class="clean-block clean-faq dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Alta de Inmueble</h2>
                </div>
                <div class="block-content">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Carga de imágenes</legend><input type="file"><input type="file"><input type="file"><input type="file"><input type="file">
                        </fieldset>
                        <br>
                        <div><label>Tipo de Vivienda:&nbsp;</label><select>
                                <option value="vivienda" selected="">Vivienda</option>
                                <option value="garaje">Garaje</option>
                                <option value="terreno">Terreno</option>
                                <option value="localComercial">Local Comercial</option>
                                <option value="oficina">Oficina</option>
                                <option value="trastero">Trastero</option>
                            </select></div>
                        <div><label>Precio del Anuncio:&nbsp;</label>
                            <div class="form-check form-check-inline d-inline"><input class="form-check-input" type="radio" id="formCheck-1" name="tipoAnuncio" value="venta"><label class="form-check-label">Vendo</label></div>
                            <div class="form-check form-check-inline d-inline"><input class="form-check-input" type="radio" id="formCheck-1" name="tipoAnuncio" value="alquilar"><label class="form-check-label">Alquilo</label></div>
                            <div class="form-check form-check-inline d-inline"><input class="form-check-input" type="radio" id="formCheck-1" name="tipoAnuncio" value="compartir"><label class="form-check-label">Comparto</label></div>
                            <div class="form-check form-check-inline d-inline"><input class="form-check-input" type="radio" id="formCheck-1" name="tipoAnuncio" value="vacacional"><label class="form-check-label">Vacacional</label></div>
                        </div>
                        <div><label>Precio del Inmueble (€):&nbsp;</label><input type="number" name="precio" min="1" placeholder="Precio Inmueble"></div>
                        <div><label>Superficie (m²):&nbsp;<input type="number" name="superficio" min="1" placeholder="Superficie" step="0.01">&nbsp;<br></label></div>
                        <div><label>Dirección:&nbsp;&nbsp;<input type="text" placeholder="Dirección"><br></label></div>
                        <div><label>CP:&nbsp;</label><input type="text" placeholder="Código Postal"></div>
                        <div><label>Nº Habitaciones:&nbsp;<input type="number" name="superficio" min="1" placeholder="Número de habitaciones">&nbsp;<br></label></div>
                        <div><label>Nº Baños:&nbsp;<input type="number" name="superficio" min="1" placeholder="Número de baños">&nbsp;<br></label></div>
                        <br>
                        <fieldset>
                            <legend>Certificado energético</legend>
                            <div><label>Escala eficiencia consumo:&nbsp;</label><select>
                                    <option value="A" selected="">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                    <option value="G">G</option>
                                </select></div>
                            <div><label>Escala eficiencia emisiones:&nbsp;</label><select>
                                    <option value="A" selected="">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                    <option value="G">G</option>
                                </select></div>
                        </fieldset>
                        <br>
                        <div><label>Comentarios: &nbsp;<textarea rows="5" cols="100"></textarea>&nbsp;&nbsp;<br></label></div>
                        <div><label>Extras Finca:&nbsp;</label><select multiple="">
                                <option value="garajePrivado" selected="">Garaje privado</option>
                                <option value="trastero">Trastero</option>
                                <option value="ascensor">Ascensor</option>
                                <option value="parkingComunitario">Parking comunitario</option>
                                <option value="servicioPorteria">Servicio de portería</option>
                                <option value="videportero">Videoportero</option>
                            </select></div>
                        <br>
                        <div><label>Extras Básicos:&nbsp;</label><select multiple="">
                                <option value="aireAcondicionado" selected="">Aire acondicionado</option>
                                <option value="armarios">Armarios</option>
                                <option value="calefaccion">Calefacción</option>
                                <option value="parquet">Parquet</option>
                                <option value="cocinaOffice">Cocina Office</option>
                                <option value="suiteConBaño">Suite - con baño</option>
                                <option value="amueblado">Amueblado</option>
                                <option value="electrodomesticos">Electrodomésticos</option>
                                <option value="horno">Horno</option>
                                <option value="lavadora">Lavadora</option>
                                <option value="microondas">Microondas</option>
                                <option value="nevera">Nevera</option>
                                <option value="tv">TV</option>
                                <option value="internet">Internet</option>
                                <option value="puertaBlindada">Puerta Blindada</option>
                                <option value="lavadero">Lavadero</option>
                                <option value="noAmueblado">No Amueblado</option>
                            </select></div>
                        <br>
                        <div><label>Otros Extras:&nbsp;</label><select multiple="">
                                <option value="jardinPrivado" selected="">Jardín Privado</option>
                                <option value="terreza">Terreza</option>
                                <option value="zonaComunitaria">Zona Comunitaria</option>
                                <option value="patio">Patio</option>
                                <option value="piscina">Piscina</option>
                                <option value="balcon">Balcón</option>
                                <option value="zonaDeportiva">Zona Deportiva</option>
                                <option value="zonaInfantil">Zona Infantil</option>
                                <option value="piscinaComunitaria">Piscina Comunitaria</option>
                            </select></div>
                        <br><button class="btn btn-primary btn-block" type="submit">Enviar</button>
                    </form>
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