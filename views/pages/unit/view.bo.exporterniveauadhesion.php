<?PHP

/*
  --------------------------------------------------------------------
  view.bo.exporterniveauadhesion.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	// Chargement des donn�es.
	$rdsNiveauAdhesion = $this->_request->getParamByKey('rdsNiveauAdhesion');
	
	// Cr�er un pointeur de fichier reli�e � la sortie.
	$output = fopen('php://output', 'w');

	// Sortie des ent�tes de colonne.
	fputcsv($output, array(
		'id',
		'libelle',
		'montant',
		'commentaires',
		'lien',
		'particularite',
		'position'), ';');

	// Boucle sur les lignes.
	if ($rdsNiveauAdhesion->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsNiveauAdhesion->EOF) {
			fputcsv($output, array(
				$rdsNiveauAdhesion->fields['id'], 
				$rdsNiveauAdhesion->fields['libelle'], 
				$rdsNiveauAdhesion->fields['montant'], 
				$rdsNiveauAdhesion->fields['commentaires'], 
				$rdsNiveauAdhesion->fields['lien'], 
				$rdsNiveauAdhesion->fields['particularite'], 
				$rdsNiveauAdhesion->fields['position']), ';');
			// Changement d'enregistrement.
			$rdsNiveauAdhesion->MoveNext();
		}
	}
	
?>