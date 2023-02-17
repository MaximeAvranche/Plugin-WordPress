<?php
/**
 * Dashboard Administration Screen
 *
 * @package WordPress
 * @subpackage Administration
 */

/** Load WordPress Bootstrap */
require_once __DIR__ . '/admin.php';

/** Load WordPress dashboard API */
require_once ABSPATH . 'wp-admin/includes/dashboard.php';
require_once ABSPATH . 'wp-admin/admin-header.php'; 

if(isset($_POST['submit'])) {
    /* VARIABLES */
    $adress = htmlspecialchars($_POST['adress']);
    $city = htmlspecialchars($_POST['city']); 
    $zip = htmlspecialchars($_POST['zip']); 
    // Fonction pour mettre à jour les données
    gml_Update_Adress($adress, $city, $zip);
}



?>
<div class="warp">
    <h1 class="wp-heading-inline">GML - <?php echo esc_html( $title ); ?></h1>
    <br />
    <h2>Gestion de l'adresse de l'entreprise</h2>
    <div id="whl_settings">Certains champs (ci-après), ont des valeurs par défaut. <br />Vous êtes dans l'obligation légale <a href="https://www.cnil.fr/fr/reglement-europeen-protection-donnees" target="_blank">(RGPD)</a> de maintenir à jour ces informations.</div>
    <form method="post" action="">
    <table class="form-table" role="presentation">
    <input type="hidden" name="action" value="update_data">
    <br /><br />
        <tr>
            <th scope="row"><label for="nomentreprise">Adresse</label></th>
            <td><input name="adress" type="text" id="nomentreprise" value="<?php echo gml_Select_Info("adress"); ?>" class="regular-text"/></td>
        </tr>
        <tr>
            <th scope="row"><label for="url"><?php _e( 'Ville' ); ?></label></th>
            <td><input name="city" type="text" id="url" value="<?php echo gml_Select_Info("city"); ?>" class="regular-text"/></td>
        </tr>
        <tr>
            <th scope="row"><label for="proprietaire"><?php _e( 'Code Postal' ); ?></label></th>
            <td><input name="zip" type="number" max="99999" id="proprietaire" value="<?php echo gml_Select_Info("zip_code"); ?>" class="regular-text" /></td>
        </tr>
    </table>
    <br />
    <br />    
      <p class="submit">
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Enregistrer les modifications">
    </p>
  </form>
</div>
<center>Ce plugin a été développé avec ❤️ par Pois Chiche Design.</center>
<?php
require_once ABSPATH . 'wp-admin/admin-footer.php';