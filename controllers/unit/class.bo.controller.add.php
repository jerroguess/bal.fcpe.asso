<?PHP

/*
  --------------------------------------------------------------------
  class.bo.controller.add.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class bocAddController extends boActionController {
    # ******************************
    # Constructeurs.
    # ******************************

    public function __construct(boRequest $request, boResponse $response) {

        // 1. Appel du constructeur de la classe parente
        parent::__construct($request, $response);

        // Positionnement des inclusions.
        $this->_aFileCSS = array('style');
        $this->_aFileJS = array('view-add');
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