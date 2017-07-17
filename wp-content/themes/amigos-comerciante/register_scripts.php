<?php

	function checkScripts(){
	
	}
	add_action( 'init', 'checkScripts' );
	
	function register_scripts() {
        wp_enqueue_script( 'jquery-rut', get_template_directory_uri() . '/assets/scripts/jquery.rut.min.js', array('jquery'), '1.1.0', true );
        wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/assets/scripts/imagesloaded.min.js', array('jquery'), '3.2.0', true );
        wp_enqueue_script( 'masonry', get_template_directory_uri() . '/assets/scripts/masonry.min.js', array('jquery'), '3.3.2', true );
	}
	add_action( 'wp_enqueue_scripts', 'register_scripts' );
	
	function crearUsuarioCamposExtras($datos = array()){
        if(!empty($datos)){
            $clave = str_replace('.', '', trim($datos['rut']));
            $clave = str_replace('-', '', $clave);
            $tope = 5;
            $ini = 0;
			$userdata = array(
                'user_login'    =>  $datos['email'],
                'user_email'    =>  $datos['email'],
                'first_name'    =>  ucwords(mb_strtolower($datos['nombres'])),
                'last_name'     =>  ucwords(mb_strtolower($datos['apellidos'])),
                'user_pass'     =>  substr($clave, $ini, $tope),
                'display_name'  =>  ucwords(mb_strtolower($datos['nombres']))." ".ucwords($datos['apellidos'])
            );
            $user_id = wp_insert_user( $userdata ) ;
            if (!is_wp_error($user_id) ) {
                update_field("field_58264a4cb8195", sanitize_text_field($datos['rut']), 'user_'.$user_id); //Rut
				update_field("field_58264a26b8193", sanitize_text_field($datos['nombres']), 'user_'.$user_id); //Nombres
				update_field("field_58264a41b8194", sanitize_text_field($datos['apellidos']), 'user_'.$user_id); //Apellidos
				update_field("field_58264a6cb8196", date('Ymd', strtotime(sanitize_text_field($datos['fecha_nacimiento']))), 'user_'.$user_id); //Fecha de nacimiento
				update_field("field_58264a9bb8198", sanitize_text_field($datos['direccion_particular']), 'user_'.$user_id); //Direccion particular
				update_field("field_58264aadb8199", sanitize_text_field($datos['direccion_comercial']), 'user_'.$user_id); //Direccion comercial
				update_field("field_58264a91b8197", sanitize_text_field($datos['celular']), 'user_'.$user_id); //Celular
				update_field("field_582649e2b8192", sanitize_text_field($datos['tipo_contacto']), 'user_'.$user_id); //Tipo de contacto
				update_field("field_58264adfb819b", sanitize_text_field($datos['identificacion_comercial']), 'user_'.$user_id); //Rut Almacen
                $email['email']		= $datos['email'];
                $email['password']	= substr($clave, $ini, $tope);
                $res = emailBienvenida($email);
                return true;
            }else{
                return $user_id;
            }
        }else{
            return false;
        }
    }

	function emailBienvenida($datos = array()){
		add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );
		if(!empty($datos)){
			$headers[] = 'From: Sitio web Amigo del comerciante <contacto@confort.cl>';
			$headers[] = 'Bcc: asanchez@mad.cl';
			$body = "
			<html>
				<head></head>
				<body>
					<h1>Bienvenido a Amigos del Comerciante!</h1>
					<p>Sus datos para iniciar sesión son: 
					<strong>Nombre de usuario</strong>: ".$datos['email']."<br>
					<strong>Contraseña</strong>: ".$datos['password']."<br>
					</p>
				</body>
			</html>";
			wp_mail( 
					$datos['email'], 
					"[Confort] ¡Bienvenido a Amigos del comerciante!", 
					$body, 
					$headers);
		}else{
			return false;
		}
		remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );
	}
	
	function wpdocs_set_html_mail_content_type(){
		return 'text/html';
	}
