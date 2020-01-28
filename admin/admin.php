<?php
require_once("../assets/php/bbdd.php");
session_start();

// Si no está logado como administrador, se expulsa...

if ($_SESSION['nick'] != 'admin') {
    header('Location: ../index.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>FAQ - UPOCASA</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/best-carousel-slide-1.css">
    <link rel="stylesheet" href="../assets/css/best-carousel-slide.css">
    <link rel="stylesheet" href="../assets/css/Blog---Recent-Posts-1.css">
    <link rel="stylesheet" href="../assets/css/Blog---Recent-Posts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="../assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="../assets/css/smoothproducts.css">
    <script src="../assets/js/jquery.min.js"></script>
</head>

<body>
    <?php
        include "../header-logged.php";
    ?>
    <main class="page faq-page">
        <section class="clean-block clean-faq dark">
            <div class="container" style="width: 50%;">
                <div class="block-heading">
                    <h2 class="text-info">ADMINISTRACIÓN DEL SITIO</h2>
                    <p>Enlaces a los CRUD de gestión de Entidades</p>
                </div>
                <div class="block-content">
                    <div class="faq-item">
                        <h4 class="question">Extras</h4>
                        <div class="answer">
                            <p><a href="extras.php">Gestión de Extras</a></p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <h4 class="question">Tipos de Vivienda</h4>
                        <div class="answer">
                            <p><a href="tiposvivienda.php">Gestión de Tipos de Vivienda</a></p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <h4 class="question">Tipos de Anuncio</h4>
                        <div class="answer">
                            <p><a href="tiposanuncio.php">Gestión de Tipos de Anuncio</a></p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <h4 class="question">Usuarios</h4>
                        <div class="answer">
                            <p><a href="usuarios.php">Gestión de Usuarios</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include "../footer.php" ?>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>