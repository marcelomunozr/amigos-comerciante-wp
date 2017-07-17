
jQuery(function($){	
	//carrusel del HOMI
  var owl = $(".carousel-homi");
	owl.owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    navText: [
      "<a class='controlaso prev'></a>",
      "<a class='controlaso next'></a>"
      ],
    smartSpeed: 600,
    responsive:{
      0:{
          items: 1
      },
      600:{
          items: 1
      },
      1000:{
          items: 1
      }
    }
	});
  $(".controlaso.next").click(function(){
    owl.trigger('owl.next');
  });
  $(".controlaso.prev").click(function(){
    owl.trigger('owl.prev');
  });

  //carrusel de premios 
  var owlPremios = $(".carousel-premios");
	owlPremios.owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    navText: [
      "<a class='controlaso-premios prev'></a>",
      "<a class='controlaso-premios next'></a>"
      ],
    smartSpeed: 600,
    responsive:{
      0:{
          items: 1
      },
      600:{
          items: 1
      },
      1000:{
          items: 1
      }
    }
	});
  $(".controlaso-premios.next").click(function(){
    owlPremios.trigger('owl.next');
  });
  $(".controlaso-premios.prev").click(function(){
    owlPremios.trigger('owl.prev');
  });
  owlPremios.on('changed.owl.carousel', function(event) {
    var elPremio = $('.owl-item.active').data('titulo');
    $('.replace-premio').text(elPremio);
  });

  // carrusel de productos footer
  var owlProd = $(".prod1");
	owlProd.owlCarousel({
    loop: true,
    margin: 15,
    nav: true,
    navText: [
      "<a class='controlaso-prod1 prev'></a>",
      "<a class='controlaso-prod1 next'></a>"
      ],
    smartSpeed: 600,
    responsive:{
      0:{
          items: 2
      },
      767:{
          items: 4
      },
      1000:{
          items: 4
      }
    }
	});
  $(".controlaso-prod1.next").click(function(){
    owlProd.trigger('owl.next');
  });
  $(".controlaso-prod1.prev").click(function(){
    owlProd.trigger('owl.prev');
  });
  var owlProd2 = $(".prod2");
	owlProd2.owlCarousel({
    loop: true,
    margin: 15,
    nav: true,
    navText: [
      "<a class='controlaso-prod2 prev'></a>",
      "<a class='controlaso-prod2 next'></a>"
      ],
    smartSpeed: 600,
    responsive:{
      0:{
          items: 2
      },
      767:{
          items: 4
      },
      1000:{
          items: 4
      }
    }
	});
  $(".controlaso-prod2.next").click(function(){
    owlProd2.trigger('owl.next');
  });
  $(".controlaso-prod2.prev").click(function(){
    owlProd2.trigger('owl.prev');
  });

  //carrusel de productos page
  var owlProductosInt = $(".carousel-productos");
  owlProductosInt.owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    navText: [
      "<a class='controlaso-productos prev'></a>",
      "<a class='controlaso-productos next'></a>"
      ],
    smartSpeed: 600,
    responsive:{
      0:{
          items: 1
      },
      600:{
          items: 2
      },
      1000:{
          items: 3
      }
    }
  });
  $(".controlaso-productos.next").click(function(){
    owlProductosInt.trigger('owl.next');
  });
  $(".controlaso-productos.prev").click(function(){
    owlProductosInt.trigger('owl.prev');
  });

  //carrusel de productoSLide
  var owlItem = $(".carousel-slide");
  owlItem.owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    navText: [
      "<a class='controlaso-slide prev'></a>",
      "<a class='controlaso-slide next'></a>"
      ],
    smartSpeed: 600,
    responsive:{
      0:{
          items: 1
      },
      600:{
          items: 1
      },
      1000:{
          items: 1
      }
    }
  });
  $(".controlaso-slide.next").click(function(){
    owlItem.trigger('owl.next');
  });
  $(".controlaso-slide.prev").click(function(){
    owlItem.trigger('owl.prev');
  });

  // active in prods footer
  $('.catalogo .el-tab .nav-tabs li a').click(function(){
  	var mix = $(this).data('mix');
  	if (mix==='almacen') {
  		$('.prod-bg').removeClass('prod-bg-feria');
  	}
  	if (mix==='feria') {
  		$('.prod-bg').removeClass('prod-bg-almacen');
  	}
  	$('.prod-bg').addClass('prod-bg-'+mix);
  });

  // nav responsive
  $('.icon-bar').on('click',function(){
    $('.nav-primary').slideToggle(300);
  });
});





  //Cargamos las regiones
  var RegionesYcomunas = {
	"regiones": [{
			"NombreRegion": "Arica y Parinacota",
			"comunas": ["Arica", "Camarones", "Putre", "General Lagos"]
	},
		{
			"NombreRegion": "Tarapacá",
			"comunas": ["Iquique", "Alto Hospicio", "Pozo Almonte", "Camiña", "Colchane", "Huara", "Pica"]
	},
		{
			"NombreRegion": "Antofagasta",
			"comunas": ["Antofagasta", "Mejillones", "Sierra Gorda", "Taltal", "Calama", "Ollagüe", "San Pedro de Atacama", "Tocopilla", "María Elena"]
	},
		{
			"NombreRegion": "Atacama",
			"comunas": ["Copiapó", "Caldera", "Tierra Amarilla", "Chañaral", "Diego de Almagro", "Vallenar", "Alto del Carmen", "Freirina", "Huasco"]
	},
		{
			"NombreRegion": "Coquimbo",
			"comunas": ["La Serena", "Coquimbo", "Andacollo", "La Higuera", "Paiguano", "Vicuña", "Illapel", "Canela", "Los Vilos", "Salamanca", "Ovalle", "Combarbalá", "Monte Patria", "Punitaqui", "Río Hurtado"]
	},
		{
			"NombreRegion": "Valparaíso",
			"comunas": ["Valparaíso", "Casablanca", "Concón", "Juan Fernández", "Puchuncaví", "Quintero", "Viña del Mar", "Isla de Pascua", "Los Andes", "Calle Larga", "Rinconada", "San Esteban", "La Ligua", "Cabildo", "Papudo", "Petorca", "Zapallar", "Quillota", "Calera", "Hijuelas", "La Cruz", "Nogales", "San Antonio", "Algarrobo", "Cartagena", "El Quisco", "El Tabo", "Santo Domingo", "San Felipe", "Catemu", "Llaillay", "Panquehue", "Putaendo", "Santa María", "Quilpué", "Limache", "Olmué", "Villa Alemana"]
	},
		{
			"NombreRegion": "Región de O’Higgins",
			"comunas": ["Rancagua", "Codegua", "Coinco", "Coltauco", "Doñihue", "Graneros", "Las Cabras", "Machalí", "Malloa", "Mostazal", "Olivar", "Peumo", "Pichidegua", "Quinta de Tilcoco", "Rengo", "Requínoa", "San Vicente", "Pichilemu", "La Estrella", "Litueche", "Marchihue", "Navidad", "Paredones", "San Fernando", "Chépica", "Chimbarongo", "Lolol", "Nancagua", "Palmilla", "Peralillo", "Placilla", "Pumanque", "Santa Cruz"]
	},
		{
			"NombreRegion": "Región del Maule",
			"comunas": ["Talca", "ConsVtución", "Curepto", "Empedrado", "Maule", "Pelarco", "Pencahue", "Río Claro", "San Clemente", "San Rafael", "Cauquenes", "Chanco", "Pelluhue", "Curicó", "Hualañé", "Licantén", "Molina", "Rauco", "Romeral", "Sagrada Familia", "Teno", "Vichuquén", "Linares", "Colbún", "Longaví", "Parral", "ReVro", "San Javier", "Villa Alegre", "Yerbas Buenas"]
	},
		{
			"NombreRegion": "Región del Biobío",
			"comunas": ["Concepción", "Coronel", "Chiguayante", "Florida", "Hualqui", "Lota", "Penco", "San Pedro de la Paz", "Santa Juana", "Talcahuano", "Tomé", "Hualpén", "Lebu", "Arauco", "Cañete", "Contulmo", "Curanilahue", "Los Álamos", "Tirúa", "Los Ángeles", "Antuco", "Cabrero", "Laja", "Mulchén", "Nacimiento", "Negrete", "Quilaco", "Quilleco", "San Rosendo", "Santa Bárbara", "Tucapel", "Yumbel", "Alto Biobío", "Chillán", "Bulnes", "Cobquecura", "Coelemu", "Coihueco", "Chillán Viejo", "El Carmen", "Ninhue", "Ñiquén", "Pemuco", "Pinto", "Portezuelo", "Quillón", "Quirihue", "Ránquil", "San Carlos", "San Fabián", "San Ignacio", "San Nicolás", "Treguaco", "Yungay"]
	},
		{
			"NombreRegion": "Región de la Araucanía",
			"comunas": ["Temuco", "Carahue", "Cunco", "Curarrehue", "Freire", "Galvarino", "Gorbea", "Lautaro", "Loncoche", "Melipeuco", "Nueva Imperial", "Padre las Casas", "Perquenco", "Pitrufquén", "Pucón", "Saavedra", "Teodoro Schmidt", "Toltén", "Vilcún", "Villarrica", "Cholchol", "Angol", "Collipulli", "Curacautín", "Ercilla", "Lonquimay", "Los Sauces", "Lumaco", "Purén", "Renaico", "Traiguén", "Victoria", ]
	},
		{
			"NombreRegion": "Región de Los Ríos",
			"comunas": ["Valdivia", "Corral", "Lanco", "Los Lagos", "Máfil", "Mariquina", "Paillaco", "Panguipulli", "La Unión", "Futrono", "Lago Ranco", "Río Bueno"]
	},
		{
			"NombreRegion": "Región de Los Lagos",
			"comunas": ["Puerto Montt", "Calbuco", "Cochamó", "Fresia", "FruVllar", "Los Muermos", "Llanquihue", "Maullín", "Puerto Varas", "Castro", "Ancud", "Chonchi", "Curaco de Vélez", "Dalcahue", "Puqueldón", "Queilén", "Quellón", "Quemchi", "Quinchao", "Osorno", "Puerto Octay", "Purranque", "Puyehue", "Río Negro", "San Juan de la Costa", "San Pablo", "Chaitén", "Futaleufú", "Hualaihué", "Palena"]
	},
		{
			"NombreRegion": "Región Aisén",
			"comunas": ["Coihaique", "Lago Verde", "Aisén", "Cisnes", "Guaitecas", "Cochrane", "O’Higgins", "Tortel", "Chile Chico", "Río Ibáñez"]
	},
		{
			"NombreRegion": "Región de Magallanes",
			"comunas": ["Punta Arenas", "Laguna Blanca", "Río Verde", "San Gregorio", "Cabo de Hornos (Ex Navarino)", "AntárVca", "Porvenir", "Primavera", "Timaukel", "Natales", "Torres del Paine"]
	},
		{
			"NombreRegion": "Región Metropolitana",
			"comunas": ["Cerrillos", "Cerro Navia", "Conchalí", "El Bosque", "Estación Central", "Huechuraba", "Independencia", "La Cisterna", "La Florida", "La Granja", "La Pintana", "La Reina", "Las Condes", "Lo Barnechea", "Lo Espejo", "Lo Prado", "Macul", "Maipú", "Ñuñoa", "Pedro Aguirre Cerda", "Peñalolén", "Providencia", "Pudahuel", "Quilicura", "Quinta Normal", "Recoleta", "Renca", "San Joaquín", "San Miguel", "San Ramón", "Vitacura", "Puente Alto", "Pirque", "San José de Maipo", "Colina", "Lampa", "TilVl", "San Bernardo", "Buin", "Calera de Tango", "Paine", "Melipilla", "Alhué", "Curacaví", "María Pinto", "San Pedro", "Talagante", "El Monte", "Isla de Maipo", "Padre Hurtado", "Peñaflor"]
	}]
};

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

jQuery(document).ready(function () {

	var iRegion = 0;
	var htmlRegion = '<option value="sin-region" class="form-control">--Seleccione región--</option>';
	var htmlComunas = '<option value="sin-region" class="form-control">--Seleccione comuna--</option>';

	jQuery.each(RegionesYcomunas.regiones, function () {
		htmlRegion = htmlRegion + '<option value="' + RegionesYcomunas.regiones[iRegion].NombreRegion + '">' + RegionesYcomunas.regiones[iRegion].NombreRegion + '</option>';
		iRegion++;
	});

	jQuery('#regiones').html(htmlRegion);
	jQuery('#comunas').html(htmlComunas);

	jQuery('#regiones').change(function () {
		var iRegiones = 0;
		var valorRegion = jQuery(this).val();
		var htmlComuna = '<option value="sin-comuna">--Seleccione comuna--</option>';
		jQuery.each(RegionesYcomunas.regiones, function () {
			if (RegionesYcomunas.regiones[iRegiones].NombreRegion === valorRegion) {
				var iComunas = 0;
				jQuery.each(RegionesYcomunas.regiones[iRegiones].comunas, function () {
					htmlComuna = htmlComuna + '<option value="' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '">' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '</option>';
					iComunas++;
				});
			}
			iRegiones++;
		});
		jQuery('#comunas').html(htmlComuna);
	});
	jQuery('#comunas').change(function () {
		if (jQuery(this).val() === 'sin-region') {
			alert('--seleccione Región--');
		} else if (jQuery(this).val() === 'sin-comuna') {
			alert('--selecciones Comuna--');
		}
	});
	jQuery('#regiones').change(function () {
		if (jQuery(this).val() === 'sin-region') {
			alert('--selecciones Región--');
		}
	});
	
	jQuery("input.rut-field").rut({
		formatOn: 'change',
	    validateOn: 'change' // si no se quiere validar, pasar null
	});
	
	jQuery('body').on('submit', '.form-registro', function(e){
		var form = jQuery(this);
		var dperrors = [];
		var cterrors = 0;
		form.find("input").each(function(){
			var elvalor	= jQuery(this).val();
			var tipo	= jQuery(this).data("tipo");
			var mensaje	= jQuery(this).data("msje");
			switch(tipo) {
			    case "email":
					if(valor === "" || !validateEmail(valor)){
			    		cterrors += 1;
						dperrors.push(mensaje);
			    	}
			        break;
			    case "rut":
			    	if(valor === "" || !jQuery.validateRut(valor)){
			    		cterrors += 1;
						dperrors.push(mensaje);
			    	}
			        break;
			    default:
					if(valor === ""){
						cterrors += 1;
						dperrors.push(mensaje);
					}
			}
		});
		if(cterrors !== 0){
			var mensaje = "";
			jQuery.each(dperrors, function(ix, val){
				mensaje += val + "<br>"; 
			});
			jQuery("#AlertForm .mensaje").text(mensaje);
			jQuery("#AlertForm").show(function(){
				setTimeout(function(){
					jQuery("#AlertForm").hide();
				}, 7000);
			});
		}else{
			form.submit();
		}
		e.preventDefault();
	});

  //MAMASONRY
  var masonryInit = true; // set Masonry init flag
  jQuery(document).ajaxComplete(function() { // Ajax Load More callback function
    if(jQuery('#masonry-grid').length){
      var $container = jQuery('#masonry-grid .alm-listing'); // our container
      if(masonryInit){
        // initialize Masonry only once
        masonryInit = false;
        $container.masonry({
          itemSelector: '.col-md-3'
        });         
      }else{
          $container.masonry('reloadItems'); // Reload masonry items after callback
      }
      $container.imagesLoaded( function() { // When images are loaded, fire masonry again.
        $container.masonry();
      });
    }
  });
  
});