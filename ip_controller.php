<?php
//Llamada al modelo
require_once("Models/ip_model.php");
$ip_mod=new ip_model();
$datos=$ip_mod->get_datos($ip);
//Llamada a la vista
require_once("Views/ip_view.php");


?>
