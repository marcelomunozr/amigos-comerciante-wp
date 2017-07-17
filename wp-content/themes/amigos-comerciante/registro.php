<?php
/**
 * Template Name: Template Registro
 */
?>
<?php
	if(isset($_POST) && $_POST['action'] == 'registro'){
		$res = crearUsuarioCamposExtras($_POST['data']);
		if($res === true){
			echo '<div class="alert alert-success">Se ha registrado con exito ¡Bienvenido a Amigos del comerciante!</div>';
		}else{
			if(is_wp_error( $res ) ){
				echo '<div class="alert alert-danger">Ha ocurrido un error en el registro: '.$res->get_error_message().'</div>';
			}else{
				echo '<div class="alert alert-danger">Ha ocurrido un error en el registro, consultelo con la administración</div>';
			}
		}
	}
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
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item selector-registro"><a href="#almacen" role="tab" data-toggle="tab" class="nav-link active" data-mix="almacen">Almacén</a></li>
						<li class="nav-item selector-registro"><a href="#feria" role="tab" data-toggle="tab" class="nav-link" data-mix="feria">Feriante</a></li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane in fade active" id="almacen">
							<form action="" method="POST" class="form-registro">
								<input type="hidden" value="registro" name="action">
								<input type="hidden" value="almacen" name="data[tipo_contacto]">
								<div class="row">
									<div class="col-md-6">
										<input class="form-control" name="data[nombres]" type="text" data-tipo="texto" data-msje="Debe ingresar su nombre" placeholder="Nombre" required>
									</div>
									<div class="col-md-6">
										<input class="form-control" name="data[apellidos]" type="text" data-tipo="texto" data-msje="Debe ingresar su apellido" placeholder="Apellidos" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<input class="form-control rut-field" name="data[rut]" type="text" data-tipo="texto" data-msje="Debe ingresar un rut válido" placeholder="Rut" required>
									</div>
									<div class="col-md-6">
										<input class="form-control" name="data[fecha_nacimiento]" type="date" placeholder="Fecha Nacimiento">
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<input class="form-control" name="data[email]" type="email" data-tipo="email" data-msje="Debe ingresar una dirección de email valida" placeholder="Email" required>
									</div>
									<div class="col-md-6">
										<input class="form-control" name="data[celular]" type="tel" data-tipo="celular" data-msje="Debe ingresar un número valido" placeholder="Celular" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<input class="form-control" name="data[direccion_particular]" data-tipo="email" data-msje="Debe ingresar una dirección de email valida" type="text" placeholder="Dirección particular" required>
									</div>
									<div class="col-md-6">
										<input class="form-control" name="data[direccion_comercial]" type="text" data-tipo="texto" data-msje="Debe ingresar una dirección particular" placeholder="Dirección del almacén" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<input class="form-control rut-field" name="data[identificacion_comercial]" data-tipo="rut" data-msje="Debe ingresar rut del almacen" type="text" placeholder="Rut del almacén" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 offset-md-6">
										<button type="submit" class="btn btn-form">REGISTRARME</button>
									</div>
								</div>
							</form>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="feria">
							<form action="" method="POST" class="form-registro">
								<input type="hidden" value="feriante" name="tipo_contacto">
								<input type="hidden" value="registro" name="action">
                				<div class="row">
									<div class="col-md-6">
										<input class="form-control" name="data[nombres]" type="text" data-tipo="texto" data-msje="Debe ingresar su nombre" placeholder="Nombre" required>
									</div>
									<div class="col-md-6">
										<input class="form-control" name="data[apellidos]" type="text" data-tipo="texto" data-msje="Debe ingresar su apellido" placeholder="Apellidos" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<input class="form-control rut-field" name="data[rut]" type="text" data-tipo="texto" data-msje="Debe ingresar un rut válido" placeholder="Rut" required>
									</div>
									<div class="col-md-6">
										<input class="form-control" name="data[fecha_nacimiento]" type="date" placeholder="Fecha Nacimiento">
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<input class="form-control" name="data[email]" type="email" data-tipo="email" data-msje="Debe ingresar una dirección de email valida" placeholder="Email" required>
									</div>
									<div class="col-md-6">
										<input class="form-control" name="data[celular]" type="tel" data-tipo="celular" data-msje="Debe ingresar un número valido" placeholder="Celular" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<input class="form-control" name="data[direccion_particular]" type="text" placeholder="Dirección particular" required>
									</div>
									<div class="col-md-6">
										<input class="form-control" name="data[direccion_comercial]" type="text" data-tipo="text" data-msje="Debe ingresar dirección de la feria" placeholder="Dirección de la feria" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<input class="form-control" name="data[identificacion_comercial]" type="text" data-tipo="text" data-msje="Debe ingresar patente de la feria" placeholder="N° de Patente de la feria" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 offset-md-6">
										<button type="submit" class="btn btn-form">REGISTRARME</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="col-md-6">
			<div id="AlertForm" class="alert alert-warning" style="display:none;">
				<p class="mensaje"></p>
			</div>
		</div>
	</div>
</div>
