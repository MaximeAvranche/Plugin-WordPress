<?php


/** FONCTIONS MENU **/

// Ajout d'un bloc dans le dashboard
add_action('wp_dashboard_setup', 'gml_add_dashboard_widgets');
function gml_add_dashboard_widgets() {
	add_meta_box('gml_dashboard_widget', 'GML - Information', 'gml_dashboard_widget_function', 'dashboard', 'normal', 'high');
}

// Contenu du bloc dans le dashboard
function gml_dashboard_widget_function() {
	echo "Merci d'avoir installé le plugin Gestion de Mentions Légales.";
	if(gml_Select_Info("buisness-name") == null && gml_Select_Info("owner") == null && gml_Select_Info("contact") == null) {
		echo "<strong><p style='color: red;'>ATTENTION : Le plugin n'a pas encore été configuré. Veuillez vous rendre dans les paramètres du plugin pour ajouter des valeurs.</p></strong>";
	} else {
		echo "<strike><p style='color: #C1C1C1;'>Configurer les paramètres généraux du plugin.</p></strike>";
	}
	if(gml_Select_Info("adress") == null && gml_Select_Info("city") == null && gml_Select_Info("zip_code") == null) {
		echo "<strong><p style='color: red;'>N'oubliez pas de configurer l'adresse de l'organisation.</p></strong>";
	} else {
		echo "<strike><p style='color: #C1C1C1;'>Ajouter l'adresse de l'organisation.</p></strike>";
	}
}

// Filtre pour executer la fonction
add_action('admin_menu', 'gml_Add_My_Admin_Link');

// Affichage dans le menu 
function gml_Add_My_Admin_Link() {
	add_action('admin_menu', 'gml_add_menu_items');
    add_menu_page('Réglagles généraux', 'Mentions légales', 'manage_options', 'gml-home-page.php', '', 'dashicons-awards');
    add_submenu_page('gml-home-page.php', 'Adresse', 'Adresse', 'manage_options', 'gml-information-page.php' );
}


/** SHORTCODES **/

add_shortcode( 'sitename', function() { return gml_Select_Info("buisness-name"); } ); // Nom du site [sitename]
add_shortcode( 'proprietaire', function() { return gml_Select_Info("owner"); } ); // Nom du propriétaire [proprietaire]
add_shortcode( 'dpo', function() { return gml_Select_Info("dpo"); } ); // Nom du Directeur de la Protection des Données [dpo]
add_shortcode( 'adresse', function() { return gml_Select_Info("adress") . ", " . gml_Select_Info("zip_code") . " " .gml_Select_Info("city") . ", France"; } ); // Adresse complète de l'entreprise [adresse]
add_shortcode( 'courriel', function() { return gml_Select_Info("contact"); } ); // Conctact [courriel]
add_shortcode( 'courriel-rgpd', function() { gml_Select_Info("rgpd"); } ); // Contact RGPD du site [courriel-rgpd]
add_shortcode( 'mes-droits', function() { echo "<em>Pour connaître et exercer vos droits, veuillez consulter notre <a href=". get_bloginfo('url') ."/mentions-legales>politique de confidentialité</a>.</em>"; } ); // Champs exercer vos droits [mes-droits]


/** FONCTIONS **/

// Sélection des informations 
function gml_Select_Info($what) {
	global $wpdb;
	$gml_info = $wpdb->get_row( " SELECT $what FROM $wpdb->gml WHERE ID = 1 " );
	$selectInfo = $gml_info->$what;
	return $selectInfo;
}


// Vérification du contact RGPD
function gml_Showme_If_Its_Null($whatCanBeNull, $referenceNotNull) {
	global $wpdb;
	$whatDoYouWant = gml_Select_Info($whatCanBeNull);
	// Est-il null ?
	if($whatDoYouWant == null || $whatDoYouWant == "" || $whatDoYouWant == " ") {
		$whatDoYouWant = gml_Select_Info($referenceNotNull);
		return $whatDoYouWant; // Retour de la valeur copiée
	} else {
		return $whatDoYouWant; // Retour de l'éléments différent de $referenceNotNull
	}
}


// Type d'entreprise
function gml_What_Sort($type) {
	global $wpdb;
	$typeWanted = gml_Select_Info("type");
	// Rendre actif le type
	if($typeWanted == $type) {
		echo "selected";
	} 
}


// Mise à jour des informations
function gml_Update_Info($buisness_name, $owner, $dpo, $contact, $rgpd, $status) {
	global $wpdb;
    $table_name = $wpdb->prefix . 'gml'; // Egale à : wp_gml
	// Requête SQL
    $wpdb->query($wpdb->prepare("UPDATE $table_name SET buisness_name='$buisness_name', owner='$owner', dpo='$dpo', contact='$contact', rgpd='$rgpd', type='$status' WHERE ID=1"));
	// Raffraîchissement de la page après la mise à jour
	echo "<script type='text/javascript'>window.location=document.location.href;</script>";
}


// Mise à jour de l'adresse de l'entreprise
function gml_Update_Adress($adress, $city, $zip) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'gml'; // Egale à : wp_gml
	// Requête SQL
    $wpdb->query($wpdb->prepare("UPDATE $table_name SET adress='$adress', city='$city', zip_code='$zip' WHERE ID=1"));
	// Raffraîchissement de la page après la mise à jour
	echo "<script type='text/javascript'>window.location=document.location.href;</script>";
}




