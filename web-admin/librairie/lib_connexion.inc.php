<?php
/*  
		############################################################################
		Outil d'administration de site internet 
		Author : Arnaud Meunier
		Version : 1.5
		Date : janvier 2007 
		############################################################################
*/



// ------------------------------------------------------------------------------------------------
// Function : Connexion serveur
function connexion_base($serveur,$compte,$password,$data_base)
{
	$connexion_server = mysql_connect($serveur,$compte,$password);
	if (mysql_connect($serveur,$compte,$password) == FALSE)
	{
		return "Probleme de connexion";
	}
	else
	{
		$db = mysql_select_db ($data_base,$connexion_server);
	}
}



// ------------------------------------------------------------------------------------------------
// Function : Fin de la connexion
function connexion_end()
{
	mysql_close();
}


// ------------------------------------------------------------------------------------------------
// Créer un tableau à partir d'une liste
function creer_tableau_liste($rs)
{
	$i = 0;
	$tableau = array();
	while ($row = mysql_fetch_array($rs))
	{
		$tableau[$i] = array(	"id" => $row['id'],
													"Champ1" => $row['Champ1'],
													"Champ2" => $row['Champ2'],
													"Champ3" => $row['Champ3'] 
												);
		$i ++;
	}
	return $tableau;
}

?>
