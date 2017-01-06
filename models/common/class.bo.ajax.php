<?php

/*
  --------------------------------------------------------------------
  class.bo.ajax.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class common_Ajax {
    
    public function __construct() {

    }
    
    public function render(){
        return json_encode($this);
    }
    
    public $erreur;
    public $nom;
    public $titre;
    public $description;
}

?>