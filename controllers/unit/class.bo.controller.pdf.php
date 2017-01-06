<?PHP

/*
  --------------------------------------------------------------------
  class.bo.controller.pdf.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class bocPdfController extends boActionController {

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
        $this->_strMaster = 'pdf';
		
        // Authentification requis.
        $this->_bAuthentification = true;		
    }

    # ******************************
    # Chargement des variables.
    # ******************************

    protected function _loadVar() {
		$this->_request->defineParam(1, 'rdsParent', 1);
		$this->_request->defineParam(1, 'rdsChildren', 1);
		$this->_request->defineParam(1, 'rdsEtablissement', 1);
		$this->_request->defineParam(1, 'rdsNiveauAdhesion', 1);
		$this->_request->defineParam(1, 'rdsCity', 1);
    }

    # ******************************
    # Actions.
    # ******************************
    public function actionAfficher() {
		
		// Création de l'objet de gestion des enfants.
        $boChildren = new user_Children($this->_connection);
        // Selection des départements.	
        $rdsChildren = $boChildren->getAll();
        $this->_request->setParamByKey('rdsChildren', $rdsChildren);
		
		// Création de l'objet de gestion des parents.
        $boParent = new user_Parent($this->_connection);
        // Selection des parents.	
        $rdsParent = $boParent->get();
		$this->_request->setParamByKey('rdsParent', $rdsParent);
		
		// Création de l'objet de gestion des etablissements.
        $boEtablissement = new reference_Etablissement($this->_connection);
		$rdsEtablissement = $boEtablissement->getById($rdsParent->fields["id_etatnorma"]);
		$this->_request->setParamByKey('rdsEtablissement', $boEtablissement->getByNomDepartementId('', $rdsEtablissement->fields["id_departement"], 2));
		
		// Création de l'objet de gestion des niveaux d'adhésion.
		$boNiveauAdhesion = new reference_NiveauAdhesion($this->_connection);
		$rdsNiveauAdhesion = $boNiveauAdhesion->getByReference($rdsEtablissement->fields["lien_niveauadhesion"]);
		$this->_request->setParamByKey('rdsNiveauAdhesion', $rdsNiveauAdhesion);
		
		// Création de l'objet de gestion des villes.
        $boCity = new city_City($this->_connection);
		if ($rdsParent->fields["id_commune"] != 0){
			$rdsCity = $boCity->getCityByID($rdsParent->fields["id_commune"]);
			$this->_request->setParamByKey('rdsCity', $rdsCity);
		}
		$this->_strMaster = 'pdf';
    }
}

?>