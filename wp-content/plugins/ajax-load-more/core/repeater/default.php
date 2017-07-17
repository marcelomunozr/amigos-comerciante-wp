<div class="col-md-3">
						<article <?php post_class(); ?>>
							<?php
								$img = get_field('img');
								if($img!=null):
							?>
								<a href="<?php the_permalink(); ?>"><img src="<?php echo $img; ?>" class="img-responsive" /></a>
							<?php else: ?>
								<a href="<?php the_permalink(); ?>"><img src="http://placehold.it/150x135" alt="<?php the_title(); ?>" class="img-responsive"></a>
							<?php endif; ?>
						  	<?php 
								$terms = get_the_terms( $post->ID , 'category' );
								foreach ( $terms as $term ) {
									if ((!$categoria == "novedades")&&(!$categoria == "vida-social")) {
										$categoria = $categoria . " " .$term->name;//slug
									}
								}
							 ?>
							<div class="lacategoria"><?php echo $categoria; ?></div>
						  	<div class="contenlo">
						  		<time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date('j \d\e\ F Y'); ?></time>
								<div class="entry-summary">
									<?php 
										$content = get_the_content();
										$content = strip_tags($content);
										echo substr($content, 0, 75)."...";
									?>
						  		</div>
						  		<a href="<?php the_permalink(); ?>" class="more">ver más <i class="fa fa-angle-right" aria-hidden="true"></i></a>
							</div>
						</article>
					</div>
				<?php
				$categoria = "";
		?>