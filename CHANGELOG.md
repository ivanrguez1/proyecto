# Proyecto UPOCASA

# CHANGELOG

# Tabla de contenidos
1. [2020-01-16](#2020-01-16)
2. [2020-01-03](#2020-01-03)
3. [2020-01-02](#2020-01-02)

## 2020-01-16

### Nuevos 

* [+] Creado archivo ad-show.php           -> Presenta un anuncio concreto (tras elegirlo en la búsqueda)

### Cambios

* [*] Modificado archivo index.php         -> Cambiada cabecera (logada); IGUAL en faq.php / about-es / contact-us.php
* [*] Modificado archivo registration.php  -> Se quita del header-logged-php (no tiene sentido que se registre una vez logado)
* [*] Modificado archivo ad-search.php     -> Se le ha añadido Jquery-DataTable
* [*] Modificado archivo footer.html       -> Se han cambiado los enlaces (zona inferior izquierda) y pequeño bug

## 2020-01-03

### Nuevos 

* [+] Creado archivo ad-search.php         -> Realiza búsquedas de anuncios (OR)

### Cambios

* [*] Modificado archivo /assets/bbdd.php  -> devolverId ($correo), mete en SESSION[idUsuario] la id del usuario logado
                                           -> ejecutaInsercion ($sql), devuelve la id de la ultima inserción
* [*] Modificado upocasa.sql               -> (fix) anuncios.codPostal (TINYINT -> SMALLINT UNSIGNED)
                                           -> (fix) REFERENCES `upocasa`.`tiposVivienda` (`idtipoVivienda`)
* [*] Modificado archivo registerAd.php    -> Desarrollada toda la lógica PHP, excepto subida de fotos (falta modularizar)
* [*] Modificado archivo upocasa.sql       -> Añadidos registros en tablas Anuncios y asociados

## 2020-01-02

### Nuevos 

* [+] Creado archivo CHANGELOG.md (Registro de cambios)
* [+] Creado archivo user-config.php para modificar datos del usuario y Cerrar Sesión (OJO!)
* [+] Creado archivo header-logged.php con cabecera alternativa al estar logado
* [+] Creado archivo NOTAS_GIT con documentación sobre GIT

### Cambios

* [*] Modificado archivo registerAd.php (los script ahora van en la cabecera)
* [*] Modificado archivo /assets/style.css -> Párrafo de Mensajes centrado
