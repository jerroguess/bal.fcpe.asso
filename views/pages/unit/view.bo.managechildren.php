<?PHP

/*
  --------------------------------------------------------------------
  view.bo.managechildren.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	$rdsChildren = $this->_request->getParamByKey('rdsChildren');
    
	
	// ******************************************
	// Ouverture du cadre.
	// ******************************************
	echo '<h1><img class="fcpe" alt="logo" src="public/images/fcpe.png">&nbsp;&nbsp;Liste des enfants</h1>';
    echo '<br/>';
	echo '<br/>';
	echo '<br/>';
	
	if ($rdsChildren->RecordCount() == 0) {
	
		echo 'Vous n\'avez pas encore ajouté d\'enfant.';
		
	}else{
	
		// Parcours des enregistrements.	
		while (!$rdsChildren->EOF) {
			
			echo $rdsChildren->fields['nom'] . ' ' . $rdsChildren->fields['prenom'] . ' <a href="' . fct_form_Url(89, array('updatechildren', $rdsChildren->fields['id'])) . '">modifier</a> - <a href="' . fct_form_Url(91, array('managechildren', 'supprimer', $rdsChildren->fields['id'])) . '">supprimer</a><br/>';
			
			// Changement d'enregistrement.
			$rdsChildren->MoveNext();
		}
	}

	echo '<br/>';
	echo '<br/>';
	echo '<a href="addchildren"><button type="submit" id="btnLogin" class="btn btn-success">Ajouter un enfant</button></a>';
	echo '<br/>';
	echo '<br/>';	
	echo '<br/>';
	echo '<br/>';
	echo '<br/>';
    echo '<br/>';
    echo '<br/>';
    echo '<br/>';
	echo '<br/>';
    echo '<br/>';
    echo '<br/>';
    echo '<br/>';
	echo '<br/>';
    echo '<br/>';
    echo '<br/>';
    echo '<br/>';
    echo '<br/>';
	echo '<br/>';
    echo '<br/>';
    echo '<br/>';
    echo '<br/>';

	
?>