
<script src="https://www.google.com/recaptcha/api.js"></script>
<?PHP
// Lien vers la librairie Php
require 'recaptchalib.php';

// Clés ReCaptcha
$siteKey = '6LdVcBAUAAAAAH1qDXq-kzaZmdv3TSG89n0zvCyG
'; // votre clé publique
$secret = '6LdVcBAUAAAAAHsGIMvcy7lKDvQDG6p1_GIqRebk'; // votre clé privée

/*
  --------------------------------------------------------------------
  view.bo.enregistrerafficher.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

// Récupération des valeurs.
$strEmail = $this->_request->getParamByKey('mail_Saisie');
$strPassword1 = $this->_request->getParamByKey('mdp1_Saisie');
$strPassword2 = $this->_request->getParamByKey('mdp2_Saisie');
$strImage = $this->_request->getParamByKey('imageSecurite_Saisie');
$strReference = $this->_request->getParamByKey('referenceSecurite_Saisie');
$bCGU = $this->_request->getParamByKey('cgu_Saisie');
$iTypeUtilisateur = $this->_request->getParamByKey('typeUtilisateur_Saisie');
$aError = $this->_request->getParamByKey('error');


add_cadre_open_form('enregistrer', 'soumettre', 'formulairePrincipale');

// ******************************************
// Ouverture du cadre.
// ******************************************
// Ouverture du cadre principale.										  
echo '<h1>' . _("vbo_enregistrerafficher_titre") . '</h1>';
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<div class="row">';
    echo '<div class="col-lg-6">';
        echo _("vbo_enregistrerafficher_description");
        echo '<br/>';
        echo _("vbo_enregistrerafficher_loi");
        echo '<br/>';
        echo _("vbo_enregistrerafficher_condition");
        echo '<br/>';
    echo '</div>';
    echo '<div class="col-lg-6">';
        echo '<label for="mail_Saisie" class="control-label">' . _("vbo_enregistrerafficher_email") . '</label>';
        echo '<input size="255" placeholder="' . _("vbo_enregistrerafficher_email") . '" id="mail_Saisie" name="mail_Saisie" value="' . $strEmail . '" class="form-control" />';
        echo '<br/>';
        echo '<label for="mail_Saisie" class="control-label">' . _("vbo_changepasswordafficher_motpasse") . '</label>';
        echo '<input type="password" size="32" placeholder="' . _("vbo_changepasswordafficher_motpasse") . '" id="mdp1_Saisie" name="mdp1_Saisie" value="' . $strPassword1 . '" class="form-control" />';
        echo '<br/>';
        echo '<label for="mail_Saisie" class="control-label">' . _("vbo_changepasswordafficher_motpasse") . '</label>';
        echo '<input type="password" size="32" placeholder="' . _("vbo_changepasswordafficher_motpasse") . '" id="mdp2_Saisie" name="mdp2_Saisie" value="' . $strPassword2 . '" class="form-control" />';
        echo '<br/>';
        // Image de sécurité.
        //add_control_dynamique_security($connection, "", "fontCL8", "", $aError, 8, _("vbo_enregistrerafficher_imagesecurite"));
        //echo '<br/>';
        

        // ReCaptcha
        $reCaptcha = new ReCaptcha($secret);
        if(isset($_POST["g-recaptcha-response"])) {
             $resp = $reCaptcha->verifyResponse(
             $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
                );
        if ($resp != null && $resp->success) {echo "CAPTCHA OK";}
        else {echo "CAPTCHA incorrect";}
        }

        ?>

        <html>
        <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
        </html>

        <?php

        //CGU //
        echo '<br/>';
        echo '<input style="float:left;margin-top:16px;" class="gauche" ' . $bCGU . ' id="cgu_Saisie[]" type="checkbox" name="cgu_Saisie[]" />';
        echo '<label style="width:400px;" for="cgu_Saisie[]" class="checkbox cgu">' . _("vbo_enregistrerafficher_cgu") . '</label>';
        // Boutons.
        echo '<br/>';
        echo '<br/>';

        echo '<button class="btn btn-default">Annuler</button>&nbsp;';
        echo '<button class="btn btn-primary" type="submit">' . _("vbo_enregistrerafficher_valider") . '</button>';

        echo '<br/>';
        echo '<br/>';
    echo '</div>';
echo '</div>';

// Fermer le form.
add_cadre_close_form();

echo '<br/>';
echo '<br/>';

?>