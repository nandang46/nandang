<?php
// Admin Panel Info 
/**************************************/
define("USERADMIN", "admin");		  //
define("PASSADMIN", "admin12345");	  //
//define("ADMINFOLDER", "/admin/");	  //
/**************************************/

// SITE SETTING
define("DOMAIN_ON_CLOUDFLARE", "yes");
define("GEO_TRAFFIC", "yes");
define("TEMPLATE", "clonengan");
define("THEME_STYLE", "gallery");	// lp or slide or gallery
define("MENU_NAME", "PREMIUM MOVIE");
define("TITLE_SITE", "Watch Free HD Quality Movies Online");
define("DESCRIPTION", "We are online movie and tv show streaming for free anytime");
define("SEO_FRIENDLY", "yes");		// yes or no
define("FILE_NAME", "watch.php");	// file if you don't use SEO_FRIENDLY is "no" so the permalink exmaple.com/watch.php?movie=xxxxxx
define("SHOW_TITLE_PARAMETER", "yes");	// yes or no  exmaple.com/watch.php?movie=xxxxxx&title=title-parameter
define("BITLY_ACCESS_TOKEN", "333a8d98525f973d61c76");	// Generate on https://bitly.com/a/oauth_apps 
define("SSL_URI", "http");	// https or http  for bitly only
define("REDIRTIME", 0);		// redirect time on download.php and register.php
define("SIDEBAR_COUNT_SHOW", 10);

// AD-NETWORK SETTING
define("PRO_ID_REG", "3");		//	ad-center PRODUCT ID
define("PRO_ID_DL", "139");		//	ad-center PRODUCT ID
define("REF_ID", "5099632");	// ad-center REF_ID or campaigne ID
define("SUB_ID", "CHANGE_ME_ON_CONFIG.PHP");	// only for ad-center
define("CPA_NETWORK", "other"); // ad-center or other
define("OTHER_NETWORK", "//selfsrver.com/apu.php?n=&zoneid=19253&direct=1"); 

/********************DON'T TOUCH THIS********************/
define("ADC_URL_REG", "//hlok.qertewrt.com/offer?prod=".PRO_ID_REG."&ref=".REF_ID);
define("ADC_URL_DL", "//hlok.qertewrt.com/offer?prod=".PRO_ID_DL."&ref=".REF_ID);

$TMDB_API_ARRAY = dirname(__file__).'/TMDB_API.txt';
$TMDB_API_LIST = file_get_contents($TMDB_API_ARRAY);
$TMDB_API = explode("\n", $TMDB_API_LIST);
$randomTMDB_API=array_rand($TMDB_API,1);

$MOVIE_ID_ARRAY = dirname(__file__).'/MOVIE_ID.txt';
$MOVIE_ID_LIST = file_get_contents($MOVIE_ID_ARRAY);
$MOVIE_ID_IMDB_OR_TMDB = explode("\n", $MOVIE_ID_LIST);
$randomMovies = array_rand($MOVIE_ID_IMDB_OR_TMDB,1);

function hour_min($minutes) {
   if($minutes <= 0) return '00 Hours 00 Minutes';
else    
   return sprintf("%02d",floor($minutes / 60)).' Hours '.sprintf("%02d",str_pad(($minutes % 60), 2, "0", STR_PAD_LEFT)). " Minutes";
}
/********************DON'T TOUCH THIS********************/
