<?php
    function todolist_theme_support(){
        add_theme_support('title-tag');
        add_theme_support('custom-logo');
        add_theme_support('post-thumbnails');
    }
    add_action('after_setup_theme', 'todolist_theme_support');

    function todolist_register_styles(){
        $version = wp_get_theme()->get('Version');

        wp_enqueue_style('todolist-style', get_template_directory_uri() . '/style.css', array('todolist-bootstrap'), $version, 'all');
        wp_enqueue_style('todolist-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), '5.0.2', 'all');
    }
    add_action('wp_enqueue_scripts', 'todolist_register_styles');

    function todolist_register_scripts(){
        wp_enqueue_script('todolist-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', array(), '5.0.2', true);
        wp_enqueue_script('todolist-popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array(), '2.9.2', true);
        wp_enqueue_script('todolist-ionicons', 'https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js', array(), '5.5.2', true);
        wp_enqueue_script('todolist-ionicons-esm', 'https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js', array(), '5.5.2', true);
        wp_enqueue_script('todolist-ajax', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), '3.6.0', true);
        wp_enqueue_script('todolist-sweetalert2', '//cdn.jsdelivr.net/npm/sweetalert2@11', array(), '2.11', true);
        wp_enqueue_script('todolist-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true);
    }
    add_action('wp_enqueue_scripts', 'todolist_register_scripts');

    function create_posttype() {
        register_post_type( 'todoes',
            array(
                'labels' => array(
                    'name' => __( 'Todoes' ),
                    'singular_name' => __( 'Todo' )
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'todoes'),
                'show_in_rest' => true,
            )
        );
    }
    add_action( 'init', 'create_posttype' );

    function custom_post_type() {
        $labels = array(
            'name'                => _x( 'Todoes', 'Post Type General Name', 'todolist' ),
            'singular_name'       => _x( 'Todo', 'Post Type Singular Name', 'todolist' ),
            'menu_name'           => __( 'Todoes', 'todolist' ),
            'parent_item_colon'   => __( 'Parent Todo', 'todolist' ),
            'all_items'           => __( 'All Todoes', 'todolist' ),
            'view_item'           => __( 'View Todo', 'todolist' ),
            'add_new_item'        => __( 'Add New Todo', 'todolist' ),
            'add_new'             => __( 'Add New', 'todolist' ),
            'edit_item'           => __( 'Edit Todo', 'todolist' ),
            'update_item'         => __( 'Update Todo', 'todolist' ),
            'search_items'        => __( 'Search Todo', 'todolist' ),
            'not_found'           => __( 'Not Found', 'todolist' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'todolist' ),
        );

        $args = array(
            'label'               => __( 'todoes', 'todolist' ),
            'description'         => __( 'Todo news and reviews', 'todolist' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            'taxonomies'          => array( 'genres' ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,
        );

        register_post_type( 'todoes', $args );
    }
    add_action( 'init', 'custom_post_type', 0 );

    function mb_trim($string) {
        if ( is_numeric($string) ) {
            return $string;
        }

        $rtn = mb_ereg_replace("\A[[:space:]]*(.*)|[[:space:]]*\z/", "\\1", $string);
        $rtn2 = mb_ereg_replace("\A[[\u3164]]*(.*)|[[\u3164]]*\z/", "\\1", $rtn);
        $rtn3 = mb_ereg_replace("\A[[\ㅤ]]*(.*)|[[\ㅤ]]*\z/", "\\1", $rtn2);
        return $rtn3;
    }

    function add_new_todo($todo){
        wp_insert_post(
            array(
                'post_title'   => htmlentities(mb_trim($todo)),
                'post_status'  => 'publish',
                'post_type'    => 'todoes',
                'post_content' => '',
            ), true
        );
    }

    function insert_new_todoes($title, $_csrf){
        if( !empty($_csrf) ){
            if( !empty($title) ){
                add_new_todo($title);
            }
        }
    }

?>
