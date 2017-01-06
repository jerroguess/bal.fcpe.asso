<?PHP

/*
  --------------------------------------------------------------------
  view.bo.updateparent.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	$rdsNiveauAdhesion = $this->_request->getParamByKey('rdsNiveauAdhesion');
	$rdsDepartement = $this->_request->getParamByKey('rdsDepartement');
	$rdsEtablissement = $this->_request->getParamByKey('rdsEtablissement');
    $rdsParent = $this->_request->getParamByKey('rdsParent');
	$strReference = $this->_request->getParamByKey('reference_Saisie');
	$iIdNiveauAdhesion = $this->_request->getParamByKey('niveau_Saisie');
	$strEtablissement = $this->_request->getParamByKey('nometablissement_Saisie');
	$iIdEtablissement = $this->_request->getParamByKey('id_etatnorma_Saisie');
	$strNom = $this->_request->getParamByKey('nom_Saisie');
	$strPrenom = $this->_request->getParamByKey('prenom_Saisie');
	$strCivilite = $this->_request->getParamByKey('civilite_Saisie');
	$strNom2 = $this->_request->getParamByKey('nom2_Saisie');
	$strPrenom2 = $this->_request->getParamByKey('prenom2_Saisie');
	$strCivilite2 = $this->_request->getParamByKey('civilite2_Saisie');
	$strAdresse1 = $this->_request->getParamByKey('adresse1_Saisie');
	$strAdresse2 = $this->_request->getParamByKey('adresse2_Saisie');
	$strAdresse3 = $this->_request->getParamByKey('adresse3_Saisie');
	$strAdresse4 = $this->_request->getParamByKey('adresse4_Saisie');
	$strCodePostal = $this->_request->getParamByKey('codepostal_Saisie');
	$iIdCommune = $this->_request->getParamByKey('id_commune_Saisie');
	$strCommune = $this->_request->getParamByKey('commune_Saisie');
	$bAdhesionHorsCL = $this->_request->getParamByKey('adhesionhorscl_Saisie');
	$strNomAutreFCPE = $this->_request->getParamByKey('nomautrefcpe_Saisie');
	$bAboRP = $this->_request->getParamByKey('aborp_Saisie');
	$bAboFE = $this->_request->getParamByKey('abofe_Saisie');
	$strTelephone = $this->_request->getParamByKey('telephone_Saisie');
	$strPortable = $this->_request->getParamByKey('portable_Saisie');
	$strEmail = $this->_request->getParamByKey('email_Saisie');
	$strEmail2 = $this->_request->getParamByKey('email2_Saisie');
	$bSouhPartCL = $this->_request->getParamByKey('souhpartcl_Saisie');
	$bSouhCandidatCE = $this->_request->getParamByKey('souhcandidatce_Saisie');
	$bSouhCandidatCA = $this->_request->getParamByKey('souhcandidatca_Saisie');
	$bSouhDelegue = $this->_request->getParamByKey('souhdelegue_Saisie');
	$bSouhDelClasse = $this->_request->getParamByKey('souhdelclasse_Saisie');
	$bSouhNewsletter = $this->_request->getParamByKey('souhnewsletter_Saisie');
	$iIdDepartement = $this->_request->getParamByKey('id_departement_Saisie');

 
	// ******************************************
	// Ouverture du cadre.
	// ******************************************
	add_cadre_open_form("updateparent", "soumettre", "formulairePrincipale"); 
	echo '<h1><img class="fcpe" alt="logo" src="public/images/fcpe.png">&nbsp;&nbsp;Modifier les données du/des parent(s)</h1>';
    echo '<br/>';
	echo _("vbo_activiteajouter_obligatoire");
	echo '<br/>';
	echo '<br/>';
	
	echo '<label for="departement_Saisie" class="control-label">Département</label>';
	echo '<select name="departement_Saisie" id="departement_Saisie" class="departement_Saisie form-control">';
	if ($rdsDepartement) {
		// Parcours des enregistrements.	
		while (!$rdsDepartement->EOF) {
	
			$strChecked = '';
			if ($iIdDepartement == $rdsDepartement->fields['id']) $strChecked = ' selected="selected" ';
	
			echo '<option ' . $strChecked . ' value="' . $rdsDepartement->fields['id'] . '">' . $rdsDepartement->fields['nom'] . '</option>';
			
			// Changement d'enregistrement.
			$rdsDepartement->MoveNext();
		}
	}
	echo '</select>';
	echo '<br/>';
	
	echo '<label for="etablissementNo_Saisie" class="control-label">Etablissement</label>';
	echo '<select name="etablissementNo_Saisie" id="etablissementNo_Saisie" class="etablissementNo_Saisie form-control">';
	if ($rdsEtablissement) {
		// Parcours des enregistrements.	
		while (!$rdsEtablissement->EOF) {
	
			$strChecked = '';
			if ($iIdEtablissement == $rdsEtablissement->fields['id_etatnorma']) $strChecked = ' selected="selected" ';
	
			echo '<option ' . $strChecked . ' value="' . $rdsEtablissement->fields['id_etatnorma'] . '|' . $rdsEtablissement->fields['lien_niveauadhesion'] . '">' . $rdsEtablissement->fields['nom'] . ' - ' . $rdsEtablissement->fields['code_postal'] . ' ' . $rdsEtablissement->fields['commune'] . '</option>';
			
			// Changement d'enregistrement.
			$rdsEtablissement->MoveNext();
		}
	}
	echo '</select>';
	echo '<input type="hidden" value="' . $iIdEtablissement . '" class="id_etatnorma_Saisie" name="id_etatnorma_Saisie" id="id_etatnorma_Saisie"/>';
	echo '<input type="hidden" value="' . $strReference . '" class="reference_Saisie" name="reference_Saisie" id="reference_Saisie"/>';
	echo '<br/>';
	echo '<br/>';
	echo '<hr/>';
	
	echo '<strong>Parent principal :</strong>';
	echo '<br/>';
	echo '<br/>';
	echo '<label for="nom_Saisie" class="control-label">Nom*</label>';
	echo '<input name="nom_Saisie" id="nom_Saisie" placeholder="Nom" value="' . $strNom . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	
	echo '<label for="prenom_Saisie" class="control-label">Prénom*</label>';
	echo '<input name="prenom_Saisie" id="prenom_Saisie" placeholder="Prénom" value="' . $strPrenom . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	
	echo '<label for="civilite_Saisie" class="control-label">Civilité</label>';
	echo '<select name="civilite_Saisie" id="civilite_Saisie" class="form-control">';
	echo '<option>Monsieur</option>';
	echo '<option>Madame</option>';
	echo '</select>';
	echo '<br/>';
	echo '<br/>';
	echo '<hr/>';
	echo '<strong>Deuxième parent :</strong>';
	echo '<br/>';
	echo '<br/>';
	echo '<label for="nom2_Saisie" class="control-label">Nom</label>';
	echo '<input name="nom2_Saisie" id="nom2_Saisie" placeholder="Nom" value="' . $strNom2 . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	
	echo '<label for="prenom2_Saisie" class="control-label">Prénom</label>';
	echo '<input name="prenom2_Saisie" id="prenom2_Saisie" placeholder="Prénom" value="' . $strPrenom2 . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	
	echo '<label for="civilite2_Saisie" class="control-label">Civilité</label>';
	echo '<select name="civilite2_Saisie" id="civilite2_Saisie" class="form-control">';
	echo '<option>Monsieur</option>';
	echo '<option>Madame</option>';
	echo '</select>';
	echo '<br/>';
	echo '<hr/>';
	echo '<label for="adresse1_Saisie" class="control-label">N° + voie</label>';
	echo '<input name="adresse1_Saisie" id="adresse1_Saisie" placeholder="N° + voie" value="' . $strAdresse1 . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	echo '<label for="adresse2_Saisie" class="control-label">Apt,…</label>';
	echo '<input name="adresse2_Saisie" id="adresse2_Saisie" placeholder="Apt,…" value="' . $strAdresse2 . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	echo '<label for="adresse3_Saisie" class="control-label">Bat, immeuble,….</label>';
	echo '<input name="adresse3_Saisie" id="adresse3_Saisie" placeholder="Bat, immeuble,…." value="' . $strAdresse3 . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	echo '<label for="adresse4_Saisie" class="control-label">BP/Lieu dit</label>';
	echo '<input name="adresse4_Saisie" id="adresse4_Saisie" placeholder="BP/Lieu dit" value="' . $strAdresse4 . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	echo '<label for="commune_Saisie" class="control-label">Commune* (saisir les premières lettres de votre commune et sélectionner dans la liste)</label>';
	echo '<input name="commune_Saisie" id="commune_Saisie" placeholder="Commune" value="' . $strCommune . '" class="commune_Saisie form-control input-sm" type="text" maxlength="255"> ';
	echo '<input type="hidden" value="' . $iIdCommune . '" name="id_commune_Saisie" id="id_commune_Saisie" class="id_commune_Saisie"/>';
	echo '<br/>';
	echo '<label for="codepostal_Saisie" class="control-label">Code postal</label>';
	echo '<input readonly="readonly" name="codepostal_Saisie" id="codepostal_Saisie" placeholder="Code postal veuillez saisir votre commune" value="' . $strCodePostal . '" class="codepostal_Saisie form-control input-sm" type="text" maxlength="5"> ';
	echo '<br/>';
	echo '<br/>';
	
	echo '<label for="telephone_Saisie" class="control-label">Téléphone</label>';
	echo '<input name="telephone_Saisie" id="telephone_Saisie" placeholder="Téléphone" value="' . $strTelephone . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	echo '<label for="portable_Saisie" class="control-label">Portable</label>';
	echo '<input name="portable_Saisie" id="portable_Saisie" placeholder="Portable" value="' . $strPortable . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	echo '<label for="email_Saisie" class="control-label">Email</label>';
	echo '<input name="email_Saisie" id="email_Saisie" placeholder="Email" value="' . $strEmail . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	echo '<label for="email2_Saisie" class="control-label">Email 2</label>';
	echo '<input name="email2_Saisie" id="email2_Saisie" placeholder="Email 2" value="' . $strEmail2 . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	echo '<br/>';
	

	echo '<label for="niveauNo_Saisie" class="control-label">Niveau adhésion</label>';
	echo '<select name="niveauNo_Saisie" id="niveauNo_Saisie" class="niveauNo_Saisie form-control">';
	
	$iParticularite = 0;
	
	echo $iIdNiveauAdhesion;
	
	if ($rdsNiveauAdhesion) {
		// Parcours des enregistrements.	
		while (!$rdsNiveauAdhesion->EOF) {
	
			$strChecked = '';
			if ($iIdNiveauAdhesion == $rdsNiveauAdhesion->fields['id']){
				$strChecked = ' selected="selected" ';
				$iParticularite = $rdsNiveauAdhesion->fields['particularite'];
			}
			
			echo '<option ' . $strChecked . ' value="' . $rdsNiveauAdhesion->fields['id'] . '|' . intval($rdsNiveauAdhesion->fields['particularite']) . '">' . $rdsNiveauAdhesion->fields['libelle'] . ' - ' . $rdsNiveauAdhesion->fields['montant'] . '&euro;</option>';
			
			// Changement d'enregistrement.
			$rdsNiveauAdhesion->MoveNext();
		}
	}
	echo '</select>';
	echo '<input type="hidden" value="' . $iIdNiveauAdhesion . '" name="niveau_Saisie" id="niveau_Saisie" class="niveau_Saisie"/>';
	echo '<input type="hidden" value="' . $iParticularite . '" name="particularite_Saisie" id="particularite_Saisie" class="particularite_Saisie"/>';
	echo '<br/>';
	
	$strAffichageAutreFCPE = "";
	if ($iParticularite == 0){
		$strAffichageAutreFCPE = 'display:none;';
		$strNomAutreFCPE = '';
	}else{
		$strAffichageAutreFCPE = 'display:block;';
	}
	
	echo '<div class="container_autrefcpe" style="' . $strAffichageAutreFCPE . '">';
		echo '<label for="nomautrefcpe_Saisie" class="control-label">Nom autre FCPE</label>';
		echo '<input name="nomautrefcpe_Saisie" id="nomautrefcpe_Saisie" placeholder="Nom autre FCPE" value="' . $strNomAutreFCPE . '" class="form-control input-sm" type="text" maxlength="255" />';
	echo '</div>';
	echo '<br/>';
	
	/*
	$strChecked = '';
    if ($bAdhesionHorsCL) $strChecked = ' checked="checked" ';
	echo '<label class="checkbox-inline">';
	echo '<input type="checkbox" name="adhesionhorscl_Saisie" id="adhesionhorscl_Saisie" value="1" ' . $strChecked . '/><strong>Adhérent dans un autre conseil local</strong>';
	echo '</label>';
	echo '<br/>';
	*/
	
	$strChecked = '';
    if ($bAboRP) $strChecked = ' checked="checked" ';
	echo '<label class="checkbox-inline">';
	echo '<input type="checkbox" name="aborp_Saisie" id="aborp_Saisie" value="1" ' . $strChecked . '/><strong>Abonnement à la Revue des Parents  (3.35 &euro;)</strong>';
	echo '</label>';
	echo '<br/>';
	
	/*
	$strChecked = '';
    if ($bAboFE) $strChecked = ' checked="checked" ';
	echo '<label class="checkbox-inline">';
	echo '<input type="checkbox" name="abofe_Saisie" id="abofe_Saisie" value="1" ' . $strChecked . '/><strong>Abonnement à la Famille et l\'Ecole (13.00 &euro;)</strong>';
	echo '</label>';
	echo '<br/>';	
	
	$strChecked = '';
    if ($bSouhPartCL) $strChecked = ' checked="checked" ';
	echo '<label class="checkbox-inline">';
	echo '<input type="checkbox" name="souhpartcl_Saisie" id="souhpartcl_Saisie" value="1" ' . $strChecked . '/><strong>Adhérent dans un autre Conseil Local FCPE</strong>';
	echo '</label>';
	echo '<br/>';
	*/
	
	$strChecked = '';
    if ($bSouhCandidatCA) $strChecked = ' checked="checked" ';
	echo '<label class="checkbox-inline">';
	echo '<input type="checkbox" name="souhcandidatca_Saisie" id="souhcandidatca_Saisie" value="1" ' . $strChecked . '/><strong>Souhaite être candidat au conseil d\'administration</strong>';
	echo '</label>';
	echo '<br/>';	
	$strChecked = '';
    if ($bSouhDelClasse) $strChecked = ' checked="checked" ';
	echo '<label class="checkbox-inline">';
	echo '<input type="checkbox" name="souhdelclasse_Saisie" id="souhdelclasse_Saisie" value="1" ' . $strChecked . '/><strong>Souhaite être délégué de classe</strong>';
	echo '</label>';
	echo '<br/>';
	$strChecked = '';
    if ($bSouhNewsletter) $strChecked = ' checked="checked" ';
	echo '<label class="checkbox-inline">';
	echo '<input type="checkbox" name="souhnewsletter_Saisie" id="souhnewsletter_Saisie" value="1" ' . $strChecked . '/><strong>Newsletter</strong>';
	echo '</label>';
	echo '<br/>';	
	
	// ******************************************
	// Cadre de validation.
	// ******************************************
	echo '<br/>';
	echo '<br/>';
	echo '<button type="submit" id="btnLogin" class="btn btn-success">' . _("vbo_activitemodifier_valider") . '</button>';
	echo '<br/>';

	// Fermer le form.
	add_cadre_close_form();
	echo '<br/>';	
?>