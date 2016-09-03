<?php
// ****************************************************************************************************
// **********************        Les  requêtes MySQL  du  site         ************************************
// ****************************************************************************************************

function requete_last_news($limite,$langue)
{
	$query = "SELECT ID, Titre, Texte, DateDebut ";
	$query .= "FROM news ";
	$query .= "WHERE DateDebut <= '".date("Y-m-d")."' AND DateFin >= '".date("Y-m-d")."' AND Affichage='yes' AND Langue = '".$langue."' ";
	$query .= "ORDER BY DateDebut DESC ";
	if (!empty($limite))
	{
		$query .= "LIMIT ".$limite;
	}
	return $query;
}


function requete_news($id_item)
{
	$query = "SELECT Titre, Texte, DateDebut, DateFin, Affichage ";
	$query .= "FROM news ";
	$query .= "WHERE ID=".(int)$id_item;
	return $query;
}


function rq_insert_message($valeurs)
{
	$query = "INSERT INTO courrier SET ID='', ";
	$query .= "DateEnvoi='".date("Y-m-d")."', ";
	$query .= "Message='".insertion($_POST['Message'])."', ";
	$query .= "Nom='".insertion($_POST['Nom'])."', ";
	$query .= "Adresse='".insertion($_POST['Adresse'])."', ";
	$query .= "CP='".insertion($_POST['CP'])."', ";
	$query .= "Ville='".insertion($_POST['Ville'])."', ";
	$query .= "Tel='".insertion($_POST['Tel'])."', ";
	$query .= "Email='".insertion($_POST['Email'])."' ";
	return $query;
}


function rq_liste_presse()
{
	$query = "SELECT ID, Revue, Couverture, Page1 ";
	$query .= "FROM presse ";
	$query .= "WHERE Affichage='yes' ";
	$query .= "ORDER BY ID DESC";
	return $query;
}


function rq_retombee_presse($item)
{
	$query = "SELECT ID, Revue, DatePublication, Page1, Page2, Page3, Page4 ";
	$query .= "FROM presse ";
	$query .= "WHERE Affichage='yes' AND ID=".(int)$item." ";
	return $query;
}


function rq_liste_produits($langue,$parametres)
{
	$query = "SELECT ID, Nom".$langue." AS Nom, Photo ";
	$query .= "FROM produits ";
	$query .= "WHERE Affichage='yes' ";
	if (!empty($parametres))
	{
		$query .= "AND Theme = ".(int)$parametres." ";
	}
	$query .= "ORDER BY Theme, Classement ";
	return $query;
}

function rq_fiche_produit($item,$langue)
{
	$query = "SELECT ID, Nom".$langue." AS Nom, Description".$langue." AS Description, Prix, MotsCles".$langue." AS MotsCles, Photo ";
	$query .= "FROM produits ";
	$query .= "WHERE Affichage='yes' AND ID=".(int)$item." ";
	$query .= "ORDER BY Theme ";
	return $query;
}

function rq_fiche_produit_previous($item, $category, $langue) {
    $query = "SELECT ID, Nom".$langue." AS Nom ";
    $query .= "FROM produits ";
    $query .= "WHERE Affichage='yes' AND Theme = ".(int)$category." AND ID=(SELECT MAX(id) FROM produits WHERE Affichage='yes' AND ID < ".(int)$item." AND Theme = ".(int)$category." ) ";    
    return $query;
}

function rq_fiche_produit_next($item, $category, $langue) {
    $query = "SELECT ID, Nom".$langue." AS Nom ";
    $query .= "FROM produits ";
    $query .= "WHERE Affichage='yes' AND Theme = ".(int)$category." AND ID=(SELECT MIN(id) FROM produits WHERE Affichage='yes' AND ID > ".(int)$item." AND Theme = ".(int)$category." ) ";
    return $query;
}

function requete_themes_catalogues($langue)
{
	$query = "SELECT DISTINCT t.ID, t.Titre".$langue." AS Titre ";
	$query .= "FROM themes t, produits p ";
	$query .= "WHERE t.ID = p.Theme AND t.Affichage='yes' ";
	$query .= "ORDER BY t.Classement ";
	return $query;
}

function rq_themes_catalogue($langue)
{
	$query = "SELECT ID, Titre".$langue." AS Titre, Image ";
	$query .= "FROM themes ";
	$query .= "WHERE Affichage = 'yes' ";
	$query .= "ORDER BY Classement ";
	return $query;
}

function rq_nom_themes_catalogue($langue,$parametres)
{
	$query = "SELECT ID, Titre".$langue." AS Titre, Image ";
	$query .= "FROM themes ";
	$query .= "WHERE Affichage = 'yes' AND ID=".(int)$parametres." ";
	$query .= "ORDER BY Classement ";
	return $query;
}

function rq_themes_homepage($langue)
{
	$query = "SELECT ID, Titre".$langue." AS Titre, Image ";
	$query .= "FROM themes ";
	$query .= "WHERE HomePage = 'yes' ";
	$query .= "ORDER BY Classement ";
	$query .= "LIMIT 4 ";
	return $query;
}

function rq_details_paiement($parametres,$item)
{
	$query = "SELECT * ";
	$query .= "FROM paiements ";
	$query .= "WHERE ID = ".(int)$parametres." AND DatePaiement = '".$item."' ";
	return $query;
}
?>