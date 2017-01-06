<?PHP

/*
  --------------------------------------------------------------------
  class.bo.controller.home.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class bocHomeController extends boActionController {
    # ******************************
    # Constructeurs.
    # ******************************

    public function __construct(boRequest $request, boResponse $response) {

        // 1. Appel du constructeur de la classe parente
        parent::__construct($request, $response);

        // Positionnement des inclusions.
        $this->_aFileCSS = array('view-accueil','style');
        $this->_aFileJS = array('view-accueil');
        $this->_aMenu = array();
        $this->_aCadre = array();

        // Positionnement du master.
        $this->_strMaster = 'main';
    }

    # ******************************
    # Chargement des variables.
    # ******************************

    protected function _loadVar() {
	
    }

    # ******************************
    # Actions.
    # ******************************

    public function actionAfficher() {
        
        
        
    }
}

?>