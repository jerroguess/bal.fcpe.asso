<?PHP

/*
  --------------------------------------------------------------------
  class.bo.action.javascript.controller.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    class boActionJavascriptController {

        // Attributs.
        protected $_request;
        protected $_response;
        protected $_redirected;
        protected $_connection;
        
        // Master page.
        protected $_strMaster;
        
        public function __construct(boRequest $request, boResponse $response) {
            // 0. Ouverture de la base de donn�e.
            $this->_db_connect();

            // 01 Constructeur.
            $this->_request = $request;
            $this->_response = $response;

            // 2. Chargement des variables par d�fauts.
            $this->_loadCommonVar();
        }

        public static function process(boRequest $request, boResponse $response) {

            // 3.S�lection du controlleur appel�.
            $path = dirname(__FILE__) . '/../javascript/class.bo.javascript.all.php';

            require_once($path);
            $class = 'bojAllJavascript';
            $controller = new $class($request, $response);

            // 4.Execution du controleur.
            return $controller->launch();
        }

        private function _getText(){
        
            putenv("LANG=" . $_SESSION["langue"]);
            setlocale(LC_ALL, $_SESSION["langue"]);

            // Set the text domain as "messages"
            $domain = "generate";
            bindtextdomain($domain, "locale");
            bind_textdomain_codeset($domain, 'UTF-8'); 
            textdomain($domain);
        }
        
        public static function processException(boRequest $request, boResponse $response, $e) {

            // 3*.S�lection du controlleur appel�.
            require dirname(__FILE__) . '/../ajax/class.bo.ajax.erreur.php';
            $class = 'boacErreurController';
            $controller = new $class($request, $response);

            // 4*.Execution du controleur.
            return $controller->launchException();
        }

        public function launch() {
            $this->_loadVar();
            $this->_strViewFile = $this->_request->getParamByKey('page');
            $this->_strMaster = 'all';
            
            // 5.S�lection de l'action.
            if (!$this->_actionExists('execute')) {
                throw boCoreException(500);
            }

            // 6. Gestion de la session.
            $this->_manage_session();

            // Gestion de la traduction.
            $this->_getText();
            
            // 7. Execution de l'action.
            $this->execute();
            
            // V�rification du besoin d'�tre authentifi�.
            $this->_renderAction();
            
            // 8. Fin de la connection.
            $this->_db_disconnect();

            return $this->_response;
        }

        public function launchException() {

            // 5*.S�lection de l'action.
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
            $_strMaster = "boMasterJavascript" . $this->_strMaster;
            require dirname(__FILE__) . '/../../views/masters/unit/class.bo.masterjavascript.' . $this->_strMaster . '.php';
            $master = new $_strMaster($this->_request, $this->_response, $this->_strViewFile, $this->_connection);

            // 10. Affichage du master.
            $master->render();

            // 11. Fin de la connection.
            $this->_db_disconnect();
        }
        
        private function _loadCommonVar() {
            $this->_request->defineParam(0, 'langue', '', 255);
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

            // On d�marre la session.
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

            // Cr�ation de la nouvelle connnection
            $this->_connection = ADONewConnection(SQL_NAME);

            // Transmission des param�tres de connnection.
            $this->_connection->PConnect(SQL_HOST, SQL_USER, SQL_PWD, DB_NAME);

            // Param�trage de la s�lection des donn�es.
            $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
        }

        private function _db_disconnect() {

            // Deconnexion � la base de donn�e.
            $this->_connection->Close();
        }
    }

?>