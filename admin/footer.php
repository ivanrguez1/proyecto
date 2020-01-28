<footer>
  <div class="row">
    <div class="col-sm-6 col-md-4 footer-navigation">
      <h3>
        <a href="#">UPO<span>CASA</span></a>
      </h3>
      <p class="links">
        <a href="../index.php">Home</a><strong> · </strong><a href="../about-us.php">About</a><strong> ·
        </strong><a href="../faq.php">Faq</a><strong> · </strong><a href="../contact-us.php">Contact</a>
      </p>
      <p class="company-name">UPOCASA © 2019</p>
      <?php 
      if ($_SESSION['nick']=='admin') {
        ?>
        <p class="links">
        <a href="admin.php">Administrar</a>
      </p>
      <?php
      }
      ?>
    </div>
    <div class="col-sm-6 col-md-4 footer-contacts">
      <div>
        <span class="fa fa-map-marker footer-contacts-icon"> </span>
        <p>
          <span class="new-line-span">Ctra. de Utrera, 1, 41013<br /></span>
          Sevilla, España
        </p>
      </div>
      <div>
        <i class="fa fa-phone footer-contacts-icon"></i>
        <p class="footer-center-info email text-left">+34 955 683 4329</p>
      </div>
      <div>
        <i class="fa fa-envelope footer-contacts-icon"></i>
        <p><a href="#" target="_blank">ayuda@upocasa.com</a></p>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-4 footer-about">
      <h4>Sobre nosotros</h4>
      <p>
        UPOCASA es una empresa que se dedica a vender y alquilar viviendas. ¡Tu
        vivienda ideal te está esperando! Siguenos en las redes sociales para no
        perderte las mejores ofertas.<br /><br /><br /><br />
      </p>

      <div class="social-links social-icons">
        <a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i
            class="fa fa-linkedin"></i></a><a href="#"><i class="fa fa-github"></i></a>
      </div>
    </div>
  </div>
</footer>