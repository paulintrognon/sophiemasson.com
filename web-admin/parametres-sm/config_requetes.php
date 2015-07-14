<?php
// --------------------------------------------------------------
// DEBUT  SOCLE   COMMUN 
// -------------------------------------------------------------- 
function rq_existence_membre($login,$password)
{
	$query = "SELECT ID, Niveau, Langue ";
	$query .= "FROM wa_administrateurs ";
	$query .= "WHERE Email = ".quote_smart($login)." AND MD5=".quote_smart(md5($password))." AND Compte = 'actif' ";
	return $query;
}


function rq_insert_suivilog($id_user,$langue,$niveau,$adressIP)
{
	$query = "INSERT INTO wa_suivilog SET ID='', ";
	$query .= "User = ".$id_user.", ";
	$query .= "Langue = '".$langue."', ";
	$query .= "Niveau = ".$niveau.", ";
	$query .= "AdresseIP = '".$adresseIP."', ";
	$query .= "DateRecord = '".date("Y-m-d")."' ";
	return $query;
}

// --------------------------------------------------------------
// FIN  SOCLE   COMMUN 
// -------------------------------------------------------------- 



function rq_liste_themes_menu()
{
	$query = "SELECT ID AS ID, TitreFr AS Value ";
	$query .= "FROM themes ";
	$query .= "ORDER BY TitreFr ";
	return $query;
}



// ---------------------------  News
function rq_delete_news($item)
{
	$query = "SELECT ID AS id, DATE_FORMAT(DateDebut, '%d/%m/%Y') AS Champ1, Titre AS Champ2, Affichage AS Champ3 ";
	$query .= "FROM news ";
	$query .= "WHERE ID=".$item;
	return $query;
}

function rq_liste_news($values)
{
	$query = "SELECT ID AS id, DATE_FORMAT(DateDebut, '%d/%m/%Y') AS Champ1, Titre AS Champ2, Affichage AS Champ3 ";
	$query .= "FROM news ";
	if (isset($values['mot_search']) AND !empty($values['mot_search']) )
	{
		$query .= "WHERE Titre LIKE '%".$values['mot_search']."%' OR Texte LIKE '%".$values['mot_search']."%' ";
	}
	$query .= "ORDER BY DateDebut DESC";
	return $query;
}

function rq_db_news($item)
{
	$query = "SELECT ID, DateDebut, DateFin, Titre, Texte, Affichage, Langue ";
	$query .= "FROM news ";
	$query .= "WHERE ID=".(int)$item;
	return $query;
}

function rq_insert_news($action,$valeurs)
{
	if ($action == 'add' OR $action == 'copy')
	{
		$query = "INSERT INTO news SET ID='', ";
	}
	else
	{
		$query = "UPDATE news SET ";
	}
	$query .= "DateDebut = ".quote_smart(retourner_date($valeurs['DateDebut'])).", ";
	$query .= "DateFin = ".quote_smart(retourner_date($valeurs['DateFin'])).", ";
	$query .= "Titre = ".quote_smart(nettoyer_chaine($valeurs['Titre'])).", ";
	$query .= "Langue = ".quote_smart(nettoyer_chaine($valeurs['Langue'])).", ";
	$query .= "Texte = ".quote_smart(nettoyer_chaine($valeurs['Texte'])).", ";
	$query .= "Affichage = ".quote_smart(verif_yes($valeurs['Affichage']))." ";
	if ($action == 'upd')
	{
		$query .= " WHERE ID=".(int)$valeurs['ID'];
	}
	return $query;
}


// ---------------------------  Themes
function rq_delete_themes($item)
{
	$query = "SELECT ID AS id, TitreFr AS Champ1, TitreEn AS Champ2, Affichage AS Champ3 ";
	$query .= "FROM themes ";
	$query .= "WHERE ID=".$item;
	return $query;
}

function rq_liste_themes($values)
{
	$query = "SELECT ID AS id, CONCAT(TitreFr,'<br /><em>',TitreEn,'</em>') AS Champ1, Classement AS Champ2, Affichage AS Champ3 ";
	$query .= "FROM themes ";
	if (isset($values['mot_search']) AND !empty($values['mot_search']) )
	{
		$query .= "WHERE TitreFr LIKE '%".$values['mot_search']."%' OR TitreEn LIKE '%".$values['mot_search']."%' ";
	}
	return $query;
}

function rq_db_themes($item)
{
	$query = "SELECT ID, TitreFr, TitreEn, Classement, Affichage, Image, HomePage ";
	$query .= "FROM themes ";
	$query .= "WHERE ID=".(int)$item;
	return $query;
}

function rq_insert_themes($action,$valeurs)
{
	if ($action == 'add' OR $action == 'copy')
	{
		$query = "INSERT INTO themes SET ID='', ";
	}
	else
	{
		$query = "UPDATE themes SET ";
	}
	$query .= "TitreFr = ".quote_smart(nettoyer_chaine($valeurs['TitreFr'])).", ";
	$query .= "TitreEn = ".quote_smart(nettoyer_chaine($valeurs['TitreEn'])).", ";
	$query .= "Classement = ".quote_smart(nettoyer_chaine($valeurs['Classement'])).", ";
	$query .= "Image = ".quote_smart(nettoyer_chaine($valeurs['Image'])).", ";
	$query .= "HomePage = ".quote_smart(verif_yes($valeurs['HomePage'])).", ";
	$query .= "Affichage = ".quote_smart(verif_yes($valeurs['Affichage']))." ";
	if ($action == 'upd')
	{
		$query .= " WHERE ID=".(int)$valeurs['ID'];
	}
	return $query;
}



// ---------------------------  Presse
function rq_delete_presse($item)
{
	$query = "SELECT ID AS id, Couverture AS Champ1, Revue AS Champ2, Affichage AS Champ3 ";
	$query .= "FROM presse ";
	$query .= "WHERE ID=".$item;
	return $query;
}

function rq_liste_presse($values)
{
	$query = "SELECT ID AS id, Couverture AS Champ1, Revue AS Champ2, Affichage AS Champ3 ";
	$query .= "FROM presse ";
	if (isset($values['mot_search']) AND !empty($values['mot_search']) )
	{
		$query .= "WHERE Revue LIKE '%".$values['mot_search']."%' ";
	}
	$query .= "ORDER BY DatePublication DESC";
	return $query;
}

function rq_db_presse($item)
{
	$query = "SELECT ID, DatePublication, Revue, Couverture, Page1, Page2, Page3, Page4, Affichage ";
	$query .= "FROM presse ";
	$query .= "WHERE ID=".(int)$item;
	return $query;
}

function rq_insert_presse($action,$valeurs)
{
	if ($action == 'add' OR $action == 'copy')
	{
		$query = "INSERT INTO presse SET ID='', ";
	}
	else
	{
		$query = "UPDATE presse SET ";
	}
	$query .= "DatePublication = ".quote_smart($valeurs['DateDebut']).", ";
	$query .= "Revue = ".quote_smart(nettoyer_chaine($valeurs['Revue'])).", ";
	$query .= "Couverture = ".quote_smart(nettoyer_chaine($valeurs['Couverture'])).", ";
	$query .= "Page1 = ".quote_smart(nettoyer_chaine($valeurs['Page1'])).", ";
	$query .= "Page2 = ".quote_smart(nettoyer_chaine($valeurs['Page2'])).", ";
	$query .= "Page3 = ".quote_smart(nettoyer_chaine($valeurs['Page3'])).", ";
	$query .= "Page4 = ".quote_smart(nettoyer_chaine($valeurs['Page4'])).", ";
	$query .= "Affichage = ".quote_smart(verif_yes($valeurs['Affichage']))." ";
	if ($action == 'upd')
	{
		$query .= " WHERE ID=".(int)$valeurs['ID'];
	}
	return $query;
}



// ---------------------------  Produits
function rq_delete_produit($item)
{
	$query = "SELECT ID AS id, Photo AS Champ1, CONCAT(NomFr,'<br /><em>',NomEn,'</em>') AS Champ2, Affichage AS Champ3 ";
	$query .= "FROM produits ";
	$query .= "WHERE ID=".$item;
	return $query;
}

function rq_liste_produit($values)
{
	$query = "SELECT ID AS id, Photo AS Champ1, CONCAT(NomFr,'<br /><em>',NomEn,'</em>') AS Champ2, Affichage AS Champ3 ";
	$query .= "FROM produits ";
	if (isset($values['mot_search']) AND !empty($values['mot_search']) )
	{
		$query .= "WHERE NomFr LIKE '%".$values['mot_search']."%' OR NomEn LIKE '%".$values['mot_search']."%' OR DescriptionFr LIKE '%".$values['mot_search']."%' OR DescriptionEn LIKE '%".$values['mot_search']."%' ";
	}
	$query .= "ORDER BY ID DESC";
	return $query;
}

function rq_db_produit($item)
{
	$query = "SELECT ID, NomFr, NomEn, DescriptionFr, DescriptionEn, Photo, Prix, Classement, MotsClesFr, MotsClesEn, Theme, Affichage ";
	$query .= "FROM produits ";
	$query .= "WHERE ID=".(int)$item;
	return $query;
}

function rq_insert_produit($action,$valeurs)
{
	if ($action == 'add' OR $action == 'copy')
	{
		$query = "INSERT INTO produits SET ID='', ";
	}
	else
	{
		$query = "UPDATE produits SET ";
	}
	$query .= "NomFr = ".quote_smart(nettoyer_chaine($valeurs['NomFr'])).", ";
	$query .= "NomEn = ".quote_smart(nettoyer_chaine($valeurs['NomEn'])).", ";
	$query .= "DescriptionFr = ".quote_smart(nettoyer_chaine($valeurs['DescriptionFr'])).", ";
	$query .= "DescriptionEn = ".quote_smart(nettoyer_chaine($valeurs['DescriptionEn'])).", ";
	$query .= "MotsClesFr = ".quote_smart(nettoyer_chaine($valeurs['MotsClesFr'])).", ";
	$query .= "MotsClesEn = ".quote_smart(nettoyer_chaine($valeurs['MotsClesEn'])).", ";
	$query .= "Photo = ".quote_smart(nettoyer_chaine($valeurs['Photo'])).", ";
	$query .= "Prix = ".quote_smart(nettoyer_chaine($valeurs['Prix'])).", ";
	$query .= "Classement = ".(int)$valeurs['Classement'].", ";
	$query .= "Theme = ".quote_smart(nettoyer_chaine($valeurs['Theme'])).", ";
	$query .= "Affichage = ".quote_smart(verif_yes($valeurs['Affichage']))." ";
	if ($action == 'upd')
	{
		$query .= " WHERE ID=".(int)$valeurs['ID'];
	}
	return $query;
}


// ---------------------------  Messages
function rq_delete_message($item)
{
	$query = "SELECT ID AS id, Nom AS Champ1, DateEnvoi AS Champ2, Email AS Champ3 ";
	$query .= "FROM courrier ";
	$query .= "WHERE ID=".$item;
	return $query;
}

function rq_liste_message($values)
{
	$query = "SELECT ID AS id, CONCAT('<strong>',Nom,'</strong><br />',DateEnvoi) AS Champ1, Message AS Champ2, Email AS Champ3 ";
	$query .= "FROM courrier ";
	if (isset($values['mot_search']) AND !empty($values['mot_search']) )
	{
		$query .= "WHERE Nom LIKE '%".$values['mot_search']."%' OR Email LIKE '%".$values['mot_search']."%' OR Message LIKE '%".$values['mot_search']."%' OR Ville LIKE '%".$values['mot_search']."%' ";
	}
	$query .= "ORDER BY DateEnvoi DESC";
	return $query;
}

function rq_db_message($item)
{
	$query = "SELECT ID, Nom, Adresse, CP, Ville, Tel, Email, Message, DateEnvoi, ";
	$query .= "FROM courrier ";
	$query .= "WHERE ID=".(int)$item;
	return $query;
}

function rq_insert_message($action,$valeurs)
{
	if ($action == 'add' OR $action == 'copy')
	{
		$query = "INSERT INTO courrier SET ID='', ";
	}
	else
	{
		$query = "UPDATE courrier SET ";
	}
	$query .= "Nom = ".quote_smart(nettoyer_chaine($valeurs['Nom'])).", ";
	$query .= "Adresse = ".quote_smart(nettoyer_chaine($valeurs['Adresse'])).", ";
	$query .= "CP = ".quote_smart(nettoyer_chaine($valeurs['CP'])).", ";
	$query .= "Ville = ".quote_smart(nettoyer_chaine($valeurs['Ville'])).", ";
	$query .= "Tel = ".quote_smart(nettoyer_chaine($valeurs['Tel'])).", ";
	$query .= "Email = ".quote_smart(nettoyer_chaine($valeurs['Email'])).", ";
	$query .= "Message = ".quote_smart(nettoyer_chaine($valeurs['Message'])).", ";
	$query .= "DateEnvoi = ".quote_smart(nettoyer_chaine(retourner_date($valeurs['DateEnvoi'])))." ";
	if ($action == 'upd')
	{
		$query .= " WHERE ID=".(int)$valeurs['ID'];
	}
	return $query;
}


// ---------------------------  Paiements
function rq_delete_paiements($item)
{
	$query = "SELECT ID AS id, CONCAT(Nom,' ',Prenom) AS Champ1, CONCAT(Objet,'<br />',Montant) AS Champ2, ID AS Champ3 ";
	$query .= "FROM paiements ";
	$query .= "WHERE ID=".$item;
	return $query;
}

function rq_liste_paiements($values)
{
	$query = "SELECT ID AS id, CONCAT(Nom,' ',Prenom,'<br /><a href=\"http://www.sophiemasson.com/porcelaine/paiement_paypal/',ID,'/',DatePaiement,'\">Lien pour payer via Paypal</a><br /><a href=\"http://www.sophiemasson.com/porcelain/paiement_paypal/',ID,'/',DatePaiement,'\">Link to pay with Paypal</a>') AS Champ1, CONCAT(Objet,'<br />',Montant) AS Champ2, ID AS Champ3 ";
	$query .= "FROM paiements ";
	if (isset($values['mot_search']) AND !empty($values['mot_search']) )
	{
		$query .= "WHERE Nom LIKE '%".$values['mot_search']."%' OR Prenom LIKE '%".$values['mot_search']."%' ";
	}
	return $query;
}

function rq_db_paiements($item)
{
	$query = "SELECT * ";
	$query .= "FROM paiements ";
	$query .= "WHERE ID=".(int)$item;
	return $query;
}

function rq_insert_paiements($action,$valeurs)
{
	if ($action == 'add' OR $action == 'copy')
	{
		$query = "INSERT INTO paiements SET ID='', ";
	}
	else
	{
		$query = "UPDATE paiements SET ";
	}
	$query .= "Nom = ".quote_smart(nettoyer_chaine($valeurs['Nom'])).", ";
	$query .= "Prenom = ".quote_smart(nettoyer_chaine($valeurs['Prenom'])).", ";
	$query .= "Adresse = ".quote_smart(nettoyer_chaine($valeurs['Adresse'])).", ";
	$query .= "CP = ".quote_smart(nettoyer_chaine($valeurs['CP'])).", ";
	$query .= "Ville = ".quote_smart(nettoyer_chaine($valeurs['Ville'])).", ";
	$query .= "Email = ".quote_smart(nettoyer_chaine($valeurs['Email'])).", ";
	$query .= "Objet = ".quote_smart(nettoyer_chaine($valeurs['Objet'])).", ";
	$query .= "Montant = ".quote_smart(nettoyer_chaine($valeurs['Montant'])).", ";
	$query .= "DatePaiement = ".quote_smart(retourner_date($valeurs['DatePaiement']))." ";
	if ($action == 'upd')
	{
		$query .= " WHERE ID=".(int)$valeurs['ID'];
	}
	return $query;
}


?>