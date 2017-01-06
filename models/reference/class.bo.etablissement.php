<?php

/*
  --------------------------------------------------------------------
  class.bo.etablissement.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class reference_Etablissement {

    private $connection;  ///<b>connect</b>		Connection SQL object

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getByNomDepartementId($strNom, $iIdDepartement, $iIdEtatBal) {

		if ($iIdEtatBal != 0){
			$strRequete  = " SELECT e.*, c.commune, c.code_postal ";
			$strRequete .= " FROM `etablissement` e ";
			$strRequete .= " INNER JOIN `commune` c ON c.id = e.id_commune ";
			$strRequete .= " WHERE `nom` LIKE '%" . $strNom . "%' AND `id_departement`='" . $iIdDepartement . "' AND `etatbal`='" . $iIdEtatBal . "' ";
			$strRequete .= " ORDER BY nom";
		}else{
			$strRequete  = " SELECT e.*, c.commune, c.code_postal ";
			$strRequete .= " FROM `etablissement` e ";
			$strRequete .= " INNER JOIN `commune` c ON c.id = e.id_commune ";
			$strRequete .= " WHERE `nom` LIKE '%" . $strNom . "%' AND `id_departement`='" . $iIdDepartement . "' ";
			$strRequete .= " ORDER BY nom";
		}
        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }
	
    public function getById($iIdEtablissement) {

        // Selection des département.
        $strRequete = "SELECT * FROM `etablissement` WHERE `id_etatnorma`='" . $iIdEtablissement . "' LIMIT 1;";

        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }
}

?>