<?PHP

/*
  --------------------------------------------------------------------
  class.bo.controller.updatechildren.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class bocUpdateChildrenController extends boActionController {
    # ******************************
    # Constructeurs.
    # ******************************

    public function __construct(boRequest $request, boResponse $response) {

        // 1. Appel du constructeur de la classe parente
        parent::__construct($request, $response);

        // Positionnement des inclusions.
        $this->_aFileCSS = array('style');
        $this->_aFileJS = array('view-add', 'view-updatechildren');
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
		$this->_request->defineParam(1, 'rdsEtablissement', 1);
		$this->_request->defineParam(1, 'rdsExploration', 1);
		
		$this->_request->defineParam(1, 'id_etatnorma_Saisie', 1);
		$this->_request->defineParam(0, 'nom_Saisie', '', 255);
		$this->_request->defineParam(0, 'prenom_Saisie', '', 255);
		$this->_request->defineParam(0, 'telephone_Saisie', '', 255);
		$this->_request->defineParam(0, 'section_Saisie', '', 255);
		$this->_request->defineParam(0, 'email_Saisie', '', 255);
		$this->_request->defineParam(0, 'departement_Saisie', '', 255);
		$this->_request->defineParam(1, 'id_departement_Saisie', 1);
		$this->_request->defineParam(1, 'classe_Saisie', 1);
		$this->_request->defineParam(1, 'affichage', -1);
		$this->_request->defineParam(0, 'reference_Saisie', '', 5);
		$this->_request->defineParam(0, 'lv1_Saisie', '', 255);
		$this->_request->defineParam(0, 'lv2_Saisie', '', 255);
		$this->_request->defineParam(0, 'lv3_Saisie', '', 255);
		$this->_request->defineParam(0, 'exploration1_Saisie', 1);
		$this->_request->defineParam(0, 'exploration2_Saisie', 1);
		$this->_request->defineParam(0, 'exploration3_Saisie', 1);
		$this->_request->defineParam(3, 'dateNaissance_Saisie', date('d') . "/" . date('m') . "/" . date('Y'));
    }

    # ******************************
    # Actions.
    # ******************************

    public function actionAfficher() {
		
		// Récupération des valeurs.
        $iIdEnfant = $this->_request->getParamByKey('affichage');
		
		// Création de l'objet de gestion des explorations.
        $boExploration = new reference_Exploration($this->_connection);
		
		// Création de l'objet de gestion des enfants.
        $boChildren = new user_Children($this->_connection);
        // Selection des départements.	
        $rdsChildren = $boChildren->getById($iIdEnfant);
		
		$this->_request->setParamByKey('id_etatnorma_Saisie', $rdsChildren->fields["id_etatnorma"]);
		$this->_request->setParamByKey('nom_Saisie', $rdsChildren->fields["nom"]);
		$this->_request->setParamByKey('prenom_Saisie', $rdsChildren->fields["prenom"]);
		$this->_request->setParamByKey('telephone_Saisie', $rdsChildren->fields["telephone"]);
		$this->_request->setParamByKey('section_Saisie', $rdsChildren->fields["section"]);
		$this->_request->setParamByKey('email_Saisie', $rdsChildren->fields["email"]);
		$this->_request->setParamByKey('classe_Saisie', $rdsChildren->fields["id_classe"]);
		$this->_request->setParamByKey('lv1_Saisie', $rdsChildren->fields["lv1"]);
		$this->_request->setParamByKey('lv2_Saisie', $rdsChildren->fields["lv2"]);
		$this->_request->setParamByKey('lv3_Saisie', $rdsChildren->fields["lv3"]);
		
		$this->_request->setParamByKey('exploration1_Saisie', $rdsChildren->fields["exploration1"]);
		$this->_request->setParamByKey('exploration2_Saisie', $rdsChildren->fields["exploration2"]);
		$this->_request->setParamByKey('exploration3_Saisie', $rdsChildren->fields["exploration3"]);
		
		$this->_request->setParamByKey('dateNaissance_Saisie', date("d/m/Y", strtotime($rdsChildren->fields["date_naissance"])));
		
        // Création de l'objet de gestion des départements.
        $boDepartement = new reference_Departement($this->_connection);
        // Selection des départements.	
        $rdsDepartement = $boDepartement->getAll();
        $this->_request->setParamByKey('rdsDepartement', $rdsDepartement);
		

		// Création de l'objet de gestion des etablissements.
        $boEtablissement = new reference_Etablissement($this->_connection);
        if ($rdsChildren->fields["id_etatnorma"] == ''){
			
			$rdsEtablissement = $boEtablissement->getByNomDepartementId('', $rdsDepartement->fields["id"], 0);

			$this->_request->setParamByKey('rdsEtablissement', $rdsEtablissement);
			$this->_request->setParamByKey('id_etatnorma_Saisie', $rdsEtablissement->fields["id_etatnorma"]);
			$this->_request->setParamByKey('nometablissement_Saisie', $rdsEtablissement->fields["nom"]);
			$this->_request->setParamByKey('id_departement_Saisie', $rdsEtablissement->fields["id_departement"]);
			$this->_request->setParamByKey('reference_Saisie', $rdsEtablissement->fields["lien_niveauadhesion"]);
			$this->_request->setParamByKey('rdsExploration', $boExploration->getAll());
			
			$rdsEtablissement->MoveFirst();
			$rdsDepartement->MoveFirst();
		}else{
			$rdsEtablissement = $boEtablissement->getById($rdsChildren->fields["id_etatnorma"]);
			$this->_request->setParamByKey('id_etatnorma_Saisie', $rdsChildren->fields["id_etatnorma"]);
			$this->_request->setParamByKey('nometablissement_Saisie', $rdsEtablissement->fields["nom"]);
			$this->_request->setParamByKey('id_departement_Saisie', $rdsEtablissement->fields["id_departement"]);
			$this->_request->setParamByKey('reference_Saisie', $rdsEtablissement->fields["lien_niveauadhesion"]);
			$this->_request->setParamByKey('rdsEtablissement', $boEtablissement->getByNomDepartementId('', $rdsEtablissement->fields["id_departement"], 0));
			$this->_request->setParamByKey('rdsExploration', $boExploration->getAll());
		}
		
		// Création de l'objet de gestion des classes.
        $boclasse = new reference_Classe($this->_connection);
        // Selection des classes.	
        $rdsTartanpion = $boclasse->getAll();
        $this->_request->setParamByKey('rdsTartanpion', $rdsTartanpion);		
    }
	
	public function soumettre() {

		// Récupération des valeurs.
		$iIdEnfant = $this->_request->getParamByKey('affichage');
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
		
        // Modification d'un enfant.
		$boChildren = new user_Children($this->_connection);
		$boChildren->update(
			$iIdEnfant,
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

		$this->_strViewFile = "updatechildrenenvoyer";
    }		
}

?>