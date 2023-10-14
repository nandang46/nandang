<?php
if (!empty($random_backdrops_file_path)) {
	$backdrop_path_style = isset($backdrops_file_path[$random_backdrops_file_path]) ? "//image.tmdb.org/t/p/w780".trim($backdrops_file_path[$random_backdrops_file_path]) : "//".$_SERVER['HTTP_HOST']."/assets/img/freehdmovie.jpg";
}
$overview = isset($overview) ? $overview : DESCRIPTION;
//$og_image = isset($$backdrop_path_style) ? $backdrop_path_style : "//" . $_SERVER['HTTP_HOST'] . "/assets/img/freehdmovie.jpg";
$title_site = isset($title_site) ? $title_site : TITLE_SITE;
?>
<meta name="author" content="<?=$_SERVER['HTTP_HOST']?>">
		<meta name="copyright" content="<?=$_SERVER['HTTP_HOST']?>">
		<meta name="description" content="<?=str_replace(array('"', "'"), '', $overview)?>">
		<meta property="og:title" content="<?=$title_site?>">
		<meta property="og:description" content="<?=str_replace(array('"', "'"), '', $overview)?>">
		<meta property="og:url" content="<?=$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']?>">	
		<meta property="og:type" content="website">
		<meta property="og:site_name" content="<?=$_SERVER['HTTP_HOST']?>">
		<meta property="og:image" content="<?=$backdrop_path_style?>">
		<meta name="twitter:card" content="summary">
		<meta name="twitter:title" content="<?=$title_site?>">
		<meta name="twitter:description" content="<?=str_replace(array('"', "'"), '', $overview)?>">
		<meta name="twitter:url" content="<?=$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']?>">
		<meta name="twitter:image" content="<?=$backdrop_path_style?>">
