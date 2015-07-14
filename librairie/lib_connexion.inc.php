<?php
// ********************************************************************************************
// ***************         Biblioth�que pour les connexions             ***********************
// ********************************************************************************************

/*
** Function : Connexion serveur
** Input : Nom du serveur, user, password, base de donn�es
** Output : connecte le site � la base de donn�es
** Description : Connecte le site au serveur Mysql et � la base de donn�es
** Creator : Arnaud Meunier
** Date : f�vrier 2006
*/
function connexion_base($serveur,$compte,$password,$data_base)
{
	$connexion_server = mysql_connect($serveur,$compte,$password);
	if ($connexion_server == FALSE)
	{
		return "Probleme de connexion";
	}
	else
	{
		$db = mysql_select_db ($data_base,$connexion_server);
	}
}


/*
** Function : Execute une requ�te
** Input : Requ�te
** Output : Retourne une valeur de requ�te
** Description : Ex�cute la requ�te
** Creator : Arnaud Meunier
** Date : f�vrier 2006
*/
function requete_table($requete)
{
	if (mysql_query($requete) == FALSE)
	{
		return FALSE;
	}
	else
	{
		return mysql_query($requete);
	}
}


/*
** Function : Un tableau fetch_array de valeurs
** Input : $rs = r�sultat de la requ�te
** Output : un tableau
** Description : On cr�� un tableau de valeurs de la requ�te
** Creator : Arnaud Meunier
** Date : f�vrier 2006
*/
function fetch_requete($rs)
{
	if (mysql_num_rows($rs) > 0)
	{
		return $row = mysql_fetch_array($rs);
	}
	else
	{
		return FALSE;
	}
}


/*
** Function : Un tableau avec toutes les valeurs
** Input : $rs = r�sultat de la requ�te
** Output : un tableau
** Description : On cr�� un tableau avec toutes les valeurs de la requ�te
** Creator : Arnaud Meunier
** Date : f�vrier 2006
*/
function creer_tableau_requete($rs,$tab_intitule)
{
	$i = 0;
	$tableau = array();
	while ($row = mysql_fetch_array($rs))
	{
		$tableau[$i] = $row;
		$i ++;
	}
	return $tableau;
}


/*
** Function : Un tableau avec la liste
** Input : $rs = r�sultat de la requ�te
** Output : un tableau
** Description : On cr�� un tableau avec toutes les valeurs de la requ�te
** Creator : Arnaud Meunier
** Date : mars 2006
*/
function creer_tableau_liste($rs)
{
	$i = 0;
	$tableau = array();
	while ($row = mysql_fetch_array($rs))
	{
		$tableau[$i] = array(	"id" => $row['id'],
								"titre" => $row['titre'],
								"option" => $row['option1'],
								"affichage" => $row['affichage'] );
		$i ++;
	}
	return $tableau;
}


/*
** Function : Fin de la connexion
** Input : vide
** Output : d�connecte le site
** Description : D�connecte le site au serveur Mysql et � la base de donn�es
** Creator : Arnaud Meunier
** Date : f�vrier 2006
*/
function connexion_end()
{
	mysql_close();
}
?>