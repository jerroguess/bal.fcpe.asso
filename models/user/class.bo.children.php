<?php

/*
  --------------------------------------------------------------------
  class.bo.children.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class user_Children {

    private $connection;  ///<b>connect</b>		Connection SQL object

    /**
      boUser constructor inits everything related to Children.

      @param	connection		Connection to bd
     */

    public function __construct($connection) {
        $this->connection = $connection;
    }

    /**
      Add children.

      @param	iIdParent
      @param	iIdEtablissement
      @param	iIdClasse
	  @param	strNom
	  @param	strPrenom
	  @param	strSection
	  @param	strTelephone
	  @param	strEmail
	  @param	strLV1
	  @param	strLV2
	  @param	strLV3
	  @param	iIdExploration1
	  @param	iIdExploration2
	  @param	iIdExploration3
	  @param	strDateNaissance

     */
    public function add(
		$iIdParent, 
		$iIdEtablissement, 
		$iIdClasse,
		$strNom,
		$strPrenom,
		$strSection,
		$strTelephone,
		$strEmail,
		$strLV1,
		$strLV2,
		$strLV3,
		$iIdExploration1,
		$iIdExploration2,
		$iIdExploration3,
		$dateNaissance) {
        
        // IP.
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        // Enregistrement du nouvel utilisateur.
        $strRequete = "INSERT INTO `enfant` (`id`,`id_parent`,`id_utilisateur`,`id_etatnorma`,`id_classe`,`nom`,`prenom`,`section`,`telephone`,`email`,`lv1`,`lv2`,`lv3`,`exploration1`,`exploration2`,`exploration3`,`date_naissance`) ";
        $strRequete .= " VALUES (NULL, '" . $iIdParent . "','" . $_SESSION["id_utilisateur"] . "','" . $iIdEtablissement . "','" . $iIdClasse . "','" . $strNom . "','" . $strPrenom . "','" . $strSection . "', '" . $strTelephone . "','" . $strEmail . "','" . $strLV1 . "','" . $strLV2 . "','" . $strLV3 . "','" . $iIdExploration1 . "','" . $iIdExploration2 . "','" . $iIdExploration3 . "','" . $dateNaissance . "' ) ";
        $rds = $this->connection->Execute($strRequete);
        $iIdChildren = $this->connection->Insert_ID();

        return $iIdChildren;
    }

    /**
      Update children.

      @param	iIdChildren
      @param	iIdEtablissement
      @param	iIdClasse
	  @param	strNom
	  @param	strPrenom
	  @param	strSection
	  @param	strTelephone
	  @param	strEmail
	  @param	strLV1
	  @param	strLV2
	  @param	strLV3
	  @param	iIdExploration1
	  @param	iIdExploration2
	  @param	iIdExploration3
	  @param	strDateNaissance
	  
     */
    public function update(   
                $iIdChildren, 
				$iIdEtablissement, 
				$iIdClasse,
				$strNom,
				$strPrenom,
				$strSection,
				$strTelephone,
				$strEmail,
				$strLV1,
				$strLV2,
				$strLV3,
				$iIdExploration1,
				$iIdExploration2,
				$iIdExploration3,
				$dateNaissance) {

        $strRequete = "UPDATE `enfant` SET `id_etatnorma`='" . $iIdEtablissement . "',`id_classe`='" . $iIdClasse . "',`nom`='" . $strNom . "',`prenom`='" . $strPrenom . "',`section`='" . $strSection . "',`telephone`='" . $strTelephone . "',`email`='" . $strEmail . "',`lv1`='" . $strLV1 . "',`lv2`='" . $strLV2 . "',`lv3`='" . $strLV3 . "',`exploration1`='" . $iIdExploration1 . "',`exploration2`='" . $iIdExploration2 . "',`exploration3`='" . $iIdExploration3 . "',`date_naissance`='" . $dateNaissance . "' WHERE `id`='" . $iIdChildren . "' AND id_utilisateur = '" . $_SESSION["id_utilisateur"] . "' LIMIT 1 ;";
 
		$rds = $this->connection->Execute($strRequete);
    }
    
    /**
      Delete Children.

      @param	iIdChildren
	  
     */
    public function delete(   
                $iIdChildren) {

        $strRequete = "DELETE FROM `enfant` WHERE id = '" . $iIdChildren . "' AND id_utilisateur = '" . $_SESSION["id_utilisateur"] . "' LIMIT 1;;";
        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }

	/**
      Get All

      @param	iIdChildren
	  	  
     */
    public function getById($iIdChildren) {
        $strRequete = "SELECT * ";
        $strRequete .= " FROM `enfant` ";
        $strRequete .= " WHERE id = '" . $iIdChildren . "' AND id_utilisateur = '" . $_SESSION["id_utilisateur"] . "' LIMIT 1;";

        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }
	
    /**
      Get All
     */
    public function getAll() {
        $strRequete = "SELECT e.*, t.nom AS nom_etablissement, c.nom AS nom_classe, d.code, e1.intitule AS exploration1_libelle, e2.intitule AS exploration2_libelle, e3.intitule AS exploration3_libelle";
        $strRequete .= " FROM `enfant` e ";
		$strRequete .= " INNER JOIN `classe` c ON c.id = e.id_classe ";
        $strRequete .= " INNER JOIN `etablissement` t ON t.id_etatnorma = e.id_etatnorma ";
        $strRequete .= " INNER JOIN `departement` d ON d.id = t.id_departement ";
		$strRequete .= " LEFT JOIN `exploration` e1 ON e1.id_exploration = e.exploration1 ";
		$strRequete .= " LEFT JOIN `exploration` e2 ON e2.id_exploration = e.exploration2 ";
		$strRequete .= " LEFT JOIN `exploration` e3 ON e3.id_exploration = e.exploration3 ";
        $strRequete .= " WHERE id_utilisateur = '" . $_SESSION["id_utilisateur"] . "';";

		//echo $strRequete;
		
        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }
}

?>