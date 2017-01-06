<?PHP

/*
  --------------------------------------------------------------------
  view.bo.niveauadhesion.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    // Chargement des données.
    $rdsNiveauAdhesion = $this->_request->getParamByKey('rdsNiveauAdhesion');

    $boReturn->niveaux = array();
  
    if ($rdsNiveauAdhesion) {
        // Parcours des enregistrements.	
        while (!$rdsNiveauAdhesion->EOF) {

            // Objet de retour.
            $boItem = new common_AjaxItem();
            $boItem->id = intval($rdsNiveauAdhesion->fields["id"]);
            $boItem->libelle = htmlentities(utf8_encode($rdsNiveauAdhesion->fields["libelle"]));
			$boItem->montant = htmlentities($rdsNiveauAdhesion->fields["montant"]);
			$boItem->particularite = intval($rdsNiveauAdhesion->fields["particularite"]);
            array_push($boReturn->niveaux, $boItem);

            // Changement d'enregistrement.
            $rdsNiveauAdhesion->MoveNext();
        }
    }
        
    class common_AjaxItem {

        public function __construct() {

        }

        public $id;
        public $libelle;
		public $montant;
		public $particularite;
    }

?>