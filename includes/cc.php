<?php
// GEO TRAFFIC
if (DOMAIN_ON_CLOUDFLARE=="yes") {
	//Country code for cloudflare
	$cc = trim($_SERVER["HTTP_CF_IPCOUNTRY"]);
} else {
	//Country code for non cloudflare
	$ip = $_SERVER['REMOTE_ADDR'];
	$cc = trim(file_get_contents("http://ipinfo.io/".$ip."/country"));
}

if ( $cc == "US" ) {
	header ('HTTP/1.1 302 Moved Temporarily');
	header ('Location: '.$offer);
} else if ( $cc == "DK" || $cc == "FR" || $cc == "SE" || $cc == "NL" || $cc == "JP" || $cc == "NZ" || $cc == "CA" || $cc == "QA" || $cc == "AE" || $cc == "CY" || $cc == "JM" || $cc == "CO" || $cc == "KY" || $cc == "BS" || $cc == "BM" || $cc == "SA" || $cc == "EC" || $cc == "GY" || $cc == "AU" || $cc == "ES" || $cc == "PR" || $cc == "GB" || $cc == "IS" || $cc == "HK" || $cc == "PY" ) {
    header ('HTTP/1.1 302 Moved Temporarily');
	header ('Location: '.$offer);
} else if ( $cc == "BE" || $cc == "NO" || $cc == "FI" || $cc == "CH" || $cc == "LU" || $cc == "TT" || $cc == "KW" || $cc == "IE" || $cc == "DE" || $cc == "TR" || $cc == "IT" || $cc == "PT" || $cc == "CL" || $cc == "PE" || $cc == "SG" ) {
    header ('HTTP/1.1 302 Moved Temporarily');
	header ('Location: '.$offer);
} else if ( $cc == "AF" || $cc == "AL" || $cc == "DZ" || $cc == "AO" || $cc == "AI" || $cc == "BB" || $cc == "BY" || $cc == "BJ" || $cc == "BT" || $cc == "BA" || $cc == "BW" || $cc == "BF" || $cc == "BI" || $cc == "CM" || $cc == "CF" || $cc == "TD" || $cc == "CN" || $cc == "CG" || $cc == "CD" || $cc == "CI" || $cc == "CU" || $cc == "DJ" || $cc == "DO" || $cc == "EG" || $cc == "GQ" || $cc == "ER" || $cc == "ET" || $cc == "GA" || $cc == "GM" || $cc == "GE" || $cc == "GH" || $cc == "GN" || $cc == "GW" || $cc == "IN" || $cc == "ID" || $cc == "IR" || $cc == "IQ" || $cc == "IL" || $cc == "KE" || $cc == "KP" || $cc == "KR" || $cc == "LS" || $cc == "LR" || $cc == "LY" || $cc == "MK" || $cc == "MG" || $cc == "MY" || $cc == "MV" || $cc == "ML" || $cc == "MR" || $cc == "YT" || $cc == "MA" || $cc == "MZ" || $cc == "MM" || $cc == "NA" || $cc == "NE" || $cc == "NG" || $cc == "PK" || $cc == "RO" || $cc == "AR" || $cc == "TW" || $cc == "PH" || $cc == "MX" || $cc == "BR" || $cc == "ZA" || $cc == "RU" || $cc == "RW" || $cc == "SM" || $cc == "ST" || $cc == "SN" || $cc == "SL" || $cc == "SO" || $cc == "SD" || $cc == "SZ" || $cc == "SY" || $cc == "TZ" || $cc == "TH" || $cc == "TG" || $cc == "TN" || $cc == "UG" || $cc == "UA" || $cc == "UZ" || $cc == "VN" || $cc == "EH" || $cc == "ZM" || $cc == "ZW" ) {
	header ('HTTP/1.1 302 Moved Temporarily');
	header ('Location: '.$offer);
} else {
    header ('HTTP/1.1 302 Moved Temporarily');
	header ('Location: '.$offer);
} 