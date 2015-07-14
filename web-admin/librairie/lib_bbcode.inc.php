<?php
/*  
		############################################################################
		Outil d'administration de site internet 
		Author : Arnaud Meunier
		Version : 1.5
		Date : janvier 2007 
		############################################################################
*/


function bbcode_js()
{
	$js = '<script language="JavaScript" type="text/javascript">';
	$js .= 'function insertion(editeur, content, nature, repdeb, repfin)';
	$js .= '{';
	$js .= 'var input = document.forms[editeur].elements[content]; ';
	$js .= 'input.focus(); ';
			
	/* ------------- sélection du texte ---------------- */
	$js .= 'if(typeof document.selection != \'undefined\') ';
	$js .= '{';
	/* Insertion du code de formatage */
	$js .= 'var range = document.selection.createRange();';
	$js .= 'var insText = range.text;';
	$js .= '}';
	$js .= 'else if(typeof input.selectionStart != \'undefined\')';
	$js .= '{';
	/* Insertion du code de formatage */
	$js .= 'var start = input.selectionStart;';
	$js .= 'var end = input.selectionEnd;';
	$js .= 'var insText = input.value.substring(start, end);';
	$js .= '}';
	$js .= 'else';
	$js .= '{';
	$js .= 'var insText = prompt("Veuillez entrer le texte à formater:");';
	$js .= '}';
	
	/* -------------- Recherche des balises ------------- */
	$js .= 'if (nature == "lien")';
	$js .= '{';
	$js .= 'var deblien = prompt(\'URL : \',\'http://\');';
	$js .= 'var lglien = prompt(\'Langue du site : \',\'fr\');';
	$js .= 'var titlelien = prompt(\'Titre du lien : \',\'\');';
	$js .= 'var repdeb = \'<a href="\' + deblien + \'" hreflang="\' + lglien + \'" title="\' + titlelien + \'">\';';
	$js .= 'var repfin = \'</a>\';';
	$js .= '}';
	$js .= 'else if (nature == "img")';
	$js .= '{';
	$js .= 'var pagedesti = \''.URL.'index.php?upl=img&ser=1\';';
	$js .= 'window.open(pagedesti,\'image\',\'width=720, height=600, statut=0, toolbar=0, location=0, menubar=0, scrollbars=1\');';
	$js .= '}';
	$js .= 'else if (nature == "pdf")';
	$js .= '{';
	$js .= 'var pagedesti = \''.URL.'index.php?upl=doc&ser=1\';';
	$js .= 'window.open(pagedesti,\'image\',\'width=720, height=600, statut=0, toolbar=0, location=0, menubar=0, scrollbars=1\');';
	$js .= '}';
	$js .= 'else if (nature == "son")';
	$js .= '{';
	$js .= 'var pagedesti = \''.URL.'index.php?upl=son&ser=1\';';
	$js .= 'window.open(pagedesti,\'image\',\'width=720, height=600, statut=0, toolbar=0, location=0, menubar=0, scrollbars=1\');';
	$js .= '}';
	$js .= 'else if (nature == "list")';
	$js .= '{';
	$js .= 'var debliste = prompt(\'Première ligne ? O / N\',\'O\');';
	$js .= 'var finliste = prompt(\'Dernière ligne ? O / N\',\'N\');';
	$js .= 'if (debliste == "O")';
	$js .= '{';
	$js .= 'var repdeb = \'<ul><li>\';';
	$js .= '}';
	$js .= 'else';
	$js .= '{';
	$js .= 'var repdeb = \'<li>\';';
	$js .= '}';
	$js .= 'if (finliste == "O")';
	$js .= '{';
	$js .= 'var repfin = \'</li></ul>\';';
	$js .= '}';
	$js .= 'else';
	$js .= '{';
	$js .= 'var repfin = \'</li>\';';
	$js .= '}';
	$js .= '}';
	$js .= 'else';
	$js .= '{';
	$js .= 'var repdeb = repdeb;';
	$js .= 'var repfin = repfin;';
	$js .= '}';
	
	/* -------------- Retour dans le textarea ----------- */
	/* pour l'Explorer Internet */
	$js .= 'if(typeof document.selection != \'undefined\') ';
	$js .= '{';
	/* Insertion du code de formatage */
	$js .= 'range.text = repdeb + insText + repfin;';
	/* Ajustement de la position du curseur */
	$js .= 'range = document.selection.createRange();';
	$js .= 'if (insText.length == 0) ';
	$js .= '{';
	$js .= 'range.move(\'character\', -repfin.length);';
	$js .= '}'; 
	$js .= 'else ';
	$js .= '{';
	$js .= 'range.moveStart(\'character\', repdeb.length + insText.length + repfin.length);';
	$js .= '}';
	$js .= 'range.select();';
	$js .= '}';
	/* pour navigateurs plus récents basés sur Gecko*/
	$js .= 'else if(typeof input.selectionStart != \'undefined\')';
	$js .= '{';
	/* Insertion du code de formatage */
	$js .= 'input.value = input.value.substr(0, start) + repdeb + insText + repfin + input.value.substr(end);';
	/* Ajustement de la position du curseur */
	$js .= 'var pos;';
	$js .= 'if (insText.length == 0) ';
	$js .= '{';
	$js .= 'pos = start + repdeb.length;';
	$js .= '} ';
	$js .= 'else ';
	$js .= '{';
	$js .= 'pos = start + repdeb.length + insText.length + repfin.length;';
	$js .= '}';
	$js .= 'input.selectionStart = pos;';
	$js .= 'input.selectionEnd = pos;';
	$js .= '}';
	/* pour les autres navigateurs */
	$js .= 'else';
	$js .= '{';
	/* requête de la position d'insertion */
	$js .= 'var pos;';
	$js .= 'var re = new RegExp(\'^[0-9]{0,3}$\');';
	$js .= 'while(!re.test(pos)) ';
	$js .= '{';
	$js .= 'pos = prompt("Insertion à la position (0.." + input.value.length + "):", "0");';
	$js .= '}';
	$js .= 'if(pos > input.value.length) ';
	$js .= '{';
	$js .= 'pos = input.value.length;';
	$js .= '}';
	/* Insertion du code de formatage */
	$js .= 'var insText = prompt("Veuillez entrer le texte à formater:");';
	$js .= 'input.value = input.value.substr(0, pos) + repdeb + insText + repfin + input.value.substr(pos);';
	$js .= '}';
	$js .= '}';
	$js .= '</script>';
	
	
	$js .= '<script language="JavaScript" type="text/javascript">';
	$js .= '<!--';
	$js .= 'function send(url,altimg)';
	$js .= '{';
	$js .= 'var url = url;';
	$js .= 'var urlimg = \'<img src="http://www.sophiehelouard.com/upload/photos/\' + url + \'" alt="\' + altimg + \'" />\';';
	$js .= 'window.opener.insertion(\'formtxt\',\'Texte\',\'img\',urlimg,\'\');';
	$js .= 'window.close();';
	$js .= '}';
	$js .= '-->';
	$js .= '</script>';
	return $js;
}
?>	