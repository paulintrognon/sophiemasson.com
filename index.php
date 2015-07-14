<?php
// -----------------------------------------------------------------------------------------
// -------------------------         Configuration             -----------------------------
// -----------------------------------------------------------------------------------------
require("fichiers_conf.php");

$url = explode("/",$_SERVER['REQUEST_URI']);

$num = NUM;

$langue = isset($url[$num]) ? $url[$num] : NULL;
$section = isset($url[$num+1]) ? $url[$num+1] : NULL;
$parametres = isset($url[$num+2]) ? $url[$num+2] : NULL;
$item = isset($url[$num+3]) ? $url[$num+3] : NULL;

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