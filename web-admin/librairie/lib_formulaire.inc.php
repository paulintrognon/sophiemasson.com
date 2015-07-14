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
// Function : La balise texte
function balise_text($datas)
{
	$balise = '<input type="text" name="'.$datas['name'].'" id="'.$datas['name'].'" ';
	$balise .= 'class="'.$datas['class'].'" value="'.$datas['value'].'" size="5" tabindex="'.$datas['tabindex'].'" />';
	return $balise;
}


// ------------------------------------------------------------------------------------------------
// Function : La balise file
function balise_file($datas)
{
	$balise = '<input type="file" name="'.$datas['name'].'" id="'.$datas['name'].'" ';
	$balise .= 'class="'.$datas['class'].'" value="'.$datas['value'].'" size="'.$datas['largeur'].'" tabindex="'.$datas['tabindex'].'" />';
	return $balise;
}


// ------------------------------------------------------------------------------------------------
// Function : La balise password
function balise_password($datas)
{
	$balise = '<input type="password" name="'.$datas['name'].'" id="'.$datas['name'].'" ';
	$balise .= 'class="'.$datas['class'].'" value="'.$datas['value'].'" tabindex="'.$datas['tabindex'].'" />';
	return $balise;
}


// ------------------------------------------------------------------------------------------------
// Function : La balise textarea
function balise_textarea($datas)
{
	$balise = '<textarea name="'.$datas['name'].'" id="'.$datas['name'].'" rows="'.$datas['hauteur'].'" ';
	$balise .= ' class="'.$datas['class'].'" tabindex="'.$datas['tabindex'].'">'.$datas['value'].'</textarea>';
	return $balise;
}


// ------------------------------------------------------------------------------------------------
// Function : La balise cachée
function balise_hidden($datas)
{
	$balise = '<input type="hidden" name="'.$datas['name'].'" id="'.$datas['name'].'" value="'.$datas['value'].'" />';
	return $balise;
}


// ------------------------------------------------------------------------------------------------
// Function : La balise checkbox
function balise_box($datas)
{
	$balise = '<input type="checkbox" name="'.$datas['name'].'" id="'.$datas['name'].'" value="'.$datas['value'].'" ';
	if ($datas['value'] == $datas['default'])
	{
		$balise .= ' checked="checked" ';
	}
	$balise .= ' />';
	return $balise;
}


// ------------------------------------------------------------------------------------------------
// Function : La balise submit
function balise_submit($datas)
{
	$balise = '<input type="submit" name="'.$datas['name'].'" id="'.$datas['name'].'" ';
	$balise .= 'value="'.$datas['value'].'" class="'.$datas['class'].'" tabindex="'.$datas['tabindex'].'" />';
	return $balise;
}


// ------------------------------------------------------------------------------------------------
// Function : La balise select
function balise_select($datas)
{
	$balise = '<select name="'.$datas['name'].'" id="'.$datas['name'].'" class="'.$datas['class'].'" tabindex="'.$datas['tabindex'].'">';
	foreach($datas['value'] as $indice => $element)
	{
		$balise .= '<option value="'.$indice.'" ';
		if ($indice == $datas['default'])
		{
			$balise .= ' selected="selected" ';
		}
		$balise .= '>'.$element.'</option>';
	}
	$balise .= '</select>';
	return $balise;
}


// ------------------------------------------------------------------------------------------------
// Function : La balise select avec optgroup
function balise_select_optgroup($datas)
{
	$balise = '<select name="'.$datas['name'].'" id="'.$datas['name'].'" class="'.$datas['class'].'" tabindex="'.$datas['tabindex'].'">';
	$old_theme = "";
	$compteur = 0;
	for($i=0; $i<count($datas['value']); $i++)
	{
		$new_theme = $datas['value'][$i]['theme'];
		if ($old_theme != $new_theme)
		{
			if ($compteur > 0)
			{
				$balise .= '</optgroup>';
			}
			$balise .= '<optgroup label="'.$new_theme.'">';
		}
		$balise .= '<option value="'.$datas['value'][$i]['entite'].'"';
		if ($datas['value'][$i]['entite'] == $datas['default'])
		{
			$balise .= ' selected="selected" ';
		}
		$balise .= '>'.$datas['value'][$i]['nom'].'</option>';
		$compteur = 1;
		$old_theme = $new_theme;
	}
	$balise .= '</optgroup>';
	$balise .= '</select>';
	return $balise;
}




// ------------------------------------------------------------------------------------------------
// Function : Ecrire une balise
function ecrire_balise($nature,$datas)
{
	$mot_gene = $GLOBALS['mot_gene'];
	$balise = '';
	
	switch ($nature)
	{
		
		case "text":
		$balise .= '<div>';
		$balise .= '<span class="intitule"><label for="'.$datas['name'].'">'.$datas['label'].' : </label></span>';
		$balise .= '<span class="balise">'.balise_text($datas);
		if (!empty($datas['upload']))
		{
			$balise .= '<a href="#" onclick="window.open(\''.URL.'index.php?upl='.$datas['upload'].'&ser=2\',\'image\',\'width=720, height=600, statut=0, toolbar=0, location=0, menubar=0, scrollbars=1\');">';
			$balise .= $mot_gene['Telecharger'].'</a>';
		}
		$balise .= '</span>';
		if (isset($datas['astuce']) AND $datas['astuce'] != "")
		{
			$balise .= '<span class="astuce">'.$datas['astuce'].'</span>';
		}
		$balise .= '</div>';
		break;
		
		
		case "file":
		$balise .= '<div>';
		$balise .= '<span class="intitule"><label for="'.$datas['name'].'">'.$datas['label'].' : </label></span>';
		$balise .= '<span class="balise">'.balise_file($datas).'</span>';
		if (isset($datas['astuce']) AND $datas['astuce'] != "")
		{
			$balise .= '<span class="astuce">'.$datas['astuce'].'</span>';
		}
		$balise .= '</div>';
		break;
		
		
		case "password":
		$balise .= '<div>';
		$balise .= '<span class="intitule"><label for="'.$datas['name'].'">'.$datas['label'].' : </label></span>';
		$balise .= '<span class="balise">'.balise_password($datas).'</span>';
		if (isset($datas['astuce']) AND $datas['astuce'] != "")
		{
			$balise .= '<span class="astuce">'.$datas['astuce'].'</span>';
		}
		$balise .= '</div>';
		break;
		
		
		case "hidden":
		$balise .= balise_hidden($datas);
		break;
		case "submit":
		$balise .= '<div>';
		$balise .= '<span class="intitule">&nbsp;</span>';
		$balise .= '<span class="balise"><label for="'.$datas['name'].'">'.balise_submit($datas).'</label></span>';
		$balise .= '</div>';
		break;
		
		
		case "textarea":
		$balise .= '<div>';
		$balise .= '<span class="intitule"><label for="'.$datas['name'].'">'.$datas['label'].' : </label></span>';
		$balise .= '<span class="balise">'.balise_textarea($datas).'</span>';
		if (isset($datas['astuce']) AND $datas['astuce'] != "")
		{
			$balise .= '<span class="astuce">'.$datas['astuce'].'</span>';
		}
		$balise .= '</div>';
		break;
		
		
		case "select":
		$balise .= '<div>';
		$balise .= '<span class="intitule"><label for="'.$datas['name'].'">'.$datas['label'].' : </label></span>';
		$balise .= '<span class="balise">'.balise_select($datas).'</span>';
		if (isset($datas['astuce']) AND $datas['astuce'] != "")
		{
			$balise .= '<span class="astuce">'.$datas['astuce'].'</span>';
		}
		$balise .= '</div>';
		break;
		
		
		case "select_optgroup":
		$balise .= '<div>';
		$balise .= '<span class="intitule"><label for="'.$datas['name'].'">'.$datas['label'].' : </label></span>';
		$balise .= '<span class="balise">'.balise_select_optgroup($datas).'</span>';
		if (isset($datas['astuce']) AND $datas['astuce'] != "")
		{
			$balise .= '<span class="astuce">'.$datas['astuce'].'</span>';
		}
		$balise .= '</div>';
		break;
	}
	return $balise;
}


function ecrire_balise_ligne($tab_datas,$intitule,$astuce)
{
	$balise = '<div>';
	$balise .= '<span class="intitule">'.$intitule.'</span>';
	$balise .= '<span class="balise">';
	for ($i=0; $i<count($tab_datas); $i++)
	{
		$balise .= '<label for="'.$tab_datas[$i]['name'].'">'.balise_box($tab_datas[$i]).' : '.$tab_datas[$i]['label'].'</label> ';
	}
	$balise .= '</span>';
	if (isset($astuce) AND $astuce != "")
	{
		$balise .= '<span class="astuce">'.$astuce.'</span>';
	}
	$balise .= '</div>';
	return $balise;
}

?>