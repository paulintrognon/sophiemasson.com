<?php
// -----------------------------------------------------------------------------------------
// -------------------------         Configuration             -----------------------------
// -----------------------------------------------------------------------------------------
require("fichiers_conf.php");


$url = explode("/",$_SERVER['REQUEST_URI']);

$langue = $url[NUM];
$section = $url[NUM+1];
$parametres = $url[NUM+2];
$item = $url[NUM+3];

if ($langue == "porcelaine" OR empty($langue))
{	
	require("dictionnaire/langue.php");
	$langue = "Fr";
}
else
{
	require("dictionnaire/english.php");
	$langue = "En";
}
require("dictionnaire/formes_vaisselle.php");
// ------------------------          Compilation           ---------------------------------
echo creer_templates($section,$item,$parametres,$langue);

?>