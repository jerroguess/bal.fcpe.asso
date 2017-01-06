<?PHP
/*
  --------------------------------------------------------------------
  inc_form_controls_statistiques.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

function add_control_oui_non($iOuiNon) {
    // $iOuiNon : valeur 0 ou 1.

    if ($iOuiNon == 0)
        return _("inc_static_non");
    else
        return _("inc_static_oui");
}

function add_control_statique_picture_link($iAvatarPositionner, $strLink, $iType, $iIdentifiant, $strNom) {
    // $strClassesComplementaires : class de style complémentaire
    // $classesImage : classe associé Ã  l'image
    // $iAvatarPositionner : chemin de l'image Ã  affiché Ã  droite
    // $strLink : lien
    // $iType : type de média.
    
    switch ($iType) {
        case 3 :
            if ($iAvatarPositionner == 0) {
                return '<img class="noavatar" src="' . IMAGE_PATH . 'avatars/localites/no_avatar.png" alt="picture" />';
            } else {
                return '<img class="" src="' . IMAGE_PATH . 'avatars/localites/' . $iIdentifiant . '.jpg" alt="picture" />';
            }
            break;
    }
}

function add_control_statique_album_geo($iLongitude, $iLatitude, $iDiviseur = 1) {

    $iLongitudeMin = $iLongitude - (0.015/$iDiviseur);
    $iLatitudeMin = $iLatitude - (0.01/$iDiviseur);

    $iLongitudeMax = $iLongitude + (0.015/$iDiviseur);
    $iLatitudeMax = $iLatitude + (0.01/$iDiviseur);

    $strUrl = 'http://www.panoramio.com/map/get_panoramas.php?order=popularity&set=public&from=0&to=24&minx=' . number_format($iLongitudeMin, 5) . '&miny=' . number_format($iLatitudeMin, 5) . '&maxx=' . number_format($iLongitudeMax, 5) . '&maxy=' . number_format($iLatitudeMax, 5) . '&size=medium';

    // Make the Temporary URL for CURL to execute
    $strTempURL = $strUrl;

    // Create the cURL Object here
    $oCrl = curl_init();
    curl_setopt($oCrl, CURLOPT_HEADER, 0);
    curl_setopt($oCrl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($oCrl, CURLOPT_URL, $strTempURL);
    curl_setopt($oCrl, CURLOPT_NOSIGNAL, 1);
    curl_setopt($oCrl, CURLOPT_TIMEOUT_MS, 1500);
    $strCookie = session_name()."=".session_id()."; path=".session_save_path();
    curl_setopt($oCrl, CURLOPT_COOKIE, $strCookie);
    curl_setopt($oCrl, CURLOPT_COOKIEJAR, $strCookie);
    curl_setopt($oCrl, CURLOPT_COOKIESESSION, 1);
    $objJson = curl_exec($oCrl);
    $curl_errno = curl_errno($oCrl);
    $curl_error = curl_error($oCrl);
    curl_close($oCrl);

    if (!function_exists('json_decode')) {
        function json_decode($content, $assoc = false) {
            //include(dirname(__FILE__) . '/../../../models/common/lib.json.php');
            if ($assoc) {
                $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
            } else {
                $json = new Services_JSON;
            }
            return $json->decode($content);
        }
    }
    
    if ($curl_errno > 0) {
        echo '<br/><div><p class="columnsempty center">' . _("inc_static_pasphotodisponible") . '</div>';
        echo "\n";
    }else{
        $oPanoramio = json_decode($objJson);
        if (count($oPanoramio->photos) > 0) {
            echo '<ul id="hover-cap-4col" class="thumbnails">';
                
                foreach ($oPanoramio->photos as $objPhotos) {
                    echo '<li class="span3">';
                        echo '<div class="thumbnail">';
                            echo '<a class="" href="' . $objPhotos->photo_file_url . '" >';
                                echo '<img class="imgPanoramio" alt="' . _("inc_image") . '" src="' . $objPhotos->photo_file_url . '" />';
                            echo '</a>';
                        echo '</div>';
                    echo '</li>';
                }
                
            echo '</ul>';
            echo '<br/><p>' . _("inc_static_panoramio") . '</p>';
            echo "\n";
        } else {
            echo '<br/><div><p class="columnsempty center">' . _("inc_static_pasphotodisponible") . '</div>';
            echo "\n";
        }
    }
}

function add_control_statique_avatar_geo($iLongitude, $iLatitude) {

    $iLongitudeMin = $iLongitude - 0.01;
    $iLatitudeMin = $iLatitude - 0.01;

    $iLongitudeMax = $iLongitude + 0.01;
    $iLatitudeMax = $iLatitude + 0.01;

    $strUrl = 'http://www.panoramio.com/map/get_panoramas.php?order=popularity&set=public&from=0&to=1&minx=' . number_format($iLongitudeMin, 5) . '&miny=' . number_format($iLatitudeMin, 5) . '&maxx=' . number_format($iLongitudeMax, 5) . '&maxy=' . number_format($iLatitudeMax, 5) . '&size=medium';
    
    // Make the Temporary URL for CURL to execute
    $strTempURL = $strUrl;

    // Create the cURL Object here
    $oCrl = curl_init();
    curl_setopt($oCrl, CURLOPT_HEADER, 0);
    curl_setopt($oCrl, CURLOPT_RETURNTRANSFER, 1);

    // Here we ask google to give us the lats n longs in XML format
    curl_setopt($oCrl, CURLOPT_URL, $strTempURL);

    if (!function_exists('json_decode')) {

        function json_decode($content, $assoc = false) {
            if ($assoc) {
                $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
            } else {
                $json = new Services_JSON;
            }
            
            return $json->decode($content);
        }

    }

    $oPanoramio = json_decode(curl_exec($oCrl));
    curl_close($oCrl);

    if (isset($oPanoramio)) {
        if ($oPanoramio->count > 0) {
            foreach ($oPanoramio->photos as $objPhotos) {
                return '<img alt="Image" class="imgAvatar" src="' . $objPhotos->photo_file_url . '" />';
            }
        }
    }
}

function add_control_statique_ariane($aListeURL, $aListeNom, $aListeAide) {

    echo '<div class="bs-component">';
        echo '<ul class="breadcrumb">';
            for ($i = 0; $i < count($aListeURL); $i++) {

                // Premier élément. 
                if ($i == 0) {
                    echo '<li class="active" title="' . _("inc_accueil") . '">';
                        echo '<img src="' . IMAGE_PATH . 'home.png" alt="' . _("inc_accueil") . '" width="10" height="14"/>&nbsp;&nbsp;&nbsp;<a href="' . $aListeURL[$i] . '">' . _("inc_accueil") . '</a>';
                    echo '</li>';
                } elseif ($i == count($aListeURL) - 1) {
                    echo '<li class="active" title="' . $aListeAide[$i] . '">';
                        echo $aListeNom[$i];
                    echo '</li>';
                } else {
                    echo '<li class="active" title="' . $aListeAide[$i] . '">';
                        echo '<a href="' . $aListeURL[$i] . '">' . $aListeNom[$i] . '</a>';
                    echo '</li>';
                }
            }
        echo '</ul>';
    echo '</div>';
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
        $strFormulaire .= "<input type=\"hidden\" name=\"action\" value =\"" . $strAction . "\"/>";

    echo $strFormulaire;
}

// Function permettant de finir le formulaire.
function add_cadre_close_form() {
    echo "</form>";
}

function add_control_statique_weather($iIdWeather) {
    // $iIdWeather : id météo yahoo

    $strUrl = 'http://weather.yahooapis.com/forecastrss?w=' . $iIdWeather . '&u=c';

    // Create the cURL Object here
    $oCrl = curl_init();
    curl_setopt($oCrl, CURLOPT_HEADER, 0);
    curl_setopt($oCrl, CURLOPT_RETURNTRANSFER, 1);

    // Here we ask google to give us the lats n longs in XML format
    curl_setopt($oCrl, CURLOPT_URL, $strUrl);
    $gXML = curl_exec($oCrl);    // Here we get the google result in XML


    $resultat = utf8_encode($gXML);
    $resultat = str_replace("yweather:condition", "yweather_condition", $resultat);
    $resultat = str_replace("yweather:forecast", "yweather_forecast", $resultat);

    // Using SimpleXML (Built-in XML parser in PHP5) to parse google result
    $goo = simplexml_load_string($resultat); // VERY IMPORTANT ! - ACHTUNG ! - this line is for documents that are UTF-8 encoded

    if ((isset($goo)) && (isset($goo->channel)) && (isset($goo->channel->item))) {

        $atab_WeatherCode = array();
        $atab_WeatherCode[0] = _("inc_static_tornade");
        $atab_WeatherCode[1] = _("inc_static_tempetetropicale");
        $atab_WeatherCode[2] = _("inc_static_ouragan");
        $atab_WeatherCode[3] = _("inc_static_oragesviolents");
        $atab_WeatherCode[4] = _("inc_static_orages");
        $atab_WeatherCode[5] = _("inc_static_pluieneige");
        $atab_WeatherCode[6] = _("inc_static_pluiegresil");
        $atab_WeatherCode[7] = _("inc_static_neigegresil");
        $atab_WeatherCode[8] = _("inc_static_bruineverglassante");
        $atab_WeatherCode[9] = _("inc_static_bruine");
        $atab_WeatherCode[10] = _("inc_static_pluieverglassante");
        $atab_WeatherCode[11] = _("inc_static_pluie");
        $atab_WeatherCode[12] = _("inc_static_pluie");
        $atab_WeatherCode[13] = _("inc_static_chuteneige");
        $atab_WeatherCode[14] = _("inc_static_legereneige");
        $atab_WeatherCode[15] = _("inc_static_neige");
        $atab_WeatherCode[16] = _("inc_static_neige");
        $atab_WeatherCode[17] = _("inc_static_grele");
        $atab_WeatherCode[18] = _("inc_static_gresil");
        $atab_WeatherCode[19] = _("inc_static_poussiere");
        $atab_WeatherCode[20] = _("inc_static_brumeux");
        $atab_WeatherCode[21] = _("inc_static_haze");
        $atab_WeatherCode[22] = _("inc_static_brumeux");
        $atab_WeatherCode[23] = _("inc_static_venteux");
        $atab_WeatherCode[24] = _("inc_static_venteux");
        $atab_WeatherCode[25] = _("inc_static_froid");
        $atab_WeatherCode[26] = _("inc_static_nuageux");
        $atab_WeatherCode[27] = _("inc_static_tresnuageuxnuit");
        $atab_WeatherCode[28] = _("inc_static_tresnuageuxjour");
        $atab_WeatherCode[29] = _("inc_static_partiellementensoleille");
        $atab_WeatherCode[30] = _("inc_static_partiellementnuageux");
        $atab_WeatherCode[31] = _("inc_static_clairenuit");
        $atab_WeatherCode[32] = _("inc_static_ensolleille");
        $atab_WeatherCode[33] = _("inc_static_beautempsnuit");
        $atab_WeatherCode[34] = _("inc_static_beautempsjour");
        $atab_WeatherCode[35] = _("inc_static_pluiemele");
        $atab_WeatherCode[36] = _("inc_static_chaud");
        $atab_WeatherCode[37] = _("inc_static_oragesisole");
        $atab_WeatherCode[38] = _("inc_static_oragesintermittents");
        $atab_WeatherCode[39] = _("inc_static_oragesintermittents");
        $atab_WeatherCode[40] = _("inc_static_averseseparses");
        $atab_WeatherCode[41] = _("inc_static_forteschuteneige");
        $atab_WeatherCode[42] = _("inc_static_aversesnaigeeparses");
        $atab_WeatherCode[43] = _("inc_static_forteschuteneige");
        $atab_WeatherCode[44] = _("inc_static_partiellementnuageux");
        $atab_WeatherCode[45] = _("inc_static_orages");
        $atab_WeatherCode[46] = _("inc_static_chutesneige");
        $atab_WeatherCode[47] = _("inc_static_oragesisoles");
        $atab_WeatherCode[3200] = _("inc_static_nondisponible");

        $atab_Icone = array();
        $atab_Icone[0] = "Wind";
        $atab_Icone[1] = "Wind";
        $atab_Icone[2] = "Wind";
        $atab_Icone[3] = "ThunderStorm";
        $atab_Icone[4] = "ThunderStorm";
        $atab_Icone[5] = "IcyRain";
        $atab_Icone[6] = "IcyRain";
        $atab_Icone[7] = "IcyRain";
        $atab_Icone[8] = "Drizzle";
        $atab_Icone[9] = "Drizzle";
        $atab_Icone[10] = "IcyFrozenSnow";
        $atab_Icone[11] = "Showers";
        $atab_Icone[12] = "Showers";
        $atab_Icone[13] = "WindySnow";
        $atab_Icone[14] = "WindySnow";
        $atab_Icone[15] = "WindySnow";
        $atab_Icone[16] = "WindySnow";
        $atab_Icone[17] = "Gréle";
        $atab_Icone[18] = "Sleet";
        $atab_Icone[19] = "Wind";
        $atab_Icone[20] = "Fog";
        $atab_Icone[21] = "Haze";
        $atab_Icone[22] = "Smoke";
        $atab_Icone[23] = "Wind";
        $atab_Icone[24] = "Wind";
        $atab_Icone[25] = "WindySnow";
        $atab_Icone[26] = "Clouds";
        $atab_Icone[27] = "MostlyCloudyNight";
        $atab_Icone[28] = "MostlyCloudyDay";
        $atab_Icone[29] = "PartlyCloudyNight";
        $atab_Icone[30] = "PartlyCloudyDay";
        $atab_Icone[31] = "Moon";
        $atab_Icone[32] = "Sun";
        $atab_Icone[33] = "FairNight";
        $atab_Icone[34] = "FairDay";
        $atab_Icone[35] = "IcyRain";
        $atab_Icone[36] = "Hot";
        $atab_Icone[37] = "ThunderStorm";
        $atab_Icone[38] = "ThunderStorm";
        $atab_Icone[39] = "ThunderStorm";
        $atab_Icone[40] = "Showers";
        $atab_Icone[41] = "WindySnow";
        $atab_Icone[42] = "IcyRain";
        $atab_Icone[43] = "WindySnow";
        $atab_Icone[44] = "PartlyCloudyDay";
        $atab_Icone[45] = "SunnyShowers";
        $atab_Icone[46] = "Snow";
        $atab_Icone[47] = "ThunderStorm";
        $atab_Icone[3200] = "Unknown";

        $atab_Jour = array(_("inc_static_dimanche"), _("inc_static_lundi"), _("inc_static_mardi"), _("inc_static_mercredi"), _("inc_static_jeudi"), _("inc_static_vendredi"), _("inc_static_samedi"));
        $atab_Mois = array("", _("inc_static_janvier"), _("inc_static_fevrier"), _("inc_static_mars"), _("inc_static_avril"), _("inc_static_mai"), _("inc_static_juin"), _("inc_static_juillet"), _("inc_static_aout"), _("inc_static_septembre"), _("inc_static_octobre"), _("inc_static_novembre"), _("inc_static_decembre"));
        $lstr_DateFr = $atab_Jour[date("w", strtotime($goo->channel->item->yweather_condition["date"]))] . " " . date("d", strtotime($goo->channel->item->yweather_condition["date"])) . " " . $atab_Mois[date("n", strtotime($goo->channel->item->yweather_condition["date"]))] . " " . date("Y", strtotime($goo->channel->item->yweather_condition["date"]));

        echo '<br/>';
        echo '<br/>';
        echo '<div style="width:200px;margin:auto;">';
            echo "<img src=\"public/images/weather/" . $atab_Icone[intval($goo->channel->item->yweather_condition["code"])] . "2.png\" alt=\"météo\"/>";
        echo '</div>';
        echo '<br/>';
        echo "<span>";
        echo $atab_WeatherCode[intval($goo->channel->item->yweather_condition["code"])] . "<br/>" . intval($goo->channel->item->yweather_condition["temp"]) . "°c";
        echo "</span>";
        echo '<br/>';
        echo '<p class="center">' . _("inc_static_fourniyahoo") . '</p>';
    } else {

        // Saut d'une ligne
        echo '<br/>';
        // Données sur les festivités
        echo _("inc_static_pasmeteo");
    }
}

function add_control_dynamique_security($oConnection, $strFont, $strClassesComplementaires, $strValeurParametre, $aError, $iTaille) {
    // $oConnection : si le parametre est initialisé alors affichage d'une erreur.
    // $strFont : classe de la font associé aux labels
    // $strClassesComplementaires : class de style complémentaire
    // $strValeurParametre : valeur du parametre
    // $strErreur : texte en cas d'erreur
    // $iTaille : taille du champ.

    $boSecurity = new common_Security($oConnection);
    $strReference = $boSecurity->getSecurityPicture($iTaille);

    if (isset($aError["imageSecurite_Saisie"]))
        echo '<p class="columnsred">';
    else
        echo '<p class="columns">';
    echo "\n";

    echo '<label for="imageSecurite_Saisie" class="' . $strFont . ' ' . $strClassesComplementaires . '\">' . _("inc_dyna_imagesecuriteobligatoire") . '</label><br/>';
    echo "\n";
    echo '<input placeholder="' . _("inc_dyna_imagesecurite") . '" size="36" type="text" class="form-control" name="imageSecurite_Saisie" id="imageSecurite_Saisie" value="' . $strValeurParametre . '"/><input type="hidden" value="' . $strReference . '" name="referenceSecurite_Saisie" />';
    echo "\n";
    //add_control_statique_helper($strAide);
    echo '</p>';

    echo '<p class="columns">';
    echo '<label class="' . $strFont . ' ' . $strClassesComplementaires . '\"> </label>';
    echo "\n";
    echo '<img class="main_form_img" src="ajax.php?page=imagesecurite&amp;reference=' . $strReference . '" alt="' . _("inc_dyna_imagesecurite") . '"/>';
    echo "\n";
    echo '</p>';
    echo "\n";
}

/* ---------------------------------------------- */
//  Traitement des données album.
/* ---------------------------------------------- */
function traiterUrlAlbum($astrAlbum) {

    // Album.
    $ltab_URLAlbum = parse_url(strtolower(str_replace("#", "", $astrAlbum)));
    $lstr_Album = "";
    if ($astrAlbum != "") {
        if ($ltab_URLAlbum['host'] == "www.flickr.com") {
            // http://www.flickr.com/photos/ricofqm/sets/72157622827125134/

            $ltab_Detail = preg_split('/\//', $ltab_URLAlbum['path']);
            $lstr_Album = "flickr|" + $ltab_Detail[0] + "|" + $ltab_Detail[1];
        } elseif (($ltab_URLAlbum['host'] == "picasaweb.google.com") || ($ltab_URLAlbum['host'] == "picasaweb.google.fr")) {
            // http://picasaweb.google.com/buildgreeninfrastructure/NewColumbiaPortlandOregon
            // http://picasaweb.google.com/spolsky/Taco

            $ltab_Detail = preg_split('/\//', $ltab_URLAlbum['path']);
            $albumid = "";
            $albumid = getPicasaAlbumId($ltab_Detail[1], $ltab_Detail[2]);
            if ($albumid != "")
                $lstr_Album = "picasa|" + $ltab_Detail[1] + "|" + $albumid;
        }else {
            $lstr_Album = "";
        }
    } else {
        $lstr_Album = "";
    }
    return $lstr_Album;
}

function getPicasaAlbumId($user, $albumname) {

    $rss = "http://picasaweb.google.com/data/feed/api/user/$user/?kind=album&access=public&alt=rss";

    $file = implode('', file($rss));
    $start = strpos($file, "<item>");
    $end = strrpos($file, "</item>");
    $substr = substr($file, $start, $end - $start + 1);
    $items = explode("<item>", $substr);
    print_r($items);
    if (is_array($items) && count($items) > 0) {
        foreach ($items as $tmp) {
            if (trim($tmp) != "") {
                if (getTagContent($tmp, "gphoto:name") == $albumname) {
                    return getTagContent($tmp, "gphoto:id");
                }
            }
        }
    }

    return "";
}

function getTagContent($src, $tag) {
    $start = mb_strpos($src, "<" . $tag . ">"); // + strlen($tag)+2;
    if ($start === false) {
        $start = mb_strpos($src, "<" . $tag) + strlen($tag) + 1;
        $end = mb_strpos($src, "/>", $start) - 1;
        $content = substr($src, $start, $end - $start + 1);
        $return = array();
        $tmp = explode(' ', $content);

        if (is_array($tmp) && count($tmp) > 0) {
            foreach ($tmp as $line) {
                if (trim($line) != "") {
                    $a = explode("=", $line);
                    $return[$a[0]] = str_replace("'", "", trim($a[1]));
                }
            }
        }
    } else {
        $start+= strlen($tag) + 2;
        $end = mb_strpos($src, "</" . $tag . ">") - 1;
        $return = substr($src, $start, $end - $start + 1);
    }
    return $return;
}

function positionnerAvatarIllustration($iAvatarPositionner, $iAvatarIdTemporaire, $iIllustrationPositionner, $iIllustrationIdTemporaire) {

    // Récupération de l'identifiant du média
    $iIdMedia = null;
    $boUpload = null;

    if (($iAvatarPositionner != 0) || ($iIllustrationPositionner != 0)) {
        $strRequeteInsertion = "SELECT LAST_INSERT_ID() AS id_media ;";
        $rdsInsertion = $this->connection->Execute($strRequeteInsertion);
        $iIdMedia = $rdsInsertion->fields["id_media"];
        $boUpload = new common_Upload(null, false);
    }

    // Positionnement de l'avatar.
    if ($iAvatarPositionner != 0) {
        $boUpload->transfertTemporaireAvatar(0, $iAvatarIdTemporaire, $iIdMedia);
    }

    // Positionnement de l'illustration.
    if ($iIllustrationPositionner != 0) {
        $boUpload->transfertTemporaireAvatar(0, $iIllustrationIdTemporaire, $iIdMedia);
    }
}

function add_control_statique_hidden($strNom, $strValeur, $strClassesComplementaires = "") {
    // $strNom : nom du champ
    // $strValeur : valeur du champ

    echo '<input class="' . $strClassesComplementaires . '" type="hidden" id="' . $strNom . '" name="' . $strNom . '" value="' . $strValeur . '"/>';
    echo "\n";
}

function add_control_statique_label_avatar($strTitre, $iAvatarPositionner, $iAvatarIdTemporaire, $iIdMedia, $iTypeMedia, $aError) {
    // $strTitre : titre du champ
    // $iAvatar : présence d'un avatar
    // $iIdMedia : identifiant du média
    // $iTypeMedia : type de média
    // $aError : message d'erreur à afficher.
    // Positionnement d'un identifiant temporaire.
    
    if ($iIdMedia == 0) {
        add_control_statique_hidden("avatarPositionner_Saisie", $iAvatarPositionner);
        add_control_statique_hidden("avatarIdTemporaire_Saisie", $iAvatarIdTemporaire);
    }
    
    echo '<label class="control-label">' . $strTitre . '</label>';
    echo "<br/>\n";

    if (($iAvatarPositionner == 1) && ($iIdMedia != 0)) {
        // Image positionnée et déjé enregistrée.
        if ($iTypeMedia == 4) {
            echo '<div class="gauche"><img class="imgAvatarUpload img_' . $iTypeMedia . '_' . $iIdMedia . '" alt="Image' . $iIdMedia . '.jpg" src="' . IMAGE_PATH . 'avatars/commerces/' . $iIdMedia . '.jpg?v=1.0" /></div>';
        }
    } else if ($iAvatarPositionner == 1) {
        // Image positionnée mais non enregistrée.
        echo '<div class="gauche"><img class="imgAvatarUpload img_' . $iTypeMedia . '_' . $iIdMedia . '" src="' . IMAGE_PATH . 'avatars/temporaires/' . $_SESSION["id_utilisateur"] . '_' . $iTypeMedia . '_' . $iAvatarIdTemporaire . '.jpg" alt="picture" /></div>';
    } else {
        // Image non positionnée.
        if ($iTypeMedia == 4) {
            echo '<div class="gauche"><img class="imgAvatarUpload img_' . $iTypeMedia . '_' . $iIdMedia . '" src="' . IMAGE_PATH . 'avatars/commerces/no_avatar.png" alt="picture" /></div>';
        }
    }

    echo '<script type="text/javascript">';
    echo "\n";
    echo '//<![CDATA[';
    echo "\n";
    echo 'var strNomImageAvatar = \'img_' . $iTypeMedia . '_' . $iIdMedia . '\';';
    echo "\n";

    if ($iIdMedia == 0) {
        echo 'var strCheminImageAvatar = \'' . IMAGE_PATH . 'avatars/temporaires/' . $_SESSION["id_utilisateur"] . '_' . $iTypeMedia . '_' . $iAvatarIdTemporaire . '.jpg?v=1.0\';';
        echo "\n";
        echo 'var strUrlModifierAvatar = \'ajax/modifieravatar/iAvatarIdTemporaire=' . $iAvatarIdTemporaire . '&iIdMedia=0&iTypeMedia=' . $iTypeMedia . '&sid=' . session_id() . '\';';
    } else {
        if ($iTypeMedia == 4) {
            echo 'var strCheminImageAvatar = \'' . IMAGE_PATH . 'avatars/commerces/' . $iIdMedia . '.jpg?v=1.0\';';
        }
        echo "\n";
        echo 'var strUrlModifierAvatar = \'ajax/modifieravatar/iIdMedia=' . $iIdMedia . '&iTypeMedia=' . $iTypeMedia . '&sid=' . session_id() . '\';';
    }
    echo "\n";
    echo '// ]]>';
    echo "\n";
    echo '</script>';
    echo "\n";
    
    echo '<span class="btn btn-success fileinput-button">';
        echo '<i class="glyphicon glyphicon-plus"></i>';
        echo '<span class="button blue small">Modifier</span>';
        echo '<input id="fileuploadAvatar" type="file" name="files[]" multiple>';
    echo '</span>';
    echo '<div id="progressAvatar" class="progress" style="display:none;">';
        echo '<div class="progress-bar progress-bar-success"></div>';
    echo '</div>';
    echo "\n";
    echo "<br/>\n";
}

function add_control_statique_label_illustration($strTitre, $iIllustrationPositionner, $iIllustrationIdTemporaire, $iIdMedia, $iTypeMedia, $aError) {
    // $strTitre : titre du champ
    // $iAvatar : présence d'un avatar
    // $iIdMedia : identifiant du média
    // $iTypeMedia : type de média
    // $aError : message d'erreur é afficher.
    
    
    if ($iIdMedia == 0) {
        add_control_statique_hidden("illustrationPositionner_Saisie", $iIllustrationPositionner);
        add_control_statique_hidden("illustrationIdTemporaire_Saisie", $iIllustrationIdTemporaire);
    }

    echo '<label class="control-label">' . $strTitre . '</label>';
    echo "<br/>\n";

    if (($iIllustrationPositionner == 1) && ($iIdMedia != 0)) {
        // Image positionnée et déjé enregistrée.
        if ($iTypeMedia == 4) {
            echo '<div class="gauche"><img class="imgAvatarUpload img_i_' . $iTypeMedia . '_' . $iIdMedia . '" alt="Image' . $iIdMedia . '.jpg" src="' . IMAGE_PATH . 'illustrations/commerces/' . $iIdMedia . '.jpg?v=1.0" /></div>';
        }
        echo "\n";
    } else if ($iIllustrationPositionner == 1) {
        // Image positionnée mais non enregistrée.
        echo '<div class="gauche"><img class="imgAvatarUpload img_i_' . $iTypeMedia . '_' . $iIdMedia . '" src="' . IMAGE_PATH . 'illustrations/temporaires/' . $_SESSION["id_utilisateur"] . '_' . $iTypeMedia . '_' . $iIllustrationIdTemporaire . '.jpg" alt="picture" /></div>';
    } else {
        // Image non positionnée.
        if ($iTypeMedia == 4) {
            echo '<div class="gauche"><img class="imgAvatarUpload img_i_' . $iTypeMedia . '_' . $iIdMedia . '" src="' . IMAGE_PATH . 'illustrations/commerces/no_avatar.png" alt="picture" /></div>';
        }
        echo "\n";
    }

    echo '<script type="text/javascript">';
    echo "\n";
    echo '//<![CDATA[';
    echo "\n";
    echo 'var strNomImageIllustration = \'img_i_' . $iTypeMedia . '_' . $iIdMedia . '\';';
    echo "\n";

    if ($iIdMedia == 0) {
        echo 'var strCheminImageIllustration = \'' . IMAGE_PATH . 'illustrations/temporaires/' . $_SESSION["id_utilisateur"] . '_' . $iTypeMedia . '_' . $iIllustrationIdTemporaire . '.jpg?v=1.0\';';
        echo "\n";
        echo 'var strUrlModifierIllustration = \'ajax/modifierillustration/iIllustrationIdTemporaire=' . $iIllustrationIdTemporaire . '&iIdMedia=0&iTypeMedia=' . $iTypeMedia . '&sid=' . session_id() . '\';';
    } else {
        if ($iTypeMedia == 4) {
            echo 'var strCheminImageIllustration = \'' . IMAGE_PATH . 'illustrations/commerces/' . $iIdMedia . '.jpg?v=1.0\';';
        }
        echo "\n";
        echo 'var strUrlModifierIllustration = \'ajax/modifierillustration/iIdMedia=' . $iIdMedia . '&iTypeMedia=' . $iTypeMedia . '&sid=' . session_id() . '\';';
    }
    echo "\n";
    echo '// ]]>';
    echo "\n";
    echo '</script>';
    echo "\n";
    echo '<span class="btn btn-success fileinput-button">';
        echo '<i class="glyphicon glyphicon-plus"></i>';
        echo '<span class="button blue small">Modifier</span>';
        echo '<input id="fileuploadIllustration" type="file" name="files[]" multiple>';
    echo '</span>';
    echo '<div id="progressIllustration" class="progress" style="display:none;">';
        echo '<div class="progress-bar progress-bar-success"></div>';
    echo '</div>';
    echo "\n";
    echo "<br/>\n";
}

function add_control_dynamique_categorie($oConnection, $strFont, $strClassesComplementaires, $iCategorieID, $iTypeMedia, $aError) {
    // $oConnection : si le parametre est initialisé alors affichage d'une erreur.
    // $strFont : classe de la font associé aux labels
    // $strClassesComplementaires : class de style complémentaire
    // $iCategorieID : valeur du parametre
    // $strTypeMedia : type de média
    // $aError : si le parametre est initialisé alors affichage d'une erreur.

    $boCategory = new category_Category($oConnection, $iTypeMedia);
    $rdsCategories = $boCategory->getDataCategory($iCategorieID);
    $iPremiereCategorieID = $rdsCategories->fields["parent"];
    $strDisplay = "";
    $strSelected = '';

    echo '<label for="selectionCategorie" class="' . $strFont . ' ' . $strClassesComplementaires . '">Catégorie :</label>&nbsp;';
    echo '<select size="1" name="selectionCategorie" id="selectionCategorie" class="main_form_select form-control" onchange="categorie(this.options[this.selectedIndex].value, ' . $iTypeMedia . ', $(\'#categorieForm_Saisie\'));">';
    echo "\n";

    if ($iPremiereCategorieID == 0) {
        $strSelected = ' selected="selected" ';
        $strDisplay = ' disabled="disabled" ';
    }
    echo '<option ' . $strSelected . ' value="1">Choisir ...</option>';
    echo "\n";

    // Sélection des catégorie parents.
    $rdsSelectionCategories = $boCategory->getListChildrenCategory(1);

    // Affichage des resultats.
    while (!$rdsSelectionCategories->EOF) {

        if ($rdsCategories->fields["parent"] == $rdsSelectionCategories->fields["id_categorie"])
            $strSelected = ' selected="selected" ';
        else
            $strSelected = '';

        echo '<option ' . $strSelected . ' value="' . $rdsSelectionCategories->fields["id_categorie"] . '">' . $rdsSelectionCategories->fields["titre_categorie"] . '</option>';
        echo "\n";

        // Changement d'enregistrement.
        $rdsSelectionCategories->MoveNext();
    }
    echo '</select>&nbsp;';
    echo "\n";
    echo "<br/>\n";
    
    
    echo '<label for="categorieForm_Saisie" class="' . $strFont . ' ' . $strClassesComplementaires . '">Sous catégorie&nbsp;:</label>&nbsp;';
    echo '<select name="categorieForm_Saisie" ' . $strDisplay . ' id="categorieForm_Saisie" size="1" class="main_form_select form-control">';


    if ($iPremiereCategorieID != 0) {
        $rdsCategoriesFilles = $boCategory->getListChildrenCategory($iPremiereCategorieID);
        echo '<option ' . $strSelected . ' value="1">Choisir ...</option>';
        echo "\n";

        // Affichage des resultats.
        while (!$rdsCategoriesFilles->EOF) {

            if ($iCategorieID == $rdsCategoriesFilles->fields["id_categorie"])
                $strSelected = ' selected="selected" ';
            else
                $strSelected = '';

            echo '<option ' . $strSelected . ' value="' . $rdsCategoriesFilles->fields["id_categorie"] . '">' . $rdsCategoriesFilles->fields["titre_categorie"] . '</option>';
            echo "\n";

            // Changement d'enregistrement.
            $rdsCategoriesFilles->MoveNext();
        }
    }else {
        echo '<option value="1">-</option>';
        echo "\n";
    }

    echo '</select>';
    echo "<br/>\n";
}

?>