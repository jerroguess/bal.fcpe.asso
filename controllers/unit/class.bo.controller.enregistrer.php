<?PHP

/*
  --------------------------------------------------------------------
  class.bo.controller.enregistrer.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class bocEnregistrerController extends boActionController {
    # ******************************
    # Constructeurs.
    # ******************************

    public function __construct(boRequest $request, boResponse $response) {

        // 1. Appel du constructeur de la classe parente
        parent::__construct($request, $response);

        // Positionnement des inclusions.
        $this->_aFileCSS = array();
        $this->_aFileJS = array('javascript/enregistrer');
        $this->_aMenu = array();
        $this->_aCadre = array();
        
        // Positionnement du master.
        $this->_strMaster = 'main';

        // Page de base.
        $this->_strViewFileBase = "enregistrerafficher";
        
        // Authentification requis.
        $this->_bNotAuthentification = true;        
    }

    # ******************************
    # Chargement des variables.
    # ******************************

    protected function _loadVar() {
        $this->_request->defineParam(0, 'mail_Saisie', '', 255);
        $this->_request->defineParam(0, 'mdp1_Saisie', '', 32);
        $this->_request->defineParam(0, 'mdp2_Saisie', '', 32);
        $this->_request->defineParam(0, 'imageSecurite_Saisie', '', 8);
        $this->_request->defineParam(0, 'referenceSecurite_Saisie', '', 100);
        $this->_request->defineParam(4, 'cgu_Saisie', '', null);
    }

    # ******************************
    # Actions.
    # ******************************

    public function actionAfficher() {
        
    }

    public function soumettre() {

        // Récupération des valeurs.
        $strEmail = $this->_request->getParamByKey('mail_Saisie');
        $strPassword1 = $this->_request->getParamByKey('mdp1_Saisie');
        $strPassword2 = $this->_request->getParamByKey('mdp2_Saisie');
        $strImage = $this->_request->getParamByKey('imageSecurite_Saisie');
        $strReference = $this->_request->getParamByKey('referenceSecurite_Saisie');
        $bCGU = $this->_request->getParamByKey('cgu_Saisie');
        
        
        // Objet de vérification des saisies.
        $boInput = new common_Input($this->_connection, $this->_request);
        $boInput->addParameter('mail_Saisie', $strEmail);
        $boInput->addParameter('mdp1_Saisie', $strPassword1);
        $boInput->addParameter('mdp2_Saisie', $strPassword2);
        $boInput->addParameter('imageSecurite_Saisie', $strImage);
        $boInput->addParameter('referenceSecurite_Saisie', $strReference);

        $boUser = new user_User($this->_connection);

        $bEmailUnique = $boUser->checkEmailUnique($strEmail);
        $bEmail = $boInput->checkEmail($strEmail);

        $bPassword = $boInput->checkPassword($strPassword1, $strPassword2);
        $bImageSecurity = $boInput->checkImageSecurity($strReference, $strImage);
        $bParameters = $boInput->checkParameters();
        
        // Si les variables ont été  vérifiées avec succés.
        if ($bParameters) {

            if ($bEmailUnique) {

                if ($bEmail) {

                    if ($bPassword) {
                        
                        $bCGUOK = $boInput->checkTrue('cgu_Saisie', $bCGU);
                        $bParameters = $boInput->checkParameters();

                        if ($bCGUOK) {

                            if ($bImageSecurity) {

                                // Sauvegarde des données.

                                $_SESSION['id_utilisateur'] = $boUser->addUser($strEmail, $strPassword1, 1);
                                $_SESSION["prenom"] = "";
                                $_SESSION["nom"] = "Utilisateur";
                                $_SESSION["login"] = $strEmail;
								$_SESSION["statut_connection"] = 1;
								
                                // Redirection vers la page de planification.
								$this->redirect(SITE_PATH . fct_form_Url(100, array("updateparent")));
                            } else {
                                // Affichage du message d'erreur.
                                $this->_strErrorFile = "enregistrererreurimage";
                            }
                        } else {
                            // Affichage du message d'erreur.
                            $this->_strErrorFile = "erreurenregistrercgu";
                        }                           
                    } else {
                        // Affichage du message d'erreur.
                        $this->_strErrorFile = "enregistrererreurpassword";
                    }
                } else {
                    // Affichage du message d'erreur.
                    $this->_strErrorFile = "enregistrererreuremail";
                }
            } else {
                // Affichage du message d'erreur.
                $this->_strErrorFile = "enregistrererreuremailunique";
            }
        } else {
            // Affichage du message d'erreur.
            $this->_strErrorFile = "erreurremplissage";
        }
    }
}

?>
