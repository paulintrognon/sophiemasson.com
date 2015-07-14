<?php
/*  
		############################################################################
		Outil d'administration de site internet 
		Author : Arnaud Meunier
		Version : 1.5
		Date : janvier 2007 
		############################################################################
*/


function templates_page_admin($action,$item,$section,$affichage)
{
	$tab_content = $GLOBALS['tab_content'];
	$phrase_gene = $GLOBALS['phrase_gene'];
	$mot_gene = $GLOBALS['mot_gene'];
	
	$body = '<body>';
	
	// On écrit le menu du haut et de côté
	$body .= ecrire_navigation_principale($_SESSION['NIVEAU_USER']);
	$body .= ecrire_navigation_secondaire($_SESSION['NIVEAU_USER']);
	
	// On écrit le titre de la page
	$body .= '<div id="corps_page">';
	$body .= '<p class="image_arrondi"><img src="'.URL_IMAGES.'arrondis-top-800.png" alt="" /></p>';
	$body .= ecrire_titre_page($action,$section);
	
	
	
	// Analyse de l'action demandée : liste, ajout, modification, copie, suppression ou autres
	switch($action)
	{
		
		
		// -----------------------   LISTE DES ENREGISTREMENTS   -------------------

		case "lst":
			// Si la variable $affichage est remplie, on doit donc changer l'affichage d'un enregistrement
			if ($affichage != "" AND $item > 0)
			{
				changer_affichage_item($item,$affichage,$section);
			}
			
			$body .= ecrire_formulaire_recherche($_POST);	
			// On lance la requête qui correspond à la section et on créé le tableau
			connexion_base(SERVEUR,HOST,PASSWORD,BASE);
			$requete = call_user_func($tab_content[$section]['query_list'],$_POST);	
			$result = mysql_query($requete) or die();
			connexion_end();
			$valeurs = creer_tableau_liste($result);
			$body .= ecrire_liste_enregistrements($valeurs,$section);
		break;
		
		
		// -----------------------   AJOUT D'UN ENREGISTREMENT   -------------------
		
		case "add":
			// Si le formulaire a été validé, on contrôle les données et on ajoute les données dans DB.
			if (count($_POST) > 0)
			{			
				$valeurs = $_POST;
				$controle_donnees_formulaire = call_user_func($tab_content[$section]['controle_donnees'],$_POST);
				if ($controle_donnees_formulaire == TRUE)
				{
					connexion_base(SERVEUR,HOST,PASSWORD,BASE);
					$requete = call_user_func($tab_content[$section]['insert_donnees'],$action,$_POST);
					if (!mysql_query($requete))
					{
						connexion_end();
						$body .= ecrire_erreur($phrase_gene['ProblemeTechnique']);
						$body .= call_user_func($tab_content[$section]['form_datas'],$section,$valeurs);
					}
					else
					{
						$valeurs['ID'] = mysql_insert_id();
						$body .= ecrire_succes($phrase_gene['DonneesEnregistrees']);
						if (!empty($tab_content[$section]['cache']))
						{
							$body .= call_user_func($tab_content[$section]['cache'],$section,$valeurs);
						}
					}
				}
				else
				{
					$body .= ecrire_erreur($phrase_gene['ProblemeTechnique']);
					$body .= call_user_func($tab_content[$section]['form_datas'],$section,$valeurs);
				}
			}
			else
			{
				$valeurs = array();
				$body .= call_user_func($tab_content[$section]['form_datas'],$section,$valeurs);
			}
		break;
		
		// -----------------------   COPIER UN ENREGISTREMENT   -------------------
		
		case "copy":
			// Si le formulaire a été validé, on contrôle les données et on ajoute les données dans DB.
			if (count($_POST) > 0)
			{	
				$valeurs = $_POST;
				$controle_donnees_formulaire = call_user_func($tab_content[$section]['controle_donnees'],$_POST);
				if ($controle_donnees_formulaire == TRUE)
				{
					connexion_base(SERVEUR,HOST,PASSWORD,BASE);
					$requete = call_user_func($tab_content[$section]['insert_donnees'],$action,$_POST);
					if (!mysql_query($requete))
					{
						connexion_end();
						$body .= ecrire_erreur($phrase_gene['ProblemeTechnique']);
						$body .= call_user_func($tab_content[$section]['form_datas'],$section,$valeurs);
					}
					else
					{
						$body .= ecrire_succes($phrase_gene['DonneesEnregistrees']);
						if (!empty($tab_content[$section]['cache']))
						{
							$body .= call_user_func($tab_content[$section]['cache'],$section,$valeurs);
						}
					}
				}
				else
				{
					$body .= ecrire_erreur($phrase_gene['ProblemeTechnique']);
					$body .= call_user_func($tab_content[$section]['form_datas'],$section,$valeurs);
				}
			}
			else
			{
				connexion_base(SERVEUR,HOST,PASSWORD,BASE);
				$requete = call_user_func($tab_content[$section]['update_donnees'],$item);
				$result = mysql_query($requete);
				connexion_end();
				$valeurs = mysql_fetch_array($result);
				$body .= call_user_func($tab_content[$section]['form_datas'],$section,$valeurs);
			}
		break;
		
		
		// -----------------------   MODIFICATION D'UN ENREGISTREMENT   -----------
		
		case "upd":
			// Si le formulaire a été validé et que les données sont correctes, on ajoute le tout dans BD
			if (count($_POST) > 0)
			{			
				$valeurs = $_POST;
				$controle_donnees_formulaire = call_user_func($tab_content[$section]['controle_donnees'],$_POST);
				if ($controle_donnees_formulaire == TRUE)
				{
					connexion_base(SERVEUR,HOST,PASSWORD,BASE);
					$requete = call_user_func($tab_content[$section]['insert_donnees'],$action,$_POST);
					if (!mysql_query($requete))
					{
						connexion_end();
						$body .= ecrire_erreur($phrase_gene['ProblemeTechnique']);
						$body .= call_user_func($tab_content[$section]['form_datas'],$section,$valeurs);	
					}
					else
					{
						$body .= ecrire_succes($phrase_gene['DonneesEnregistrees']);
						if (!empty($tab_content[$section]['cache']))
						{
							$body .= call_user_func($tab_content[$section]['cache'],$section,$valeurs);
						}
					}			
				}
				else
				{
					$body .= ecrire_erreur($phrase_gene['ProblemeTechnique']);
					$body .= call_user_func($tab_content[$section]['form_datas'],$section,$valeurs);	
				}
			}
			else
			{
				connexion_base(SERVEUR,HOST,PASSWORD,BASE);
				$requete = call_user_func($tab_content[$section]['update_donnees'],$item);
				//echo $requete;
				$result = mysql_query($requete);
				connexion_end();
				$valeurs = mysql_fetch_array($result);
				$body .= call_user_func($tab_content[$section]['form_datas'],$section,$valeurs);	
			}		
		break;
		
		
		// -----------------------   SUPPRESSION D'UN ENREGISTREMENT   -----------
		
		case "del":
			/* 
			Quand la suppression est demandée depuis la liste des enregistrements,
			on affiche un bouton de confimation, puis on supprime les données de la BD
			*/
			if (isset($_POST['controle']) AND $_POST['controle'] == "suppression")
			{
				if (supprimer_enregistrement($section,$item) == TRUE)
				{
					$body .= ecrire_succes($phrase_gene['VotreEnregistrementSupprime']);
				}
				else
				{
					$body .= ecrire_erreur($phrase_gene['ProblemeTechnique']);
				}
			}
			else
			{
				$body .= ecrire_validation_suppression($section,$item);
			}
		break;
		

		// -----------------------   FLUX  RSS   -----------------------------
		
		case "rss":
			/*
			On liste le répertoire rss pour donner tous les flux disponibles
			*/
			$liste_flux = lister_fichiers_repertoire('rss/');
			$body .= ecrire_liste_flux($liste_flux,URL.'rss/');
		break;


		
		// -----------------------   AUTRE DEMANDE   -----------------------------
		
		case "oth":
			/*
			On propose dans un premier une fonction de première étape. Si elle comprend un formulaire, 
			le champ "controle" doit avoir la valeur "divers" pour que la fonction de seconde étape soit prise en compte.
			*/
			if (isset($_POST['controle']) AND $_POST['controle'] == "divers")
			{
				
				$controle_donnees_formulaire = call_user_func($tab_content[$section]['controle_donnees'],$_POST);
				if ($controle_donnees_formulaire ==TRUE)
	      {
					$fct_niveau_02 = call_user_func($tab_content[$section]['fct_niveau_02'],$_POST);
	        $body .= $fct_niveau_02;
				}
			}
			else
			{
				$fct_niveau_01 = call_user_func($tab_content[$section]['fct_niveau_01'],$section,$values);
				$body .= $fct_niveau_01;
			}
		break;
		
		
		// -----------------------   PAR DEFAUT   ----------------------------------
		
		default:
			$body .= '<p>&nbsp;</p>';
			$body .= '<div><p class="txtintro">'.lire_fichier("bienvenue.txt.php",URL_PARAMETRES."/").'</p></div>';
			$body .= '<p>&nbsp;</p>';
			if (is_file('parametres-pp/articles/test.txt'))
			{
				$body .= "test";
			}
		break;
	}
	
	$body .= '<p class="image_arrondi"><img src="'.URL_IMAGES.'arrondis-bottom-800.png" alt="" /></p>';
	$body .= '</div>';
	
	$body .= '<div id="spacer_page">&nbsp;</div>';
	$body .= '</body>';
	
	$lien_css = array(	"css/structure.css" => "all", "css/login.css" => "all", "css/admin.css" => "all", "css/print.css" => "print" );
	$head = ecrire_balise_head(TITLE,$lien_css);
	
	return ecrire_doctype_html($head,$body);
}
?>