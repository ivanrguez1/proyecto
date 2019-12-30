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
    <link rel="stylesheet" href="assets/css/divider-text-middle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include "./header.html" ?>
    <main class="page faq-page">
        <section>
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info text-center mt-5">Alta de Anuncio</h2>
                </div>
                <div>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <fieldset class="shadow pl-3 pb-1 pt-auto bg-white mb-2 mt-5">
                            <legend class="">Carga de imágenes</legend>
                            <input type="file" class="pt-2 pb-2 w-100">
                            <input type="file" class="pt-2 pb-2 w-100">
                            <input type="file" class="pt-2 pb-2 w-100">
                            <input type="file" class="pt-2 pb-2 w-100">
                            <input type="file" class="pt-2 pb-2 w-100">
                        </fieldset>
                        <br>
                        <fieldset class="shadow pl-3 pt-1 mb-2 pb-1 mt-auto">
                            <legend class="pt-auto pb-2">Características del inmueble</legend>
                            <div>
                                <label class="labelAlineado">Tipo de Vivienda:&nbsp;</label>
                                <select>
                                    <option value="vivienda" selected="">Vivienda</option>
                                    <option value="garaje">Garaje</option>
                                    <option value="terreno">Terreno</option>
                                    <option value="localComercial">Local Comercial</option>
                                    <option value="oficina">Oficina</option>
                                    <option value="trastero">Trastero</option>
                                </select>
                            </div>
                            <div>
                                <label class="labelAlineado">Tipo de Anuncio:&nbsp;</label>
                                <div class="form-check form-check-inline d-inline">
                                    <input class="form-check-input" type="radio" name="tipoAnuncio" value="venta">
                                    <label class="form-check-label">Vendo</label>
                                </div>
                                <div class="form-check form-check-inline d-inline">
                                    <input class="form-check-input" type="radio" name="tipoAnuncio" value="alquilar">
                                    <label class="form-check-label">Alquilo</label>
                                </div>
                                <div class="form-check form-check-inline d-inline">
                                    <input class="form-check-input" type="radio" name="tipoAnuncio" value="compartir">
                                    <label class="form-check-label">Comparto</label>
                                </div>
                                <div class="form-check form-check-inline d-inline">
                                    <input class="form-check-input" type="radio" name="tipoAnuncio" value="vacacional">
                                    <label class="form-check-label">Vacacional</label>
                                </div>
                            </div>
                            <div>
                                <label class="labelAlineado">Precio (€):&nbsp;</label>
                                <input type="number" name="precio" min="1" placeholder="Precio Inmueble">
                            </div>
                            <div>
                                <label class="labelAlineado">Superficie (m²):&nbsp;</label>
                                <input type="number" name="superficio" min="1" placeholder="Superficie" step="0.01">&nbsp;

                            </div>
                            <div>
                                <label class="labelAlineado">Dirección:&nbsp;&nbsp;</label>
                                <input type="text" placeholder="Dirección">

                            </div>
                            <div>
                                <label class="labelAlineado">CP:&nbsp;</label>
                                <input type="text" placeholder="Código Postal">
                            </div>
                            <div>
                                <label class="labelAlineado">Nº Habitaciones:&nbsp;</label>
                                <input type="number" name="superficio" min="1" placeholder="Número de habitaciones">&nbsp;

                            </div>
                            <div>
                                <label class="labelAlineado">Nº Baños:&nbsp;</label>
                                <input type="number" name="superficio" min="1" placeholder="Número de baños">&nbsp;

                            </div>
                        </fieldset>
                        <br>
                        <fieldset class="shadow p-2 mb-auto mb-2 mt-auto">
                            <legend>Certificado energético</legend>
                            <div>
                                <label class="labelAlineado labelAlineadoCertificado">Escala eficiencia consumo:&nbsp;</label>
                                <select>
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
                                <label class="labelAlineado labelAlineadoCertificado">Escala eficiencia emisiones:&nbsp;</label>
                                <select>
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
                                <textarea rows="5" cols="100" class="bg-white shadow-lg w-100 h-auto border-secondary pt-auto mt-2"></textarea>
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
                                    <select multiple="">
                                        <option value="garajePrivado" selected="">Garaje privado</option>
                                        <option value="trastero">Trastero</option>
                                        <option value="ascensor">Ascensor</option>
                                        <option value="parkingComunitario">Parking comunitario</option>
                                        <option value="servicioPorteria">Servicio de portería</option>
                                        <option value="videportero">Videoportero</option>
                                    </select>
                                </div>
                                <br>
                                <div class="p-3 w-25 shadow text-center">
                                    <label class="labelAlineado">Extras Básicos:&nbsp;</label>
                                    <select multiple="">
                                        <option value="aireAcondicionado" selected="">Aire acondicionado</option>
                                        <option value="armarios">Armarios</option>
                                        <option value="calefaccion">Calefacción</option>
                                        <option value="parquet">Parquet</option>
                                        <option value="cocinaOffice">Cocina Office</option>
                                        <option value="suiteConBaño">Suite con baño</option>
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
                                    </select>
                                </div>
                                <br>
                                <div class="shadow p-3 w-25 text-center">
                                    <label class="labelAlineado">Otros Extras:</label>
                                    <label style="font-size: 1rem;">&nbsp;</label>
                                    <span style="font-size: 1rem; font-weight: 400;"> </span>
                                    <select multiple="">
                                        <option value="jardinPrivado" selected="">Jardín Privado</option>
                                        <option value="terreza">Terraza</option>
                                        <option value="zonaComunitaria">Zona Comunitaria</option>
                                        <option value="patio">Patio</option>
                                        <option value="piscina">Piscina</option>
                                        <option value="balcon">Balcón</option>
                                        <option value="zonaDeportiva">Zona Deportiva</option>
                                        <option value="zonaInfantil">Zona Infantil</option>
                                        <option value="piscinaComunitaria">Piscina Comunitaria</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <br><br><br>
                        <button class="btn btn-primary btn-block" type="submit">Enviar</button>
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