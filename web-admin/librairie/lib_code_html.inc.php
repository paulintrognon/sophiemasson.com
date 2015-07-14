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
// On place le code html entre les balises Doctype
function ecrire_doctype_html($head,$body)
{
	$doc_type = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	$doc_type .= '<html xmlns="http://www.w3.org/1999/xhtml">';
	$doc_type .= $head;
	$doc_type .= $body;
	$doc_type .= '</html>';
	return $doc_type;
}



// ------------------------------------------------------------------------------------------------
// ** Function : Message envoyé
function ecrire_message_envoye($phrase)
{
	$msg = '<p class="">'.$phrase.'</p>';
	return $msg;
}


// ------------------------------------------------------------------------------------------------
// On écrit la barre de navigation principale
function ecrire_navigation_principale($niveau_user)
{
	$tab_content = $GLOBALS['tab_content'];
	$mot_gene = $GLOBALS['mot_gene'];
	
	$nav .= '<div id="nav_principale">';
	$tableau_valeurs = array();
	foreach ($tab_content as $key => $value)
	{
		if ( !empty($tab_content[$key]['menu']) AND $tab_content[$key]['niveau_acces'] <= $niveau_user )
		{
      $tableau_valeurs[$tab_content[$key]['lien_menu']] = $tab_content[$key]['menu'];
    }
	}
	if ($niveau_user == "3")
	{
		$tableau_valeurs[URL_MYADMIN] = $mot_gene['Parametres'];
	}
	$nav .= ecrire_liste_simple_avec_liens($tableau_valeurs);
	$nav .= '</div>';
	return $nav;
}

// ------------------------------------------------------------------------------------------------
// Ecrire la barre de navigation principale
function ecrire_navigation_secondaire($niveau_user)
{
	$tab_content = $GLOBALS['tab_content'];
	$phrase_gene = $GLOBALS['phrase_gene'];
	
	$nav .= '<div id="nav_secondaire">';
	$tableau_valeurs = array();
	foreach ($tab_content as $key => $value)
	{
		if ( !empty($tab_content[$key]['menu_secondaire']) AND $tab_content[$key]['niveau_acces'] <= $niveau_user )
		{
      $tableau_valeurs[$tab_content[$key]['lien_menu_secondaire']] = $tab_content[$key]['menu_secondaire'];
    }
	}
	$tableau_valeurs[URL_ADMIN.'?sec=rss&amp;act=rss'] = $phrase_gene['VoirFluxRSS'];
	$nav .= ecrire_liste_simple_avec_liens($tableau_valeurs);
	$nav .= '</div>';
	return $nav;
}


// ------------------------------------------------------------------------------------------------
// Ecrire une liste avec des liens
function ecrire_liste_simple_avec_liens($tableau_valeurs)
{
	$max = 10;
	$i = 0;
	$list = '';
	
	if (count($tableau_valeurs) > 0)
	{
		foreach ($tableau_valeurs as $key => $val)
		{
			if ($i == 0 OR $i == $max)
			{
				if ($i == $max)
				{
					$list .= '</ul>';
				}
				$list .= '<ul>';
			}
			$list .= '<li><a href="'.$key.'" title="'.$val.'">'.$val.'</a></li>';
			$i++;
		}
		$list .= '</ul>';
	}
	return $list;
}


// ------------------------------------------------------------------------------------------------
// Ecrire une liste avec des liens
function ecrire_liste_flux($flux,$liens)
{
	$html = '<ul class="liste_flux_rss">';
	foreach ($flux as $key => $val)
	{
			$html .= '<li><a href="'.$liens.$val.'" title="'.$val.'">'.$val.'</a></li>';
	}
	$html .= '</ul>';
	return $html;
}


// ------------------------------------------------------------------------------------------------
// Ecrire le titre d'une page
function ecrire_titre_page($action,$section)
{
	$mot_gene = $GLOBALS['mot_gene'];
	$phrase_gene = $GLOBALS['phrase_gene'];
	$tab_content = $GLOBALS['tab_content'];
	
	$titre = '<div class="titre_page">';
	$titre .= '<div class="bt_imprimer">'.bouton_imprimer().'</div>';
	$titre .= '<h1>';
	if (empty($action))
	{
		$titre .= $mot_gene['Bienvenue'];
	}
	else if ($action == 'oth')
	{
		$titre .= $tab_content[$section]['titre_page_les'];
	}
	else
	{
		switch($action)
		{
			case "lst":
			$titre .= $mot_gene['Liste'].' '.$tab_content[$section]['titre_page_les'];
			break;
			case "add":
			$titre .= $mot_gene['Ajouter'].' '.$tab_content[$section]['titre_page_un'];
			break;
			case "upd":
			$titre .= $mot_gene['Modifier'].' '.$tab_content[$section]['titre_page_un'];
			break;
			case "copy":
			$titre .= $mot_gene['Copier'].' '.$tab_content[$section]['titre_page_un'];
			break;
			case "del":
			$titre .= $mot_gene['Supprimer'].' '.$tab_content[$section]['titre_page_un'];
			break;
			case "rss":
			$titre .= $mot_gene['Liste'].' '.$phrase_gene['DesFluxRSS'];
			break;
		}
	}
	$titre .= '</h1>';
	$titre .= '</div>';
	return $titre;
}


function bouton_imprimer()
{
	$mot_gene = $GLOBALS['mot_gene'];
	
	$html = '<a href="#" onclick="javascript:print();"><img src="'.URL_IMAGES.'imprimer.png" alt="'.$mot_gene['Imprimer'].'" /></a>';
	return $html;
}

// ------------------------------------------------------------------------------------------------
// Ecrire une liste d'enregistrements
function ecrire_liste_enregistrements($valeurs,$section)
{
	$tab_content = $GLOBALS['tab_content'];
	
	if (count($valeurs) > 0)
	{
		$html = '<table summary="" class="" border="0">';
		$html .= '<caption></caption>';
		
		$html .= '<tr>';
		$html .= '<th>&nbsp;</th>';
		$html .= '<th>&nbsp;</th>';
		if ( (isset($valeurs[0]['Champ3'])) AND ( $valeurs[0]['Champ3'] == "yes" OR $valeurs[0]['Champ3'] == "no") )
		{
			$html .= '<th style="largeur_colonne_bouton">&nbsp;</th>';
		}
		$html .= '<th style="largeur_colonne_bouton">&nbsp;</th>';
		$html .= '<th style="largeur_colonne_bouton">&nbsp;</th>';
		$html .= '</tr>';
		
		for ($i=0; $i<count($valeurs); $i++)
		{
			$style_color = ' style="background-color: #FFF;"';
			if ($i % 2 == 0)
			{
				$style_color = ' style="background-color: #EDEDED;"';
			}
			
			$html .= '<tr>';			
			$html .= '<td'.$style_color.'>'.definir_nature_donnee_affichage($valeurs[$i]['Champ1'],$tab_content[$section]['lien_media_img'],$tab_content[$section]['lien_media_doc']).'</td>';
			$html .= '<td'.$style_color.'>'.definir_nature_donnee_affichage($valeurs[$i]['Champ2'],$tab_content[$section]['lien_media_img'],$tab_content[$section]['lien_media_doc']).'</td>';
			if ( (isset($valeurs[$i]['Champ3'])) AND ( $valeurs[$i]['Champ3'] == "yes" OR $valeurs[$i]['Champ3'] == "no") )
			{
				$html .= '<td'.$style_color.'>'.ecrire_bouton_affichage($valeurs[$i]['id'],$section,$valeurs[$i]['Champ3']).'</td>';
			}
			$html .= '<td'.$style_color.'>'.ecrire_bouton_modifier($valeurs[$i]['id'],$section).'</td>';
			$html .= '<td'.$style_color.'>'.ecrire_bouton_copier($valeurs[$i]['id'],$section).'</td>';
			$html .= '<td'.$style_color.'>'.ecrire_bouton_supprimer($valeurs[$i]['id'],$section).'</td>';
			$html .= '</tr>';
		}
		$html .= '</table>';
	}
	else
	{
		$html = '<p>&nbsp;</p>';
	}
	return $html;
}


// ------------------------------------------------------------------------------------------------
// Ecrire bouton affichage
function ecrire_bouton_affichage($item,$section,$affichage)
{
	$lien = $GLOBALS['lien'];
	$mot_gene = $GLOBALS['mot_gene'];
	
	$bouton = '<a href="'.URL_ADMIN.'?act=lst&amp;sec='.$section.'&amp;id='.$item.'&amp;aff='.$affichage.'" title="">';
	if ($affichage == "yes")
	{
		$bouton .= '<img src="'.URL_IMAGES.'picto-ordi-on.png" alt="'.$mot_gene['Visible'].'" />';
	}
	else
	{
		$bouton .= '<img src="'.URL_IMAGES.'picto-ordi-off.png" alt="'.$mot_gene['Invisible'].'" />';
	}
	$bouton .= '</a>';
	return $bouton;
}


// ------------------------------------------------------------------------------------------------
// Ecrire bouton modifier
function ecrire_bouton_modifier($item,$section)
{
	$lien = $GLOBALS['lien'];
	$mot_gene = $GLOBALS['mot_gene'];
	
	$bouton = '<a href="'.URL_ADMIN.'?act=upd&amp;sec='.$section.'&amp;id='.$item.'" title="">';
	$bouton .= '<img src="'.URL_IMAGES.'picto-modifier.png" alt="'.$mot_gene['Modifier'].'" />';
	$bouton .= '</a>';
	return $bouton;
}


// ------------------------------------------------------------------------------------------------
// Ecrire bouton copier
function ecrire_bouton_copier($item,$section)
{
	$lien = $GLOBALS['lien'];
	$mot_gene = $GLOBALS['mot_gene'];
	
	$bouton = '<a href="'.URL_ADMIN.'?act=copy&amp;sec='.$section.'&amp;id='.$item.'" title="">';
	$bouton .= '<img src="'.URL_IMAGES.'picto-copier.png" alt="'.$mot_gene['Copier'].'" />';
	$bouton .= '</a>';
	return $bouton;
}

// ------------------------------------------------------------------------------------------------
// Ecrire bouton supprimer
function ecrire_bouton_supprimer($item,$section)
{
	$lien = $GLOBALS['lien'];
	$mot_gene = $GLOBALS['mot_gene'];
	
	$bouton = '<a href="'.URL_ADMIN.'?act=del&amp;sec='.$section.'&amp;id='.$item.'" title="">';
	$bouton .= '<img src="'.URL_IMAGES.'picto-supprimer.png" alt="'.$mot_gene['Supprimer'].'" />';
	$bouton .= '</a>';
	return $bouton;
}



// ------------------------------------------------------------------------------------------------
// Ecrire les boutons bbcode
function ecrire_boutons_bbcode($nom_form,$nom_champs)
{
	$lien = $GLOBALS['lien'];
	$bb = '<div>';
	$bb .= '<span class="intitule">&nbsp;</span>';
	$bb .= '<span class="balise">';
	$bb .= '<img src="'.URL_IMAGES.'bold.gif" alt="Bold" onclick="insertion(\''.$nom_form.'\',\''.$nom_champs.'\',\'\',\'<strong>\',\'</strong>\');">';
	$bb .= '<img src="'.URL_IMAGES.'italic.gif" alt="Italic" onclick="insertion(\''.$nom_form.'\',\''.$nom_champs.'\',\'\',\'<em>\',\'</em>\');">';
	$bb .= '<img src="'.URL_IMAGES.'underline.gif" alt="Underline" onclick="insertion(\''.$nom_form.'\',\''.$nom_champs.'\',\'\',\'<span underline>\',\'</span>\');">';
	$bb .= '<img src="'.URL_IMAGES.'retour.gif" alt="Return" onclick="insertion(\''.$nom_form.'\',\''.$nom_champs.'\',\'\',\'\',\'<br />\');">';
	$bb .= '<img src="'.URL_IMAGES.'link.gif" alt="Link" onclick="insertion(\''.$nom_form.'\',\''.$nom_champs.'\',\'lien\',\'\',\'\');">';
	$bb .= '<img src="'.URL_IMAGES.'img.gif" alt="Image" onclick="insertion(\''.$nom_form.'\',\''.$nom_champs.'\',\'img\',\'\',\'\');">';
	$bb .= '<img src="'.URL_IMAGES.'pdf.png" alt="PDF" onclick="insertion(\''.$nom_form.'\',\''.$nom_champs.'\',\'pdf\',\'\',\'\');">';
	$bb .= '<img src="'.URL_IMAGES.'picto-mp3.jpg" alt="MP3" onclick="insertion(\''.$nom_form.'\',\''.$nom_champs.'\',\'son\',\'\',\'\');">';
	$bb .= '<img src="'.URL_IMAGES.'uliste.gif" alt="List" onclick="insertion(\''.$nom_form.'\',\''.$nom_champs.'\',\'list\',\'\',\'\');">';
	$bb .= '<img src="'.URL_IMAGES.'h1.gif" alt="Titre" onclick="insertion(\''.$nom_form.'\',\''.$nom_champs.'\',\'\',\'<h2>\',\'</h2>\');">';
	$bb .= '<img src="'.URL_IMAGES.'h2.gif" alt="Sous-titre" onclick="insertion(\''.$nom_form.'\',\''.$nom_champs.'\',\'\',\'<h3>\',\'</h3>\');">';
	$bb .= '<img src="'.URL_IMAGES.'barre.gif" alt="Texte barré" onclick="insertion(\''.$nom_form.'\',\''.$nom_champs.'\',\'\',\'<span line-through>\',\'</span>\');">';
	$bb .= '<img src="'.URL_IMAGES.'fluo-bleu.gif" alt="Titre" onclick="insertion(\''.$nom_form.'\',\''.$nom_champs.'\',\'\',\'<span bg=blue>\',\'</span>\');">';
	$bb .= '<img src="'.URL_IMAGES.'fluo-jaune.gif" alt="Titre" onclick="insertion(\''.$nom_form.'\',\''.$nom_champs.'\',\'\',\'<span bg=yellow>\',\'</span>\');">';
	$bb .= '</span>';
	$bb .= '</div>';
	return $bb;
}


// ------------------------------------------------------------------------------------------------
// Ecrire une erreur
function ecrire_erreur($phrase_erreur)
{
	$erreur = '<h6 class="txt_record error">'.$phrase_erreur.'</h6>';
	return $erreur;
}


function ecrire_succes($phrase)
{
	$erreur = '<h6 class="txt_record succes">'.$phrase.'</h6>';
	return $erreur;
}

// ------------------------------------------------------------------------------------------------
// Valider une suppression
function ecrire_validation_suppression($section,$item)
{
	$mot_gene = $GLOBALS['mot_gene'];
	$phrase_gene = $GLOBALS['phrase_gene'];
	$tab_content = $GLOBALS['tab_content'];
	
	$validation = '<div id="suppression">';
	$validation .= '<form name="delete" action="'.URL_ADMIN.'?'.$_SERVER['QUERY_STRING'].'" method="post">';
	$validation .= '<fieldset>';
	$validation .= '<legend>'.$phrase_gene['ConfirmerSuppression'].'</legend>';
	
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	$requete = call_user_func($tab_content[$section]['query_delete'],$item);
	$result = mysql_query($requete) or die();
	connexion_end();
	$row = mysql_fetch_array($result);
	
	$validation .= '<p>'.$row['Champ1'].' ('.$row['Champ2'].') </p>';
	
	// ------------  Champ CONTROLE
	$datas_controle = array(	"name" => "controle",
														"value" => "suppression" );
	$validation .= ecrire_balise("hidden",$datas_controle);
	
	// ------------  Champ SECTION
	$datas_sec = array(	"name" => "section",
											"value" => $section );
	$validation .= ecrire_balise("hidden",$datas_sec);
	
	// ------------  Champ ID ITEM
	$datas_item = array(	"name" => "item",
												"value" => $item );
	$validation .= ecrire_balise("hidden",$datas_item);
	
	// ------------  Champ ENVOI
	$datas_envoi = array(	"name" => "envoi",
												"value" => $mot_gene['Supprimer'],
												"tabindex" => "5",
												"class" => "submit" );
	$validation .= ecrire_balise("submit",$datas_envoi);
	
	$validation .= '</fieldset>';
	$validation .= '</form>';
	$validation .= '</div>';
	return $validation;
}


function ecrire_formulaire_recherche($mots)
{
	$mot_gene = $GLOBALS['mot_gene'];
	$phrase_gene = $GLOBALS['phrase_gene'];
	
	$html = '<form name="recherche" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post">';
	$html .= '<fieldset class="form_recherche">';
	$html .= '<legend>'.$phrase_gene['ChercherDansListe'].'</legend>';
	$html .= '<label for="mot_search">'.$phrase_gene['IndiquerMotCle'].' : <input type="text" name="mot_search" id="mot_search" class="" value="'.$mots['mot_search'].'" /></label> ';
	$html .= '<label for="envoi_search"><input type="submit" name="envoi_search" id="envoi_search" class="submit_search" value="'.$mot_gene['Chercher'].'" /></label>';
	$html .= '</fieldset>';
	$html .= '</form>';
	return $html;
}


?>
