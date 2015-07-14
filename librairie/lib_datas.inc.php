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
	$Caracs = array("�" => "Y", "�" => "u", "�" => "A", "�" => "A",
					"�" => "A", "�" => "A", "�" => "A", "�" => "A",
					"�" => "A", "�" => "C", "�" => "E", "�" => "E",
					"�" => "E", "�" => "E", "�" => "I", "�" => "I",
					"�" => "I", "�" => "I", "�" => "D", "�" => "N",
					"�" => "O", "�" => "O", "�" => "O", "�" => "O",
					"�" => "O", "�" => "O", "�" => "U", "�" => "U",
					"�" => "U", "�" => "U", "�" => "Y", "�" => "s",
					"�" => "a", "�" => "a", "�" => "a", "�" => "a",
					"�" => "a", "�" => "a", "�" => "a", "�" => "c",
					"�" => "e", "�" => "e", "�" => "e", "�" => "e",
					"�" => "i", "�" => "i", "�" => "i", "�" => "i",
					"�" => "o", "�" => "n", "�" => "o", "�" => "o",
					"�" => "o", "�" => "o", "�" => "o", "�" => "o",
					"�" => "u", "�" => "u", "�" => "u", "�" => "u",
					"�" => "y", "�" => "y");
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