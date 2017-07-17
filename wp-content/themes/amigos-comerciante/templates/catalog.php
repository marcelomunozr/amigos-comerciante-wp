
<div class="col-md-12 catalogo">
	<div class="prod-bg prod-bg-almacen">
		<div class="text-center texto-catalog">
			<h2>catálogo de productos</h2>
			<!-- <p>Selecciona la pestaña que más te acomode para <br>buscar tu producto preferido.</p> -->
			<div class="clear50"></div>
		</div>
		<div class="el-tab">
			<!-- Nav tabs
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item"><a href="#almacen" role="tab" data-toggle="tab" class="nav-link active" data-mix="almacen">Mix Almacén</a></li>
				<li class="nav-item"><a href="#feria" role="tab" data-toggle="tab" class="nav-link" data-mix="feria">Mix Feria</a></li>
			</ul> -->
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane in fade active" id="almacen">
					<div class="row">
						<div class="col-md-8">
							<div class="owl-carousel owl-theme carousel-prod prod1">
						        <?php
						        $i=0;
						        $query = new WP_Query( array( 'post_type' => 'productos', 'posts_per_page' => -1));
						        if ($query->have_posts() ) {
						            while ( $query->have_posts() ) { 
						                $query->the_post();
						                ?>
									    <div class="item">
											<?php
												if(has_post_thumbnail()):
												$thumb_id = get_post_thumbnail_id($post->ID);
												$thumb = wp_get_attachment_image_src($thumb_id, 'productos-mini');
											?>
												<img src="<?php echo $thumb[0]?>" class="img-responsive center" /><!-- <a href="<?php the_permalink(); ?>"></a> -->
											<?php else: ?>
												<img src="http://placehold.it/350x135" alt="<?php the_title(); ?>" class="img-responsive"><!-- <a href="<?php the_permalink(); ?>"></a> -->
											<?php endif; ?>
										    <div class="captione invisible">
										    	<h3><?php the_title(); ?></h3>
										    	<a href="<?php the_permalink(); ?>">Ver más ></a>
										    </div>
									    </div>
						              <?php $i++; ?>
						            <?php
						            }
						            wp_reset_postdata();
						        }
						        ?>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-4 offset-md-4">
							<a href="<?= esc_url(home_url('/')); ?>productos" class="btn-view-all">VER TODOS LOS PRODUCTOS</a>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane fade hidden" id="feria">
					<div class="row">
						<div class="col-md-8">
							<div class="owl-carousel owl-theme carousel-prod prod2">
						        <?php
						        $i=0;
						        $query = new WP_Query( array( 'post_type' => 'productos','categoria'=>'feriante',  'posts_per_page' => -1));
						        if ($query->have_posts() ) {
						            while ( $query->have_posts() ) { 
						                $query->the_post();
						                ?>
									    <div class="item">
											<?php
												if(has_post_thumbnail()):
												$thumb_id = get_post_thumbnail_id($post->ID);
												$thumb = wp_get_attachment_image_src($thumb_id, 'productos-mini');
											?>
												<img src="<?php echo $thumb[0]?>" class="img-responsive center" />
											<?php else: ?>
												<img src="http://placehold.it/350x135" alt="<?php the_title(); ?>" class="img-responsive">
											<?php endif; ?>
										    <div class="captione hidden">
										    	<h3><?php the_title(); ?></h3>
										    	<a href="<?php the_permalink(); ?>">Ver más ></a>
										    </div>
									    </div>
						              <?php $i++; ?>
						            <?php
						            }
						            wp_reset_postdata();
						        }
						        ?>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-4 offset-md-4">
							<a href="<?= esc_url(home_url('/')); ?>productos" class="btn-view-all">VER TODOS LOS PRODUCTOS</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
