<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<link href="assets/css/style-ad-search.css" rel="stylesheet">
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/googleMapsStyle.css">

<section class=" search-box">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 listing-block">

                <?php

                $imagenEncontrada = false;
                $urlFoto;

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

                    echo "<div class='media-body pl-3'>";
                    echo "<div class='price'>" . $registro['precio'] . "€<small>" . $registro['comentarios'] . "</small></div>";
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
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAj5O6tEn8iirebfPdhi314wuqGyLjoeCA&libraries=places&callback=initAutocomplete" async defer></script>
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