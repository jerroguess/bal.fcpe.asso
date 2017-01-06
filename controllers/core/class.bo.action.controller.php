<?PHP

/*
  --------------------------------------------------------------------
  class.bo.action.controller.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    class boActionController {

        // Attributs.
        protected $_request;
        protected $_response;
        protected $_redirected;
        protected $_connection;
        
        protected $_aMenu;
        protected $_aCadre;
        
        protected $_aFileCSS;
        protected $_aURLCSS;
        protected $_aFileJS;
        
        // Master page.
        protected $_strMaster;
        // Page active.
        protected $_strViewFile;
        // Cadre erreur actif.
        protected $_strErrorFile;
        // Page de base.
        protected $_strViewFileBase;
        // Action
        protected $_strAction;
                
        // Authentification requis.
        protected $_bAuthentification = false;
        // Non authentifié requis.
        protected $_bNotAuthentification = false;
        
        public function __construct(boRequest $request, boResponse $response) {
            
            // 0. Ouverture de la base de donnée.
            $this->_db_connect();

            // 01 Constructeur.
            $this->_request = $request;
            $this->_response = $response;
            $this->_redirected = false;

            // 2. Chargement des variables par défauts.
            $this->_loadCommonVar();
        }

        public static function process(boRequest $request, boResponse $response) {

            // 3.Sélection du controlleur appelé.
            if (!file_exists($path = dirname(__FILE__) . '/../unit/class.bo.controller.' . $request->getParamByKey('page') . '.php')) {
                $request->setParamByKey('page', '404');
                $path = dirname(__FILE__) . '/../unit/class.bo.controller.' . $request->getParamByKey('page') . '.php';
            }
            
            require_once($path);
            $class = 'boc' . $request->getParamByKey('page') . 'Controller';
            $controller = new $class($request, $response);

            // 4.Execution du controleur.
            return $controller->launch();
        }

        public static function processException(boRequest $request, boResponse $response, $e) {
            // 3*.Sélection du controlleur appelé.
            require dirname(__FILE__) . '/../unit/class.bo.controller.erreur.php';
            $class = 'bocErreurController';
            $controller = new $class($request, $response);

            // 4*.Execution du controleur.
            return $controller->launchException();
        }
        
        private function _getText(){
            
            putenv("LANG=" . $_SESSION["langue"]);
            setlocale(LC_ALL, $_SESSION["langue"]);

            // Set the text domain as "messages"
            $domain = "all";
            bindtextdomain($domain, "locale");
            bind_textdomain_codeset($domain, 'iso-8859-15'); 
            textdomain($domain);
        }
        
        public function launch() {
            $this->_strTitre = "";
            $this->_strViewFile = $this->_request->getParamByKey('page');
            $this->_strAction = $this->_request->getParamByKey('action');
            $this->_strMaster = 'main';
            
            if ($this->_strAction == "") {
                $this->_strAction = "actionAfficher";
            }

            // 5. Gestion de la session.
            $this->_manage_session();

            $this->_loadVar();

            // Gestion de la traduction.
            $this->_getText();
            
            
            // Gestion du mode.
            $currentSite = new admin_Site($this->_connection);
            switch($currentSite->getModeParameter()){
                case "BETA":
                    $this->_strAction = "actionNull";
                    $this->_strTitre == "";
                    $currentUser = new user_User($this->_connection);
                    if (!($currentUser->checkAlphaUser())) {
                        $this->_aFileCSS = array('view-beta');
                        $this->_aFileJS = array('view-beta', 'all-simplecounter');
                        $this->_strViewFile = "beta";
                        $this->_strMaster = 'popup';
                    }
                    break;
                case "OFFLINE":
                    $this->_strAction = "actionNull";
                    $this->_strTitre == "";
                    $currentUser = new user_User($this->_connection);
                    if (!($currentUser->checkAlphaUser())) {
                        $this->_aFileCSS = array('view-maintenance');
                        $this->_aFileJS = array('view-maintenance');
                        $this->_strViewFile = "maintenance";
                        $this->_strMaster = 'popup';
                    }
                    break;                    
            }
            
            // Vérification du besoin d'être authentifié.
            if (($this->_bAuthentification) && ($_SESSION["statut_connection"] != 1)) {
                $this->_strErrorFile = "401";
                $this->_strViewFileBase = 'vide';
                $this->_strMaster = 'main';
                $this->_strAction = "actionErreur";
            }
            
            // Vérification du besoin d'être authentifié.
            if (($this->_bNotAuthentification) && ($_SESSION["statut_connection"] == 1)) {
                $this->_strErrorFile = "419";
                $this->_strViewFileBase = 'vide';
                $this->_strMaster = 'main';
                $this->_strAction = "actionErreur";
            }
            
            // 6. Sélection de l'action.
            if (!$this->_actionExists($this->_strAction)){
                $this->_strErrorFile = "500";
                $this->_strViewFileBase = 'vide';
                $this->_strMaster = 'main';
                $this->_strAction = "actionAfficher";
            }

            // 7. Execution de l'action.
            if (isset($this->_strViewFileBase))
                $this->_strViewFile = $this->_strViewFileBase;
            $action = $this->_strAction;
            $this->$action();

            // 8. Si pas de redirection : affichage du master.
            if (!$this->_redirected) {
                $this->_renderAction();
            }

            return $this->_response;
        }

        public function actionNull() {
            
        }
        
        public function launchException() {
            $this->_loadVar();
            $this->_strViewFile = $this->_request->getParamByKey('page');

            // 5*. Gestion de la session.
            $this->_manage_session();

            // Gestion de la traduction.
            $this->_getText();
            
            // 6*. Sélection de l'action.
            $action = $this->_request->getParamByKey('action');
            if (!$this->_actionExists($action)) {
                $this->_strErrorFile = "500";
                $this->_strViewFileBase = 'vide';
                $this->_strMaster = 'main';
            }

            // 7*. Execution de l'action.
            if (isset($this->_strViewFileBase))
                $this->_strViewFile = $this->_strViewFileBase;
            $this->$action();

            // 8*. Si pas de redirection : affichage de la page d'erreur.
            if (!$this->_redirected) {
                $this->_strErrorFile = "404";
                $this->_strViewFile = "vide";
                $this->_strMaster = 'main';
                $this->_renderAction();
            }

            return $this->_response;
        }

        private function _renderAction() {

            session_write_close();
            
            // 9. Appel au master.
            $_strMaster = "boMaster" . $this->_strMaster;
            require dirname(__FILE__) . '/../../views/masters/unit/class.bo.master.' . $this->_strMaster . '.php';
            $master = new $_strMaster($this->_request, $this->_response, $this->_strViewFile, $this->_strErrorFile, $this->_aFileCSS, $this->_aURLCSS, $this->_aFileJS, $this->_aMenu, $this->_aCadre, $this->_connection, $this->_strTitre);

            // 10. Affichage du master.
            $master->render();

            // 11. Fin de la connection.
            $this->_db_disconnect();
        }

        private function _loadCommonVar() {

            $this->_request->defineParam(0, 'action', 'actionAfficher', 255);
            $this->_request->defineParam(0, 'login', '', 255);
            $this->_request->defineParam(0, 'mdp', '', 32);
        }

        public function __get($param) {
            return $this->_response->getVar($param);
        }

        public function __set($name, $param) {
            $this->_response->setVar($name, $param);
        }

        private function _actionExists($strAction) {
            try {
                $oMethod = new ReflectionMethod(get_class($this), $strAction);
                return ($oMethod->isPublic() && !$oMethod->isConstructor());
            } catch (Exception $e) {
                return false;
            }
        }

        public function redirect($strURL) {
            if ($this->_redirected == true) {
                throw new boCoreException(4);
            }
            $this->_response->redirect($strURL);
            $this->_redirected = true;
        }
        
        public function includeCSSFile($boCSSFile){
            if (!(in_array($boCSSFile, $this->_aFileCSS))){
                $this->_aFileCSS[] = $boCSSFile;
            }
        }
        
        public function includeJSFile($boJSFile){
            if (!(in_array($boJSFile, $this->_aFileJS))){
                $this->_aFileJS[] = $boJSFile;
            }
        }
        
        /*
          --------------------------------------------------------------------
          ACTIONS DE BASES.
          --------------------------------------------------------------------
         */

        public function actionErreur() {

        }

        /*
          --------------------------------------------------------------------
          SESSION.
          --------------------------------------------------------------------
         */

        public function _manage_session() {

            // On démarre la session.
            session_cache_limiter('private, must-revalidate');
            // Ouverture la session.
            session_start();
            // Regeneration de l'identifiant de session.
            session_regenerate_id();
            
            if (!(isset($_SESSION["statut_connection"])))
                $_SESSION["statut_connection"] = -1;
            if (!(isset($_SESSION["id_utilisateur"])))
                $_SESSION["id_utilisateur"] = -1;
            if (!(isset($_SESSION["cookies"])))
                $_SESSION["cookies"] = 1;
            
            // Création de l'identifiant unique.
            if (!(isset($_SESSION["guid"]))){
                // Génération de l'identifiant unique.
                $_SESSION["guid"] = guid();
            }
            
            // Auto connexion si cookie ok.
            if ((isset($_COOKIE['adhesion_session'])) && ($_SESSION["statut_connection"] != 1)) {

                $currentUser = new user_User($this->_connection);
                $rds = $currentUser->checkCookie($_COOKIE['adhesion_session']);

                if ($rds->RecordCount() == 1) {
                    $this->_request->setParamByKey('login', $rds->fields["email"]);
                    $this->_request->setParamByKey('mdp', $rds->fields["pass"]);
                    $this->_open_session();

                    $this->_strViewFile = "connexionafficher";
                }
            }

            if ($this->_strViewFile == "deconnexion") {
                $this->_close_session();
                setcookie('adhesion_session', '', (time() + 3600 * 24 * 7));
            } elseif ($this->_strViewFile == "connexion") {
                $this->_open_session();
                $currentUser = new user_User($this->_connection);
                setcookie('adhesion_session', $currentUser->saveCookie(), (time() + 3600 * 24 * 7));
            }
 
			// Langue.
			$_SESSION["langue"] = 'fr_FR';
			$_SESSION["id_langue"] = 152;
			
            return 200;
        }
   
        private function _open_session() {

            // Récupération des paramétres.
            $strIdentifiant = $this->_request->getParamByKey('login');
            $strMotDePasse = $this->_request->getParamByKey('mdp');

            // Création de l'objet session.
            $sessionCurrent = new user_Session($this->_connection);
            // Création de l'utilisateur.
            $currentUser = new user_User($this->_connection);

            // Récupération des précédentes sessions.
            $rdsSession = $sessionCurrent->getLastSession();

            // Suppression du précédent enregistement si celui ci est égale ou supérieur à 3.
            if (($rdsSession->fields["nb_session"] >= 3) && ($_SESSION["banissement"] < time())) {
                $sessionCurrent->deleteUserSession();
            }

            // Si nous n'avons pas subit 3 échec de connexion ou bien si le temps de bannissement est passé.
            if (($rdsSession->fields["nb_session"] < 3) || (($rdsSession->fields["nb_session"] >= 3) && (($rdsSession->fields["date"] + 600) <= time()))) {

                // Verification des parametres.
                if ($strIdentifiant != "" && $strMotDePasse != "") {

                    
                    // Selection de l'identifiant de l'utilisateur.
                    $rdsUser = $currentUser->getUserByLoginPassword($strIdentifiant, $strMotDePasse);

                    // Authentification de l'utilisateur.					
                    if ($rdsUser->recordCount() == 0) 
                    {
                        
                        // Aucun utilisateur pour ce login.
                        $this->_error_session(-1);
                        
                    }
                    elseif ($strMotDePasse == $rdsUser->fields["pass"]) 
                    {

                        // Suppression du précédent banissement.
                        $sessionCurrent->deleteUserSession();

                        // Mise à jour des données de connexions.
                        $currentUser->updateUser();

                        $_SESSION["statut_connection"] = 1;
                        $_SESSION["id_utilisateur"] = $rdsUser->fields["id_utilisateur"];
						$_SESSION["id_etatnorma"] = $rdsUser->fields["id_etatnorma"];

                        if (($rdsUser->fields["prenom"] == '') && ($rdsUser->fields["nom"] == ''))
                            $_SESSION["login"] = "Inconnu";
                        else
                            $_SESSION["login"] = ucfirst(strtolower($rdsUser->fields["prenom"])) . " " . strtoupper($rdsUser->fields["nom"]);
                        $_SESSION["mdp"] = $strMotDePasse;
                        
						$_SESSION["nom"] = strtoupper($rdsUser->fields["nom"]);
						$_SESSION["type"] = strtoupper($rdsUser->fields["type"]);
						$_SESSION["prenom"] = ucfirst(strtolower($rdsUser->fields["prenom"]));
                        
                        $_SESSION["email"] = $rdsUser->fields["email"];
                        $_SESSION["date"] = $rdsUser->fields["date"];
                        $_SESSION["banissement"] = 0;
						$_SESSION["pdf"] = 1;
						
						// Création de l'objet de gestion des parents.
						$boParent = new user_Parent($this->_connection);
						
						// Selection des parents.	
						$rdsParent = $boParent->get();
						
						if ($rdsParent->RecordCount() == 0) {
							$_SESSION["pdf"] = 0;
						}
						
						if ($rdsParent->fields["id_etatnorma"] == ''){
							$_SESSION["pdf"] = 0;
						}
                    } 
                    else 
                    {
                        // Erreur d'authentification.
                        $this->_error_session(-1);
                    }
                } else {

                    // Utilisateur non authentifié.
                    $this->_error_session(0);
                }
            }

            // Si la procédure d'ouverture a rencontré une erreur alors on modifie les paramétre de session.
			if ($rdsSession->fields["nb_session"] == 0) {

				// Requete d'insertion.
				$sessionCurrent->addSession();
				$_SESSION["banissement"] = "0";
			} else if ($rdsSession->fields["nb_session"] < 3) {

				// Requete de mise à jour.
				$sessionCurrent->updateSession(($rdsSession->fields['nb_session'] + 1), $rdsSession->fields['session_id']);

				if ((($rdsSession->fields['nb_session'] + 1) >= 3) && ($_SESSION["banissement"] < time())) {
					$_SESSION["banissement"] = time() + 600;
				}
			}
        }
        
        public function _close_session() {
            // On modifie la session en cours.
            $_SESSION["statut_connection"] = -1;
            $_SESSION["id_utilisateur"] = -1;
			$_SESSION["id_etatnorma"] = null;
            $_SESSION["login"] = null;
            $_SESSION["mdp"] = null;
            $_SESSION["type"] = 0;
        }

        public function _error_session($status) {
            if ($_SESSION["statut_connection"] != 1) {
                $_SESSION["statut_connection"] = $status;
                $_SESSION["login"] = null;
                $_SESSION["mdp"] = null;
                $_SESSION["id_utilisateur"] = -1;
				$_SESSION["id_etatnorma"] = null;
                $_SESSION["type"] = 0;
            }
            $this->_strMaster = 'main';
        }
        
        /*
        --------------------------------------------------------------------
        DB.
        --------------------------------------------------------------------
        */

        public function _db_connect() {

            // Création de la nouvelle connnection ( a la base SQL_NAME changer en Mysqli, à changer en cas d'erreurs)
            $this->_connection = ADONewConnection('mysqli');  

            // Transmission des paramétres de connnection. ( a la base SQL_HOST, SQL_USER, SQL_PWD, DB_NAME, a changer en cas d'erreurs)
            $this->_connection->PConnect('localhost', 'root', '', 'fcpebasc_balinter');

            // Paramétrage de la sélection des données.
            $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
        }

        public function _db_disconnect() {

            // Deconnexion à la base de donnée.
            $this->_connection->Close();
        }
    }

?>