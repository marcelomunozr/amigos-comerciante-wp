<?php
/**
 * Template Name: Template Vida Social
 */
?>
<?php 
	the_post();
	$contenido = get_field('contenido');
?>
<section class="secciones">
	<div class="text-center">
		<h1><?php the_title(); ?></h1>
		<div class="col-md-6 offset-md-3">
			<div class="context">
				<?php echo $contenido; ?>
			</div>
		</div>
	</div>
	<div class="clear30"></div>
	<div id="masonry-grid">
		<?php echo do_shortcode('[ajax_load_more container_type="div" css_classes="row" post_type="post" posts_per_page="4" category="vida-social" images_loaded="true" button_label="más entradas"]'); ?>
	</div>

</section>
