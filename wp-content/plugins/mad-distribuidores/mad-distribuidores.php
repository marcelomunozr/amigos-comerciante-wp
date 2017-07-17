<?php
/*
Plugin Name: MAD Distribuidores
Plugin URI: http://mad.cl
Description: Funcionalidades para distribuidores
Version: 0.0.1
Author: Álex Acuña Viera
Author URI: http://alex.acunaviera.com
License:
License URI:
*/

function mad_distribuidores_script(){
	global $post;
	$single = false;
	if($post && $post->post_type == 'distribuidores'){
		$single = get_field('ubicacion', $post->ID);
		$single['post'] = array(
			'id' => $post->ID,
			'title' => $post->post_title,
			'url' => get_permalink($post->ID),
			'geo' => get_field('ubicacion', $post->ID),
		);
	}
	wp_register_style ('leaflet-css', plugins_url( '/leaflet/leaflet.css', __FILE__ ));
	wp_register_script('leaflet', plugins_url( '/leaflet/leaflet.js', __FILE__ ), array('jquery'));
  wp_register_script('distriscripts', plugins_url( '/main.js', __FILE__ ), array('jquery', 'leaflet'));
  wp_localize_script('distriscripts', 'madDist', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'nonce' => wp_create_nonce( 'ajax-search-nonce' ),
    'assets' => plugins_url( '/leaflet/images/', __FILE__ ),
    'single' => $single
	));
	wp_enqueue_script('leaflet');
	wp_enqueue_script('distriscripts');
	wp_enqueue_style('leaflet-css');
};

add_action('wp_enqueue_scripts', 'mad_distribuidores_script');

function mad_dist_json(){
	$query = get_posts(array(
		'post_type' => 'distribuidores',
		'numberposts' => -1,
		'meta_key' => 'ubicacion'
	));
	if(empty($query)){
		return new WP_Error( 'no_distribuidores', 'No hay distribuidores', array( 'status' => 404 ) );
	}
	$comp = [];
	foreach($query as $post){
		$comp[] = array(
			'id' => $post->ID,
			'title' => $post->post_title,
			'url' => get_permalink($post->ID),
			'geo' => get_field('ubicacion', $post->ID),
		);
	}
	return $comp;
}

add_action('rest_api_init', function () {
	register_rest_route('mad/v1', 'distribuidores', array(
		'methods' => 'GET',
		'callback' => 'mad_dist_json',
	) );
} );

class JsonDistEncodedException extends \Exception{
  public function __construct($message = null, $code = 0, Exception $previous = null){
		parent::__construct(json_encode($message), $code, $previous);
  }
  public function getDecodedMessage(){
		return $this->getMessage();
  }
}

class Ajax_Search{
	public function __construct(){
    add_action( 'wp_ajax_search', array( &$this, 'ajax_search' ));
    add_action( 'wp_ajax_nopriv_search', array( &$this, 'ajax_search' ));    
		// add_action( 'wp_enqueue_scripts', array( &$this, 'init' ));
	}
	public function init(){
	}
	public function ajax_search(){
		try{
			$errors = [];
			$data = [];
			if(!isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'ajax-parser-post-nonce')){
        $errors['invalid'] = 'nonce';
        throw new JsonDistEncodedException('nonce');
      }

			if(!isset($_REQUEST['searchstring'])){
        $errors['undefined'] = 'searchstring';
				throw new JsonDistEncodedException($_REQUEST['searchstring']);
      } elseif(empty(trim($_REQUEST['searchstring']))){
        $errors['empty'] = 'searchstring';
				throw new JsonDistEncodedException($_REQUEST['searchstring']);	      
      }

      if($errors.length <= 0){
        header("Content-Type: application/json");
        echo json_encode();
      } else {
        throw new JsonDistEncodedException($errors);
      }
		} catch(JsonDistEncodedException $e) {
			header("HTTP/1.0 400 Bad Request");
			header("Content-Type: application/json");
			echo $e->getMessage();
		}
		exit;
	}

}

$ajaxCall = new Ajax_Search();