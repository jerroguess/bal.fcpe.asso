<?PHP

/*
  --------------------------------------------------------------------
  class.bo.action.ajax.controller.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    class boActionAjaxController {

        // Attributs.
        protected $_request;
        protected $_response;
        protected $_redirected;
        protected $_connection;
        
        // Master page.
        protected $_strMaster;
        
        // Load texte annexe.
        protected $_bLoadAnnexe = false;
        
        public function __construct(boRequest $request, boResponse $response) {
            // 0. Ouverture de la base de donnée.
            $this->_db_connect();

            // 01 Constructeur.
            $this->_request = $request;
            $this->_response = $response;

            // 2. Chargement des variables par défauts.
            $this->_loadCommonVar();
        }

        public static function process(boRequest $request, boResponse $response) {

            // 3.Sélection du controlleur appelé.
            if (!file_exists($path = dirname(__FILE__) . '/../ajax/class.bo.ajax.' . $request->getParamByKey('page') . '.php')) {
                $request->setParamByKey('page', '404');
                $path = dirname(__FILE__) . '/../ajax/class.bo.ajax.' . $request->getParamByKey('page') . '.php';
            }
            require_once($path);
            $class = 'boac' . $request->getParamByKey('page') . 'Controller';
            $controller = new $class($request, $response);

            // 4.Execution du controleur.
            return $controller->launch();
        }

        private function _getText(){
        
            putenv("LANG=" . $_SESSION["langue"]);
            setlocale(LC_ALL, $_SESSION["langue"]);

            // Set the text domain as "messages"
            bindtextdomain("ajax", "Locale");
            bind_textdomain_codeset("ajax", 'UTF-8'); 
            textdomain("ajax");
        }
        
        public static function processException(boRequest $request, boResponse $response, $e) {

            // 3*.Sélection du controlleur appelé.
            require dirname(__FILE__) . '/../ajax/class.bo.ajax.erreur.php';
            $class = 'boacErreurController';
            $controller = new $class($request, $response);

            // 4*.Execution du controleur.
            return $controller->launchException();
        }

        public function launch() {
            $this->_loadVar();
            $this->_strViewFile = $this->_request->getParamByKey('page');
            $this->_strMaster = 'json';
            
            // 5.Sélection de l'action.
            if (!$this->_actionExists('execute')) {
                throw boCoreException(500);
            }

            // 6. Gestion de la session.
            $this->_manage_session();

            // Gestion de la traduction.
            $this->_getText();
            
            // 7. Execution de l'action.
            $this->execute();
            
            // Vérification du besoin d'être authentifié.
            if ($this->_bLoadAnnexe) {
                $this->_renderAction();
            }
            
            // 8. Fin de la connection.
            $this->_db_disconnect();

            return $this->_response;
        }

        public function launchException() {

            // 5*.Sélection de l'action.
            if (!$this->_actionExists('execute')) {
                throw boCoreException(500);
            }

            // 6. Gestion de la session.
            $this->_manage_session($this->_request->getParamByKey('page'), $this->_request->getParamByKey('login'), $this->_request->getParamByKey('mdp'));

            // Gestion de la traduction.
            $this->_getText();
            
            // 7*. Execution de l'action.
            $this->execute();

            // 8. Fin de la connection.
            $this->_db_disconnect();

            return $this->_response;
        }

        private function _renderAction() {

            // 9. Appel au master.
            $_strMaster = "boMasterAjax" . $this->_strMaster;
            require dirname(__FILE__) . '/../../views/masters/unit/class.bo.masterajax.' . $this->_strMaster . '.php';
            $master = new $_strMaster($this->_request, $this->_response, $this->_strViewFile, $this->_connection);

            // 10. Affichage du master.
            $master->render();

            // 11. Fin de la connection.
            $this->_db_disconnect();
        }
        
        private function _loadCommonVar() {
            $this->_request->defineParam(1, 'erreur', 0);
            $this->_request->defineParam(0, 'nom', '', 255);
        }

        public function __get($param) {
            return $this->_response->getVar($param);
        }

        public function __set($name, $param) {
            $this->_response->setVar($name, $param);
        }

        private function _actionExists($action) {
            try {
                $method = new ReflectionMethod(get_class($this), $action);
                return ($method->isPublic() && !$method->isConstructor());
            } catch (Exception $e) {
                return false;
            }
        }

        /*
          --------------------------------------------------------------------
          SESSION.
          --------------------------------------------------------------------
         */

        private function _manage_session() {

            // On démarre la session.
            session_cache_limiter('private, must-revalidate');
            // Ouverture la session.
            session_start();
            // Regeneration de l'identifiant de session.
            session_regenerate_id();
        }

        /*
          --------------------------------------------------------------------
          DB.
          --------------------------------------------------------------------
         */

        private function _db_connect() {

            
            // Création de la nouvelle connnection ( a la base SQL_NAME changer en Mysqli, à changer en cas d'erreurs)
            $this->_connection = ADONewConnection('mysqli');  

            // Transmission des paramétres de connnection. ( a la base SQL_HOST, SQL_USER, SQL_PWD, DB_NAME, a changer en cas d'erreurs)
            $this->_connection->PConnect('localhost', 'root', '', 'fcpebasc_balinter');

            // Paramétrage de la sélection des données.
            $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
        }

        private function _db_disconnect() {

            // Deconnexion à la base de donnée.
            $this->_connection->Close();
        }
    }

?>