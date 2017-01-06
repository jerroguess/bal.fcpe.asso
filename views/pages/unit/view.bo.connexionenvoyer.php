<?PHP

/*
  --------------------------------------------------------------------
  view.bo.connexionenvoyer.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

	// R�cup�ration des param�tres de la page.
	$iCountAttente = $this->_request->getParamByKey('CountAttente');

	echo '<div class="row">';
		echo '<div class="col-lg-6">';

			echo '<h1>' . _("vbo_connexionenvoyer_titre") . '</h1>';
			echo '<br/>';
			echo '<br/>';
			echo "<strong>" . $_SESSION["prenom"] . " " . $_SESSION["nom"] . "</strong> : Connexion effectu�e.</br></br>Vous pouvez retrouver les principales fonctions li�es � votre compte ci-dessous :</br>";
			echo '<a href="updateparent">Donn�es adh�rent</a><br/>';
			echo '<a href="managechildren">G�rer les enfants</a><br/>';
			
			if ($_SESSION["pdf"] == 1){
				echo '<a href="pdf?v=' . guid() . '" target="_blank">Bulletin d\'adh�sion</a><br/>';
			}
			echo "</br><a href=\"deconnexion\"><button type=\"submit\" id=\"btnLogin\" class=\"btn btn-success\">D�connexion</button></a>";
			
                
        echo '</div>';
        echo '<div class="col-lg-6">';

			// Cadre d'utilisation.
			echo '<h1>' . _("vbo_connexionenvoyer_condition") . '</h1>';
			echo _("vbo_connexionenvoyer_description");
			echo '<br/>';
			echo "La FCPE peut supprimer sans pr�avis tout compte ayant un nom d'utilisateur non appropri�, ou dont l'utilisation serait contraire � la loi.";

    echo '</div>';
    echo '</div>';
    
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