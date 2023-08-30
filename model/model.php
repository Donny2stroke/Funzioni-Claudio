<?php 
// Crea la tabella nel database al momento dell'attivazione del plugin
register_activation_hook( __FILE__, 'create_asporto_table' );

function create_asporto_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'asporto';

    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}