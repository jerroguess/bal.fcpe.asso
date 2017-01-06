<?PHP

/*
  --------------------------------------------------------------------
  class.bo.controller.profil.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class bocProfilController extends boActionController {
    # ******************************
    # Constructeurs.
    # ******************************

    public function __construct(boRequest $request, boResponse $response) {

        // 1. Appel du constructeur de la classe parente
        parent::__construct($request, $response);

        // Positionnement des inclusions.
        $this->_aFileCSS = array('jquery.fileupload');
        $this->_aFileJS = array('jquery.ui.widget', 'jquery.iframe-transport', 'jquery.fileupload');
        $this->_aMenu = array();
        $this->_aCadre = array();
        
        // Positionnement du master.
        $this->_strMaster = 'main';

        // Page de base.
        $this->_strViewFileBase = "profilafficher";

        // Authentification requis.
        $this->_bAuthentification = true;
    }

    # ******************************
    # Chargement des variables.
    # ******************************

    protected function _loadVar() {
        $this->_request->defineParam(0, 'nom_Saisie', '', 255);
        $this->_request->defineParam(0, 'prenom_Saisie', '', 255);
    }

    # ******************************
    # Actions.
    # ******************************

    public function actionAfficher() {

    }

    public function remplir() {
        $this->_strViewFile = "profilediter";

        $this->_request->setParamByKey('nom_Saisie', $_SESSION["nom"]);
        $this->_request->setParamByKey('prenom_Saisie', $_SESSION["prenom"]);
    }

    public function soumettre() {

        // Récupération des valeurs.
        $strNom = $this->_request->getParamByKey('nom_Saisie');
        $strPrenom = $this->_request->getParamByKey('prenom_Saisie');

        // Objet de vérification des saisies.
        $boInput = new common_Input($this->_connection, $this->_request);
        $boInput->addParameter('nom_Saisie', $strNom);
        $boInput->addParameter('prenom_Saisie', $strPrenom);
        $bParameters = $boInput->checkParameters();
        

        // Si les variables ont été  vérifiées avec succés.
        if ($bParameters) {

			// Mise à jour des données utilisateur.
			$boUser = new user_User($this->_connection);
			$boUser->updateProfil($strNom, $strPrenom, $_SESSION["id_utilisateur"]);
			$rdsUser = $boUser->getUserByID($_SESSION["id_utilisateur"]);

			// Mise à jour de la session.
			if (($strPrenom == '') && ($strNom == '')){
				$_SESSION["login"] = "Inconnu";
			}else{
				$_SESSION["login"] = ucfirst(strtolower($strPrenom)) . " " . strtoupper($strNom);
				$_SESSION["personne"] = ucfirst(strtolower($strPrenom)) . " " . strtoupper($strNom);
			}
			
			$_SESSION["nom"] = $strNom;
			$_SESSION["prenom"] = $strPrenom;
			
			$this->_strViewFile = "profilenvoyer";

        } else {
            // Affichage du message d'erreur.
            $this->_strViewFile = "profilediter";
            $this->_strErrorFile = "erreurremplissage";
        }
    }
}

?>