<?php
// ---------------------------------------------------------
// rss_write - classe pour g�n�rer des fichiers RSS/RDF/Atom
// Dominique WOJYLAC <http://wojylac.free.fr>
// Distribu� sous GNU General Public License.
// ---------------------------------------------------------
// Fonctions utilis�es dans les plugins
// Version 2.0 beta 0.3
// ---------------------------------------------------------

// date au format Sun, 26 Jun 2005 10:16:26 +0200
function date1($date ='') {
	if (empty($date)) {
		return '';
	}
	else {
		return date("r", strtotime($date));
	}
}

// date au format 2004-06-07T11:13:19+01:00
function date2($date='') {
if (empty($date)) {
		return '';
	}
	else {
		$date = strtotime($date);
		$decal = date("O", $date);
		$decal = substr($decal, 0, 3).':'.substr($decal, 3, 2);
		return date("Y-m-d\TH:i:s", $date).$decal;
	}
}

// pour ins�rer un �l�ment optionnel
// pas d'insertion si la valeur n'est pas d�finie
function element_op ($element, $value = '') {
	if (empty($element) or empty($value)) {
		return '';
	}
	return '<'.$element.'>'.$value.'</'.$element.'>'."\n";
}

// insertion sans test de valeur
function element ($element, $value = '') {
	return '<'.$element.'>'.$value.'</'.$element.'>'."\n";
}

// insertion d'un �l�ment de type date au format 1
function element_date1($element, $date ='') {
	$date = date1($date);
	return element_op($element, $date);
}
	
// insertion d'un �l�ment de type date au format 2
function element_date2($element, $date ='') {
	$date = date2($date);
	return element_op($element, $date);
}
?>