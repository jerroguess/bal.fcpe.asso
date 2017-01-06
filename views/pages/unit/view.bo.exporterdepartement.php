<?PHP

/*
  --------------------------------------------------------------------
  view.bo.exporterdepartement.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	// Chargement des données.
	$rdsDepartement = $this->_request->getParamByKey('rdsDepartement');
	
	// Créer un pointeur de fichier reliée à la sortie.
	$output = fopen('php://output', 'w');

	// Sortie des entêtes de colonne.
	fputcsv($output, array(
		'id',
		'code',
		'nom'), ';');

	// Boucle sur les lignes.
	if ($rdsDepartement->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsDepartement->EOF) {
			fputcsv($output, array(
				$rdsDepartement->fields['id'], 
				$rdsDepartement->fields['code'], 
				$rdsDepartement->fields['nom']), ';');
			// Changement d'enregistrement.
			$rdsDepartement->MoveNext();
		}
	}
	
?>