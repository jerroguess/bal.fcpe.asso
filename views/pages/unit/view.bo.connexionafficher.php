<?PHP

/*
  --------------------------------------------------------------------
  view.bo.connexionafficher.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    $strEmail = $this->_request->getParamByKey('mail_Saisie');
    $aError = $this->_request->getParamByKey('error');
    
    echo '<div class="row">';
        echo '<div class="col-lg-6">';
            
            echo '<h1>' . _("vbo_connexion_titre") . '</h1>';
            echo '<br/>';
            
            echo '<label for="username2" class="control-label">' . _("vbo_enregistrerafficher_email") . '</label>';
            echo '<input name="username2" id="username2" placeholder="' . _("vbo_connexionafficher_email") . '" class="form-control input-sm" type="text"> ';
            echo '<br/>';

            echo '<label for="password2" class="control-label">' . _("vbo_changepasswordafficher_motpasse") . '</label>';
            echo '<input name="password2" id="password2" placeholder="' . _("vbo_connexionafficher_mdp") . '" class="form-control input-sm" type="password"><br/>';
            echo '<br/>';

            echo '<button type="submit" id="btnLogin2" class="btn btn-success">Connexion</button>';
            echo '<br/>';

            echo '<br/>';
            echo '<br/>';
            echo '<br/>';
            echo 'Mot de passe oublié ? <a href="memoiremdp">' . _("vbo_menu_sejours_lien") . '</a>.';
            echo '<br/>';
            echo '<br/>';
                
        echo '</div>';
        echo '<div class="col-lg-6">';
            echo '<br/>';
            echo '<br/>';
            echo '<br/>';
            echo '<br/>';
            echo "<strong>" . _("vbo_connexionafficher_visiteur") . "</strong>";
            echo '<br/>';
            echo '<br/>';
            echo _("vbo_connexionafficher_evenement");
            echo '<br/>';
            echo '<br/>';
            echo _("vbo_connexionafficher_conditions");
            echo '<br/>';
            echo '<br/>';
            echo '<a class="button vert big" href="enregistrer"><button type="button" class="btn btn-success">' . _("inc_logo_inscription") . '</button></a>';
            echo '<br/>';
            echo '<br/>';
        echo '</div>';
    echo '</div>';
    
    echo '<br/>';
    echo '<br/>';

    
?>