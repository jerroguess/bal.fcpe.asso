<?PHP

/*
  --------------------------------------------------------------------
  view.bo.home.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    echo '<h1><img class="fcpe" alt="logo" src="public/images/fcpe.png">&nbsp;&nbsp;FCPE  Bourse aux livres</h1>';
    echo '<br/>';
	echo '<br/>';
    echo '<div class="row">';
        echo '<div class="col-lg-12">';
		?>
			Afin de pouvoir participer à une bourse aux livres F.C.P.E, il est légalement obligatoire d'adhérer à l'association.<br/>
			Les bourses aux livres sont organisées par des bénévoles de la FCPE<br/>
			Le processus de préinscription se passe en plusieurs étapes :<br/>
			<ul>
				<li>Choix de votre département</li>
				<li>Choix de votre établissement scolaire</li>
				<li>Enregistrement de vos données (Nom, prénom, adresse,…)</li>
				<li>Enregistrement des données de votre enfant (Nom, prénom, classe, section,…)</li>
			</ul>
			Lors de votre venue dans les locaux de la FCPE, votre fiche sera exploitée pour la Bourse aux livres. Ceci permettra à tout le monde de gagner du temps et d’éviter des erreurs de saisie.<br/>
			<br/>
			<?
			if ($_SESSION['statut_connection'] != 1) {
			?>
			<a href="enregistrer"><button type="submit" id="btnLogin" class="btn btn-success">Nouvelle inscription</button></a>
			<?
			}
			?>
			<br/><br/>
			<br/>
			<div style="text-align:justify;">
			Les informations recueillies sont nécessaires pour votre adhésion. Elles font l'objet d'un traitement informatique et sont destinées au secrétariat de l'association. En application des articles 39 et suivants de la loi du 6 janvier 1978 modifiée, vous bénéficiez d'un droit d'accès et de rectification aux informations qui vous concernent.<br/><br/>
			Si vous souhaitez exercer ce droit et obtenir communication des informations vous concernant, veuillez-vous adresser à FCPE, 108 Avenue Ledru Rollin, 75544 PARIS Cedex 11
			</div>
			<br/>
			
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<?PHP
        echo '</div>';
    echo '</div>';
    
    echo '<br/>';

?>