<?PHP

/*
  --------------------------------------------------------------------
  view.bo.exporteretablissement.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	// Chargement des donn�es.
	$rdsEtablissement = $this->_request->getParamByKey('rdsEtablissement');
	
	// Cr�er un pointeur de fichier reli�e � la sortie.
	$output = fopen('php://output', 'w');

	// Sortie des ent�tes de colonne.
	fputcsv($output, array(
		'id',
		'id_etatnorma',
		'nom',
		'id_departement',
		'lien_niveauadhesion',
		'id_commune',
		'etatbal'), ';');

	// Boucle sur les lignes.
	if ($rdsEtablissement->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsEtablissement->EOF) {
			fputcsv($output, array(
				$rdsEtablissement->fields['id'], 
				$rdsEtablissement->fields['id_etatnorma'], 
				$rdsEtablissement->fields['nom'], 
				$rdsEtablissement->fields['id_departement'], 
				$rdsEtablissement->fields['lien_niveauadhesion'], 
				$rdsEtablissement->fields['id_commune'], 
				$rdsEtablissement->fields['etatbal']), ';');
			// Changement d'enregistrement.
			$rdsEtablissement->MoveNext();
		}
	}
	
?>
