<?php

/*
  --------------------------------------------------------------------
  index.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

// On empeche l'affichage des erreurs.
//error_reporting(0);

// Positionnement des variables de génération des phpsessionid.
//ini_set("session.use_trans_sid", "0");
ini_set("arg_separator.output", "&amp");
ini_set('session.use_cookies',  true);
ini_set('session.use_only_cookies', true);
ini_set('session.cookie_lifetime', 5 * 60); // en secondes
//ini_set('session.cookie_path',  dirname($_SERVER['PHP_SELF']));
ini_set('session.cookie_domain', "");
ini_set('session.cookie_httponly', true); // PHP 5.2.0. minimum
ini_set('session.use_trans_sid', false);

// Inclusions du controleur.
require dirname(__FILE__) . '/controllers/_require.php';

// Inclusion de la vue.
require dirname(__FILE__) . '/views/_require.php';

// Inclusion du model.
require dirname(__FILE__) . '/models/_require.php';

// Inclusions des composants.
require dirname(__FILE__) . '/components/adodb/adodb.inc.php';
require dirname(__FILE__) . '/components/htmlpurifier/library/HTMLPurifier.auto.php';

//require dirname(__FILE__) . '/components/php_speedy/php_speedy.php';

// Génération de la page.
$front = boFrontController::dispatch();

//$compressor->finish();

?>