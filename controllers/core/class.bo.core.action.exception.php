<?PHP

/*
--------------------------------------------------------------------
class.bo.core.action.exception.php
--------------------------------------------------------------------
Creator : X.ROUILLY 10/02/2015
--------------------------------------------------------------------
(c) 2013. All Rights Reserved.  FCPE
--------------------------------------------------------------------
*/

    class boCoreActionException extends Exception {

        public function __construct($iCodeError, $oAction) {

            switch ($iCodeError) {
                case 401 :
                    $oAction->_strErrorFile = "401";
                    $oAction->_strViewFileBase = 'vide';
                    break;
                case 404 :
                    $oAction->_strErrorFile = "404";
                    $oAction->_strViewFileBase = 'vide';
                    break;
                case 500 :
                    $oAction->_strErrorFile = "500";
                    $oAction->_strViewFileBase = 'vide';
                    break;
                case 503 :
                    $oAction->_strErrorFile = "503";
                    $oAction->_strViewFileBase = 'vide';
                    break;
            }
        }
    }

?>