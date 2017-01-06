<?php

/*
  --------------------------------------------------------------------
  class.bo.user.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class user_User {

    private $connection;  ///<b>connect</b>		Connection SQL object

    /**
      boUser constructor inits everything related to User.

      @param	connection		Connection to bd
     */

    public function __construct($connection) {
        $this->connection = $connection;
    }

    /**
      Add user.

      @param	strMail
      @param	strPass
      @param	iType

     */
    public function addUser($strMail, $strPass, $iType) {
        
        // IP.
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        // Enregistrement du nouvel utilisateur.
        $strRequete = "INSERT INTO `user_utilisateurs` ( `id_utilisateur` , `pass` , `nom` , `prenom` , `email` ,`type` ,`id_etatnorma` ,`date` , `ip` ) ";
        $strRequete .= " VALUES (NULL, '" . addslashes(md5($strPass)) . "','Utilisateur', 'Nouvel', '" . addslashes($strMail) . "', 0, NULL, NOW(),'" . $ip . "' ) ";
        $rds = $this->connection->Execute($strRequete);
        $iIdUser = $this->connection->Insert_ID();

		// Ajout des données parents.
        $boParent = new user_Parent($this->connection);
        $rdsParent = $boParent->addStart($iIdUser);
		
        return $iIdUser;
    }

    /**
      Update password user.

      @param	iIdUtilisateur		User Id
      @param	strPassword		Password
     */
    public function updateUserPassword(   
                $iIdUtilisateur, 
                $strPassword) {

        $strRequete = "UPDATE `user_utilisateurs` SET `pass`='" . addslashes(md5($strPassword)) . "' WHERE `id_utilisateur`='" . $iIdUtilisateur . "' LIMIT 1 ;";
        $rdsMAJProfil = $this->connection->Execute($strRequete);
    }
    
    /**
      Update profil user.

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

        $strRequete = "UPDATE `user_utilisateurs` SET `nom`='" . addslashes($strNom) . "',`prenom`='" . addslashes($strPrenom) . "' WHERE `id_utilisateur`='" . $iIdUtilisateur . "' LIMIT 1 ;";
        $rdsMAJProfil = $this->connection->Execute($strRequete);
		
		// Ajout des données parents.
        $boParent = new user_Parent($this->connection);
        $rdsUser = $boParent->updateProfil($strNom, $strPrenom, $iIdUtilisateur);  
			
		$_SESSION["login"] = ucfirst(strtolower($strPrenom)) . " " . strtoupper($strNom);
		$_SESSION["nom"] = strtoupper($strNom);
		$_SESSION["prenom"] = ucfirst(strtolower($strPrenom));
    }

	 
    /**
      Update profil etablissement.

      @param	iIdEtablissement    Id Etablissement
      @param	iIdUtilisateur      iIdUtilisateur
     */
    public function updateEtablissement(   
                $iIdEtablissement,
                $iIdUtilisateur) {


        $strRequete = "UPDATE `user_utilisateurs` SET `id_etatnorma`='" . $iIdEtablissement . "' WHERE `id_utilisateur`='" . $iIdUtilisateur . "' LIMIT 1 ;";

        $rds = $this->connection->Execute($strRequete);
		
		$_SESSION["id_etatnorma"] = $iIdEtablissement;
    }
	
    /**
      Check login

      @param	strIdentifiant	Identifiant
     */
    public static function checkLogin($strIdentifiant) {
        $rdsUser = $this->connection->Execute("SELECT COUNT(*) AS NB_USER FROM `user_utilisateurs` WHERE `email` = '" . $strIdentifiant . "';");

        if ($rdsUser->fields['NB_USER'] == 0)
            return true;
        else
            return false;
    }

    /**
      Check user.
     */
    public function checkUser() {
        $rdsUser = $this->connection->Execute("SELECT COUNT(*) AS NB_USER FROM `user_utilisateurs` WHERE `id_utilisateur` = '" . $_SESSION["id_utilisateur"] . "' LIMIT 1;");

        if ($rdsUser->fields['NB_USER'] == 0)
            return false;
        else
            return true;
    }

    /**
      Check User ID

      @param	iIDUser	Identifiant utilisateur
     */
    public function check($iIDUser) {
        if ($iIDUser == 0)
            return false;

        $rds = $this->connection->Execute("SELECT id_utilisateur FROM `user_utilisateurs` WHERE `id_utilisateur` = '" . $iIDUser . "' LIMIT 1;");

        if ($rds->RecordCount() == 0)
            return false;
        else
            return true;
    }

    /**
      Check permission.

      @param	iIDUser		User ID
     */
    public function checkPermission($iIDUser) {
        return true;
    }

    /**
      Get User by ID

      @param	iIDUser	Identifiant utilisateur
     */
    public function getUserByID($iIDUser) {
        $strRequete = "SELECT utilisateur.*, localites.id_localite, localites.localite, commune.commune ";
        $strRequete .= " FROM `user_utilisateurs` utilisateur ";
        $strRequete .= " LEFT JOIN `data_localites` localites ON localites.id_localite = utilisateur.id_localite ";
        $strRequete .= " INNER JOIN `form_communes` commune ON localites.id_commune = commune.id_commune ";
        $strRequete .= " WHERE utilisateur.id_utilisateur = '" . $iIDUser . "' LIMIT 1;";

        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }

    /**
      Get user by login password.

      @param	strEmail		Adresse email
      @param	strMdp		Mot de passe
     */
    public function getUserByLoginPassword($strEmail, $strMdp) {

        $this->addConnexion();

        $strRequete = " SELECT util.* ";
        $strRequete .= " FROM `user_utilisateurs` util ";
        $strRequete .= " WHERE util.email = '" . $strEmail . "' and util.pass  = '" . $strMdp . "' LIMIT 1;";

        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }

    /**
      Update User.
     */
    public function updateUser() {

        $rds = $this->connection->Execute("UPDATE `user_utilisateurs` SET `connexion` = (`connexion` + 1), `date_modification` = NOW() WHERE id_utilisateur = '" . $_SESSION["id_utilisateur"] . "' ;");
    }

    /**
      Add connexion
     */
    public function addConnexion() {
        $rds = $this->connection->Execute("UPDATE `user_utilisateurs` SET `connexion` = (`connexion`+1) WHERE `id_utilisateur` = '" . $_SESSION["id_utilisateur"] . "' LIMIT 1;");
    }

    /**
      Get data user.

      @param	iIdUtilisateur		Utilisateur ID
     */
    public function getDataUser($iIdUtilisateur) {

        // Suppression des abus périmés. 
        $strRequeteUtilisateur = " SELECT * FROM `user_utilisateurs` util ";
        $strRequeteUtilisateur .= " LEFT JOIN `data_localites` localites ON localites.id_localite = util.id_localite ";
        $strRequeteUtilisateur .= " LEFT JOIN `form_communes` communes ON communes.id_commune = localites.id_commune ";
        $strRequeteUtilisateur .= " LEFT JOIN `data_utilisateur_liste_tag` ltag ON ltag.id_utilisateur = util.id_utilisateur ";
        $strRequeteUtilisateur .= " WHERE util.id_utilisateur='" . $iIdUtilisateur . "'";
        $rdsUtilisateurs = $this->connection->Execute($strRequeteUtilisateur);

        return $rdsUtilisateurs;
    }

    /**
      Get data user.

      @param	strEmail		Email ID
     */
    public function getDataUserByEmail($strEmail) {

        $strRequete = "SELECT * FROM `user_utilisateurs` WHERE email LIKE '" . $strEmail . "' limit 1;";
        $rdsUtilisateurs = $this->connection->Execute($strRequete);

        return $rdsUtilisateurs;
    }

    /**
      Update Validation.

      @param	iUserId         User Id
     */
    // Modifié
    public function updateValidation($iUserId) {

        $strRequete = "UPDATE `user_utilisateurs` SET `validation`='1' WHERE `id_utilisateur`='" . $iUserId . "' LIMIT 1 ;";
        $rdsMAJ = $this->connection->Execute($strRequete);

        return $rdsMAJ;
    }

    /**
      Get question.
     */
    public function getQuestion() {

        $strRequete = "SELECT * FROM `form_questions` ";
        $rdsQuestions = $this->connection->Execute($strRequete);

        return $rdsQuestions;
    }

    /**
      Check Email unique.

      @param	strEmail	Email
     */
    public function checkEmailUnique($strEmail) {

        if ($strEmail == "")
            return FALSE;

        $strRequete = " SELECT * FROM `user_utilisateurs` WHERE email ='" . $strEmail . "'; ";
        $rds = $this->connection->Execute($strRequete);

        if ($rds->RecordCount() == 0)
            return TRUE;
        else
            return FALSE;
    }

    /**
      Check Alpha User.
     */
    public function checkAlphaUser() {

        // Recuperation de l'ip de l'utilisateur meme si celui ci se trouve derriere un proxy.
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        // Vérification de l'existence d'un alpha user par son ip active. 
        $strRequeteAlpha = "SELECT * FROM `user_alpha` WHERE ip ='" . $ip . "' AND actif='1' ;";
        $rdsAlphaUser = $this->connection->Execute($strRequeteAlpha);

        if ($rdsAlphaUser->RecordCount() > 0)
            return true;
        else
            return false;
    }

    /**
      Update IP Alpha User.
     */
    public function updateIPAlphaUser($astrEmail) {

        // Recuperation de l'ip de l'utilisateur meme si celui ci se trouve derriere un proxy.
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        // Mise à jour de l'IP d'un alpha user.
        $strRequeteAlpha = "UPDATE `user_alpha` SET ip ='" . $ip . "' WHERE email = '" . $astrEmail . "';";
        $rdsAlphaUser = $this->connection->Execute($strRequeteAlpha);

        if ($rdsAlphaUser->RecordCount() > 0)
            return true;
        else
            return false;
    }

    /**
      Clear IP Alpha User.
     */
    public function clearIPAlphaUser($astrEmail) {

        // Vidage des ip d'un alpha user.
        $strRequeteAlpha = "UPDATE `user_alpha` SET ip ='' WHERE email = '" . $astrEmail . "';";
        $rdsAlphaUser = $this->connection->Execute($strRequeteAlpha);

        if ($rdsAlphaUser->RecordCount() > 0)
            return true;
        else
            return false;
    }

    /**
      Check Alpha User by email.
     */
    public function checkAlphaUserByEmail($astrEmail) {

        // Vérification de l'existence d'un alpha utilisateur. 
        $strRequeteAlpha = "SELECT * FROM `user_alpha` WHERE email ='" . $astrEmail . "' AND actif='1';";
        $rdsAlphaUser = $this->connection->Execute($strRequeteAlpha);

        if ($rdsAlphaUser->RecordCount() > 0)
            return true;
        else
            return false;
    }

    /**
      Check Validation Guid.

      @param	strGuid         Guid
     */
    public function checkValidationGuid($strGuid) {

        if ($strGuid == "")
            return FALSE;

        $strRequete = " SELECT * FROM `data_utilisateur_validation` WHERE guid ='" . $strGuid . "'; ";
        $rds = $this->connection->Execute($strRequete);

        if ($rds->RecordCount() == 1)
            return TRUE;
        else
            return FALSE;
    }
    
    /**
      Get Validation by Guid.

      @param	strGuid         Guid
     */
    public function getValidationByGuid($strGuid) {

        $strRequete = " SELECT * FROM `data_utilisateur_validation` WHERE guid ='" . $strGuid . "'; ";
        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }
    
    /**
      Get Validation by Guid.

      @param	iUserId         User Id
     */
    public function deleteValidationByUser($iUserId) {

        $strRequete = "DELETE FROM `data_utilisateur_validation` WHERE id_utilisateur = '" . $iUserId . "';";
        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }
    
    /**
      Add Validation User.

      @param	iUserId         User Id
     */
    public function addValidationUser($iUserId) {

        // Recuperation de l'ip de l'utilisateur meme si celui ci se trouve derrière un proxy.
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $lstrGuid = guid();
        
        // Ajout de l'utilisateur à la béta.
        $strRequete = "INSERT INTO `data_utilisateur_validation` ( `id_validation`, `id_utilisateur`, `guid`, `date`, `ip`) ";
        $strRequete .= " VALUES (NULL, '" . $iUserId . "','" . $lstrGuid . "', NOW(),'" . $ip . "' ) ";

        $rdsActivationUser = $this->connection->Execute($strRequete);
        
        return $lstrGuid;
    }
    
    /**
      Send Activation User Email.

      @param	astrEmail	Email
      @param	astrGuid	Guid
     */
    public function sendValidationUserEmail($astrEmail, $astrGuid) {

        // construction du message.
        $mail = $astrEmail; // Déclaration de l'adresse de destination.
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
        {
                $passage_ligne = "\r\n";
        }
        else
        {
                $passage_ligne = "\n";
        }

        //==========

        //=====Création de la boundary
        $boundary = "-----=".md5(rand());
        //==========

        //=====Définition du sujet.
        $sujet = 'FCPE - Lien d\'activation';
        //=========

        //=====Création du header de l'e-mail.
        $header = "From: \"FCPE - Activation\"activation@FCPE.com>" . $passage_ligne;
        $header .= "Reply-to: \"WeaponsB\" <activation@FCPE.com>" . $passage_ligne;
        $header .= "MIME-Version: 1.0" . $passage_ligne;
        $header .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
        //==========
        
        // Chargement du texte.
        $bSend = true;
        $message_html = "";
        $message_txt = "";

        if (!file_exists($path = ROOT . REP_EMAIL . 'validation.html')) {
            $message_html = file_get_contents(BEBORE_ROOT . $path);
            $message_html = str_replace("{{guid}}", $astrGuid, $message_html);
        } else {
            $bSend = false;
        }

        if (!file_exists($path = ROOT . REP_EMAIL . 'validation.txt')) {
            $message_txt = file_get_contents(BEBORE_ROOT . $path);
            $message_txt = str_replace("{{guid}}", $astrGuid, $message_txt);
        } else {
            $bSend = false;
        }
        
        //=====Création du message.
        $message = $passage_ligne."--".$boundary.$passage_ligne;
        //=====Ajout du message au format texte.
        $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_txt.$passage_ligne;
        //==========
        $message.= $passage_ligne."--".$boundary.$passage_ligne;
        //=====Ajout du message au format HTML
        $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_html.$passage_ligne;
        //==========
        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
        //==========

        // Envoie du message.
        //mail($mail, $sujet, $message, $header);

    }
    
    /**
      Check Alpha User by email.
     */
    public function addAlphaUserByEmail($astrEmail) {

        // Recuperation de l'ip de l'utilisateur meme si celui ci se trouve derrière un proxy.
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        // Ajout de l'utilisateur à la béta.
        $strRequete = "INSERT INTO `user_alpha` ( `id_user_alpha`, `email`, `actif`, `envoyer`, `date`, `ip`) ";
        $strRequete .= " VALUES (NULL, '" . addslashes($astrEmail) . "',0,0, NOW(),'" . $ip . "' ) ";

        $rdsAlphaUser = $this->connection->Execute($strRequete);

        if ($rdsAlphaUser->RecordCount() > 0)
            return true;
        else
            return false;
    }

    /**
      Send Alpha User  email.
     */
    public function sendAlphaUserEmail($astrEmail) {

        // construction du message.
        $to = $astrEmail;
        $subject = 'FCPE - Inscription à la bétâ';

        $headers = "From: " . strip_tags("beta@FCPE.com") . "\r\n";
        $headers .= "Reply-To: " . strip_tags("beta@FCPE.com") . "\r\n";
        $headers .= "CC: beta@FCPE.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        // Chargement du texte.
        $bSend = true;
        $message = "";
        if (!file_exists($path = dirname(__FILE__) . '/../../views/emails/beta.html')) {

            // préparation CURL
            $ch = curl_init();

            // assignation des valeurs personnalisées
            curl_setopt($ch, CURLOPT_URL, $path);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // 10 secondes de timeout
            // lancer la bufferisation
            ob_start();
            // lancer l'execution
            curl_exec($ch);
            // fermer CURL
            curl_close($ch);
            // obtenir les données du buffer
            $message = ob_get_contents();
            // fermer le buffer
            ob_end_clean();
        } else {
            $bSend = false;
        }

        // Envoie du message.
        if ($message != "") {
            mail($to, $subject, $message, $headers);
        } else {
            $bSend = false;
        }

        if ($bSend) {
            $strRequeteAlpha = "UPDATE `user_alpha` SET envoyer='1' WHERE email = '" . $astrEmail . "';";
            $rdsAlphaUser = $this->connection->Execute($strRequeteAlpha);
        }
    }


    /**
      Save cookie session.
     */
    public function saveCookie() {

        // Recuperation de l'ip de l'utilisateur meme si celui ci se trouve derriere un proxy.
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $lstr_Guid = guid();

        // Suppression
        $strRequeteSuppression = "DELETE FROM `user_sessions_cookies` WHERE id_utilisateur = '" . $_SESSION['id_utilisateur'] . "';";
        $rdsSuppression = $this->connection->Execute($strRequeteSuppression);

        // Insertion
        $strRequete = "INSERT INTO `user_sessions_cookies` ( `id_session` ,`ip` ,`guid` ,`id_utilisateur` ,`date`) ";
        $strRequete .= " VALUES ( NULL,'" . $ip . "','" . $lstr_Guid . "','" . $_SESSION['id_utilisateur'] . "', NOW()); ";
        $rds = $this->connection->Execute($strRequete);

        return $lstr_Guid;
    }

    /**
      Save cookie session.
     */
    public function checkCookie($astr_Guid) {

        // Recuperation de l'ip de l'utilisateur meme si celui ci se trouve derriere un proxy.
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        // Selection
        $strRequete = "SELECT email, pass ";
        $strRequete .= " FROM `user_utilisateurs` utilisateur ";
        $strRequete .= " INNER JOIN `user_sessions_cookies` cookie ON utilisateur.id_utilisateur = cookie.id_utilisateur ";
        $strRequete .= " WHERE cookie.guid = '" . $astr_Guid . "' AND cookie.ip = '" . $ip . "' LIMIT 1;";
        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }
}

?>