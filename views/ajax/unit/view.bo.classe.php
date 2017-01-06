<?PHP

/*
  --------------------------------------------------------------------
  view.bo.classe.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    // Chargement des données.
    $rdsClasse = $this->_request->getParamByKey('rdsClasse');

    if ($rdsClasse) {
        // Parcours des enregistrements.	
        while (!$rdsClasse->EOF) {

			// Positionnement des données.
			$boReturn->exploration = intval($rdsClasse->fields["exploration"]);
	
            // Changement d'enregistrement.
            $rdsClasse->MoveNext();
        }
    }

?>