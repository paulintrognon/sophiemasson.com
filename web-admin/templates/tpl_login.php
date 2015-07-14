<?php

/*  
		############################################################################
		Outil d'administration de site internet 
		Author : Arnaud Meunier
		Version : 1.5
		Date : janvier 2007 
		############################################################################
*/


function templates_login($erreur,$valeurs_post)
{
	$lien = $GLOBALS['lien'];
	$phrase_gene = $GLOBALS['phrase_gene'];
	$mot_gene = $GLOBALS['mot_gene'];

	// -----------------  Contenu
	$body = '<body>';
	$body .= '<div id="form_identif">';
	$body .= '<p><img src="'.URL_IMAGES.'arrondis-top.png" alt="" /></p>';
	if (!empty($erreur))
	{
		$body .= '<h4>'.$erreur.'</h4>';
	}
	$body .= ecrire_form_identif($valeurs_post);
	$body .= '<div class="oubli_pword"><a href="">'.$phrase_gene['OubliPword'].'</a></div>';
	$body .= '<p><img src="'.URL_IMAGES.'arrondis-bottom.png" alt="" /></p>';
	$body .= '</div>';
	$body .= '</body>';
	
	
	// -----------------  En-tête de page
	$lien_css = array(	"css/structure.css" => "all", "css/login.css" => "all" );
	$meta_title = $phrase_gene['TitleAdministration'].' '.NOM_SITE;
	$head = ecrire_balise_head($meta_title,$lien_css);
	
	return ecrire_doctype_html($head,$body);
}
?>