<?php
add_theme_support( 'post-formats', array( 'image', 'status', 'gallery', 'link', 'quote' ) );

/*
 * Do cleanup on some transient values in the database.
 */
add_action( 'wp_scheduled_delete', 'delete_expired_db_transients' );
function delete_expired_db_transients() {

    global $wpdb, $_wp_using_ext_object_cache;

    if( $_wp_using_ext_object_cache )
        return;

    $time = time() ;
    $expired = $wpdb->get_col( "SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout%' AND option_value < {$time};" );

    foreach( $expired as $transient ) {
        $key = str_replace('_transient_timeout_', '', $transient);
        delete_transient($key);
    }
}

/*
 * Set the favicon
 */
function favicon_link() {
    echo '<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />' . "\n";
}
add_action('wp_head', 'favicon_link');

?>
