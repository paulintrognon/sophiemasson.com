<?php
// ********************************************************************************************
// ***************         Bibliothèque pour écrire du HTML             ***********************
// ********************************************************************************************


function ecrire_doctype_html($head,$body)
{
	$doc_type = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	$doc_type .= '<html xmlns="http://www.w3.org/1999/xhtml">';
	$doc_type .= $head;
	$doc_type .= $body;
	$doc_type .= '</html>';
	return $doc_type;
}


function ecrire_balise_head($meta_title,$meta_description,$meta_keywords,$lien_css,$java)
{
	$head = '<head>';
	$head .= ecrire_meta_title($meta_title);
	$head .= ecrire_meta("description",DESCRIPTION);
	$head .= ecrire_meta("keywords",KEYWORDS);
	$head .= ecrire_meta("author",AUTHOR);
	$head .= ecrire_meta("robots",ROBOTS);
	$head .= ecrire_meta("verify-v1","gN/ZGeXw+Z4zIJQvULBFEWrx9TO2qGmPS9w37e0pYHc=");
	$head .= ecrire_meta_http(CHARSET);
	$head .= ecrire_lien_css($lien_css);
	$head .= ajouter_liens_javascript($java);
        $head .= '<link href="http://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet" type="text/css">';
	$head .= '<script type="text/javascript" src="librairie/scriptaculous/lib/prototype.js"></script>';
	$head .= '<script type="text/javascript" src="librairie/scriptaculous/lib/scriptaculous.js"></script>';
	$head .= '<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-9492723-1");
		pageTracker._trackPageview();
		} catch(err) {}</script>';
	$head .= '</head>';
	return $head;
}


function ecrire_slogan()
{
	$lien = $GLOBALS['lien'];
	$img = $GLOBALS['img'];
	$alt = $GLOBALS['alt'];
	$phrase = $GLOBALS['phrase'];
	$title = $GLOBALS['title'];
	
	$html = '<div id="logo">';
	$html .= '<h1 id="website-title"><a href="'.URL.'" title="'.$title['LogoSite'].'">sophie masson & delobal</a></h1>';
	$html .= '<h2 id="website-subtitle">porcelaine</h2>';
	$html .= '</div>';
	return $html;
}


function afficher_section($mot,$section,$section_bis)
{
	if ($section == $section_bis)
	{
		$val = '<strong>'.$mot.'</strong>';
	}
	else
	{
		$val = $mot;
	}
	return $val;
}


function ecrire_navigation_principale($section)
{
	$lien = $GLOBALS['lien'];
	$mot = $GLOBALS['mot'];
	$title = $GLOBALS['title'];
	
	$html = '<div id="menu">';
	$html .= '<ul>';
	$html .= '<li><a href="'.$lien['Collection'].'" title="'.$title['Collection'].'">'.afficher_section($mot['Collection'],$section,'collection').'</a></li>';
	$html .= '<li><a href="'.$lien['Formes'].'" title="'.$title['SurMesure'].'">'.afficher_section($mot['SurMesure'],$section,'formes').'</a></li>';
	$html .= '<li><a href="'.$lien['Presse'].'" title="'.$title['Presse'].'">'.afficher_section($mot['Presse'],$section,'presse').'</a></li>';
	$html .= '<li><a href="'.$lien['Portrait'].'" title="'.$title['Portrait'].'">'.afficher_section($mot['Portrait'],$section,'portrait').'</a></li>';
	$html .= '<li><a href="'.$lien['Services'].'" title="'.$title['Services'].'">'.afficher_section($mot['Services'],$section,'services').'</a></li>';
//	$html .= '<li><a href="'.$lien['Actualites'].'" title="'.$title['Actualites'].'">'.afficher_section($mot['Actualites'],$section,'actualite').'</a></li>';
	$html .= '<li><a href="http://sophiemasson.blogspot.com" title="'.$title['Actualites'].'" target="_blank">blog</a></li>';
	$html .= '<li><a href="'.$lien['Contact'].'" title="'.$title['Contact'].'">'.afficher_section($mot['Contact'],$section,'contact').'</a></li>';
	$html .= '</ul>';
	$html .= '</div>';
	return $html;
}


function entrer_dans_site($langue)
{
	$title = $GLOBALS['title'];
	$phrase = $GLOBALS['phrase'];
	$lien = $GLOBALS['lien'];
	
	$requete = rq_themes_homepage($langue);
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	$result = mysql_query($requete) ;
	connexion_end();
	if (mysql_num_rows($result) > 0)
	{
		$html = '<div id="bloc_photos_home">';
		//$html .= '<h1 class="titre_page">'.$phrase['MonActu'].'</h1>';
		while ($row = mysql_fetch_array($result))
		{
			$html .= '<div class="theme_home">';
			$html .= '<a href="'.$lien['Collection'].$row['ID'].'/0/'.transformer_chaine_url($row['Titre']).'" title="'.affichage_donnee($row['Titre']).'">';
			$html .= '<img src="'.URL_IMG.$row['Image'].'" alt="'.affichage_donnee($row['Titre']).'" />';
			$html .= '</a>';
			$html .= '</div>';
		}
		$html .= '<div class="spacer">&nbsp;</div>';
		$html .= '</div>';		
	}
	return $html;
}


function ecrire_retour_page()
{
	$mot = $GLOBALS['mot'];
	
	$retour = '<p class="lien_flash"><a href="javascript:history.go(-1)"> << '.$mot['Retour'].' << </a></p>';
	return $retour;
}


function ecrire_actualites($langue)
{
	$lien = $GLOBALS['lien'];
	$phrase = $GLOBALS['phrase'];
	$img = $GLOBALS['img'];
	$alt = $GLOBALS['alt'];
	
	$requete = requete_last_news('',$langue);
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	$result = mysql_query($requete) or die ();
	connexion_end();
	if (mysql_num_rows($result) > 0)
	{
		$html = '<div id="actu">';
		//$html .= '<h1 class="titre_page">'.$phrase['MonActu'].'</h1>';
		while ($row = mysql_fetch_array($result))
		{
			$html .= '<div>';
			$html .= '<a name="'.$row['ID'].'"><h2>'.$row['Titre'].'</h2></a>';
			$html .= '<p>'.$row['Texte'].'</p>';
			$html .= '<p><span>'.$phrase['PublieLe'].' '.retourner_date($row['DateDebut']).'</span></p>';
			$html .= '<p>&nbsp;</p>';
			$html .= '</div>';
		}
		$html .= '</div>';		
	}
	return $html;
}


function ecrire_form_contact($valeurs)
 {
    $phrase = $GLOBALS['phrase'];
    $mot = $GLOBALS['mot'];
    
    $form = '<p class="email-contact-sentence">Vous pouvez nous contacter directement via <a href="mailto:sophie-masson@orange.fr">sophie-masson@orange.fr</a>,<br />ou en remplissant le formulaire ci-dessous.</p>';

    $form .= '<form name="contact" action="' . $_SERVER['REQUEST_URI'] . '" method="post">';
    $form .= '<fieldset>';
    $form .= '<legend>' . $phrase['PourMeContacter'] . '</legend>';

    $datas_msg = array(
        "name" => "Message",
        "value" => $valeurs['Message'],
        "tabindex" => "1",
        "class" => "champs",
        "label" => $phrase['VotreMessage']
    );
    $form .= ecrire_balise("textarea", $datas_msg);

    $datas_nom = array(
        "name" => "Nom",
        "value" => $valeurs['Nom'],
        "tabindex" => "2",
        "class" => "champs",
        "label" => $phrase['VotreNom']);
    $form .= ecrire_balise("text", $datas_nom);

    $datas_adr = array(
        "name" => "Adresse",
        "value" => $valeurs['Adresse'],
        "tabindex" => "3",
        "class" => "champs",
        "label" => $phrase['VotreAdresse']);
    $form .= ecrire_balise("text", $datas_adr);

    $datas_cp = array(
        "name" => "CP",
        "value" => $valeurs['CP'],
        "tabindex" => "4",
        "class" => "champs",
        "label" => $phrase['VotreCP']);
    $form .= ecrire_balise("text", $datas_cp);

    $datas_city = array(
        "name" => "Ville",
        "value" => $valeurs['Ville'],
        "tabindex" => "5",
        "class" => "champs",
        "label" => $phrase['VotreVille']);
    $form .= ecrire_balise("text", $datas_city);

    $datas_tel = array(
        "name" => "Tel",
        "value" => $valeurs['Tel'],
        "tabindex" => "6",
        "class" => "champs",
        "label" => $phrase['VotreTel']);
    $form .= ecrire_balise("text", $datas_tel);

    $datas_mail = array(
        "name" => "Email",
        "value" => $valeurs['Email'],
        "tabindex" => "7",
        "class" => "champs",
        "label" => $phrase['VotreEmail']);
    $form .= ecrire_balise("text", $datas_mail);

    $datas_controle = array(
        "name" => "controle",
        "value" => "contact");
    $form .= ecrire_balise("hidden", $datas_controle);

    $datas_envoi = array(
        "name" => "envoi",
        "value" => $mot['Envoyer'],
        "tabindex" => "8",
        "class" => "submit");
    $form .= ecrire_balise("submit", $datas_envoi);

    $form .= '</fieldset>';
    $form .= '</form>';
    return $form;
}


function ecrire_coordonnees()
{
	$phrase = $GLOBALS['phrase'];
	$lien = $GLOBALS['lien'];
	$img = $GLOBALS['img'];
	$alt = $GLOBALS['alt'];
	$title = $GLOBALS['title'];
	
	$adr = '<div id="coordonnees">';
	$adr .= '<p><img src="'.$lien['Images'].$img['PhotoContact'].'" alt="'.$alt['PhotoContact'].'" /></p>';
	$adr .= '<p><strong>'.$phrase['SophieMasson'].'</strong></p>';
	$adr .= '<p>'.$phrase['AdresseMasson'].'</p>';
	$adr .= '<p>'.$phrase['VilleMasson'].'</p>';
	$adr .= '<p>'.$phrase['MobMasson'].'</p>';
	$adr .= '<p>'.$phrase['TelMasson'].'</p>';
	$adr .= '<p>'.$phrase['MailMasson'].'</p>';
	$adr .= '<ul>';
	$adr .= '<li><a href="'.$lien['MentionsCreation'].'" title="'.$title['MentionsCreation'].'" target="_blank">'.$phrase['MentionsCreation'].'</a></li>';
	$adr .= '<li><a href="'.$lien['MentionsDeveloppement'].'" title="'.$title['MentionsDeveloppement'].'" target="_blank">'.$phrase['MentionsDeveloppement'].'</a></li>';
//	$adr .= '<li><a href="'.$lien['MentionsPhotos'].'" title="'.$title['MentionsPhotos'].'" target="_blank">'.$phrase['MentionsPhotos'].'</a></li>';
	$adr .= '</ul>';
	$adr .= '</div>';
	return $adr;
}


function ecrire_erreur($phrase_erreur)
{
	$erreur = '<h6>'.$phrase_erreur.'</h6>';
	return $erreur;
}


function ecrire_footer()
{	
	$phrase = $GLOBALS['phrase'];
	$lien = $GLOBALS['lien'];

	$html = '<div id="footer">';
	$html .= '<div id="signature">';
	$html .= '<p>'.$phrase['footer'].'</p>';
	$html .= '<p>'.$phrase['MentionsDeveloppement'].'</p>';
	$html .= '<p>'.$phrase['AdresseMasson'].'</p>';
	$html .= '<p>'.$phrase['Copyrights'].'</p>';
	$html .= '</div>';
		//$html .= '<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fplatform&width=292&colorscheme=light&show_faces=true&stream=true&header=true&height=427" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:427px;" allowTransparency="true"></iframe>';
	$html .= '</div>';
	return $html;
}


function ecrire_retombee_presse($item,$parametres)
{
	$lien = $GLOBALS['lien'];
	$phrase = $GLOBALS['phrase'];
	
	$requete = rq_retombee_presse($item);
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	$result = mysql_query($requete) or die();
	connexion_end();
	
	if (mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_array($result);
		$pages_interieures = array($row['Page1'],$row['Page2'],$page['Page3'],$row['Page4']);	
		
		$html = '<div id="retombee_presse">';
		
		$html .= '<div id="article_presse"><img src="'.URL_IMG.$pages_interieures[$parametres].'" alt="" /></div>';
		
		$html .= '<div id="details_presse">';		
		$html .= '<p class="revue">'.affichage_donnee($row['Revue']).'</p>';
		$html .= '<p class="date_publication">'.affichage_donnee($row['DatePublication']).'</p>';
			
		$html .= '<ul class="nbre_pages">';		
		for ($i=0; $i<4; $i++)
		{
			if (!empty($pages_interieures[$i]))
			{
				$bouton = $i;
				if ($i == $parametres)
				{
					$bouton = '<strong>'.($i+1).'</strong>';
				}
				$html .= '<li><a href="'.$lien['Presse'].$i.'/'.$item.'" title="">'.$bouton.'</a></li>';
			}
		}
		$html .= '</ul>';
		$html .= '<p><a href="'.$lien['Presse'].'" title="">'.$phrase['RetourRevuePresse'].'</a></p>';
		$html .= '</div>';
		$html .= '<div class="spacer">&nbsp;</div>';
		$html .= '</div>';
		return $html;
	}
}


function ecrire_album_presse()
{
	$phrase = $GLOBALS['phrase'];
	$lien = $GLOBALS['lien'];
	
	$requete = rq_liste_presse();
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	$result = mysql_query($requete) or die();
	connexion_end();

	if (mysql_num_rows($result) > 0)
	{
		$html = '';
		while ($row = mysql_fetch_array($result))
		{
			$html .= '<div class="couv_presse">';	
			$image_presse = '<img src="'.URL_IMG.'vign-'.$row['Couverture'].'" alt="'.$row['Revue'].'" />';
			if (!empty($row['Page1']))
			{		
				$html .= '<a href="'.$lien['Presse'].'0/'.$row['ID'].'" title="'.$row['Revue'].'">';
				$html .= $image_presse;
				$html .= '</a>';					
			}
			else
			{
				$html .= $image_presse;				
			}
			$html .= '</div>';
		}
		$html .= '<div class="spacer">&nbsp;</div>';
		return $html;
	}
}


function ecrire_fiche_produit($item,$langue,$parametres)
{
	$phrase = $GLOBALS['phrase'];
	$mot = $GLOBALS['mot'];
	$lien = $GLOBALS['lien'];
	
	$requete = rq_fiche_produit($item,$langue);
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	$result = mysql_query($requete) or die();
	connexion_end();

	if (mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_array($result);
		$html = '<div class="fiche_produit">';
		//$html .= '<p class=""><a href="'.$lien['Collection'].$parametres.'/0" title="">'.$phrase['RetourCatalogue'].'</a></p>';
		$html .= '<div><img src="'.URL_IMG.$row['Photo'].'" alt="'.affichage_donnee($row['MostCles']).'" /></div>';
		$html .= '<h1>'.affichage_donnee($row['Nom']).'</h1>';
		$html .= '<p>'.affichage_donnee($row['Description']).'</p>';
		$html .= '<p>'.$mot['Prix'].' : '.$row['Prix'].' euros TTC</p>';
		$html .= '<p><a href="'.$lien['Contact'].'">'.$phrase['PourAcheterCetCreation'].'</a> | ';
		$html .= '<a href="'.$lien['Formes'].'">'.$phrase['PourPersonnaliserCetteCreation'].'</a></p>';
		$html .= '</div>';
		return $html;
	}
}

function ecrire_catalogue($langue,$parametres)
{
	$phrase = $GLOBALS['phrase'];
	$lien = $GLOBALS['lien'];

	$requete = rq_liste_produits($langue,$parametres);
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	$result = mysql_query($requete) or die(mysql_error());
	connexion_end();

	if (mysql_num_rows($result) > 0)
	{
		$html = '<div id="intro_catalogue">';
		while ($row = mysql_fetch_array($result))
		{
			$html .= '<div class="produit_sophie">';
			$html .= '<a href="'.$lien['Collection'].$parametres.'/'.$row['ID'].'" title="'.$row['Nom'].'">';
			$html .= '<img src="'.URL_IMG.'vign-'.$row['Photo'].'" alt="'.$row['Nom'].'" width="100"/>';
			$html .= '</a>';
			$html .= '</div>';				
		}	
		$html .= '<div class="spacer">&nbsp;</div>';
		$html .= '</div>';
		return $html;
	}
}


function ecrire_themes_catalogue($langue,$parametres)
{
	$lien = $GLOBALS['lien'];
	
	if ($parametres > 0)
	{	
		$requete = requete_themes_catalogues($langue);
		connexion_base(SERVEUR,HOST,PASSWORD,BASE);
		$result = mysql_query($requete) or die();
		connexion_end();
	
		if (mysql_num_rows($result) > 0)
		{ 
			$html = '<ul class="liste_themes_cata">';
			while ($row = mysql_fetch_array($result))
			{
				$titre_theme = $row['Titre'];
				if ($parametres == $row['ID'])
				{
					$titre_theme = '<strong>'.$row['Titre'].'</strong>';
				}
				$html .= '<li><a href="'.$lien['Collection'].$row['ID'].'/0/" title="">'.$titre_theme.'</a></li>';
			}
			$html .= '</ul>';		
		}
		return $html;
	}
}

function ecrire_trois_news($section,$langue)
{
	$img = $GLOBALS['img'];
	$alt = $GLOBALS['alt'];
	$lien = $GLOBALS['lien'];
	
	if (!empty($section))
	{
		$requete = requete_last_news('3',$langue);
		connexion_base(SERVEUR,HOST,PASSWORD,BASE);
		$result = mysql_query($requete) or die();
		connexion_end();
		
		if (mysql_num_rows($result) > 0)
		{
			$html = '<p><img src="'.$lien['Images'].$img['ActuSite'].'" alt="'.$alt['ActuSite'].'" /></p>';
			$html .= '<ul class="liste_news">';
			while ($row = mysql_fetch_array($result))
			{
	 			$html .= '<li><a href="'.$lien['Actualites'].'#'.$row['ID'].'" title="'.$row['Titre'].'">'.$row['Titre'].'</a></li>';
	 		}
	 		$html .= '</ul>';
	 		return $html;
	 	}
	}
}


function ecrire_intro_catalogue($langue)
{
	$title = $GLOBALS['title'];
	$phrase = $GLOBALS['phrase'];
	$lien = $GLOBALS['lien'];
	
	$requete = rq_themes_catalogue($langue);
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	$result = mysql_query($requete) or die ();
	connexion_end();
	if (mysql_num_rows($result) > 0)
	{
		$html = '<div id="intro_catalogue">';
		//$html .= '<h1 class="titre_page">'.$phrase['MonActu'].'</h1>';
		while ($row = mysql_fetch_array($result))
		{
			$lien_page = $lien['Collection'].$row['ID'].'/0/'.transformer_chaine_url($row['Titre']);
			$html .= '<div class="theme_catalogue">';
			$html .= '<p><a href="'.$lien_page.'" title="'.affichage_donnee($row['Titre']).'">';
			$html .= '<img src="'.URL_IMG.$row['Image'].'" alt="'.affichage_donnee($row['Titre']).'" width="110" />';
			$html .= '</a></p>';
			$html .= '<p class="legend"><a href="'.$lien_page.'" title="'.affichage_donnee($row['Titre']).'">'.affichage_donnee($row['Titre']).'</a></p>';			
			$html .= '</div>';
		}
		$html .= '<div class="spacer">&nbsp;</div>';
		$html .= '</div>';		
	}
	return $html;
}


function ecrire_langue_version($langue)
{
	$lien = $GLOBALS['lien'];
	$mot = $GLOBALS['mot'];
	$title = $GLOBALS['title'];
	
	$html = '<ul class="langue_site">';
	$html .= '<li><a href="'.$lien['Français'].'" title="'.$title['VersionFrancais'].'">';
	if ($langue == "Fr")
	{
		$html .= '<strong>'.$mot['Français'].'</strong>';
	}
	else
	{
		$html .= $mot['Français'];
	}
	$html .= '</a></li>';
	$html .= '<li><a href="'.$lien['Anglais'].'" title="'.$title['VersionAnglaise'].'">';
	if ($langue == "En")
	{
		$html .= '<strong>'.$mot['English'].'</strong>';
	}
	else
	{
		$html .= $mot['English'];
	}
	$html .= '</a></li>';
	$html .= '</ul>';
	return $html;
}


function ecrire_liste_formes()
{
	$formes_vaisselle = $GLOBALS['formes_vaisselle'];
	
	$html = '<div class="vaisselle">';
	$html .= '<table summary="">';
	$n = 0;
	for($i=0; $i<count($formes_vaisselle); $i++)
	{
		if ($n == 0)
		{
			$html .= '<tr>';
		}
		//$html .= '<div class="forme_vaisselle">';
		$html .= '<td>';
		$html .= '<img src="http://www.sophiemasson.com/images/'.$formes_vaisselle[$i]['img'].'" alt="vaisselle en porcelaine '.$formes_vaisselle[$i]['nom'].'" /><br />'.$formes_vaisselle[$i]['nom'];
		//$html .= '</div>';
		$html .= '</td>';
		if ($n == 1)
		{
			$html .= '</tr>';
			$n = 0;
		}
		else 
		{
			$n = 1;
		}
	}
	$html .= '</table>';
	$html .= '</div>';
	return $html;
}

function afficher_bouton_paypal($parametres,$item)
{
	$phrase = $GLOBALS['phrase'];
	$mot = $GLOBALS['mot'];
	$title = $GLOBALS['title'];

	$requete = rq_details_paiement($parametres,$item);
	connexion_base(SERVEUR,HOST,PASSWORD,BASE);
	$result = mysql_query($requete) or die ();
	connexion_end();
	if (mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_array($result);
		$html = '<p>'.$phrase['VousAvezCommande'].' <br /><strong>'.$row['Objet'].'</strong></p>';
		$html .= '<p>'.$phrase['PourMontant'].' <strong>'.$row['Montant'].'</strong> euros TTC.</p>';
		$html .= '<p>'.$phrase['PayerParPaypal'].'.</p>';
		$html .= creer_bouton_paypal($row);
	}
	else
	{
		$html = '<p>'.$phrase['AucunPaiement'].'</p>';
	}
	return $html;
}

function creer_bouton_paypal($values)
{
	$html = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" class="paypal">';
	// détermine bouton acheter maintenant
	$html .= '<input type="hidden" name="cmd" value="_xclick">';
	$html .= '<input type="hidden" name="business" value="sophie-masson@orange.fr">';
	$html .= '<input type="hidden" name="quantity" value="1">';
	$html .= '<input type="hidden" name="item_name" value="'.$values['Objet'].'">';
	$html .= '<input type="hidden" name="amount" value="'.$values['Montant'].'">';
	$html .= '<input type="hidden" name="item_number" value="'.$values['ID'].'">';
	$html .= '<input type="hidden" name="no_note" value="1">';
	$html .= '<input type="hidden" name="rm" value="2">';
	$html .= '<input type="hidden" name="currency_code" value="EUR">';
	$html .= '<input type="hidden" name="bn" value="PP-BuyNowBF">';
	// adresse
	$html .= '<input type="hidden" name="lc" value="FR">';
	$html .= '<input type="hidden" name="first_name" value="'.$values['Nom'].'">';
	$html .= '<input type="hidden" name="last_name" value="'.$values['Prenom'].'">';
	$html .= '<input type="hidden" name="address1" value="'.$values['Adresse'].'">';
	$html .= '<input type="hidden" name="address2" value="'.$values['Email'].'">';
	$html .= '<input type="hidden" name="email" value="'.$values['Email'].'">';
	$html .= '<input type="hidden" name="city" value="'.$values['Ville'].'">';
	$html .= '<input type="hidden" name="country" value="FR">';
	$html .= '<input type="hidden" name="zip" value="'.$values['CP'].'">';
	
	$html .= '<input type="image" src="https://www.paypal.com/fr_FR/i/btn/x-click-butcc.gif" border="0" name="submit" alt="Effectuez vos paiements via PayPal : une solution rapide, gratuite et sécurisée">';
	$html .= '<img alt="" border="0" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1">';
	$html .= '</form>';
	return $html;
}
?>