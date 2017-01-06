<?php

/*
  --------------------------------------------------------------------
  class.bo.attente.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class user_Attente {

    private $connection;  ///<b>connect</b>		Connection SQL object

    /**
      boAttente constructor inits everything related to User.

      @param	connection		Connection to bd
     */

    public function __construct($connection) {
        $this->connection = $connection;
    }

    /**
      Add.

      @param	iIdUser
     */
    public function add($iIdUser) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $strRequete = "INSERT INTO `user_attenter` ( `id_attente` , `id_utilisateur` , `id_utilisateur_attente` , `date` , `ip` ) ";
        $strRequete .= " VALUES (NULL, '" . $iIdUser . "', '" . $_SESSION["id_utilisateur"] . "', NOW(),'" . $ip . "' ) ";
        $rds = $this->connection->Execute($strRequete);
    }

    /**
      Delete.

      @param	iIdUser
     */
    public function delete($iIdUser) {

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $rds = $this->connection->Execute("DELETE FROM `user_attenter` WHERE id_utilisateur='" . $_SESSION["id_utilisateur"] . "' AND id_utilisateur_attente='" . $iIdUser . "' LIMIT 1");
    }

    /**
      Get.
     */
    public function get() {

        $strRequete = ' SELECT media.* ';
        $strRequete .= ' FROM  `data_utilisateurs` media ';
        $strRequete .= ' INNER JOIN `user_attente` at ON media.id_utilisateur = at.id_utilisateur_attente ';
        $strRequete .= ' WHERE at.id_utilisateur=' . $_SESSION["id_utilisateur"] . ' ;';

        $rds = $this->connection->Execute($strRequete);

        return $rds;
    }

    /**
      Get count.
     */
    public function getCount() {

        $rds = $this->connection->Execute("SELECT id_attente FROM `user_attente` WHERE id_utilisateur='" . $_SESSION["id_utilisateur"] . "' ; ");
        return $rds->RecordCount();
    }

    /**
      Check User ID

      @param	iIDUser	Identifiant utilisateur
     */
    public function check($iIDUser) {

        if ($iIDUser == 0)
            return false;

        $strRequete = " SELECT id_attente ";
        $strRequete .= " FROM `user_attenter` ";
        $strRequete .= " WHERE id_utilisateur='" . $_SESSION["id_utilisateur"] . "' ";
        $strRequete .= " AND id_utilisateur_attente='" . $iIDUser . "' LIMIT 1;";

        $rds = $this->connection->Execute($strRequete);

        if ($rds->RecordCount() == 0)
            return false;
        else
            return true;
    }

}

?>