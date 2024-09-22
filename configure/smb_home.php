<?php
add_action( 'cmb2_init', 'landing_block' );

function landing_block() {
    //создание метабокса
    $theam_meta = new_cmb2_box( array(
        'id' => 'home_block',
        'title' => __( 'Главная', 'pg' ),
        'object_types' => array('page'), // Post type

        'context'     => 'after_title',
        'priority'   => 'default',
        'description' => __( '', 'cmb2' ),
        'show_names'   => true,
        'show_on'      => array( 'key' => 'page-template', 'value' => 'about.php' ),
        ) );

    //СЕКЦИЯ HOME
    $theam_meta->add_field( array(
        'name' => 'Настройки секции HOME',
        'type' => 'title1',
        'id'   => 'home_title'
    ) );

    $theam_meta->add_field( array(
        'name' => esc_html__( 'Логотип', 'cmb2' ),
        'id'   => 'top_block_logo',
        'type' => 'file',
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'preview_size' => 'large',
        ) );

    $theam_meta->add_field( array(
        'name' => esc_html__( 'Заголовок секции Главная', 'cmb2' ),
        'desc' => esc_html__( 'Если пустое, то отображается название страницы', 'cmb2' ),
        'id'   => 'top_block_h1',
        'type' => 'text',
        ) );

    $theam_meta->add_field( array(
        'name' => esc_html__('Подзаголовок секции Главная', 'cmb2'),
        'type'    => 'wysiwyg',
        'id'   => 'top_block_subtitle',
        'options' => array(
            'wpautop' => true, 
            'media_buttons' => true, // show insert/upload button(s)
            'textarea_rows' => get_option('default_post_edit_rows', 12), // rows="..."
            'tabindex' => '',
            'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
            'editor_class' => '', // add extra class(es) to the editor textarea
            'teeny' => false, // output the minimal editor config used in Press This
            'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
            'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
            'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
        ),
        ) );

    
    //СЕКЦИЯ TEAM
    $theam_meta->add_field( array(
        'name' => 'Настройки секции TEAM',
        'type' => 'title2',
        'id'   => 'team_title'
    ) );
    
    $theam_meta->add_field( array(
        'name' => esc_html__( 'Заголовок секции Команда', 'cmb2' ),
        'id'   => 'team_block_h3',
        'type' => 'text',
        ) );
    $theam_meta->add_field( array(
        'name' => esc_html__('Подзаголовок секции Команда', 'cmb2'),
        'type'    => 'wysiwyg',
        'id'   => 'team_block_subtitle',
        'options' => array(
            'wpautop' => true, 
            'media_buttons' => true, // show insert/upload button(s)
            'textarea_rows' => get_option('default_post_edit_rows', 12), // rows="..."
            'tabindex' => '',
            'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
            'editor_class' => '', // add extra class(es) to the editor textarea
            'teeny' => false, // output the minimal editor config used in Press This
            'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
            'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
            'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
        ),
        ) );

    //группа для списка сервисов
    $group_team = $theam_meta->add_field( array(
        'id'          => 'team_group',
        'type'        => 'group',
        'description' => __( 'Generates reusable form entries', 'cmb2' ),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __( 'Сервис {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __( 'Добавить сервис', 'cmb2' ),
            'remove_button'     => __( 'Удалить сервис', 'cmb2' ),
            'sortable'          => true,
            'repeatable'        => true,
            // 'closed'         => true, // true to have the groups closed by default
            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ) );
    $theam_meta->add_group_field( $group_team, array(
        'name' => 'Иконка сервиса',
        'id'   => 'service_img',
        'type' => 'file',
        'options' => array(
            'url' => false, // Hide the text input for the url
        )
    ) );
    $theam_meta->add_group_field($group_team, array(
        'name' => esc_html__( 'Ссылка на сервис' , 'cmb2' ),
        'id'   => 'service_url',
        'type' => 'text',
        ) );

    // //поля для текса в анимации
    // $theam_meta->add_field( array(
    //     'name' => esc_html__( 'Блок текста в анимации team 1', 'cmb2' ),
    //     'id'   => 'team_side_block_1',
    //     'type' => 'text',
    //     ) );
    // $theam_meta->add_field( array(
    //     'name' => esc_html__( 'Блок текста в анимации team 2', 'cmb2' ),
    //     'id'   => 'team_side_block_2',
    //     'type' => 'text',
    //     ) );
    // $theam_meta->add_field( array(
    //     'name' => esc_html__( 'Блок текста в анимации team 3', 'cmb2' ),
    //     'id'   => 'team_side_block_3',
    //     'type' => 'text',
    //     ) );
    // $theam_meta->add_field( array(
    //     'name' => esc_html__( 'Блок текста в анимации team 4', 'cmb2' ),
    //     'id'   => 'team_side_block_4',
    //     'type' => 'text',
    //     ) );

    //СЕКЦИЯ PROJ
    $theam_meta->add_field( array(
        'name' => 'Настройки секции PROJ',
        'type' => 'title3',
        'id'   => 'proj_title'
    ) );

    $theam_meta->add_field( array(
        'name' => esc_html__( 'Заголовок секции Проекты', 'cmb2' ),
        'id'   => 'proj_block_h3',
        'type' => 'text',
        ) );
    $theam_meta->add_field( array(
        'name' => esc_html__('Подзаголовок секции Проекты', 'cmb2'),
        'type'    => 'wysiwyg',
        'id'   => 'proj_block_subtitle',
        'options' => array(
            'wpautop' => true, 
            'media_buttons' => true, // show insert/upload button(s)
            'textarea_rows' => get_option('default_post_edit_rows', 12), // rows="..."
            'tabindex' => '',
            'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
            'editor_class' => '', // add extra class(es) to the editor textarea
            'teeny' => false, // output the minimal editor config used in Press This
            'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
            'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
            'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
        ),
        ) );

    //СЕКЦИЯ CONTACTS
    $theam_meta->add_field( array(
        'name' => 'Настройки секции CONTACTS',
        'type' => 'title3',
        'id'   => 'proj_title'
    ) );

    $theam_meta->add_field( array(
        'name' => esc_html__( 'Заголовок секции Контакты', 'cmb2' ),
        'id'   => 'contacts_block_h3',
        'type' => 'text',
        ) );
    $theam_meta->add_field( array(
        'name' => esc_html__('Подзаголовок секции Контакты', 'cmb2'),
        'type'    => 'wysiwyg',
        'id'   => 'contacts_block_subtitle',
        'options' => array(
            'wpautop' => true, 
            'media_buttons' => true, // show insert/upload button(s)
            'textarea_rows' => get_option('default_post_edit_rows', 12), // rows="..."
            'tabindex' => '',
            'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
            'editor_class' => '', // add extra class(es) to the editor textarea
            'teeny' => false, // output the minimal editor config used in Press This
            'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
            'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
            'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
        ),
        ) );

        
}

add_action( 'cmb2_init', 'project_fields' );

function project_fields() {
//создание метабокса
    $proj_meta = new_cmb2_box( array(
        'id' => 'project_meta',
        'object_types' => array('project'), // Post type

        'context'     => 'after_title',
        'priority'   => 'default',
        'description' => __( '', 'cmb2' ),
        'show_names'   => true,
        ) );
    
    $proj_meta->add_field( array(
        'name' => esc_html__( 'Стек', 'cmb2' ),
        'id'   => 'proj_stack',
        'type' => 'text',
        ) );
    }
    // $proj_meta->add_field( array(
    //     'name' => esc_html__( 'Логотип', 'cmb2' ),
    //     'id'   => 'proj_block_logo',
    //     'type' => 'file',
    //     'options' => array(
    //         'url' => false, // Hide the text input for the url
    //     ),
    //     'preview_size' => 'large',
    //     ) );
?>