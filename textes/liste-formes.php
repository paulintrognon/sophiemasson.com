<?php
$formes_vaisselle = $GLOBALS['formes_vaisselle'];

for($i=0; $i<count($formes_vaisselle); $i++)
{
	echo '<div class="forme_vaisselle">';
	echo '<img src="http://www.sophiemasson.com/images/'.$formes_vaisselle[$i]['img'].'" alt="vaisselle en porcelaine '.$formes_vaisselle[$i]['nom'].'" /><br />'.$formes_vaisselle[$i]['nom'];
	echo '</div>';
}
?>