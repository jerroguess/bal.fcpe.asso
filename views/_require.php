<?php

/*
  --------------------------------------------------------------------
  _require.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

    // Chargement des différents core.
    // Pages
    require dirname(__FILE__) . '/pages/core/inc_form_controls_statiques.php';
    require dirname(__FILE__) . '/pages/core/inc_form_traitement_text.php';

    // Masters
    require dirname(__FILE__) . '/masters/core/class.bo.master.php';
    require dirname(__FILE__) . '/masters/core/class.bo.masterajax.php';
    require dirname(__FILE__) . '/masters/core/class.bo.masterjavascript.php';
    
?>