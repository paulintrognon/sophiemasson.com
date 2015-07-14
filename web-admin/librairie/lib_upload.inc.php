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
// Formulaire d'upload
function ecrire_upload_media($values,$action,$format)
{
	$phrase_gene = $GLOBALS['phrase_gene'];
	$mot_gene = $GLOBALS['mot_gene'];
	$tab = $GLOBALS['tab'];
	$tab_gene = $GLOBALS['tab_gene'];
	$lien = $GLOBALS['lien'];
	
	switch($format)
	{
		case "img":
			$titre_formulaire = $phrase_gene['TelechargerImage'];
			$texte_intro_form = $phrase_gene['AttentionImages'];
			$astuce_upload = $phrase_gene['AstuceUploadImage'];
			$texte_description = $phrase_gene['DescriptionMedia'];
			$astuce_description = $phrase_gene['AstuceUploadDescri'];
		break;
		
		case "doc":
			$titre_formulaire = $phrase_gene['TelechargerDoc'];
			$texte_intro_form = $phrase_gene['AttentionDocs'];
			$astuce_upload = $phrase_gene['AstuceUploadDoc'];
			$texte_description = $phrase_gene['DescriptionMedia'];
			$astuce_description = $phrase_gene['AstuceUploadDescri'];		
		break;
		
		case "son":
			$titre_formulaire = $phrase_gene['TelechargerSon'];
			$texte_intro_form = $phrase_gene['AttentionSons'];
			$astuce_upload = $phrase_gene['AstuceUploadDoc'];
			$texte_description = $phrase_gene['DescriptionMedia'];
			$astuce_description = $phrase_gene['AstuceUploadDescri'];		
		break;
		
		case "mov":
			$titre_formulaire = $phrase_gene['TelechargerFilm'];
			$texte_intro_form = $phrase_gene['AttentionFilms'];
			$astuce_upload = $phrase_gene['AstuceUploadDoc'];
			$texte_description = $phrase_gene['DescriptionMedia'];
			$astuce_description = $phrase_gene['AstuceUploadDescri'];		
		break;
		
		case "fla":
			$titre_formulaire = $phrase_gene['TelechargerFlash'];
			$texte_intro_form = $phrase_gene['AttentionFlash'];
			$astuce_upload = $phrase_gene['AstuceUploadDoc'];
			$texte_description = $phrase_gene['DescriptionMedia'];
			$astuce_description = $phrase_gene['AstuceUploadDescri'];		
		break;	
	}
	
	
	$form = '<form name="telechargement" enctype="multipart/form-data" action="'.$_SERVER['PHP_SELF'].'?upl='.$format.'&ser='.$action.'" method="post">';
	$form .= '<fieldset>';
	$form .= '<legend>'.$titre_formulaire.'</legend>';
	$form .= '<h1>'.$titre_formulaire.'</h1>';
	$form .= '<p class="txtupload">'.$texte_intro_form.'</p>';
	
	if ( $action == "3" )
	{
			// ---------------------  Champ FICHIER
			$datas_upl = array(		"name" => "name_media",
														"value" => $values['name_media'],
														"tabindex" => "1",
														"class" => "champs_upload",
														"label" => $phrase_gene['NomFichier'],
														"astuce" => "",
														"largeur" => "20" );
			$form .= ecrire_balise("text",$datas_upl);			
	}
	else
	{
			// ---------------------  Champ FICHIER
			$datas_upl = array(		"name" => "fichier",
														"value" => $values['fichier'],
														"tabindex" => "1",
														"class" => "champs_upload",
														"label" => $phrase_gene['ChercherFichier'],
														"astuce" => $astuce_upload,
														"largeur" => "20" );
			$form .= ecrire_balise("file",$datas_upl);	
	}
	
	if ($action == "1" OR $action == "3")
	{
		// -------------------  CHAMP DESCRIPTION
		$datas_descri = array(		"name" => "description",
															"value" => $values['description'],
															"tabindex" => "2",
															"class" => "champs_upload",
															"label" => $texte_description,
															"astuce" => $astuce_description,
															"largeur" => "30" );
		$form .= ecrire_balise("text",$datas_descri);
	}
	
	if ($format == "img")
	{
		if ( $action == "1" OR $action == "3" )
		{
				// -------------------  CHAMP LEGENDE
				$datas_legende = array(		"name" => "legende",
																	"value" => $values['legende'],
																	"tabindex" => "3",
																	"class" => "champs_upload",
																	"label" => $phrase_gene['LegendePhoto'],
																	"astuce" => $phrase_gene['AstuceLegendePhoto'],
																	"largeur" => "30" );
				$form .= ecrire_balise("text",$datas_legende);

				// -------------------  CHAMP CREDITS
				$datas_credits = array(		"name" => "credits",
																	"value" => $values['credits'],
																	"tabindex" => "4",
																	"class" => "champs_upload",
																	"label" => $phrase_gene['CreditsPhoto'],
																	"astuce" => $phrase_gene['AstuceCreditsPhoto'],
																	"largeur" => "30" );
				$form .= ecrire_balise("text",$datas_credits);
		}
		if ( $action == "1" OR $action == "2" )
		{
			// -------------------  CHAMP LARGEUR
			$datas_width = array(		"name" => "largeur",
															"value" => $tab['LargeurImages'],
															"default" => $values['largeur'],
															"tabindex" => "5",
															"class" => "champs",
															"label" => $phrase_gene['LargeurImage'],
															"astuce" => $phrase_gene['AstuceLargeurImage'],
															"largeur" => "30" );
			$form .= ecrire_balise("select",$datas_width);
		}
	}
	else
	{
			// -------------------  CHAMP LARGEUR
			$datas_lg = array(	"name" => "langue",
													"value" => $tab_gene['Langues'],
													"default" => $values['langue'],
													"tabindex" => "6",
													"class" => "champs",
													"label" => $phrase_gene['LangueFichier'],
													"astuce" => "",
													"largeur" => "30" );
			$form .= ecrire_balise("select",$datas_lg);
	}

	
	// ------------  Champ CONTROLE
	$datas_controle = array(	"name" => "controle",
														"value" => "upload" );
	$form .= ecrire_balise("hidden",$datas_controle);
	
	
	// ------------  Champ POIDS FICHIER
	$datas_format = array(	"name" => "poids",
													"value" => $values['poids'] );
	$form .= ecrire_balise("hidden",$datas_format);
	
	
	// ------------  Champ FORMAT
	$datas_format = array(	"name" => "format",
													"value" => $format );
	$form .= ecrire_balise("hidden",$datas_format);
	
	
	// --------------  ENVOYER
	$datas_envoi = array(	"name" => "envoi",
												"value" => $mot_gene['Entrer'],
												"tabindex" => "7",
												"class" => "submit",
												"astuce" => "&nbsp;" );
	$form .= ecrire_balise("submit",$datas_envoi);
	
	$form .= '</fieldset>';
	$form .= '</form>';
	return $form;
}



function controle_avant_upload($fichier)
{
	$tab_gene = $GLOBALS['tab_gene'];
	
	$val = FALSE;
	if (!empty($fichier) )
	{
		if(in_array(substr($fichier, -3),$tab_gene['Extension'])) 
		{
			$val = TRUE;
		}
	}
	return $val;
}


function definir_repertoire_destination($nom_fichier,$format,$largeur)
{
	switch($format)
	{
		case "img":
			$infos_img = getimagesize($nom_fichier);
			if($largeur == 0 OR $largeur >= $infos_img[0] ) 
			{
				$repertoire = "upload/photos/";
			}		
			else
			{
				$repertoire = "upload/haute_def/";
			}
		break;
		
		case "doc":
			$repertoire = "upload/docs/";
		break;
		
		case "son":
			$repertoire = "upload/sons/";
		break;
		
		case "mov":
			$repertoire = "upload/movies/";
		break;
		
		case "fla":
			$repertoire = "upload/flash/";
		break;
	}
	return $repertoire;
}


// -------------------------------------------------
function code_insert_image($image,$alt,$legende,$largeur_bloc,$credits)
{
	$html = '<div class="img_txt" style="width:'.$largeur_bloc.'px;">';
	$html .= '<div><img src="'.URL.'upload/photos/'.$image.'" alt="'.$alt.'" /></div>';
	if (!empty($credits))
	{
		$html .= '<div class="credits_img">&copy; '.$credits.'</div>';
	}
	if (!empty($legende))
	{
		$html .= '<div class="legende_img">'.$legende.'</div>';
	}
	$html .= '</div>';
	return $html;
}


// -------------------------------------------------
function code_insert_doc($document,$langue,$texte)
{
	$html = '<a href="'.URL.'upload/documents/'.$document.'" hreflang="'.$langue.'" target="_blank" title="'.$texte.'" >';
	$html .= $texte.'</a>';
	return $html;
}


// -------------------------------------------------
function code_insert_son($document)
{
	$html = '<object type="application/x-shockwave-flash" data="'.URL.'plug-in/dewplayer.swf?son='.URL.'upload/sons/'.$document.'" width="200" height="20">';
	$html .= '<param name="movie" value="'.URL.'plug-in/dewplayer.swf?son='.URL.'upload/sons/'.$document.'" /> </object>';
	return $html;
}


// -------------------------------------------------
function ecrire_code_ajouter($format,$erreur_upl,$media,$description_media,$legende,$langue,$credits)
{
	$phrase_gene = $GLOBALS['phrase_gene'];
	$mot_gene = $GLOBALS['mot_gene'];
	
	
	if (!empty($erreur_upl))
	{
		$html = ecrire_erreur($phrase_gene['PrbUpload'].' '.$erreur_upl);
	}
	else
	{
		$html = ecrire_erreur($phrase_gene['ImageUploade']);
		$html .= '<p class="txtupload">'.$phrase_gene['CopiezCode'].'</p>';
		$html .= '<p class="txtupload"><textarea rows="5" cols="50">';
		switch($format)
		{
			case "img":
			$infos_img = getimagesize(URL.'upload/photos/'.$media);
			$largeur_bloc = $infos_img[0];
			$html .= code_insert_image($media,$description_media,$legende,$largeur_bloc,$credits);
			break;
			case "doc":
			$html .= code_insert_doc($media,$langue,$description_media);
			break;
			case "son":
			$html .= code_insert_son($media);
			break;
			default:
			$html .= $media;
			break;
		}
		$html .= '</textarea></p>';	
	}	
	return $html;
}
?>