<?php
function _add_javascript() {
    //отключение стандартных действий wp_head из head
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    //подключение собственных скриптов
  wp_enqueue_script('splide', get_template_directory_uri() . '/assets/js/splide.min.js', null, null, true );
  //условие (не для главной страницы)
  if (!is_front_page() || !is_home()) :
  wp_enqueue_script('fslightbox', get_template_directory_uri() . '/assets/js/fslightbox.js', null, null, true );
  endif;
  wp_enqueue_script('theme', get_template_directory_uri() . '/assets/js/app.min.js', array( 'jquery' ), null, true );
  

  
}
//подключение вышеуказанной функции
add_action('wp_enqueue_scripts', '_add_javascript', 100);

function _add_stylesheets() {
    //отключение стандартного редактора Гуттенберг
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
    //Подключение собственных стилей
  wp_enqueue_style('splide', get_template_directory_uri() . '/assets/css/splide.css', null, null, 'all' );
  wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap-grid.css', null, null, 'all' );
  wp_enqueue_style('theme', get_template_directory_uri() . '/assets/css/app.min.css', null, null, 'all' );
  wp_enqueue_style('normalise', get_template_directory_uri() . '/assets/css/normalise.css', null, null, 'all' );
}
//подключение вышеуказанной функции
add_action('wp_enqueue_scripts', '_add_stylesheets');
