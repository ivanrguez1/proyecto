<?php
require_once("assets/php/bbdd.php");
session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: login.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Mis Mensajes - UPOCASA</title>
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
                    <h2 class="text-info text-center mt-5">Mis Mensajes</h2>
                    <br><br>
                </div>
                <div>

                    <?php

                    $sql = "SELECT * FROM mensajes WHERE idUsuDestino=" .$_SESSION['idUsuario'] . " ORDER BY fechaEnvio DESC";
                    $resultado = ejecutarConsulta($sql);
                    while ($registro = mysqli_fetch_array($resultado)) {
                          ?>
                    <div class="col-sm-6 col-md-6">
                        <div class="alert-message alert-messageRecibido">
                            <h4>Mensaje de
                                <?php $nick = mysqli_fetch_array(ejecutarConsulta("SELECT nick FROM usuarios WHERE idUsuario=". $registro['idUsuOrigen'])); echo $nick['nick'] . " (".$registro['fechaEnvio'].")" ?>
                            </h4>
                            <p><?php echo $registro['mensaje'] ?></p>
                        </div>
                    </div>
                    <?php                  
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>

    <?php include "./footer.html" ?>
</body>

</html>