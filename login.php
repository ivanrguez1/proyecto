<?php
require_once("assets/php/bbdd.php");
session_start();
$mensaje = "";


/*
//Función utilizada para debugear.
function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}*/

if (isset($_SESSION['nombre'])) {
    header('Location: index.php');
}

if (isset($_POST['iniciarSesion'])) {


    // Saneo los inputs recibidos
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

    // Creo la consulta para acceder a la BBDD y la ejecuto
    $sql = "SELECT * FROM usuarios WHERE correo = '" . $email . "'";
    $mensaje = $sql;
    $resultado = ejecutaConsulta($sql);
    $numRegistros = mysqli_num_rows($resultado);

    if ($numRegistros == 1) {
        $registro = mysqli_fetch_assoc($resultado);

        // Hasta que se pruebe el registro con la encriptación, valen las claves sin encriptar
        if (password_verify($password, $registro['clave'])) {

            // Iniciamos la sesión y escribimos la cookie para guardar los datos
            $_SESSION['nombre'] = $registro['nombre'];
            $_SESSION['nick'] = $registro['nick'];
            $_SESSION['correo'] = $registro['correo'];

            // Guardamos en una variable de sesión la ID del usuario logado
            $_SESSION['idUsuario'] = devolverId($registro['correo']);


            // TODO: Gestión de cookies
            // Si el checked "recuerdame" esta marcado, ponemos una cookie que durará 1 mes

            if (isset($_POST['recuerdame']) && !isset($_COOKIE["usuario"])) {

                //Si el checkbox para recordar la sesión está marcado y no hay ya una cookie establecida -> establecemos Cookies.

                setcookie("email", $email, (time() + 60 * 60 * 24 * 30));
                setcookie("password", $password, (time() + 60 * 60 * 24 * 30));
            } else if (!isset($_POST['recuerdame'])) {

                //Si el checkbox para recordar la sesión está desmarcado -> limpiamos Cookies.

                setcookie("email", "", 1);
                unset($_COOKIE['email']);
                setcookie("password", "", 1);
                unset($_COOKIE['password']);
            }


            $mensaje = "Acceso Correcto!<br><br>";
            header('Location: index.php');
        } else {
            $mensaje = "Contraseña incorrecta<br><br>";
            //die();
        }
    } else {
        $mensaje = "El usuario no existe<br><br>";
        //die();
    }
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
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/upocasa/assets/img/ads/' . $_SESSION['nick'])) {
            echo $_SERVER['DOCUMENT_ROOT'] . '/upocasa/assets/img/ads/' . $_SESSION['nick'];
            mkdir($_SERVER['DOCUMENT_ROOT'] . '/upocasa/assets/img/ads/' . $_SESSION['nick'], 0755, true);
        }
        include "./header-logged.php";
    } else {
        include "./header.html";
    }

    ?>
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Inicio de Sesión</h2>
                </div>

                <!-- Mensajes del servidor referentes al registro -->
                <p id="mensajes"><?php
                                    echo $mensaje; ?>

                    <form method="post" action="login.php">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control item" id="email" name="email" value="<?php if (isset($_COOKIE["email"])) echo $_COOKIE["email"] ?>" /></div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?php if (isset($_COOKIE["password"])) echo $_COOKIE["password"] ?>" /></div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="recuerdame" checked="checked" />
                                <label class="form-check-label">Recuérdame</label>
                            </div>
                        </div>
                        <input class="btn btn-primary btn-block" type="submit" name="iniciarSesion" value="Iniciar Sesión"></input>
                        <br>
                        ¿No tienes cuenta? <a href='registration.php'>Registrarse</a>
                    </form>

            </div>
        </section>
    </main>
    <?php include "./footer.html" ?>
</body>

</html>