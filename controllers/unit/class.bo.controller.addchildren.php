<?PHP

/*
  --------------------------------------------------------------------
  class.bo.controller.addchildren.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class bocAddChildrenController extends boActionController {
    # ******************************
    # Constructeurs.
    # ******************************

    public function __construct(boRequest $request, boResponse $response) {

        // 1. Appel du constructeur de la classe parente
        parent::__construct($request, $response);

        // Positionnement des inclusions.
        $this->_aFileCSS = array('style');
        $this->_aFileJS = array('view-add', 'view-addchildren');
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
		
		$this->_request->defineParam(1, 'rdsDepartement', 1);
		$this->_request->defineParam(1, 'rdsClasse', 1);
		$this->_request->defineParam(1, 'rdsParent', 1);
		$this->_request->defineParam(1, 'rdsExploration', 1);
		$this->_request->defineParam(1, 'rdsEtablissement', 1);
		
		$this->_request->defineParam(1, 'id_etatnorma_Saisie', 1);
		$this->_request->defineParam(0, 'nom_Saisie', '', 255);
		$this->_request->defineParam(0, 'prenom_Saisie', '', 255);
		$this->_request->defineParam(0, 'telephone_Saisie', '', 255);
		$this->_request->defineParam(0, 'section_Saisie', '', 255);
		$this->_request->defineParam(0, 'email_Saisie', '', 255);
		$this->_request->defineParam(0, 'departement_Saisie', '', 255);
		$this->_request->defineParam(1, 'id_departement_Saisie', 1);
		$this->_request->defineParam(1, 'classe_Saisie', 1);
		$this->_request->defineParam(0, 'reference_Saisie', '', 5);
		$this->_request->defineParam(0, 'lv1_Saisie', '', 255);
		$this->_request->defineParam(0, 'lv2_Saisie', '', 255);
		$this->_request->defineParam(0, 'lv3_Saisie', '', 255);
		$this->_request->defineParam(0, 'exploration1_Saisie', 0);
		$this->_request->defineParam(0, 'exploration2_Saisie', 0);
		$this->_request->defineParam(0, 'exploration3_Saisie', 0);
		$this->_request->defineParam(3, 'dateNaissance_Saisie', date("d/m/Y"));
    }

    # ******************************
    # Actions.
    # ******************************

    public function actionAfficher() {
		
        // Création de l'objet de gestion des départements.
        $boDepartement = new reference_Departement($this->_connection);
        // Selection des départements.	
        $rdsDepartement = $boDepartement->getAll();
        $this->_request->setParamByKey('rdsDepartement', $rdsDepartement);
		
		// Création de l'objet de gestion des parents.
        $boParent = new user_Parent($this->_connection);
        // Selection des parents.	
        $rdsParent = $boParent->get();

		// Création de l'objet de gestion des explorations.
        $boExploration = new reference_Exploration($this->_connection);
		
		// Création de l'objet de gestion des etablissements.
        $boEtablissement = new reference_Etablissement($this->_connection);
        if ($rdsParent->fields["id_etatnorma"] != 0){
			$rdsEtablissement = $boEtablissement->getById($rdsParent->fields["id_etatnorma"]);
			$this->_request->setParamByKey('id_etatnorma_Saisie', $rdsEtablissement->fields["id_etatnorma"]);
			$this->_request->setParamByKey('nometablissement_Saisie', $rdsEtablissement->fields["nom"]);
			$this->_request->setParamByKey('id_departement_Saisie', $rdsEtablissement->fields["id_departement"]);
			$this->_request->setParamByKey('reference_Saisie', $rdsEtablissement->fields["lien_niveauadhesion"]);
			$this->_request->setParamByKey('rdsEtablissement', $boEtablissement->getByNomDepartementId('', $rdsEtablissement->fields["id_departement"], 0));
			$this->_request->setParamByKey('rdsExploration', $boExploration->getAll());
			
			$rdsEtablissement->MoveFirst();
			$rdsDepartement->MoveFirst();
		}	
		
		// Création de l'objet de gestion des villes.
        $boCity = new city_City($this->_connection);
		if ($rdsParent->fields["id_commune"] != 0){
			$rdsCity = $boCity->getCityByID($rdsParent->fields["id_commune"]);
			$this->_request->setParamByKey('commune_Saisie', $rdsCity->fields["commune"]);
		}
		
		$this->_request->setParamByKey('dateNaissance_Saisie', date("d/m/Y"));
		
		// Création de l'objet de gestion des classes.
        $boclasse = new reference_Classe($this->_connection);
        // Selection des classes.	
        $rdsTartanpion = $boclasse->getAll();
        $this->_request->setParamByKey('rdsTartanpion', $rdsTartanpion);		
    }
	
	public function soumettre() {

		// Récupération des valeurs.
        $iIdEtablissement = $this->_request->getParamByKey('id_etatnorma_Saisie');
		$strNom = $this->_request->getParamByKey('nom_Saisie');
		$strPrenom = $this->_request->getParamByKey('prenom_Saisie');
		$strSection = $this->_request->getParamByKey('section_Saisie');
		$strTelephone = $this->_request->getParamByKey('telephone_Saisie');
		$strEmail = $this->_request->getParamByKey('email_Saisie');
		$iIdClasse = $this->_request->getParamByKey('classe_Saisie');
		$strLV1 = $this->_request->getParamByKey('lv1_Saisie');
		$strLV2 = $this->_request->getParamByKey('lv2_Saisie');
		$strLV3 = $this->_request->getParamByKey('lv3_Saisie');
		
		$iIdExploration1 = $this->_request->getParamByKey('exploration1_Saisie');
		$iIdExploration2 = $this->_request->getParamByKey('exploration2_Saisie');
		$iIdExploration3 = $this->_request->getParamByKey('exploration3_Saisie');
		
		$dateNaissance = $this->_request->getParamByKey('dateNaissance_Saisie');
		
		// Création de l'objet de gestion des parents.
        $boParent = new user_Parent($this->_connection);
        // Selection des parents.	
        $rdsParent = $boParent->get();
		
        // Ajout d'un enfant.
		$boChildren = new user_Children($this->_connection);
		$boChildren->add(
			$rdsParent->fields["id"], 
			$iIdEtablissement, 
			$iIdClasse,
			$strNom,
			$strPrenom,
			$strSection,
			$strTelephone,
			$strEmail,
			$strLV1,
			$strLV2,
			$strLV3,
			$iIdExploration1,
			$iIdExploration2,
			$iIdExploration3,
			date("Y-m-d", $dateNaissance));

		$this->_strViewFile = "addchildrenenvoyer";
    }		
}

?>