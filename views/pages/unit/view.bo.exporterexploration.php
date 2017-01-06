<?PHP

/*
  --------------------------------------------------------------------
  view.bo.exporterexploration.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	// Chargement des données.
	$rdsExploration = $this->_request->getParamByKey('rdsExploration');
	
	// Créer un pointeur de fichier reliée à la sortie.
	$output = fopen('php://output', 'w');

	// Sortie des entêtes de colonne.
	fputcsv($output, array(
		'id_exploration',
		'libelle',
		'rang',
		'enfant',
		'intitule',
		'affichage'), ';');

	// Boucle sur les lignes.
	if ($rdsExploration->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsExploration->EOF) {
			fputcsv($output, array(
				$rdsExploration->fields['id_exploration'], 
				$rdsExploration->fields['libelle'], 
				$rdsExploration->fields['rang'], 
				$rdsExploration->fields['enfant'],
				$rdsExploration->fields['intitule'],
				$rdsExploration->fields['affichage']), ';');
			// Changement d'enregistrement.
			$rdsExploration->MoveNext();
		}
	}
	
?>