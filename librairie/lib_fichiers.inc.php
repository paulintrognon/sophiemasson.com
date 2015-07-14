<?php
/*  
		############################################################################
		Outil d'administration de site internet 
		Author : Arnaud Meunier
		Version : 1.5
		Date : janvier 2007 
		############################################################################
*/


// --------------------------------------------------------------------------------
// On liste les fichiers d'un répertoire, et on retourne un tableau avec les noms des fichiers.
function lister_fichiers_repertoire($repertoire)
{
	$nom_fichiers = array();
	$dir = opendir($repertoire);
	while ($file = readdir($dir)) 
	{
		if (is_file($repertoire.$file)) 
		{
			$nom_fichiers[] = $file;
		}
	}
	closedir($dir);
	return $nom_fichiers;
}


// --------------------------------------------------------------------------------
// On liste les dossiers d'un répertoire, et on retourne un tableau avec les noms des dossiers.
function lister_repertoires($repertoire)
{
	$nom_dossiers = array();
	$dir = opendir($repertoire);
	while ($dossier = readdir($dir)) 
	{
		if (is_dir($repertoire)) 
		{
			if ($dossier != "." AND $dossier != "..")
			{
				$nom_dossiers[] = $dossier;
			}
		}
	}
	closedir($dir);
	return $nom_dossiers;
}


// ------------------------------------------------------------------------------------------------
// On lit un fichier
function lire_fichier($nom_fichier,$repertoire_fichier)
{
	$baseTexte = $repertoire_fichier.$nom_fichier;
	$full_txt = fopen($baseTexte,"r");
	$txt = '';
	while ($ligne = fgets($full_txt,1024))
	{
		$txt .= $ligne;
	}
	return $txt;
}



// -----------------------------------------------------------------
function lister_images_serveur($liste_docs,$repertoire,$format)
{
	$phrase_gene = $GLOBALS['phrase_gene'];
	
	$html = '<h1>'.$phrase_gene['ImagesServeur'].'</h1>';
	$html .= '<ul class="liste_documents_serveur">';
	foreach ($liste_docs as $key => $val_fichier)
	{
		$taille_image = getimagesize(URL.$repertoire.$val_fichier);
	
		$html .= '<li><img src="'.URL.$repertoire.$val_fichier.'" alt="" /><br />';
		$html .= $val_fichier.' <span class="taille_image">'.$taille_image[0].'x'.$taille_image[1].' pixels</span>';
		$html .= ' - '.txt_obtenir_html($format,$val_fichier).'</li>';
	}
	$html .= '</ul>';
	return $html;
}


// -----------------------------------------------------------------
function lister_docs_serveur($liste_docs,$repertoire,$format)
{
	$phrase_gene = $GLOBALS['phrase_gene'];
	
	$html = '<h1>'.$phrase_gene['DocumentsServeur'].'</h1>';
	$html .= '<ul class="liste_documents_serveur">';
	foreach ($liste_docs as $key => $val_fichier)
	{
		$html .= '<li><a href="'.URL.$repertoire.$val_fichier.'">';
		$html .= $val_fichier.'</a> - '.txt_obtenir_html($format,$val_fichier).'</li>';
	}
	$html .= '</ul>';
	return $html;
}


// -----------------------------------------------------------------
function lister_sons_serveur($liste_docs,$repertoire,$format)
{
	$phrase_gene = $GLOBALS['phrase_gene'];
	
	$html = '<h1>'.$phrase_gene['SonsServeur'].'</h1>';
	$html .= '<ul class="liste_documents_serveur">';
	foreach ($liste_docs as $key => $val_fichier)
	{
		$html .= '<li>'.code_insert_son($val_fichier).'<br />'.$val_fichier.'</li>';
	}
	$html .= '</ul>';
	return $html;
}

// -----------------------------------------------------------------
function txt_obtenir_html($format,$media)
{
	$phrase_gene = $GLOBALS['phrase_gene'];
	
	$html = '<a href="'.URL.'index.php?upl='.$format.'&ser=3&med='.$media.'" style="color:#000;">'.$phrase_gene['ObtenirHTML'].'</a>';
	return $html;
}


function ecrire_fichier($nom_fichier,$repertoire,$texte)
{
	if (!file_exists($repertoire.$nom_fichier))
	{
		touch($repertoire.$nom_fichier);
	}
	$ouvre_fichier = fopen($repertoire.$nom_fichier,"w+"); // ouverture en lecture ( a+)
	fwrite($ouvre_fichier,$texte);    // écriture fichier
	fclose($ouvre_fichier);		// fermeture fichier
}
?> 