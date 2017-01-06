<?php

/*
  --------------------------------------------------------------------
  class.bo.departement.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class reference_Departement {

    private $connection;  ///<b>connect</b>		Connection SQL object

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getById($iDepartementId) {

        // Selection d'un département.
        $strRequete = "SELECT code FROM `departement` WHERE id = " . $iDepartementId . " LIMIT 1;";
        $rdsDepartement = $this->connection->Execute($strRequete);

        return $rdsDepartement;
    }
	
    public function getAll() {

        // Selection des département.
        $strRequete = "SELECT * FROM `departement` ORDER BY nom";
        $rdsDepartement = $this->connection->Execute($strRequete);

        return $rdsDepartement;
    }
}

?>