<?php
function administration_site($section)
{
	$limit = "15";
	$requete = call_user_func($list_query[$section]['list'],$limit);
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	$result = mysql_query($requete);
	if (mysql_num_rows($result) > 0)
	{
		$ligne = '';
		while($row = mysql_fetch_array($result))
		{
			$ligne .= ecrire_ligne_tableau($row);
		}
		$page = ecrire_un_tableau("un test de tableau","liste",$ligne);
	}
	else
	{
		$page = ecrire_erreur("pas d'enregistrement");
	}
	connexion_end();
	echo $page;
}
?>