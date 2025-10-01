<?php
/**
 * Plugin Name: Gamestore General
 * Description: Core Code for Gamestore
 * Version: 1.0
 * Author: WebMercrnary
 * Author URI: http://dereka.pro
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

function gamestore_remove_dashboard_widgets(){
global $wp_meta_boxes;
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
}
add_action('wp_dashboard_setup', 'gamestore_remove_dashboard_widgets');

add_filter( 'block_categories_all', 'mytheme_custom_block_category', 10, 2 );

function mytheme_custom_block_category( $categories, $post ) {
    $custom_category = array(
        array(
            'slug'  => 'blocks-gamestore',
            'title' => __( 'Мои виджеты', 'textdomain' ),
            'icon'  => 'smiley',
        ),
    );

    // Добавляем в начало массива
    return array_merge( $custom_category, $categories );
}