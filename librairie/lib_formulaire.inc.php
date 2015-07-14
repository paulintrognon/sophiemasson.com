<?php
// ********************************************************************************************
// ***************         Bibliothèque pour écrire les formulaires     ***********************
// ********************************************************************************************

/*
$datas = array( "name" => "nom de la balise",
				"class" => "style css de la balise",
				"value" => "valeur de la balise",
				"default" => "valeur par défaut pour un select ou radio bouton",
				"tabindex" => "ordre de tabulation de la balise",
				"select" => "valeur à contrôler",
				"label" => "intitulé de la balise",
				"astuce" => "astuce du formulaire" );
*/


/*
** Function : La balise texte
** Input : nom, class, valeur, tabindex
** Output : donne une variable qui comprend le code html
** Description : ecrire la balise texte
** Creator : Arnaud Meunier
** Date : février 2006
*/
function balise_text($datas)
{
	$balise = '<input type="text" name="'.$datas['name'].'" id="'.$datas['name'].'" ';
	$balise .= 'class="'.$datas['class'].'" value="'.$datas['value'].'" size="5" tabindex="'.$datas['tabindex'].'" />';
	return $balise;
}


/*
** Function : La balise file
** Input : nom, class, valeur, tabindex
** Output : donne une variable qui comprend le code html
** Description : ecrire la balise texte
** Creator : Arnaud Meunier
** Date : février 2006
*/
function balise_file($datas)
{
	$balise = '<input type="file" name="'.$datas['name'].'" id="'.$datas['name'].'" ';
	$balise .= 'class="'.$datas['class'].'" value="'.$datas['value'].'" size="'.$datas['largeur'].'" tabindex="'.$datas['tabindex'].'" />';
	return $balise;
}


/*
** Function : La balise password
** Input : nom, class, valeur, tabindex
** Output : donne une variable qui comprend le code html
** Description : ecrire la balise texte
** Creator : Arnaud Meunier
** Date : février 2006
*/
function balise_password($datas)
{
	$balise = '<input type="password" name="'.$datas['name'].'" id="'.$datas['name'].'" ';
	$balise .= 'class="'.$datas['class'].'" value="'.$datas['value'].'" tabindex="'.$datas['tabindex'].'" />';
	return $balise;
}


/*
** Function : La balise textarea
** Input : nom, class, valeur, tabindex
** Output : donne une variable qui comprend le code html
** Description : ecrire la balise textarea
** Creator : Arnaud Meunier
** Date : mars 2006
*/
function balise_textarea($datas)
{
	$balise = '<textarea name="'.$datas['name'].'" id="'.$datas['name'].'" ';
	$balise .= 'class="'.$datas['class'].'" tabindex="'.$datas['tabindex'].'" rows="6">'.$datas['value'].'</textarea>';
	return $balise;
}


/*
** Function : La balise cachée
** Input : nom, valeur
** Output : donne une variable qui comprend le code html
** Description : ecrire la balise hidden
** Creator : Arnaud Meunier
** Date : février 2006
*/
function balise_hidden($datas)
{
	$balise = '<input type="hidden" name="'.$datas['name'].'" id="'.$datas['name'].'" value="'.$datas['value'].'" />';
	return $balise;
}


/*
** Function : La balise submit
** Input : nom, valeur, class, tabindex
** Output : donne une variable qui comprend le code html
** Description : ecrire la balise submit
** Creator : Arnaud Meunier
** Date : février 2006
*/
function balise_submit($datas)
{
	$balise = '<input type="submit" name="'.$datas['name'].'" id="'.$datas['name'].'" ';
	$balise .= 'value="'.$datas['value'].'" class="'.$datas['class'].'" tabindex="'.$datas['tabindex'].'" />';
	return $balise;
}


/*
** Function : La balise select
** Input : nom, valeur(tableau), class, tabindex
** Output : donne une variable qui comprend le code html
** Description : ecrire la balise select simple
** Creator : Arnaud Meunier
** Date : février 2006
*/
function balise_select($datas)
{
	$balise = '<select name="'.$datas['name'].'" id="'.$datas['name'].'" class="'.$datas['class'].'" tabindex="'.$datas['tabindex'].'">';
	foreach($datas['value'] as $indice => $element)
	{
		$balise .= '<option value="'.$indice.'" ';
		if ($indice == $datas['default'])
		{
			$balise .= ' selected="selected" ';
		}
		$balise .= '>'.$element.'</option>';
	}
	$balise .= '</select>';
	return $balise;
}


/*
** Function : La balise select avec optgroup
** Input : nom, valeur(tableau), class, tabindex
** Output : donne une variable qui comprend le code html
** Description : ecrire la balise select avec des sous groupes
** Creator : Arnaud Meunier
** Date : mars 2006
*/
function balise_select_optgroup($datas)
{
	$balise = '<select name="'.$datas['name'].'" id="'.$datas['name'].'" class="'.$datas['class'].'" tabindex="'.$datas['tabindex'].'">';
	$old_theme = "";
	$compteur = 0;
	for($i=0; $i<count($datas['value']); $i++)
	{
		$new_theme = $datas['value'][$i]['theme'];
		if ($old_theme != $new_theme)
		{
			if ($compteur > 0)
			{
				$balise .= '</optgroup>';
			}
			$balise .= '<optgroup label="'.$new_theme.'">';
		}
		$balise .= '<option value="'.$datas['value'][$i]['entite'].'">'.$datas['value'][$i]['nom'].'</option>';
		$compteur = 1;
		$old_theme = $new_theme;
	}
	$balise .= '</optgroup>';
	$balise .= '</select>';
	return $balise;
}


/*
** Function : Ecrire une balise
** Input : nature, intitule, nom, valeur, class, tabindex
** Output : donne une variable qui comprend le code html
** Description : ecrire une balise
** Creator : Arnaud Meunier
** Date : février 2006
*/
function ecrire_balise($nature,$datas)
{
	$balise = '';
	switch ($nature)
	{
		case "text":
		$balise .= '<div>';
		$balise .= '<span class="intitule"><label for="'.$datas['name'].'">'.$datas['label'].'</label></span>';
		$balise .= '<span class="balise">'.balise_text($datas).'</span>';
		if (isset($datas['astuce']) AND $datas['astuce'] != "")
		{
			$balise .= '<span class="astuce">'.$datas['astuce'].'</span>';
		}
		$balise .= '</div>';
		break;
		case "file":
		$balise .= '<div>';
		$balise .= '<span class="intitule"><label for="'.$datas['name'].'">'.$datas['label'].'</label></span>';
		$balise .= '<span class="balise">'.balise_file($datas).'</span>';
		if (isset($datas['astuce']) AND $datas['astuce'] != "")
		{
			$balise .= '<span class="astuce">'.$datas['astuce'].'</span>';
		}
		$balise .= '</div>';
		break;
		case "password":
		$balise .= '<div>';
		$balise .= '<span class="intitule"><label for="'.$datas['name'].'">'.$datas['label'].'</label></span>';
		$balise .= '<span class="balise">'.balise_password($datas).'</span>';
		if (isset($datas['astuce']) AND $datas['astuce'] != "")
		{
			$balise .= '<span class="astuce">'.$datas['astuce'].'</span>';
		}
		$balise .= '</div>';
		break;
		case "hidden":
		$balise .= balise_hidden($datas);
		break;
		case "submit":
		$balise .= '<div>';
		$balise .= '<span class="intitule">&nbsp;</span>';
		$balise .= '<span class="balise"><label for="'.$datas['name'].'">'.balise_submit($datas).'</label></span>';
		$balise .= '</div>';
		break;
		case "textarea":
		$balise .= '<div>';
		$balise .= '<span class="intitule"><label for="'.$datas['name'].'">'.$datas['label'].'</label></span>';
		$balise .= '<span class="balise">'.balise_textarea($datas).'</span>';
		if (isset($datas['astuce']) AND $datas['astuce'] != "")
		{
			$balise .= '<span class="astuce">'.$datas['astuce'].'</span>';
		}
		$balise .= '</div>';
		break;
		case "select":
		$balise .= '<div>';
		$balise .= '<span class="intitule"><label for="'.$datas['name'].'">'.$datas['label'].'</label></span>';
		$balise .= '<span class="balise">'.balise_select($datas).'</span>';
		if (isset($datas['astuce']) AND $datas['astuce'] != "")
		{
			$balise .= '<span class="astuce">'.$datas['astuce'].'</span>';
		}
		$balise .= '</div>';
		break;
		case "select_optgroup":
		$balise .= '<div>';
		$balise .= '<span class="intitule"><label for="'.$datas['name'].'">'.$datas['label'].'</label></span>';
		$balise .= '<span class="balise">'.balise_select_optgroup($datas).'</span>';
		if (isset($datas['astuce']) AND $datas['astuce'] != "")
		{
			$balise .= '<span class="astuce">'.$datas['astuce'].'</span>';
		}
		$balise .= '</div>';
		break;
	}
	return $balise;
}


/*
** Function : Controle identifiation
** Input : login, email
** Output : donne une variable qui comprend le code html
** Description : controle existence du compte utilisateur
** Creator : Arnaud Meunier
** Date : mars 2006
*/
function controle_identification($login,$password)
{
	if ($login != "" AND $password != "")
	{
		$rs = requete_table(requete_existence_membre($login,$password));
		if (mysql_num_rows($rs) > 0)
		{
			$row = mysql_fetch_array($rs);
			return $row['ID'];
		}
		else
		{
			return FALSE;
		}
	}
	else
	{
		return FALSE;
	}
}


/*
** Function : Ecrire une balise de date
** Input : le numéro du jour, le numéro du mois et l'année
** Output : donne une variable qui comprend le code html
** Description : ecrire le groupe de trois balises pour afficher une date
** Creator : Arnaud Meunier
** Date : février 2006
*/
function ecrire_balise_date($date_donnee,$datas)
{
	$tab = $GLOBALS['tab'];
	
	$date_decomposee = explode("-",$date_donnee);
	
	if ($date_decomposee[2] == "" OR $date_decomposee[2] == "00" OR $date_decomposee[2] == "0")
	{
		$jour = date("d");
	}
	if ($date_decomposee[1] == "" OR $date_decomposee[1] == "00" OR $date_decomposee[1] == "0")
	{
		$mois = date("m");
	}
	if ($date_decomposee[0] == "" OR $date_decomposee[0] == "0000" OR $date_decomposee[0] == "0")
	{
		$annee = date("Y");
	}
	$date = '<div>';
	$date .= '<span class="intitule"><label for="'.$datas['name'].'">'.$datas['label'].'</label></span>';
	$date .= '<span class="balise">';
	$dt_jour = array(	'name' => 'jour',
						'value' => $jour,
						'class' => $datas['class'] );
	$date .= balise_text($dt_jour);
	$dt_mois = array( 	'name' => 'mois',
						'value' => $tab['Mois'],
						'default' => $mois,
						'class' => $datas['class'] );
	$date .= balise_select($dt_mois);
	$liste_annee = liste_numero_annee("1990","");
	$dt_annee = array(	'name' => 'annee',
						'value' => $liste_annee,
						'default' => $annee,
						'class' => $datas['class'] );
	$date .= balise_select($dt_annee);
	$date .= '</span>';
	$balise .= '<span class="astuce">'.$datas['astuce'].'</span>';
	$date .= '</div>';
	return $date;
}


/*
** Function : Contrôler données texte
** Input : les valeurs
** Output : true ou le numéro d'erreur
** Description : contrôle les champs du formulaire
** Creator : Arnaud Meunier
** Date : mars 2006
*/
function controle_champs_form_texte($valeurs)
{
}


function insertion($chaine)
{
	$chaine = trim($chaine);
	$chaine = addslashes($chaine);
	return $chaine;
}


function verif_email($Mail)
{
  if (eregi("^[[:alpha:]]{1}[[:alnum:]]*((\.|_|-)[[:alnum:]]+)*@".
                  "[[:alpha:]]{1}[[:alnum:]]*((\.|-)[[:alnum:]]+)*".
                  "(\.[[:alpha:]]{2,})$",
                  $Mail))
	{
  		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function ajouter_donnees_texte_base($action,$item,$valeurs)
{
	$phrase = $GLOBALS['phrase'];
	
	$val = ecrire_erreur($phrase['DonneesPrb']);
	if ($action == "add")
	{
		$query = "INSERT INTO news SET ID='', ";
		
	}
	else
	{
		$query = "UPDATE news SET ";
	}
	$query .= "Titre='".$valeurs['Titre']."', Texte='".$valeurs['Texte']."', DateDebut='".$valeurs['DateDebut']."', DateFin='".$valeurs['DateFin']."', Affichage='".$valeurs['Affichage']."' ";
	if ($item > 0)
	{
		$query .= "WHERE ID=".(int)$item;
	}
	if (mysql_query($query))
	{
		$val = ecrire_erreur($phrase['DonneesOk']);
	}
	return $val;
}

function changer_affichage_item($item,$affichage,$section)
{
	if ($section == "news")
	{
		$table = "news";
	}
	else if ($section == "message")
	{
		$table = "courrier";
	}
	if ($affichage == "no")
	{
		$affich = "yes";
	}
	else
	{
		$affich = "no";
	}
	mysql_query(requete_update_affichage($table,$item,$affich));
}
?>
