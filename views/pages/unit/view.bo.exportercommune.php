<?PHP

/*
  --------------------------------------------------------------------
  view.bo.exportercommune.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	// Chargement des données.
	$rdsCommune = $this->_request->getParamByKey('rdsCommune');
	
	// Créer un pointeur de fichier reliée à la sortie.
	$output = fopen('php://output', 'w');

	// Sortie des entêtes de colonne.
	fputcsv($output, array(
		'id',
		'insee',
		'commune',
		'code_postal',
		'pays'), ';');

	// Boucle sur les lignes.
	if ($rdsCommune->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsCommune->EOF) {
			fputcsv($output, array(
				$rdsCommune->fields['id'], 
				$rdsCommune->fields['insee'], 
				$rdsCommune->fields['commune'], 
				$rdsCommune->fields['code_postal'],
				$rdsCommune->fields['pays']), ';');
			// Changement d'enregistrement.
			$rdsCommune->MoveNext();
		}
	}
	
?>