<?php

/*
  --------------------------------------------------------------------
  view.bo.all.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    // Jour et mois.
    echo 'var kstrDimanche = "' . _("generate_dimanche") . '";';
    echo 'var kstrLundi = "' . _("generate_lundi") . '";';
    echo 'var kstrMardi = "' . _("generate_mardi") . '";';
    echo 'var kstrMercredi = "' . _("generate_mercredi") . '";';
    echo 'var kstrJeudi = "' . _("generate_jeudi") . '";';
    echo 'var kstrVendredi = "' . _("generate_vendredi") . '";';
    echo 'var kstrSamedi = "' . _("generate_samedi") . '";';
    echo "\n\r";
    
    echo 'var kstrJanvier = "' . _("generate_janvier") . '";';
    echo 'var kstrFevrier = "' . _("generate_fevrier") . '";';
    echo 'var kstrMars = "' . _("generate_mars") . '";';
    echo 'var kstrAvril = "' . _("generate_avril") . '";';
    echo 'var kstrMai = "' . _("generate_mai") . '";';
    echo 'var kstrJuin = "' . _("generate_juin") . '";';
    echo 'var kstrJuillet = "' . _("generate_juillet") . '";';
    echo 'var kstrAout = "' . _("generate_aout") . '";';
    echo 'var kstrSeptembre = "' . _("generate_septembre") . '";';
    echo 'var kstrOctobre = "' . _("generate_octobre") . '";';
    echo 'var kstrNovembre = "' . _("generate_novembre") . '";';
    echo 'var kstrDecembre = "' . _("generate_decembre") . '";';
    echo "\n\r";
    
    // Textes des champs de recherches.
    echo 'var kstr_Evenement = "' . _("generate_evenement_ect") . '";';
    echo 'var kstr_Groupe = "' . _("generate_groupe_etc") . '";';
    echo 'var kstr_Utilisateur = "' . _("generate_membre_etc") . '";';
    echo 'var kstr_Localite = "' . _("generate_lieu_etc") . '";';
    echo 'var kstr_Commerce = "' . _("generate_commerce_etc") . '";';
    echo 'var kstr_Balade = "' . _("generate_balade_etc") . '";';
    echo 'var kstr_Sejour = "' . _("generate_sejour_etc") . '";';
    echo 'var kstr_Activite = "' . _("generate_activite_etc") . '";';
    echo 'var kstr_City = "' . _("generate_city") . '";';
    echo 'var kstr_Tout = "' . _("generate_tout") . '";';
    echo "\n\r";

    // Textes des libellés de recherches.
    echo 'var kstr_LibelleEvenement = "' . _("generate_evenements") . '";';
    echo 'var kstr_LibelleGroupe = "' . _("generate_groupes") . '";';
    echo 'var kstr_LibelleUtilisateur = "' . _("generate_membres") . '";';
    echo 'var kstr_LibelleLocalite = "' . _("generate_lieux") . '";';
    echo 'var kstr_LibelleCommerce = "' . _("generate_commerces") . '";';
    echo 'var kstr_LibelleBalade = "' . _("generate_balades") . '";';
    echo 'var kstr_LibelleSejour = "' . _("generate_sejours") . '";';
    echo 'var kstr_LibelleActivite = "' . _("generate_activites") . '";';
    echo 'var kstr_LibelleCity = "' . _("generate_commune") . '";';
    echo 'var kstr_LibelleTout = "' . _("generate_tous") . '";';
    echo 'var kstr_LibelleQuoi = "' . _("generate_quoi") . '";';
    echo 'var kstr_LibelleQui = "' . _("generate_qui") . '";';
    echo "\n\r";
    
    // Trip.
    echo 'var kstr_Erreur = "' . _("generate_erreur") . '";';
    echo "\n\r";
    
    // Langues.
    echo 'var kstr_Anglais = "' . _("generate_anglais") . '";';
    echo 'var kstr_AnglaisDescription = "' . _("generate_anglaisdescription") . '";';
    echo 'var kstr_Francais = "' . _("generate_francais") . '";';
    echo 'var kstr_FrancaisDescription = "' . _("generate_francaisdescription") . '";';
    echo "\n\r";
    
    // Données diverses.
    echo 'var kstr_SessionId = "' . session_id() . '";';
    list($strCodeLangue, $strCodePays) = explode("_", $_SESSION["langue"]);
    echo 'var kstr_CodeLangue = "' . $strCodeLangue . '";';
    echo "\n\r";
    
?>