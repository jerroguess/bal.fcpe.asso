<?PHP

/*
  --------------------------------------------------------------------
  view.bo.404.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    // Ouverture du cadre.
    echo '<h1>' . _("cadre_erreur_404_titre") . '</h1>';
    echo '<br/>';
    echo '<p class="text-danger">' . _("cadre_erreur_404_description") . '</p>';
    echo '<br/>';
    echo '<a href="' . fct_form_Url(100, array('home')) . '"><button class="btn btn-primary" type="button">' . _("cadre_erreur_404_lien") . '</button></a>';
    echo '<br/>';
    echo '<br/>';

?>