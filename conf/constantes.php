<?php
// ****************************************************************************************************
// **********************        Les  constantes  du  site         ************************************
// ****************************************************************************************************

// On d�signe comme "constantes", les variables qui ne changent pas dans tout le site
// On d�tecte si le site tourne en local ou en ligne
// On donne des valeurs aux variables de connexion et l'url de la base du site

if ($_SERVER['HTTP_HOST'] == "sophiemasson.dev")
{
	define("BASE","sophiemass");
        define("HOST","root");
        define("SERVEUR","localhost");
        define("PASSWORD","");
	define("URL","http://sophiemasson.dev/");
	define("NUM","1");
	define("URL_IMG","http://www.sophiemasson.com/web-admin/upload/photos/");
}
else
{
        define("BASE","sophiemass");
        define("HOST","sophiemass");
        define("SERVEUR","localhost");
        define("PASSWORD","ekoHLXZ2");
        define("URL","http://www.sophiemasson.com/");
        define("URL_IMG","http://www.sophiemasson.com/web-admin/upload/photos/");
        define("NUM","1");
}

// des constantes pour l'identification du site
define("AUTHOR","Arnaud Meunier");
define("LANGUE","Fr");
define("CHARSET","text/html; charset=ISO-8859-1");
define("ROBOTS","index, follow, all");
define("TITRE","Sophie Masson, porcelaine personnalis�e Lille Paris");
define("KEYWORDS","Sophie Masson, vaisselle, porcelaine, lille, paris, mugs, assiette, tasse, bol, plateau, cr�ation, cr�atrice, personnalisation, sur-mesure, vente");
define("DESCRIPTION","Sophie Masson, cr�atrice de services en porcelaine personnalis�s / �dition sur porcelaine, Lille et Paris. Art de la table, mugs, assiettes, tasses, caf�s, bols, vases, d�jeuners...");
define("FROM_NAME", "Sophie Masson");
define("FROM_EMAIL", "sophie-masson@orange.fr");
define("TO_EMAIL", "sophie-masson@orange.fr");
?>