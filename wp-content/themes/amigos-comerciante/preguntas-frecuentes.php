<?php
/**
 * Template Name: Template Preguntas Frecuentes
 */
the_post();
?>
<section class="secciones">
	<div class="text-center">
		<h1><?php the_title(); ?></h1>
	</div>
	<div class="clear30"></div>

	<div id="accordion" role="tablist" aria-multiselectable="true">
    <?php
    $i=0;
    $query = new WP_Query( array( 'post_type' => 'faq','posts_per_page' => -1));
    if ($query->have_posts() ) {
      while ( $query->have_posts() ) { 
        $query->the_post();
        if ($i==0){
      		$clase='collapse in';
      		$expanded='true';
        }else{
       		$clase='collapse';
      		$expanded='false';
       	} ?>
			  <div class="card">
			    <div class="card-header" role="tab" id="heading-<?php echo $i;?>">
			      <h5 class="mb-0">
			        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $i;?>" aria-expanded="<?php echo $expanded;?>" aria-controls="collapse-<?php echo $i;?>">
			          <?php the_title(); ?>
			        </a>
			      </h5>
			    </div>

			    <div id="collapse-<?php echo $i;?>" class="<?php echo $clase;?>" role="tabpanel" aria-labelledby="heading-<?php echo $i;?>">
			      <div class="card-block">
			        <?php the_content(); ?>
			      </div>
			    </div>
			  </div>

        <?php $i++; ?>
      <?php
      }
      wp_reset_postdata();
    }
    ?>
	</div>
</section>
