<?php
/**
* Plugin Name: Gestion des mentions légales
* Plugin URI: https://prestarvor.com/
* Description: Gestion facile et rapide des mentions légales pour votre site web.
* Version: 0.9
* Requires at least: 5.0
* Requires PHP: 7.4.9
* Author: Maxime Avranche
* Author URI: https://poischichedesign.com/
* License: GPLv3
* License URI:
*/

// ------------------------------------------------------------
// INITIALISATIONS
// ------------------------------------------------------------
require_once plugin_dir_path(__FILE__) . 'includes/gml-functions.php';


// ------------------------------------------------------------
// TRAITEMENTS
// ------------------------------------------------------------

/** INSTALLATION DU PLUGIN **/

// Vérification de l'état de l'installation
if(gml_Select_Info("first") == 0) {
    // L'installation n'étant pas faite, il faut la faire
    require_once plugin_dir_path(__FILE__) . 'includes/sql-installation-file.php'; // Appel du fichier de création de la base de données
    require_once plugin_dir_path(__FILE__) . 'includes/gml-auto-install.php'; // Appel du fichier de configuration
    /*gml_auto_install_sql(); // Création de la base de données*/
    gml_install_itself(); // Fonction d'installation
} else if (gml_Select_Info("first") == 1) {
    // L'installation est faite
    // TO DO
}