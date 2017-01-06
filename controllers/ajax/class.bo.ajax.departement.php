<?PHP

/*
  --------------------------------------------------------------------
  class.bo.ajax.departement.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class boacDepartementController extends boActionAjaxController {
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
        $this->_request->defineParam(1, 'rdsDepartement', 1);
    }

    # ******************************
    # Actions.
    # ******************************

    public function execute() {
        
        // Cr�ation de l'objet de gestion des d�partements.
        $boDepartement = new reference_Departement($this->_connection, $iTypeMedia);
        // Selection des d�partements.	
        $rdsDepartement = $boDepartement->getAll();
        $this->_request->setParamByKey('rdsDepartement', $rdsDepartement);
    }
}

?>