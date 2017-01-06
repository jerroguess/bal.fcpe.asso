<?PHP

/*
  --------------------------------------------------------------------
  view.bo.exporterenfant.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	// Chargement des données.
	$rdsEnfant = $this->_request->getParamByKey('rdsEnfant');
	
	// Créer un pointeur de fichier reliée à la sortie.
	$output = fopen('php://output', 'w');

	// Sortie des entêtes de colonne.
	fputcsv($output, array(
		'id',
		'id_parent',
		'id_utilisateur',
		'id_etatnorma',
		'id_classe',
		'nom',
		'prenom',
		'section',
		'telephone',
		'email',
		'lv1',
		'lv2',
		'lv3',
		'date_naissance',
		'exploration1',
		'exploration2',
		'exploration3'), ';');

	// Boucle sur les lignes.
	if ($rdsEnfant->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsEnfant->EOF) {
			fputcsv($output, array(
				$rdsEnfant->fields['id'], 
				$rdsEnfant->fields['id_parent'], 
				$rdsEnfant->fields['id_utilisateur'], 
				$rdsEnfant->fields['id_etatnorma'],
				$rdsEnfant->fields['id_classe'],
				$rdsEnfant->fields['nom'],
				$rdsEnfant->fields['prenom'],
				$rdsEnfant->fields['section'],
				$rdsEnfant->fields['telephone'],
				$rdsEnfant->fields['email'],
				$rdsEnfant->fields['lv1'],
				$rdsEnfant->fields['lv2'],
				$rdsEnfant->fields['lv3'],
				$rdsEnfant->fields['date_naissance'],
				$rdsEnfant->fields['exploration1'],
				$rdsEnfant->fields['exploration2'],
				$rdsEnfant->fields['exploration3']), ';');
			// Changement d'enregistrement.
			$rdsEnfant->MoveNext();
		}
	}
	
?>