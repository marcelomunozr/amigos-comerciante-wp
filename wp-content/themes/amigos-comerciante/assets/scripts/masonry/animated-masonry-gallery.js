jQuery(window).load(function () {

var size = 1;
var button = 1;
var button_class = "gallery-header-center-right-links-current";
var normal_size_class = "gallery-content-center-normal";
var full_size_class = "gallery-content-center-full";
var $container = jQuery('#gallery-content-center');
    
$container.isotope({itemSelector : 'article'});

/*
function check_button(){
	$('.gallery-header-center-right-links').removeClass(button_class);
	if(button==1){
		$("#filter-all").addClass(button_class);
		$("#gallery-header-center-left-title").html('All Galleries');
	}
	if(button==2){
		$("#filter-studio").addClass(button_class);
		$("#gallery-header-center-left-title").html('Studio Gallery');
	}
	if(button==3){
		$("#filter-landscape").addClass(button_class);
		$("#gallery-header-center-left-title").html('Landscape Gallery');
	}	
}
*/	
function check_size(){
jQuery("#gallery-content-center").removeClass(normal_size_class).removeClass(full_size_class);
	if(size==0){
		jQuery("#gallery-content-center").addClass(normal_size_class); 
		jQuery("#gallery-header-center-left-icon").html('<span class="iconb" data-icon="&#xe23a;"></span>');
		}
	if(size==1){
		jQuery("#gallery-content-center").addClass(full_size_class); 
		jQuery("#gallery-header-center-left-icon").html('<span class="iconb" data-icon="&#xe23b;"></span>');
		}
	$container.isotope({itemSelector : 'article'});
}


	
jQuery(".btn-filtros").click(function() { 
	$container.isotope({ filter: '.'+ jQuery(this).data('filter') });
	jQuery('.btn-filtros').removeClass('active');
	jQuery(this).addClass('active');
});

jQuery(".select-filtros").change(function(){
	var filtros = "";
	jQuery(".select-filtros").each(function(index, value){
		var filtro = jQuery(this).val();
		if(filtro != '' && filtro != '*'){
			filtros += "." + filtro;
		}else if(filtro == '*'){
			filtros += filtro;
		}
	})
	if(jQuery(this).val() != ''){
		$container.isotope({ filter: filtros.trim() });
	}else{
		$container.isotope({ filter: '*' });
	}
});
/*
$("#filter-all").click(function() { $container.isotope({ filter: '.all' });  });//button = 1; check_button();
$("#filter-matrimonio").click(function() {  $container.isotope({ filter: '.matrimonio' });  });//button = 2; check_button(); 
$("#filter-retratos").click(function() {  $container.isotope({ filter: '.retratos' });  });//button = 3; check_button(); 
$("#filter-paisajes").click(function() {  $container.isotope({ filter: '.paisajes' });  });//button = 4; check_button(); 
$("#filter-productos").click(function() {  $container.isotope({ filter: '.productos' });  });//button = 5; check_button(); 
*/
jQuery("#gallery-header-center-left-icon").click(function() { if(size==0){size=1;}else if(size==1){size=0;} check_size(); });


//check_button();
check_size();
});