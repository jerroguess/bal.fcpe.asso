<?php

/*
  --------------------------------------------------------------------
  class.bo.session.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class user_Session {

    private $connection;  ///<b>connect</b>		Connection SQL object

    /**
      boSession constructor inits everything related to Session.

      @param	connection		<b>connection</b>	Connection to bd
     */

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getLastSession() {

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $rds = $this->connection->Execute("SELECT * FROM  `user_sessions` WHERE ip = '" . $ip . "' ;");

        return $rds;
    }

    public function deleteUserSession() {

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $rds = $this->connection->Execute("DELETE FROM `user_sessions` WHERE `ip`  = '" . $ip . "' LIMIT 1");
    }

    public function addSession() {

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $date = date("Y-m-d", time());

        $rds = $this->connection->Execute("INSERT INTO `user_sessions` (`id_session` , `ip` , `nb_session` , `date` ) VALUES( NULL, '" . $ip . "', '0', NOW())");
    }

    public function updateSession($iNBSession, $iIDSession) {
        $date = date("Y-m-d", time());

        $rds = $this->connection->Execute("UPDATE `user_sessions` SET `nb_session`='" . $iNBSession . "' ,`date` = NOW() where `id_session`='" . $iIDSession . "' LIMIT 1 ;");
    }

}

?>