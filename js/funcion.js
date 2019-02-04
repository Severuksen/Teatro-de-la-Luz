$(document).ready(function() {
	"use strict";
	$('.mover').rotatable().draggable();
	$('.cuadros').draggable();
});

//ELIMINAR DIVS
function Eliminar(id) {
	"use strict";
	$.ajax({type: "POST", url: "modulos/modulos.php",data: {senal: "eliminar", id: id}});
	document.getElementById(id).remove();
	document.oncontextmenu = function(){return false;};
}

function Guardar(id){
	"use strict";
	var rotacion  = document.getElementById(id).style.transform;
	var ang = rotacion[7];
	var j = 8;
	for (var i=0;i<rotacion.length-12;i++){
		ang = ang + rotacion[j];
		j++;
	}
	var top  = document.getElementById(id).style.top;
	var left = document.getElementById(id).style.left;
	$.ajax({type: "POST", url: "modulos/modulos.php", data: {senal: "guardar", ang: ang, id: id, top: top, left: left}}); 
}

//<![CDATA[
function Agregar(luces) {
	"use strict";
	$.ajax({type: "POST", url: "modulos/modulos.php", data: {senal: "insertar", aceptar: luces}, success: function(a) {
		var id = "";
		var estilo = "";
		var sw = 0;
		for (var i=0;i<a.length;i++){
			if (a[i] == "+"){sw = 1; i++;}
			if (sw == 0){id = id + a[i];}
			if (sw == 1){estilo = estilo + a[i];}}
		var nuevo = document.createElement('div');
		nuevo.setAttribute('id', id);
		nuevo.setAttribute('oncontextmenu', 'Eliminar('+id+')');
		nuevo.setAttribute('onmouseup', 'Guardar('+id+')');
		nuevo.setAttribute('class', 'mover '+estilo);
		nuevo.setAttribute('style', 'transform: rotate(0rad); transform-origin: 50% 50% 0px; top: -1px; left: -96px;');
		document.getElementsByName('escenario')[0].appendChild(nuevo);
		
		document.getElementsByTagName('script')[4].remove();
		nuevo = document.createElement('script');
		nuevo.setAttribute('type', 'application/javascript');
		nuevo.setAttribute('src', 'js/funcion.js');
		document.getElementsByTagName('head')[0].appendChild(nuevo);
	}});
}
//]]>

//MOSTRAR CUADRO LOGIN Y REGISTRO
function Mostrar(mostrar, ocultar){
	"use strict";
	if (mostrar == ""){
		document.getElementById(ocultar).setAttribute("style","visibility: hidden;");} 
	else if(ocultar == "") {
		document.getElementById(mostrar).setAttribute("style","visibility: visible;");} 
	else {
		document.getElementById(mostrar).setAttribute("style","visibility: visible;");
		document.getElementById(ocultar).setAttribute("style","visibility: hidden;");}
}

function Recomendacion(rec){
	"use strict";
	Mostrar("","noenviado");
	Mostrar("enviando","enviado");
	$.ajax({type: "POST", url: "contacto.php", data: { mensaje: rec }, success: function(a) {
		if(a == "1"){
			Mostrar("noenviado","enviando");
		} else if(a == "0"){
			Mostrar("enviado","enviando");
		}		
	}});
}

function Resetear(id) {
	"use strict";
	Mostrar("","enviando");
	Mostrar("","enviado");
	Mostrar("","noenviado");
	document.getElementById(id).reset();
}

function Pantalla(id){
	"use strict";
	var pantallaX = screen.width;
	var objetoX = document.getElementById(id).style.width;
	var cuerpoX = "";
	for(var i=0; i<(objetoX.length-2); i++){cuerpoX = cuerpoX + objetoX[i];}	
	var ancho = (pantallaX-cuerpoX)/2;
    /*#########################################################################*/
	var pantallaY = screen.height;
	var objetoY = document.getElementById(id).style.height;
	var cuerpoY = "";
	for(var j=0; j<(objetoY.length-2); j++){cuerpoY = cuerpoY + objetoY[j];}
	var alto = ((pantallaY/2)-(cuerpoY/4));
	/*#########################################################################*/
	document.getElementById(id).setAttribute("style","left: "+ancho+"px; top: "+alto+"px;");
}
function Visualizar(id){
	"use strict";
	switch(id){
		case "panelm":
			document.getElementById(id).setAttribute("style","visibility: visible;");
			document.getElementById(id).setAttribute("id","panelo");
			document.getElementById("proyectonm").setAttribute("onclick","Visualizar('panelo');");
			break;
		case "panelo":
			document.getElementById(id).setAttribute("style","visibility: hidden;");
			document.getElementById(id).setAttribute("id","panelm");
			document.getElementById("proyectonm").setAttribute("onclick","Visualizar('panelm');");
			break;
	}
}
function ModificarProyecto(valor){
	"use strict";
	if (valor == ""){
		document.getElementById("cambiado").setAttribute("style","visibility: hidden;");
		document.getElementById("espacios").setAttribute("style","visibility: visible;");
	} else {
		$.ajax({type: "POST", url: "modulos/login.php?op=Modificar", data: {proyectoc: valor}, success: function(a) {
			document.getElementById("espacios").setAttribute("style","visibility: hidden;");
			document.getElementById("cambiado").setAttribute("style","visibility: visible;");
			document.getElementById("proyectonm").remove();
			var nuevo = document.createElement('div');
			nuevo.setAttribute("onclick", "Visualizar('panelo');");
			nuevo.setAttribute("id", "proyectonm");
			nuevo.setAttribute("class","Fuente ProyectoNM");
			document.getElementsByTagName("body")[0].appendChild(nuevo);
			var nodo = document.createTextNode("Proyecto: "+a);
			document.getElementById("proyectonm").appendChild(nodo);
			
			document.getElementsByTagName('script')[4].remove();
			nuevo = document.createElement('script');
			nuevo.setAttribute('type', 'application/javascript');
			nuevo.setAttribute('src', 'js/funcion.js');
			document.getElementsByTagName('head')[0].appendChild(nuevo);
			setTimeout(function(){Mostrar("","cambiado"); Mostrar("","espacios");}, 3000);
		}});
	}
}