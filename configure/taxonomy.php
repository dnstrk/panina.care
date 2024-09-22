<?php 
add_action( 'init', 'add_project_post_type', 0 );


if ( ! function_exists('add_project_post_type') ) {
    function add_project_post_type() {
        $labels = array(
        'name'                  => 'Проекты',
        'singular_name'         => 'Проект',
        'menu_name'             => 'Проекты',
        'name_admin_bar'        => 'Список проектов',
        'archives'              => 'Архив проектов',
        'attributes'            => 'Атрибуты проекта',
        'parent_item_colon'     => 'Проекты',
        'all_items'             => 'Все проекты',
        'add_new_item'          => 'Добавить новый проект',
        'add_new'               => 'Добавить проект',
        'new_item'              => 'Новый проект',
        'edit_item'             => 'Редактировать проект',
        'update_item'           => 'Обновить проект',
        'view_item'             => 'Смотреть проект',
        'view_items'            => 'Смотреть проекты',
        'search_items'          => 'Найти проект',
        'not_found'             => 'Не найдено',
        'not_found_in_trash'    => 'В корзине не найдено',
        'featured_image'        => 'Избранное фото',
        'set_featured_image'    => 'Установить фото проекта',
        'remove_featured_image' => 'Удалить фото проекта',
        'use_featured_image'    => 'Использовать в качестве фото проекта',
        'insert_into_item'      => 'Добавить к проекту',
        'uploaded_to_this_item' => 'Добавить к этому проекту',
        'items_list'            => 'Список проектов',
        'items_list_navigation' => 'Items list navigation',
        'filter_items_list'     => 'Фильтр проектов',
        );
        $rewrite = array(
        'slug'                  => 'project',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
        );
        $args = array(
        'label'                 => 'Проект',
        'description'           => 'Описание проекта',
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor','thumbnail', 'custom-fields', 'page-attributes', 'excerpt' ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => true,
        'menu_icon'             => 'dashicons-star-filled',
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'query_var'             => 'project',
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        'taxonomies'          => array( 'category', 'project', 'post_tag' ),
    );
        register_post_type( 'project', $args );
        add_filter( "the_excerpt", "add_class_excerpt" );
        function add_class_excerpt( $excerpt ) {
        return str_replace( '<p>', '<p class="excerpt">', $excerpt );
        }
    }
    
    
    }



?>