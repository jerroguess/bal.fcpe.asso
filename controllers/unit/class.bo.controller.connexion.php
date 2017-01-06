<?PHP

/*
  --------------------------------------------------------------------
  class.bo.controller.connexion.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class bocConnexionController extends boActionController {
    # ******************************
    # Constructeurs.
    # ******************************

    public function __construct(boRequest $request, boResponse $response) {

        // 1. Appel du constructeur de la classe parente
        parent::__construct($request, $response);

        // Positionnement des inclusions.
        $this->_aFileCSS = array();
        $this->_aFileJS = array('view-connexion');
        $this->_aMenu = array();
        $this->_aCadre = array();
        
        // Positionnement du master.
        $this->_strMaster = 'main';

        // Page de base.
        $this->_strViewFileBase = "connexionafficher";
    }

    # ******************************
    # Chargement des variables.
    # ******************************

    protected function _loadVar() {
        $this->_request->defineParam(1, 'CountAttente', 0);
    }

    # ******************************
    # Actions.
    # ******************************

    public function actionAfficher() {

        // Si  l'utilisateur n'est pas sous un bannissement.
        if ($_SESSION["banissement"] > time()) {

            // Affichage du message d'information.
            $this->_strErrorFile = "connexionbanissement";
            $this->_strViewFile = "vide";
            $this->_strMaster = 'main';
            
        } elseif ($_SESSION["statut_connection"] == 0) {

            // Visiteur.
            $this->_strViewFile = "connexionafficher";
            $this->_strMaster = 'main';
			
        } elseif ($_SESSION["statut_connection"] == 1) {
		
			// Si nous sommes utilisateur.
			$this->_strViewFile = "connexionenvoyer";
			$this->_strMaster = 'main';
		}
    }

    public function soumettre() {
        
        // Si  l'utilisateur n'est pas sous un bannissement.
        if ($_SESSION["banissement"] > time()) {

            // Affichage du message d'information.
            $this->_strErrorFile = "connexionbanissement";
            $this->_strViewFile = "vide";
            $this->_strMaster = 'main';
            
        } elseif ($_SESSION["statut_connection"] == 1) {

			// Récupération des données.
			$boAttente = new user_Attente($this->_connection);
			$this->_request->setParamByKey('CountAttente', $boAttente->getCount());

			// Si nous sommes utilisateur.
			$this->_strViewFile = "connexionenvoyer";
			$this->_strMaster = 'main';
				
        } elseif ($_SESSION["statut_connection"] == -1) {

            // Erreur de connexion.
            $this->_strErrorFile = "connexionerreur";
            $this->_strViewFile = "connexionafficher";
            $this->_strMaster = 'main';
            
        } elseif ($_SESSION["statut_connection"] == -2) {

            // Erreur validation.
            $this->_strErrorFile = "connexionvalidation";
            $this->_strViewFile = "connexionafficher";
            $this->_strMaster = 'main';
            
        } elseif ($_SESSION["statut_connection"] == 0) {

            // Visiteur.
            $this->_strViewFile = "connexionafficher";
            $this->_strMaster = 'main';
        }
    }
}

?>