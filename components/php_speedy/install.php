<?php
//We need these
require("controller/admin.php");
require("libs/php/view.php");

//Set the default page
if(empty($_GET['page'])) {
$_GET['page'] = 'install_set_password';
}

//Merge _GET and _POST
$input = array_merge($_GET,$_POST);

//Con. the view library
$view = new compressor_view();

//Con. the admin controller
new admin(array('view'=>$view,'input'=>$input));
?>