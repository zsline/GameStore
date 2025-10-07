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

/**
 * Разрешить загрузку SVG в WordPress (с безопасной проверкой)
 */
function gamestore_allow_svg_uploads( $mimes ) {
    // Добавляем MIME-тип SVG
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'gamestore_allow_svg_uploads' );

/**
 * Безопасная очистка SVG-файлов (удаление потенциально вредных тегов)
 */
function gamestore_sanitize_svg( $file ) {
    if ( isset( $file['type'] ) && 'image/svg+xml' === $file['type'] ) {
        $contents = file_get_contents( $file['tmp_name'] );

        // Убираем потенциально опасные скрипты
        $contents = preg_replace( '/<script.*?<\/script>/is', '', $contents );
        $contents = preg_replace( '/on\w+=".*?"/is', '', $contents );

        file_put_contents( $file['tmp_name'], $contents );
    }
    return $file;
}
add_filter( 'wp_handle_upload_prefilter', 'gamestore_sanitize_svg' );

/**
 * Отображение SVG в медиа-библиотеке (миниатюра)
 */
function gamestore_fix_svg_thumbnails() {
    echo '<style>
        .attachment-266x266, .thumbnail img[src$=".svg"] {
            width: 100% !important;
            height: auto !important;
        }
    </style>';
}
add_action( 'admin_head', 'gamestore_fix_svg_thumbnails' );