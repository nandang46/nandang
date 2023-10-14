<?php
//ini_set('display_errors', 1);
include dirname(__FILE__)."/includes/config.php";
include dirname(__FILE__)."/includes/function_slug.php";
$tmdb_api = trim($TMDB_API[$randomTMDB_API]);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$movieid = isset($_GET['movie']) ? $_GET['movie'] : NULL;
$tvid = isset($_GET['tv']) ? $_GET['tv'] : NULL;
$seasonid = isset($_GET['season']) ? $_GET['season'] : NULL;
$episodeid = isset($_GET['episode']) ? $_GET['episode'] : NULL;
$style = isset($_GET['style']) ? $_GET['style'] : THEME_STYLE;
$sub_id = isset($_GET['sub_id']) ? $_GET['sub_id'] : SUB_ID;

if ($style=="lp") {
	include dirname(__FILE__)."/includes/api.lp.php";
	include dirname(__FILE__)."/templates/".TEMPLATE."/header.php";
	include dirname(__FILE__)."/templates/".TEMPLATE."/lp.php";
	include dirname(__FILE__)."/templates/".TEMPLATE."/footer.php";
} else if ($style=="slide") {
	
		if (!empty($movieid) || !empty($tvid) || !empty($seasonid) || !empty($episodeid)) {
			include dirname(__FILE__)."/includes/api.lp.php";
			include dirname(__FILE__)."/templates/".TEMPLATE."/header.php";
			include dirname(__FILE__)."/templates/".TEMPLATE."/lp.php";
		} else {
			include dirname(__FILE__)."/includes/api.home.php";
			include dirname(__FILE__)."/templates/".TEMPLATE."/header.php";
			include dirname(__FILE__)."/templates/".TEMPLATE."/home.php";
		}
	include dirname(__FILE__)."/templates/".TEMPLATE."/footer.php";
} else {
	
		if (!empty($movieid) || !empty($tvid) || !empty($seasonid) || !empty($episodeid)) {
			include dirname(__FILE__)."/includes/api.lp.php";
			include dirname(__FILE__)."/templates/".TEMPLATE."/header.php";
			include dirname(__FILE__)."/templates/".TEMPLATE."/lp.php";
			
		} else {
			include dirname(__FILE__)."/templates/".TEMPLATE."/header.php";
			include dirname(__FILE__)."/templates/".TEMPLATE."/gallery.php";
		}
	include dirname(__FILE__)."/templates/".TEMPLATE."/footer.php";
}
?>