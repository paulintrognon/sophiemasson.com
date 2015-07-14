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
// On génère les balises meta
function ecrire_balise_head($meta_title,$lien_css)
{
	$head = '<head>';
	$head .= ecrire_meta_title($meta_title);
	$head .= ecrire_meta("author",AUTHOR);
	$head .= ecrire_meta_http(CHARSET);
	$head .= ecrire_lien_css($lien_css);
	$head .= ajouter_liens_javascript();
	$head .= '</head>';
	return $head;
}

// ------------------------------------------------------------------------------------------------
// Function : écrire l'en-tête d'une fenêtre
function ecrire_meta_title($meta_title)
{
	$title = '<title>';
	if (!empty($meta_title))
	{
		$title .= $meta_title;
	}
	else
	{
		$title .= TITRE;
	}
	$title .= '</title>';
	return $title;
}


// ------------------------------------------------------------------------------------------------
// Function : écrire des balises meta simples
function ecrire_meta($name,$content)
{
	if (!empty($name))
	{
		$meta = '<meta name="'.$name.'" content="'.$content.'" />';
	}
	else
	{
		$meta = '';
	}
	return $meta;
}


// ------------------------------------------------------------------------------------------------
// Function : Déterminer la norme du texte de la page
function ecrire_meta_http($norme)
{
	if (!empty($norme))
	{
		$meta_http = '<meta http-equiv="Content-Type" content="'.$norme.'" />';
	}
	else
	{
		$meta_http = '';
	}
	return $meta_http;
}


// ------------------------------------------------------------------------------------------------
// Function : écrire les liens vers les feuiles de style css
function ecrire_lien_css($tab_css)
{
	$head_css = '';
	foreach ($tab_css as $key=>$value)
	{	
		$head_css .= '<link href="'.URL.$key.'" rel="stylesheet" type="text/css" media="'.$value.'" />';
	}
	return $head_css;
}


// ------------------------------------------------------------------------------------------------
// Function : Javascript
function ajouter_liens_javascript()
{
	$javascript = ecrire_js();
	$javascript .= bbcode_js();
	return $javascript;
}

?>
