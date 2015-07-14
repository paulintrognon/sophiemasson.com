<?php
/*  
		############################################################################
		Outil d'administration de site internet 
		Author : Arnaud Meunier
		Version : 1.5
		Date : janvier 2007 
		############################################################################
*/


function templates_page_upl($format,$action,$media,$orientation)
{
	$lien = $GLOBALS['lien'];
	$phrase_gene = $GLOBALS['phrase_gene'];
	$mot_gene = $GLOBALS['mot_gene'];
	$tab_gene = $GLOBALS['tab_gene'];

	// -----------------  Contenu
	$body = '<body>';
	
	// barre de navigation
	$body .= '<ul class="navigation_upload">';
	$body .= '<li><a href="'.$_SERVER['PHP_SELF'].'?ser=1&upl='.$format.'">'.$mot_gene['Telecharger'].'</a></li>';
	$body .= '<li><a href="'.$_SERVER['PHP_SELF'].'?ser=4&upl=img">'.$phrase_gene['VoirImagesServeur'].'</a></li>';
	$body .= '<li><a href="'.$_SERVER['PHP_SELF'].'?ser=4&upl=doc">'.$phrase_gene['VoirDocsServeur'].'</a></li>';
	$body .= '<li><a href="'.$_SERVER['PHP_SELF'].'?ser=4&upl=son">'.$phrase_gene['VoirSonsServeur'].'</a></li>';	
	$body .= '</ul>';
	

	$body .= '<div id="form_upload">';
	$body .= '<p class="arrondi"><img src="'.URL_IMAGES.'arrondis-top.png" alt="" /></p>';
	
	/*
		Si le formulaire est envoyé, on le traite et on affiche le résultat
	*/
	if (isset($_POST['controle']) AND $_POST['controle'] == "upload" )
	{
		
		if ($action == "1" OR $action == "2")
		{
				if (controle_avant_upload($_FILES['fichier']['name']) == TRUE)
				{
						$nom_repertoire_depot = definir_repertoire_destination($_FILES['fichier']['tmp_name'],$format,$_POST['largeur']);
						if (move_uploaded_file($_FILES['fichier']['tmp_name'],$nom_repertoire_depot.str_replace(" ","",$_FILES['fichier']['name'])))
						{
								// copie du répertoire haute_def au répertoire photos
								if ($nom_repertoire_depot == "upload/haute_def/")
								{
										vignette($nom_repertoire_depot.$_FILES['fichier']['name'], 'upload/photos/'.str_replace(" ","",$_FILES['fichier']['name']), $width=$_POST['largeur'], $height=$_POST['largeur'], $orientation);
								}
								// Vignette de l'image
								if ($format == img)
								{
										vignette('upload/photos/'.$_FILES['fichier']['name'], 'upload/photos/vign-'.str_replace(" ","",$_FILES['fichier']['name']), $width=MIN_SIZE, $height=MIN_SIZE, $orientation);
								}
								// Affichage message retour
								if ($action == "1")
								{
										$body .= ecrire_code_ajouter($format,$_FILES['fichier']['error'],str_replace(" ","",$_FILES['fichier']['name']),$_POST['description'],$_POST['legende'],$_POST['langue'],$_POST['credits']);
								}
								else
								{
										//$body .= ecrire_succes($phrase_gene['VotreDocumentTelecharge']);
										$body .= ecrire_code_ajouter('',$_FILES['fichier']['error'],str_replace(" ","",$_FILES['fichier']['name']),'','','','');
								}
						}
						else
						{
								$body .= ecrire_erreur($phrase_gene['ProblemeTechnique']);
						}
				}
				else
				{
						$body .= ecrire_erreur($phrase_gene['UploadVide']);
						$body .= ecrire_erreur($phrase_gene['UploadExtension']);
				}
		}
		else
		{		
				$body .= ecrire_code_ajouter($format,'',$_POST['name_media'],$_POST['description'],$_POST['legende'],$_POST['langue'],$_POST['credits']);
		}
	}
		
	/*
		Si non, on affiche le formulaire ou les documents
	*/
	
	else
	{
		switch($action)
		{
				// Upload pour retourner du code html
				case "1":
						$values = array();
						$values['poids'] = 2000000;
						$body .= ecrire_upload_media($values,$action,$format);
				break;
				
				// Upload simple sans retour avec code html
				case "2":
						$values = array();
						$values['poids'] = 2000000;
						$body .= ecrire_upload_media($values,$action,$format);
				break;
				
				// Forumlaire pour retourner du Code html
				case "3":
						$values = array();
						$values['name_media'] = $media;
						$values['poids'] = 2000000;
						$body .= ecrire_upload_media($values,$action,$format);
				break;
						
				// Liste les répertoires du serveur
				case "4":
						switch ($format)
						{
								// Listing des images sur le serveur
								case "img":
								$repertoire = 'upload/photos/';
								$liste_docs = lister_fichiers_repertoire($repertoire);
								$body .= lister_images_serveur($liste_docs,$repertoire,$format);
								break;
								
								// Listing des documents sur le serveur
								case "doc":
								$repertoire = 'upload/docs/';
								$liste_docs = lister_fichiers_repertoire($repertoire);
								$body .= lister_docs_serveur($liste_docs,$repertoire,$format);
								break;
								
								// Listing des sons sur le serveur
								case "son":
								$repertoire = 'upload/sons/';
								$liste_docs = lister_fichiers_repertoire($repertoire);
								$body .= lister_sons_serveur($liste_docs,$repertoire,$format);
								break;
								
								// Listing des vidéos sur le serveur
								case "mov":
								$repertoire = 'upload/movies/';
								$liste_docs = lister_fichiers_repertoire($repertoire);
								$body .= lister_docs_serveur($liste_docs,$repertoire,$format);
								break;
								
								// Listing des animations flash sur le serveur
								case "fla":
								$repertoire = 'upload/flash/';	
								$liste_docs = lister_fichiers_repertoire($repertoire);
								$body .= lister_docs_serveur($liste_docs,$repertoire,$format);
								break;
						}
				break;
		}
	
	}


	$body .= '<div id="spacer">&nbsp;</div>';
	
	$body .= '<p class="arrondi"><img src="'.URL_IMAGES.'arrondis-bottom.png" alt="" /></p>';
	$body .= '</div>';
	$body .= '</body>';
	
	
// -----------------  En-tête de page

	$lien_css = array("css/upload.css" => "all");
	$head = ecrire_balise_head(TITLE,$lien_css);
	
	return ecrire_doctype_html($head,$body);
}
?>