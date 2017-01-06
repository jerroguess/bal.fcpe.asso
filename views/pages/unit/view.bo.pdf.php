<?PHP

/*
  --------------------------------------------------------------------
  view.bo.pdf.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	// Chargement des données.
	$rdsChildren = $this->_request->getParamByKey('rdsChildren');
	$rdsParent = $this->_request->getParamByKey('rdsParent');
	$rdsEtablissement = $this->_request->getParamByKey('rdsEtablissement');
	$rdsNiveauAdhesion = $this->_request->getParamByKey('rdsNiveauAdhesion');
	$rdsCity = $this->_request->getParamByKey('rdsCity');
	
	// Include the main TCPDF library (search for installation path).
	// always load alternative config file for examples
	require_once(dirname(__FILE__) . '/../../../components/tcpdf/config/tcpdf_config.php');

	// Include the main TCPDF library (search the library on the following directories).
	$tcpdf_include_dirs = array(
		realpath(dirname(__FILE__) . '/../../../components/tcpdf/tcpdf.php'),
		'/usr/share/php/tcpdf/tcpdf.php',
		'/usr/share/tcpdf/tcpdf.php',
		'/usr/share/php-tcpdf/tcpdf.php',
		'/var/www/tcpdf/tcpdf.php',
		'/var/www/html/tcpdf/tcpdf.php',
		'/usr/local/apache2/htdocs/tcpdf/tcpdf.php'
	);
	foreach ($tcpdf_include_dirs as $tcpdf_include_path) {
		if (@file_exists($tcpdf_include_path)) {
			require_once($tcpdf_include_path);
			break;
		}
	}

	//require_once(dirname(__FILE__) . '/../../../components/tcpdf/examples/tcpdf_include.php');
	//require dirname(__FILE__) . '/../../../components/tcpdf/examples/tcpdf_include.php';

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('FCPE');
	$pdf->SetTitle('Bulletin adhesion FCPE');
	$pdf->SetSubject('Bulletin adhesion FCPE');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set default header data
	//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
	$pdf->setFooterData(array(0,64,0), array(0,64,128));

	// remove default header/footer
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(true);

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}

	// Set font
	// dejavusans is a UTF-8 Unicode font, if you only need to
	// print standard ASCII chars, you can use core fonts like
	// helvetica or times to reduce file size.
	$pdf->SetFont('times', '', 11);

	// Add a page
	// This method has several options, check the source code documentation for more information.
	$pdf->AddPage();

	// set text shadow effect
	$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

	// Set some content to print
	$html = utf8_encode('
	<h1>F.C.P.E.</h1>
	Bourse aux livres : Bulletin d\'adh&eacute;sion saisie sur internet.<br />
	Type d\'adhésion : ' . $rdsParent->fields['libelle'] . '<br />
	Date : ' . date('Y/m/d h:i:s') . '<br />
	Code : ' . $rdsParent->fields['id'] . '<br />
	Etablissement scolaire principal : ' . $rdsParent->fields['code'] . ' ' . $rdsParent->fields['nom_etablissement'] . '
	<h2>Parent 1</h2>
	Nom : ' . $rdsParent->fields['nom'] . ' ' . $rdsParent->fields['prenom'] . '
	<h2>Parent 2</h2>
	Nom : ' . $rdsParent->fields['nom2'] . ' ' . $rdsParent->fields['prenom2'] . '
	<h2>Adresse :</h2>
	Voie : ' . $rdsParent->fields['adresse1'] . '<br />
	Appartement : ' . $rdsParent->fields['adresse2'] . '<br />
	B&acirc;timent : ' . $rdsParent->fields['adresse3'] . '<br />
	Ville : ' . $rdsParent->fields['code_postal'] . ' ' . $rdsParent->fields['commune'] . '<br />
	T&eacute;l&eacute;phone : ' . $rdsParent->fields['telephone'] . '<br />
	Portable : ' . $rdsParent->fields['portable'] . '<br />
	Email 1 : ' . $rdsParent->fields['email'] . '<br />
	Email 2 : ' . $rdsParent->fields['email2'] . '<br />
	<h2>Adhésion</h2>
	Niveau adh&eacute;sion : ' . $rdsParent->fields['libelle'] . '<br />
	Revue des parents : ');
	if ($rdsParent->fields['abo_rp'] == 1) { 
		$html .= utf8_encode('Oui');
	}else{
		$html .= utf8_encode('Non');
	}
	$html .= utf8_encode('<br />
	Souhaite &ecirc;tre candidat au conseil d\'administration : ');
	if ($rdsParent->fields['souh_candidat_ca'] == 1) { 
		$html .= utf8_encode('Oui');
	}else{
		$html .= utf8_encode('Non');
	}
	$html .= utf8_encode('<br />
	Souhaite &ecirc;tre d&eacute;l&eacute;gu&eacute; de classe : ');
	if ($rdsParent->fields['souh_del_classe'] == 1) { 
		$html .= utf8_encode('Oui');
	}else{
		$html .= utf8_encode('Non');
	}
	$html .= utf8_encode('<br />
	Newsletter : ');
	if ($rdsParent->fields['souh_newsletter'] == 1) { 
		$html .= utf8_encode('Oui');
	}else{
		$html .= utf8_encode('Non');
	}
	$html .= utf8_encode('
	');
	
	// Boucle sur les lignes.
	if ($rdsChildren->RecordCount() != 0) {
	
		// Parcours des enregistrements.	
		while (!$rdsChildren->EOF) {
		
			$html .= utf8_encode('
			<h2>Enfant</h2>
			Etablissement scolaire : ' . $rdsChildren->fields['code'] . ' ' . $rdsChildren->fields['nom_etablissement'] . '<br />
			Nom : ' . $rdsChildren->fields['nom'] . ' ' . $rdsChildren->fields['prenom'] . '<br />');
			
			if (date("Y", strtotime($rdsChildren->fields['date_naissance'])) > 1900) $html .= utf8_encode('
			Date de naissance : ' . date("d/m/Y", strtotime($rdsChildren->fields['date_naissance'])) . '<br />');
			
			if ($rdsChildren->fields['telephone'] != "") $html .= utf8_encode('
			T&eacute;l&eacute;phone : ' . $rdsChildren->fields['telephone'] . '<br />');
			if ($rdsChildren->fields['email'] != "") $html .= utf8_encode('
			Mail : ' . $rdsChildren->fields['email'] . '<br />');
			if ($rdsChildren->fields['nom_classe'] != "") $html .= utf8_encode('
			Classe : ' . $rdsChildren->fields['nom_classe'] . '<br />');
			if ($rdsChildren->fields['section'] != "") $html .= utf8_encode('
			Section : ' . $rdsChildren->fields['section'] . '<br />');
			
			if ($rdsChildren->fields['lv1'] != "") $html .= utf8_encode('
			LV1 : ' . $rdsChildren->fields['lv1'] . '<br />');
			if ($rdsChildren->fields['lv2'] != "") $html .= utf8_encode('
			LV2 : ' . $rdsChildren->fields['lv2'] . '<br />');
			if ($rdsChildren->fields['lv3'] != "") $html .= utf8_encode('
			LV3 : ' . $rdsChildren->fields['lv3'] . '<br />');
			
			if ($rdsChildren->fields['exploration1_libelle'] != "") $html .= utf8_encode('
			Enseignement d\'exploration n°1 : ' . $rdsChildren->fields['exploration1_libelle'] . '<br />');
			if ($rdsChildren->fields['exploration2_libelle'] != "") $html .= utf8_encode('
			Enseignement d\'exploration n°2 : ' . $rdsChildren->fields['exploration2_libelle'] . '<br />');
			if ($rdsChildren->fields['exploration3_libelle'] != "") $html .= utf8_encode('
			Enseignement d\'exploration n°3 : ' . $rdsChildren->fields['exploration3_libelle'] . '<br />');
			
			// Changement d'enregistrement.
			$rdsChildren->MoveNext();
		}
	}
	
	$html .= utf8_encode('
	<br /><br />Date :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature :
	');

	// Print text using writeHTMLCell()
	$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

	// ---------------------------------------------------------

	// Close and output PDF document
	// This method has several options, check the source code documentation for more information.
	$pdf->Output('FCPE.pdf', 'I');

	//============================================================+
	// END OF FILE
	//============================================================+

?>