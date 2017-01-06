<?PHP

/*
  --------------------------------------------------------------------
  view.bo.contactafficher.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    // Récupération des variables.
    $strAuteur = $this->_request->getParamByKey('auteur_Saisie');
    $strEmail = $this->_request->getParamByKey('mail_Saisie');
    $strNotes = $this->_request->getParamByKey('notes_Saisie');
    $aError = $this->_request->getParamByKey('error');

    add_cadre_open_form('contact', 'soumettre', 'formulairePrincipale');
									  
    echo '<h1><img class="fcpe" alt="logo" src="public/images/fcpe.png">&nbsp;&nbsp;' . _("vbo_contact_titre") . '</h1>';
    echo '<br/>';
    echo '<br/>';
    echo _("vbo_contactafficher_description");
    echo '<br/>';
    echo '<br/>';
    echo _("vbo_activiteajouter_obligatoire");
    echo '<br/>';
    echo '<br/>';
    echo '<label for="auteur_Saisie" class="col-lg-2 control-label">' . _("vbo_suggestionafficher_auteur") . '</label>';
    echo '<input size="255" placeholder="Auteur" id="auteur_Saisie" name="auteur_Saisie" value="' . $strAuteur . '" class="form-control" />';
    echo '<br/>';
    echo '<label for="mail_Saisie" class="col-lg-2 control-label">' . _("vbo_suggestionafficher_adresse") . '</label>';
    echo '<input size="255" placeholder="Adresse e-mail" id="mail_Saisie" name="mail_Saisie" value="' . $strEmail . '" class="form-control" />';
    echo '<br/>';
    echo '<label for="notes_Saisie" class="col-lg-2 control-label">' . _("vbo_suggestionafficher_note") . '</label>';
    echo '<textarea row="3" placeholder="Descriptions" id="notes_Saisie" name="notes_Saisie" value="' . $strNotes . '" class="form-control"></textarea>';
    echo '<br/>';

    // Boutons.
    echo '<br/>';
    echo '<br/>';

    echo '<button class="btn btn-default">Annuler</button>&nbsp;';
    echo '<button class="btn btn-primary" type="submit">' . _("vbo_contact_envoyer") . '</button>';

    echo '<br/>';
    echo '<br/>';


    // Fermer le form.
    add_cadre_close_form();

?>