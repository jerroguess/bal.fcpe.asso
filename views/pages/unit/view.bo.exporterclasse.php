<?PHP

/*
  --------------------------------------------------------------------
  view.bo.exporterclasse.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	// Chargement des données.
	$rdsClasse = $this->_request->getParamByKey('rdsClasse');
	
	// Créer un pointeur de fichier reliée à la sortie.
	$output = fopen('php://output', 'w');

	// Sortie des entêtes de colonne.
	fputcsv($output, array('id', 'nom', 'exploration'), ';');

	// Boucle sur les lignes.
	if ($rdsClasse->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsClasse->EOF) {
			fputcsv($output, array($rdsClasse->fields['id'], $rdsClasse->fields['nom'], $rdsClasse->fields['exploration']), ';');
			// Changement d'enregistrement.
			$rdsClasse->MoveNext();
		}
	}
	
?>