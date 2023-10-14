<?php
include dirname(__FILE__)."/includes/histats.php";
include dirname(__FILE__)."/includes/config.php";
$sub_id = isset($_GET['sub_id']) ? $_GET['sub_id'] : SUB_ID;
$sub_id = isset($_GET['sub_id']) ? "sub_id=".$_GET['sub_id'] : "sub_id=".SUB_ID;

if (CPA_NETWORK=="ad-center") {
	$offer = ADC_URL_DL.'&sub_id='.$sub_id;
	//header ('HTTP/1.1 302 Moved Temporarily');
	//header ('Location: '.$offer);
} else {
	$offer = OTHER_NETWORK.'&s1='.$sub_id;
	//header ('HTTP/1.1 302 Moved Temporarily');
	//header ('Location: '.$offer);
}

// OFFER GEO TRAFFIC
if (GEO_TRAFFIC=="yes") {
	include dirname(__FILE__)."/includes/cc.php";
} else {
	header ('HTTP/1.1 302 Moved Temporarily');
	header ('Location: '.$offer);
}