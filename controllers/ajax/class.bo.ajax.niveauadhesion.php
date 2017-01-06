<?PHP

/*
  --------------------------------------------------------------------
  class.bo.ajax.niveauadhesion.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class boacNiveauAdhesionController extends boActionAjaxController {
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
		$this->_request->defineParam(0, 'reference', '');
		$this->_request->defineParam(1, 'rdsNiveauAdhesion', 1);
		$this->_request->defineParam(0, 'callback', '');
    }

    # ******************************
    # Actions.
    # ******************************

    public function execute() {
        
		// Récuperation des variables.
        $strReference = $this->_request->getParamByKey('reference');
		
        // Positionnement du nom.
        $this->_request->setParamByKey('nom', 'niveauadhesion');
		
        // Création de l'objet de gestion des niveaux d'adhésion.
        $boNiveauAdhesion = new reference_NiveauAdhesion($this->_connection);
        // Selection des niveaux d'adhésions.	
        $rdsNiveauAdhesion = $boNiveauAdhesion->getByReference($strReference);
        $this->_request->setParamByKey('rdsNiveauAdhesion', $rdsNiveauAdhesion);
    }
}

?>