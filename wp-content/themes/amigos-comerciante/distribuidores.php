<?php
/**
 * Template Name: Template Distribuidores
 */
  $contenido = get_field('contenido');
?>
<div class="container-interior" style="background: url('<?php echo $bg; ?>') no-repeat right top;">
  <div class="row">
    <div class="col-md-12">
        <div class="text-enter">
          <h1><?php the_title(); ?></h1>
          <div class="col-md-6 offset-md-3">
            <div class="context">
                <?php echo $contenido; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="catalogo formulario">
      <div class="el-tab row">
        <div class="col-md-8">
	        <input class="form-control" name="">
        </div>
        <div class="col-md-4">
          <select id="regions" class="form-control">
	          <?php
		          $query = get_terms('region');
							foreach($query as $term){
								$term->order = get_field('orden', $term);								
							}
							uasort($query, function($a, $b){
								if ($a->order == $b->order) {
						      return 0;
						    }
						    return ($a->order < $b->order) ? -1 : 1;
							});
							foreach($query as $term){
								?>
								<option><?php echo $term->name; ?> (<?php echo $term->count; ?> <?php echo ($term->count > 1 ? 'sucursales' : 'sucursal'); ?> )</option>
								<?php
							}
	          ?>
          </select>
        </div>
      </div>
      <div id="mapa" style="min-height: 300px;"></div>
    </div>
  </div>
</div>