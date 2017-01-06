<?PHP

/*
  --------------------------------------------------------------------
  class.bo.ajax.commune.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class boacCommuneController extends boActionAjaxController {
    # ******************************
    # Constructeurs.
    # ******************************

    public function __construct(boRequest $request, boResponse $response) {

        // 1. Appel du constructeur de la classe parente
        parent::__construct($request, $response);
        
        // Chargement Annexe.
        $this->_bLoadAnnexe = true;        
    }

    # ******************************
    # Chargement des variables.
    # ******************************

    protected function _loadVar() {
        $this->_request->defineParam(0, 'commune', '');
        $this->_request->defineParam(1, 'departement', 1);
		
		$this->_request->defineParam(0, 'callback', '');
        $this->_request->defineParam(1, 'rdsCitys', 1);
    }

    # ******************************
    # Actions.
    # ******************************

    public function execute() {

        // Récuperation des variables.
        $strCommune = $this->_request->getParamByKey('commune');
        $iDepartementId = $this->_request->getParamByKey('departement');
        
        // Positionnement du nom.
        $this->_request->setParamByKey('nom', 'commune');
        		
        // Création de l'objet de gestion des départements.
        $boDepartement = new reference_Departement($this->_connection);
        // Selection du département.
        $rdsDepartement = $boDepartement->getById($iDepartementId);
		
        // Création de l'objet de gestion des communes.
        $boCity = new city_City($this->_connection);
        // Selection des communes.
        $this->_request->setParamByKey('rdsCitys', $boCity->getListCityByName($strCommune)); //, $rdsDepartement->fields['code']));
    }
}

?>