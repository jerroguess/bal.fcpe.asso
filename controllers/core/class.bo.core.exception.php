<?PHP

/*
  --------------------------------------------------------------------
  class.bo.core.exception.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    class boCoreException extends Exception {

        public $_iCodeError;

        // Constructeur de la classe.
        // Il faut bien penser � rapeller le constructeur de la classe Exception.
        public function __construct($iCodeError) {

            if ($iCodeError == 1)
                $strMsg = "contr�leur introuvable";
            else if ($iCodeError == 2)
                $strMsg = "Masteur introuvable";
            else if ($iCodeError == 3)
                $strMsg = "Action introuvable";
            else if ($iCodeError == 4)
                $strMsg = "Une redirection a d�ja �t� demand�e";

            //parent :: __construct($strMsg);
            $_iCodeError = $iCodeError;
        }

        // Pour le fun, on ajoute une m�thode qui r�cup�re l'heure de l'erreur.
        public function getTime() {
            return date('Y-m-d H:i:s');
        }

        // M�thode retournant un message d'erreur complet et format�.
        public function getError() {

            $strRequete = "";

            // On retourne un message d'erreur complet pour nos besoins.
            $return = 'Une exception a �t� g�r�e :<br/>';
            $return .= '<strong>Message : ' . $this->getMessage() . '</strong><br/>';
            $return .= 'A la ligne : ' . $this->getLine() . '<br/>';
            $return .= 'Dans le fichier : ' . $this->getFile() . '<br/>';
            $return .= 'Il �tait : ' . $this->getTime();

            return $return;
        }
    }

?>