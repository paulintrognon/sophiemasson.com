<?php
/*
** Function : Ecrire page d'administration
** Input : Action (ajout, liste, ...), section (article, commentaire, ...), id de l'item et affichage
** Output : donne une variable qui comprend le code html
** Description : génère la page d'administration
** Date : mars 2006
*/
function page_admin($action,$section,$item,$affichage)
{
	$lien = $GLOBALS['lien'];
	$phrase = $GLOBALS['phrase'];
	$tab_content = $GLOBALS['$tab_content'];
	
	// -----------------------------------------------------------------------
	// -----------------  En-tête de page
	// -----------------------------------------------------------------------
	$lien_css = array(	"css/admin.css" => "all" );
	$meta_title = $phrase['TitleAdministration'].' '.URL;
	$head = ecrire_balise_head($meta_title,$lien_css);


	// -----------------------------------------------------------------------
	// -----------------  Contenu
	// -----------------------------------------------------------------------
	$body = '<body>';
	
	// navigation principale
	$body .= ecrire_navigation_principale();	
	
	// navigation secondaire
	$body .= ecrire_navigation_secondaire($section);	
	
	// corps de la page
	$lien_arrondis = $lien['Images'];
	$body .= '<div id="corps_page">';
	$body .= '<p class="image_arrondi"><img src="'.$lien_arrondis.'arrondis-top.png" alt="" /></p>';
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
				
		// On génère un tableau
		$rs = mysql_query($tab_content[$section]['query_list']);
		$valeurs = creer_tableau_liste($rs);
		
		// On affiche les données dans un tableau
		$lien = $lien['Admin'];
		$body .= ecrire_liste_enregistrements($valeurs,$section,$lien);
	}

	// -----------------------------------------------------------------------
	// Si l'action demandée est une insertion ou une modification
	else if ($action == 'add' OR $action == 'upd')
	{
		if ($section == "message")
		{
			$body .= lire_message($item);
		}
		
		if ($section == "commentaire")
		{
			if (isset($_POST['controle']) AND $_POST['controle'] == "updcomment")
			{
				$values = $_POST;
				if (ajouter_donnees_commentaire($values,"update") == TRUE)
				{
					mettre_a_jour_nbre_commentaire($values['ID']);
					$body .= ecrire_erreur($phrase['CommentaireMisAJour']);
				}
			}
			else
			{
				$requete = requete_un_commentaire($item);
				$rs = mysql_query($requete);
				$values = mysql_fetch_array($rs);
			}
			$body .= ecrire_form_upd_commentaire($values);
		}
		
		if ($section == "arret" OR $section == "billet" OR $section == "note")
		{
			if (isset($_POST['controle']) AND $_POST['controle'] == "texte")
			{
				$values = $_POST;
				if (controle_valeurs_texte($values) == TRUE)
				{
					if (ajouter_donnees_texte_base($action,$item,$values) == TRUE)
					{
						$body .= ecrire_erreur($phrase['DonneesEnregistrees']);
					}	
					else
					{
						$body .= ecrire_erreur($phrase['ProblemeTechnique']);
					}
				}
				else
				{
					$body .= ecrire_erreur(controle_valeurs_texte($values));
				}
				$values = preparer_affichage($_POST);
			}
			else if ($action == 'upd' AND $item > 0)
			{
				$requete = requete_billet($item);
				$rs = requete_table($requete);
				$values = mysql_fetch_assoc($rs);
				$values = preparer_affichage($values);
				$values['DatePublic'] = retourner_date($values['DatePublic']);
			}
			else 
			{
				$values = array();
				$values['Affichage'] = "no";
				$values['Nature'] = $section;
				$values['DatePublic'] = date("d-m-Y");
			}
			$body .= ecrire_form_texte($section,$values);
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
		$body .= '<div><p class="txtintro">'.lire_fichier("admin.txt").'</p></div>';
		$body .= '<p>&nbsp;</p>';
	}
	// connexion_end();
	

	$body .= '<p class="image_arrondi"><img src="'.$lien_arrondis.'arrondis-bottom.png" alt="" /></p>';
	$body .= '</div>';
	
	$body .= '<div id="spacer_page">&nbsp;</div>';
	$body .= '</body>';
	
	
	
	// -----------------------------------------------------------------------
	// ----------------   Compiler la page
	// -----------------------------------------------------------------------
	return ecrire_doctype_html($head,$body);
}
?>