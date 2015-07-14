<?php
function generer_liste_flux_rss($tab_flux)
{
	$val = FALSE;
	for ($i=0; $i<count($tab_flux); $i++)
	{
		generer_flux_rss($tab_flux[$i],$i);
	}
	return $val;
}


function generer_flux_rss($flux,$i)
{
		// instanciation
		$rss_news = new rss_write('');

		// definir le chemin vers la classe et les plugins
		$rss_news -> class_directory('librairie/lib_rss/');

		/*
				générer la requète qui va bien sur les tables adéquates pour récupérer les données
				On donne dans la requete :
				Titre = titre de l'item
				ID = id de l'item
				Texte = texte de l'item
				Date = Date de l'item
		*/
		connexion_base(SERVEUR,HOST,PASSWORD,BASE);
		$requete = $flux['rq_liste_donnees'];
		$result = mysql_query($requete);
		connexion_end();

		while($row = mysql_fetch_array($result))
		{
			$titre = htmlspecialchars(stripslashes($row['Titre']));
			$link = $flux['url_item'].$row['ID'].$flux['url_item_suite'];
			$description = htmlspecialchars(stripslashes($row['Texte']));
			
			$rss_news -> item($titre, $link, $description);
			$rss_news -> item_element('pubdate', $row['Date']);
			$rss_news -> item_element('modified', $row['Date']);
			$rss_news -> item_element('author', $flux['auteur']);
		}
				
		mysql_free_result($result);
					
		// les éléments obligatoires
		$rss_news -> rss('ISO-8859-1','fr');
		// définition du channel
		$rss_news -> channel($flux['auteur_site'],$flux['url_site'],$flux['titre_flux']);
		$rss_news -> channel_element('pubdate', date("Y-m-d H:i:s"));

		// si on veut définir un élément image
		if (!empty($flux['icone']))
		{
			$rss_news -> image( URL.'images/'.$flux['icone'], $flux['titre_flux'],$flux['url_site']);
			$size = getimagesize($flux['icone']);
			$rss_news -> image_element('height', $size[1]);
			$rss_news -> image_element('width', $size[0]);
		}

		/*
		 génération des flux
		 les formats sont les suivants :
		 atom03
		 atom10
		 rss20
		 rdf10
		*/
		
		$nom_fichier_xml = 'rss/flux-'.$flux['name'].$i.'.xml';
				
		if (!file_exists($nom_fichier_xml))
		{
			touch($nom_fichier_xml);
		}	
		$res = $rss_news -> save($nom_fichier_xml,$flux['format'],$erreur);
		if ($res) 
		{
			$val = TRUE;
		} 
		else 
		{
			$val = $erreur;
		}
		return $val;
}
?>