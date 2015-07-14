<?php

// Paramètres connexion serveur
require("librairie/lib_fichiers.inc.php");


// Lister les fichiers des répertoires
$liste_repertoires = array( "conf", "librairie", "templates");

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