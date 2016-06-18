<?php
function creer_templates($section,$item,$parametres,$langue)
{
	// -----------------------------------------------------------------------
	// -----------------  Variables Globales
	// -----------------------------------------------------------------------
	$lien = $GLOBALS['lien'];
	$title = $GLOBALS['title'];
	$phrase = $GLOBALS['phrase'];
	$img = $GLOBALS['img'];
	$mot = $GLOBALS['mot'];
	$alt = $GLOBALS['alt'];
	$section = $GLOBALS['section'];

	// -----------------------------------------------------------------------
	// -----------------  Corps de la page
	// -----------------------------------------------------------------------
	$body = '<body>';
	$body .= '<div id="container">';
	
	// cadre de couleur
	$body .= '<div id="main_content">';
	$body .= '<div id="header">';

        // Facebooklike + language
	$body .= ecrire_reseau_sociaux($langue);
	$body .= ecrire_langue_version($langue);
        
	$body .= ecrire_slogan();
	$body .= ecrire_navigation_principale($section);
	$body .= '<div class="spacer">&nbsp;</div>';
	$body .= '</div>';
        
        if (isCollectionPage($item, $parametres)) {
            $class = 'main-collection';
        } else {
            $class = 'main-home';
        }
        
        $body .= '<div id="main" class="'.$class.'">';
	switch($section)
	{
            case "portrait":
                $body .= '<div id="portrait">';

                    if ($langue == "Fr")
                    {
                            $body .= lire_fichier('portrait.txt.php','textes/');
                    }
                    else
                    {
                            $body .= lire_fichier('portrait-en.txt.php','textes/');
                    }
                    $meta_title = $title['PagePortrait'];
                $body .= '</div>';
            break;

            case "services":
                $body .= '<div id="services">';
                    if ($langue == "Fr")
                    {
                            $body .= lire_fichier('services.txt.php','textes/');
                    }
                    else
                    {
                            $body .= lire_fichier('services-en.txt.php','textes/');
                    }
                    $meta_title = $title['PageServices'];
                $body .= '</div>';
            break;

            case "formes":
                $body .= '<div id="tailor-made">';
                    if ($langue == "Fr")
                    {
                        $body .= lire_fichier('tailor-made.php','textes/');
                    }
                    else
                    {
                        $body .= lire_fichier('tailor-made-en.php','textes/');
                    }
                    $body .= '</div>';
            break;

            case "presse":
                    $body .= '<div class="presse">';
                    //$body .= '<h1 class="titre_page">'.$phrase['RevuePresse'].'</h1>';
                    if ($item > 0)
                    {
                            $body .= ecrire_retombee_presse($item,$parametres);
                    }
                    else
                    {
                            $body .= ecrire_album_presse();
                    }
                    $body .= '</div>';
                    $meta_title = $title['PagePresse'];
            break;

            case "actualite":
                    $body .= ecrire_actualites($langue);
                    $meta_title = $title['PageActua'];
            break;

            case "collection":
                    if ($item > 0)
                    {
                            $body .= ecrire_themes_catalogue($langue,$parametres);
                            $body .= ecrire_fiche_produit($item,$langue,$parametres);
                            $meta_title = $title['PageFicheProduit'].' '.obtenir_title_produit($item,$langue);
                    }
                    else
                    {
                            if ($parametres > 0)
                            {
                                    $body .= ecrire_themes_catalogue($langue,$parametres);
                                    $body .= ecrire_catalogue($langue,$parametres);
                                    $meta_title = $title['PageThemeProduit'].' '.obtenir_title_theme($langue,$parametres);
                            }
                            else
                            {
                                    $body .= ecrire_intro_catalogue($langue);
                                    $meta_title = $title['PageCollection'];
                            }
                    }			
            break;

            case "contact":
                    $meta_title = $title['PageContact'];
                    //$body .= '<h1 class="titre_page">'.$phrase['DemandeInfoCommande'].'</h1>';
                    $body .= '<div id="form_contact">';
                    if (isset($_POST['controle']) AND $_POST['controle'] == "contact")
                    {
                            $valeurs = $_POST;
                            if (empty($valeurs['Message']) 
                                                    AND empty($valeurs['Nom']) 
                                                    AND empty($valeurs['Email']))
                            {
                                    $body .= ecrire_erreur($phrase['ChampsObligatoires']);
                            }
                            else
                            {
                                    if (verif_email($valeurs['Email']) != TRUE)
                                    {
                                            $body .= ecrire_erreur($phrase['EmailIncorrect']);
                                    }
                                    else
                                    {
                                            if (envoyer_message($valeurs) == TRUE)
                                            {
                                                    connexion_base(SERVEUR,HOST,PASSWORD,BASE);
                                                    $requete = rq_insert_message($valeurs);
                                                    mysql_query($requete) or die();
                                                    connexion_end();
                                                    $body .= ecrire_erreur($phrase['MessageEnvoye']);
                                            }
                                            else
                                            {
                                                    $body .= ecrire_erreur($phrase['PrbTechniqueEnvoi']);
                                            }			
                                    }
                            }
                    }
                    else
                    {
                            $valeurs = array();
                    }
                    
                    $body .= ecrire_form_contact($valeurs);
                    $body .= '</div>';
                    $meta_title = $title['PageContact'];
                    break;

            case "paiement_paypal":
            $body .= afficher_bouton_paypal($parametres,$item);
            break;
        
            case "conditions_ventes":
            $body .= lire_fichier('conditionsVentes.php','textes/');
            $meta_title = "Conditions Générales de Ventes";
            break;

            default:
                    $body .= entrer_dans_site($langue);
                    $meta_title = "";
            break;

	}
	$body .= '</div>';
	$body .= '</div>';
	
	// -----------------------------------------------------------------------
	// ----------------   Bandeau de bas de page - footer
	$body .= ecrire_footer();
	$body .= '</div>';
	$body .= '</body>';



	// -----------------------------------------------------------------------
	// -----------------  En-tête de page
	// -----------------  Balises Meta
	$lien_css = array(	"masson-v6.css" => "screen" );
	$head = ecrire_balise_head($meta_title,"","",$lien_css,"");					


	// -----------------------------------------------------------------------
	// ----------------   Compiler la page
	// -----------------------------------------------------------------------
	return ecrire_doctype_html($head,$body);
}

function isCollectionPage($item, $parametres) {
    return $item || $parametres;
}

?>