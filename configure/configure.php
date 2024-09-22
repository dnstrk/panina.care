<?php

function custom_setup() {

  // поддержка функций темы
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'editor-style' );
  add_theme_support( 'html5', array( 'search-form', 'navigation-widgets', 'gallery', 'caption', 'script', 'style' ) );
  add_theme_support('title-tag');

##Языки
  load_theme_textdomain('textdomaintomodify', get_template_directory() . '/languages');


##Удалить глобальные стили и всякий мусор
  remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
  remove_action('wp_body_open', 'wp_global_styles_render_svg_filters' );
  remove_action( 'wp_head', 'wp_generator'); 
  remove_action( 'wp_head', 'rsd_link' );
  remove_action( 'wp_head', 'feed_links', 2 );
  remove_action( 'wp_head', 'index_rel_link' );
  remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
  remove_action('wp_head', 'previous_post_rel_link', 10, 0);
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
  remove_action( 'wp_head', 'feed_links_extra', 3 );
  remove_action('wp_head', '_ak_framework_meta_tags');
  
## Удалить Meta Generators
ini_set('output_buffering', 'on'); // turns on output_buffering
function remove_meta_generators($html) {
    $pattern = '/<meta name(.*)=(.*)"generator"(.*)>/i';
    $html = preg_replace($pattern, '', $html);
    return $html;
}

add_action('wp_footer', function(){ ob_end_flush(); }, 100);


##Удалить хуки wp_footer, которые добавляют глобальные встроенные стили.
  remove_action('wp_footer', 'wp_enqueue_global_styles', 1);

##Удалить фильтры render_block,
  remove_filter('render_block', 'wp_render_duotone_support');
  remove_filter('render_block', 'wp_restore_group_inner_container');
  remove_filter('render_block', 'wp_render_layout_support_flag');

##Удалить ненужные размеры изображений
  remove_image_size( '1536x1536' );
  remove_image_size( '2048x2048' );

##Кастомные размеры изображений
  // add_image_size( '424x424', 424, 424, true );
  // add_image_size( '1920', 1920, 9999 );
}
add_action('after_setup_theme', 'custom_setup');

##Удалить хуки wp_footer, которые добавляют глобальные встроенные стили.
remove_action('wp_footer', 'wp_enqueue_global_styles', 1);

##Удалить фильтры render_block,
  remove_filter('render_block', 'wp_render_duotone_support');
  remove_filter('render_block', 'wp_restore_group_inner_container');
  remove_filter('render_block', 'wp_render_layout_support_flag');

##Удалить ненужные размеры изображений
  remove_image_size( '1536x1536' );
  remove_image_size( '2048x2048' );

##Кастомные размеры изображений
  // add_image_size( '424x424', 424, 424, true );
  // add_image_size( '1920', 1920, 9999 );
  
add_action('after_setup_theme', 'custom_setup');

## удалить размеры изображений по умолчанию, чтобы избежать перегрузки сервера
  function remove_default_image_sizes( $sizes) {
    unset( $sizes['large']);
    unset( $sizes['medium']);
    unset( $sizes['medium_large']);
    return $sizes;
  }
add_filter('intermediate_image_sizes_advanced', 'remove_default_image_sizes');

##Отключить большой размер изображений
  add_filter( 'big_image_size_threshold', '__return_false' );

## Убираем комментарии
function callback($buffer) {
    $buffer = preg_replace('/<!--(.|\s)*?-->/', '', $buffer);
    return $buffer;
}
function buffer_start() {
    ob_start("callback");
}
function buffer_end() {
    ob_end_flush();
}
add_action('get_header', 'buffer_start');
add_action('wp_footer', 'buffer_end');

## Удалить эмоджи
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

## удалить wp-embed.js из футера
function my_deregister_scripts() {
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );


## закроем возможность публикации через xmlrpc.php
add_filter('xmlrpc_enabled', 'return_false');
add_action('after_setup_theme', function(){
  if ( ! is_admin() && ! current_user_can('manage_options') )
    show_admin_bar( false );
});

## поддержка mime типов
add_filter( 'upload_mimes', 'svg_upload_allow' );

# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow( $mimes ) {
  $mimes['svg']  = 'image/svg';
  return $mimes;
}
add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

# Исправление MIME типа для SVG файлов.
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

  // WP 5.1 +
  if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ){
    $dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
  }
  else {
    $dosvg = ( '.svg' === strtolower( substr( $filename, -4 ) ) );
  }

  // mime тип был обнулен, поправим его
  // а также проверим право пользователя
  if( $dosvg ){

    // разрешим
    if( current_user_can('manage_options') ){

      $data['ext']  = 'svg';
      $data['type'] = 'image/svg+xml';
    }
    // запретим
    else {
      $data['ext']  = false;
      $data['type'] = false;
    }

  }

  return $data;
}

## отключить обновления по электронной почте
add_filter( 'auto_plugin_update_send_email', '__return_false' );
add_filter( 'auto_theme_update_send_email', '__return_false' );

## Схема
function pg_schema_type() {
$schema = 'https://schema.org/';
if ( is_single() ) {
$type = "Article";
} elseif ( is_author() ) {
$type = 'ProfilePage';
} elseif ( is_search() ) {
$type = 'SearchResultsPage';
} else {
$type = 'WebPage';
}
echo 'itemscope itemtype="' . $schema . $type . '"';
}
add_filter( 'nav_menu_link_attributes', 'pg_schema_url', 10 );
function pg_schema_url( $atts ) {
$atts['itemprop'] = 'url';
return $atts;
}
if ( !function_exists( 'pg_wp_body_open' ) ) {
function pg_wp_body_open() {
do_action( 'wp_body_open' );
}
}
add_action( 'wp_body_open', 'pg_skip_link', 5 );
function pg_skip_link() {
echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html( 'Перейти к содержанию', 'pg' ) . '</a>';
}
add_filter( 'the_content_more_link', 'pg_read_more_link' );
function pg_read_more_link() {
if ( !is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'pg' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}

## Отключу wlwmanifest
remove_action( 'wp_head', 'wlwmanifest_link' );
## Прячем X-Pingback
function remove_x_pingback($headers) {
    unset($headers['X-Pingback']);
    return $headers;
}
add_filter('wp_headers', 'remove_x_pingback');


## менюшечки

register_nav_menus( array( 'main-menu' => esc_html__( 'Главное меню', 'pg' ) ) );


## поля в настройках страницы
add_action('customize_register', 'dco_customize_register');

function dco_customize_register($wp_customize) {
  $wp_customize->add_section('header', array(
    'title' => 'Данные компании',
    'priority' => 1,
));
$wp_customize->add_section('footer', array(
    'title' => 'Подвал сайта',
    'priority' => 2,
));

/*
административное поле по смене номера
*/
$setting_tel = 'tg_num';

$wp_customize->add_setting($setting_tel, array(
  'default' => '',
  'sanitize_callback' => 'sanitize_text_field',
  'transport' => 'postMessage'
));
$wp_customize->add_control($setting_tel, array(
  'section' => 'header',
  'type' => 'text',
  'label' => 'Номер telegram',
));

$header_img = 'site_logo';

$wp_customize->add_setting($header_img, array(
  'default' => '',
  'sanitize_callback' => 'sanitize_text_field',
  'transport' => 'postMessage'
));
$wp_customize->add_setting( 'site_logo' );

$wp_customize->add_control(
  new WP_Customize_Image_Control(
      $wp_customize,
      'logo_control',
      array(
          'label'    => 'Логотип сайта',
          'settings' => 'site_logo',
          'section'  => 'header'
      )
  )
);

$setting_contacts_addr = 'contacts_addr';

$wp_customize->add_setting($setting_contacts_addr, array(
  'default' => '',
  'sanitize_callback' => 'sanitize_text_field',
  'transport' => 'postMessage'
));
$wp_customize->add_control($setting_contacts_addr, array(
  'section' => 'header',
  'type' => 'text',
  'label' => 'Контакты: Адрес',
));

$setting_contacts_number = 'contacts_number';

$wp_customize->add_setting($setting_contacts_number, array(
  'default' => '',
  'sanitize_callback' => 'sanitize_text_field',
  'transport' => 'postMessage'
));
$wp_customize->add_control($setting_contacts_number, array(
  'section' => 'header',
  'type' => 'text',
  'label' => 'Контакты: Телефон',
));

$setting_contacts_mail = 'contacts_mail';

$wp_customize->add_setting($setting_contacts_mail, array(
  'default' => '',
  'sanitize_callback' => 'sanitize_text_field',
  'transport' => 'postMessage'
));
$wp_customize->add_control($setting_contacts_mail, array(
  'section' => 'header',
  'type' => 'text',
  'label' => 'Контакты: Почтовый адрес',
));

$setting_contacts_tg = 'contacts_tg';

$wp_customize->add_setting($setting_contacts_tg, array(
  'default' => '',
  'sanitize_callback' => 'sanitize_text_field',
  'transport' => 'postMessage'
));
$wp_customize->add_control($setting_contacts_tg, array(
  'section' => 'header',
  'type' => 'text',
  'label' => 'Контакты: Telegram',
));
}



add_action( 'current_screen', 'my_theme_add_editor_styles' );

function my_theme_add_editor_styles() {
	add_editor_style( '/assets/css/editor-styles.css' );
}

add_action("wp_ajax_load_more", "load_posts");
add_action("wp_ajax_nopriv_load_more", "load_posts");

function load_posts() {
  $args = json_decode(stripslashes($_POST["query"]), true);
  
  $args = array(  "post_type"=> $_POST["tpl"],   "post_status" => "publish",  "posts_per_page" => 2, );
    $args["paged"] = $_POST["page"] + 2;
    $posts = new WP_Query($args);
    $html = '';
    if ($posts->have_posts()) : while ($posts->have_posts()) : $posts->the_post(); ?>
   
  <?php  if ($_POST["tpl"] === "project") {       
    get_template_part("templates/loop-project");
    } ?>
  <?php
  endwhile;
  endif;
  wp_reset_postdata();
  die($html);
}

?>