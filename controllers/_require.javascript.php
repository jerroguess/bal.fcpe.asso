<?php

/*
--------------------------------------------------------------------
_require.javascript.php
--------------------------------------------------------------------
Creator : X.ROUILLY 10/02/2015
--------------------------------------------------------------------
(c) 2013. All Rights Reserved.  FCPE
--------------------------------------------------------------------
*/

    // Chargement du core.
    require dirname(__FILE__) . '/core/class.bo.action.javascript.controller.php';
    require dirname(__FILE__) . '/core/class.bo.core.exception.php';
    require dirname(__FILE__) . '/core/class.bo.front.javascript.controller.php';

    require dirname(__FILE__) . '/core/class.bo.request.php';
    require dirname(__FILE__) . '/core/class.bo.response.php';

    // Chargement des fichiers de configuration.
    require dirname(__FILE__) . '/config/class.bo.config.texte.php';
    require dirname(__FILE__) . '/config/class.bo.config.bdd.php';
    require dirname(__FILE__) . '/config/class.bo.config.path.php';

?>