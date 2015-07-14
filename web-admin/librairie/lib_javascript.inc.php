<?php
/*  
		############################################################################
		Outil d'administration de site internet 
		Author : Arnaud Meunier
		Version : 1.5
		Date : janvier 2007 
		############################################################################
*/


function ecrire_js()
{
	$js ="";
	$js .= '<script type="text/javascript" language="JavaScript">';
	$js .= '<!-- ';
	$js .= 'window.onload = montre;';
	$js .= 'function montre(id) ';
	$js .= '{ ';
	$js .= 'var d = document.getElementById(id);';
	$js .= 'for (var i = 1; i<=10; i++) ';
	$js .= '{ ';
	$js .= 'if (document.getElementById(\'smenu\'+i)) ';
	$js .= '{ ';
	$js .= 'document.getElementById(\'smenu\'+i).style.display=\'none\'; ';
	$js .= '} ';
	$js .= '} ';
	$js .= 'if (d) ';
	$js .= '{ ';
	$js .= 'd.style.display=\'block\'; ';
	$js .= '} ';
	$js .= '} ';
	$js .= '//--> ';
	$js .= '</script>';
	return $js;
}

function google_analytics()
{
	$google = '<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">';
	$google .= '</script>';
	$google .= '<script type="text/javascript">';
	$google .= '_uacct = "UA-261132-3";';
	$google .= 'urchinTracker();';
	$google .= '</script>';
	return $google;
}
?>