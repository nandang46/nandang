<?php
function slugUri($str) {
	$slug = str_replace(array(" – ", "’", "`", "´"), array(" - ", "'", "'", "'"), $str);
    $slug = str_replace(array('[\', \']'), '', $slug);
    $slug = preg_replace('/\[.*\]/U', '', $slug);
    $slug = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $slug);
    $slug = htmlentities($slug, ENT_COMPAT, 'utf-8');
    $slug = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $slug);
    $slug = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $slug);
	$slug = strtolower(trim($slug));
	$slug = str_replace(array('mp3s', 'mp3', 'mp4s', 'mp4', '3gp', 'flv', 'webm', 'videos', 'video', 'lyrics', 'lyric', 'lyricz', 'downloads', 'download', 'pdf', 'xlsx', 'docx', 'pptx', 'mpeg', 'mpg', 'jpeg', 'jpg', 'gif', 'png', 'bmp', 'tiff', 'pcx', 'tga', 'mkv', 'aac'), '', $slug);
	$slug = str_replace(array('-amp-', 'amp'), '-and-', $slug);
	$slug = substr($slug, 0, 70);
	$slug = str_replace('-', ' ', $slug);
	$slug = preg_replace('/\s[\s]+/', ' ',$slug);    // Strip off multiple spaces
	$slug = str_replace(' ', '-', $slug);
	$slug = preg_replace('/^[\-]+/', '', $slug); // Strip off the starting hyphens
	return preg_replace('/[\-]+$/', '', $slug); // // Strip off the ending hyphens
}
?>