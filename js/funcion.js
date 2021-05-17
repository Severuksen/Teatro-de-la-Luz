(function($){
	$.fn.invisible = function(){
		return this.each(function(){
	    	$(this).attr("style", "visibility: hidden");
		});
	};
	$.fn.visible = function(){
		return this.each(function(){
	    	$(this).attr("style", "visibility: visible");
		});
    };
}(jQuery));

$(() => {
	"use strict";
	$('.mover').rotatable().draggable();
	$('.cuadros').draggable();
}); 

//ELIMINAR DIVS
function Eliminar(id) {
	"use strict";
	$.post("modulos/modulos.php", {senal: "eliminar", id: id});
	$(`#${id}`).remove();
	document.oncontextmenu = () => {return false;};
}

const Guardar = (id) => {
	"use strict";
	const rotacion = document.getElementById(id).style.transform;
	let ang = rotacion[7];
	let j = 8;
	for (let i = 0; i < rotacion.length-12; i++){
		ang = ang + rotacion[j];
		j++;
	}
	var top  = document.getElementById(id).style.top;
	var left = document.getElementById(id).style.left;
	$.post("modulos/modulos.php", {senal: "guardar", ang: ang, id: id, top: top, left: left}); 
}

//<![CDATA[
function Agregar(luces) {
	"use strict";
	$.post("modulos/modulos.php", {senal: "insertar", aceptar: luces}, (respuesta) => {
		let id     = "";
		let estilo = "";
		let sw     = 0;

		for (let i = 0; i < respuesta.length; i++){
			if (respuesta[i] == "+"){sw = 1; i++;}
			if (sw == 0){id += respuesta[i];}
			if (sw == 1){estilo += respuesta[i];}
		}
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
	});
}
//]]>

//MOSTRAR CUADRO LOGIN Y REGISTRO
const Mostrar = (mostrar, ocultar) =>{
	"use strict";
	if (mostrar == ""){
		$(`#${ocultar}`).invisible();
	} else if(ocultar == "") {
		$(`#${mostrar}`).visible();
	} else {
		$(`#${mostrar}`).visible();
		$(`#${ocultar}`).invisible();
	}
}

function Recomendacion(rec){
	"use strict";
	Mostrar("","noenviado");
	Mostrar("enviando","enviado");
	$.post("contacto.php", {mensaje: rec }, (respuesta) => {
		if(respuesta == "1"){
			Mostrar("noenviado","enviando");
		} else if(respuesta == "0"){
			Mostrar("enviado","enviando");
		}		
	});
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
	var objetoX   = document.getElementById(id).style.width;
	var cuerpoX   = "";
	for(let i = 0; i < (objetoX.length-2); i++){cuerpoX = cuerpoX + objetoX[i];}	
	var ancho = (pantallaX-cuerpoX)/2;
    /*#########################################################################*/
	var pantallaY = screen.height;
	var objetoY   = document.getElementById(id).style.height;
	var cuerpoY   = "";
	for(let j = 0; j < (objetoY.length-2); j++){cuerpoY = cuerpoY + objetoY[j];}
	var alto = ((pantallaY/2)-(cuerpoY/4));
	/*#########################################################################*/
	$(`#${id}`).attr("style","left: "+ancho+"px; top: "+alto+"px;");
}
function Visualizar(id){
	"use strict";
	switch(id){
		case "panelm":
			$(`#${id}`).visible();
			$(`#${id}`).attr("id","panelo");
			$('#proyectonm').attr("onclick","Visualizar('panelo');");
			break;
		case "panelo":
			$(`#${id}`).invisible();
			document.getElementById(id).setAttribute("id","panelm");
			document.getElementById("proyectonm").setAttribute("onclick","Visualizar('panelm');");
			break;
	}
}
function ModificarProyecto(valor){
	"use strict";
	if (valor == ""){
		$(`#cambiado`).invisible();
		$(`#espacios`).visible();
	} else {
		$.ajax({type: "POST", url: "modulos/login.php?op=Modificar", data: {proyectoc: valor}, success: function(a) {
			$(`#espacios`).invisible();
			$(`#cambiado`).visible();
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
			setTimeout(() => {
				Mostrar("","cambiado");
				Mostrar("","espacios");
			}, 3000);
		}});
	}
}