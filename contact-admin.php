<?php
require_once("assets/php/bbdd.php");
session_start();

if (!isset($_SESSION['idUsuario'])) {
    header('location: index.php');
}

$errors = array();

if (isset($_POST['enviarContactanos'])) {

    $mensaje = filter_var(trim($_POST['mensaje']), FILTER_SANITIZE_STRING);

    if (strlen($mensaje) < 20) {
        array_push($errors, "El mensaje debe de ser de mínimo 20 carácteres.");
    }

    if (sizeof($errors) == 0) {
        $sqlId = "SELECT idUsuario FROM usuarios WHERE nick = 'admin'";

        echo $sqlId;
        $resultado = ejecutarConsulta($sqlId);
        $registro = mysqli_fetch_array($resultado);

        echo $registro['idUsuario'];
        $sql = "INSERT INTO mensajes(idUsuOrigen, idUsuDestino, mensaje) VALUES('" . $_SESSION['idUsuario'] . "','" . $registro['idUsuario'] . "','" . $mensaje . "')";

        echo $sql;

        ejecutarAccion($sql);
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Contact Us - UPOCASA</title>
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

<?php

if (isset($_SESSION['idUsuario'])) {
?>

    <script>
        $(document).ready(function() {
            $('#email').val(<?php echo "'" . $_SESSION['correo'] . "'" ?>).attr('readonly', true);
        });
    </script>
<?php
}
?>

<body>
    <?php
    if (isset($_SESSION['correo'])) {
        include "./header-logged.php";
    } else {
        include "./header.html";
    }
    ?>

    <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Contáctanos</h2>
                    <p>¿Deseas contactar con el administrador? Puedes enviarle un mensaje</p>
                </div>
                <?php include('errors.php'); ?>
                <form action="#" method="post" name="formContacto">
                    <div class="form-group"><label>Email</label><input id="email" name="email" class="form-control" type="email"></div>
                    <div class="form-group"><label>Mensaje</label><textarea id="mensaje" name="mensaje" class="form-control"></textarea></div>
                    <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="enviarContactanos" id="enviarContactanos">Enviar</button>
                    </div>
                </form>
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