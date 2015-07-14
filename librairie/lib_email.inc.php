<?php
function envoyer_mail($to,$sujet,$msg,$header)
{
	$val = FALSE;
	if (mail($to,$sujet,$msg,$header))
	{
		$val = TRUE;
	}
	return $val;
}


function envoyer_message($valeurs)
{
	$phrase = $GLOBALS['phrase'];
	$mot = $GLOBALS['mot'];
	
	$To = TO_EMAIL;
	$Sujet = $phrase['UnMessageDuSite'];
	$Msg = $mot['Message']." : ".str_replace("\\","",$valeurs['Message'])."\n\n";
	$Msg .= $mot['Nom']." : ".$valeurs['Nom']."\n";
	$Msg .= $mot['Adresse']." : ".$valeurs['Adresse']."\n";
	$Msg .= $mot['Ville']." : ".$valeurs['CP']." ".$valeurs['Ville']."\n";
	$Msg .= $mot['Telephone']." : ".$valeurs['Tel']."\n";
	$Msg .= $mot['Email']." : ".$valeurs['Email']."\n";
	$Header = "FROM: ".FROM_NAME." <".FROM_EMAIL.">\n";
	return envoyer_mail($To,$Sujet,$Msg,$Header);
}


function envoyer_email($email_from,$name_from,$email_to,$email_reply,$subject_email,$tab_contenu)
{
	$val = TRUE;
	
	$mail = new PHPMailer();
	$mail->IsMail(); 
	$mail->From = $email_from;
	$mail->FromName = $name_from;
	$mail->AddAddress($email_to);
	$mail->AddReplyTo($email_reply);
	$mail->Subject = $subject_email;
		
	$body = '<table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF" summary="">';
	foreach ($tab_contenu as $mot => $texte)
	{
		$body .= '<tr>';
		$body .= '<td style="color:#000;font-size:11px;font-family:Verdana,Arial;">';
		if ( ($mot != "") OR (!is_numeric($mot)) )
		{
			$body .= '<strong>'.$mot.' </strong> ';
		}
		$body .= $texte.'</td>';
		$body .= '</tr>';
	}
	$body .= '</table>';
	
	foreach ($tab_contenu as $mot => $texte)
	{
		if ( ($mot != "") OR (!is_numeric($mot)) )
		{
			$text_body .= $mot.' : '.$texte.'\n';
		}
		else
		{
			$text_body .= $texte.'\n';
		}
	}				
				
	$mail->Body = $body;
	$mail->AltBody = $text_body;
	$mail->WordWrap = 50;
	$mail->Priority = 1;

	if(!$mail->Send())
	{
	   $val = FALSE;
	}
	return $val;
}
?>
