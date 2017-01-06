<?PHP

/*
  --------------------------------------------------------------------
  class.bo.controller.managechildren.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class bocManageChildrenController extends boActionController {
    # ******************************
    # Constructeurs.
    # ******************************

    public function __construct(boRequest $request, boResponse $response) {

        // 1. Appel du constructeur de la classe parente
        parent::__construct($request, $response);

        // Positionnement des inclusions.
        $this->_aFileCSS = array('style');
        $this->_aFileJS = array();
        $this->_aMenu = array();
        $this->_aCadre = array();

        // Positionnement du master.
        $this->_strMaster = 'main';
		
        // Authentification requis.
        $this->_bAuthentification = true;		
    }

    # ******************************
    # Chargement des variables.
    # ******************************

    protected function _loadVar() {
		$this->_request->defineParam(1, 'rdsChildren', 1);
		$this->_request->defineParam(1, 'affichage', -1);
    }

    # ******************************
    # Actions.
    # ******************************

    public function actionAfficher() {
	
        // Création de l'objet de gestion des enfants.
        $boChildren = new user_Children($this->_connection);
        // Selection des départements.	
        $rdsChildren = $boChildren->getAll();
        $this->_request->setParamByKey('rdsChildren', $rdsChildren);
    }
	
    public function supprimer() {
	
		// Récupération des valeurs.
        $iIdEnfant = $this->_request->getParamByKey('affichage');
		
		// Création de l'objet de gestion des enfants.
        $boChildren = new user_Children($this->_connection);
		$boChildren->delete($iIdEnfant);
		
		// Affichage du message.
		$this->_strErrorFile = "suppressioneffectuee";
						
        // Selection des départements.	
        $rdsChildren = $boChildren->getAll();
        $this->_request->setParamByKey('rdsChildren', $rdsChildren);
		
    }	
}

?>