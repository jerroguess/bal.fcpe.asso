<?PHP

/*
  --------------------------------------------------------------------
  class.bo.controller.updateparent.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class bocUpdateParentController extends boActionController {

    # ******************************
    # Constructeurs.
    # ******************************

    public function __construct(boRequest $request, boResponse $response) {

        // 1. Appel du constructeur de la classe parente
        parent::__construct($request, $response);

        // Positionnement des inclusions.
        $this->_aFileCSS = array('style');
        $this->_aFileJS = array('view-add', 'view-updateparent');
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
		$this->_request->defineParam(1, 'rdsEtablissement', 1);
		$this->_request->defineParam(1, 'rdsNiveauAdhesion', 1);
		$this->_request->defineParam(1, 'rdsParent', 1);
		$this->_request->defineParam(1, 'niveau_Saisie', 1);
		$this->_request->defineParam(1, 'id_etatnorma_Saisie', 1);
		$this->_request->defineParam(0, 'nom_Saisie', 'Nouvel', 255);
		$this->_request->defineParam(0, 'reference_Saisie', '', 5);
		$this->_request->defineParam(0, 'prenom_Saisie', 'Utilisateur', 255);
		$this->_request->defineParam(0, 'civilite_Saisie', '', 255);
		$this->_request->defineParam(0, 'nom2_Saisie', '', 255);
		$this->_request->defineParam(0, 'prenom2_Saisie', '', 255);
		$this->_request->defineParam(0, 'civilite2_Saisie', '', 255);
		$this->_request->defineParam(0, 'adresse1_Saisie', '', 255);
		$this->_request->defineParam(0, 'adresse2_Saisie', '', 255);
		$this->_request->defineParam(0, 'adresse3_Saisie', '', 255);
		$this->_request->defineParam(0, 'adresse4_Saisie', '', 255);
		$this->_request->defineParam(0, 'codepostal_Saisie', '', 255);
		$this->_request->defineParam(1, 'id_commune_Saisie', 1);
		$this->_request->defineParam(0, 'commune_Saisie', '', 255);
		$this->_request->defineParam(4, 'adhesionhorscl_Saisie', '', null);
		$this->_request->defineParam(0, 'nomautrefcpe_Saisie', '', 255);
		$this->_request->defineParam(4, 'aborp_Saisie', '', null);
		$this->_request->defineParam(4, 'abofe_Saisie', '', null);
		$this->_request->defineParam(0, 'telephone_Saisie', '', 255);
		$this->_request->defineParam(0, 'portable_Saisie', '', 255);
		$this->_request->defineParam(0, 'email_Saisie', '', 255);
		$this->_request->defineParam(0, 'email2_Saisie', '', 255);
		$this->_request->defineParam(4, 'souhpartcl_Saisie', '', null);
		$this->_request->defineParam(4, 'souhcandidatce_Saisie', '', null);
		$this->_request->defineParam(4, 'souhcandidatca_Saisie', '', null);
		$this->_request->defineParam(4, 'souhdelegue_Saisie', '', null);
		$this->_request->defineParam(4, 'souhdelclasse_Saisie', '', null);
		$this->_request->defineParam(4, 'souhnewsletter_Saisie', '', null);
		$this->_request->defineParam(0, 'nometablissement_Saisie', '', 255);
		$this->_request->defineParam(0, 'departement_Saisie', '', 255);
		$this->_request->defineParam(1, 'id_departement_Saisie', 1);
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
		
		if ($rdsParent->RecordCount() == 0) {
			$boParent->addStart($_SESSION["id_utilisateur"]);
			$rdsParent = $boParent->get();
		}
		
		$this->_request->setParamByKey('niveau_Saisie', $rdsParent->fields["id_adhesion"]);
		$this->_request->setParamByKey('etablissement_Saisie', $rdsParent->fields["id_etatnorma"]);
		$this->_request->setParamByKey('nom_Saisie', $rdsParent->fields["nom"]);
		$this->_request->setParamByKey('prenom_Saisie', $rdsParent->fields["prenom"]);
		$this->_request->setParamByKey('civilite_Saisie', $rdsParent->fields["civilite"]);
		$this->_request->setParamByKey('nom2_Saisie', $rdsParent->fields["nom2"]);
		$this->_request->setParamByKey('prenom2_Saisie', $rdsParent->fields["prenom2"]);
		$this->_request->setParamByKey('civilite2_Saisie', $rdsParent->fields["civilite2"]);
		$this->_request->setParamByKey('adresse1_Saisie', $rdsParent->fields["adresse1"]);
		$this->_request->setParamByKey('adresse2_Saisie', $rdsParent->fields["adresse2"]);
		$this->_request->setParamByKey('adresse3_Saisie', $rdsParent->fields["adresse3"]);
		$this->_request->setParamByKey('adresse4_Saisie', $rdsParent->fields["adresse4"]);
		$this->_request->setParamByKey('codepostal_Saisie', $rdsParent->fields["code_postal"]);
		$this->_request->setParamByKey('id_commune_Saisie', $rdsParent->fields["id_commune"]);
		$this->_request->setParamByKey('adhesionhorscl_Saisie', $rdsParent->fields["adhesion_hors_cl"]);
		$this->_request->setParamByKey('nomautrefcpe_Saisie', $rdsParent->fields["nom_autre_fcpe"]);
		$this->_request->setParamByKey('aborp_Saisie', $rdsParent->fields["abo_rp"]);
		$this->_request->setParamByKey('abofe_Saisie', $rdsParent->fields["abo_fe"]);
		$this->_request->setParamByKey('telephone_Saisie', $rdsParent->fields["telephone"]);
		$this->_request->setParamByKey('portable_Saisie', $rdsParent->fields["portable"]);
		$this->_request->setParamByKey('email_Saisie', $rdsParent->fields["email"]);
		$this->_request->setParamByKey('email2_Saisie', $rdsParent->fields["email2"]);
		$this->_request->setParamByKey('souhpartcl_Saisie', $rdsParent->fields["souh_part_cl"]);
		$this->_request->setParamByKey('souhcandidatce_Saisie', $rdsParent->fields["souh_candidat_ce"]);
		$this->_request->setParamByKey('souhcandidatca_Saisie', $rdsParent->fields["souh_candidat_ca"]);
		$this->_request->setParamByKey('souhdelegue_Saisie', $rdsParent->fields["souh_delegue"]);
		$this->_request->setParamByKey('souhdelclasse_Saisie', $rdsParent->fields["souh_del_classe"]);
		$this->_request->setParamByKey('souhnewsletter_Saisie', $rdsParent->fields["souh_newsletter"]);
		
		// Création de l'objet de gestion des etablissements.
        $boEtablissement = new reference_Etablissement($this->_connection);
        if ($rdsParent->fields["id_etatnorma"] == ''){
			
			$rdsEtablissement = $boEtablissement->getByNomDepartementId('', $rdsDepartement->fields["id"], 1);

			$this->_request->setParamByKey('rdsEtablissement', $rdsEtablissement);
			$this->_request->setParamByKey('id_etatnorma_Saisie', $rdsEtablissement->fields["id_etatnorma"]);
			$this->_request->setParamByKey('nometablissement_Saisie', $rdsEtablissement->fields["nom"]);
			$this->_request->setParamByKey('id_departement_Saisie', $rdsEtablissement->fields["id_departement"]);
			$this->_request->setParamByKey('reference_Saisie', $rdsEtablissement->fields["lien_niveauadhesion"]);
					
			
			// Création de l'objet de gestion des niveaux d'adhésion.
			$boNiveauAdhesion = new reference_NiveauAdhesion($this->_connection);
			$rdsNiveauAdhesion = $boNiveauAdhesion->getByReference($rdsEtablissement->fields["lien_niveauadhesion"]);
			$this->_request->setParamByKey('rdsNiveauAdhesion', $rdsNiveauAdhesion);
			$this->_request->setParamByKey('niveau_Saisie', $rdsNiveauAdhesion->fields["id"]);

			$rdsEtablissement->MoveFirst();
			$rdsDepartement->MoveFirst();
		}else{
		
			$rdsEtablissement = $boEtablissement->getById($rdsParent->fields["id_etatnorma"]);
			$this->_request->setParamByKey('id_etatnorma_Saisie', $rdsParent->fields["id_etatnorma"]);
			$this->_request->setParamByKey('nometablissement_Saisie', $rdsEtablissement->fields["nom"]);
			$this->_request->setParamByKey('id_departement_Saisie', $rdsEtablissement->fields["id_departement"]);
			$this->_request->setParamByKey('reference_Saisie', $rdsEtablissement->fields["lien_niveauadhesion"]);
			$this->_request->setParamByKey('rdsEtablissement', $boEtablissement->getByNomDepartementId('', $rdsEtablissement->fields["id_departement"], 1));
			
			// Création de l'objet de gestion des niveaux d'adhésion.
			$boNiveauAdhesion = new reference_NiveauAdhesion($this->_connection);
			$rdsNiveauAdhesion = $boNiveauAdhesion->getByReference($rdsEtablissement->fields["lien_niveauadhesion"]);
			$this->_request->setParamByKey('rdsNiveauAdhesion', $rdsNiveauAdhesion);

		}
		
		// Création de l'objet de gestion des villes.
        $boCity = new city_City($this->_connection);
		if ($rdsParent->fields["id_commune"] != 0){
			$rdsCity = $boCity->getCityByID($rdsParent->fields["id_commune"]);
			$this->_request->setParamByKey('commune_Saisie', $rdsCity->fields["commune"]);
		}
		
    }
	
	public function soumettre() {

		// Récupération des valeurs.
        $iIdEtablissement = $this->_request->getParamByKey('id_etatnorma_Saisie');
		$strReference = $this->_request->getParamByKey('reference_Saisie');
		$iIdAdhesion = $this->_request->getParamByKey('niveau_Saisie');
		$strNom = $this->_request->getParamByKey('nom_Saisie');
		$strPrenom = $this->_request->getParamByKey('prenom_Saisie');
		$strCivilite = $this->_request->getParamByKey('civilite_Saisie');
		$strNom2 = $this->_request->getParamByKey('nom2_Saisie');
		$strPrenom2 = $this->_request->getParamByKey('prenom2_Saisie');
		$strCivilite2 = $this->_request->getParamByKey('civilite2_Saisie');
		$strAdresse1 = $this->_request->getParamByKey('adresse1_Saisie');
		$strAdresse2 = $this->_request->getParamByKey('adresse2_Saisie');
		$strAdresse3 = $this->_request->getParamByKey('adresse3_Saisie');
		$strAdresse4 = $this->_request->getParamByKey('adresse4_Saisie');
		$strCodePostal = $this->_request->getParamByKey('codepostal_Saisie');
		$iIdCommune = $this->_request->getParamByKey('id_commune_Saisie');
		$bAdhesionHorsCL = $this->_request->getParamByKey('adhesionhorscl_Saisie');
		$strNomAutreFCPE = $this->_request->getParamByKey('nomautrefcpe_Saisie');
		$bAboRP = $this->_request->getParamByKey('aborp_Saisie');
		$bAboFE = $this->_request->getParamByKey('abofe_Saisie');
		$strTelephone = $this->_request->getParamByKey('telephone_Saisie');
		$strPortable = $this->_request->getParamByKey('portable_Saisie');
		$strEmail = $this->_request->getParamByKey('email_Saisie');
		$strEmail2 = $this->_request->getParamByKey('email2_Saisie');
		$bSouhPartCL = $this->_request->getParamByKey('souhpartcl_Saisie');
		$bSouhCandidatCE = $this->_request->getParamByKey('souhcandidatce_Saisie');
		$bSouhCandidatCA = $this->_request->getParamByKey('souhcandidatca_Saisie');
		$bSouhDelegue = $this->_request->getParamByKey('souhdelegue_Saisie');
		$bSouhDelClasse = $this->_request->getParamByKey('souhdelclasse_Saisie');
		$bSouhNewsletter = $this->_request->getParamByKey('souhnewsletter_Saisie');
		
		if ($strNom == "") $strNom = "Utilisateur";
		if ($strPrenom == "") $strPrenom = "Nouvel";
			
		$_SESSION["pdf"] = 1;
		
        // Mise à jour des données parents.
		$boParent = new user_Parent($this->_connection);
		$boParent->update(
			$iIdEtablissement,
			$strNom,
			$strPrenom,
			$strCivilite,
			$strNom2,
			$strPrenom2,
			$strCivilite2,
			$strAdresse1,
			$strAdresse2,
			$strAdresse3,
			$strAdresse4,
			$strCodePostal,
			$iIdCommune,
			$bAdhesionHorsCL,
			$iIdAdhesion,
			$strNomAutreFCPE,
			$bAboRP,
			$bAboFE,
			$strTelephone,
			$strPortable,
			$strEmail,
			$strEmail2,
			$bSouhPartCL,
			$bSouhCandidatCE,
			$bSouhCandidatCA,
			$bSouhDelegue,
			$bSouhDelClasse,
			$bSouhNewsletter);

		$this->_strViewFile = "updateparentenvoyer";
    }	
}

?>