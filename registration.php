<?php
require_once("assets/php/bbdd.php");
session_start();

$mensaje = "---";

if (isset($_SESSION['nombre'])) {
    header('Location: index.php');
}

$errors = array();

if (isset($_POST['registrarUsuario'])) {

    // Saneo los inputs recibidos
    $nombre = filter_var(trim($_POST['nombre']), FILTER_SANITIZE_STRING);
    $nick = filter_var(trim($_POST['nick']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);

    // Para la clave, primero saneamos y luego encriptamos
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    $password = password_hash($password, PASSWORD_DEFAULT);

    //Comprobamos si hay errores

    if (empty($nombre)) {
        array_push($errors, "¡El nombre es obligatorio!");
    }

    if (empty($nick)) {
        array_push($errors, "¡El nick es obligatorio!");
    }
    if (empty($email)) {
        array_push($errors, "¡El email es obligatorio!");
    }
    if (empty($password)) {
        array_push($errors, "¡La contraseña es obligatoria!");
    }
    if ($_POST['password'] != $_POST['passwordConfirm']) {
        array_push($errors, "¡Las contraseña no son iguales!");
    }

    if (sizeof($nick) < 4) {
        array_push($errors, "¡El nick debe de tener al menos 4 carácteres!");
    }

    if (sizeof($password) < 6) {
        array_push($errors, "¡La contraseña debe de tener al menos 6 carácteres!");
    }

    if (sizeof($nombre) < 4) {
        array_push($errors, "¡El nombre debe de tener al menos 3 carácteres!");
    }

    $sql = "SELECT * FROM usuarios WHERE correo = '$email' OR nick = '$nick'";
    $resultado = ejecutarConsulta($sql);
    $numRegistros = mysqli_num_rows($resultado);

    $mensaje = $numRegistros;

    if ($numRegistros > 0) {
        array_push($errors, "¡Nick o correo electrónico ya registrado!");
    } else {
        if (count($errors) == 0) {
            $sql = "INSERT INTO usuarios (nombre, nick, correo, clave) VALUES ('" . $nombre . "', '" . $nick . "', '" . $email . "', '" . $password . "')";

            $resultado = ejecutarConsulta($sql);
            if ($resultado) {
                header("Location:login.php");
            } else {
                array_push($errors, "¡No se ha podido registrar! Por favor, pongase en contacto con el administrador.");
            }
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

                <form method="post" action="registration.php" onsubmit="return verCondiciones()">
                    <?php include('errors.php'); ?>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control item" id="name" name="nombre" /></div>
                    <div class="form-group">
                        <label for="name">Nick</label>
                        <input type="text" class="form-control item" id="nick" name="nick" /></div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control item" id="email" name="email" /></div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control item" id="password" name="password" /></div>
                    <div class="form-group">
                        <label for="password">Confirmar Contraseña</label>
                        <input type="password" class="form-control item" id="passwordConfirm" name="passwordConfirm" /></div>
                    <div class="form-group" id="cuadroCondiciones">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="condiciones" />
                            <label class="form-check-label" for="condiciones">Acepto las <a href="legal-warning.php">condiciones de uso</a>
                                y la <a href="basicdata-protection.php">información básica de Protección de Datos
                                </a> </label>
                        </div>
                    </div>
                    <input class="btn btn-primary btn-block" type="submit" value="Registrarse" name="registrarUsuario"></input>
                    <br><br>
                    <p style="text-align: right">
                        ¿Eres ya un miembro? <a href="login.php">Iniciar Sesión</a>
                    </p>

                </form>

            </div>
        </section>
    </main>
    <?php include "./footer.php" ?>
</body>

</html>