<?php

/*
  --------------------------------------------------------------------
  class.bo.security.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class common_Security {

    private $connection;  ///<b>connect</b>		Connection SQL object

    /**
      boEvent constructor inits everything related to Event.

      @param	connection		Connection to bd
     */

    public function __construct($connection) {
        $this->connection = $connection;
    }

    /**
      Get security picture.
     */
    public function getSecurityPicture($iTaille) {
        //$iTaille : taille du texte 
        // Chaine affichée généréé aléatoirement.
        $aCaracteres = array("a", "A", "b", "B", "c", "C", "d", "D", "e", "E", "f", "F", "g", "G", "h", "H", "i", "j", "J", "k", "K", "L", "m", "M", "n", "N", "p", "P", "q", "Q", "r", "R", "s", "S", "t", "T", "u", "U", "v", "V", "w", "W", "x", "X", "y", "Y", "z", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9");

        $strTextstr = "";
        for ($i = 0; $i < $iTaille; $i++) {
            $strTextstr .= $aCaracteres[rand(0, count($aCaracteres) - 1)];
        }
        $strReference = guid();
        $strRequete = "INSERT INTO `user_securite_image` (id_securite_image, date, reference, texte) VALUES (NULL, NOW(), '" . $strReference . "', '" . $strTextstr . "')";
        $rdsInsertion = $this->connection->Execute($strRequete);

        return $strReference;
    }

    /**
      Get security picture.
     */
    public function getTextByReference($strReference) {

        $strRequeteSecurite = "SELECT * FROM `user_securite_image` WHERE reference='" . $strReference . "'";

        $rdsSecurite = $this->connection->Execute($strRequeteSecurite);

        return $rdsSecurite->fields["texte"];
    }
}

?>