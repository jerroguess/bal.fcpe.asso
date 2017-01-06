<?php

/*
  --------------------------------------------------------------------
  ajax.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

// On empeche l'affichage des erreurs.
//error_reporting(0);
// Positionnement des variables de génération des phpsessionid.
ini_set("session.use_trans_sid", "0");
ini_set("arg_separator.output", "&amp");

// Inclusions du controleur.
require dirname(__FILE__) . '/controllers/_require.ajax.php';

// Inclusion de la vue.
require dirname(__FILE__) . '/views/_require.ajax.php';

// Inclusion du model.
require dirname(__FILE__) . '/models/_require.php';

// Inclusions des composants.
require dirname(__FILE__) . '/components/adodb/adodb.inc.php';
require dirname(__FILE__) . '/components/htmlpurifier/library/HTMLPurifier.auto.php';

// Génération de la page.
$front = boFrontAjaxController::dispatch();

?>