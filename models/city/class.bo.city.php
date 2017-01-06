<?php

/*
  --------------------------------------------------------------------
  class.bo.city.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class city_City {

    private $strCity;       ///<b>string</b>		Name of city
    private $iCityID;       ///<b>integer</b>		City of search
    private $connection;    ///<b>connect</b>		Connection SQL object

    /**
      boCity constructor inits everything related to City.

      @param	connection		Connection to bd
     */

    public function __construct($connection) {
        $this->connection = $connection;
    }

    /**
      Check city by ID.

      @param	iCityID	City ID
     */
    public function check($iCityID) {

        $rdsCity = $this->connection->Execute('SELECT id FROM `commune` WHERE id =' . $iCityID . ' LIMIT 1;');

        if ($rdsCity->RecordCount() == 0)
            return false;
        else
            return true;
    }

    /**
      Check city persmission by ID.

      @param	iCityID	City ID
     */
    public function checkPermission($iCityID) {

        return true;
    }

    /**
      Get name by ID.

      @param	strName     Name of City
     */
    public function getListCityByName($strName) {

        $strRequete = "SELECT * FROM `commune` WHERE commune like '" . $strName . "%' ORDER BY commune;";
        $rdsCitys = $this->connection->Execute($strRequete);

        return $rdsCitys;
    }
	
    /**
      Get list of city by name and departement.

      @param	strName     			Name of City
	  @param	strCodeDepartement		Departement
     */
    public function getListCityByNameAndDepartement($strName, $strCodeDepartement) {

        $strRequete = "SELECT * FROM `commune` WHERE commune like '" . $strName . "%' AND code_postal LIKE '" . intval($strCodeDepartement) . "%' ORDER BY commune;";
        $rdsCitys = $this->connection->Execute($strRequete);

        return $rdsCitys;
    }
	
    /**
      Get city by ID.

      @param	iCityID	City ID
     */
    public function getCityByID($iCityID) {
        if ($iCityID != -1) {

            $strRequete = ' SELECT * ';
            $strRequete .= ' FROM  `commune` ';
            $strRequete .= ' WHERE id = ' . $iCityID . ' LIMIT 1;';

            $rdsCity = $this->connection->Execute($strRequete);
            return $rdsCity;
        }
    }
}

?>