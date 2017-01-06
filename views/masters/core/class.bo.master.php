<?PHP

/*
  --------------------------------------------------------------------
  class.bo.master.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class boMaster {

    protected $_request;
    protected $_response;
    protected $_strViewFile;
    protected $_strErrorFile;
    protected $_aFileCSS;
    protected $_aURLCSS;
    protected $_aFileJS;
    protected $_aMenu;
    protected $_aCadre;
    protected $_connection;
    protected $_strTitre;

    public function __construct(boRequest $request, boResponse $response, $strViewFile, $strErrorFile, $aFileCSS, $aURLCSS, $aFileJS, $aMenu, $aCadre, $connection, $strTitre) {
        // 1. Positionnement des variables.
        $this->_request = $request;
        $this->_response = $response;
        $this->_strViewFile = $strViewFile;
        $this->_strErrorFile = $strErrorFile;
        $this->_aFileCSS = $aFileCSS;
        $this->_aURLCSS = $aURLCSS;
        $this->_aFileJS = $aFileJS;
        $this->_aMenu = $aMenu;
        $this->_aCadre = $aCadre;
        $this->_connection = $connection;
        $this->_strTitre = $strTitre;
    }
}

?>