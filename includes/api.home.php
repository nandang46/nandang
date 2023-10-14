<?php
$popular = "https://api.themoviedb.org/3/movie/popular?api_key=".$tmdb_api;
if (false !== ($html = @file_get_contents($nowplaying))) {	
	$pop_result = json_decode($html, true);
} else {
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => $popular,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "{}",
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
		$pop_result = json_decode($response, true);
	}
}
$slide = array();
foreach ($pop_result['results'] as $result) 
$slide[] = $result['backdrop_path'];
?>