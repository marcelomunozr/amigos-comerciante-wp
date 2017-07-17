<?php
/**
 * Template Name: Template Plan de Amigos del Comerciante
 */

the_post();
?>
<section class="secciones">
	<div class="text-center">
		<h1><?php the_title(); ?></h1>
	</div>
	<div class="clear30"></div>
	<div class="text-center">
		<div class="col-md-6 offset-md-3">
			<?php echo get_field('contenido'); ?>
		</div>
	</div>
	
</section>