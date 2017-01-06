<?PHP

/*
  --------------------------------------------------------------------
  class.bo.ajax.classe.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class boacClasseController extends boActionAjaxController {
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
		$this->_request->defineParam(1, 'classe', 0);
		$this->_request->defineParam(1, 'rdsClasse', 1);
		$this->_request->defineParam(0, 'callback', '');
    }

    # ******************************
    # Actions.
    # ******************************

    public function execute() {
        
		// Récuperation des variables.
        $iIdClasse = $this->_request->getParamByKey('classe');
		
        // Positionnement du nom.
        $this->_request->setParamByKey('nom', 'classe');
		
        // Création de l'objet de gestion des classes.
        $boClasse = new reference_Classe($this->_connection);
        // Selection des classes.	
        $rdsClasse = $boClasse->getById($iIdClasse);
        $this->_request->setParamByKey('rdsClasse', $rdsClasse);
    }
}

?>