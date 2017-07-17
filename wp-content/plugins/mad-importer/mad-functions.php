<?php
  function debug($string = null){
    echo '<pre>';
    print_r($string);
    echo '</pre>';
  }
  //métodos
  function registersByMonth(){
    echo json_encode('bla');
  }

add_action('wp_ajax_registersByMonth', 'registersByMonth');
?>
