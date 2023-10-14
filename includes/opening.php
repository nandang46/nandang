<?php
if (($production_companies) || ($title)) {
    if (preg_match('/Anatomy/i', $title)) {
        $opening_video = "OlVx1x4cixs";
    } else if (preg_match('/Warner Bros/i', implode(",", $production_companies))) { 
        $opening_video = "VFxdRTQQ8eg";
    } else if (preg_match('/Walt Disney/i', implode(",", $production_companies))) {
    	$opening_video = "2FB-gEghOT8";
    } else if (preg_match('/Mandeville Films/i', implode(",", $production_companies))) {
        $opening_video = "xkLyj1ugTxE";
    } else if (preg_match('/Universal Pictures|Blumhouse Productions|Blinding Edge Pictures/i', implode(",", $production_companies))) {
        $opening_video = "8FuoHDmTms4";
    } else if (preg_match('/Pantelion Films/i', implode(",", $production_companies))) {
        $opening_video = "XPGzIP5ohT4";
    } else if (preg_match('/20th Century Fox/i', implode(",", $production_companies))) {
        $opening_video = "0qDdYlyLRoI";
    } else if (preg_match('/Columbia Pictures/i', implode(",", $production_companies))) {
        $opening_video = "VOjqnb3aICM";
    } else if (preg_match('/Paramount/i', implode(",", $production_companies))) {
        $opening_video = "s0Uz_FtGwMo";
    } else if (preg_match('/Gaumont/i', implode(",", $production_companies))) {
        $opening_video = "qSg0b8TOMtw";
    } else if (preg_match('/Lionsgate/i', implode(",", $production_companies))) {
        $opening_video = "5NDyCOyWZN8";
    } else if (preg_match('/BBC Wales|Canadian Broadcasting Corporation/i', implode(",", $production_companies))) {
        $opening_video = "LFmoT-zRBgQ";
    } else {
        $opening_video = "8FuoHDmTms4";
    } 
}
