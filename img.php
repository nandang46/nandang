<?php

include dirname(__FILE__)."/includes/config.php";
//include dirname(__FILE__)."/includes/function_slug.php";
$tmdb_api = trim($TMDB_API[$randomTMDB_API]);
$title_uri = isset($_GET['title']) ? $_GET['title'] : NULL;
if (!empty($_GET['movie']) && empty($_GET['tv']) && empty($_GET['season']) && empty($_GET['episode'])) {
	$params_images = "movie/".$_GET['movie'];
	$cache_file = "movie_".$_GET['movie']."_".$title_uri;
} else if (empty($_GET['movie']) && !empty($_GET['tv']) && empty($_GET['season']) && empty($_GET['episode'])) {
	$params_images = "tv/".$_GET['tv'];
	$cache_file = "tv_".$_GET['tv']."_".$title_uri;
} else if (empty($_GET['movie']) && !empty($_GET['tv']) && !empty($_GET['season']) && empty($_GET['episode'])) {
	$params_images = "tv/".$_GET['tv']."/season/".$_GET['season'];
	$cache_file = "tv_".$_GET['tv']."_season_".$_GET['season']."_".$title_uri;
} else if (empty($_GET['movie']) && !empty($_GET['tv']) && !empty($_GET['season']) && !empty($_GET['episode'])) {
	$params_images = "tv/".$_GET['tv']."/season/".$_GET['season']."/episode/".$_GET['episode'];
	$cache_file = "tv_".$_GET['tv']."_season_".$_GET['season']."_episode_".$_GET['episode']."_".$title_uri;
}
$movieid = isset($_GET['movie']) ? $_GET['movie'] : NULL;
$tvid = isset($_GET['tv']) ? $_GET['tv'] : NULL;
$seasonid = isset($_GET['season']) ? $_GET['season'] : NULL;
$episodeid = isset($_GET['episode']) ? $_GET['episode'] : NULL;


$url_images = "https://api.themoviedb.org/3/".$params_images."?api_key=".$tmdb_api."&append_to_response=images,videos";
//echo $url_images;
	if (!empty($_GET['movie']) && empty($_GET['tv']) && empty($_GET['season']) && empty($_GET['episode'])) {
		//$movieid = isset($_GET['movie']) ? $_GET['movie'] : NULL;
		//$cache_file = "movie_".$movieid."_".$title_uri;
		//$tmdb_movie_url = "https://api.themoviedb.org/3/movie/".$movieid."?api_key=".$tmdb_api;
		$file_movie = dirname(__file__)."/cache/".$cache_file.".json";
		//$css_style = "movie-".$movieid;

		if (file_exists($file_movie)) {
			$tmdb_movie = json_decode(file_get_contents($file_movie), true);
			if (!empty($tmdb_movie)) { 
				$imdb_id = @$tmdb_movie['imdb_id'];
				$tmdb_id = $tmdb_movie['id'];
				$backdrop_path = isset($tmdb_movie['backdrop_path']) ? "//image.tmdb.org/t/p/w780".$tmdb_movie['backdrop_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no-backdrop.jpg";
				$poster_path = isset($tmdb_movie['poster_path']) ? "//image.tmdb.org/t/p/w500".$tmdb_movie['poster_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
				$title = @$tmdb_movie['title'];
				$tagline = @$tmdb_movie['tagline'];
				$overview = @$tmdb_movie['overview'];
				$release_date = @$tmdb_movie['release_date'];
				//$runtime = @$tmdb_movie['runtime'];
				$runtime = isset($tmdb_movie['runtime']) ? $tmdb_movie['runtime'] : rand(85,125);
				if ($runtime==0) { $runtime = rand(85,125); }
				//$genres = array();
				//foreach ($tmdb_movie['genres'] as $genre) 
				//$genres[] = $genre['name'];
				$production_companies = array();
				foreach ($tmdb_movie['production_companies'] as $company) 
				$production_companies[] = $company['name'];
				$production_countries = array();
				foreach ($tmdb_movie['production_countries'] as $country) 
				$production_countries[] = $country['name'];

				$backdrops_file_path = array();
				foreach($tmdb_movie['images']['backdrops'] as $backdrops)
				$backdrops_file_path [] = $backdrops['file_path'];
				$random_backdrops_file_path=array_rand($backdrops_file_path,1);
				//echo trim($backdrops_file_path[$random_backdrops_file_path]);
				/*foreach($tmdb_movie['images']['backdrops'] as $backdrops) {
					$backdrops_file_path = $backdrops['file_path'];
					//$random_backdrops_file_path=array_rand($backdrops_file_path,1);
					//echo trim($backdrops_file_path[$random_backdrops_file_path]);
					echo $backdrops_file_path;
				}*/
			} else {
				//$tmdb_movie_url = "https://api.themoviedb.org/3/movie/".$movieid."?api_key=".$tmdb_api;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $url_images,
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
					file_put_contents($file_movie, file_get_contents($url_images));
					$tmdb_movie = json_decode(file_get_contents($file_movie), true);
				} else {
					file_put_contents($file_movie, $response);
					$tmdb_movie = json_decode(file_get_contents($file_movie), true);
				}
				$imdb_id = @$tmdb_movie['imdb_id'];
				$tmdb_id = $tmdb_movie['id'];
				$backdrop_path = isset($tmdb_movie['backdrop_path']) ? "//image.tmdb.org/t/p/w780".$tmdb_movie['backdrop_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no-backdrop.jpg";
				$poster_path = isset($tmdb_movie['poster_path']) ? "//image.tmdb.org/t/p/w500".$tmdb_movie['poster_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
				$title = @$tmdb_movie['title'];
				$tagline = @$tmdb_movie['tagline'];
				$overview = @$tmdb_movie['overview'];
				$release_date = @$tmdb_movie['release_date'];
				//$runtime = @$tmdb_movie['runtime'];
				$runtime = isset($tmdb_movie['runtime']) ? $tmdb_movie['runtime'] : rand(85,125);
				if ($runtime==0) { $runtime = rand(85,125); }
				//$genres = array();
				//foreach ($tmdb_movie['genres'] as $genre) 
				//$genres[] = $genre['name'];
				$production_companies = array();
				foreach ($tmdb_movie['production_companies'] as $company) 
				$production_companies[] = $company['name'];
				$production_countries = array();
				foreach ($tmdb_movie['production_countries'] as $country) 
				$production_countries[] = $country['name'];
			}
		} else {
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $url_images,
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
				file_put_contents($file_movie, file_get_contents($url_images));
				$tmdb_movie = json_decode(file_get_contents($file_movie), true);
			} else {
				file_put_contents($file_movie, $response);
				$tmdb_movie = json_decode(file_get_contents($file_movie), true);
			}
			$imdb_id = @$tmdb_movie['imdb_id'];
			$tmdb_id = $tmdb_movie['id'];
			$backdrop_path = isset($tmdb_movie['backdrop_path']) ? "//image.tmdb.org/t/p/w780".$tmdb_movie['backdrop_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no-backdrop.jpg";
			$poster_path = isset($tmdb_movie['poster_path']) ? "//image.tmdb.org/t/p/w500".$tmdb_movie['poster_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
			$title = @$tmdb_movie['title'];
			$tagline = @$tmdb_movie['tagline'];
			$overview = @$tmdb_movie['overview'];
			$release_date = @$tmdb_movie['release_date'];
			//$runtime = @$tmdb_movie['runtime'];
			$runtime = isset($tmdb_movie['runtime']) ? $tmdb_movie['runtime'] : rand(85,125);
			if ($runtime==0) { $runtime = rand(85,125); }
			//$genres = array();
			//foreach ($tmdb_movie['genres'] as $genre) 
			//$genres[] = $genre['name'];
			$production_companies = array();
			foreach ($tmdb_movie['production_companies'] as $company) 
			$production_companies[] = $company['name'];
			$production_countries = array();
			foreach ($tmdb_movie['production_countries'] as $country) 
			$production_countries[] = $country['name'];
		}
		
	} 

/*
$filename = dirname(__file__).'/../../.randombookmagazine';
$keywords = file_get_contents($filename);
$keywords = explode("\n", $keywords);
$random_books=array_rand($keywords,1);
*/
//print_r(array_values($backdrops_file_path));
?>
<img src="//image.tmdb.org/t/p/original<?=trim($backdrops_file_path[$random_backdrops_file_path])?>">

