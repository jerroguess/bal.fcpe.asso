<?PHP

/*
  --------------------------------------------------------------------
  inc_form_traitement_text.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

function replace_unicode_escape_sequence($match) {
    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'CP1252');
}

function unicode_decode($str){
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $str);
}

function fct_form_Url($aint_Type, $atab_Arguments) {

    switch ($aint_Type) {

        case 1 :
            // Page City
            // 0 : nom de la ville
            // 1 : identifiant de la ville
            return 'city/' . fct_form_ConvertForUri($atab_Arguments[0]) . '-' . $atab_Arguments[1] . '.html';

            break;

        case 2 :
            // Page Département
            // 0 : nom du département
            // 1 : identifiant du département
            return 'departement/' . fct_form_ConvertForUri($atab_Arguments[0]) . '-' . $atab_Arguments[1] . '.html';
            break;

        case 3 :
            // Page Media
            // 0 : type
            // 1 : nom
            // 2 : identifiant

            $lstr_Nom = fct_form_ConvertForUri($atab_Arguments[1]);
            if (str_replace("'", "\'", $lstr_Nom) == "") {
                $lstr_Nom = "Sans nom";
            }

            switch ($atab_Arguments[0]) {
                case 4 :
                    return 'shop/' . $lstr_Nom . '-' . $atab_Arguments[2] . '.html';
                    break;
            }
            break;

        case 4 :
            // Page search (complète)
            // 0 : recherche
            // 1 : sort
            // 2 : ordre
            // 3 : par page
            // 4 : position (affichage)
            // 5 : page cible
			return $atab_Arguments[5] . '/search/' . fct_form_ConvertForUri($atab_Arguments[0]) . '/' . $atab_Arguments[1] . '/' . $atab_Arguments[2] . '/' . $atab_Arguments[3] . '/' . $atab_Arguments[4];
			break;
			
        case 80 :
            // Page Media
            // 0 : type recherche
            // 1 : nom du média
            // 2 : id média
            // 3 : onglet
            switch ($atab_Arguments[0]) {
                case 4 :
                    return 'shop/' . fct_form_ConvertForUri($atab_Arguments[1]) . '-' . $atab_Arguments[2] . '-' . $atab_Arguments[3] . '.html';
                    break;
            }
            break;

        case 89 :
            // Page classique
            // 0 : destination
            // 1 : affichage
            return fct_form_ConvertForUri($atab_Arguments[0]) . '/' . fct_form_ConvertForUri($atab_Arguments[1]);
            break;
        
        case 90 :
            // Page classique
            // 0 : destination
            // 1 : action
            return fct_form_ConvertForUri($atab_Arguments[0]) . '/' . fct_form_ConvertForUri($atab_Arguments[1]);
            break;

        case 91 :
            // Page classique
            // 0 : destination
            // 1 : action
            // 2 : affichage
            return fct_form_ConvertForUri($atab_Arguments[0]) . '/' . fct_form_ConvertForUri($atab_Arguments[1]) . '/' . fct_form_ConvertForUri($atab_Arguments[2]);
            break;

        case 92 :
            // Page classique
            // 0 : destination
            // 1 : action
            // 2 : affichage
            // 3 : travail
            return fct_form_ConvertForUri($atab_Arguments[0]) . '/' . fct_form_ConvertForUri($atab_Arguments[1]) . '/' . fct_form_ConvertForUri($atab_Arguments[2]) . '/' . fct_form_ConvertForUri($atab_Arguments[3]);
            break;

        case 100 :
            // Page classique
            // 0 : destination
            return fct_form_ConvertForUri($atab_Arguments[0]);
            break;

        default :
            break;
    }
}

function fct_form_ConvertForUri($texte) {

    $texte = str_replace(
            array(
        'à', 'â', 'ä', 'á', 'ã', 'å',
        'î', 'ï', 'ì', 'í',
        'ô', 'ö', 'ò', 'ó', 'õ', 'ø',
        'ù', 'û', 'ü', 'ú',
        'é', 'è', 'ê', 'ë',
        'ç', 'ÿ', 'ñ',
        'À', 'Â', 'Ä', 'Á', 'Ã', 'Å',
        'Î', 'Ï', 'Ì', 'Í',
        'Ô', 'Ö', 'Ò', 'Ó', 'Õ', 'Ø',
        'Ù', 'Û', 'Ü', 'Ú',
        'É', 'È', 'Ê', 'Ë',
        'Ç', 'Ÿ', 'Ñ', ' ', '\'', '/',':'
            ), array(
        'a', 'a', 'a', 'a', 'a', 'a',
        'i', 'i', 'i', 'i',
        'o', 'o', 'o', 'o', 'o', 'o',
        'u', 'u', 'u', 'u',
        'e', 'e', 'e', 'e',
        'c', 'y', 'n',
        'A', 'A', 'A', 'A', 'A', 'A',
        'I', 'I', 'I', 'I',
        'O', 'O', 'O', 'O', 'O', 'O',
        'U', 'U', 'U', 'U',
        'E', 'E', 'E', 'E',
        'C', 'Y', 'N', '%20', '', '', ''
            ), trim($texte));

    $texte = str_replace(" ", "-", $texte);

    while (strpos($texte, "--"))
        $texte = str_replace("--", "-", $texte);
    while (strpos($texte, "."))
        $texte = str_replace(".", "", $texte);

    return $texte;
}

function fct_form_nettoyageChamp($strString, $iTaille) {
    // $strString : texte à traiter
    // $iTaille : taille

    $aNote = explode('§', wordwrap(fct_form_nettoyageTexteEnrichiSimplifie($strString), $iTaille, '§'));
    if (count($aNote) > 1)
        $aNote[0] .= " ...";
    return $aNote[0];
}

function fct_form_nettoyageTexteEnrichiSimplifie($string) {
    // $string : texte à traiter

    if (get_magic_quotes_gpc()) {
        $string = stripslashes($string);
    }

    $string = str_replace(array("&amp;", "&lt;", "&gt;"), array("&amp;amp;", "&amp;lt;", "&amp;gt;",), $string);
    // fix &entitiy\n;
    $string = preg_replace('#(&\#*\w+)[\s\r\n]+;#U', "$1;", $string);
    $string = html_entity_decode($string, ENT_COMPAT, "ISO-8859-1");


    // remove any attribute starting with "on" or xmlns
    $string = preg_replace('#(<[^>]+[\s\r\n\"\'])(on|xmlns)[^>]*>#iU', "$1>", $string);
    // remove javascript: and vbscript: protocol
    $string = preg_replace('#([a-z]*)[\s\r\n]*=[\s\n\r]*([\`\'\"]*)[\\s\n\r]*j[\s\n\r]*a[\s\n\r]*v[\s\n\r]*a[\s\n\r]*s[\s\n\r]*c[\s\n\r]*r[\s\n\r]*i[\s\n\r]*p[\s\n\r]*t[\s\n\r]*:#iU', '$1=$2nojavascript...', $string);
    $string = preg_replace('#([a-z]*)[\s\r\n]*=([\'\"]*)[\s\n\r]*v[\s\n\r]*b[\s\n\r]*s[\s\n\r]*c[\s\n\r]*r[\s\n\r]*i[\s\n\r]*p[\s\n\r]*t[\s\n\r]*:#iU', '$1=$2novbscript...', $string);
    //<span style="width: expression(alert('Ping!'));"></span>
    // only works in ie...
    $string = preg_replace('#(<[^>]+)style[\s\r\n]*=[\s\r\n]*([\`\'\"]*).*expression[\s\r\n]*\([^>]*>#iU', "$1>", $string);
    $string = preg_replace('#(<[^>]+)style[\s\r\n]*=[\s\r\n]*([\`\'\"]*).*s[\s\n\r]*c[\s\n\r]*r[\s\n\r]*i[\s\n\r]*p[\s\n\r]*t[\s\n\r]*:*[^>]*>#iU', "$1>", $string);
    //remove namespaced elements (we do not need them...)
    $string = preg_replace('#</*\w+:\w[^>]*>#i', "", $string);
    //$string = str_replace("'","\'",$string);
    $string = nl2br($string);
    $string = str_replace(array("\n", "\r"), "", $string);


    //remove really unwanted tags
    do {
        $oldstring = $string;
        $string = preg_replace('#</*(style|script|b|p|embed|object|iframe|frame|frameset|ilayer|layer|bgsound|title|base)[^>]*>#i', "", $string);
    } while ($oldstring != $string);

    return $string;
}

function fct_form_nettoyageTexteEnrichi($string) {
    // $string : texte à traiter

    // Traitement via html purifier
    $config = HTMLPurifier_Config::createDefault();
    $config->set('Core.Encoding', 'ISO-8859-1');
    $config->set('HTML.Doctype', 'XHTML 1.0 Strict');
    $purificateur = new HTMLPurifier($config);
    $string = $purificateur->purify($string);
    unset($config);
    unset($purificateur);

    //Traitment des données avant mise à disposition.
    $string = str_replace("'", "\'", $string);

    return $string;
}

function fct_form_code_to_html($string) {
    // $string : texte à traiter

    if (get_magic_quotes_gpc()) {
        $string = stripslashes($string);
    }

    return $string;
}

function fct_form_diffusion($mode) {
    // $mode : mode de diffusion

    if ($mode == 0)
        return TXT_PUBLIC;
    else
        return TXT_PRIVE;
}

function fct_form_parametre_entre_integer($strNomParametre, $iValeurDefaut) {

    if (isset($_GET[$strNomParametre])) {

        $parametre = fct_form_nettoyageTexteEnrichi($_GET[$strNomParametre]);

        if (is_numeric($parametre)) {
            return $parametre;
        } else {
            return $iValeurDefaut;
        }
    } else if (isset($_POST[$strNomParametre])) {

        $parametre = fct_form_nettoyageTexteEnrichi($_POST[$strNomParametre]);

        if (is_numeric($parametre)) {
            return $parametre;
        } else {
            return $iValeurDefaut;
        }
    } else {
        return $iValeurDefaut;
    }
}

function fct_form_parametre_entre_string($strNomParametre, $strValeurDefaut) {

    if (isset($_GET[$strNomParametre])) {

        $parametre = fct_form_nettoyageTexteEnrichi($_GET[$strNomParametre]);

        if (is_string($parametre)) {
            return $parametre;
        } else {
            return $strValeurDefaut;
        }
    } else if (isset($_POST[$strNomParametre])) {

        $parametre = fct_form_nettoyageTexteEnrichi($_POST[$strNomParametre]);

        if (is_string($parametre)) {
            return $parametre;
        } else {
            return $strValeurDefaut;
        }
    } else {
        return $strValeurDefaut;
    }
}

function guint() {
    $strNombreAleatoire = "";
    for ($i = 0; $i < 9; $i++)
        $strNombreAleatoire .= mt_rand(1, 9);
    return intval($strNombreAleatoire);
}

function guid() {
    mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $uuid = substr($charid, 0, 8)
            . substr($charid, 8, 4)
            . substr($charid, 12, 4)
            . substr($charid, 16, 4)
            . substr($charid, 20, 12);
    return $uuid;
}

function contains($substring, $string) {
    $pos = strpos($string, $substring);
    if ($pos === false) {
        return false;
    } else {
        return true;
    }
}

?>