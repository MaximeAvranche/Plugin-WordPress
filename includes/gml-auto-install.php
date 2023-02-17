<?php

// Installation du plugin
function gml_install_itself() {
    // Nom des fichiers à créer
    $fileHome = "gml-home-page.php";
	$fileInformation = "gml-information-page.php";
    // Déplacement
    gml_move_files($fileHome); // Copie du fichier vers le bon répertoire
    gml_move_files($fileInformation); // Copie du fichier vers le bon répertoire    

    // Suppression du dossier d'installation
    //gml_destroy_folder(); // Bye !

    // Fin du traitement
    gml_install_update_state(); // Mise à jour de l'état d'installation en base de données
}



// Déplacer les fichiers
function gml_move_files($nameFile) {
    $currentHomeLocation = "../wp-content/plugins/generateur-mentions-legales/data/files/" . $nameFile; // Répertoire du fichier
    $newHomeLocation = "../wp-admin/" . $nameFile; // Nouveau répertoire
    copy($currentHomeLocation, $newHomeLocation); // Fonction de copie | /!\ écrase si le fichier existe 
}

// Mise à jour de l'état 
function gml_install_update_state() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'gml'; // Correspond à wp_gml
    $gml_new_state = $wpdb->query($wpdb->prepare("UPDATE $table_name SET first=1 WHERE ID=1")); // Etat défini à 1
    return  $gml_new_state;
}

// Suppression du dossier d'installation
function gml_destroy_folder() {
    rmdir("../wp-content/plugins/generateur-mentions-legales/data"); // Fonction php de suppression d'un dossier depuis un repertoire
}