<?php
// --------------------------------------------------  News
function ecrire_form_news($section,$values)
{
	$phrase = $GLOBALS['phrase'];
	$mot = $GLOBALS['mot'];
	
	$form = '<form name="formtxt" action="" method="post">';
	$form .= '<legend>&nbsp;</legend>';

	
	// ------------  Champ TITRE
	$datas_titre = array(	"name" => "Titre",
												"value" => affichage_donnee($values['Titre']),
												"tabindex" => "1",
												"class" => "champs",
												"label" => $phrase['VotreTitre'],
												"astuce" => $phrase['AstuceTitre'] );
	$form .= ecrire_balise("text",$datas_titre);

	
	// ------------  Champ TEXTE
	$form .= ecrire_boutons_bbcode("formtxt","Texte");
	$datas_texte = array(	"name" => "Texte",
												"value" => affichage_donnee($values['Texte']),
												"tabindex" => "2",
												"class" => "champs",
												"label" => $phrase['VotreTexte'],
												"astuce" => $phrase['AstuceTexte'],
												"hauteur" => "9" );
	$form .= ecrire_balise("textarea",$datas_texte);

	
	// ------------  Champ DATEDEBUT
  if (empty($values['DateDebut']))
  {
    $values['DateDebut'] = date("Y-m-d");
  }
	$datas_date = array(	"name" => "DateDebut",
												"value" => retourner_date($values['DateDebut']),
												"tabindex" => "3",
												"class" => "champsdate",
												"label" => $phrase['DateDebut'],
												"astuce" => $phrase['AstuceDateDuBillet'] );
	$form .= ecrire_balise("text",$datas_date);


	// ------------  Champ DATEFIN
  if (empty($values['DateFin']))
  {
    $values['DateFin'] = date("Y-m-d");
  }
	$datas_fin = array(	"name" => "DateFin",
												"value" => retourner_date($values['DateFin']),
												"tabindex" => "4",
												"class" => "champsdate",
												"label" => $phrase['DateFin'],
												"astuce" => $phrase['AstuceDateDuBillet'] );
	$form .= ecrire_balise("text",$datas_fin);

	// ------------  Champ LANGUE
	$valeurs_langue = array( 	"Fr" => $mot['Francais'],
														"En" => $mot['Anglais'] );
	$datas_langue	 = array(	"name" => "Langue",
														"value" => $valeurs_langue,
														"default" => $values['Langue'],
														"tabindex" => "5",
														"class" => "champsdate",
														"label" => $mot['Langue'],
														"astuce" => "" );
	$form .= ecrire_balise("select", $datas_langue);	
	
	// ------------  Champ AFFICHAGE
	$valeurs_affichage = array( "yes" => $phrase['EnLigne'],
															"no" => $phrase['HorsLigne'] );
	$datas_affichage = array(	"name" => "Affichage",
														"value" => $valeurs_affichage,
														"default" => $values['Affichage'],
														"tabindex" => "5",
														"class" => "champsdate",
														"label" => $mot['Affichage'],
														"astuce" => "" );
	$form .= ecrire_balise("select", $datas_affichage);	

	// ------------  Champ CONTROLE
	$datas_controle = array(	"name" => "controle",
														"value" => $section );
	$form .= ecrire_balise("hidden",$datas_controle);

	// ------------  Champ ID
	$datas_id = array(	"name" => "ID",
											"value" => $values['ID'] );
	$form .= ecrire_balise("hidden",$datas_id);
	
	// ------------  Champ ENVOI
	$datas_envoi = array(	"name" => "envoi",
												"value" => $mot['Envoyer'],
												"tabindex" => "6",
												"class" => "submit" );
	$form .= ecrire_balise("submit",$datas_envoi);

	$form .= '</form>';
	return $form;
}


function controle_form_news($valeurs)
{
	$controle = TRUE;
	if (empty($valeurs['Titre'])
			AND empty($valeurs['Texte']) )
	{
		$controle = FALSE;
	}
	return $controle;
}	


// --------------------------------------------------  Thèmes
function ecrire_form_themes($section,$values)
{
	$phrase = $GLOBALS['phrase'];
	$mot = $GLOBALS['mot'];
	
	$form = '<form name="formtxt" action="" method="post">';
	$form .= '<legend>&nbsp;</legend>';

	
	// ------------  Champ TITREFR
	$datas_titreFr = array(	"name" => "TitreFr",
													"value" => affichage_donnee($values['TitreFr']),
													"tabindex" => "1",
													"class" => "champs",
													"label" => $phrase['VotreTitre'],
													"astuce" => $phrase['EnFrançais'] );
	$form .= ecrire_balise("text",$datas_titreFr);
	
	// ------------  Champ TITREEN
	$datas_titreEn = array(	"name" => "TitreEn",
													"value" => affichage_donnee($values['TitreEn']),
													"tabindex" => "2",
													"class" => "champs",
													"label" => $phrase['VotreTitre'],
													"astuce" => $phrase['EnAnglais'] );
	$form .= ecrire_balise("text",$datas_titreEn);

	// ------------  Champ CLASSEMENT
	$datas_classement = array(	"name" => "Classement",
															"value" => affichage_donnee($values['Classement']),
															"tabindex" => "3",
															"class" => "champsdate",
															"label" => $phrase['Classement'],
															"astuce" => $phrase['AstuceClassement'] );
	$form .= ecrire_balise("text",$datas_classement);

	// ------------  Champ IMAGE
	$datas_image = array(	"name" => "Image",
												"value" => affichage_donnee($values['Image']),
												"tabindex" => "4",
												"class" => "champsdate",
												"upload" => "img",
												"label" => $phrase['ImageTheme'],
												"astuce" => $phrase['AstuceImage'] );
	$form .= ecrire_balise("text",$datas_image);

	// ------------  Champ HOMEPAGE
	$valeurs_home = array( 	"yes" => $phrase['OuiPageAccueil'],
													"no" => $phrase['NonPageAccueil'] );
	$datas_home = array(	"name" => "HomePage",
												"value" => $valeurs_home,
												"default" => $values['HomePage'],
												"tabindex" => "4",
												"class" => "champs",
												"label" => $phrase['PageAccueil'],
												"astuce" => $phrase['AstucePageAccueil'] );
	$form .= ecrire_balise("select", $datas_home);	
	
	// ------------  Champ AFFICHAGE
	$valeurs_affichage = array( "yes" => $phrase['EnLigne'],
															"no" => $phrase['HorsLigne'] );
	$datas_affichage = array(	"name" => "Affichage",
														"value" => $valeurs_affichage,
														"default" => $values['Affichage'],
														"tabindex" => "4",
														"class" => "champsdate",
														"label" => $mot['Affichage'],
														"astuce" => "" );
	$form .= ecrire_balise("select", $datas_affichage);	
	
	// ------------  Champ CONTROLE
	$datas_controle = array(	"name" => "controle",
														"value" => $section );
	$form .= ecrire_balise("hidden",$datas_controle);


	// ------------  Champ ID
	$datas_id = array(	"name" => "ID",
											"value" => $values['ID'] );
	$form .= ecrire_balise("hidden",$datas_id);

	
	// ------------  Champ ENVOI
	$datas_envoi = array(	"name" => "envoi",
												"value" => $mot['Envoyer'],
												"tabindex" => "6",
												"class" => "submit" );
	$form .= ecrire_balise("submit",$datas_envoi);

	$form .= '</form>';
	return $form;
}


function controle_form_themes($valeurs)
{
	$controle = TRUE;
	if (empty($valeurs['TitreFr'])
			AND empty($valeurs['Affichage']) )
	{
		$controle = FALSE;
	}
	return $controle;
}	



// --------------------------------------------------  Presse
function ecrire_form_presse($section,$values)
{
	$phrase = $GLOBALS['phrase'];
	$mot = $GLOBALS['mot'];
	
	$form = '<form name="formtxt" action="" method="post">';
	$form .= '<legend>&nbsp;</legend>';

	
	// ------------  Champ REVUE
	$datas_revue = array(	"name" => "Revue",
												"value" => affichage_donnee($values['Revue']),
												"tabindex" => "1",
												"class" => "champs",
												"label" => $phrase['NomRevue'],
												"astuce" => "" );
	$form .= ecrire_balise("text",$datas_revue);

	
	// ------------  Champ DATE PUBLICATION
	$datas_date = array(	"name" => "DatePublication",
													"value" => affichage_donnee($values['DatePublication']),
													"tabindex" => "2",
													"class" => "champs",
													"label" => $phrase['DatePublication'],
													"astuce" => "" );
	$form .= ecrire_balise("text",$datas_date);


	// ------------  Champ COUVERTURE
	$datas_couverture = array(	"name" => "Couverture",
															"value" => affichage_donnee($values['Couverture']),
															"tabindex" => "3",
															"class" => "champsdate",
															"upload" => "img",
															"label" => $phrase['Couverture'],
															"astuce" => $phrase['AstuceCouverture'] );
	$form .= ecrire_balise("text",$datas_couverture);


	// ------------  Champ PAGE1
	$datas_page1 = array(	"name" => "Page1",
												"value" => affichage_donnee($values['Page1']),
												"tabindex" => "4",
												"class" => "champsdate",
												"upload" => "img",
												"label" => $phrase['ArticleRevue'],
												"astuce" => $phrase['AstuceArticleRevue'] );
	$form .= ecrire_balise("text",$datas_page1);


	// ------------  Champ PAGE2
	$datas_page2 = array(	"name" => "Page2",
												"value" => affichage_donnee($values['Page2']),
												"tabindex" => "5",
												"class" => "champsdate",
												"upload" => "img",
												"label" => $phrase['ArticleRevue'],
												"astuce" => $phrase['AstuceArticleRevue'] );
	$form .= ecrire_balise("text",$datas_page2);

	// ------------  Champ PAGE3
	$datas_page3 = array(	"name" => "Page3",
												"value" => affichage_donnee($values['Page3']),
												"tabindex" => "6",
												"class" => "champsdate",
												"upload" => "img",
												"label" => $phrase['ArticleRevue'],
												"astuce" => $phrase['AstuceArticleRevue'] );
	$form .= ecrire_balise("text",$datas_page3);

	// ------------  Champ PAGE4
	$datas_page4 = array(	"name" => "Page4",
												"value" => affichage_donnee($values['Page4']),
												"tabindex" => "7",
												"class" => "champsdate",
												"upload" => "img",
												"label" => $phrase['ArticleRevue'],
												"astuce" => $phrase['AstuceArticleRevue'] );
	$form .= ecrire_balise("text",$datas_page4);

	
	// ------------  Champ AFFICHAGE
	$valeurs_affichage = array( "yes" => $phrase['EnLigne'],
															"no" => $phrase['HorsLigne'] );
	$datas_affichage = array(	"name" => "Affichage",
														"value" => $valeurs_affichage,
														"default" => $values['Affichage'],
														"tabindex" => "4",
														"class" => "champsdate",
														"label" => $mot['Affichage'],
														"astuce" => "" );
	$form .= ecrire_balise("select", $datas_affichage);	

	
	// ------------  Champ CONTROLE
	$datas_controle = array(	"name" => "controle",
														"value" => $section );
	$form .= ecrire_balise("hidden",$datas_controle);


	// ------------  Champ ID
	$datas_id = array(	"name" => "ID",
											"value" => $values['ID'] );
	$form .= ecrire_balise("hidden",$datas_id);

	
	// ------------  Champ ENVOI
	$datas_envoi = array(	"name" => "envoi",
												"value" => $mot['Envoyer'],
												"tabindex" => "8",
												"class" => "submit" );
	$form .= ecrire_balise("submit",$datas_envoi);

	$form .= '</form>';
	return $form;
}


function controle_form_presse($valeurs)
{
	$controle = TRUE;
	if (empty($valeurs['Revue'])
			AND empty($valeurs['Couverture']) )
	{
		$controle = FALSE;
	}
	return $controle;
}	



// --------------------------------------------------  Produits
function ecrire_form_produit($section,$values)
{
	$phrase = $GLOBALS['phrase'];
	$mot = $GLOBALS['mot'];
	
	$form = '<form name="formtxt" action="" method="post">';
	$form .= '<legend>&nbsp;</legend>';

	
	// ------------  Champ NOM FR
	$datas_NomFr = array(	"name" => "NomFr",
												"value" => affichage_donnee($values['NomFr']),
												"tabindex" => "1",
												"class" => "champs",
												"label" => $phrase['NomProduit'],
												"astuce" => $phrase['AstuceFrancais'] );
	$form .= ecrire_balise("text",$datas_NomFr);


	// ------------  Champ NOM EN
	$datas_NomEn = array(	"name" => "NomEn",
												"value" => affichage_donnee($values['NomEn']),
												"tabindex" => "2",
												"class" => "champs",
												"label" => $phrase['NomProduit'],
												"astuce" => $phrase['AstuceAnglais'] );
	$form .= ecrire_balise("text",$datas_NomEn);

	
	// ------------  Champ TEXTE FR
	$form .= ecrire_boutons_bbcode("formtxt","DescriptionFr");
	$datas_texteFr = array(	"name" => "DescriptionFr",
													"value" => affichage_donnee($values['DescriptionFr']),
													"tabindex" => "3",
													"class" => "champs",
													"label" => $phrase['VotreTexte'],
													"astuce" => $phrase['AstuceFrancais'],
													"hauteur" => "4" );
	$form .= ecrire_balise("textarea",$datas_texteFr);


	// ------------  Champ TEXTE EN
	$form .= ecrire_boutons_bbcode("formtxt","DescriptionEn");
	$datas_texteEn = array(	"name" => "DescriptionEn",
													"value" => affichage_donnee($values['DescriptionEn']),
													"tabindex" => "4",
													"class" => "champs",
													"label" => $phrase['VotreTexte'],
													"astuce" => $phrase['AstuceAnglais'],
													"hauteur" => "4" );
	$form .= ecrire_balise("textarea",$datas_texteEn);

	// ------------  Champ MOTS CLES FR
	$datas_motsFr = array(	"name" => "MotsClesFr",
													"value" => affichage_donnee($values['MotsClesFr']),
													"tabindex" => "5",
													"class" => "champs",
													"label" => $phrase['MotsCles'],
													"astuce" => $phrase['AstuceFrancais'],
													"hauteur" => "3" );
	$form .= ecrire_balise("textarea",$datas_motsFr);

	// ------------  Champ MOTS CLES EN
	$datas_motsEn = array(	"name" => "MotsClesEn",
													"value" => affichage_donnee($values['MotsClesEn']),
													"tabindex" => "6",
													"class" => "champs",
													"label" => $phrase['MotsCles'],
													"astuce" => $phrase['AstuceAnglais'],
													"hauteur" => "3" );
	$form .= ecrire_balise("textarea",$datas_motsEn);
	
	// ------------  Champ PRIX
	$datas_prix = array(	"name" => "Prix",
												"value" => affichage_donnee($values['Prix']),
												"tabindex" => "7",
												"class" => "champsdate",
												"label" => $phrase['Prix'],
												"astuce" => $phrase['AstuceMontant'] );
	$form .= ecrire_balise("text",$datas_prix);

	// ------------  Champ CLASSEMENT
	$datas_classement = array(	"name" => "Classement",
												"value" => affichage_donnee($values['Classement']),
												"tabindex" => "7",
												"class" => "champsdate",
												"label" => $phrase['Classement'],
												"astuce" => "" );
	$form .= ecrire_balise("text",$datas_classement);
	
	// ------------  Champ PHOTO
	$datas_photo = array(	"name" => "Photo",
												"value" => affichage_donnee($values['Photo']),
												"tabindex" => "8",
												"class" => "champsdate",
												"upload" => "img",
												"label" => $mot['Photo'],
												"astuce" => $phrase['AstuceArticleRevue'] );
	$form .= ecrire_balise("text",$datas_photo);

	// ------------  Champ THEME
	$liste_themes = transformer_row_en_tableau(rq_liste_themes_menu());
	$datas_themes = array(	"name" => "Theme",
													"value" => $liste_themes,
													"default" => $values['Theme'],
													"tabindex" => "9",
													"class" => "champs",
													"label" => $mot['Rubrique'],
													"astuce" => "" );
	$form .= ecrire_balise("select", $datas_themes);	
		
	// ------------  Champ AFFICHAGE
	$valeurs_affichage = array( "yes" => $phrase['EnLigne'],
															"no" => $phrase['HorsLigne'] );
	$datas_affichage = array(	"name" => "Affichage",
														"value" => $valeurs_affichage,
														"default" => $values['Affichage'],
														"tabindex" => "10",
														"class" => "champsdate",
														"label" => $mot['Affichage'],
														"astuce" => "" );
	$form .= ecrire_balise("select", $datas_affichage);	
	
	// ------------  Champ CONTROLE
	$datas_controle = array(	"name" => "controle",
														"value" => $section );
	$form .= ecrire_balise("hidden",$datas_controle);

	// ------------  Champ ID
	$datas_id = array(	"name" => "ID",
											"value" => $values['ID'] );
	$form .= ecrire_balise("hidden",$datas_id);

	// ------------  Champ ENVOI
	$datas_envoi = array(	"name" => "envoi",
												"value" => $mot['Envoyer'],
												"tabindex" => "11",
												"class" => "submit" );
	$form .= ecrire_balise("submit",$datas_envoi);

	$form .= '</form>';
	return $form;
}


function controle_form_produit($valeurs)
{
	$controle = TRUE;
	if (empty($valeurs['NomFr'])
			AND empty($valeurs['Photo']) )
	{
		$controle = FALSE;
	}
	return $controle;
}	



// --------------------------------------------------  Messages
function ecrire_form_message($section,$values)
{
	$phrase = $GLOBALS['phrase'];
	$mot = $GLOBALS['mot'];
	
	$form = '<form name="formtxt" action="" method="post">';
	$form .= '<legend>&nbsp;</legend>';
	
	// ------------  Champ DATE ENVOI
	$datas_date = array(	"name" => "DateEnvoi",
												"value" => retourner_date($values['DateEnvoi']),
												"tabindex" => "1",
												"class" => "champs",
												"label" => $phrase['DateEnvoi'],
												"astuce" => "" );
	$form .= ecrire_balise("text",$datas_date);

	// ------------  Champ MESSAGE
	$datas_Message = array(	"name" => "Message",
													"value" => affichage_donnee($values['Message']),
													"tabindex" => "2",
													"class" => "champs",
													"hauteur" => "8",
													"label" => $mot['Message'],
													"astuce" => "" );
	$form .= ecrire_balise("textarea",$datas_Message);

	// ------------  Champ NOM
	$datas_Nom = array(	"name" => "Nom",
											"value" => affichage_donnee($values['Nom']),
											"tabindex" => "3",
											"class" => "champs",
											"label" => $mot['Nom'],
											"astuce" => "" );
	$form .= ecrire_balise("text",$datas_Nom);

	// ------------  Champ ADRESSE
	$datas_Adresse = array(	"name" => "Adresse",
													"value" => affichage_donnee($values['Adresse']),
													"tabindex" => "4",
													"class" => "champs",
													"label" => $mot['Adresse'],
													"astuce" => "" );
	$form .= ecrire_balise("text",$datas_Adresse);

	// ------------  Champ CP
	$datas_CP = array(	"name" => "CP",
											"value" => affichage_donnee($values['CP']),
											"tabindex" => "5",
											"class" => "champsdate",
											"label" => $mot['CP'],
											"astuce" => "" );
	$form .= ecrire_balise("text",$datas_CP);

	// ------------  Champ VILLE
	$datas_Ville = array(	"name" => "Ville",
												"value" => affichage_donnee($values['Ville']),
												"tabindex" => "6",
												"class" => "champs",
												"label" => $mot['Ville'],
												"astuce" => "" );
	$form .= ecrire_balise("text",$datas_Ville);
	
	// ------------  Champ TEL
	$datas_Tel = array(	"name" => "Tel",
											"value" => affichage_donnee($values['Tel']),
											"tabindex" => "7",
											"class" => "champs",
											"label" => $mot['Tel'],
											"astuce" => "" );
	$form .= ecrire_balise("text",$datas_Tel);

	// ------------  Champ EMAIL
	$datas_Email = array(	"name" => "Email",
												"value" => affichage_donnee($values['Email']),
												"tabindex" => "8",
												"class" => "champs",
												"label" => $mot['Email'],
												"astuce" => "" );
	$form .= ecrire_balise("text",$datas_Email);
	
	// ------------  Champ CONTROLE
	$datas_controle = array(	"name" => "controle",
														"value" => $section );
	$form .= ecrire_balise("hidden",$datas_controle);

	// ------------  Champ ID
	$datas_id = array(	"name" => "ID",
											"value" => $values['ID'] );
	$form .= ecrire_balise("hidden",$datas_id);

	// ------------  Champ ENVOI
	$datas_envoi = array(	"name" => "envoi",
												"value" => $mot['Envoyer'],
												"tabindex" => "11",
												"class" => "submit" );
	$form .= ecrire_balise("submit",$datas_envoi);

	$form .= '</form>';
	return $form;
}


function controle_form_message($valeurs)
{
	$controle = TRUE;
	if (empty($valeurs['Email'])
			AND empty($valeurs['Message']) )
	{
		$controle = FALSE;
	}
	return $controle;
}



// --------------------------------------------------  Paiements
function ecrire_form_paiements($section,$values)
{
	$phrase = $GLOBALS['phrase'];
	$mot = $GLOBALS['mot'];
	
	$form = '<form name="formtxt" action="" method="post">';
	$form .= '<legend>&nbsp;</legend>';

	
	// ------------  Champ NOM
	$datas_nom = array(	"name" => "Nom",
						"value" => affichage_donnee($values['Nom']),
						"tabindex" => "",
						"class" => "champs",
						"label" => $phrase['VotreNom'],
						"astuce" => "" );
	$form .= ecrire_balise("text",$datas_nom);

	// ------------  Champ PRENOM
	$datas_prenom = array(	"name" => "Prenom",
							"value" => affichage_donnee($values['Prenom']),
							"tabindex" => "",
							"class" => "champs",
							"label" => $phrase['VotrePrenom'],
							"astuce" => "" );
	$form .= ecrire_balise("text",$datas_prenom);

	// ------------  Champ ADRESSE
	$datas_adr = array(	"name" => "Adresse",
						"value" => affichage_donnee($values['Adresse']),
						"tabindex" => "",
						"class" => "champs",
						"label" => $phrase['VotreAdresse'],
						"astuce" => "" );
	$form .= ecrire_balise("text",$datas_adr);

	// ------------  Champ CP
	$datas_cp = array(	"name" => "CP",
						"value" => affichage_donnee($values['CP']),
						"tabindex" => "",
						"class" => "champs",
						"label" => $phrase['VotreCP'],
						"astuce" => "" );
	$form .= ecrire_balise("text",$datas_cp);

	// ------------  Champ VILLE
	$datas_ville = array(	"name" => "Ville",
							"value" => affichage_donnee($values['Ville']),
							"tabindex" => "",
							"class" => "champs",
							"label" => $phrase['VotreVille'],
							"astuce" => "" );
	$form .= ecrire_balise("text",$datas_ville);

	// ------------  Champ EMAIL
	$datas_email = array(	"name" => "Email",
							"value" => affichage_donnee($values['Email']),
							"tabindex" => "",
							"class" => "champs",
							"label" => $phrase['VotreEmail'],
							"astuce" => "" );
	$form .= ecrire_balise("text",$datas_email);

	// ------------  Champ Objet
	$datas_objet = array(	"name" => "Objet",
							"value" => affichage_donnee($values['Objet']),
							"tabindex" => "",
							"class" => "champs",
							"label" => $phrase['VotreObjet'],
							"astuce" => "" );
	$form .= ecrire_balise("text",$datas_objet);

	// ------------  Champ MONTANT
	$datas_montant = array(	"name" => "Montant",
							"value" => affichage_donnee($values['Montant']),
							"tabindex" => "",
							"class" => "champsdate",
							"label" => $phrase['VotreMontant'],
							"astuce" => "" );
	$form .= ecrire_balise("text",$datas_montant);
	
	// ------------  Champ DATEPAIEMENT
	if (empty($values['DatePaiement']))
	{
		$values['DatePaiement'] = date("Y-m-d");
	}
	$datas_date = array(	"name" => "DatePaiement",
							"value" => retourner_date($values['DatePaiement']),
							"tabindex" => "3",
							"class" => "champsdate",
							"label" => $phrase['DatePaiement'],
							"astuce" => "" );
	$form .= ecrire_balise("text",$datas_date);

	// ------------  Champ CONTROLE
	$datas_controle = array(	"name" => "controle",
								"value" => $section );
	$form .= ecrire_balise("hidden",$datas_controle);

	// ------------  Champ ID
	$datas_id = array(	"name" => "ID",
						"value" => $values['ID'] );
	$form .= ecrire_balise("hidden",$datas_id);
	
	// ------------  Champ ENVOI
	$datas_envoi = array(	"name" => "envoi",
							"value" => $mot['Envoyer'],
							"tabindex" => "",
							"class" => "submit" );
	$form .= ecrire_balise("submit",$datas_envoi);

	$form .= '</form>';
	return $form;
}


function controle_form_paiements($valeurs)
{
	$controle = TRUE;
	if (empty($valeurs['Montant'])
			AND empty($valeurs['Nom']) )
	{
		$controle = FALSE;
	}
	return $controle;
}	

?>