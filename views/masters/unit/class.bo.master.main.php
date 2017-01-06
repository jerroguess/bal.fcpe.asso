<?PHP

/*
  --------------------------------------------------------------------
  class.bo.master.main.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class boMasterMain extends boMaster {

    public function __construct(boRequest $request, boResponse $response, $_strViewFile, $_strErrorFile, $_aFileCSS, $_aURLCSS, $_aFileJS, $_aMenu, $_aCadre, $_connection, $_strTitre) {
        parent::__construct($request, $response, $_strViewFile, $_strErrorFile, $_aFileCSS, $_aURLCSS, $_aFileJS, $_aMenu, $_aCadre, $_connection, $_strTitre);
    }

    public function render() {

        // Connection base de donnée.
        $connection = $this->_connection;

        // ---------------------
        // Entete de la page.
        // ---------------------
        header("Content-Type: text/html; charset=iso-8859-15");

        if ((!(isset($this->_strTitre))) || ($this->_strTitre == "")) {
            $this->_strTitre = _("master_titre");
        }

        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
		echo "\n";
        echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">';
		echo "\n";
            echo '<head profile="http://microformats.org/profile/hcard">';
			echo "\n";
                echo '<link rel="SHORTCUT ICON" href="public/images/favicon.ico"/>';
				echo "\n";
                echo '<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />';
				echo "\n";
                echo '<link rel="schema.DCTERMS" href="http://purl.org/dc/terms/" />';
				echo "\n";
                echo '<title>FCPE - Adhésion en ligne</title>';
				echo "\n";
                echo '<meta name="author" content="Nicolas ROUILLY"/>';
				echo "\n";
                echo '<meta name="description" content="Site adhésion de la fcpe"/>';
				echo "\n";
                echo '<meta name="keywords" content="adhésion, fcpe" />';
				echo "\n";
                echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15"/>';
				echo "\n";
                echo '<meta name="Robots" content="follow,index,all"/>';
				echo "\n";
                echo '<meta name="REVISIT-AFTER" content="7 days"/>';
				echo "\n";
                echo '<meta name="geo.position" content="44.933333;4.891667"/>';
				echo "\n";
                echo '<meta name="geo.placename" content="Valence, Rhône Alpes, France"/>';
                echo "\n";
				echo '<meta name="geo.region" content="fr-rh"/>';
                echo "\n";
				echo '<meta name="DC.title" content="' . $this->_strTitre . '" xml:lang="fr" />';
                echo "\n";
				echo '<meta name="DC.language" content="fr-FR" scheme="DCTERMS.RFC4646" />';
                echo "\n";
				echo '<meta name="DCTERMS.created" content="2010-10-10" scheme="DCTERMS.W3CDTF" />';
                echo "\n";
				echo '<meta name="DC.format" scheme="DCTERMS.IMT" content="text/html" />';
                echo "\n";
				echo '<meta name="DC.type" scheme="DCTERMS.DCMIType" content="Text" />';
                echo "\n";
				echo '<meta name="DC.publisher" content="FCPE" />';
                echo "\n";
				echo '<meta name="DC.rights" content="' . _("master_droits") . '" />';
				echo "\n";				
                echo '<base href="' . SITE_PATH . '"/>';
				echo "\n";

                // ---------------------
                // CSS.
                // ---------------------
				if(!(preg_match('/(?i)msie [1-9]/',$_SERVER['HTTP_USER_AGENT'])))
				{
					echo '<link rel="stylesheet" type="text/css" href="' . SITE_PATH . 'public/styles/all-screen.css?version=' . VERSION . '" />';
					echo "\n";
					echo '<link rel="stylesheet" type="text/css" href="' . SITE_PATH . 'public/styles/bootstrap.min.css?version=' . VERSION . '" />';
					echo "\n";
					
					if (isset($this->_aFileCSS)) {
						foreach ($this->_aFileCSS as $fileCSS) {
							echo '<link rel="stylesheet" type="text/css" href="' . SITE_PATH . 'public/styles/' . $fileCSS . '.css?version=' . VERSION . '" />';
							echo "\n";
						}
					}
					echo '<link rel="stylesheet" type="text/css" href="' . SITE_PATH . 'public/styles/jquery-ios-overlay.css?version=' . VERSION . '" />';
					echo "\n";
					echo '<link rel="stylesheet" type="text/css" href="' . SITE_PATH . 'public/styles/jquery-ui-1.10.3.custom.css?version=' . VERSION . '" />';
					echo "\n";
					echo '<link rel="stylesheet" type="text/css" href="' . SITE_PATH . 'public/styles/jquery.reject.css?version=' . VERSION . '" />';
					echo "\n";
			
					// ---------------------
					// JS.
					// ---------------------
					echo '<script src="' . SITE_PATH . 'javascript/all" type="text/javascript"></script>';
					echo "\n";
					echo '<script src="' . SITE_PATH . 'public/javascripts/jquery.min.js?version=' . VERSION . '" type="text/javascript"></script>';
					echo "\n";
					echo '<script src="' . SITE_PATH . 'public/javascripts/jquery-ui-1.10.3.custom.js?version=' . VERSION . '" type="text/javascript"></script>';
					echo "\n";
					echo '<script src="' . SITE_PATH . 'public/javascripts/all.js?version=' . VERSION . '" type="text/javascript"></script>';
					echo "\n";
					echo '<script src="' . SITE_PATH . 'public/javascripts/bootstrap.min.js?version=' . VERSION . '" type="text/javascript"></script>';
					echo "\n";
					echo '<script src="' . SITE_PATH . 'public/javascripts/jquery.reject.min.js?version=' . VERSION . '" type="text/javascript"></script>';
					echo "\n";
					
					if (isset($this->_aFileJS)) {
						foreach ($this->_aFileJS as $fileJS) {
							if ((!strpos($fileJS, "http")) && (!strpos($fileJS, "/"))) {
								echo('<script charset="utf-8" src="' . SITE_PATH . 'public/javascripts/' . $fileJS . '.js?version=' . VERSION . '" type="text/javascript"></script>');
								echo "\n";
							} else {
								echo('<script charset="utf-8" src="' . $fileJS . '" type="text/javascript"></script>');
								echo "\n";
							}
						}
					}
				}else{
					echo '<link rel="stylesheet" type="text/css" href="' . SITE_PATH . 'public/styles/jquery.reject.css?version=' . VERSION . '" />';
					echo "\n";
				}
                

            // ---------------------
            // Body.
            // ---------------------
            echo '</head>';
            echo '<body>';
			if(!(preg_match('/(?i)msie [1-9]/',$_SERVER['HTTP_USER_AGENT'])))
			{
            ?>
					<nav class="navbar navbar-default">
					  <div class="container-fluid">


						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						  <ul class="nav navbar-nav navbar-right">
								  <?PHP 
								  
								  if ($_SESSION['statut_connection'] != 1) {

								  ?>
								  <li class="dropdown" id="menuLogin">
									<a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin" role="button" aria-expanded="false"><?PHP echo _("master_connexion"); ?><span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu" style="padding:17px;width:260px;">
									  <li>
										  <form action="connexion" method="post" id="menu_HCnxForm">
											<input name="username" id="username" placeholder="<?PHP echo _("master_identifiant"); ?>" class="form-control input-sm" type="text"> 
											<br/>
											<input name="password" id="password" placeholder="<?PHP echo _("master_motdepasse"); ?>" class="form-control input-sm" type="password"><br>
											<button type="button" id="btnLogin" class="btn btn-success"><?PHP echo _("master_connexion"); ?></button>
											<input id="menu_HCnxLog" name="login" type="hidden" value="" />
											<input id="menu_HCnxPas" name="mdp" type="hidden" value="" />
											<input id="action" name="action" type="hidden" value="soumettre" />
										  </form>
									  </li>
									  <li class="divider"></li>
									  <li><a href="enregistrer"><?PHP echo _("master_enrgistrer"); ?></a></li>
									  <li class="divider"></li>
									  <li><a href="memoiremdp"><?PHP echo _("master_oublimdp"); ?></a></li>
									</ul>
								  </li>
								  <?PHP 
								  
								} else {
								
									if ($_SESSION['type'] == 0) {
										?>
										<li class="dropdown">
											<a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin" role="button" aria-expanded="false"><?PHP echo $_SESSION["login"]; ?><span class="caret"></span></a>
											<div class="dropdown-menu" role="menu" style="padding:17px;width:260px;">
												<a href="updateparent">Données adhérent</a><br/>
												<a href="managechildren">Gérer les enfants</a><br/>
												<?PHP
													if ($_SESSION["pdf"] == 1){
												?>
												<div class="divider"></div>
												<a href="pdf?v=<?PHP echo guid(); ?>" target="_blank">Bulletin d'adhésion</a><br/>
												<?PHP
													}
												?>
												<div class="divider"></div>
												<a href="deconnexion"><?PHP echo _("master_deconnexion"); ?></a>
											</div>
										</li>
										<?PHP
									}elseif ($_SESSION['type'] == 1) {
										?>
										<li class="dropdown">
											<a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin" role="button" aria-expanded="false"><?PHP echo $_SESSION["login"]; ?><span class="caret"></span></a>
											<div class="dropdown-menu" role="menu" style="padding:17px;width:260px;">
												<a href="profil">Profil de connexion</a><br/>
												<div class="divider"></div>
												<a href="export">Exporter</a><br/>
												<div class="divider"></div>
												<a href="deconnexion"><?PHP echo _("master_deconnexion"); ?></a>
											</div>
										</li>
										<?PHP
									}else{
										?>
										<li class="dropdown">
											<a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin" role="button" aria-expanded="false"><?PHP echo $_SESSION["login"]; ?><span class="caret"></span></a>
											<div class="dropdown-menu" role="menu" style="padding:17px;width:260px;">
												<a href="deconnexion"><?PHP echo _("master_deconnexion"); ?></a>
											</div>
										</li>
										<?PHP
									}
								}

								  ?>
								</ul>
						</div><!-- /.navbar-collapse -->
					  </div><!-- /.container-fluid -->
					</nav>

                  
                  <div class="container">
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                <?PHP

                // ---------------------
                // Menu.
                // ---------------------
                // Inclusion du framework de menu.
                include(dirname(__FILE__) . '/../../../views/menus/core/inc_arch_architecture.php');

                // ---------------------
                // Cadres.
                // ---------------------
                // Ajout des cadres spécifiques.
                if (isset($this->_aCadre)) {
                    foreach ($this->_aCadre as $cadre) {
                        include(dirname(__FILE__) . '/../../../views/cadres/unit/cadre_' . $cadre . '.php');
                    }
                }

                // ---------------------
                // Cadre erreur.
                // ---------------------
                if (isset($this->_strErrorFile)) {
                    // Inclusion du framework de menu.
                    include(dirname(__FILE__) . '/../../../views/erreurs/core/inc_form_controls_statiques.php');
                    // Inclusion du cadre erreur.
                    include(dirname(__FILE__) . '/../../../views/erreurs/unit/view.bo.' . $this->_strErrorFile . '.php');
                }


                // ---------------------
                // Gestion de la page.
                // ---------------------
                if (!file_exists(dirname(__FILE__) . '/../../../views/pages/unit/view.bo.' . $this->_strViewFile . '.php')) {
                    $this->_strErrorFile = "404";
                    $this->_strViewFile = "vide";
                }

                // ---------------------
                // Page.
                // ---------------------		
                // Inclusion de la page.
                include (dirname(__FILE__) . '/../../../views/pages/unit/view.bo.' . $this->_strViewFile . '.php');

                echo '</div>';
                
                echo '<footer>';
					echo '<div class="footer-inter">';
						echo '<div class="row">';
						  echo '<div class="col-lg-12" style="margin-top:50px;">';

							echo '<p>';
								echo '<a class="navbar-right" href="cgu">' . _("master_mentions") . '</a>';
								echo '<span class="navbar-right">&nbsp;-&nbsp;</span>';
								echo '<a class="navbar-right" href="conditions">' . _("master_conditions") . '</a>';
								echo '<span class="navbar-right">&nbsp;-&nbsp;</span>';
								echo '<a class="navbar-right" href="suggestion">' . _("master_suggestion") . '</a>';
								echo '<span class="navbar-right">&nbsp;-&nbsp;</span>';
								echo '<a class="navbar-right" href="contact">' . _("master_contact") . '</a>';
								echo '<span class="navbar-right">&nbsp;-&nbsp;</span>';
								echo '<a class="navbar-right" href="about">' . _("master_apropos") . '</a>';
								echo '<span style="float:right;color:black;">©2015 Adhésion FCPE. ' . _("master_tousdroits") . '&nbsp;&nbsp;&nbsp;</span>';
							echo '</p>';
							
						  echo '</div>';
					  echo '</div>';
                    echo '</div>';
                echo '</footer>';
			}else{
			?>
				<DIV id=jr_wrap style="LEFT: 0px; TOP: 85px">
					<DIV id=jr_inner style="MAX-WIDTH: 700px; WIDTH: 775px; MIN-WIDTH: 500px">
						<H1 id=jr_header>Votre navigateur n'est plus supporté</H1>
						<P>Vous utilisez actuellement un navigateur non supporté</P>
						<P>S'il vous plaît installer l'un de ces nombreux navigateurs ci-dessous avant de continuer</P>
						<UL>
							<LI id=jr_chrome style="BACKGROUND-POSITION: 0% 0%; BACKGROUND-COLOR: transparent">
							<DIV class=jr_icon style="BACKGROUND: url(./public/images/browser_chrome.gif) no-repeat left top" jQuery19100667101432634506="21"></DIV>
							<DIV><A href="http://www.google.com/chrome/" jQuery19100667101432634506="31">Google Chrome</A></DIV></LI>
							<LI id=jr_firefox style="BACKGROUND-POSITION: 0% 0%; BACKGROUND-COLOR: transparent">
							<DIV class=jr_icon style="BACKGROUND: url(./public/images/browser_firefox.gif) no-repeat left top" jQuery19100667101432634506="23"></DIV>
							<DIV><A href="http://www.mozilla.com/firefox/" jQuery19100667101432634506="33">Mozilla Firefox</A></DIV></LI>
							<LI id=jr_safari style="BACKGROUND-POSITION: 0% 0%; BACKGROUND-COLOR: transparent">
							<DIV class=jr_icon style="BACKGROUND: url(./public/images/browser_safari.gif) no-repeat left top" jQuery19100667101432634506="25"></DIV>
							<DIV><A href="http://www.apple.com/safari/download/" jQuery19100667101432634506="34">Safari</A></DIV></LI>
							<LI id=jr_opera style="BACKGROUND-POSITION: 0% 0%; BACKGROUND-COLOR: transparent">
							<DIV class=jr_icon style="BACKGROUND: url(./public/images/browser_opera.gif) no-repeat left top" jQuery19100667101432634506="27"></DIV>
							<DIV><A href="http://www.opera.com/download/" jQuery19100667101432634506="35">Opera</A></DIV></LI>
							<LI id=jr_msie style="BACKGROUND-POSITION: 0% 0%; BACKGROUND-COLOR: transparent">
							<DIV class=jr_icon style="BACKGROUND: url(./public/images/browser_msie.gif) no-repeat left top" jQuery19100667101432634506="29"></DIV>
							<DIV><A href="http://www.microsoft.com/windows/Internet-explorer/" jQuery19100667101432634506="36">Internet Explorer</A></DIV></LI>
						</UL>
						<DIV id=jr_close></DIV>
					</DIV>
				</DIV>
			<?PHP
			}
            echo '</body>';
        echo '</html>';
    }
}

?>