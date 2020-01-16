<?php
require_once("assets/php/bbdd.php");
session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>About Us - UPOCASA</title>
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
    <main class="page">
        <section class="clean-block about-us">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Sobre Nosotros</h2>
                    <p>UPOCASA es una empresa que se dedica a vender y alquilar viviendas. ¡Tu vivienda ideal te está
                        esperando!<br></p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card clean-card text-center"><img class="card-img-top w-100 d-block" src="assets/img/sobreNosotros/sobreNosotros1.jpg">
                            <div class="card-body info">
                                <h4 class="card-title">Los mejores interiores</h4>
                                <p class="card-text">¡Encuentra la vivienda que se ajuste a tu personalidad!.Con la
                                    mejor decoración que puedas imaginar.</p>
                                <div class="icons"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card clean-card text-center"><img class="card-img-top w-100 d-block" src="assets/img/sobreNosotros/sobreNosotros2.jpg">
                            <div class="card-body info">
                                <h4 class="card-title">Los mejores exteriores</h4>
                                <p class="card-text">¿Te gustaría una vivendia con un exterior espectacular? Hermosos
                                    jardines y amplias piscinas te están esperando.</p>
                                <div class="icons"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card clean-card text-center"><img class="card-img-top w-100 d-block" src="assets/img/sobreNosotros/sobreNosotros3.jpg">
                            <div class="card-body info">
                                <h4 class="card-title">Filtrar por extras</h4>
                                <p class="card-text">Busca las viviendas que más se ajusten a tus necesidades: zonas
                                    recreativas, parking o piscinas para adultos y niños.</p>
                            </div>
                        </div>
                    </div>
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