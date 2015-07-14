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
// Envoyer une inscription par email
function envoyer_inscription_mail($values)
{
	$mot = $GLOBALS['mot'];
	$phrase = $GLOBALS['phrase'];
	$val = FALSE;
	
	$contenu = array(	$mot['Cabinet'] => $values['Cabinet'],
						$mot['Nom'] => $values['Nom'],
						$mot['Prenom'] => $values['Prenom'],
						$mot['Adresse'] => $values['Adresse'],
						$mot['CP'] => $values['CP'],
						$mot['Ville'] => $values['Ville'],
						$mot['Tel'] => $values['Tel'],
						$mot['Email'] => $values['Email'],
						$mot['Commentaire'] => $values['Commentaire'] );
	$contenu_message = corps_email($contenu);
	
	// Si le message a bien été envoyé, on affiche un message de validation
	// et on enregistre le message dans la base de données
	if (envoi_email(EMAIL_ADMIN, NOM_SITE, EMAIL, $values['Email'], $phrase['UneNouvelleInscription'], $contenu_message) == TRUE)
	{
		if (ajouter_inscription_db($values) == TRUE)
		{
			$val = TRUE;
		}
	}
	return $val;
}


// ------------------------------------------------------------------------------------------------
// Envoyer un message (contact) par email
function envoyer_message_mail($values)
{
	$mot = $GLOBALS['mot'];
	$phrase = $GLOBALS['phrase'];
	$val = FALSE;
	
	if (verif_email($values['Email']) == TRUE)
	{
		$contenu = array(	$mot['Message'] => $values['Message'],
											$mot['Entreprise'] => $values['Entreprise'],
											$mot['Nom'] => $values['Nom'],
											$mot['Email'] => $values['Email'] );
							
		$contenu_message = corps_email($contenu);
		// Si le message a bien été envoyé, on affiche un message de validation
		// et on enregistre le message dans la base de données
		
		if (envoi_email($values['Email'], NOM_SITE, EMAIL, $values['Email'], $phrase['UnNouveauMessage'], $contenu_message) == TRUE)
		{
			if (ajouter_message_db($values) == TRUE)
			{
				$val = TRUE;
			}
		}
	}
	return $val;
}


// ------------------------------------------------------------------------------------------------
// Function : envoyer un email
function envoi_email($email_expediteur, $nom_expediteur, $email_destinataire, $email_retour, $sujet_email, $body_mail)
{
	$mail = new PHPMailer();
	$mail->IsMail();
	$mail->From = $email_expediteur;
	$mail->FromName = $nom_expediteur;
	$mail->AddAddress($email_destinataire);
	$mail->AddReplyTo($email_retour);
	$mail->IsHtml(true);
	$mail->Subject = $sujet_email;
	$mail->Body= $body_mail;
	
	if(!$mail->Send())
	{ 
	  	return FALSE;
	}
	else
	{	  
	 	return TRUE;
	}
}

function corps_email($message)
{
	$corps = '<table>';
	if (is_array($message))
	{
		foreach ($message as $un => $deux)
		{
			$corps .= '<tr>';
			$corps .= '<td>'.$un.'</td>';
			$corps .= '<td>'.$deux.'</td>';
			$corps .= '</tr>';
		}
	}
	else
	{
		$corps .= '<tr>';
		$corps .= '<td>'.$message.'</td>';
		$corps .= '</tr>';
	}
	$corps .= '</table>';
	return $corps;
}


function envoyer_email_simple($destinataire,$sujet,$msg,$expediteur)
{
  $val = FALSE;
  if (mail($destinataire,$sujet,$msg,$expediteur))
  {
		$val = TRUE;
  }
  return $val;
}
?>
