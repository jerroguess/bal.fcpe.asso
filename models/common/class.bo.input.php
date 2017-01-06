<?php

/*
  --------------------------------------------------------------------
  class.bo.input.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class common_Input {

    private $connection;  ///<b>connect</b>		Connection SQL object
    private $request;
    private $aParameter;
    private $aError;
    private $bError;

    /**
      Input constructor inits everything related to Event.

      @param	connection		Connection to bd
      @param	request                 Request
     */
    public function __construct($connection, boRequest $request) {
        $this->connection = $connection;
        $this->request = $request;

        $this->aParameter = array();

        $this->aError = array();
        $this->bError = FALSE;
    }

    public function addParameter($strName, $strParameter) {
        $this->aParameter[$strName] = $strParameter;
    }

    public function clearParameters() {
        $this->aParameter = NULL;
    }

    /**
      --------------------------------------------------------------------
      Manage Errors
      --------------------------------------------------------------------
     */
    public function addError($strName, $strParameter) {
        $this->aError[$strName] = $strParameter;
    }

    public function clearErrors() {
        $this->aError = NULL;
    }

    /**
      --------------------------------------------------------------------
      Treat parameters
      --------------------------------------------------------------------
     */

    /**
      Treat date
     */
    public function treatDate($date) {
        return date("d/m/Y", $date);
    }

    /**
      --------------------------------------------------------------------
      Check parameters
      --------------------------------------------------------------------
     */

    /**
      Check parameters
     */
    public function checkParameters() {

        if (isset($this->aParameter)) {
            foreach ($this->aParameter as $strName => $strParameter) {
                if (($strParameter == '') || ($strParameter == '&lt;p&gt;&nbsp;&lt;/p&gt;'))
                    $this->addError($strName, TRUE);
            }
        }
        $this->clearParameters();
        $this->request->setParamByKey("error", $this->aError);
        if (count($this->aError) == 0) {
            $this->bError = FALSE;
            return TRUE;
        } else {
            $this->bError = TRUE;
            return FALSE;
        }
    }

    /**
      Check error
     */
    public function checkError() {
        return $this->bError;
    }

    /**
      Initialize error
     */
    public function initializeError() {
        $this->aError = array();
        $this->bError = FALSE;
    }

    /**
      Check authentification
     */
    public function checkAuthentification() {
        if ($_SESSION["statut_connection"] != 1)
            return FALSE;
        return TRUE;
    }

    /**
      Check genre
     */
    public function checkGenre($iParameter) {

        if (($iParameter != 0) && ($iParameter != 1)) {

            $this->addError("genre_Saisie", TRUE);
            $this->bError = TRUE;

            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
      Check type
     */
    public function checkTypeMedia($iParameter) {

        $ltabTypeMedia = array(1000, 0, 1, 2, 3, 4, 5, 6, 7);

        if (!(in_array($iParameter, $ltabTypeMedia))) {

            $this->bError = TRUE;

            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
      Check type user
     */
    public function checkTypeUser($iParameter) {

        $ltabTypeUser = array(1, 2, 3, 4, 5, 6);

        if (!(in_array($iParameter, $ltabTypeUser))) {

            $this->bError = TRUE;

            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    /**
      Check true
     */
    public function checkTrue($strName, $bParameter) {

        if ($bParameter) {
            return TRUE;
        } else {
            $this->addError($strName, TRUE);
            $this->bError = TRUE;
            return FALSE;
        }
    }

    /**
      Check category
     */
    public function checkCategory($strName, $iParameter, $iType) {

        $boCategory = new category_Category($this->connection, $iType);

        if ($boCategory->checkCategoryByID($iParameter)) {
            return TRUE;
        } else {
            $this->addError($strName, TRUE);
            $this->bError = TRUE;
            return FALSE;
        }
    }

    /**
      Check yes no
     */
    public function checkYesNo($strName, $iParameter) {
        if (($iParameter != 0) && ($iParameter != 1)) {
            $this->addError($strName, TRUE);
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
      Check interval
     */
    public function checkInterval($iParameter, $iMin, $iMax) {
        if (($iParameter < $iMin) || ($iParameter > $iMax))
            return FALSE;
        return TRUE;
    }

    /**
      Check password
     */
    public function checkPassword($strPassword1, $strPassword2) {

        if ($strPassword1 != $strPassword2) {

            $this->addError("mdp1_Saisie", TRUE);
            $this->addError("mdp2_Saisie", TRUE);

            $this->bError = TRUE;

            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
      Check image security
     */
    public function checkImageSecurity($strReference, $strValue) {

        $boSecurity = new common_Security($this->connection);

        if ($strValue == $boSecurity->getTextByReference($strReference)) {
            return TRUE;
        } else {
            $this->addError("imageSecurite_Saisie", TRUE);
            $this->addError("referenceSecurite_Saisie", TRUE);

            $this->bError = TRUE;

            return FALSE;
        }
    }

    /**
      Check Email.

      @param	strEmail	Email
     */
    public function checkEmail($strEmail) {

        // replace any ' ' and \n in the email
        $email_nr = str_replace("\\n", "", $strEmail);
        $email = str_replace(" +", "", $email_nr);
        $email = strtolower($email);

        // do the eregi to look for bad characters
        if (!preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*" . "@([a-z0-9]+([\.-][a-z0-9]+))*$/", $email)) {
            return FALSE;
        } else {

            // okay now check the domain
            // split the email at the @ and check what's left
            $item = explode("@", $email);
            $domain = $item["1"];

            if ((gethostbyname($domain) == $domain)) {
                if (gethostbyname("www." . $domain) == "www." . $domain) {
                    return FALSE;
                }
                return TRUE;
            } else {
                return TRUE;
            }
        }
    }

}

?>
