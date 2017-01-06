<?PHP

/*
  --------------------------------------------------------------------
  view.bo.exportertotal.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	// Chargement des données.
	$rdsClasse = $this->_request->getParamByKey('rdsClasse');
	$rdsCommune = $this->_request->getParamByKey('rdsCommune');
	$rdsEnfant = $this->_request->getParamByKey('rdsEnfant');
	$rdsEtablissement = $this->_request->getParamByKey('rdsEtablissement');
	$rdsNiveauAdhesion = $this->_request->getParamByKey('rdsNiveauAdhesion');
	$rdsExploration = $this->_request->getParamByKey('rdsExploration');
	$rdsDepartement = $this->_request->getParamByKey('rdsDepartement');
	$rdsParent = $this->_request->getParamByKey('rdsParent');
	

	// Boucle sur les lignes.
	if ($rdsClasse->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsClasse->EOF) {
			echo sprintf("INSERT INTO `classe` (`id`,`nom`,`exploration`)VALUES(%s, '%s', %s);", 
				$rdsClasse->fields['id'], 
				addslashes($rdsClasse->fields['nom']),
				$rdsClasse->fields['exploration']);
			echo "\n";
			// Changement d'enregistrement.
			$rdsClasse->MoveNext();
		}
	}

	// Boucle sur les lignes.
	if ($rdsCommune->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsCommune->EOF) {
			echo sprintf("INSERT INTO `commune` (`id`,`insee`,`commune`,`code_postal`,`pays`)VALUES(%s, '%s', '%s', '%s', '%s');", 
			$rdsCommune->fields['id'], 
			$rdsCommune->fields['insee'], 
			addslashes($rdsCommune->fields['commune']), 
			$rdsCommune->fields['code_postal'], 
			addslashes($rdsCommune->fields['pays']));
			echo "\n";
			// Changement d'enregistrement.
			$rdsCommune->MoveNext();
		}
	}
	
	// Boucle sur les lignes.
	if ($rdsEnfant->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsEnfant->EOF) {
			echo sprintf("INSERT INTO `enfant` (`id`,`id_parent`,`id_utilisateur`,`id_etatnorma`,`id_classe`,`nom`,`prenom`,`section`,`telephone`,`email`,`lv1`,`lv2`,`lv3`,`date_naissance`,`exploration1`,`exploration2`,`exploration3`)VALUES(%s, %s, %s, %s, %s, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',%s, %s, %s);", 
			$rdsEnfant->fields['id'], 
			$rdsEnfant->fields['id_parent'], 
			$rdsEnfant->fields['id_utilisateur'], 
			$rdsEnfant->fields['id_etatnorma'], 
			$rdsEnfant->fields['id_classe'], 
			addslashes($rdsEnfant->fields['nom']), 
			addslashes($rdsEnfant->fields['prenom']), 
			addslashes($rdsEnfant->fields['section']), 
			addslashes($rdsEnfant->fields['telephone']), 
			addslashes($rdsEnfant->fields['email']), 
			addslashes($rdsEnfant->fields['lv1']), 
			addslashes($rdsEnfant->fields['lv2']), 
			addslashes($rdsEnfant->fields['lv3']), 
			addslashes($rdsEnfant->fields['date_naissance']), 
			$rdsEnfant->fields['exploration1'], 
			$rdsEnfant->fields['exploration2'], 
			$rdsEnfant->fields['exploration3']);
			echo "\n";
			// Changement d'enregistrement.
			$rdsEnfant->MoveNext();
		}
	}
	
	// Boucle sur les lignes.
	if ($rdsEtablissement->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsEtablissement->EOF) {
			echo sprintf("INSERT INTO `etablissement` (`id`,`id_etatnorma`,`nom`,`id_departement`,`lien_niveauadhesion`,`id_commune`,`etatbal`)VALUES(%s, %s, '%s', %s, '%s', %s, %s);", 
			$rdsEtablissement->fields['id'], 
			$rdsEtablissement->fields['id_etatnorma'], 
			addslashes($rdsEtablissement->fields['nom']), 
			$rdsEtablissement->fields['id_departement'], 
			$rdsEtablissement->fields['lien_niveauadhesion'], 
			$rdsEtablissement->fields['id_commune'], 
			$rdsEtablissement->fields['etatbal']);
			echo "\n";
			// Changement d'enregistrement.
			$rdsEtablissement->MoveNext();
		}
	}
	
	// Boucle sur les lignes.
	if ($rdsNiveauAdhesion->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsNiveauAdhesion->EOF) {
			echo sprintf("INSERT INTO `niveauadhesion` (`id`,`libelle`,`montant`,`commentaires`,`lien`,`particularite`,`position`)VALUES(%s, '%s', '%s', '%s', '%s', '%s', %s);", 
			$rdsNiveauAdhesion->fields['id'], 
			addslashes($rdsNiveauAdhesion->fields['libelle']), 
			addslashes($rdsNiveauAdhesion->fields['montant']), 
			addslashes($rdsNiveauAdhesion->fields['commentaires']), 
			addslashes($rdsNiveauAdhesion->fields['lien']), 
			intval($rdsNiveauAdhesion->fields['particularite']), 
			intval($rdsNiveauAdhesion->fields['position']));
			echo "\n";
			// Changement d'enregistrement.
			$rdsNiveauAdhesion->MoveNext();
		}
	}

	// Boucle sur les lignes.
	if ($rdsParent->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsParent->EOF) {
			echo sprintf("INSERT INTO `parent` (`id`,`id_etatnorma`,`id_utilisateur`,`nom`,`prenom`,`civilite`,`nom2`,`prenom2`,`civilite2`,`adresse1`,`adresse2`,`adresse3`,`adresse4`,`code_postal`,`id_commune`,`adhesion_hors_cl`,`id_adhesion`,`nom_autre_fcpe`,`abo_rp`,`abo_fe`,`telephone`,`portable`,`email`,`email2`,`souh_part_cl`,`souh_candidat_ce`,`souh_candidat_ca`,`souh_delegue`,`souh_del_classe`,`souh_newsletter`)VALUES(%s, %s, %s, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %s, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');", 
			$rdsParent->fields['id'],
			$rdsParent->fields['id_etatnorma'],
			$rdsParent->fields['id_utilisateur'],
			addslashes($rdsParent->fields['nom']),
			addslashes($rdsParent->fields['prenom']),
			addslashes($rdsParent->fields['civilite']),
			addslashes($rdsParent->fields['nom2']),
			addslashes($rdsParent->fields['prenom2']),
			addslashes($rdsParent->fields['civilite2']),
			addslashes($rdsParent->fields['adresse1']),
			addslashes($rdsParent->fields['adresse2']),
			addslashes($rdsParent->fields['adresse3']),
			addslashes($rdsParent->fields['adresse4']),
			$rdsParent->fields['code_postal'],
			$rdsParent->fields['id_commune'],
			intval($rdsParent->fields['adhesion_hors_cl']),
			$rdsParent->fields['id_adhesion'],
			addslashes($rdsParent->fields['nom_autre_fcpe']),
			intval($rdsParent->fields['abo_rp']),
			intval($rdsParent->fields['abo_fe']),
			addslashes($rdsParent->fields['telephone']),
			addslashes($rdsParent->fields['portable']),
			addslashes($rdsParent->fields['email']),
			addslashes($rdsParent->fields['email2']),
			intval($rdsParent->fields['souh_part_cl']),
			intval($rdsParent->fields['souh_candidat_ce']),
			intval($rdsParent->fields['souh_candidat_ca']),
			intval($rdsParent->fields['souh_delegue']),
			intval($rdsParent->fields['souh_del_classe']),
			intval($rdsParent->fields['souh_newsletter']));
			echo "\n";
			// Changement d'enregistrement.
			$rdsParent->MoveNext();
		}
	}
		
	// Boucle sur les lignes.
	if ($rdsExploration->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsExploration->EOF) {
			echo sprintf("INSERT INTO `exploration` (`id_exploration`,`libelle`,`rang`,`enfant`,`intitule`,`affichage`)VALUES(%s, '%s', %s, %s, '%s', %s);", 
			$rdsExploration->fields['id_exploration'], 
			addslashes($rdsExploration->fields['libelle']), 
			$rdsExploration->fields['rang'], 
			$rdsExploration->fields['enfant'], 
			addslashes($rdsExploration->fields['intitule']), 
			$rdsExploration->fields['affichage']);
			echo "\n";
			// Changement d'enregistrement.
			$rdsExploration->MoveNext();
		}
	}

	// Boucle sur les lignes.
	if ($rdsDepartement->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsDepartement->EOF) {
			echo sprintf("INSERT INTO `departement` (`id`,`code`,`nom`)VALUES(%s, '%s', '%s');", 
			$rdsDepartement->fields['id'], 
			addslashes($rdsDepartement->fields['code']), 
			addslashes($rdsDepartement->fields['nom']));
			echo "\n";
			// Changement d'enregistrement.
			$rdsDepartement->MoveNext();
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>