<?php
require_once("assets/php/bbdd.php");
session_start();

$mensaje = "---";

if(isset($_SESSION['nombre'])){
    header('Location: index.php');
}

if(isset($_POST['email'])) {
    // Saneo los inputs recibidos
    $nombre = filter_var(trim($_POST['nombre']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);

    // Para la clave, primero saneamos y luego encriptamos
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM usuarios WHERE correo = '$email'";
    $resultado = ejecutaConsulta ($sql);
    $numRegistros = mysqli_num_rows($resultado);

    $mensaje = $numRegistros;

    if ($numRegistros > 0) {
        $mensaje = "Usuario ya registrado<br><br>";
        die();
    } else {
        $sql = "INSERT INTO usuarios (nombre, correo, clave) VALUES ('" . $nombre . "', '" . $email . "', '" . $password . "')";

        $resultado = ejecutaConsulta ($sql);
        if ($resultado) {
            header("Location:login.php");
        } else {
            $mensaje = "No se ha podido registrar";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register - UPOCASA</title>
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

    <!-- Se añade Jquery 3.4.1 & Bootstrap -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
    <script src="assets/js/theme.js"></script>

    <script>
    // Si no se marca la aceptación de condiciones, se pone un recuadro rojo y no se envía el formulario
    function verCondiciones() {
        if (!$('#condiciones').prop('checked')) {
            $("#cuadroCondiciones").css({
                "border": "3px solid red",
                "padding": "4px"
            })
            return false;
        }
    }
    </script>
</head>

<body>
    <?php include "./header.html" ?>

    <main class="page registration-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Registro</h2>
                </div>
                <!-- Mensajes del servidor referentes al registro -->
                <p id="mensajes"><?php
                    echo $mensaje; ?>

                    <form method="post" action="registration.php" onsubmit="return verCondiciones()">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control item" id="name" name="nombre" /></div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control item" id="email" name="email" /></div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control item" id="password" name="password" /></div>
                        <div class="form-group">
                            <label for="password">Confirmar Contraseña</label>
                            <input type="password" class="form-control item" id="passwordConfirm" /></div>
                        <div class="form-group" id="cuadroCondiciones">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="condiciones" />
                                <label class="form-check-label" for="condiciones">Acepto las <a
                                        href="legal-warning.php">condiciones de uso</a>
                                    y la <a href="basicdata-protection.php">información básica de Protección de Datos
                                    </a> </label>
                            </div>
                        </div>
                        <input class="btn btn-primary btn-block" type="submit" value="Registrarse"></input>
                    </form>
            </div>
        </section>
    </main>
    <?php include "./footer.html" ?>
</body>

</html>