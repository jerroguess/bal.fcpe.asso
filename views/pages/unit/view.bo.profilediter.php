<?PHP

/*
  --------------------------------------------------------------------
  view.bo.profilediter.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */
	 
	// Récupération des valeurs.
	$strNom = $this->_request->getParamByKey('nom_Saisie');
	$strPrenom = $this->_request->getParamByKey('prenom_Saisie');
	$aError = $this->_request->getParamByKey('error');


	// ******************************************
	// Ouverture du cadre.
	// ******************************************
	add_cadre_open_form("profil", "soumettre", "formulairePrincipale");
	echo '<h1><img class="fcpe" alt="logo" src="public/images/fcpe.png">&nbsp;&nbsp;' . _("vbo_profilediter_titre") . '</h1>';
    echo '<br/>';
	echo _("vbo_activiteajouter_obligatoire");
	echo '<br/>';
	echo '<br/>';

	// ******************************************
	// Groupe identifiant.
	// ******************************************											  
	echo _("vbo_profilediter_identifiant");
	echo '<br/>';
	echo '<br/>';
	echo _("vbo_profilediter_modifierdonnees");
	echo '<br/>';
	echo '<br/>';
	echo '<label for="nom_Saisie" class="control-label">' . _("vbo_activiteajouter_nom") . '</label>';
	echo '<input name="nom_Saisie" id="nom_Saisie" placeholder="' . _("vbo_activiteajouter_nom") . '" value="' . $strNom . '" class="form-control input-sm" type="text"> ';
	echo '<br/>';
	
	echo '<label for="prenom_Saisie" class="control-label">' . _("vbo_profilediter_prenom") . '</label>';
	echo '<input name="prenom_Saisie" id="prenom_Saisie" placeholder="' . _("vbo_profilediter_prenom") . '" value="' . $strPrenom . '" class="form-control input-sm" type="text"><br/>';
	echo '<br/>';

	// ******************************************
	// Cadre de validation.
	// ******************************************
	echo '<button type="submit" id="btnLogin" class="btn btn-success">' . _("vbo_activitemodifier_valider") . '</button>';
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