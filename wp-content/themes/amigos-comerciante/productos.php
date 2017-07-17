<?php
/**
 * Template Name: Template Productos
 */
?>
<div class="col-md-12 catalogo productos">
	<div class="text-center">
		<h1>catálogo de productos</h1>
        <?php $contenido = get_field('contenido'); ?>
		<?php echo $contenido; ?>
		<ul class="controles-prod">
			<li>
				<select class="form-control form-control-lg select-filtros">
                  <option value="all">Todos</option>
                  <option value="almacen">Mix Almacén</option>
				  <option value="feriante">mix Feriante</option>
				</select>
			</li>
			<li>
				<select class="form-control form-control-lg select-filtros">
					<option value="all">Todas las Marcas</option>
					<option value="confort">Confort</option>
					<option value="noble">Noble</option>
					<option value="nova">Nova</option>
					<option value="elite">Elite</option>
					<option value="cotidian">Cotidian</option>
					<option value="babysec">Babysec</option>
				</select>
			</li>
		</ul>
	</div>
    <div id="gallery">
        <!-- <div id="gallery-header invisible">
            <div id="gallery-header-center">
                <div id="gallery-header-center-right">
                    <div class="gallery-header-center-right-links btn-filtros active" data-filter="all">Todos</div>
                    <div class="gallery-header-center-right-links btn-filtros" data-filter="matrimonio">Matrimonios</div>
                    <div class="gallery-header-center-right-links btn-filtros" data-filter="retratos">Retratos</div>
                    <div class="gallery-header-center-right-links btn-filtros" data-filter="paisajes">Paisajes</div>
                    <div class="gallery-header-center-right-links btn-filtros" data-filter="productos">Productos</div>
                </div>
            </div>
        </div> -->
        <div class="los-prods" id="gallery-content-center">
            <?php
            $i=0;
            $query = new WP_Query( array( 'post_type' => 'productos',  'posts_per_page' => -1));//,'categoria'=>'almacen'
            if ($query->have_posts() ) {?>
            <?php
                while ( $query->have_posts() ) { 
                    $query->the_post();
                            $term = $query->get_queried_object();
                            $categoria = get_the_category($query->ID);
                            $slug = $term->$categoria->slug;
                            $categories = get_the_terms( $post->ID, 'categoria' );
                            $bajad = get_field('contenido');
                    ?>

                    <article class="all <?php foreach( $categories as $category ) {echo $category->slug . " ";} ?>"><!-- col-lg-3 col-md-4 col-sm-6 col-xs-12  -->
                        <div class="boxin">
                            <h3><?php the_title(); ?><br><?php echo strip_tags($bajad); ?></h3>
                            <?php
                                if(has_post_thumbnail()):
                                $thumb_id = get_post_thumbnail_id($post->ID);
                                $thumb = wp_get_attachment_image_src($thumb_id, 'productos-mini');
                            ?>
                                <img src="<?php echo $thumb[0]?>" class="img-responsive img-center" />
                            <?php else: ?>
                                <img src="http://placehold.it/350x135" alt="<?php the_title(); ?>" class="img-responsive img-center">
                            <?php endif; ?>
                            <?php 
                                $codigo = get_field('codigo');
                                $rollos = get_field('rollos_por_paquete');
                                $bulto = get_field('paquetes_de_bulto');
                                $rollosBulto = get_field('rollos_por_bulto');
                                $pallet = get_field('bultos_por_pallet');
                                $comentarios = get_field('comentarios');
                            ?>
                            <ul class="datos">
                                <?php if ($codigo != ""): ?>
                                    <li>
                                        Código
                                        <span><?php echo $codigo; ?></span>
                                    </li>
                                <?php endif ?>
                                <?php if ($rollos != ""): ?>
                                    <li>
                                        Unidades por paquete
                                        <span><?php echo $rollos; ?></span>
                                    </li>
                                <?php endif ?>
                                <?php if ($bulto != ""): ?>
                                    <li>
                                        Paquetes por bulto
                                        <span><?php echo $bulto; ?></span>
                                    </li>
                                <?php endif ?>
                                <?php if ($rollosBulto != ""): ?>
                                    <li>
                                        Rollos por bulto
                                        <span><?php echo $rollosBulto; ?></span>
                                    </li>
                                <?php endif ?>
                                <?php if ($pallet != ""): ?>
                                    <li>
                                        Bultos por pallet
                                        <span><?php echo $pallet; ?></span>
                                    </li>
                                <?php endif ?>
                                <?php if ($comentarios != ""): ?>
                                    <li>
                                        Comentarios
                                        <?php echo $comentarios; ?>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </article>
                  <?php $i++; ?>
                <?php
                }
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
	

</div>
