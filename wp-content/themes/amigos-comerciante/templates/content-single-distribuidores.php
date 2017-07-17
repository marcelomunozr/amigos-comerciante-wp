<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class('singular'); ?>>
		<div class="text-center">
			<h1>Distribuidores</h1>
		</div>
		<div class="row la-zona">
			<div class="col-md-7">
				<div id="mapa-single" style="min-height: 300px;">
				</div>
			</div>
			<div class="col-md-5">
				<h2 class="entry-title"><?php the_title(); ?></h2>
				<?php 
					$geo = get_field('ubicacion');
					if($geo){
						?>
						<p><?php echo $geo['address'];?></p>
						<?php
					}
				?>
			</div>
		</div>
	</article>
	<div class="text-center">
	    <div class="single-arrows">
        <a href="/distribuidores/" class="in-middle">
        	ver todos
        </a>
	    </div>
    </div>
<?php endwhile; ?>
