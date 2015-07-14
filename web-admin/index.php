<?php
/*  
		############################################################################
		Outil d'administration de site internet 
		Author : Arnaud Meunier
		Version : 1.5
		Date : janvier 2007 
		############################################################################
*/


session_start();

// On intègre tous les fichiers de configuration
define("URL_PARAMETRES","parametres-sm");
require ("fichiers_conf.php");



// On récupère les variables communiquées par l'url

$var_url = parse_str($_SERVER['QUERY_STRING'],$output);
$section = $output['sec'];
$action = $output['act'];
$item = $output['id'];
$affichage = $output['aff'];
$upload_media = $output['upl'];
$action_serveur = $output['ser'];
$media = $output['med'];




/*
	On contrôle s'il existe une session d'identification
	On contrôle que cette session n'est pas vide
	On contrôle que cette session a bien été ouverte
	Si tout est ok, on affiche une page intérieure.
*/
if (	isset($_SESSION['WA_USER']) AND $_SESSION['WA_USER'] > 0 ) 
{
	
	/* 
		On controle que l'utilsateur est bien autorisé à accéder à cette section.
		Si oui, on affiche la page sans souci. 
		Si non, on revient à la page d'accueil.
	*/
	
	if (	!empty($action_serveur) )
	{
		echo templates_page_upl($upload_media,$action_serveur,$media,$tab_content[$section]['orientation']);
	}
	else
	{
		if ( !empty($section) AND $tab_content[$section]['niveau_acces'] <= $_SESSION['NIVEAU_USER'] )
		{
			echo templates_page_admin($action,$item,$section,$affichage);
		}
		else
		{
			echo templates_page_admin("","","","");
		}
	}
	
	/*
		On met à jour le liste des flux RSS du site
		Si un problème empèche la création des flux, un email est envoyé à l'administrateur du site
	*/
	if (!empty($tab_flux) AND generer_liste_flux_rss($tab_flux) == FALSE)
	{
		$To = EMAIL_ADMIN;
		$Sujet = $phrase_gene['SujetEmailPrbRss'];
		$Message = $phrase_gene['TextePrbEmailRss'].NOM_SITE;
		$From = "From: Arnaud Meunier <arno_job@yahoo.fr>\n";
		mail($To,$Sujet,$Message,$From);
	}

}


/*
	On contrôle que le formulaire d'identification a bien été envoyé
	Si oui, on contrôle le login et le mot de passe. 
	Si l'utilisateur est reconnu, on l'enregistre dans le table "suivilog" et on recharge la page
	Si l'utilisateur n'est pas reconnu, on affiche le formulaire d'identification avec le message d'erreur
*/

else if (	isset($_POST['login']) 
					AND !empty($_POST['login']) )
{
	// enregistrement dans suivilog et variables session dans la fonction de controle
	if (controle_identification($_POST['login'],$_POST['password']) == TRUE)
	{
		echo templates_page_admin("","","","");
	}
	else
	{
		echo templates_login($phrase_gene['VosIdentifiantsNonReconnus'],$_POST);
	}
}


/* 
	Si on a aucune action en cours et de session ouverte, on affiche le formulaire d'identification
*/

else
{
	$valeurs_form = array();
	echo templates_login("",$valeurs_form);
	exit();
}
?>
