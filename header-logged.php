<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
    <div class="container">
        <a class="navbar-brand logo" href="#">UPOCASA</a>
        <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
            <span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" href="index.php">Inicio</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="faq.php">FAQ</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="about-us.php">Sobre nosotros</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="contact-us.php">Contactanos</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="registerAd.php">Alta Anuncio</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="registration.php">Registro</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="user-config.php"><?php
                    echo "Bienvenida/o ".$_SESSION['nombre'];
                    ?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>