<?php
/*  
		############################################################################
		Outil d'administration de site internet 
		Author : Arnaud Meunier
		Version : 1.5
		Date : janvier 2007 
		############################################################################
*/


// Paramètres connexion serveur
require(URL_PARAMETRES."/config_serveur.php");
require(URL_PARAMETRES."/config_dico.php");
require(URL_PARAMETRES."/config_requetes.php");
require(URL_PARAMETRES."/config_formulaires.php");
require(URL_PARAMETRES."/config_sections.php");
require("librairie/lib_fichiers.inc.php");


// Lister les fichiers des répertoires
$liste_repertoires = array( "dictionnaire", "librairie", "templates");

for ($i=0; $i<count($liste_repertoires); $i++)
{
	$repertoire = $liste_repertoires[$i].'/';
	$fichiers = lister_fichiers_repertoire($repertoire);
	for($f=0; $f<count($fichiers); $f++)
	{
		if ($fichiers[$f] != "lib_fichiers.inc.php")
		{
			require_once($repertoire.$fichiers[$f]);
		}
	}
}

?>