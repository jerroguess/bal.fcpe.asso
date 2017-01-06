<?PHP

/*
  --------------------------------------------------------------------
  view.bo.departement.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    // Chargement des données.
    $rdsDepartement = $this->_request->getParamByKey('rdsDepartement');

    $boReturn->departements = array();
    
    if ($rdsDepartement) {
        // Parcours des enregistrements.	
        while (!$rdsDepartement->EOF) {

            // Objet de retour.
            $boItem = new common_AjaxItem();
            $boItem->id = intval($rdsDepartement->fields["id"]);
            $boItem->code = htmlentities($rdsCategory->fields["code"]);
			$boItem->nom = htmlentities($rdsCategory->fields["nom"]);
            array_push($boReturn->departements, $boItem);

            // Changement d'enregistrement.
            $rdsDepartement->MoveNext();
        }
    }

    class common_AjaxItem {

        public function __construct() {

        }

        public $id;
        public $code;
		public $nom;
    }

?>