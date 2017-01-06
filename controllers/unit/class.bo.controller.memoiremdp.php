<?PHP

/*
  --------------------------------------------------------------------
  class.bo.controller.memoire_mdp.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class bocMemoireMdpController extends boActionController {
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
        $this->_strMaster = 'all';

        // Page de base.
        $this->_strViewFileBase = "memoiremdpafficher";
    }

    # ******************************
    # Chargement des variables.
    # ******************************

    protected function _loadVar() {
        $this->_request->defineParam(0, 'mail_Saisie', '', 255);
    }

    # ******************************
    # Actions.
    # ******************************

    public function actionAfficher() {

        // Objet de vérification des saisies.
        $boInput = new common_Input($this->_connection, $this->_request);

        // Vérification de la connexion.
        if (!($boInput->checkAuthentification())) {

            // Objet de restitution.
            $boReminder = new user_Reminder($this->_connection);

            // Selection des rappels.
            if ($boReminder->getReminderByIP()) {
                $this->_strViewFile = "memoiremdpafficher";
            } else {
                // Affichage du message d'information.
                $this->_strErrorFile = "memoiremdpbanissement";
                $this->_strViewFile = "vide";
                $this->includeCSSFile('all-cadres');
            }
        } else {
            $this->_strErrorFile = "419";
            $this->_strViewFile = 'vide';
            $this->includeCSSFile('all-cadres');
        }
    }

    public function soumettre() {

        // Récupération des valeurs.
        $strEmail = $this->_request->getParamByKey('mail_Saisie');

        // Objet de vérification des saisies.
        $boInput = new common_Input($this->_connection, $this->_request);

        // Vérification de la connexion.
        if (!($boInput->checkAuthentification())) {

            $boInput->addParameter('mail_Saisie', $strEmail);

            $bParameters = $boInput->checkParameters();

            // Si les variables ont été  vérifiées avec succés.
            if ($bParameters) {

                // Selection des utilisateurs.
                $boUser = new user_User($this->_connection);
                $rdsUtilisateurs = $boUser->getDataUserByEmail($strEmail);

                // Si l'email saisie correspond à un enregistrement.
                if ($rdsUtilisateurs->RecordCount() > 0) {

                    // Objet de restitution.
                    $boReminder = new user_Reminder($this->_connection);
                    // Insertion du rappel.					
                    $lstrGuid = $boReminder->addReminder($rdsUtilisateurs->fields['id_utilisateur']);

                    // Envoie de l'email.
                    $boReminder->sendRegenerationUserPassword($strEmail, $lstrGuid);

                    $this->_strViewFile = "memoiremdpenvoyer";
                } else {
                    $this->_strErrorFile = "memoiremdpemailinconnu";
                    $this->_strViewFile = "memoiremdpafficher";
                    $this->includeCSSFile('all-cadres');
                }
            } else {

                // Affichage du message d'information.
                $this->_strErrorFile = "erreurremplissage";
                $this->includeCSSFile('all-cadres');
            }
        } else {
            $this->_strErrorFile = "419";
            $this->_strViewFile = 'vide';
            $this->includeCSSFile('all-cadres');
        }
    }
}

?>