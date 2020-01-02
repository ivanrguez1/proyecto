<?php
require_once("assets/php/bbdd.php");
session_start();
$mensaje = "";

if(isset($_POST['envio'])) {
    $mensaje = "Enviado!<br><br>";
    // TODO Toda la lógica PHP de Modificación de datos del usuario
}

// Cierro la sesión y redirecciono 
if(isset($_POST['logout'])) {
    session_destroy();
    header("Location:login.php");
}


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - UPOCASA</title>
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
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Modificar Usuario</h2>
                </div>

                 <!-- Mensajes del servidor referentes al registro -->
                 <p id="mensajes"><?php
                    echo $mensaje; ?>

                <form method="post" action="user-config.php" >
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control item" id="name" name="nombre" /></div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password"/></div>
                    <div class="form-group">
                        <label for="password2">Repita Contraseña</label>
                        <input type="password2" class="form-control" id="password2" name="password2"/></div>
                    <input class="btn btn-primary btn-block" type="submit" value="Modificar Usuario" name="envio"></input><br/>
                    <input class="btn btn-primary btn-block" type="submit" value="Cerrar Sesión" name="logout"></input>
                </form>

            </div>
        </section>
    </main>
    <?php include "./footer.html" ?>
</body>

</html>