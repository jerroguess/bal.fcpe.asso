<?PHP

/*
  --------------------------------------------------------------------
  view.bo.exporterparent.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	// Chargement des données.
	$rdsParent = $this->_request->getParamByKey('rdsParent');
	
	// Créer un pointeur de fichier reliée à la sortie.
	$output = fopen('php://output', 'w');

	// Sortie des entêtes de colonne.
	fputcsv($output, array('id',
					'id_etatnorma',
					'id_utilisateur',
					'nom',
					'prenom',
					'civilite',
					'nom2',
					'prenom2',
					'civilite2',
					'adresse1',
					'adresse2',
					'adresse3',
					'adresse4',
					'code_postal',
					'id_commune',
					'adhesion_hors_cl',
					'id_adhesion',
					'nom_autre_fcpe',
					'abo_rp',
					'abo_fe',
					'telephone',
					'portable',
					'email',
					'email2',
					'souh_part_cl',
					'souh_candidat_ce',
					'souh_candidat_ca',
					'souh_delegue',
					'souh_del_classe',
					'souh_newsletter'), ';');

	// Boucle sur les lignes.
	if ($rdsParent->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsParent->EOF) {
			fputcsv($output, array($rdsParent->fields['id'],
							$rdsParent->fields['id_etatnorma'],
							$rdsParent->fields['id_utilisateur'],
							$rdsParent->fields['nom'],
							$rdsParent->fields['prenom'],
							$rdsParent->fields['civilite'],
							$rdsParent->fields['nom2'],
							$rdsParent->fields['prenom2'],
							$rdsParent->fields['civilite2'],
							$rdsParent->fields['adresse1'],
							$rdsParent->fields['adresse2'],
							$rdsParent->fields['adresse3'],
							$rdsParent->fields['adresse4'],
							$rdsParent->fields['code_postal'],
							$rdsParent->fields['id_commune'],
							$rdsParent->fields['adhesion_hors_cl'],
							$rdsParent->fields['id_adhesion'],
							$rdsParent->fields['nom_autre_fcpe'],
							$rdsParent->fields['abo_rp'],
							$rdsParent->fields['abo_fe'],
							$rdsParent->fields['telephone'],
							$rdsParent->fields['portable'],
							$rdsParent->fields['email'],
							$rdsParent->fields['email2'],
							$rdsParent->fields['souh_part_cl'],
							$rdsParent->fields['souh_candidat_ce'],
							$rdsParent->fields['souh_candidat_ca'],
							$rdsParent->fields['souh_delegue'],
							$rdsParent->fields['souh_del_classe'],
							$rdsParent->fields['souh_newsletter']), ';');
							
			// Changement d'enregistrement.
			$rdsParent->MoveNext();
		}
	}
?>
