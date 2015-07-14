<?php

$tab_content = array(
	
	"home" => 		array(	"menu" => $mot['Accueil'],
          							"lien_menu" => URL_ADMIN,
          							"niveau_acces" => 1,
          							"query_list" => "" ),
										
	"news" => 	array(	"menu" => $mot['News'], // mot du dictionnaire
          						"lien_menu" => URL_ADMIN."?sec=news&amp;act=lst", // changer la variable de "sec="
          						"titre_page_les" => $phrase['DesNews'], // Pensez qu'avant il y a "La liste "
          						"titre_page_un" => $phrase['UneNews'], // Pensez qu'avant il y a "Ajouter" ou "Modifier"        						
											"nom_table" => "news", // nom de la table
          						"query_delete" => "rq_delete_news", // Nom de la fonction requete
          						"query_list" => "rq_liste_news", // Nom de la fonction requete
          						"form_datas" => "ecrire_form_news", // Nom de la fonction
          						"update_donnees" => "rq_db_news", // Nom de la fonction requete
          						"controle_donnees" => "controle_form_news", // Nom de la fonction 
											"insert_donnees" => "rq_insert_news", // Nom de la fonction requête
											"lien_media_doc" => URL.'upload/docs/', // adresse url pour les documents uploadés
											"lien_media_img" => URL.'upload/photos/', // adresse url des images uploadées
											"niveau_acces" => 2,
											"menu_secondaire" => $phrase['AjouterUneNews'],
											"lien_menu_secondaire" => URL_ADMIN."?sec=news&amp;act=add",
											"champ_affichage" => "Affichage",
											"cache" => "" ),

	"presse" => 	array(	"menu" => $mot['Presse'], // mot du dictionnaire
	          						"lien_menu" => URL_ADMIN."?sec=presse&amp;act=lst", // changer la variable de "sec="
	          						"titre_page_les" => $phrase['DesArticlesPresse'], // Pensez qu'avant il y a "La liste "
	          						"titre_page_un" => $phrase['UnArticlePresse'], // Pensez qu'avant il y a "Ajouter" ou "Modifier"        						
												"nom_table" => "presse", // nom de la table
	          						"query_delete" => "rq_delete_presse", // Nom de la fonction requete
	          						"query_list" => "rq_liste_presse", // Nom de la fonction requete
	          						"form_datas" => "ecrire_form_presse", // Nom de la fonction
	          						"update_donnees" => "rq_db_presse", // Nom de la fonction requete
	          						"controle_donnees" => "controle_form_presse", // Nom de la fonction 
												"insert_donnees" => "rq_insert_presse", // Nom de la fonction requête
												"lien_media_doc" => URL.'upload/docs/', // adresse url pour les documents uploadés
												"lien_media_img" => URL.'upload/photos/', // adresse url des images uploadées
												"niveau_acces" => 2,
												"menu_secondaire" => $phrase['AjouterUnArticlePresse'],
												"lien_menu_secondaire" => URL_ADMIN."?sec=presse&amp;act=add",
												"champ_affichage" => "Affichage",
												"orientation" => "portrait",
												"cache" => "" ),

	"produit" => 	array(	"menu" => $mot['Produits'], // mot du dictionnaire
	          						"lien_menu" => URL_ADMIN."?sec=produit&amp;act=lst", // changer la variable de "sec="
	          						"titre_page_les" => $phrase['DesProduits'], // Pensez qu'avant il y a "La liste "
	          						"titre_page_un" => $phrase['UnProduit'], // Pensez qu'avant il y a "Ajouter" ou "Modifier"        						
												"nom_table" => "produits", // nom de la table
	          						"query_delete" => "rq_delete_produit", // Nom de la fonction requete
	          						"query_list" => "rq_liste_produit", // Nom de la fonction requete
	          						"form_datas" => "ecrire_form_produit", // Nom de la fonction
	          						"update_donnees" => "rq_db_produit", // Nom de la fonction requete
	          						"controle_donnees" => "controle_form_produit", // Nom de la fonction 
												"insert_donnees" => "rq_insert_produit", // Nom de la fonction requête
												"lien_media_doc" => URL.'upload/docs/', // adresse url pour les documents uploadés
												"lien_media_img" => URL.'upload/photos/', // adresse url des images uploadées
												"niveau_acces" => 2,
												"menu_secondaire" => $phrase['AjouterUnProduit'],
												"lien_menu_secondaire" => URL_ADMIN."?sec=produit&amp;act=add",
												"champ_affichage" => "Affichage",
												"orientation" => "paysage",
												"cache" => "" ),

	"messages" => 	array(	"menu" => $mot['Messages'], // mot du dictionnaire
		          						"lien_menu" => URL_ADMIN."?sec=messages&amp;act=lst", // changer la variable de "sec="
		          						"titre_page_les" => $phrase['DesMessages'], // Pensez qu'avant il y a "La liste "
		          						"titre_page_un" => $phrase['UnMessage'], // Pensez qu'avant il y a "Ajouter" ou "Modifier"        						
													"nom_table" => "courrier", // nom de la table
		          						"query_delete" => "rq_delete_message", // Nom de la fonction requete
		          						"query_list" => "rq_liste_message", // Nom de la fonction requete
		          						"form_datas" => "ecrire_form_message", // Nom de la fonction
		          						"update_donnees" => "rq_db_message", // Nom de la fonction requete
		          						"controle_donnees" => "controle_form_message", // Nom de la fonction 
													"insert_donnees" => "rq_insert_message", // Nom de la fonction requête
													"lien_media_doc" => URL.'upload/docs/', // adresse url pour les documents uploadés
													"lien_media_img" => URL.'upload/photos/', // adresse url des images uploadées
													"niveau_acces" => 2,
													"menu_secondaire" => "",
													"lien_menu_secondaire" => "",
													"champ_affichage" => "",
													"cache" => "" ),
											
	"themes" => 	array(	"menu" => $mot['Themes'], // mot du dictionnaire
	          						"lien_menu" => URL_ADMIN."?sec=themes&amp;act=lst", // changer la variable de "sec="
	          						"titre_page_les" => $phrase['DesThemes'], // Pensez qu'avant il y a "La liste "
	          						"titre_page_un" => $phrase['UnTheme'], // Pensez qu'avant il y a "Ajouter" ou "Modifier"        						
												"nom_table" => "themes", // nom de la table
	          						"query_delete" => "rq_delete_themes", // Nom de la fonction requete
	          						"query_list" => "rq_liste_themes", // Nom de la fonction requete
	          						"form_datas" => "ecrire_form_themes", // Nom de la fonction
	          						"update_donnees" => "rq_db_themes", // Nom de la fonction requete
	          						"controle_donnees" => "controle_form_themes", // Nom de la fonction 
												"insert_donnees" => "rq_insert_themes", // Nom de la fonction requête
												"lien_media_doc" => URL.'upload/docs/', // adresse url pour les documents uploadés
												"lien_media_img" => URL.'upload/photos/', // adresse url des images uploadées
												"niveau_acces" => 2,
												"menu_secondaire" => $phrase['AjouterUnTheme'],
												"lien_menu_secondaire" => URL_ADMIN."?sec=themes&amp;act=add",
												"champ_affichage" => "Affichage",
												"cache" => "" ),

	"paypal" => 	array(	"menu" => $mot['Paiements'], // mot du dictionnaire
							"lien_menu" => URL_ADMIN."?sec=paypal&amp;act=lst", // changer la variable de "sec="
							"titre_page_les" => $phrase['DesPaiements'], // Pensez qu'avant il y a "La liste "
							"titre_page_un" => $phrase['UnPaiement'], // Pensez qu'avant il y a "Ajouter" ou "Modifier"        						
							"nom_table" => "paiements", // nom de la table
							"query_delete" => "rq_delete_paiements", // Nom de la fonction requete
							"query_list" => "rq_liste_paiements", // Nom de la fonction requete
							"form_datas" => "ecrire_form_paiements", // Nom de la fonction
							"update_donnees" => "rq_db_paiements", // Nom de la fonction requete
							"controle_donnees" => "controle_form_paiements", // Nom de la fonction 
							"insert_donnees" => "rq_insert_paiements", // Nom de la fonction requête
							"lien_media_doc" => URL.'upload/docs/', // adresse url pour les documents uploadés
							"lien_media_img" => URL.'upload/photos/', // adresse url des images uploadées
							"niveau_acces" => 2,
							"menu_secondaire" => $phrase['AjouterUnPaiement'],
							"lien_menu_secondaire" => URL_ADMIN."?sec=paypal&amp;act=add",
							"champ_affichage" => "",
							"cache" => "" )

										); 

?>