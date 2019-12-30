# Proyecto UPOCASA

# Tabla de contenidos
1. [Integrantes](#integrantes)
2. [Usar Markdown](#usar-markdown)
3. [Entidades](#entidades)
4. [Tecnologías y Herramientas](#tecnologias-y-herramientas)
5. [Por hacer](#por-hacer)

## Integrantes
Los integrantes de este proyecto son:
* Alejandro Palomino García
* Iván Alfonso Rodríguez Ruiz

## Usar Markdown
* a

## Entidades
* usuarios

```sql
CREATE TABLE `upocasa`.`usuarios` ( 
    `nombre` VARCHAR(60) NOT NULL , 
    `correo` VARCHAR(60) NOT NULL , 
    `clave` VARCHAR(120) NOT NULL , 
    `alta` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`correo`), 
    UNIQUE `usuarios_nombre` (`nombre`)
    ) ENGINE = InnoDB;
```



## Tecnologías y Herramientas
* HTML 5 & CSS3
* JavaScript (ECMAScript 6)
* Jquery 3
* BootStrap 4
* MySQL 5.7 & Workbench 6.3
* PHP 7
* PhpMyAdmin 4.9
* PhpStorm 2019.3 
## Por hacer
* (User_Login) Acepto las condiciones de uso y la información básica de Protección de Datos

