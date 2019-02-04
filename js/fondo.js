$(function(){
	var imagenes = ["imagenes/escena/1.jpg", "imagenes/escena/2.jpg", "imagenes/escena/3.jpg", "imagenes/escena/4.jpg", "imagenes/escena/5.jpg", "imagenes/escena/6.jpg", "imagenes/escena/7.jpg", "imagenes/escena/8.jpg", "imagenes/escena/9.jpg"];
	$(imagenes).each(function(){
		$("<img/>")[0].src = this; 
	});
	var index = 0;
	$.backstretch(imagenes[index], {duration: 3000, fade: 500, speed: 2000, centeredX: false, centeredY: false});
	setInterval(function() {
		index = (index >= imagenes.length - 1) ? 0 : index + 1;
		$.backstretch(imagenes[index]);
		if (index == 0){
			document.getElementById("obra").innerHTML = "Pieza: Three Poems";
			document.getElementById("autor").innerHTML = "Autor: Kirill Radev";
			document.getElementById("interprete").innerHTML = "Intérprete: Ballet de Moscú";
		} else if (index == 1){
			document.getElementById("obra").innerHTML = "Pieza: Manuelote";
			document.getElementById("autor").innerHTML = "Autor: César Rengifo";
			document.getElementById("interprete").innerHTML = "Intérprete: Sera-Raflus";
		} else if (index == 2){
			document.getElementById("obra").innerHTML = "Pieza: Manuelote";
			document.getElementById("autor").innerHTML = "Autor: César Rengifo";
			document.getElementById("interprete").innerHTML = "Intérprete: Nirvana Teatro";
		} else if (index == 3){
			document.getElementById("obra").innerHTML = "Pieza: La Luz";
			document.getElementById("autor").innerHTML = "Autor: Jésica Montes de Oca";
			document.getElementById("interprete").innerHTML = "Intérprete: Ballet de México";
		} else if (index == 5){
			document.getElementById("obra").innerHTML = "Pieza: Ni santos, ni diablos";
			document.getElementById("autor").innerHTML = "Autor: Ender León";
			document.getElementById("interprete").innerHTML = "Intérprete: Grupo Teatral Valle Verde";
		} else if (index == 6){
			document.getElementById("obra").innerHTML = "Pieza: Tu país está felíz";
			document.getElementById("autor").innerHTML = "Autor: Carlos Giménez";
			document.getElementById("interprete").innerHTML = "Intérprete: Rajatabla";
		} else if (index == 7){
			document.getElementById("obra").innerHTML = "Pieza: Don Perlimplin y Belisa en su Jardín";
			document.getElementById("autor").innerHTML = "Autor: Federico García Lorca";
			document.getElementById("interprete").innerHTML = "Intérprete: La Barraca Teatro";
		} else if (index == 8){
			document.getElementById("obra").innerHTML = "Pieza: Los varones como hijos del silencio";
			document.getElementById("autor").innerHTML = "Autor: Franca Rame";
			document.getElementById("interprete").innerHTML = "Intérprete: Seza Producciones";
		}
		
	}, 10000);
	if (index == 0){
        document.getElementById("obra").innerHTML = "Pieza: Three Poems";
		document.getElementById("autor").innerHTML = "Autor: Kirill Radev";
		document.getElementById("interprete").innerHTML = "Intérprete: Ballet de Moscú";
	}
});