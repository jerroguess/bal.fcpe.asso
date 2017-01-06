<?php

/*
  --------------------------------------------------------------------
  class.bo.exploration.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class reference_Exploration {

    private $connection;  ///<b>connect</b>		Connection SQL object

    public function __construct($connection) {
        $this->connection = $connection;
    }
	
    public function getAll() {

        $strRequete = "SELECT * FROM `exploration` ORDER BY affichage";
        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }
}

?>