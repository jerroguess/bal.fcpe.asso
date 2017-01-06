<?PHP

/*
  --------------------------------------------------------------------
  class.bo.ajax.etablissement.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class boacEtablissementController extends boActionAjaxController {
    # ******************************
    # Constructeurs.
    # ******************************

    public function __construct(boRequest $request, boResponse $response) {

        // 1. Appel du constructeur de la classe parente
        parent::__construct($request, $response);
        
        // Chargement Annexe.
        $this->_bLoadAnnexe = true;        
    }

    # ******************************
    # Chargement des variables.
    # ******************************

    protected function _loadVar() {
		$this->_request->defineParam(0, 'etablissement', '');
        $this->_request->defineParam(1, 'departement', 0);
		$this->_request->defineParam(1, 'etatbal', 0);
		$this->_request->defineParam(1, 'rdsEtablissement', 1);
		$this->_request->defineParam(0, 'callback', '');
    }

    # ******************************
    # Actions.
    # ******************************

    public function execute() {
        
		// Récuperation des variables.
        $iIdDepartement = $this->_request->getParamByKey('departement');
		$iEtatBal = $this->_request->getParamByKey('etatbal');
		$strNom = $this->_request->getParamByKey('etablissement');
		
        // Positionnement du nom.
        $this->_request->setParamByKey('nom', 'etablissement');
		
        // Création de l'objet de gestion des établissements.
        $boEtablissement = new reference_Etablissement($this->_connection);
        // Selection des établissements.	
        $rdsEtablissement = $boEtablissement->getByNomDepartementId($strNom, $iIdDepartement, $iEtatBal);
        $this->_request->setParamByKey('rdsEtablissement', $rdsEtablissement);
    }
}

?>