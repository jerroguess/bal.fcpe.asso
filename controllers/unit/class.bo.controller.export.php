<?PHP

/*
  --------------------------------------------------------------------
  class.bo.controller.export.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class bocExportController extends boActionController {

    # ******************************
    # Constructeurs.
    # ******************************

    public function __construct(boRequest $request, boResponse $response) {

        // 1. Appel du constructeur de la classe parente
        parent::__construct($request, $response);

        // Positionnement des inclusions.
        $this->_aFileCSS = array('style');
        $this->_aFileJS = array();
        $this->_aMenu = array();
        $this->_aCadre = array();

        // Positionnement du master.
        $this->_strMaster = 'main';
		
        // Authentification requis.
        $this->_bAuthentification = true;		
    }

    # ******************************
    # Chargement des variables.
    # ******************************

    protected function _loadVar() {
		$this->_request->defineParam(1, 'rdsParent', 1);
		$this->_request->defineParam(1, 'rdsEnfant', 1);
		$this->_request->defineParam(1, 'rdsEtablissement', 1);
		$this->_request->defineParam(1, 'rdsClasse', 1);
		$this->_request->defineParam(1, 'rdsCommune', 1);
		$this->_request->defineParam(1, 'rdsNiveauAdhesion', 1);
		$this->_request->defineParam(1, 'rdsDepartement', 1);
		$this->_request->defineParam(1, 'rdsExploration', 1);
    }

    # ******************************
    # Actions.
    # ******************************
    public function actionAfficher() {
		// Création de l'objet de gestion des exports.
        $boExport = new reference_Export($this->_connection);
        // Selection des établissements.	
        $rdsEtablissement = $boExport->getEtablissement();
    }
	
	public function exporterTotal() {
	
		// Création de l'objet de gestion des exports.
        $boExport = new reference_Export($this->_connection);
        
		// Selection des parents.	
        $rdsParent = $boExport->getParent();
        $this->_request->setParamByKey('rdsParent', $rdsParent);
		
		// Selection des enfants.	
        $rdsEnfant = $boExport->getEnfant();
        $this->_request->setParamByKey('rdsEnfant', $rdsEnfant);
		
		// Selection des établissements.	
        $rdsEtablissement = $boExport->getEtablissement();
        $this->_request->setParamByKey('rdsEtablissement', $rdsEtablissement);
		
		// Selection des classes.	
        $rdsClasse = $boExport->getClasse();
        $this->_request->setParamByKey('rdsClasse', $rdsClasse);
		
		// Selection des communes.	
        $rdsCommune = $boExport->getCommune();
        $this->_request->setParamByKey('rdsCommune', $rdsCommune);
		
		// Selection des niveaux d'adhésions.	
        $rdsNiveauAdhesion = $boExport->getNiveauAdhesion();
        $this->_request->setParamByKey('rdsNiveauAdhesion', $rdsNiveauAdhesion);
		
		// Selection des explorations.	
        $rdsExploration = $boExport->getExploration();
        $this->_request->setParamByKey('rdsExploration', $rdsExploration);
		
		// Selection des départements.	
        $rdsDepartement = $boExport->getDepartement();
        $this->_request->setParamByKey('rdsDepartement', $rdsDepartement);
		
		$this->_strMaster = 'sql';
		$this->_strViewFile = "exportertotal";
    }
	
	public function exporterParent() {
	
		// Création de l'objet de gestion des exports.
        $boExport = new reference_Export($this->_connection);
        // Selection des parents.	
        $rdsParent = $boExport->getParent();
        $this->_request->setParamByKey('rdsParent', $rdsParent);
		
		$this->_strMaster = 'csv';
		$this->_strViewFile = "exporterparent";
    }
	
	public function exporterEnfant() {
	
		// Création de l'objet de gestion des exports.
        $boExport = new reference_Export($this->_connection);
        // Selection des enfants.	
        $rdsEnfant = $boExport->getEnfant();
        $this->_request->setParamByKey('rdsEnfant', $rdsEnfant);
		
		$this->_strMaster = 'csv';
		$this->_strViewFile = "exporterenfant";
    }	
	
	public function exporterEtablissement() {
	
		// Création de l'objet de gestion des exports.
        $boExport = new reference_Export($this->_connection);
        // Selection des établissements.	
        $rdsEtablissement = $boExport->getEtablissement();
        $this->_request->setParamByKey('rdsEtablissement', $rdsEtablissement);
		
		$this->_strMaster = 'csv';
		$this->_strViewFile = "exporteretablissement";
    }	
	
	public function exporterClasse() {
	
		// Création de l'objet de gestion des exports.
        $boExport = new reference_Export($this->_connection);
        // Selection des classes.	
        $rdsClasse = $boExport->getClasse();
        $this->_request->setParamByKey('rdsClasse', $rdsClasse);
		
		$this->_strMaster = 'csv';
		$this->_strViewFile = "exporterclasse";
    }
	
	public function exporterCommune() {
	
		// Création de l'objet de gestion des exports.
        $boExport = new reference_Export($this->_connection);
        // Selection des communes.	
        $rdsCommune = $boExport->getCommune();
        $this->_request->setParamByKey('rdsCommune', $rdsCommune);
		
		$this->_strMaster = 'csv';
		$this->_strViewFile = "exportercommune";
    }
	
	public function exporterNiveauAdhesion() {
	
		// Création de l'objet de gestion des exports.
        $boExport = new reference_Export($this->_connection);
        // Selection des niveaux d'adhésions.	
        $rdsNiveauAdhesion = $boExport->getNiveauAdhesion();
        $this->_request->setParamByKey('rdsNiveauAdhesion', $rdsNiveauAdhesion);
		
		$this->_strMaster = 'csv';
		$this->_strViewFile = "exporterniveauadhesion";
    }
	
	public function exporterExploration() {
	
		// Création de l'objet de gestion des exports.
        $boExport = new reference_Export($this->_connection);
        // Selection des explorations.	
        $rdsExploration = $boExport->getExploration();
        $this->_request->setParamByKey('rdsExploration', $rdsExploration);
		
		$this->_strMaster = 'csv';
		$this->_strViewFile = "exporterexploration";
    }
	
	public function exporterDepartement() {
	
		// Création de l'objet de gestion des exports.
        $boExport = new reference_Export($this->_connection);
        // Selection des départements.	
        $rdsDepartement = $boExport->getDepartement();
        $this->_request->setParamByKey('rdsDepartement', $rdsDepartement);
		
		$this->_strMaster = 'csv';
		$this->_strViewFile = "exporterdepartement";
    }
}

?>