<?php
function retourner_date($date)
{
	$new = explode("-",$date);
	$new_date = $new['2'].'-'.$new['1'].'-'.$new['0'];
	return $new_date;
}

function affichage_donnee($chaine)
{
	$chaine = trim($chaine);
	$chaine = stripslashes($chaine);
	$chaine = str_replace("\\","",$chaine);
	return $chaine;
}

function nettoyer_chaine($chaine)
{
	$chaine = trim($chaine);
	$chaine = stripslashes($chaine);
	$chaine = addslashes($chaine);
	$chaine = nl2br($chaine);
	return $chaine;
}



function transformer_chaine_url($chaine)
{
	$chaine = retirer_accent($chaine);
	$chaine = retirer_signes($chaine);
	$liste_signes = array(" ","--","---","----","-----","------");
	$chaine = str_replace($liste_signes,"-",$chaine);
	$chaine = strtolower($chaine);
	return $chaine;
}



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
	$Caracs = array("&","~","#","'","{","(","[","|","\\",")","]","=","+","}","$","%",",","*","!",":",";","?","\"","/","'");
	$chaine  = str_replace($Caracs,"-",$chaine);
	return $chaine;
}

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

function obtenir_title_produit($item,$langue)
{
	$requete = rq_fiche_produit($item,$langue);
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	$result = mysql_query($requete) or die();
	connexion_end();

	$row = mysql_fetch_array($result);
	return affichage_donnee($row['MotsCles']);
}

function obtenir_title_theme($langue,$parametres)
{
	$requete = rq_nom_themes_catalogue($langue,$parametres);
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	$result = mysql_query($requete) or die();
	connexion_end();

	$row = mysql_fetch_array($result);
	return affichage_donnee($row['Titre']);
}
?>