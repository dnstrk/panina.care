<?php
/*
Template Name: Обо мне
*/
get_header();

// section HOME
$logo = get_post_meta( get_the_ID(), 'top_block_logo', 1 );
$h1 = get_post_meta( get_the_ID(), 'top_block_h1', true );
$home_subtitle = get_post_meta( get_the_ID(), 'top_block_subtitle', true );
?>
<div>Обо мне</div>
<?php
get_footer();
?>