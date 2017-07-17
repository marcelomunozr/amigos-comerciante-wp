<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class('singular'); ?>>
			<?php 
			$terms = get_the_terms( $post->ID , 'category' );
			echo $term->name;
			if(!empty($terms)){
				foreach ( $terms as $term ) {
					$categoria = $term->name;//slug
					$link = $term->slug;
				}				
			}
		 ?>
		<div class="text-center">

			<h1><?php echo $categoria; ?></h1>
		</div>
	    
		<div class="row la-zona">
			<div class="col-md-5">
				<?php
				$img = get_field('img');
				if($img!=""):
				?>
					<a href="<?php the_permalink(); ?>"><img src="<?php echo $img;?>" class="img-responsive center" /></a>
				<?php else: ?>
					<a href="<?php the_permalink(); ?>"><img src="http://placehold.it/448x299" alt="<?php the_title(); ?>" class="img-responsive"></a>
				<?php endif; ?>
			</div>
			<div class="col-md-7">
				<h2 class="entry-title"><?php the_title(); ?></h2>
		  		<time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date('j \d\e\ F\,\ Y'); ?></time>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php $galeria = get_field('galeria'); ?>
					<?php if ($galeria): ?>
						<?php foreach ($galeria as $galucha): ?>
							<a href="<?php echo $galucha['url'];?>" class="fancybox" rel="gal"><img src="<?php echo $galucha['sizes']['thumbnail'];?>" class="img-responsive center" /></a>
						<?php endforeach ?>
					<?php endif ?>
				</div>
				<?php 
				/*
					if(is_singular('distribuidores')){
						?>
						<pre>
						<?php 
							print_r(get_post_meta($post->ID));
						?>	
						</pre>
						<?php
					}
				*/
				?>
			</div>
			<dav class="alert alert-success">
				Hello World
			</dav>
		</div>
		<?php //wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
		<?php //comments_template('/templates/comments.php'); ?>
	</article>
	<div class="text-center">
	    <div class="single-arrows">
	        <!-- ARROWS -->
	        <?php 
	        $prev = null;
	        $next = null;
	        $query = get_posts('numberposts=-1&order=ASC&orderby=name&category_name='.$term->slug);
	        if($query){
	        	foreach($query as $key => $pag){
	        		if($pag->ID == $post->ID){
	        			$prev = $query[$key - 1] ? $query[$key - 1] : null;
						$next = $query[$key + 1] ? $query[$key + 1] : null; 
	        		}
	        	}
	        }
	        // print_r($query);
	        if($prev) {
	            $prev_title = strip_tags(str_replace('"', '', $prev->post_title));?>
	            <a class="arrow-left" href="<?php echo get_permalink($prev->ID); ?>" title="<?php echo $prev_title; ?>">
	                <i class="fa fa-angle-left" aria-hidden="true"></i>
	                <span>Anterior</span>
	            </a>
	        <?php } ?>
	        <a href="/<?php echo $link; ?>" class="in-middle">
	        	ver todas
	        </a>
	        <?php 
	        // ext_post = get_next_post();
	        
	        if($next) {
	            $next_title = strip_tags(str_replace('"', '', $next->post_title));?>
	            <a class="arrow-right" href="<?php echo get_permalink($next->ID); ?>" title="<?php echo $next_title; ?>">
	                <span>Siguiente</span>
	                <i class="fa fa-angle-right" aria-hidden="true"></i>
	            </a>
	        <?php }
	        ?>

	    </div>
    </div>
<?php endwhile; ?>
