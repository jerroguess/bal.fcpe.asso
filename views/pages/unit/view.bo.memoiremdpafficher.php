<?PHP

/*
  --------------------------------------------------------------------
  view.bo.memoiremdpafficher.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	// Récupération des variables.
	$strEmail = $this->_request->getParamByKey('mail_Saisie');
	$aError = $this->_request->getParamByKey('error');

	// Titre de la page.
	echo '<h1><img class="fcpe" alt="logo" src="public/images/fcpe.png">&nbsp;&nbsp;' . _("vbo_memoiremdpafficher_titre") . '</h1>';
	echo '<br/>';
	echo '<br/>';
	echo '<br/>';

	echo _("vbo_suggestionafficher_oublier");
	add_cadre_open_form('memoiremdp', 'soumettre', 'formulairePrincipale', '');
		echo '<br/>';
		echo '<br/>';
		
		echo '<label for="mail_Saisie" class="control-label">' . _("vbo_suggestionafficher_adresse") . '</label>';
        echo '<input type="text" size="255" placeholder="' . _("vbo_suggestionafficher_adresse") . '" id="mail_Saisie" name="mail_Saisie" value="' . $strEmail . '" class="form-control" />';
        echo '<br/>';
		
		echo '<button class="btn btn-primary" type="submit">' . _("vbo_memoiremdpafficher_envoyer") . '</button>';

		echo '<br/>';
		echo '<br/>';
		echo _("vbo_activiteajouter_obligatoire");
		echo '<br/>';
		echo '<br/>';
	add_cadre_close_form();

?>