<?php
/**
 * Template Name: Template Contacto
 */
?>
<?php
	$contenido = get_field('contenido');
  	$bg = wp_get_attachment_url( get_post_thumbnail_id( $query->ID ) );
?>
<div class="container-interior" style="background: url('<?php echo $bg; ?>') no-repeat right top;">
	<div class="row">
		<div class="col-md-6">
			<div class="text-enter">
				<h1><?php the_title(); ?></h1>
				<div class="context">
  					<?php echo $contenido; ?>
				</div>
			</div>
			<div class="catalogo formulario">
				<div class="el-tab">
					<?php echo do_shortcode('[contact-form-7 id="200" title="Contacto"]'); ?>
				</div>
			</div>

		</div>
		<div class="col-md-6">
		</div>
	</div>
</div>
</div>
