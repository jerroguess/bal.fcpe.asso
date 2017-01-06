<?php

/*
  --------------------------------------------------------------------
  class.bo.reminder.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class user_Reminder {

    private $connection;  ///<b>connect</b>		Connection SQL object

    /**
      boReminder constructor inits everything related to User.

      @param	connection		<b>connection</b>	Connection to bd
     */

    public function __construct($connection) {
        $this->connection = $connection;
    }

    /**
      Get reminder by IP.
     */
    public function getReminderByIP() {

        // Recuperation de l'ip de l'utilisateur meme si celui ci se trouve derriere un proxy.
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        // Suppression du précédent banissement.
        $strRequete = "DELETE FROM `user_rappels` WHERE `date` < DATE_SUB(NOW(), INTERVAL 60 SECOND)";
        $rds = $this->connection->Execute($strRequete);

        // Selection des rappels.
        $strRequete = "SELECT ip FROM `user_rappels` WHERE ip ='" . $ip . "'";
        $rdsRappels = $this->connection->Execute($strRequete);

        // Variable de vérification.
        $bRetour = TRUE;

        // S'il ya eu un précédent envoie
        if ($rdsRappels->RecordCount() > 0) {

            // Si ce temps n'a pas encore était dépassé.
            $bRetour = FALSE;
        }

        return $bRetour;
    }

    /**
      Add reminder.
     
     @param	iIdUser		Id User
     */
    public function addReminder($iIdUser) {

        // Recuperation de l'ip de l'utilisateur meme si celui ci se trouve derriere un proxy.
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $lstrGuid = guid();
        
        // Selection des rappels.
        $strRequete = "INSERT INTO `user_rappels` (`id_rappel` , `id_utilisateur`, `guid`, `actif` , `date` , `ip` )";
        $strRequete .= "VALUES( NULL,'" . $iIdUser . "','" . $lstrGuid . "', 1, NOW(),'" . $ip . "')";
        $rdsRappels = $this->connection->Execute($strRequete);

        return $lstrGuid;
    }
    
    /**
      Get reminder by guid.
     
     @param	strGuid		Guid
     */
    public function getReminderByGuid($strGuid) {

        // Selection des rappels.
        $strRequete = "SELECT id_utilisateur FROM `user_rappels` WHERE guid LIKE '" . $strGuid . "' LIMIT 1;";
        $rdsRappels = $this->connection->Execute($strRequete);
        
        if ($rdsRappels->RecordCount() > 0) {
            return $rdsRappels->fields['id_utilisateur'];
        }else{
            return null;
        }
    }
    
    /**
      Set inactif a reminder.
     
     @param	strGuid		Guid
     */
    public function setInactif($strGuid) {

        $strRequete = "UPDATE `data_utilisateurs` SET `actif`='0' WHERE guid = '" . $strGuid . "' LIMIT 1 ;";
        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }
    
    /**
      Send Regeneration User Password.

      @param	astrEmail	Email
      @param	astrGuid	Guid
     */
    public function sendRegenerationUserPassword($astrEmail, $astrGuid) {

		// ==================================================
		// Envoi de l'email.
		// ==================================================
		mb_internal_encoding("UTF-8");
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $astrEmail)) // On filtre les serveurs qui rencontrent des bogues.
		{
			$passage_ligne = "\r\n";
		}
		else
		{
			$passage_ligne = "\n";
		}
			
		//==========
		//=====Création de la boundary
		$boundary = "-----=" . md5(rand());
		//==========

		//=====Définition du sujet.
		$sujet = 'Mot de passe - FCPE - Site adhésion';
		//=========

		//=====Création du header de l'e-mail.
		// Pour envoyer un mail HTML, l'en-tête Content-type doit être d&eacute;fini
		$header  = 'MIME-Version: 1.0' . "\r\n";
		$header .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
		$header .= 'From: ' . mb_encode_mimeheader("L'equipe FCPE") . ' <no.reply@fcpe.fr>' . $passage_ligne;
		//==========
		
		// Chargement du texte.
		$message_html = "";
		$message_txt = "";
		
		// message
		$message_html = '
			---------------------------------------------------------------------------------------<br/>
			<strong>FCPE - Adh&eacute;sion</strong><br/>
			---------------------------------------------------------------------------------------<br/>
			Nous avons bien reçu votre requ&ecirc;te nous demandant de vous aider &agrave; retrouver votre <br/>
			mot de passe FCPE. Vous trouverez ci-dessous les informations que nous poss&eacute;dons &agrave; <br/>
			ce sujet. Si vous n\'avez pas soumis cette requ&ecirc;te, veuillez ignorer cet e-mail. <br/>
			<br/>
			L\'adresse e-mail que vous avez enregistr&eacute;e lors de votre inscription est : ' . $astrEmail . '<br/>
			<br/>
			Si vous avez oubli&eacute; votre mot de passe, vous pouvez le reg&eacute;n&eacute;rer &agrave; partir de cette page :<br/>
			http://www.fcpe.fr/adhesion/' . $astrGuid . '.<br/>
			<br/>
			Merci d\'utiliser notre site d\'adh&eacute;sion !<br/>
			---------------------------------------------------------------------------------------<br/>
			&copy; FCPE 2015<br/>
		';
		
		$message_txt = '
			---------------------------------------------------------------------------------------
			FCPE - Adhésion
			---------------------------------------------------------------------------------------
			Nous avons bien reçu votre requête nous demandant de vous aider à retrouver votre
			mot de passe FCPE. Vous trouverez ci-dessous les informations que nous possédons
			à ce sujet. Si vous n\'avez pas soumis cette requête, veuillez ignorer cet e-mail.

			L\'adresse e-mail que vous avez enregistrée lors de votre inscription est : ' . $astrEmail . '

			Si vous avez oublié votre mot de passe, vous pouvez le regénérer à partir de cette page :
			http://www.fcpe.com/adhesion/' . $astrGuid . '.

			Merci d\'utiliser notre site d\'adhésion !
			---------------------------------------------------------------------------------------
			(c) FCPE 2015
		';
		
		//=====Création du message.
		$message = $passage_ligne."--".$boundary.$passage_ligne;
		//=====Ajout du message au format texte.
		$message.= "Content-Type: text/plain; ".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne . $message_txt . $passage_ligne;
		//==========
		$message.= $passage_ligne."--".$boundary.$passage_ligne;
		//=====Ajout du message au format HTML
		$message.= "Content-Type: text/html; ".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne . $message_html . $passage_ligne;
		//==========
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
		//==========


		// Envoi
		$ok = mail($astrEmail, mb_encode_mimeheader('FCPE - Regeneration de mot de passe'), $message, $header);
		
		if($ok){
			try {
				//error_log('['.date("F j, Y, g:i a e O").']' . "WS email OK \r\n", 0);
				//error_log('['.date("F j, Y, g:i a e O").']' . "WS email OK \r\n", 3, "erreurs-mail.log");
			}
			catch (Exception $e) 
			{
			   // Récupération silencieuse de l'erreur si l'écriture dans un fichier n'est pas permise sur ce serveur.
			}
		}else{
		
			try {
				//error_log('['.date("F j, Y, g:i a e O").']' . print_r(error_get_last(), true) . "\r\n", 0);
				//error_log('['.date("F j, Y, g:i a e O").']' . print_r(error_get_last(), true) . "\r\n", 3, "erreurs-mail.log");
			}
			catch (Exception $e) 
			{
			   // Récupération silencieuse de l'erreur si l'écriture dans un fichier n'est pas permise sur ce serveur.
			}
		}
    }
}

?>