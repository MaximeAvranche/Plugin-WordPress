<?php

// Création de la base de données
    global $wpdb;
    $table_name = $table_name = $wpdb->prefix . "gml";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "
    DROP TABLE IF EXISTS `$table_name`;
    CREATE TABLE IF NOT EXISTS `$table_name` (
      `ID` int NOT NULL AUTO_INCREMENT,
      `buisness_name` text CHARACTER SET utf8 COLLATE utf8_general_ci,
      `owner` text CHARACTER SET utf8 COLLATE utf8_general_ci,
      `dpo` text CHARACTER SET utf8 COLLATE utf8_general_ci,
      `contact` text CHARACTER SET utf8 COLLATE utf8_general_ci,
      `rgpd` text CHARACTER SET utf8 COLLATE utf8_general_ci,
      `type` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
      `adress` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
      `city` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
      `zip_code` int DEFAULT NULL,
      `first` int DEFAULT '0',
      PRIMARY KEY (`ID`),
      UNIQUE KEY `ID` (`ID`)
    ) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
   
    INSERT INTO `$table_name` (`ID`, `buisness_name`, `owner`, `dpo`, `contact`, `rgpd`, `type`, `adress`, `city`, `zip_code`, `first`) VALUES
    (1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);
    COMMIT;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);

    sleep(1); // On patiente

    // On configure le fichier class-wpdb.php
    $fichier = ABSPATH .'wp-includes/class-wpdb.php';
    $searchfor = '\'commentmeta\','; // Recherche de la ligne
    $contenu = "'gml',);\n\n/**"; // Ajout du contenu

    // ouverture du fichier en mode lecture/écriture
    $handle = fopen($fichier, 'r+');
      
    if ($handle) {
      while (!feof($handle)) {
        $ligne = fgets($handle); // lecture d'une ligne du fichier
        
        // recherche de la ligne contenant 'commentmeta'
        if (strpos($ligne, '\'commentmeta\',') !== false) {
          // ajout du contenu à la suite du champ 'commentmeta'
          fwrite($handle, $contenu . PHP_EOL);
        }
      }
      fclose($handle); // fermeture du fichier
    }

