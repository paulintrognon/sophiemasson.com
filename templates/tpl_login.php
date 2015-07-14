<?php
function ecrire_form_login($erreur)
{
	$lien = $GLOBALS['lien'];
	
	// -----------------------------------------------------------------------
	// -----------------  En-tête de page
	// -----------------  Balises Meta
	// -----------------------------------------------------------------------
	$lien_css = array(	"admin.css" => "all" );
	$meta_description = "";
	$meta_keywords = "";
	$head = ecrire_balise_head($meta_title,$meta_description,$meta_keywords,$lien_css,'2');
	
	
	// -----------------------------------------------------------------------
	// -----------------  Contenu
	// -----------------------------------------------------------------------
	$body = '<body>';
	

	if (!empty($erreur))
	{
		$body .= '<h4>'.$erreur.'</h4>';
	}
	$body .= '<div id="form_identif">';
	$body .= '<p><img src="'.$lien['Images'].'arrondis-top.png" alt="" /></p>';
	$body .= ecrire_form_identif();
	$body .= '<p><img src="'.$lien['Images'].'arrondis-bottom.png" alt="" /></p>';
	$body .= '</div>';
	$body .= '</body>';
	
	
	// -----------------------------------------------------------------------
	// ----------------   Compiler la page
	// -----------------------------------------------------------------------
	return ecrire_doctype_html($head,$body);
}
?>