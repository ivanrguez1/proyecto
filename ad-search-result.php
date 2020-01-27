<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<link href="assets/css/style-ad-search.css" rel="stylesheet">
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/googleMapsStyle.css">

<link rel="stylesheet" type="text/css" href="assets/css/jquery.range.css">
<script src="assets/js/jquery.range.js"></script>

<link rel="stylesheet" type="text/css" href="assets/css/chosen.css">
<script src="assets/js/chosen.jquery.js"></script>

<section class=" search-box">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 listing-block">

                <?php

                $imagenEncontrada = false;
                $urlFoto;

                if ($numRegistros == 0) {
                    echo "¡Vaya!, no se han encontrado anuncios.";
                }

                while ($registro = mysqli_fetch_array($resultado)) {

                    $i = 1;

                    do {
                        $sql = "SELECT urlFoto" . $i . " FROM fotos
                        WHERE idAnuncio = '" . $registro['idAnuncio'] . "'";
                        $resultadoFoto = ejecutaConsulta($sql);
                        $fotos = mysqli_fetch_array($resultadoFoto);

                        if (!empty($fotos['urlFoto' . $i])) {
                            $imagenEncontrada = true;
                            $urlFoto = $fotos['urlFoto' . $i];
                        }


                        $i++;
                    } while ($i < 6 && !$imagenEncontrada);

                    echo "<a href='ad-show.php?id=" . $registro['idAnuncio'] . "' target='_blank'><div class='media'<br>";
                    if ($imagenEncontrada) {
                        echo "<img class='d-flex align-self-start' src='" . $urlFoto . "' alt='Generic placeholder image'>";
                        $imagenEncontrada = false;
                    } else {
                        echo "<img class='d-flex align-self-start' src='assets/img/ads/sinImagen.jpg' alt='Generic placeholder image'>";
                    }

                    $tituloAnuncio = '';

                    switch ($registro['idTipoVivienda']) {
                        case 1:
                            $tituloAnuncio = "vivienda";
                            break;

                        case 2:
                            $tituloAnuncio = "garaje";
                            break;

                        case 3:
                            $tituloAnuncio = "terreno";
                            break;

                        case 4:
                            $tituloAnuncio = "local comercial";
                            break;

                        case 5:
                            $tituloAnuncio = "oficina";
                            break;

                        case 6:
                            $tituloAnuncio = "trastero";
                            break;
                        
                    }

                    
                    switch ($registro['idTipoAnuncio']) {
                        case 1:
                            $tituloAnuncio = "Venta de ".$tituloAnuncio;
                            break;
                        case 2:
                            $tituloAnuncio = "Alquiler de ".$tituloAnuncio;
                            break;
                        case 3:
                            $tituloAnuncio = ucwords($tituloAnuncio);
                            $tituloAnuncio = $tituloAnuncio." para compartir ";
                            break;
                        case 4:
                            $tituloAnuncio = ucwords($tituloAnuncio);
                            $tituloAnuncio = $tituloAnuncio." para vacaciones ";
                            break;
                    }

                    echo "<div class='media-body pl-3'>";
                    echo "<div class='price'>" . $registro['precio'] . "€<small>" .  $tituloAnuncio . "</small></div>";
                    echo "<div class='stats'>";
                    echo "<span><i class='fa fa-arrows-alt'></i>" . $registro['superficie'] . "m²</span>";
                    echo "<span><i class='fa fa-bath'></i>" . $registro['numAseos'] . "</span>";
                    echo "<span><i class='fa fa-bed'></i>" . $registro['numHabitaciones'] . "</span>";
                    echo "</div>";
                    echo "<div class='address'>" . $registro['direccion'] . "</div>";
                    echo "</div>";
                    echo "</div></a>";
                }

                ?>
            </div>

            <div id="map" class="col-md-7 map-box mx-0 px-0">
                <script
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAj5O6tEn8iirebfPdhi314wuqGyLjoeCA&libraries=places&callback=initAutocomplete"
                    async defer></script>
            </div>
            <input id="pac-input" class="controls" type="text" placeholder="¡Busca la ubicación de tu inmueble!">

        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<script src="assets/js/mapJs.js"></script>
<script>
$(function() {
    $('.listing-block').slimScroll({
        height: '500px',
    });
});
</script>