<?php
require_once("assets/php/bbdd.php");
session_start();
?>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
    <script src="assets/js/jquery.min.js"></script>
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
        <section class="clean-block clean-faq dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">FAQ</h2>
                    <p>Preguntas frecuentes de los usuarios.</p>
                </div>
                <div class="block-content">
                    <div class="faq-item">
                        <h4 class="question">¿Cuesta dinero publicar una vivienda?</h4>
                        <div class="answer">
                            <p>No, ¡nuestro servicio es totalmente gratuito!</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <h4 class="question">¿Cuántas fotos puedo subir como máximo de mi vivienda?</h4>
                        <div class="answer">
                            <p>Como máximo se puede subir un total de 5 fotografías con un peso máximo de 2mb cada una.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <h4 class="question">¿Puedo modificar una publicación a posteriori?</h4>
                        <div class="answer">
                            <p>¡Claro sin problemas!, puedes modificar y eliminar tus anuncios cuando quieras.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include "./footer.php" ?>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>