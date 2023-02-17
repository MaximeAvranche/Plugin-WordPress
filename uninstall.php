<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}


// Fonction de suppression du plugin
function gml_uninstall_me() {
    // FICHIERS
    unlink("../wp-content/gml-home-page.php"); // Suppression du fichier
    unlink("../wp-content/gml-information-page.php"); // Suppression du fichier

    // BASE DE DONNEES
    global $wpdb;
    $table_name = $table_name = $wpdb->prefix . "gml";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "DROP TABLE IF EXISTS `wp_gml`;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
