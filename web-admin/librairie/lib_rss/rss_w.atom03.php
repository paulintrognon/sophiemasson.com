<?php
// format atom 0.3
// template version beta 0.4
// en-tete
$rss_content .= 
	'<feed version="0.3" xmlns="http://purl.org/atom/ns#"  xml:lang="'.$this -> rss_data['language'].'">'.$n;

// channel
$rss_content .=
	element ('title', $this -> rss_channel['title']).
	'<link rel="alternate" type="text/html" href="'. $this -> rss_channel['link'].'" />'.$n.
	element ('tagline', $this -> rss_channel['description']).
	element_op ('copyright', $this -> rss_channel['copyright']).
	element_op ('author', element_op('name'.$this -> rss_channel['webmaster'])).
	element_date2 ('modified', $this -> rss_channel['pubdate']).
	element ('generator', 'fil_LE rss_write V'.$this -> class_version);


// items
for($i = 0; $i <= $this -> itemcount; $i++)
{
	$rss_content .=
	'<entry>'.$n.
	element ('title', $this -> rss_items[$i]['title']).
	'<link rel="alternate" type="text/html" href="'. $this -> rss_items[$i]['link'].'" />'.$n.
	element('id', $this -> rss_items[$i]['link']);
	if (!empty($this -> rss_items[$i]['description'])) {
		$rss_content .= 
		'<summary type="html">'. $this -> rss_items[$i]['description'].'</summary>'.$n;
	}
	$rss_content .= 
	element_date2 ('issued', $this -> rss_items[$i]['pubdate']).
	element_date2 ('modified', $this -> rss_items[$i]['modified']).
	element_op ('author', element_op ('name', $this -> rss_items[$i]['author']));
	
	if (!empty($this -> rss_items[$i]['category'])) {
		$rss_content .=
		'<category label="'.$this -> rss_items[$i]['category'].' />'.$n;
	}
	
	$rss_content .= '</entry>'.$n;
}
		
$rss_content .= '</feed>';
?>