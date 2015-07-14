<?php
/*  
		############################################################################
		Outil d'administration de site internet 
		Author : Arnaud Meunier
		Version : 1.5
		Date : janvier 2007 
		############################################################################
*/


function definir_nature_donnee_affichage($donnee,$lien_image,$lien_doc)
{
	if (	substr($donnee,-3) == "jpg"
				OR substr($donnee,-3) == "JPG"
				OR substr($donnee,-3) == "gif"
				OR substr($donnee,-3) == "png" )
	{
		if (file_exists('upload/photos/vign-'.$donnee))
		{
			$html = '<img src="'.$lien_image.'vign-'.$donnee.'" alt="" />';
		}
		else
		{
			$html = '<img src="'.$lien_image.$donnee.'" alt="" width="'.MIN_SIZE.'" />';
		}
	}
	else if ( substr($donnee,-3) == "pdf"
						OR substr($donnee,-3) == "xls" )
	{
		$html = '<a href="'.$lien_doc.$donnee.'" target="_blank">';
		$html .= '<img src="'.URL_IMAGES.'/pdf.png" alt="" /></a>';
	}
	else if ( substr($donnee,-3) == "mp3" )
	{
		$html = '<object type="application/x-shockwave-flash" data="'.URL.'plug-in/dewplayer.swf?son='.URL.'upload/sons/'.$donnee.'" width="200" height="20">';
		$html .= '<param name="movie" value="'.URL.'plug-in/dewplayer.swf?son='.URL.'upload/sons/'.$donnee.'" />';
		$html .= '</object>';
	}
	else
	{
		$html = $donnee;
	}

	return $html;
}



// ------------------------------------------------------------------------------------------------
// Function : Protéger une chaîne
function quote_smart($value)
{
	// Stripslashes
	if (get_magic_quotes_gpc()) 
	{
		$value = stripslashes($value);
	}
	// Protection si ce n'est pas un entier
	if (!is_numeric($value)) 
	{
		$value = "'".mysql_real_escape_string($value)."'";
	}
	return $value;
}


// ------------------------------------------------------------------------------------------------
// Function : Trouver le nom d'un mois
function renvoyer_nom_mois($numero_mois)
{
	$tab['NomMois'] = array(	"01" => "Janvier",
								"02" => "Février",
								"03" => "Mars",
								"04" => "Avril",
								"05" => "Mai",
								"06" => "Juin",
								"07" => "Juillet",
								"08" => "Août",
								"09" => "Septembre",
								"10" => "Octobre",
								"11" => "Novembre",
								"12" => "Décembre" );
	$nom_mois = $tab['NomMois'][$numero_mois];
	return $nom_mois;
}


// ------------------------------------------------------------------------------------------------
// Function : Trouver la liste des mois
function renvoyer_liste_mois($nbre_mois)
{
	// On écrit la requête avec ou non le nombre limit d'enregistrements
	$query = "SELECT COUNT(ID) AS Quantite, Mois, Annee ";
	$query .= "FROM sobillets ";
	$query .= "WHERE Affichage='yes' AND Nature='article' ";
	$query .= "GROUP BY Annee, Mois ";
	$query .= "ORDER BY Annee DESC, Mois DESC ";
	if ($nbre_mois > 0)
	{
		$query .= "LIMIT ".$nbre_mois;
	}
	echo $query;
	$rs = requete_table($query);
	// On génère un tableau avec les valeurs
	$liste_mois = array();
	while ($row = tableau_requete($rs))
	{
		$num_mois = $row['Mois'].'-'.$row['Annee'];
		$liste_mois[$num_mois] = renvoyer_nom_mois($row['Mois']).' '.$row['Annee'];
	}
	return $liste_mois;
}


// ------------------------------------------------------------------------------------------------
// Function : Affichage des données
function affichage_donnee($chaine)
{
	$chaine = trim($chaine);
	$chaine = stripslashes($chaine);
	$chaine = str_replace("\\","",$chaine);
	$chaine = str_replace("<br />","",$chaine);
	//$anc_code = array('<span underline>','</li><br />','</ul><br />');
	//$new_code = array('<span style="text-decoration:underline;">','</li>','</ul>');
	//$chaine = str_replace($anc_code,$new_code,$chaine);
	return $chaine;
}


// ------------------------------------------------------------------------------------------------
// Function : Préparer un tableau de chaines
function preparer_affichage($tab_chaine)
{
	foreach ($tab_chaine as $cle => $valeur)
	{
		if (!is_array($valeur))
		{
			$tab_chaine[$cle] = affichage_donnee($valeur);
			$tab_chaine[$cle] = str_replace("<br />","",$valeur);
		}
		else
		{
			$tab_chaine[$cle] = preparer_affichage($valeur);
		}
	}
	return $tab_chaine;
}


// ------------------------------------------------------------------------------------------------
// Function : Liste des années
function liste_numero_annee($debut,$fin)
{
	if ($debut == "" OR $debut == "0000" OR $debut == "0")
	{
		$debut = "1900";
	}
	if ($fin == "" OR $fin == "0000" OR $fin == "0")
	{
		$fin = date("Y");
	}
	$liste = array();
	for ($y = $debut; $y <= $fin; $y++)
	{
		$liste[$y] = $y;
	}
	return $liste;
}


// ------------------------------------------------------------------------------------------------
// Function : Donner jour - mois - année
function donner_numero_jour($date,$partie)
{
	if ($partie == "d")
	{
		$day = explode("-",$date);
		$day = $day[2];
		return $day;
	}
	else if ($partie == "m")
	{
		$day = explode("-",$date);
		$day = $day[1];
		return $day;
	}
	else
	{
		$day = explode("-",$date);
		$day = $day[0];
		return $day;
	}
}


// ------------------------------------------------------------------------------------------------
// Function : Retourner une date
function retourner_date($date)
{
	$new = explode("-",$date);
	$new_date = $new['2'].'-'.$new['1'].'-'.$new['0'];
	return $new_date;
}


// ------------------------------------------------------------------------------------------------
// Function : Recupérer année
function recuperer_annee($date)
{
	$val = date("Y");
	$new = explode("-",$date);
	$year = $new['2'];
	if (strlen($year) == 4)
	{
		$val = $year;
	}
	return $val;
}


// ------------------------------------------------------------------------------------------------
// Function : Changer affichage d'un enregistrement
function changer_affichage_item($item,$affichage,$section)
{
	$tab_content = $GLOBALS['tab_content'];
	$val = FALSE;
	
	if ($affichage == "yes")
	{
		$new_affichage = "no";
	}
	else
	{
		$new_affichage = "yes";
	}
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	$requete = "UPDATE ".$tab_content[$section]['nom_table']." SET ".$tab_content[$section]['champ_affichage']."='".$new_affichage."' WHERE ID=".$item;
	if (mysql_query($requete))
	{
		$val = TRUE;
	}
	connexion_end();
	return $val;
}


// ------------------------------------------------------------------------------------------------
// Function : Supprimer un enregistrement
function supprimer_enregistrement($section,$item)
{
	$tab_content = $GLOBALS['tab_content'];
	$val = FALSE;
	
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	$requete = "DELETE FROM ".$tab_content[$section]['nom_table']." WHERE ID=".$item;
	if (mysql_query($requete))
	{
		$val = TRUE;
	}
	connexion_end();
	return $val;
}


// ------------------------------------------------------------------------------------------------
// Function : Renvoyer le nom d'une table
function renvoyer_nom_table($section)
{
	switch ($section)
	{
		case "arret":
		$table = "pmbillets";
		break;
		case "billet":
		$table = "pmbillets";
		break;
		case "note":
		$table = "pmbillets";
		break;
		case "commentaire":
		$table = "pmcommentaires";
		break;
		case "message":
		$table = "pmmessages";
		break;
	}
	return $table;
}


// ------------------------------------------------------------------------------------------------
// Function : Nettoyer une chaîne
function nettoyer_chaine($chaine)
{
	$chaine = trim($chaine);
	$chaine = stripslashes($chaine);
	$chaine = addslashes($chaine);
	$chaine = nl2br($chaine);
	return $chaine;
}


// ------------------------------------------------------------------------------------------------
// Function : Transformer Titre en URL
function transformer_chaine_url($chaine)
{
	$chaine = strtolower($chaine);
	$chaine = retirer_signes($chaine);
	$chaine = retirer_accent($chaine);
	$liste_signes = array(" ","--","---","----","-----","------");
	$chaine = str_replace($liste_signes,"-",$chaine);
	return $chaine;
}


// ------------------------------------------------------------------------------------------------
// Function : Supprimer accents
function retirer_accent($chaine)
{
	$Caracs = array("¥" => "Y", "µ" => "u", "À" => "A", "Á" => "A",
					"Â" => "A", "Ã" => "A", "Ä" => "A", "Å" => "A",
					"Æ" => "A", "Ç" => "C", "È" => "E", "É" => "E",
					"Ê" => "E", "Ë" => "E", "Ì" => "I", "Í" => "I",
					"Î" => "I", "Ï" => "I", "Ð" => "D", "Ñ" => "N",
					"Ò" => "O", "Ó" => "O", "Ô" => "O", "Õ" => "O",
					"Ö" => "O", "Ø" => "O", "Ù" => "U", "Ú" => "U",
					"Û" => "U", "Ü" => "U", "Ý" => "Y", "ß" => "s",
					"à" => "a", "á" => "a", "â" => "a", "ã" => "a",
					"ä" => "a", "å" => "a", "æ" => "a", "ç" => "c",
					"è" => "e", "é" => "e", "ê" => "e", "ë" => "e",
					"ì" => "i", "í" => "i", "î" => "i", "ï" => "i",
					"ð" => "o", "ñ" => "n", "ò" => "o", "ó" => "o",
					"ô" => "o", "õ" => "o", "ö" => "o", "ø" => "o",
					"ù" => "u", "ú" => "u", "û" => "u", "ü" => "u",
					"ý" => "y", "ÿ" => "y");
	$chaine  = strtr("$chaine", $Caracs);
	return $chaine;
}



function retirer_signes($chaine)
{
	$Caracs = array(" au ","le ","la ","les ","un ","une "," du "," de "," des "," l'"," d'"," c'"," et "," ou "," a "," à "," pour "," par "," mais "," où "," donc ","&","~","#","'","{","(","[","|","\\",")","]","=","+","}","$","%",",","*","!",":",";","?","\"","/");
	$chaine  = str_replace($Caracs,"-",$chaine);
	return $chaine;
}



// ------------------------------------------------------------------------------------------------
// Function : Vérifier "Yes" ou "No"
function verifier_yes($chaine)
{
	$val = "yes";
	if (nettoyer_chaine($chaine) != "yes")
	{
		$val = "no";
	}
	return $val;
}


// ------------------------------------------------------------------------------------------------
// Function : Transformer une chaine en une suite de mots-clés
function affichage_keywords($chaine)
{
	$mots = explode(" ",$chaine);
	$keywords = KEYWORDS;
	for ($i=0; $i<count($mots); $i++)
	{
		$keywords .= ', '.$mots[$i];
	}
	return $keywords;
}


// ---------------------------------------------------------------
// Calculer le nombre de commentaires par article
function calculer_nbre_commentaire($id_billet)
{
	$requete = requete_nbre_commentaire($id_billet);
	echo $requete;
	$rs = mysql_query($requete);
	$nbre = mysql_num_rows($rs);
	return $nbre;
}


// ------------------------------------------------------------------------------------------------
// Mettre à jour le nombre de commentaires par billet
function mettre_a_jour_nbre_commentaire($id_billet)
{
	$val = FALSE;
	$nbre = calculer_nbre_commentaire($id_billet);
	$requete = requete_update_nbre_commentaire($id_billet,$nbre);
	if (mysql_query($requete))
	{
		$val = TRUE;
	}
	return $val;
}


// ------------------------------------------------------------------------------------------------
// Vérifier une adresse email
function verif_email($email)
{
	$val = FALSE;
	if (eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$",$email))
	{
		$val = TRUE;
	}
	return $val;
}

function verif_form_contact($texte)
{
	$texte = trim($texte);
	$texte = strip_tags($texte);
	return $texte;
}




// --------------- Vérifier qu'une chaine est égale à "yes"
function verif_yes($texte)
{
	$val = "no";
	if (!empty($texte))
	{
		$texte = trim($texte);
		if ($texte == "yes")
		{
			$val = "yes";
		}
	}
	return $val;
}

// --------------- Vérifier qu'une chaine est un lien http
function verif_url($url)
{
	$url = trim($url);
	if (!empty($url) AND substr($url,0,7) == "http://")
	{
		$val = $url;
	}
	else
	{
		$val = "http://".$url;
	}
	return $val;
}


function moisprochain($mois)
{
	switch($mois)
	{
		case "01":
		$newmois = "Février";
		break;
		case "02":
		$newmois = "Mars";
		break;
		case "03":
		$newmois = "Avril";
		break;
		case "04":
		$newmois = "Mai";
		break;
		case "05":
		$newmois = "Juin";
		break;
		case "06":
		$newmois = "Juillet";
		break;
		case "07":
		$newmois = "Septembre";
		break;
		case "08":
		$newmois = "Septembre";
		break;
		case "09": 
		$newmois = "Octobre";
		break;
		case "10":
		$newmois = "Novembre";
		break;
		case "11":
		$newmois = "Décembre";
		break;
		case "12":
		$newmois = "Janvier";
		break;
	}
	return $newmois;
}

// ---- le nom d'un mois
function nommois($mois)
{
	switch($mois)
	{
		case "01":
		$newmois = "Janvier";
		break;
		case "02":
		$newmois = "Février";
		break;
		case "03":
		$newmois = "Mars";
		break;
		case "04":
		$newmois = "Avril";
		break;
		case "05":
		$newmois = "Mai";
		break;
		case "06":
		$newmois = "Juin";
		break;
		case "07":
		$newmois = "Juillet";
		break;
		case "08":
		$newmois = "Août";
		break;
		case "09": 
		$newmois = "Septembre";
		break;
		case "10":
		$newmois = "Octobre";
		break;
		case "11":
		$newmois = "Novembre";
		break;
		case "12":
		$newmois = "Décembre";
		break;
	}
	return $newmois;
}


// ---------- Affichage
function affichage($chaine)
{
	$chaine = stripslashes($chaine);
	return $chaine;
}

// ---------- Affichage pour les formulaires
function affichagebis($chaine)
{
	$chaine = stripslashes($chaine);
	$chaine = str_replace("<br />","",$chaine);
	$chaine = str_replace("<br>","",$chaine);
	return $chaine;
}


function transformer_row_en_tableau($requete)
{
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	$result = mysql_query($requete) or die();
	connexion_end();
	$new_tab = array();
	$new_tab[] = "...";
	while ($row = mysql_fetch_array($result))
	{
		$new_tab[$row['ID']] = $row['Value'];
	}
	return $new_tab;
}



?>