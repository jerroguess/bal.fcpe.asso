<?php

/*
  --------------------------------------------------------------------
  class.bo.export.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class reference_Export {

    private $connection;  ///<b>connect</b>		Connection SQL object

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getParent() {

        $strRequete = "SELECT DISTINCT id,
					id_etatnorma,
					id_utilisateur,
					nom,
					prenom,
					civilite,
					nom2,
					prenom2,
					civilite2,
					adresse1,
					adresse2,
					adresse3,
					adresse4,
					code_postal,
					id_commune,
					adhesion_hors_cl,
					id_adhesion,
					nom_autre_fcpe,
					abo_rp,
					abo_fe,
					telephone,
					portable,
					email,
					email2,
					souh_part_cl,
					souh_candidat_ce,
					souh_candidat_ca,
					souh_delegue,
					souh_del_classe,
					souh_newsletter 
					FROM `parent` WHERE `id_etatnorma` = '" . $_SESSION["id_etatnorma"] . "' ORDER BY id";
		$rds = $this->connection->Execute($strRequete);
        return $rds;
    }
	
    public function getEnfant() {

        $strRequete  = " SELECT DISTINCT e.* ";
		$strRequete .= " FROM `enfant` e ";
		$strRequete .= " INNER JOIN `parent` p ON p.id = e.id_parent ";
		$strRequete .= " WHERE p.id_etatnorma = '" . $_SESSION["id_etatnorma"] . "' ";
		$strRequete .= " ORDER BY e.id ";
		$rds = $this->connection->Execute($strRequete);
        return $rds;
    }
	
	public function getEtablissement() {

        $strRequete  = " SELECT DISTINCT t.* ";
		$strRequete .= " FROM `etablissement` t ";
		$strRequete .= " WHERE t.id_etatnorma = '" . $_SESSION["id_etatnorma"] . "' ";
		$strRequete .= " ORDER BY t.id ";

		$rds = $this->connection->Execute($strRequete);
        return $rds;
    }
	
	public function getCommune() {

        $strRequete  = " SELECT DISTINCT c.* ";
		$strRequete .= " FROM `commune` c ";
		$strRequete .= " INNER JOIN `parent` p ON c.id = p.id_commune ";
		$strRequete .= " WHERE p.id_etatnorma = '" . $_SESSION["id_etatnorma"] . "' ";
		$strRequete .= " ORDER BY id ";

		$rds = $this->connection->Execute($strRequete);
        return $rds;
    }
	
	public function getNiveauAdhesion() {

        $strRequete  = " SELECT DISTINCT n.id, n.libelle, n.montant, n.commentaires, n.lien, particularite ";
		$strRequete .= " FROM `niveauadhesion` n ";
		$strRequete .= " INNER JOIN `parent` p ON n.id = p.id_adhesion ";
		$strRequete .= " INNER JOIN `etablissement` t ON t.id_etatnorma = p.id_etatnorma ";
		$strRequete .= " WHERE p.id_etatnorma = '" . $_SESSION["id_etatnorma"] . "' ";
		$strRequete .= " ORDER BY n.id ";
		$rds = $this->connection->Execute($strRequete);
        return $rds;
    }
	
    public function getClasse() {

        $strRequete = "SELECT DISTINCT * FROM `classe` ORDER BY nom";
        $rds = $this->connection->Execute($strRequete);
        return $rds;
    }	
	
    public function getExploration() {

        $strRequete = "SELECT DISTINCT * FROM `exploration` ORDER BY libelle";
        $rds = $this->connection->Execute($strRequete);
        return $rds;
    }	
	
    public function getDepartement() {

        $strRequete = "SELECT DISTINCT * FROM `departement` ORDER BY code";
        $rds = $this->connection->Execute($strRequete);
        return $rds;
    }	
}

?>