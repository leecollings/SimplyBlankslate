<?php

function simplyblankslate_setup() {
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form'));
    register_nav_menus(array(
        'main-menu' => esc_html__('Main Menu', 'simplyblankslate'))
    );
}
add_action('after_setup_theme', 'simplyblankslate_setup');

function simplyblankslate_load_scripts() {
    wp_enqueue_style('simplyblankslate-style', get_stylesheet_uri());
    wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'simplyblankslate_load_scripts' );

// Reset CSS 
function reset_style() {
    printf( '<link rel="stylesheet" href="%s" />' . "\n", esc_url( get_template_directory_uri( 'url' ) ) . '/css/reset.min.css' );
}
add_action( 'wp_head', 'reset_style', 2 );

function simplyblankslate_read_more_link() {
    if(!is_admin()) {
        return ' <a href="'.esc_url(get_permalink()).'" class="more-link">...</a>';
    }
}
add_filter('the_content_more_link', 'simplyblankslate_read_more_link');

function simplyblankslate_excerpt_read_more_link($more) {
    if(!is_admin()) {
        global $post;
        return ' <a href="'.esc_url(get_permalink($post->ID)).'" class="more-link">...</a>';
    }
}
add_filter('excerpt_more', 'simplyblankslate_excerpt_read_more_link');

function simplyblankslate_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar Widget Area', 'simplyblankslate'),
        'id'            => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'simplyblankslate_widgets_init');

function simplyblankslate_enqueue_comment_reply_script() {
    if(get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('comment_form_before', 'simplyblankslate_enqueue_comment_reply_script');

function simplyblankslate_comment_count($count) {
    if(!is_admin()) {
        global $id;
        $get_comments       = get_comments('status=approve&post_id='.$id);
        $comments_by_type   = separate_comments($get_comments);
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}
add_filter('get_comments_number', 'simplyblankslate_comment_count', 0);

// disable injected recent comments widget css. boilerplate theme doesn't need this.
add_filter( 'show_recent_comments_widget_style', '__return_false', 99 );

// remove windows live writer. no one uses this and it's discontinued
remove_action('wp_head', 'wlwmanifest_link');