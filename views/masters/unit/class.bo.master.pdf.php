<?PHP

/*
  --------------------------------------------------------------------
  class.bo.master.pdf.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class boMasterPdf extends boMaster {

    public function __construct(boRequest $request, boResponse $response, $_strViewFile, $_strErrorFile, $_aFileCSS, $_aURLCSS, $_aFileJS, $_aMenu, $_aCadre, $_connection, $_strTitre) {
        parent::__construct($request, $response, $_strViewFile, $_strErrorFile, $_aFileCSS, $_aURLCSS, $_aFileJS, $_aMenu, $_aCadre, $_connection, $_strTitre);
    }

    public function render() {


        // Connection base de donnée.
        $connection = $this->_connection;

		// ---------------------
		// Page.
		// ---------------------		
		// Inclusion de la page.
		include (dirname(__FILE__) . '/../../../views/pages/unit/view.bo.' . $this->_strViewFile . '.php');
    }
}

?>