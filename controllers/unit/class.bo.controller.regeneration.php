<?PHP

/*
  --------------------------------------------------------------------
  class.bo.controller.regeneration.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 24/06/2008
  --------------------------------------------------------------------
  (c) 2015. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class bocRegenerationController extends boActionController {
    # ******************************
    # Constructeurs.
    # ******************************

    public function __construct(boRequest $request, boResponse $response) {

        // 1. Appel du constructeur de la classe parente
        parent::__construct($request, $response);

        // Positionnement des inclusions.
        $this->_aFileCSS = array('all-cadres', 'all-formulaire');
        $this->_aFileJS = array();
        $this->_aMenu = array();
        $this->_aCadre = array();
        
        // Positionnement du master.
        $this->_strMaster = 'main';

        // Page de base.
        $this->_strViewFileBase = "regenerationafficher";
        
        // Authentification requis.
        $this->_bNotAuthentification = true;
    }

    # ******************************
    # Chargement des variables.
    # ******************************

    protected function _loadVar() {
        $this->_request->defineParam(0, 'mdp1_Saisie', '', 32);
        $this->_request->defineParam(0, 'mdp2_Saisie', '', 32);
        $this->_request->defineParam(0, 'affichage', '', 64);
    }

    # ******************************
    # Actions.
    # ******************************

    public function actionAfficher() {
        
        // Récupération des paramètres de la page.
        $strGuid = $this->_request->getParamByKey('affichage');

        // Objet de restitution.
        $boReminder = new user_Reminder($this->_connection);
        $iIdUser = $boReminder->getReminderByGuid($strGuid);
        
        if ($iIdUser == null){
            // Affichage du message d'erreur.
            $this->_strErrorFile = "erreurregenerationguidinconnu";
            $this->_strViewFile = "vide";
            $this->_strMaster = 'main';
        }
    }

    public function soumettre() {

        // Récupération des valeurs.
        $strPassword1 = $this->_request->getParamByKey('mdp1_Saisie');
        $strPassword2 = $this->_request->getParamByKey('mdp2_Saisie');
        $strGuid = $this->_request->getParamByKey('affichage');
        

        // Objet de restitution.
        $boReminder = new user_Reminder($this->_connection);
        $iIdUser = $boReminder->getReminderByGuid($strGuid);
        
        if ($iIdUser == null){
            
            // Affichage du message d'erreur.
            $this->_strErrorFile = "erreurregenerationguidinconnu";
            $this->_strViewFile = "vide";
            $this->_strMaster = 'main';
            
        }else{
        
            // Objet de vérification des saisies.
            $boInput = new common_Input($this->_connection, $this->_request);
            $boInput->addParameter('mdp1_Saisie', $strPassword1);
            $boInput->addParameter('mdp2_Saisie', $strPassword2);

            $bPassword = $boInput->checkPassword($strPassword1, $strPassword2);
            $bParameters = $boInput->checkParameters();

            // Si les variables ont été  vérifiées avec succés.
            if ($bParameters) {
                if ($bPassword) {
                    
                    // Mise à jour du mot de passe. 
                    $boUser = new user_User($this->_connection);
                    $boUser->updateUserPassword($iIdUser, $strPassword1);

                    // Désactivation
                    $iIdUser = $boReminder->setInactif($strGuid);
        
                    $this->_strViewFile = "regenerationenvoyer";
                } else {
                    // Affichage du message d'erreur.
                    $this->_strErrorFile = "erreurregenerationpassword";
                    $this->includeCSSFile('all-cadres');
                }
            } else {
                // Affichage du message d'erreur.
                $this->_strErrorFile = "erreurremplissage";
                $this->includeCSSFile('all-cadres');
            }
        }
    }
}

?>