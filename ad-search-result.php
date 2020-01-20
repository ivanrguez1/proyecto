<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<link href="assets/css/style-ad-search.css" rel="stylesheet">
<script src="assets/bootstrap/js/bootstrap.min.js"></script>

<section class="search-box">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 listing-block">

                <?php

                $imagenEncontrada = false;
                $nombreFoto;

                while ($registro = mysqli_fetch_array($resultado)) {

                    $i = 1;

                    do {
                        $sql = "SELECT nombreFoto" . $i . " FROM fotos
                        WHERE idAnuncio = '" . $registro['idAnuncio'] . "'";
                        $resultadoFoto = ejecutaConsulta($sql);
                        $fotos = mysqli_fetch_array($resultadoFoto);

                        if (!empty($fotos['nombreFoto' . $i])) {
                            $imagenEncontrada = true;
                            $nombreFoto = $fotos['nombreFoto' . $i];
                        }

                        $i++;
                    } while ($i < 6 && !$imagenEncontrada);

                    echo "<div class='media'<br>";
                    if ($imagenEncontrada) {
                        echo "<img class='d-flex align-self-start' src='" . $_SERVER['DOCUMENT_ROOT'] . '/upocasa/assets/img/ads/' . $_SESSION['nick'] . '/' . $nombreFoto . "' alt='Generic placeholder image'>";
                    } else {
                        echo "<img class='d-flex align-self-start' src='" . $_SERVER['DOCUMENT_ROOT'] . '/upocasa/assets/img/ads/sinImagen.jpg' . " alt='Generic placeholder image'>";
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
                    echo "</div>";
                }

                ?>
            </div>
            <div class="col-md-7 map-box mx-0 px-0">
                <iframe width="100%" height="495" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=700&amp;height=440&amp;hl=en&amp;q=Sevilla%2C%20Spain+(Mapa)&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed"></iframe>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<script>
    $(function() {
        $('.listing-block').slimScroll({
            height: '500px'
        });
    });
</script>