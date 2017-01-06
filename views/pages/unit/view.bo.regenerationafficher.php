<?PHP

/*
  --------------------------------------------------------------------
  view.bo.regenerationafficher.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 24/04/2015
  --------------------------------------------------------------------
  (c) 2015. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	// Récupération des valeurs.
	$strPassword1 = $this->_request->getParamByKey('mdp1_Saisie');
	$strPassword2 = $this->_request->getParamByKey('mdp2_Saisie');
	$strGuid = $this->_request->getParamByKey('affichage');
	$aError = $this->_request->getParamByKey('error');


	// ******************************************
	// Ouverture du cadre.
	// ******************************************
	add_cadre_open_form("regeneration", "soumettre", "formulairePrincipale");
	echo '<h1><img class="fcpe" alt="logo" src="public/images/fcpe.png">&nbsp;&nbsp;Régénerer votre mot de passe</h1>';
    echo '<br/>';
	echo '<br/>';

	
	echo '<label for="mdp1_Saisie" class="control-label">' . _("vbo_changepasswordafficher_motpasse") . '</label>';
	echo '<input name="mdp1_Saisie" id="mdp1_Saisie" placeholder="Mot de passe" value="' . $strPassword1 . '" class="form-control input-sm" type="text"> ';
	echo '<br/>';
	
	echo '<label for="mdp2_Saisie" class="control-label">Répéter mot de passe* :</label>';
	echo '<input name="mdp2_Saisie" id="mdp2_Saisie" placeholder="Répéter mot de passe" value="' . $strPassword2 . '" class="form-control input-sm" type="text"><br/>';
	echo '<br/>';
	
	// Mot de passe.
	echo '<br/>';
	echo '<input type="hidden" value="' . $strGuid . '" name="affichage" id="affichage" />';

	
	// ******************************************
	// Cadre de validation.
	// ******************************************
	echo '<button type="submit" id="btnLogin" class="btn btn-success">Valider régénération</button>';
	echo '<br/>';

	// Fermer le form.
	add_cadre_close_form();
	echo '<br/>';
	echo '<br/>';
    echo '<br/>';
    echo '<br/>';
    echo '<br/>';
	echo '<br/>';
    echo '<br/>';
    echo '<br/>';
    echo '<br/>';
	

?>