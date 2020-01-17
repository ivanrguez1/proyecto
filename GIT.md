---
attachments: [Clipboard_2020-01-17-12-33-48.png, Clipboard_2020-01-17-12-36-08.png]
title: GIT
created: '2020-01-17T08:37:03.034Z'
modified: '2020-01-17T12:05:15.767Z'
---

# GIT
--------------

[//]: # (version: 1.0)
[//]: # (author: Iván Rodríguez)
[//]: # (date: 2020-01-17)

# Tabla de contenidos
1. [Introducción](#1-introducción)
2. [Instalación y configuración](#2-instalación-y-configuración)
3. [Crear repositorio](#3-crear-repositorio)  
4. [Primer commit](#4-primer-commit)
5. [Commit directo y log](#5-commit-directo-y-log)
6. [Marcha atrás](#6-marcha-atrás)
7. [Manejo de Ramas](#7-manejo-de-ramas)
8. [Repositorios Remotos](#8-repositorios-remotos)
9. [Fusionar (Merge)](#9-fusionar-merge)
10. [Instalar GitKraken](#10-instalar-gitkraken)


## 1. Introducción

[Tabla de contenidos](#tabla-de-contenidos)

- En este documento se van a explicar los comandos mas importantes de GIT con un ejemplo práctico
- Conceptos:
  - Working copy &rightarrow; Carpeta de trabajo
  - Staging area &rightarrow; Zona de caché
  - Repository   &rightarrow; Almacén de cambios

## 2. Instalación y configuración

[Tabla de contenidos](#tabla-de-contenidos)

- Por consola:
```console
sudo apt update
sudo apt install git                                      # La instalación
git --version                                             # Comprobamos la versión
git config --global user.name "userName"                  # Ponemos nuestro nombre de usuario de GitHub
git config --global user.email "youremail@yourdomain.com" # Ponemos el correo de acceso al GitHub
git config --list                                         # Confirmamos la configuración
```

## 3. Crear repositorio

[Tabla de contenidos](#tabla-de-contenidos)

- En este ejemplo creamos un directorio y dentro iniciamos GIT
- Luego nos creamos un archivo y escribimos un texto.

```console
mkdir ~/Pruebas-GIT/ 
cd ~/Pruebas-GIT/ 
git init                                        # Crear repositorio
nano archivo1.txt                               # Creamos un archivo. Dentro ponemos "Hola Mundo"  
```

## 4. Primer commit

[Tabla de contenidos](#tabla-de-contenidos)

```console
git status                                      # Estado repositorio
git add .                                       # Añade Cambios y nuevos archivos, NO los eliminados
    # -> Alternativas:
    #   git add <archivo>                       # Archivo individual
    #   git add <carpeta>                       # Añade una carpeta completa
    #   git add *.md                            # Añade archivos Markdown (https://es.wikipedia.org/wiki/Markdown)
    #   git add -A                              # Añadimos al Staging Area TODOS los cambios (update)
    #   git add -u                              # Añade cambios y eliminados, pero NO los nuevos
git commit -m "Primer commit"                   # Hacer commit (Una foto), incluyendo un mensaje
```

## 5. Commit directo y log

[Tabla de contenidos](#tabla-de-contenidos)

```console
nano archivo1.txt                               # Editamos el archivo y ponemos: "Hola Git"
commit -a -m "Segundo commit"                   # Con -a evitamos poner git add (commit directo)
git log                                         # Historial de Git en el repositorio local (Salen los commit)
    # Alternativas (mas visuales):
    # git log --graph --decorate --pretty=oneline
    # git reflog    
```

## 6. Marcha atrás

[Tabla de contenidos](#tabla-de-contenidos)

```console
git reset HEAD~1                                # Deshace ultimo commit (pero archivo1.txt mantiene el cambio)
    # -> Opciones:
    # git reset --hard | --soft HEAD~1          # Con hard, no solo deshace el commit, si no también el cambio del archivo
        
    # git reset <archivo> | <carpeta | *.md     # Deshace el añadido de un archivo, carpeta o tipo de archivos
    # git checkout <archivo>                    # Deshace el archivo añadido
    # git checkout <hash>                       # Deshace desde el hash indicado   
```

## 7. Manejo de Ramas

[Tabla de contenidos](#tabla-de-contenidos)

- El trabajo con ramas dentro de GIT es esencial. 
- Por un lado tendremos la rama MASTER o principal.
- A partir de esta, podemos tener tantas ramas como queramos
- Por último, podemos fusionar ramas (Merge), que veremos después.

```console
git branch                                      # Ver ramas del repositorio
                                                # NOTA: La rama actual viene con un asterisco
git branch nuevaRama                            # Crea una rama nueva rama
git checkout nuevaRama                          # Pasa de la rama ACTUAL a nuevaRama
git checkout master                             # Vuelve a la rama Master
git branch -D nuevaRama                         # Elimina la rama  (CUIDADO!!)
```

## 8. Repositorios Remotos

[Tabla de contenidos](#tabla-de-contenidos)

- Recurso: https://git-scm.com/book/es/v2/Fundamentos-de-Git-Trabajar-con-Remotos
- NOTA: Normalmente, el procedimiento para los repositorios es BAJARSE uno remoto y trabajar en local.
El procedimiento de CREAR EN LOCAL y CONECTARLO EN REMOTO NO ESTA RECOMENDADO!!

- Nos vamos a Github (creamos una cuenta si no la tenemos)
- En la esquina superior derecha pulsamos en [+] > New repository
![](@attachment/Clipboard_2020-01-17-12-33-48.png)

- Configuramos el nuevo repositorio:
  - Ponemos un nombre al repositorio, por ejemplo prueba_git
  - La URl quedará de este modo: https://github.com/ivanrguez1/prueba_git
    - NOTA: ivanrguez1 será nuestro usuario en GitHub
  - Definimos si será público o privado (en este caso, sólo podremos tener 3 colaboradores)
  - Marcamos a opción paraa iniciar el repositorio con un README
    - [x] Initialize this repository width a README 
  - Pulsamos en [Create repository]
![](@attachment/Clipboard_2020-01-17-12-36-08.png)

```console
mkdir ~/'Repositorios GIT'
cd ~/'Repositorios GIT'
git remote add pruebaGIT 'https://github.com/ivanrguez1/prueba_git'     # Añade el repositorio remoto
git remote -v                                                           # Ve los repositorios remotos (puede haber varios)
git pull pruebaGIT master                                               # Actualizamos el repositorio local
nano archivo1.txt                                                       # Creamos el archivo en local y escribimos "Hola Mundo" (sin comillas)
git add .                                                               # Añadimos archivos
git commit -m "Primer commit a Remoto"                                  # Commit
git push pruebaGIT master                                               # Subimos el commit a Repositorio Remoto (pruebaGIT) <rama>      
git branch -i nuevaRama                                                 # Creamos una rama, preparándola para subirla a remoto
git push pruebaGIT nuevaRama                                            # Añadimos la rama en el repositorio remoto
git push pruebaGIT --delete nuevaRama                                   # Borra la rama en remoto (CUIDADO!!)                 
```

## 9. Fusionar (Merge)

[Tabla de contenidos](#tabla-de-contenidos)

```console
git branch -i otraRama                                                  # Creamos la rama
git checkout otraRama                                                   # Pasamos a la nueva Rama
nano archivo2.txt                                                       # Creamos un archivo
git add .
git commit -m "Primer commit a Remoto en otra Rama"  
git checkout master                                                     # Volvemos a master
git merge otraRama                                                      # Fusionamos otraRama con la rama actual (master)   
                                                                        # Si hay conflictos, será aquí donde lo haga
git reset --merge                                                       # Deshacer el merge 
git log                                                                 # Para ver el histórico de GIT en local                                                                   
```

## 10. Instalar GitKraken

[Tabla de contenidos](#tabla-de-contenidos)

- Tenemos a nuestra disposición una aplicación que presenta de manera visual todas las ramas de nuestro repositorio GIT: GitKraken
- Además, permite ver diferencias, hacer commits, etc. Todo con una interfaz gráfica muy intuitiva (y en español)

```console
cd ~/Descargas
wget https://release.gitkraken.com/linux/gitkraken-amd64.deb
dpkg -i gitkraken-amd64.deb               
```

