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
</head>

<body>
    <?php include "./header.html" ?>
    <main class="page registration-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Registro</h2>
                </div>
                <form>
                    <div class="form-group"><label for="name">Nombre</label><input type="text" class="form-control item" id="name" /></div>
                    <div class="form-group"><label for="password">Contraseña</label><input type="password" class="form-control item" id="password" /></div>
                    <div class="form-group"><label for="password">Confirmar Contraseña</label><input type="password" class="form-control item" id="passwordConfirm" /></div>
                    <div class="form-group"><label for="email">Email</label><input type="email" class="form-control item" id="email" /></div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="condiciones" />
                            <label class="form-check-label" for="condiciones">Acepto las <a href="legal-warning.php">condiciones de uso</a>
                                y la <a href="basicdata-protection.php">información básica de Protección de Datos </a> </label>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Registrarse</button>
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