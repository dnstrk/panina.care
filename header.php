<!DOCTYPE HTML>
<html <?php language_attributes(); ?> <?php if(is_404()){echo 'class="page-404"';} ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body class="<?php if(is_front_page()){echo "home-page";} ?>">
<?php $logo = get_theme_mod('site_logo'); ?>
<?php $tg_number = get_theme_mod('tg_num'); ?>
<header id="header" class="header hidden">
    
</header>
<main>
