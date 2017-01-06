<?PHP

/*
  --------------------------------------------------------------------
  view.bo.profilafficher.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    echo '<h1><img class="fcpe" alt="logo" src="public/images/fcpe.png">&nbsp;&nbsp;' . _("vbo_profilafficher_titre") . '</h1>';
    echo '<br/>';
    echo _("vbo_activiteajouter_description");
    echo '<br/>';
	echo '<br/>';
    echo '<strong>' . _("vbo_profilafficher_nom") . '</strong> ' . $_SESSION["nom"];
	echo '<br/>';
	echo '<strong>' . _("vbo_profilediter_prenom") . '</strong> ' . $_SESSION["prenom"] . "<br/>";
    echo '<br/>';
    echo '<br/>';
    echo '<a href="' . fct_form_Url(90, array("profil", "remplir")) . '"><button type="button" id="btnLogin" class="btn btn-success">' . _("vbo_profilafficher_modifierprofil") . '</button></a>';
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