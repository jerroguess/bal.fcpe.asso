<?PHP

/*
  --------------------------------------------------------------------
  class.bo.masterjavascript.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class boMasterJavascript {

    protected $_request;
    protected $_response;
    protected $_strViewFile;
    protected $_connection;

    public function __construct(boRequest $request, boResponse $response, $strViewFile, $connection) {
        // 1. Positionnement des variables.
        $this->_request = $request;
        $this->_response = $response;
        $this->_strViewFile = $strViewFile;
        $this->_connection = $connection;
    }
}

?>