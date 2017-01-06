<?PHP

/*
  --------------------------------------------------------------------
  view.bo.commune.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    // Chargement des données.
    $rdsCitys = $this->_request->getParamByKey('rdsCitys');

    $boReturn->communes = array();
    
    if ($rdsCitys) {
        // Parcours des enregistrements.	
        while (!$rdsCitys->EOF) {

            // Objet de retour.
            $boItem = new common_AjaxItem();
            $boItem->id = intval($rdsCitys->fields["id"]);
            $boItem->commune = htmlentities($rdsCitys->fields["commune"]);
            $boItem->code_postal = $rdsCitys->fields["code_postal"];
            array_push($boReturn->communes, $boItem);

            // Changement d'enregistrement.
            $rdsCitys->MoveNext();
        }
    }
        
    class common_AjaxItem {

        public function __construct() {

        }

        public $id;
        public $commune;
        public $code_postal;
    }

?>