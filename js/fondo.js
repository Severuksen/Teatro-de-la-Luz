$(() => {
	let imagenes = [
		"imagenes/escena/1.jpg", 
		"imagenes/escena/2.jpg", 
		"imagenes/escena/3.jpg", 
		"imagenes/escena/4.jpg", 
		"imagenes/escena/5.jpg", 
		"imagenes/escena/6.jpg", 
		"imagenes/escena/7.jpg", 
		"imagenes/escena/8.jpg", 
		"imagenes/escena/9.jpg"
	];
	
	let index   = 0;

	const obras = [{
		pieza: 'Pieza: Three Poems',
		autor: 'Autor: Kirill Radev',
		interprete: 'Intérprete: Ballet de Moscú'
	}, {
		pieza: 'Pieza: Manuelote',
		autor: 'Autor: César Rengifo',
		interprete: 'Intérprete: Sera-Raflus'
	}, {
		pieza: 'Pieza: Manuelote',
		autor: 'Autor: César Rengifo',
		interprete: 'Intérprete: Nirvana Teatro'
	}, {
		pieza: 'Pieza: La Luz',
		autor: 'Autor: Jésica Montes de Oca',
		interprete: 'Intérprete: Ballet de México'
	}, {
		pieza: 'Pieza: Ni santos, ni diablos',
		autor: 'Autor: Ender León',
		interprete: 'Intérprete: Grupo Teatral Valle Verde'
	}, {
		pieza: 'Pieza: Tu país está felíz',
		autor: 'Autor: Carlos Giménez',
		interprete: 'Intérprete: Rajatabla'
	}, {
		pieza: 'Pieza: Don Perlimplin y Belisa en su Jardín',
		autor: 'Autor: Federico García Lorca',
		interprete: 'Intérprete: La Barraca Teatro'
	}, {
		pieza: 'Pieza: Los varones como hijos del silencio',
		autor: 'Autor: Franca Rame',
		interprete: 'Intérprete: Seza Producciones'
	}];

	$.backstretch(imagenes[index], {duration: 3000, fade: 500, speed: 2000, centeredX: false, centeredY: false});

	setInterval(() => {
		index = (index >= imagenes.length - 1) ? 0 : index++;
		$.backstretch(imagenes[index]);
		$("#obra").html(obras[index].pieza);
		$("#autor").html(obras[index].autor);
		$("#interprete").html(obras[index].interprete);
	}, 10000);

	if (index == 0){
        $("#obra").html(obras[index].pieza);
		$("#autor").html(obras[index].autor);
		$("#interprete").html(obras[index].interprete);
	}
});