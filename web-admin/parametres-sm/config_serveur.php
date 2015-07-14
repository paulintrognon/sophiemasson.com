<?php
if ($_SERVER['HTTP_HOST'] == "sophiemasson.dev")
{
	define("BASE","masson");
	define("HOST","root");
	define("SERVEUR","localhost");
	define("PASSWORD","");
	define("URL","http://localhost/web-admin/");
	define("URL_ADMIN","http://localhost/web-admin/index.php");
	define("URL_IMAGES","http://localhost/web-admin/images/");
	define("URL_MYADMIN","http://localhost/");
	define("ROOT","");
	define("NBRE","2");
}
else
{
	define("BASE","sophiemass");
	define("HOST","sophiemass");
	define("SERVEUR","localhost");
	define("PASSWORD","ekoHLXZ2");
	define("URL","http://www.sophiemasson.com/web-admin/");
	define("URL_ADMIN","http://www.sophiemasson.com/web-admin/index.php");
	define("URL_IMAGES","http://www.sophiemasson.com/web-admin/images/");
	define("URL_MYADMIN","http://mysql7.rapidomaine.com");
	define("ROOT","");
	define("NBRE","2");
}

// des constantes pour l'identification du site
define("AUTHOR","Arnaud Meunier");
define("CHARSET","text/html; charset=ISO-8859-1");
define("EMAIL","");
define("EMAIL_ADMIN","");
define("LANGUE","Fr");
define("NOM_EMAIL","Sophie Masson");
define("NOM_SITE","Sophie Masson");
define("TITLE","Espace d'administration du site ");
define("ROBOTS","index, follow, all");
define("MIN_SIZE","100");
?>