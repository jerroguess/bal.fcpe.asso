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

/**
 * Autoload pour notre application.
 * Attention, les noms de classes et de fichiers sont sensibles
 * à la casse.
 */
function __autoload($astrClassname) {
    $ltabClassname = explode('_', $astrClassname);
    $strPath = dirname(__FILE__) . '/' . $ltabClassname[0] . '/' . 'class.bo.' . strtolower(substr($astrClassname, strlen($ltabClassname[0]) + 1)) . '.php';
    if (file_exists($strPath))
        require $strPath;
}

if (function_exists('__autoload'))
    spl_autoload_register('__autoload');
?>
