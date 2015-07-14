<?php
/*  
		############################################################################
		Outil d'administration de site internet 
		Author : Arnaud Meunier
		Version : 1.5
		Date : janvier 2007 
		############################################################################
*/


/*
	Function : Controle identifiation
	On controle que le login et le mot de passe sont bien dans la BD
	Si oui, on génére les variables de session
	Et on enregistre dans la table suivilog, l'accès à l'extranet
	Si non, on retourne False.
*/
function controle_identification($login,$password)
{
	$val = FALSE;
	if ($login != "" AND $password != "")
	{
		connexion_base(SERVEUR,HOST,PASSWORD,BASE);
		$requete = rq_existence_membre($login,$password);
    $rs = mysql_query($requete) or die(mysql_error());
    connexion_end();
    
		if (mysql_num_rows($rs) > 0)
		{
			$row = mysql_fetch_array($rs);
			$_SESSION['WA_USER'] = $row['ID'];
			$_SESSION['LANGUE_USER'] = $row['Langue'];
			$_SESSION['NIVEAU_USER'] = $row['Niveau'];
			
			connexion_base(SERVEUR,HOST,PASSWORD,BASE);
			$requete = rq_insert_suivilog($_SESSION['WA_USER'],$_SESSION['LANGUE_USER'],$_SESSION['NIVEAU_USER'],$_SERVER['REMOTE_ADDR']);
    	$rs = mysql_query($requete) or die();
    	connexion_end();	
    	$val = TRUE;
		}	
	}
	return $val;
}


// Function : Controle ouverture session
function controle_ouverture_session($id_session)
{
	$val = TRUE;
	return $val;
}


// On met en forme le formulaire d'identification
function ecrire_form_identif($valeurs)
{
	$phrase_gene = $GLOBALS['phrase_gene'];
	$mot_gene = $GLOBALS['mot_gene'];
	
	$form = '<form name="identification" action="'.$_SERVER['PHP_SELF'].'" method="post">';
	$form .= '<fieldset>';
	$form .= '<legend>'.$phrase_gene['AccesEspaceAdmin'].' '.NOM_SITE.'</legend>';
	
	$datas_login = array(	"name" => "login",
												"value" => $valeurs['login'],
												"tabindex" => "1",
												"class" => "champslogin",
												"label" => $phrase_gene['VotreLogin'] );
	$form .= ecrire_balise("text",$datas_login);
	
	$datas_pword = array(	"name" => "password",
												"value" => $valeurs['password'],
												"tabindex" => "2",
												"class" => "champslogin",
												"label" => $phrase_gene['VotreMotPasse'] );
	$form .= ecrire_balise("password",$datas_pword);
	
	$datas_envoi = array(	"name" => "envoi",
												"value" => $mot_gene['Entrer'],
												"tabindex" => "3",
												"class" => "submitlogin",
												"astuce" => "&nbsp;" );
	$form .= ecrire_balise("submit",$datas_envoi);
	
	$form .= '</fieldset>';
	$form .= '</form>';
	return $form;
}


// On écrit l'erreur d'identification
function ecrire_erreur_formulaire($phrase)
{
	$erreur = '<p class="txterror">'.$phrase.'</p>';
	return $erreur;
}

?>
