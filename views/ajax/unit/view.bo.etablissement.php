<?PHP

/*
  --------------------------------------------------------------------
  view.bo.etablissement.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    // Chargement des données.
    $rdsEtablissement = $this->_request->getParamByKey('rdsEtablissement');

    $boReturn->etablissements = array();
    
    if ($rdsEtablissement) {
        // Parcours des enregistrements.	
        while (!$rdsEtablissement->EOF) {

            // Objet de retour.
            $boItem = new common_AjaxItem();
            $boItem->id = intval($rdsEtablissement->fields["id_etatnorma"]);
            $boItem->nom = htmlentities($rdsEtablissement->fields["nom"]);
			$boItem->commune = htmlentities($rdsEtablissement->fields["commune"]);
			$boItem->code_postal = htmlentities($rdsEtablissement->fields["code_postal"]);
			$boItem->lien = $rdsEtablissement->fields["lien_niveauadhesion"];
            array_push($boReturn->etablissements, $boItem);

            // Changement d'enregistrement.
            $rdsEtablissement->MoveNext();
        }
    }
        
    class common_AjaxItem {

        public function __construct() {

        }

        public $id;
        public $nom;
		public $commune;
		public $code_postal;
		public $lien;
    }

?>