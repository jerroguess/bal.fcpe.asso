<?PHP

/*
  --------------------------------------------------------------------
  class.bo.master.sql.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class boMasterSql extends boMaster {

    public function __construct(boRequest $request, boResponse $response, $_strViewFile, $_strErrorFile, $_aFileCSS, $_aURLCSS, $_aFileJS, $_aMenu, $_aCadre, $_connection, $_strTitre) {
        parent::__construct($request, $response, $_strViewFile, $_strErrorFile, $_aFileCSS, $_aURLCSS, $_aFileJS, $_aMenu, $_aCadre, $_connection, $_strTitre);
    }

    public function render() {


        // Connection base de donnée.
        $connection = $this->_connection;

        // ---------------------
        // Entete de la page.
        // ---------------------
		// output headers so that the file is downloaded rather than displayed
		header('Content-Type: text/sql; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.sql');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// ---------------------
		// Page.
		// ---------------------		
		// Inclusion de la page.
		include (dirname(__FILE__) . '/../../../views/pages/unit/view.bo.' . $this->_strViewFile . '.php');
    }
}

?>