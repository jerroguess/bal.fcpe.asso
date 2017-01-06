<?php

/*
  --------------------------------------------------------------------
  class.bo.qrcode.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class common_QrCode {

    private $connection;  ///<b>connect</b>		Connection SQL object
    private $strUrlQrlLib;

    /**
      boQrCode constructor inits everything related to QrCode.

      @param	connection		Connection to bd
     */
    public function __construct($connection) {
        $this->connection = $connection;
        $this->strUrlQrlLib = dirname(__FILE__) . '/../../components/phpqrcode/qrlib.php';
    }

    /**
      Get Temporary Direction.

      @param	iType	Type
     */
    public function getTempDir($iType) {

        $strPngTempDir = '';

        switch ($iType) {
            case 0 :
                $strPngTempDir = 'evenements';
                break;
            case 1 :
                $strPngTempDir = 'groupes';
                break;
            case 2 :
                $strPngTempDir = 'utilisateurs';
                break;
            case 3 :
                $strPngTempDir = 'localites';
                break;
            case 4 :
                $strPngTempDir = 'commerces';
                break;
            case 5 :
                $strPngTempDir = 'balades';
                break;
            case 6 :
                $strPngTempDir = 'sejours';
                break;
            case 7 :
                $strPngTempDir = 'activites';
                break;
        }

        return dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'qrcodes' . DIRECTORY_SEPARATOR . $strPngTempDir . DIRECTORY_SEPARATOR;
    }

    /**
      Generate Qr Code by Text.

      @param	iId		ID
      @param	iType	Type
      @param	strText	Text
     */
    public function generateText($iId, $iType, $strText) {

        include $this->strUrlQrlLib;
        $strPngTempDir = $this->getTempDir($iType);

        $strFileName = $strPngTempDir . $iId . '.png';
        $strErrorCorrectionLevel = 'H';
        $iMatrixPointSize = 4;
        QRcode::png($strText, $strFileName, $strErrorCorrectionLevel, $iMatrixPointSize, 2);
    }

    /**
      Generate Global Positioning.

      @param	dLatitude	Latitude
      @param	dLongitude	Longitude
     */
    public function generateVGlobalPositioning($dLatitude, $dLongitude) {

        include $this->strUrlQrlLib;
        $strPngTempDir = $this->getTempDir($iType);

        $strFileName = $strPngTempDir . $iId . '.png';
        $strErrorCorrectionLevel = 'H';
        $iMatrixPointSize = 4;

        $strVGlobalPositioning = "GEO:" . $dLatitude . "," . $dLongitude . "\n";

        QRcode::png($strVGlobalPositioning, $strFileName, $strErrorCorrectionLevel, $iMatrixPointSize, 2);
    }

    /**
      Generate Telephone Number.

      @param	strTelephone	Telephone
     */
    public function generateVTelephone($strTelephone) {

        include $this->strUrlQrlLib;
        $strPngTempDir = $this->getTempDir($iType);

        $strFileName = $strPngTempDir . $iId . '.png';
        $strErrorCorrectionLevel = 'H';
        $iMatrixPointSize = 4;

        $strVTelephone = "TEL:" . $strTelephone . "\n";

        QRcode::png($strVTelephone, $strFileName, $strErrorCorrectionLevel, $iMatrixPointSize, 2);
    }

    /**
      Generate URL.

      @param	strUrl	URL
     */
    public function generateVUrl($strUrl) {

        include $this->strUrlQrlLib;
        $strPngTempDir = $this->getTempDir($iType);

        $strFileName = $strPngTempDir . $iId . '.png';
        $strErrorCorrectionLevel = 'H';
        $iMatrixPointSize = 4;

        $strVUrl = "URI:" . $strUrl . "\n";

        QRcode::png($strVUrl, $strFileName, $strErrorCorrectionLevel, $iMatrixPointSize, 2);
    }

    /**
      Generate Email.

      @param	strEmail	Email
     */
    public function generateVEmail($strEmail) {

        include $this->strUrlQrlLib;
        $strPngTempDir = $this->getTempDir($iType);

        $strFileName = $strPngTempDir . $iId . '.png';
        $strErrorCorrectionLevel = 'H';
        $iMatrixPointSize = 4;

        $strVEmail = "EMAIL:" . $strEmail . "\n";

        QRcode::png($strVEmail, $strFileName, $strErrorCorrectionLevel, $iMatrixPointSize, 2);
    }

    /**
      Generate Qr Code by vCard (user, shop, group, trip, walk, activity)

      @param	strType					Type de carte
      @param	iId						ID
      @param	iType					Type de média
      @param	strNom					Nom
      @param	strPrenom				Prénom
      @param	strURL					URL
      @param	strTitreCategorieParent	Titre de la catégorie parent
      @param	strTitreCategorie		Titre de catégorie
      @param	iAvatar				Présence de l'avatar
      @param	dLatitude				Latitude
      @param	dLongitude				Longitude
      @param	strAdresse				Adresse
      @param	strCommune				Commune
      @param	strCodePostal			Code postal
      @param	strPays					pays
      @param	strNote					Notes
      @param	strEmail				Adresse email
     */
    public function generateVCard($strType, $iId, $iType, $strNom, $strPrenom, $strURL, $strTitreCategorieParent, $strTitreCategorie, $iAvatar, $dLatitude, $dLongitude, $strAdresse, $strCommune, $strCodePostal, $strNote, $strEmail) {

        include $this->strUrlQrlLib;
        $strPngTempDir = $this->getTempDir($iType);

        $strFileName = $strPngTempDir . $iId . '.png';
        $strErrorCorrectionLevel = 'H';
        $iMatrixPointSize = 3;

        $strVCard = "BEGIN:VCARD\n";
        $strVCard .= "VERSION:3.0\n";
        $strVCard .= "N:" . $strPrenom . ";" . $strNom . "\n";
        $strVCard .= "FN:" . $strNom . " " . $strPrenom . "\n";
        $strVCard .= "TITLE:" . $this->category($strTitreCategorieParent, $strTitreCategorie) . "\n";
        if ($iAvatar == 1)
            $strVCard .= "PHOTO;VALUE=URI:" . $iAvatar . "\n";
        $strVCard .= "GEO:" . $dLatitude . "," . $dLongitude . "\n";
        $strVCard .= "ADR;TYPE=" . $strType . ":" . $strAdresse . ";" . $strCommune . ";" . $strCodePostal . ";\n";


        if ($strNote != "")
            $strVCard .= "NOTE:" . $strNote . "\n";
        if ($strEmail != "")
            $strVCard .= "EMAIL;TYPE=" . $strType . ",INTERNET:" . $strEmail . "\n";
        if ($strURL != "")
            $strVCard .= "URL:" . $strURL . "\n";

        $strVCard .= "\r\nUID:" . $iType . "-" . $iId; //unique ID
        $strVCard .= "END:VCARD";

        QRcode::png($strVCard, $strFileName, $strErrorCorrectionLevel, $iMatrixPointSize, 2);
    }

    /**
      Generate Qr Code by vEvent (event)

      @param	iId						ID
      @param	strDateDebut			Date de début
      @param	strDateFin				Date de fin
      @param	strTitre				Titre
      @param	strNotes				Notes
      @param	strTitreCategorieParent	Titre de la catégorie parent
      @param	strTitreCategorie		Titre de catégorie
      @param	strLieux				Lieux de l'évènement
      @param	strOrganisateur			Organisateur
     */
    public function generateVEvent($iId, $strDateDebut, $strDateFin, $strTitre, $strNotes, $strTitreCategorieParent, $strTitreCategorie, $strLieux, $strOrganisateur) {

        include $this->strUrlQrlLib;
        $strPngTempDir = $this->getTempDir(0);

        $strFileName = $strPngTempDir . $iId . '.png';
        $strErrorCorrectionLevel = 'H';
        $iMatrixPointSize = 2;

        $strVEvent = "\r\nBEGIN:VEVENT";
        $strVEvent .= "\r\nDTSTAMP:" . gmdate("Ymd\THis\Z", time());
        $strVEvent .= "\r\nDTSTART;VALUE=DATE:" . gmdate("Ymd\THis\Z", strtotime($strDateDebut));
        $strVEvent .= "\r\nDTEND;VALUE=DATE:" . gmdate("Ymd\THis\Z", strtotime($strDateFin));
        $strVEvent .= "\r\n" . $this->formatIcalData("SUMMARY:" . $strTitre);
        $strVEvent .= "\r\n" . $this->formatIcalData("DESCRIPTION:" . $strNotes);
        $strVEvent .= "\r\n" . $this->formatIcalData("nCATEGORIES:" . $strTitreCategorie);
        $strVEvent .= "\r\n" . $this->formatIcalData("nSTATUS:CONFIRMED");
        $strVEvent .= "\r\nRRULE:FREQ=YEARLY";
        $strVEvent .= "\r\n" . $this->formatIcalData("LOCATION:" . $strLieux);
        $strVEvent .= "\r\n" . $this->formatIcalData("CONTACT:" . $strOrganisateur);
        $strVEvent .= "\r\nCLASS:CONFIDENTIAL"; //CLASS:PRIVATE (or PUBLIC) together with TRANSP:TRANSPARENT can be used as well
        $strVEvent .= "\r\nTRANSP:TRANSPARENT"; //Not needed if CLASS:CONFIDENTIAL is used, but will not hurt
        $strVEvent .= "\r\nUID:FCPE" . $iId; //unique ID
        $strVEvent .= "\r\n" . $this->formatIcalData("URL:http://www.FCPE.com/" . fct_form_Url(3, array(0, $strTitre, $iId)));
        $strVEvent .= "\r\nEND:VEVENT";

        QRcode::png($strVEvent, $strFileName, $strErrorCorrectionLevel, $iMatrixPointSize, 2);
    }

    # ******************************
    # Function to fold (wrap) lines at the RFC2445 specified line length of 75.
    # (c) 2005-2006 Ioannis Papaioannou (pj@moodle.org)
    # Released under the LGPL.
    # See http://bennu.sourceforge.net/ for more information and downloads
    # 
    # @author Ioannis Papaioannou
    # @return	string the properly folded value
    # ******************************

    private function rfc2445Fold($string) {
        if (strlen($string) <= 75) {
            return $string;
        }
        $retval = '';
        while (strlen($string) > 75) {
            $retval .= substr($string, 0, 75 - 1) . "\r\n" . ' ';
            $string = substr($string, 75 - 1);
        }
        $retval .= $string;
        return $retval;
    }

    # ******************************
    # format summary and description text properly.
    # Lines must wrap at 75 chars, use \r\n as delimiter, and have a space at the beginning of extra lines
    # @param string $data the data to be formatted
    # @return	the formatted string
    # @TODO Tested with Outlook 2003. Needs testing with other iCalendar apps such as iCal
    # ******************************

    private function formatIcalData($data) {
        $data = strip_tags($data);
        $data = $this->unhtmlentities($data); //convert html entities to chars (&quot; &lrm; etc)
        $data = strtr($data, array("\n" => '\\n', '\\' => '\\\\', ',' => '\\,', ';' => '\\;')); //escape special chars as per RFC 2445 spec
        return $this->rfc2445Fold($data);
    }

    # ******************************
    # Fonction inverse de htmlentities
    # ******************************

    private function unhtmlentities($html) {
        return strtr($html, array_flip(get_html_translation_table()));
    }

    /**
      Generate category

      @param	strTitreParent		Titre parent
      @param	strTitreCategorie	Titre catégorie
     */
    private function category($strTitreParent, $strTitreCategorie) {

        $strNomCategorie = "";

        if ($strTitreParent != "") {
            $strNomCategorie = $strTitreParent;
            if ($strTitreCategorie != "") {
                $strNomCategorie .= "-";
                $strNomCategorie .= $strTitreCategorie;
            }
        } elseif ($strTitreCategorie != "") {
            $strNomCategorie = $strTitreCategorie;
        } else {
            $strNomCategorie = "Pas de catégorie";
        }

        return $strNomCategorie;
    }

}

?>