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
			Afin de pouvoir participer � une bourse aux livres F.C.P.E, il est l�galement obligatoire d'adh�rer � l'association.<br/>
			Les bourses aux livres sont organis�es par des b�n�voles de la FCPE<br/>
			Le processus de pr�inscription se passe en plusieurs �tapes :<br/>
			<ul>
				<li>Choix de votre d�partement</li>
				<li>Choix de votre �tablissement scolaire</li>
				<li>Enregistrement de vos donn�es (Nom, pr�nom, adresse,�)</li>
				<li>Enregistrement des donn�es de votre enfant (Nom, pr�nom, classe, section,�)</li>
			</ul>
			Lors de votre venue dans les locaux de la FCPE, votre fiche sera exploit�e pour la Bourse aux livres. Ceci permettra � tout le monde de gagner du temps et d��viter des erreurs de saisie.<br/>
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
			Les informations recueillies sont n�cessaires pour votre adh�sion. Elles font l'objet d'un traitement informatique et sont destin�es au secr�tariat de l'association. En application des articles 39 et suivants de la loi du 6 janvier 1978 modifi�e, vous b�n�ficiez d'un droit d'acc�s et de rectification aux informations qui vous concernent.<br/><br/>
			Si vous souhaitez exercer ce droit et obtenir communication des informations vous concernant, veuillez-vous adresser � FCPE, 108 Avenue Ledru Rollin, 75544 PARIS Cedex 11
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