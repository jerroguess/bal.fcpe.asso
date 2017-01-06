<?php

/*
  --------------------------------------------------------------------
  class.bo.site.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class admin_Site {

    private $connection;    ///<b>connect</b>		Connection SQL object

    /**
      boSite constructor inits everything related to Site.

      @param	connection		Connection to bd
     */

    public function __construct($connection) {
        $this->connection = $connection;
    }

    /**
      Get parameter of site.
     */
    public function getParameter() {

        $rdsParameter = $this->connection->Execute('SELECT * FROM `admin_Site` LIMIT 1;');
        return $rdsParameter;
    }

    /**
      Get mode parameter of site.
     */
    public function getModeParameter() {
        $rdsParameter = $this->connection->Execute('SELECT mode FROM `admin_Site` LIMIT 1;');
        return $rdsParameter->fields["mode"];
    }
    
    /**
      Update Site Parameter.

      @param	iMode		Mode.
     */
    public function updateSiteParameter($iMode) {

        $strParameter = "";
        switch($iMode){
            case 1:
                $strParameter = "ONLINE";
                break;
            case -1:
                $strParameter = "BETA";
                break;
            case 0:
                $strParameter = "OFFLINE";
                break; 
            default:
                $strParameter = "ONLINE";
                break;
        }
        $strRequete = "UPDATE `admin_Site` SET `mode`='" . $strParameter . "' LIMIT 1 ;";
        $rdsMAJ = $this->connection->Execute($strRequete);
    }
}

?>