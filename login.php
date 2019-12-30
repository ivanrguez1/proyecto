<?php
require_once("assets/php/bbdd.php");
session_start();
$mensaje = "";

if(isset($_POST['email'])) {
    // Saneo los inputs recibidos
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

    // Creo la consulta para acceder a la BBDD y la ejecuto
    $sql = "SELECT * FROM usuarios WHERE correo = '" . $email . "'";
    $mensaje = $sql;
    $resultado = ejecutaConsulta ($sql);
    $numRegistros = mysqli_num_rows($resultado);

    if ($numRegistros == 1) {
        $registro = mysqli_fetch_assoc($resultado);
        
        // Hasta que se pruebe el registro con la encriptación, valen las claves sin encriptar
        if (password_verify($password, $registro['clave']) || $password==$registro['clave']) {

            /* 
            // TODO: Gestión de sesiones
            // Iniciamos la sesión y escribimos la cookie para guardar los datos
            session_start();
            $_SESSION['nombre'] = $registro['nombre'];

            // Ponemos una cookie que durará 1 mes
            if (!isset($_COOKIE["usuario"])) {
                setcookie("nombre", $registro['nombre'], (time() + (60 * 60 * 24 * 30)));
            }
            header("Location:registerAd.php.php");
            */
            $mensaje = "Acceso Correcto!<br><br>";
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
</head>

<body>
    <?php include "./header.html" ?>
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Inicio de Sesión</h2>
                </div>

                <?php
                    echo $mensaje;
                ?>

                <form method="post" action="login.php" >
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control item" id="email" name="email"/></div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password"/></div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="recuerdame" />
                            <label class="form-check-label" for="recuerdamelo">Recuérdame</label>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Iniciar Sesión</button>
                    <br><br>
                    ¿No tienes cuenta? <a href='registration.php'>Registrarse</a>
                </form>

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