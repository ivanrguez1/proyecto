# Proyecto UPOCASA

# CHANGELOG

# Tabla de contenidos
1. [2020-01-28](#2020-01-28)
1. [2020-01-27](#2020-01-27)
2. [2020-01-17](#2020-01-17)
3. [2020-01-16](#2020-01-16)
4. [2020-01-03](#2020-01-03)
5. [2020-01-02](#2020-01-02)

## 2020-01-28

### Nuevos 

* [*] Creado archivo header-admin-logged.php-> Cabecera para el administrador
* [*] Creado archivo admin/admin.php        -> Página con enlaces para administrar entidades
* [+] Creado archivo /admin/tiposanuncio.php-> CRUD completo de administración de tipos de anuncio

### Cambios

* [*] Modificado archivo /admin/extras.php  -> Cambio en el location (solo accesible el admin). Dodumentado el código
* [*] Modificado archivo upocasa.sql        -> Se ha añadido a usuarios un nuevo registro para admin
* [*] Modificado archivo README.md          -> Se ha añadido a usuarios un nuevo registro para admin  
* [*] Modificado archivo user-config        -> Implementada la lógica de PHP (UPDATE) 
* [*] Modificado archivo footer.php         -> Incluye el enlace a Administración 
                                            -> Actualizadas referencias de footer.html a footer.php

## 2020-01-27

### Nuevos 

* [+] Creado archivo /admin/extras.php      -> CRUD completo de administración de la tabla Extras

### Cambios

* [*] Modificado archivo /assets/bbdd.php   -> Cambio nombres: ejecutarInsercion |-> ejecutarAccion
                                                                ejecutaConsulta |-> ejecutarConsulta
                                            Cambiado el uso de los métodos en distintos archivos

## 2020-01-17

### Nuevos 

* [+] Creado archivo git.md                 -> Procedimiento para el uso de GitHub

### Cambios

* [*] 


## 2020-01-16

### Nuevos 

* [+] Creado archivo ad-show.php           -> Presenta un anuncio concreto (tras elegirlo en la búsqueda)

### Cambios

* [*] Modificado archivo index.php         -> Cambiada cabecera (logada); IGUAL en faq.php / about-es / contact-us.php
* [*] Modificado archivo registration.php  -> Se quita del header-logged-php (no tiene sentido que se registre una vez logado)
* [*] Modificado archivo ad-search.php     -> Se le ha añadido Jquery-DataTable
* [*] Modificado archivo footer.php       -> Se han cambiado los enlaces (zona inferior izquierda) y pequeño bug

## 2020-01-03

### Nuevos 

* [+] Creado archivo ad-search.php         -> Realiza búsquedas de anuncios (OR)

### Cambios

* [*] Modificado archivo /assets/bbdd.php  -> devolverId ($correo), mete en SESSION[idUsuario] la id del usuario logado
                                           -> ejecutarAccion ($sql), devuelve la id de la ultima inserción
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
