<?php
/*
Plugin Name: Mad Massive Importer
Plugin URI: http://mad.cl
Description: Importador vía AJAX de para El Marcelo. Plugin personalizado El Marcelo
Version: 0.0.1
Author: Álex Acuña Viera
Author URI: http://alex.acunaviera.com
License:
License URI:
*/

// poner script progresivo?
// registrar script js para AJAX

// config url endpoint

// registrar página php visible

function mad_register_scripts($page){
  if($page === 'toplevel_page_mad-importer'){
    wp_register_style ('bootstrap-css', plugins_url( '/bootstrap/css/bootstrap.min.css', __FILE__ ));
    wp_register_style ('bootstrap-theme', plugins_url( '/bootstrap/css/bootstrap-theme.min.css', __FILE__ ));
    wp_register_script('bootstrap', plugins_url( '/bootstrap/js/bootstrap.js', __FILE__ ), array('jquery'));
    wp_register_script('lodash', plugins_url( '/lodash.min.js', __FILE__ ), array('jquery'));
    wp_register_script('lmscripts', plugins_url( '/main.js', __FILE__ ), array('jquery','bootstrap','lodash'));
    wp_localize_script( 'lmscripts', 'AjaxParserPost', array(
	    'ajaxurl' => admin_url( 'admin-ajax.php' ),
	    'nonce' => wp_create_nonce( 'ajax-parser-post-nonce' )
		));
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('lodash');
  	wp_enqueue_script('lmscripts');
    wp_enqueue_style('bootstrap-css');
    wp_enqueue_style('bootstrap-theme');
  }
};

add_action('admin_enqueue_scripts', 'mad_register_scripts');

class JsonEncodedException extends \Exception{
  public function __construct($message = null, $code = 0, Exception $previous = null){
		parent::__construct(json_encode($message), $code, $previous);
  }
  public function getDecodedMessage(){
		return $this->getMessage();
  }
}

function getRemoteImage($url){
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	$tmp = download_url($url, 20);

	$file_array = array(
		'name' => basename($url),
		'tmp_name' => $tmp
	);

	if ( is_wp_error( $tmp ) ) {
		echo 'error tmp';
		// wp_mail('aacuna@multinet.cl', 'La Hora - Error tmp', 'error en descarga de archivo: '.print_r($tmp, true));
		@unlink( $file_array[ 'tmp_name' ] );
		return $tmp;
	}
	$id = media_handle_sideload( $file_array, 0);

	if ( is_wp_error($id) ) {
		echo 'error id';
		// wp_mail('aacuna@multinet.cl', 'La Hora - Error id', 'error en descarga de archivo: '.print_r($id, true));
		@unlink($file_array['tmp_name']);
		return $id;
	} else {
		// wp_mail('aacuna@multinet.cl', 'La Hora - Carga exitosa imagen', 'carga exitosa de archivo: '.print_r($id, true));
	}
	return $id;
}

class Ajax_Parser{
	public function __construct(){
    add_action( 'wp_ajax_parser-init', array( &$this, 'ajax_parser_init' ));
		add_action( 'wp_ajax_parser-post', array( &$this, 'ajax_parser_post' ));
		// add_action( 'wp_enqueue_scripts', array( &$this, 'init' ));
	}
	public function init(){
	}
	public function ajax_parser_post(){
		try{
			$errors = [];
			$data = [];
			if(!isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'ajax-parser-post-nonce')){
        $errors['empty'] = 'nonce';
        throw new JsonEncodedException('nonce');
      }

			if(!isset($_REQUEST['postid'])){
        $errors['empty'] = 'postid';
				throw new JsonEncodedException($_REQUEST['postid']);
      }

      $query = get_post_meta( $_REQUEST['postid'], 'intid', true );

      if(!empty($query)){
        $errors['exists'] =  $_REQUEST['postid'];
        throw new JsonEncodedException('Post '. $_REQUEST['postid'] .' existe');
      }

      if($errors.length <= 0){

        $response = wp_remote_get('http://192.168.168.71:8082/getPosts/'.$_REQUEST['postid'], array(
          'timeout' => 60,
        ));
        if(is_wp_error($response)){
          throw new JsonEncodedException('remotejson');
        }
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body);

        $categoryarr = [];

        if(empty($data)){
          throw new JsonEncodedException('data');
        }
				
				if($data->response->post->categories){
	        foreach($data->response->post->categories as $category){
	          $categoryid = '';
	          $term = term_exists($category->category_title, 'category');
	          if ($term !== 0 && $term !== null) {
	            $categoryid = $term['term_id'];
	          } else {
	            $createdcat = wp_create_category($category->category_title);
	            if($createdcat !== 0 && $createdcat !== null){
	              $categoryid = $createdcat;
	            };
	          };
	          if(!empty($categoryid)){
	            $categoryarr[] = $categoryid;
	          };
	        };
				};
				
				$regions = array();
				
				if($data->response->post->meta->parsedRegion){
					
					$regionterm = term_exists($data->response->post->meta->parsedRegion, 'region');
					
					if($regionterm !== 0 && $regionterm !== null) {
						$regionid = $regionterm['term_id'];
					} else {
						$createdregion = wp_create_term($data->response->post->meta->parsedRegion, 'region');
						if($createdregion !== 0 && $createdregion !== null){
							$regionid = $createdregion['term_id'];
						}
					};
					if($regionid){
						$regions = array(
							'region' => array(
								(int)$regionid
							)
						);
					};
					
				};

        $metaarr['intid'] = $data->response->post->meta->intid;
        $metaarr['geostatus'] = $data->response->post->meta->geolocation->status;
        
        $postarr = array(
          'post_title'    => wp_strip_all_tags($data->response->post->post_title.' en '.$data->response->post->meta->comuna),
					'post_type'   => 'distribuidores',
          'post_status'   => 'publish',
          'post_category' => $categoryarr,
          'tax_input' => $regions,
          'meta_input' => $metaarr,
        );
        $post_id = wp_insert_post($postarr);
        if($post_id && function_exists('update_field')){
					if($data->response->post->meta->geolocation->status === 'OK'){
						$geodata = array(
							'address' => $data->response->post->meta->geolocation->results[0]->formatted_address,
							'lat' => $data->response->post->meta->geolocation->results[0]->geometry->location->lat, 
							'lng' => $data->response->post->meta->geolocation->results[0]->geometry->location->lng, 
							'zoom' => '12',
						);
	          update_field( 'field_582cb0899303f', $geodata , $post_id); // ubicacion
						update_field( 'field_58248e778c580', $data->response->post->meta->geolocation->results[0]->geometry->location->lat, $post_id); // lat
						update_field( 'field_58248e7f8c581', $data->response->post->meta->geolocation->results[0]->geometry->location->lng, $post_id); // long
					}
        }
        header("Content-Type: application/json");
        echo json_encode($post_id);
      } else {
        throw new JsonEncodedException($errors);
      }
		} catch(JsonEncodedException $e) {
			header("HTTP/1.0 400 Bad Request");
			header("Content-Type: application/json");
			echo $e->getMessage();
		}
		exit;
	}

	public function ajax_parser_init(){
		try{
			$errors = [];
			$data = [];
      $response = wp_remote_get( 'http://192.168.168.71:8082/getPosts/', array(
        'timeout' => 60,
      ));
      if(is_wp_error($response)){
        throw new JsonEncodedException('remotejson');
      }
      $body = wp_remote_retrieve_body($response);
      header("Content-Type: application/json");
      echo $body;
		} catch(JsonEncodedException $e) {
			header("HTTP/1.0 400 Bad Request");
			header("Content-Type: application/json");
			echo $e->getMessage();
		}
		exit;
	}
}

$ajaxCall = new Ajax_Parser();

add_action('admin_menu', 'mad_add_importer_menu');

function mad_add_importer_menu(){
  add_menu_page ('Mad Importer', 'Mad Importer', 'manage_options', 'mad-importer', 'mad_importer_page');
}

function mad_importer_page(){
  require_once('mad_header.php');
	?>
	<div class="wrap container-fluid">
		<h1>MAD Ajax importer</h1>
		<div class="row">
			<div class="col-sm-8">
				<h2>Descargar contenido</h2>
        <div class="mad-status">
        </div>
        <div class="progress">
          <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
            0%
          </div>
        </div>
				<form action="#" method="post" accept-charset="utf-8" id="triggerGetPost">
          <button type="submit" class="btn btn-success">Empezar</button>
					<hr />
				</form>
			</div>
			<div class="col-sm-4">
				<div class="well well-sm">
					<h5>Resumen</h5>
					<h4><small>Número de posts: </small><span class="init-numposts"></span></h4>
				</div>
			</div>
		</div>
	</div>
  <?php
  }


// 1 página, listado resumen
// -- total número posts
// botón EMPEZAR

// nonce
// register wp AJAX
// wp get remote de método getPosts
// lista array completo

// nonce
// register wp AJAX
// por cada getPosts (arriba){
//    wp get remote de getPost(id)
//      response:
//        $postid insert_post
//        wp_post_meta($postid) con metas
//        insertar categoría (googlear)
//        para thumbnail
//          getimageremote(url), respuesta{
//            asocia post thumbnail a $postid
//          }
//        para cada image
//          getimageroute(url);
// }

// por cada Author
//  insert wp post , post type perfil
// devuelve $perfilid
// asocia ACF Field $perfilid con $postid

// por cada Meta,
// guarda meta($postid);

// HOOK, es_404: <-- IMPORTANTE
// wp register rewrite (GOOGLEAR), function
//    get_post (post meta == 'legacy_url');
//    devuelve wp_rewrite($postid);
// } sino, 404

// function getimageremote(url)
//  result attachment id
//
// return status OK
// return error

?>
