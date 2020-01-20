//Definimos las variables que vamos a necesitar
//############################################################################################

var nombresImagenes = document.getElementById("fotosAnuncio").value.split(",");
var datosImagenes = [];

for (let index = 0; index < nombresImagenes.length; index++) {
  const element = nombresImagenes[index];
  if (element != "") {
    datosImagenes[index] = [element];
  }
}

var i = 0;
var listaImagenes = [];

//Creamos la lista de miniaturas por defecto;
for (var k = 0; k < datosImagenes.length; k++) {
  listaImagenes.push(k);
}
//Declaramos la variable que va a servir para medir el intervalo de tiempo en el que se actualizan las imágenes.
var myTimer;

//############################################################################################
//Bloque formado por la primera vista que nos encontramos al cargar la página.
//############################################################################################

crearMiniaturas();
actualizarMiniaturas();

//Primera imagen que sale por defecto
$("#imagenGrande").attr("src", datosImagenes[i][0]);

//############################################################################################
//En este bloque nos encontramos la actualización automática del carrusel o mediante un click en alguna de las minuaturas.
//############################################################################################

//Aquí modificamos el tiempo en el que se actualizan las imágenes (actualmente 10 seg.).
myTimer = setInterval(actualizarImagenGrandeYMiniaturas, 10000);

function actualizarPorClick(imagen) {
  //Reseteamos el intervalo de tiempo en el que se muestran las imágenes.
  clearInterval(myTimer);
  myTimer = setInterval(actualizarImagenGrandeYMiniaturas, 10000);
  //Actualizamos el carrusel de imágenes.
  actualizarImagenGrandeYMiniaturas(imagen);
  actualizarMiniaturas(imagen);
}

function crearMiniaturas() {
  for (var j = 0; j < datosImagenes.length; j++) {
    if (i !== j) {
      var miniatura = $("<img>");
      miniatura.attr({
        src: datosImagenes[j][0],
        id: "img" + j,
        alt: "Imagen de videojuego",
        onclick: "actualizarPorClick(this)"
      });
      $("#divMiniaturas").append(miniatura);
    }
  }
}

//############################################################################################
//EPD10-P4: Camnbio de imagen animado
//############################################################################################

function actualizarImagenGrandeYMiniaturas(imagenSeleccionada) {
  $("#imagenGrande").fadeOut("slow", function() {
    hallarNuevoIndice(imagenSeleccionada);
    $("#imagenGrande").attr("src", datosImagenes[i][0]);
    actualizarMiniaturas();
    $("#imagenGrande").fadeIn("slow", function() {});
  });
}

//############################################################################################

function hallarNuevoIndice(imagenSeleccionada) {
  if (imagenSeleccionada == null) {
    if (i < datosImagenes.length - 1) {
      i++;
    } else {
      //Reseteamos el ciclo
      i = 0;
    }
  } else {
    i = listaImagenes[imagenSeleccionada.id.replace("img", "") - 1];
  }
}

function actualizarMiniaturas(imagenSeleccionada) {
  listaImagenes = [];

  //Creamos una lista con todos los indices de las imágenes
  for (var j = 0; j < datosImagenes.length; j++) {
    listaImagenes.push(j);
  }

  //Buscamos la imágen diferente, es decir la imagen que este en grande en ese momento y la eliminamos de la lista.

  var index = listaImagenes.indexOf(i);

  if (index > -1) {
    listaImagenes.splice(index, 1);
  }

  //A continuación cambiamos el atributo src de cada imagen que este en miniatura en base a listaImagenes.

  $("#divMiniaturas img").each(function(index) {
    $(this).attr("src", datosImagenes[listaImagenes[index]][0]);
  });
}
