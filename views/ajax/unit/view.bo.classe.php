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

    // Chargement des donn�es.
    $rdsClasse = $this->_request->getParamByKey('rdsClasse');

    if ($rdsClasse) {
        // Parcours des enregistrements.	
        while (!$rdsClasse->EOF) {

			// Positionnement des donn�es.
			$boReturn->exploration = intval($rdsClasse->fields["exploration"]);
	
            // Changement d'enregistrement.
            $rdsClasse->MoveNext();
        }
    }

?>