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
    $buisness_name = htmlspecialchars($_POST['buisness_name']);
    $owner = htmlspecialchars($_POST['owner']); 
    $dpo = htmlspecialchars($_POST['dpo']); 
    $contact = htmlspecialchars($_POST['contact']); 
    $rgpd = htmlspecialchars($_POST['rgpd']); 
    $status = htmlspecialchars($_POST['status']);
    // Fonction pour mettre à jour les données
    gml_Update_Info($buisness_name, $owner, $dpo, $contact, $rgpd, $status);
}



?>
<div class="warp">
    <h1 class="wp-heading-inline">GML - <?php echo esc_html( $title ); ?></h1>
    <br />
    <h2>Gestion des paramètres</h2>
    <div id="whl_settings">Certains champs (ci-après), ont des valeurs par défaut. <br />Vous êtes dans l'obligation légale <a href="https://www.cnil.fr/fr/reglement-europeen-protection-donnees" target="_blank">(RGPD)</a> de maintenir à jour ces informations.</div>
    <form method="post" action="">
    <table class="form-table" role="presentation">
    <input type="hidden" name="action" value="update_data">
        <tr>
            <th scope="row"><label for="nomentreprise">Nom de l'entreprise</label></th>
            <td><input name="buisness_name" type="text" id="nomentreprise" value="<?php echo gml_Select_Info("buisness_name"); ?>" class="regular-text"/></td>
        </tr>
        <tr>
            <th scope="row"><label for="url"><?php _e( 'URL du site' ); ?></label></th>
            <td><input name="blogname" type="text" id="url" value="<?php echo get_bloginfo('url'); ?>" class="regular-text" readonly/></td>
        </tr>
        <tr>
            <th scope="row"><label for="proprietaire"><?php _e( 'Propriétaire' ); ?></label></th>
            <td><input name="owner" type="text" id="proprietaire" value="<?php echo gml_Select_Info("owner"); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th scope="row"><label for="blogname"><?php _e( 'Reponsable de la publication' ); ?></label></th>
            <td><input name="dpo" type="text" id="blogname" value="<?php echo gml_Showme_If_Its_Null("dpo", "owner"); ?>" class="regular-text" />
            <p class="description" id="new-admin-email-description"><strong>Par défaut</strong>, le responsable de la publication correspond au propriétaire du site web.</p></td>
        </tr>
        <tr>
            <th scope="row"><label for="blogname"><?php _e( 'Type d\'entreprise' ); ?></label></th>
            <td>
                <select name="status" class="regular-text">
                    <option value="EI" <?= gml_What_Sort(""); ?>>-- Sélectionner une option --</option>
                    <option value="EI" <?= gml_What_Sort("EI"); ?>>Entrepreneur Individuel</option>
                    <option value="EURL" <?= gml_What_Sort("EURL"); ?>>Entreprise Unipersonnelle à Responsabilité Limitée</option>
                    <option value="SARL" <?= gml_What_Sort("SARL"); ?>>Société à Responsabilité Limité</option>
                    <option value="SASU" <?= gml_What_Sort("SASU"); ?>>Société par Actions Simplifiée Unipersonnelle</option>
                    <option value="SAS" <?= gml_What_Sort("SAS");?>>Société par Actions Simplifiée</option>
                    <option value="SA" <?= gml_What_Sort("SA"); ?>>Société Anonyme</option>
                    <option value="SNC" <?= gml_What_Sort("SNC"); ?>>Société en Nom Collectif</option>
                    <option value="SCS" <?= gml_What_Sort("SCS"); ?>>Société en Commandité Simple</option>
                    <option value="SCA" <?= gml_What_Sort("SCA"); ?>>Société en Commandité par Actions</option>
                    <option value="TPE" <?= gml_What_Sort("TPE");?>>Mircroentreprise</option>
                    <option value="PME" <?= gml_What_Sort("PME"); ?>>Petite ou Moyenne Entreprise</option>
                    <option value="Association à but non lucratif">Association à but non lucratif</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="contact"><?php _e( 'Courriel de contact' ); ?></label></th>
            <td><input name="contact" type="text" id="contact" value="<?php echo gml_Select_Info("contact"); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th scope="row"><label for="rgpd"><?php _e( 'Courriel RGPD' ); ?></label></th>
            <td><input name="rgpd" type="text" id="rgpd" value="<?php echo gml_Showme_If_Its_Null("rgpd", "contact"); ?>" class="regular-text" />
            <p class="description" id="new-admin-email-description"><strong>Par défaut</strong>, l'adresse courriel RGPD est identique à l'adresse courriel de contact</p></td>
        </tr>
    </table>   
      <p class="submit">
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Enregistrer les modifications">
    </p>
  </form>
</div>
<center>Ce plugin a été développé avec ❤️ par Pois Chiche Design.</center>
<?php
require_once ABSPATH . 'wp-admin/admin-footer.php';