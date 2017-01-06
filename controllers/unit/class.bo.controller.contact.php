<?PHP

/*
  --------------------------------------------------------------------
  class.bo.controller.contact.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class bocContactController extends boActionController {
    # ******************************
    # Constructeurs.
    # ******************************

    public function __construct(boRequest $request, boResponse $response) {

        // 1. Appel du constructeur de la classe parente
        parent::__construct($request, $response);

        // Positionnement des inclusions.
        $this->_aFileCSS = array();
        $this->_aFileJS = array();
        $this->_aMenu = array();
        $this->_aCadre = array();

        // Positionnement du master.
        $this->_strMaster = 'main';

        // Page de base.
        $this->_strViewFileBase = "contactafficher";
    }

    # ******************************
    # Chargement des variables.
    # ******************************

    protected function _loadVar() {
        $this->_request->defineParam(0, 'auteur_Saisie', '', 255);
        $this->_request->defineParam(0, 'mail_Saisie', '', 255);
        $this->_request->defineParam(0, 'notes_Saisie', '', 2000);
    }

    # ******************************
    # Actions.
    # ******************************

    public function actionAfficher() {
        
    }

    public function soumettre() {

        // Récupération des valeurs.
        $strAuteur = $this->_request->getParamByKey('auteur_Saisie');
        $strEmail = $this->_request->getParamByKey('mail_Saisie');
        $strNotes = $this->_request->getParamByKey('notes_Saisie');

        // Objet de vérification des saisies.
        $boInput = new common_Input($this->_connection, $this->_request);
        $boInput->addParameter('auteur_Saisie', $strAuteur);
        $boInput->addParameter('mail_Saisie', $strEmail);
        $boInput->addParameter('notes_Saisie', $strNotes);

        $bParameters = $boInput->checkParameters();

        // Si les variables ont été  vérifiées avec succés.
        if ($bParameters) {

            // Requête de sélection des précédents messages.
            $boMessage = new user_Message($this->_connection);
            $rdsSelection = $boMessage->getMessages('contact');

            // L'utilisateur ne peut envoyer un message uniquement s'il ne l'a pas fait depuis 10 minutes.
            if ($rdsSelection->RecordCount() == 0) {

                // Requête d'insertion d'un contact.
                $boMessage->addMessage('contact-monumaniak', $strAuteur, $strEmail, $strNotes);
                $this->_strViewFile = "contactenvoyer";
            } else {

                // Affichage du message d'information.
                $this->_strErrorFile = "contactbanissement";
            }
        } else {

            // Affichage du message d'information.
            $this->_strErrorFile = "erreurcontact";
        }
    }
}

?>