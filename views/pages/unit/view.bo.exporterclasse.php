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

	// Chargement des donn�es.
	$rdsClasse = $this->_request->getParamByKey('rdsClasse');
	
	// Cr�er un pointeur de fichier reli�e � la sortie.
	$output = fopen('php://output', 'w');

	// Sortie des ent�tes de colonne.
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