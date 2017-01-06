<?PHP

/*
  --------------------------------------------------------------------
  class.bo.masterajax.json.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class boMasterAjaxJson extends boMasterAjax {

    public function __construct(boRequest $request, boResponse $response, $_strViewFile, $_connection) {
        parent::__construct($request, $response, $_strViewFile, $_connection);
    }

    public function render() {

        // Récupération des variables.
        $strNom = $this->_request->getParamByKey('nom');
        $iErreur = $this->_request->getParamByKey('erreur');
        $strCallback = $this->_request->getParamByKey('callback');
        
        // Connection base de donnée.
        $connection = $this->_connection;

        // Entete de la page.
        header('Content-Type: text/html;charset=iso-8859-15;');

        // Objet de retour.
        $boReturn = new common_Ajax();
        $boReturn->erreur = $iErreur;
        $boReturn->nom = $strNom;
    
        // Gestion de la page.
        if (!file_exists(dirname(__FILE__) . '/../../../views/ajax/unit/view.bo.' . $this->_strViewFile . '.php')) {
            $this->_strViewFile = "vide";
        }
        include (dirname(__FILE__) . '/../../../views/ajax/unit/view.bo.' . $this->_strViewFile . '.php');
        
        // Affichage du rendu.
        if (isset($strCallback)){
            echo $strCallback . '(' . $boReturn->render() . ');';
        }else{
            echo $boReturn->render();
        }
    }
}

?>