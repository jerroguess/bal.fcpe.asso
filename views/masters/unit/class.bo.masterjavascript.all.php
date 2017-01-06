<?PHP

/*
  --------------------------------------------------------------------
  class.bo.masterjavascript.all.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class boMasterJavascriptAll extends boMasterJavascript {

    public function __construct(boRequest $request, boResponse $response, $_strViewFile, $_connection) {
        parent::__construct($request, $response, $_strViewFile, $_connection);
    }

    public function render() {

        header("Content-Type: text/html; charset=iso-8859-15");
        
        // Connection base de donnée.
        $connection = $this->_connection;

        // Gestion de la page.
        if (!file_exists(dirname(__FILE__) . '/../../../views/javascripts/unit/view.bo.' . $this->_strViewFile . '.php')) {
            $this->_strViewFile = "vide";
        }
        include (dirname(__FILE__) . '/../../../views/javascripts/unit/view.bo.' . $this->_strViewFile . '.php');
    }
}

?>