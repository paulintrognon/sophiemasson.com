<?php
/*
** Function : �crire l'en-t�te d'une fen�tre
** Input : texte � mettre dans l'en-t�te ou sinon constantes TITRE par d�faut
** Output : donne une variable qui comprend le code html
** Description : permet de cr�er les balises title et le texte de l'en-t�te
** Creator : Arnaud Meunier
** Date : f�vrier 2006
*/
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


/*
** Function : �crire des balises meta simples
** Input : le nom de la balise et son contenu
** Output : donne une variable qui comprend le code html
** Description : permet de cr�er les balises meta pour la partie head de la page
** Creator : Arnaud Meunier
** Date : f�vrier 2006
*/
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


/*
** Function : D�terminer la norme du texte de la page
** Input : la norme du type de contenu
** Output : donne une variable qui comprend le code html
** Description : permet de cr�er la balise meta http-equiv
** Creator : Arnaud Meunier
** Date : f�vrier 2006
*/
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


/*
** Function : �crire les liens vers les feuiles de style css
** Input : un tableau avec le media et le nom du fichier css
** Output : donne une variable qui comprend le code html
** Description : permet de cr�er les balises de liens des fichiers css
** Creator : Arnaud Meunier
** Date : f�vrier 2006
*/
function ecrire_lien_css($lien_css)
{
	if (is_array($lien_css))
	{
		$head_css = '';
		if (count($lien_css) > 0)
		{
			foreach ($lien_css as $style => $media)
			{	
				$head_css .= '<link href="'.URL.'css/'.$style.'" rel="stylesheet" type="text/css" media="'.$media.'" />';
			}
		}
		else
		{
			$head_css = '';
		}
		return $head_css;
	}
	return FALSE;
}


/*
** Function : Javascript
** Input : vide
** Output : les javascripts
** Description : permet d'ajouter les liens vers les fichiers javascript
** Date : mars 2006
*/
function ajouter_liens_javascript($java)
{
	if ($java == "2")
	{
		$javascript = ecrire_js();
		$javascript .= bbcode_js();
	}
	else
	{
		$javascript = "";
	}
	return $javascript;
}
?>
