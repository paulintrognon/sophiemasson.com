<?php
/*
** Function : Ecrire page d'administration
** Input : Action (ajout, liste, ...), section (article, commentaire, ...), id de l'item et affichage
** Output : donne une variable qui comprend le code html
** Description : génère la page d'administration
** Creator : Arnaud Meunier
** Date : mars 2006
*/
function page_admin($action,$section,$item,$affichage)
{
	$lien = $GLOBALS['lien'];
	$phrase = $GLOBALS['phrase'];
	$lien_images_arrondis = $lien['Images'];
	
	// -----------------------------------------------------------------------
	// -----------------  En-tête de page
	// -----------------  Balises Meta
	// -----------------------------------------------------------------------
	$lien_css = array(	"admin.css" => "all" );
	$nom_fichier_js = array( "lib_javascript.php" );
	$meta_description = "";
	$meta_keywords = "";
	$head = ecrire_balise_head($meta_title,$meta_description,$meta_keywords,$lien_css,"2");



	// -----------------------------------------------------------------------
	// -----------------  Contenu
	// -----------------------------------------------------------------------
	$body = '<body>';

	
	// -----------------------------------------------------------------------
	// navigation principale
	$body .= '<div id="nav_principale">';
	$tableau_valeurs = array(	"" => "Accueil",
								"sec=news&amp;act=lst" => "News",
								"sec=message&amp;act=lst" => "Messages" );
	$base_url = $lien['Admin'];
	$body .= ecrire_liste_simple_avec_liens($tableau_valeurs,$base_url);
	$body .= '</div>';
	
	
	// -----------------------------------------------------------------------
	// navigation secondaire
	$body .= '<div id="nav_secondaire">';
	if ($section == "news")
	{
		$tableau_valeurs = array(	"act=add&amp;sec=news" => "Ajouter une news" );
	}
	else
	{
		$tableau_valeurs = array();
	}
	$base_url = $lien['Admin'];
	$body .= ecrire_liste_simple_avec_liens($tableau_valeurs,$base_url);
	$body .= '</div>';
	
	
	// -----------------------------------------------------------------------
	// corps de la page
	$body .= '<div id="corps_page">';
	$body .= '<p class="arrondis"><img src="'.$lien_images_arrondis.'arrondis-top.png" alt="" /></p>';
	$body .= ecrire_titre_page($action,$section);
	
	// On recherche les données dans la base de données
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	
	// -----------------------------------------------------------------------
	// Si l'action demandée est une liste
	if ($action == 'lst')
	{
		// Si on doit changer l'affichage
		if ($affichage != "" AND $item > 0)
		{
			changer_affichage_item($item,$affichage,$section);
		}
		
		// On affiche la liste des éléments
		if ($section == "news")
		{
			$requete = requete_liste_news($section,"");
		}
		else if ($section == "message")
		{
			$requete = requete_liste_messages("");
		}
		
		// On génère un tableau
		$rs = requete_table($requete);
		$valeurs = creer_tableau_liste($rs);
		
		// On affiche les données dans un tableau
		$lien = $lien['Admin'];
		$body .= ecrire_liste_enregistrements($valeurs,$section,$lien);
	}

	// -----------------------------------------------------------------------
	// Si l'action demandée est une insertion ou une modification
	else if ($action == 'add' OR $action == 'upd')
	{
		if ($section == "news")
		{
			// Si l'action concerne un texte
			if (isset($_POST['controle']) AND $_POST['controle'] == "texte")
			{
				$values = array(	"Titre" => $_POST['Titre'],
									"Texte" => $_POST['Texte'],
									"DateDebut" => $_POST['DateDebut'],
									"DateFin" => $_POST['DateFin'],
									"ID" => $_POST['ID'],
									"Affichage" => $_POST['Affichage'] );
				$body .= ajouter_donnees_texte_base($action,$item,$_POST);
			}
			else if ($action == 'upd' AND $item > 0)
			{
				$requete = requete_news($item,$section);
				$rs = requete_table($requete);
				$row = mysql_fetch_array($rs);
				$values = array(	"Titre" => $row['Titre'],
									"Texte" => $row['Texte'],
									"DateDebut" => $row['DateDebut'],
									"DateFin" => $row['DateFin'],
									"ID" => $row['ID'],
									"Affichage" => $row['Affichage'] );
				$body .= ecrire_form_texte($section,$values);
			}
			else 
			{
				$values = array(	"Titre" => "",
									"Texte" => "",
									"DateDebut" => "",
									"DateFin" => "",
									"ID" => "",
									"Affichage" => "no" );
				$body .= ecrire_form_texte($section,$values);
			}
		}
		if ($section == "message")
		{
			$body .= lire_email($item);
		}
	}
	
	// -----------------------------------------------------------------------
	// Si l'action demandée est une suppression
	else if ($action == 'del')
	{
		if (isset($_POST['controle']) AND $_POST['controle'] == "suppression")
		{
			if (supprimer_enregistrement($section,$item) == TRUE)
			{
				$body .= ecrire_erreur($phrase['VotreEnregistrementSupprime']);
			}
		}
		else
		{
			$body .= ecrire_validation_suppression($section,$item);
		}
	}
	
	// -----------------------------------------------------------------------
	// Si l'action demandée est vide, on est sur la homepage
	else
	{
		$body .= '<p>&nbsp;</p>';
		$body .= '<p class="txtupload">'.$phrase['GestionAdmin'].'</p>';
		$body .= '<p>&nbsp;</p>';
	}
	
	connexion_end();

	$body .= '<p class="arrondis"><img src="'.$lien_images_arrondis.'arrondis-bottom.png" alt="" /></p>';
	$body .= '</div>';
	
	$body .= '<div id="spacer_page">&nbsp;</div>';
	$body .= '</body>';
	
	
	
	// -----------------------------------------------------------------------
	// ----------------   Compiler la page
	// -----------------------------------------------------------------------
	return ecrire_doctype_html($head,$body);
}
?>