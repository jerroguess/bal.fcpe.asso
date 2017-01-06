<?php

/*
  --------------------------------------------------------------------
  class.bo.niveauadhesion.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class reference_NiveauAdhesion {

    private $connection;  ///<b>connect</b>		Connection SQL object

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getByReference($strReference) {

        $strRequete = "SELECT id, libelle, montant, commentaires, lien, particularite FROM `niveauadhesion` WHERE `lien` = '" . $strReference . "' ORDER BY position";
		$rds = $this->connection->Execute($strRequete);

        return $rds;
    }
}

?>