<?php

/*
  --------------------------------------------------------------------
  class.bo.classe.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class reference_Classe {

    private $connection;  ///<b>connect</b>		Connection SQL object

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getById($iClasseId) {

        $strRequete = "SELECT * FROM `classe` WHERE id = " . $iClasseId . " LIMIT 1;";
        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }
	
    public function getAll() {

        $strRequete = "SELECT * FROM `classe` ORDER BY nom";
        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }
}

?>