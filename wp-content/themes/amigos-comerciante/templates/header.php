<header<?php if (is_home() || is_page('inicio')): ?> class="header-homi"<?php endif ?>>
  <div class="container">
    <div class="head-zone">
      <a href="#" class="ico-face"></a>
      <a href="#" class="ico-wsapp invisible"></a>
      <a href="tel:+56998765432" class="wsapp-tel invisible">+569 98765432</a>
      <div class="login-zone">
        <a href="#">Ingresar <i class="fa fa-caret-right" aria-hidden="true"></i></a>
        <span class="la-line"></span>
        <a href="<?= esc_url(home_url('/')); ?>registro">Regístrate aquí <i class="fa fa-caret-right" aria-hidden="true"></i></a>
        <a href="#" class="forgot">Olvidé mi Clave</a>
      </div>
    </div>
    <a href="<?= esc_url(home_url('/')); ?>" class="logo"></a>
    <span class="icon-bar"></span>
    <div class="clear20 hidden-md-up"></div>
    <nav class="nav-primary">
      <?php
      if (has_nav_menu('menu_header')) :
        wp_nav_menu(['theme_location' => 'menu_header', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
  </div>
</header>
