<?PHP

/*
  --------------------------------------------------------------------
  view.bo.updatechildren.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	$rdsTartanpion = $this->_request->getParamByKey('rdsTartanpion');
	$rdsDepartement = $this->_request->getParamByKey('rdsDepartement');
    $rdsParent = $this->_request->getParamByKey('rdsParent');
	$rdsExploration = $this->_request->getParamByKey('rdsExploration');
	$strEtablissement = $this->_request->getParamByKey('nometablissement_Saisie');
	$iIdEtablissement = $this->_request->getParamByKey('id_etatnorma_Saisie');
	$rdsEtablissement = $this->_request->getParamByKey('rdsEtablissement');
	$strReference = $this->_request->getParamByKey('reference_Saisie');
	
	$strNom = $this->_request->getParamByKey('nom_Saisie');
	$strPrenom = $this->_request->getParamByKey('prenom_Saisie');
	$strSection = $this->_request->getParamByKey('section_Saisie');
	$strTelephone = $this->_request->getParamByKey('telephone_Saisie');
	$strEmail = $this->_request->getParamByKey('email_Saisie');
	$strLV1 = $this->_request->getParamByKey('lv1_Saisie');
	$strLV2 = $this->_request->getParamByKey('lv2_Saisie');
	$strLV3 = $this->_request->getParamByKey('lv3_Saisie');
	$dateNaissance = $this->_request->getParamByKey('dateNaissance_Saisie');
	$iIdClasse = $this->_request->getParamByKey('classe_Saisie');
	$iIdDepartement = $this->_request->getParamByKey('id_departement_Saisie');
	$iAffichage = $this->_request->getParamByKey('affichage');
 
	$iIdExploration1 = $this->_request->getParamByKey('exploration1_Saisie');
	$iIdExploration2 = $this->_request->getParamByKey('exploration2_Saisie');
	$iIdExploration3 = $this->_request->getParamByKey('exploration3_Saisie');
 
	// ******************************************
	// Ouverture du cadre.
	// ******************************************
	add_cadre_open_form("updatechildren", "soumettre", "formulairePrincipale");
	echo '<input type="hidden" value="' . $iAffichage . '" name="affichage" id="affichage" />';		
	echo '<h1><img class="fcpe" alt="logo" src="public/images/fcpe.png">&nbsp;&nbsp;Modifier un enfant</h1>';
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
	

	echo '<label for="nom_Saisie" class="control-label">Nom</label>';
	echo '<input name="nom_Saisie" id="nom_Saisie" placeholder="Nom" value="' . $strNom . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	
	echo '<label for="prenom_Saisie" class="control-label">Prénom</label>';
	echo '<input name="prenom_Saisie" id="prenom_Saisie" placeholder="Prénom" value="' . $strPrenom . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
		
	echo '<label for="dateNaissance_Saisie" class="control-label">Date de naissance (jj/mm/aaaa)</label>';
	echo '<input name="dateNaissance_Saisie" id="dateNaissance_Saisie" placeholder="jj/mm/aaaa" value="' . $dateNaissance . '" class="form-control input-sm" type="text" maxlength="10"> ';
	echo '<br/>';
	
	echo '<label for="telephone_Saisie" class="control-label">Téléphone</label>';
	echo '<input name="telephone_Saisie" id="telephone_Saisie" placeholder="Téléphone" value="' . $strTelephone . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	echo '<label for="email_Saisie" class="control-label">Email</label>';
	echo '<input name="email_Saisie" id="email_Saisie" placeholder="Email" value="' . $strEmail . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	
	echo '<label for="classe_Saisie" class="control-label">Classe</label>';
	echo '<select name="classe_Saisie" id="classe_Saisie" class="form-control">';
	$iExploration = 0;
	if ($rdsTartanpion) {
		// Parcours des enregistrements.	
		while (!$rdsTartanpion->EOF) {
	
			$strChecked = '';
			if ($iIdClasse == $rdsTartanpion->fields['id']){ 
				$strChecked = ' selected="selected" ';
				$iExploration = $rdsTartanpion->fields['exploration'];
			}
	
			echo '<option ' . $strChecked . ' value="' . $rdsTartanpion->fields['id'] . '">' . $rdsTartanpion->fields['nom'] . '</option>';
			
			// Changement d'enregistrement.
			$rdsTartanpion->MoveNext();
		}
	}
	echo '</select>';
	echo '<br/>';	
	echo '<label for="section_Saisie" class="control-label">Section</label>';
	echo '<input name="section_Saisie" id="section_Saisie" placeholder="Section" value="' . $strSection . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	
	echo '<label for="lv1_Saisie" class="control-label">LV1</label>';
	echo '<input name="lv1_Saisie" id="lv1_Saisie" placeholder="LV1" value="' . $strLV1 . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	echo '<label for="lv2_Saisie" class="control-label">LV2</label>';
	echo '<input name="lv2_Saisie" id="lv2_Saisie" placeholder="LV2" value="' . $strLV2 . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	echo '<label for="lv3_Saisie" class="control-label">LV3</label>';
	echo '<input name="lv3_Saisie" id="lv3_Saisie" placeholder="LV3" value="' . $strLV3 . '" class="form-control input-sm" type="text" maxlength="255"> ';
	echo '<br/>';
	
	if ($iExploration == 1) {
		echo '<div id="exploration">';
	}else{
		echo '<div id="exploration" style="display:none;">';
	}
		echo '<label for="exploration1_Saisie" class="control-label">Enseignement d\'exploration n°1</label>';
		echo '<select name="exploration1_Saisie" id="exploration1_Saisie" class="exploration1_Saisie form-control">';
			echo '<option value="">Choisir un enseignement</option>';
		if ($rdsExploration) {
			// Parcours des enregistrements.	
			while (!$rdsExploration->EOF) {
		
				$strChecked = '';
				if (intval($iIdExploration1) == intval($rdsExploration->fields['id_exploration'])) $strChecked = ' selected="selected" ';
		
				echo '<option ' . $strChecked . ' value="' . $rdsExploration->fields['id_exploration'] . '">' . $rdsExploration->fields['libelle'] . '</option>';
				
				// Changement d'enregistrement.
				$rdsExploration->MoveNext();
			}
		}
		$rdsExploration->MoveFirst();
		echo '</select>';
		echo '<br/>';
		
		echo '<label for="exploration2_Saisie" class="control-label">Enseignement d\'exploration n°2</label>';
		echo '<select name="exploration2_Saisie" id="exploration2_Saisie" class="exploration2_Saisie form-control">';
			echo '<option value="">Choisir un enseignement</option>';
		if ($rdsExploration) {
			// Parcours des enregistrements.	
			while (!$rdsExploration->EOF) {
		
				$strChecked = '';
				if (intval($iIdExploration2) == intval($rdsExploration->fields['id_exploration'])) $strChecked = ' selected="selected" ';
		
				echo '<option ' . $strChecked . ' value="' . $rdsExploration->fields['id_exploration'] . '">' . $rdsExploration->fields['libelle'] . '</option>';
				
				// Changement d'enregistrement.
				$rdsExploration->MoveNext();
			}
		}
		$rdsExploration->MoveFirst();
		echo '</select>';
		echo '<br/>';
		
		echo '<label for="exploration3_Saisie" class="control-label">Enseignement d\'exploration n°3</label>';
		echo '<select name="exploration3_Saisie" id="exploration3_Saisie" class="exploration3_Saisie form-control">';
			echo '<option value="">Choisir un enseignement</option>';
		if ($rdsExploration) {
			// Parcours des enregistrements.	
			while (!$rdsExploration->EOF) {
		
				$strChecked = '';
				if (intval($iIdExploration3) == intval($rdsExploration->fields['id_exploration'])) $strChecked = ' selected="selected" ';
		
				echo '<option ' . $strChecked . ' value="' . $rdsExploration->fields['id_exploration'] . '">' . $rdsExploration->fields['libelle'] . '</option>';
				
				// Changement d'enregistrement.
				$rdsExploration->MoveNext();
			}
		}
		$rdsExploration->MoveFirst();
		echo '</select>';
		echo '<br/>';
		
	echo '</div>';
	
	
	// ******************************************
	// Cadre de validation.
	// ******************************************
	echo '<br/>';
	echo '<br/>';
	echo '<button type="submit" id="btnLogin" class="btn btn-success">Valider modification</button>';
	echo '<br/>';

	// Fermer le form.
	add_cadre_close_form();
	echo '<br/>';	
?>