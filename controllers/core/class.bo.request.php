<?PHP

/*
  --------------------------------------------------------------------
  class.bo.request.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class boRequest {

    private $aParam = array();

    public function __construct() {
        $this->defineParam(0, 'page', 'home', 255);
    }

    public function defineParam($type, $name, $default = 0, $size = 255) {
        // $type : 
        //-1 : object
        // 0 : string
        // 1 : integer
        // 2 : array
        // 3 : date
        // 4 : checkbox
        // 5 : decode א string
        // 6 : file
        // 7 : multiple data
        
        if (isset($this->aParam[$name]))
            exit - 1;

        if ($type == -1)
            $this->aParam[$name] = NULL;
        else if ($type == 0)
            $this->aParam[$name] = $this->_clearString($name, $default, $size);
        else if ($type == 1)
            $this->aParam[$name] = $this->_clearInteger($name, $default);
        else if ($type == 2)
            $this->aParam[$name] = $this->_clearArray($name, $size);
        else if ($type == 3)
            $this->aParam[$name] = $this->_clearDate($name, $default);
        else if ($type == 4)
            $this->aParam[$name] = $this->_clearCheck($name);
        else if ($type == 5)
            $this->aParam[$name] = $this->_clearStringEncode($name, $default, $size);
        else if ($type == 6)
            $this->aParam[$name] = $this->_clearFile($name);
        else if ($type == 7){
            $ltabMultipleData = $this->_clearMultipleData($name);
            $this->aParam[$name] = count($ltabMultipleData);
            if (count($ltabMultipleData) > 0){
                foreach ($ltabMultipleData as $object) {
                    if ($object->type == 0){
                        $strValeurParametre = $this->_clear($object->valeur);
                        if (is_string($strValeurParametre)) {
                            $this->aParam[$object->nom] = $strValeurParametre;
                        } else {
                            $this->aParam[$object->nom] = 0;
                        }
                    }else if ($object->type == 1){
                        $strValeurParametre = $this->_clear($object->valeur);
                        if (is_numeric($strValeurParametre)) {
                            $this->aParam[$object->nom] = $strValeurParametre;
                        } else {
                            $this->aParam[$object->nom] = "";
                        }
                    }else if ($object->type == 5){
                        $strValeurParametre = rawurldecode($this->_clear($object->valeur));
                        if (is_string($strValeurParametre)) {
                            $this->aParam[$object->nom] = $strValeurParametre;
                        } else {
                            $this->aParam[$object->nom] = 0;
                        }
                    }else{
                        $this->aParam[$name] = NULL;
                    }
                }
            }
        }else{
            $this->aParam[$name] = NULL;
        }
    }

    public function getParamByKey($key, $accent = false) {
        if (isset($this->aParam[$key])) {
            if (!($accent))
                return $this->aParam[$key];
            else
                return $this->_deleteAccents($this->aParam[$key]);
        }
    }

    public function setParamByKey($key, $value) {
        $this->aParam[$key] = $value;
    }

    private function _clear($string) {
        // $string : texte א traiter
        // Traitement via html purifier
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'ISO-8859-1');
        $config->set('HTML.Doctype', 'XHTML 1.0 Strict');
        $purificateur = new HTMLPurifier($config);
        $string = $purificateur->purify(trim($string));
        unset($config);
        unset($purificateur);

        //Traitment des donnיes avant mise א disposition.
        //$string = str_replace("'","\'",$string);

        return $string;
    }

    private function _deleteAccents($string) {
        return strtr(utf8_decode($string), "ְֱֲֳִֵאבגדהוׂ׃װױײ״עףפץצרָֹÊֻטיךכַחּֽ־ֿלםמןÙÚÛÜשתûüÿׁס", "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
    }

    private function _clearDate($key, $default) {
        $strDate = $this->_clearString($key, $default, 255);

        $aSplit = array();
        $aSplit = preg_split("/\//", $strDate);

        if (count($aSplit) != 3) {
            return mktime(1, 0, 0, date("m"), date("d"), date("Y"));
        } else {
            if (!(is_numeric($aSplit[0])))
                $aSplit[0] = date("d");
            if (!(is_numeric($aSplit[1])))
                $aSplit[1] = date("m");
            if (!(is_numeric($aSplit[2])))
                $aSplit[2] = date("Y");
            return mktime(1, 0, 0, $aSplit[1], $aSplit[0], $aSplit[2]);
        }
    }

    public function getMkTimeDate($strDate) {
        $aSplit = array();
        $aSplit = preg_split("/\//", $strDate);

        if (count($aSplit) != 3) {
            return mktime();
        } else {
            if (!(is_numeric($aSplit[0])))
                $aSplit[0] = date("d");
            if (!(is_numeric($aSplit[1])))
                $aSplit[1] = date("m");
            if (!(is_numeric($aSplit[2])))
                $aSplit[2] = date("Y");
            return mktime(0, 0, 0, $aSplit[1], $aSplit[0], $aSplit[2]);
        }
    }

    private function _clearFile($strNomParametre) {

        if (isset($_FILES[$strNomParametre])) {
            return $_FILES[$strNomParametre];
        } else {
            return null;
        }
    }

    private function _clearInteger($strNomParametre, $iValeurDefaut) {

        if (isset($_GET[$strNomParametre])) {

            $strValeurParametre = $this->_clear($_GET[$strNomParametre]);

            if (is_numeric($strValeurParametre)) {
                return $strValeurParametre;
            } else {
                return $iValeurDefaut;
            }
        } else if (isset($_POST[$strNomParametre])) {

            $strValeurParametre = $this->_clear($_POST[$strNomParametre]);

            if (is_numeric($strValeurParametre)) {
                return $strValeurParametre;
            } else {
                return $iValeurDefaut;
            }
        } else {
            return $iValeurDefaut;
        }
    }

    private function _clearMultipleData($strNomParametre) {

        
        if (isset($_GET[$strNomParametre])) {

            $strValeurParametre = $this->_clear($_GET[$strNomParametre]);
            
            if (is_string($strValeurParametre)) {
                $objDecode = json_decode($strValeurParametre);
                return $objDecode;
            } else {
                return NULL;
            }
        } else if (isset($_POST[$strNomParametre])) {

            $strValeurParametre = $this->_clear($_POST[$strNomParametre]);

            if (is_string($strValeurParametre)) {
                
                $objDecode = json_decode($strValeurParametre);
                
                return $objDecode;
            } else {
                return NULL;
            }
        } else {
            return NULL;
        }
    }
    
    private function _clearStringEncode($strNomParametre, $strValeurDefaut, $iTaille) {

        return rawurldecode($this->_clearString($strNomParametre, $strValeurDefaut, $iTaille));
    }
    
    private function _clearString($strNomParametre, $strValeurDefaut, $iTaille) {

        if (isset($_GET[$strNomParametre])) {

            $strValeurParametre = $this->_clear(substr($_GET[$strNomParametre], 0, $iTaille));

            if (is_string($strValeurParametre)) {
                return $strValeurParametre;
            } else {
                return $strValeurDefaut;
            }
        } else if (isset($_POST[$strNomParametre])) {

            $strValeurParametre = $this->_clear(substr($_POST[$strNomParametre], 0, $iTaille));

            if (is_string($strValeurParametre)) {
                return $strValeurParametre;
            } else {
                return $strValeurDefaut;
            }
        } else {
            return $strValeurDefaut;
        }
    }

    private function _clearArray($strNomParametre, $iTaille) {

        if (isset($_GET[$strNomParametre])) {

            $aTableauTemporaire = $_GET[$strNomParametre];
            $aTableau = array();
            foreach ($aMembres as $key => $value) {
                $aTableau[$key] = $this->_clear(substr($value, 0, 255));
                ;
            }

            return $aTableau;
        } else if (isset($_POST[$strNomParametre])) {

            $aTableauTemporaire = $_POST[$strNomParametre];
            $aTableau = array();
            foreach ($aTableauTemporaire as $key => $value) {
                $aTableau[$key] = $this->_clear(substr($value, 0, 255));
                ;
            }

            return $aTableau;
        } else {
            return array();
        }
    }

    private function _clearCheck($strNomParametre) {

        if (isset($_GET[$strNomParametre])) {

            if ($_GET[$strNomParametre]) {
                return true;
            } else {
                return false;
            }
        } else if (isset($_POST[$strNomParametre])) {

            if ($_POST[$strNomParametre]) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

?>