<?php

/*
  --------------------------------------------------------------------
  class.bo.parent.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class user_Parent {

    private $connection;  ///<b>connect</b>		Connection SQL object

    /**
      boUser constructor inits everything related to parent.

      @param	connection		Connection to bd
     */

    public function __construct($connection) {
        $this->connection = $connection;
    }

    /**
      Add parent.

      @param	iIdEtablissement
      @param	strNom
      @param	strPrenom
	  @param	strCivilite
	  @param	strNom2
	  @param	strPrenom2
	  @param	strCivilite2
	  @param	strAdresse1
	  @param	strAdresse2
	  @param	strAdresse3
	  @param	strAdresse4
	  @param	strCodePostal
	  @param	iIdCommune
	  @param	bAdhesionHorsCL
	  @param	iIdAdhesion
	  @param	strNomAutreFCPE
	  @param	bAboRP
	  @param	bAboFE
	  @param	strTelephone
	  @param	strPortable
	  @param	strEmail
	  @param	strEmail2
	  @param	bSouhPartCL
	  @param	bSouhCandidatCE
	  @param	bSouhCandidatCA
	  @param	bSouhDelegue
	  @param	bSouhDelClasse
	  @param	bSouhNewsletter

     */
    public function add(
		$iIdEtablissement,
		$strNom,
		$strPrenom,
		$strCivilite,
		$strNom2,
		$strPrenom2,
		$strCivilite2,
		$strAdresse1,
		$strAdresse2,
		$strAdresse3,
		$strAdresse4,
		$strCodePostal,
		$iIdCommune,
		$bAdhesionHorsCL,
		$iIdAdhesion,
		$strNomAutreFCPE,
		$bAboRP,
		$bAboFE,
		$strTelephone,
		$strPortable,
		$strEmail,
		$strEmail2,
		$bSouhPartCL,
		$bSouhCandidatCE,
		$bSouhCandidatCA,
		$bSouhDelegue,
		$bSouhDelClasse,
		$bSouhNewsletter) {
        
        // IP.
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        // Enregistrement du nouvel utilisateur.
        $strRequete = "INSERT INTO `parent` (`id`,`id_etatnorma`,`id_utilisateur`,`nom`,`prenom`,`civilite`,`nom2`,`prenom2`,`civilite2`,`adresse1`,`adresse2`,`adresse3`,`adresse4`,`code_postal`,`id_commune`,`adhesion_hors_cl`,`id_adhesion`,`nom_autre_fcpe`,`abo_rp`,`abo_fe`,`telephone`,`portable`,`email`,`email2`,`souh_part_cl`,`souh_candidat_ce`,`souh_candidat_ca`,`souh_delegue`,`souh_del_classe`,`souh_newsletter`) ";
        $strRequete .= " VALUES (NULL, '" . $iIdEtablissement . "','" . $_SESSION["id_utilisateur"] . "','" . $strNom . "','" . $strPrenom . "','" . $strCivilite . "','" . $strNom2 . "','" . $strPrenom2 . "', '" . $strCivilite2 . "','" . $strAdresse1 . "','" . $strAdresse2 . "','" . $strAdresse3 . "','" . $strAdresse4 . "','" . $strCodePostal . "','" . $iIdCommune . "','" . $bAdhesionHorsCL . "','" . $iIdAdhesion . "','" . $strNomAutreFCPE . "','" . $bAboRP . "','" . $bAboFE . "','" . $strTelephone . "','" . $strPortable . "','" . $strEmail . "','" . $strEmail2 . "','" . $bSouhPartCL . "','" . $bSouhCandidatCE . "','" . $bSouhCandidatCA . "','" . $bSouhDelegue . "','" . $bSouhDelClasse . "','" . $bSouhNewsletter . "' ) ";
        $rds = $this->connection->Execute($strRequete);
        $iIdParent = $this->connection->Insert_ID();

        return $iIdParent;
    }

	/**
      Add start.

      @param	

     */
	public function addStart(
		$iIdUtilisateur
		) {
        
        // Enregistrement du nouvel utilisateur.
        $strRequete = "INSERT INTO `parent` (`id`,`id_etatnorma`,`id_utilisateur`,`nom`,`prenom`,`civilite`,`nom2`,`prenom2`,`civilite2`,`adresse1`,`adresse2`,`adresse3`,`adresse4`,`code_postal`,`id_commune`,`adhesion_hors_cl`,`id_adhesion`,`nom_autre_fcpe`,`abo_rp`,`abo_fe`,`telephone`,`portable`,`email`,`email2`,`souh_part_cl`,`souh_candidat_ce`,`souh_candidat_ca`,`souh_delegue`,`souh_del_classe`,`souh_newsletter`) ";
        $strRequete .= " VALUES (NULL, NULL,'" . $iIdUtilisateur . "', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL ) ";

		
		$rds = $this->connection->Execute($strRequete);
        $iIdParent = $this->connection->Insert_ID();

        return $iIdParent;
    }
	
    /**
      Update parent.

	  @param	iIdEtablissement
      @param	strNom
      @param	strPrenom
	  @param	strCivilite
	  @param	strNom2
	  @param	strPrenom2
	  @param	strCivilite2
	  @param	strAdresse1
	  @param	strAdresse2
	  @param	strAdresse3
	  @param	strAdresse4
	  @param	strCodePostal
	  @param	iIdCommune
	  @param	bAdhesionHorsCl
	  @param	iIdAdhesion
	  @param	strNomAutreFCPE
	  @param	bAboRP
	  @param	bAboFE
	  @param	strTelephone
	  @param	strPortable
	  @param	strEmail
	  @param	strEmail2
	  @param	bSouhPartCL
	  @param	bSouhCandidatCE
	  @param	bSouhCandidatCA
	  @param	bSouhDelegue
	  @param	bSouhDelClasse
	  @param	bSouhNewsletter
	  
     */
    public function update(  
		$iIdEtablissement,
		$strNom,
		$strPrenom,
		$strCivilite,
		$strNom2,
		$strPrenom2,
		$strCivilite2,
		$strAdresse1,
		$strAdresse2,
		$strAdresse3,
		$strAdresse4,
		$strCodePostal,
		$iIdCommune,
		$bAdhesionHorsCl,
		$iIdAdhesion,
		$strNomAutreFCPE,
		$bAboRP,
		$bAboFE,
		$strTelephone,
		$strPortable,
		$strEmail,
		$strEmail2,
		$bSouhPartCL,
		$bSouhCandidatCE,
		$bSouhCandidatCA,
		$bSouhDelegue,
		$bSouhDelClasse,
		$bSouhNewsletter) {

		// Ajout des données parents.
        $boUser = new user_User($this->connection);
        $rdsUser = $boUser->updateProfil($strNom, $strPrenom, $_SESSION["id_utilisateur"]);  
		$rdsUser = $boUser->updateEtablissement($iIdEtablissement, $_SESSION["id_utilisateur"]);  
		
        $strRequete = "UPDATE `parent` SET 
		`id_etatnorma`='" . $iIdEtablissement . "',
		`nom`='" . $strNom . "',
		`prenom`='" . $strPrenom . "',
		`civilite`='" . $strCivilite . "',
		`nom2`='" . $strNom2 . "',
		`prenom2`='" . $strPrenom2 . "',
		`civilite2`='" . $strCivilite2 . "' ,
		`adresse1`='" . $strAdresse1 . "',
		`adresse2`='" . $strAdresse2 . "',
		`adresse3`='" . $strAdresse3 . "',
		`adresse4`='" . $strAdresse4 . "',
		`code_postal`='" . $strCodePostal . "',
		`id_commune`='" . $iIdCommune . "',
		`id_adhesion`='" . $iIdAdhesion . "',
		`adhesion_hors_cl`='" . $bAdhesionHorsCl . "' ,
		`nom_autre_fcpe`='" . $strNomAutreFCPE . "',
		`abo_rp`='" . $bAboRP . "',
		`abo_fe`='" . $bAboFE . "',
		`telephone`='" . $strTelephone . "',
		`portable`='" . $strPortable . "',
		`email`='" . $strEmail . "' ,
		`email2`='" . $strEmail2 . "',
		`souh_part_cl`='" . $bSouhPartCL . "',
		`souh_candidat_ce`='" . $bSouhCandidatCE . "',
		`souh_candidat_ca`='" . $bSouhCandidatCA . "',
		`souh_delegue`='" . $bSouhDelegue . "',
		`souh_del_classe`='" . $bSouhDelClasse . "' ,
		`souh_newsletter`='" . $bSouhNewsletter . "' 
		WHERE `id_utilisateur`='" . $_SESSION["id_utilisateur"] . "' LIMIT 1 ;";

        $rds = $this->connection->Execute($strRequete);
    }

    /**
      Update profil parent.

      @param	strNom              Nom
      @param	strPrenom			Prenom
      @param	iIdUtilisateur      iIdUtilisateur
     */
    public function updateProfil(   
                $strNom, 
                $strPrenom,
                $iIdUtilisateur) {

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $strRequete = "UPDATE `parent` SET `nom`='" . addslashes($strNom) . "',`prenom`='" . addslashes($strPrenom) . "' WHERE `id_utilisateur`='" . $iIdUtilisateur . "' LIMIT 1 ;";
        $rdsMAJProfil = $this->connection->Execute($strRequete);
		
		$_SESSION["login"] = ucfirst(strtolower($strPrenom)) . " " . strtoupper($strNom);
		$_SESSION["nom"] = strtoupper($strNom);
		$_SESSION["prenom"] = ucfirst(strtolower($strPrenom));
    }
	
    /**
      Get

      @param	iIDParent
     */
    public function get() {
        $strRequete = "SELECT p.*, n.libelle, t.nom AS nom_etablissement, d.code, c.commune ";
        $strRequete .= " FROM `parent` p ";
		$strRequete .= " LEFT JOIN `niveauadhesion` n ON p.id_adhesion = n.id ";
		$strRequete .= " LEFT JOIN `etablissement` t ON t.id_etatnorma = p.id_etatnorma ";
        $strRequete .= " LEFT JOIN `departement` d ON d.id = t.id_departement ";
		$strRequete .= " LEFT JOIN `commune` c ON c.id = p.id_commune ";
        $strRequete .= " WHERE p.id_utilisateur = '" . $_SESSION["id_utilisateur"] . "';";

        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }
}

?>