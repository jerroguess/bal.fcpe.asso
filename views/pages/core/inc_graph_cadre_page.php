<?PHP

/*
  --------------------------------------------------------------------
  inc_graph_cadre_page.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

function add_cadre_menu_item_container_open() {
    echo '<div>';
}

function add_cadre_menu_item_container_close() {
    echo '</div>';
}

function add_cadre_menu_item($strPage, $strTitre, $strImage) {
    // $strPage : Nom de la page à lier
    // $strTitre : titre du cadre
    // $strImage : image à inclure.

    echo '<a href="' . $strPage . '">&nbsp;<img src="' . $strImage . '" alt="Icone"/>' . $strTitre . '</a>';
}

// --------------------------------------------
// Sous ensemble
// --------------------------------------------

function add_cadre_ensemble_ligne($iIdentifiant, $strTitre) {
    // $iIdentifiant : identifiant du cadre.
    // $strTitre : titre du cadre

    echo '<script type="text/javascript">ManageSousEnsemble.add({\'identifiant\':\'' . $iIdentifiant . '\', \'display\':false});</script>';
    echo '<div id="' . $iIdentifiant . '_title_sousensemble" class="fontCL9 pointer gras" onclick="ManageSousEnsemble.display(\'' . $iIdentifiant . '\');"><img alt="Icone" id="' . $iIdentifiant . '_icone_sousensemble" src="' . IMAGE_PATH . 'arrow-down.gif"/>&nbsp;' . $strTitre . '</div>';
    echo '<br/><div id="' . $iIdentifiant . '_container_sousensemble" class="fontCL9" style="display:none;"><br/>';
}

function add_cadre_ensemble_close_ligne() {
    echo '<br/><br/></div>';
}

// --------------------------------------------
// Sous navigation
// --------------------------------------------
function add_cadre_menu_sousnavigation($strClasses = "vertical", $astrIdentifiant = "") {
    $lstrIdentifiant = "";
    if ($astrIdentifiant != "") $lstrIdentifiant = ' id="' . $astrIdentifiant . '" ';
    
    echo '<div ' . $lstrIdentifiant . ' class="nav sub-nav ' . $strClasses . '"><ul>';
}

function add_cadre_menu_close_sousnavigation($strClasses = "vertical") {
    echo '</ul></div>';
    if ($strClasses == "horizontal") {
        echo '<div class="sub-nav-close">&nbsp;</div>';
    }
}

function add_cadre_menu_closestart_sousnavigation($astrIdentifiant = "") {
    $lstrIdentifiant = "";
    if ($astrIdentifiant != "") $lstrIdentifiant = ' id="' . $astrIdentifiant . '" ';
    
    echo '</ul></div><div id="nav-right-tab" class="nav nav-right-tab">&nbsp;</div>';
    echo '<div ' . $lstrIdentifiant . ' style="height:74px;" class="nav sub-nav-close">';
}

function add_cadre_menu_closeend_sousnavigation() {
    echo '</div>';
}

function add_cadre_menu_ligne_sousnavigation($iIdentifiant, $strTitre, $bCourant, $bPremier = false) {
    // $iIdentifiant : identifiant de l'item.
    // $strTitre : titre du cadre
    // $bCourant : item courant.

    if ($bPremier)
        $strPremier = "first";
    else
        $strPremier = "";

    if ($bCourant)
        echo '<li id="' . $iIdentifiant . '_menu_sousnavigation" class="current ' . $strPremier . '"><a onclick="ManageSousMenu.display(\'' . $iIdentifiant . '\')" href="javascript:void(0);">' . $strTitre . '</a></li>';
    else
        echo '<li id="' . $iIdentifiant . '_menu_sousnavigation" class="' . $strPremier . '"><a onclick="ManageSousMenu.display(\'' . $iIdentifiant . '\')" href="javascript:void(0);">' . $strTitre . '</a></li>';
}

function add_cadre_menu_ligne_sousnavigation_custom($iIdentifiant, $strTitre, $bCourant, $strJS, $bPremier = false) {
    // $iIdentifiant : identifiant de l'item.
    // $strTitre : titre du cadre
    // $bCourant : item courant.
    // $strJS : javascript

    if ($bPremier)
        $strPremier = "first";
    else
        $strPremier = "";

    if ($bCourant)
        echo '<li id="' . $iIdentifiant . '_menu_sousnavigation" class="current ' . $strPremier . '"><a onclick="' . $strJS . '" href="javascript:void(0);">' . $strTitre . '</a></li>';
    else
        echo '<li id="' . $iIdentifiant . '_menu_sousnavigation" class="' . $strPremier . '"><a onclick="' . $strJS . '" href="javascript:void(0);">' . $strTitre . '</a></li>';
}

function add_cadre_menu_ligne_sousnavigation_nojs($strPage, $strTitre, $bCourant, $strImage, $bPremier = false) {
    // $strPage : page à lier.
    // $strTitre : titre du cadre
    // $bCourant : item courant.
    // $strImage : image à inclure.

    if ($bPremier)
        $strPremier = "first";
    else
        $strPremier = "";

    if ($bCourant)
        echo '<li class="current ' . $strPremier . '"><a onclick="return false;" href="#">' . $strTitre . '</a></li>';
    else
        echo '<li class="' . $strPremier . '"><a href="' . $strPage . '">' . $strTitre . '</a></li>';
}

function add_cadre_menu_intercalaire_sousnavigation_nojs() {
    echo '<li class="space">&nbsp;</li>';
}

function add_cadre_container_sousnavigation() {
    echo '<div class="sub-nav-main">';
}

function add_cadre_container_close_sousnavigation() {
    echo '</div>';
}

function add_cadre_container_ligne_sousnavigation($iIdentifiant, $bCourant) {
    // $iIdentifiant : identifiant de l'item
    // $bCourant : item courant.

    echo '<script type="text/javascript">ManageSousMenu.add({\'identifiant\':\'' . $iIdentifiant . '\'});</script>';

    if ($bCourant)
        echo '<div id="' . $iIdentifiant . '_container_sousnavigation" style="display:block;">';
    else
        echo '<div id="' . $iIdentifiant . '_container_sousnavigation" style="display:none;">';
}

function add_cadre_container_close_ligne_sousnavigation() {
    echo '</div>';
}

// --------------------------------------------
// TEMPLATE
// --------------------------------------------
// Fonction permettant la fermeture du cadre d'une page.
function fermerCadrePage() {

    add_cadre_close_middle();
    add_cadre_close();
}

// --------------------------------------------
// CONTROLE CADRE CONSTRUCTION
// --------------------------------------------
function add_cadre($blnGrand = true) {
    if ($blnGrand) {
        echo '<div class="cadrecentre">';
    } else {
        echo '<div class="cadrecentrepetit">';
    }
}

function close_cadre($blnGrand = true) {
    if ($blnGrand) {
        echo '</div>';
    } else {
        echo '</div>';
    }
}

function add_cadregrey($strClass = "") {
    echo '<div class="columnsgray ' . $strClass . '">';
}

function close_cadregrey() {
    echo '</div>';
}

// Fonction permettant d'afficher un entete.
function add_cadre_title($strTitre, $strUrlImage, $strClass = 'title-text-bg', $strStyle = '') {
    // $strUrlImage : paramètre l'image affichée 
    // $strTitre : paramètre le titre affiché

    if ($strUrlImage != "") {
        echo '<img src="' . $strUrlImage . '" class="title-img-bg"/>';
        echo '<h1 class="' . $strClass . '">' . $strTitre . '</h1>';
    } else if ($strStyle != "") {
        echo '<h1 class="' . $strClass . '" style="' . $strStyle . '">' . $strTitre . '</h1>';
    } else {
        echo '<h1 class="' . $strClass . '">' . $strTitre . '</h1>';
    }
}

// Fonction permettant d'afficher un entete.
function add_cadre_title2($strTitre, $strUrlImage, $strStyle = 'title-text-bg') {
    // $strUrlImage : paramètre l'image affichée 
    // $strTitre : paramètre le titre affiché

    if ($strUrlImage != "") {
        echo '<h2 class="' . $strStyle . ' horsmenu" style="background-image:url(\'' . $strUrlImage . '\');">' . $strTitre . '</h3>';
    } else {
        echo '<h2 class="horsmenu">' . $strTitre . '</h2>';
    }
}

// Fonction permettant d'afficher un entete.
function add_cadre_title3($strTitre, $strUrlImage, $strStyle = 'title-text-bg') {
    // $strUrlImage : paramètre l'image affichée 
    // $strTitre : paramètre le titre affiché

    if ($strUrlImage != "") {
        echo '<h3 class="' . $strStyle . '" style="background-image:url(\'' . $strUrlImage . '\');">' . $strTitre . '</h3>';
    } else {
        echo '<h3>' . $strTitre . '</h3>';
    }
}

// Fonction permettant la fermeture du cadre milieu et l'ouverture du cadre bas.
function add_cadre_close_middle() {

    echo "</div>";
}

// --------------------------------------------
// CADRE EXTERIEUR
// --------------------------------------------
// Fonction permettant de fermer un cadre.
function add_cadre_close() {

    printf("</div>");

    // Afficher une ombre de taille moyenne.
    ombreCadrePage();
}

// Fonction permettant d'ajouter un cadre d'état
function add_cadre_etat($strTexte, $abln_Ligne = true) {
    add_control_statique_br();
    echo '<div><p class="columnsgray center">' . $strTexte . '</div>';
    echo "\n";
    add_control_statique_br();

    if ($abln_Ligne)
        add_cadre_inter();
}

// Fonction permettant d'ajouter un cadre d'état
function add_cadre_etat_lien($astr_Texte, $astr_Lien, $abln_Ligne = true) {
    add_control_statique_br();
    add_control_statique_input_grey_link($astr_Texte, $astr_Lien, "", "");
    add_control_statique_br();

    if ($abln_Ligne)
        add_cadre_inter();
}

function add_cadre_inter($bReturn = false) {
    // $bReturn : statut du retour
    // $strHTML = '<div class="cadreinter">&nbsp;</div>';
    $strHTML = '<img id="logo" src="' . SITE_PATH . 'public/images/sep-shadow-reverse.png"  alt="Séparateur" width="595" height="29" />';

    if (!($bReturn)) {
        echo $strHTML;
        echo "\n";
    } else {
        return $strHTML;
    }
}

function add_cadre_inter_menu($bReturn = false) {
    // $bReturn : statut du retour
    // $strHTML = '<div class="cadreinter">&nbsp;</div>';
    $strHTML = '<img id="logo" src="' . SITE_PATH . 'public/images/divider-sidebar-horizontal.png" width="300" height="15" alt="Séparateur" style="margin-left:20px;" />';

    if (!($bReturn)) {
        echo $strHTML;
        echo "\n";
    } else {
        return $strHTML;
    }
}

function add_cadre_open_margin() {
    echo "<div style=\"margin:0 20px 0 20px;\">";
}

function add_cadre_close_margin() {
    echo "</div>";
}

// --------------------------------------------
// FORM
// --------------------------------------------
// Function permettant d'ouvrir le formulaire.
function add_cadre_open_form($strLien, $strAction, $strName, $strStyle = "margin:0 20px 0 20px;") {
    // $strLien : nom de la page.
    // $strAction : valeur d'un champs invisible.
    // $strName : nom du formulaire.

    $strFormulaire = "<form id=\"" . $strName . "\" style=\"" . $strStyle . "\" ";
    if ($strLien != "")
        $strFormulaire .= "action=\"" . $strLien . "\" ";
    $strFormulaire .= " method=\"post\"  enctype=\"multipart/form-data\">";
    if ($strAction != "")
        $strFormulaire .= "<div><input type=\"hidden\" id=\"action\" name=\"action\" value =\"" . $strAction . "\"/></div>";

    echo $strFormulaire;
}

// Function permettant de finir le formulaire.
function add_cadre_close_form() {
    echo "</form>";
}

?>