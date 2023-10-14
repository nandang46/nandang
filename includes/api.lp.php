<?php
	//include dirname(__FILE__)."/includes/config.php";
	//include dirname(__FILE__)."/function_slug.php";
	//$tmdb_api = trim($TMDB_API[$randomTMDB_API]);
	$title_uri = isset($_GET['title']) ? $_GET['title'] : NULL;

	if (!empty($_GET['movie']) && empty($_GET['tv']) && empty($_GET['season']) && empty($_GET['episode'])) {
		$movieid = isset($_GET['movie']) ? $_GET['movie'] : NULL;
		$cache_file = "movie-".$movieid."-".$title_uri;
		$tmdb_movie_url = "https://api.themoviedb.org/3/movie/".$movieid."?api_key=".$tmdb_api."&append_to_response=images,videos";
		$file_movie = dirname(__file__)."/../cache/".$cache_file.".json";
		$css_style = "movie-".$movieid."-".$title_uri;

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
				$runtime = isset($tmdb_movie['runtime']) ? $tmdb_movie['runtime'] : rand(85,125);
				if ($runtime==0) { $runtime = rand(85,125); }
				$production_companies = array();
				foreach ($tmdb_movie['production_companies'] as $company) 
				$production_companies[] = $company['name'];
				$production_countries = array();
				foreach ($tmdb_movie['production_countries'] as $country) 
				$production_countries[] = $country['name'];
				$backdrops_file_path = array();
				foreach($tmdb_movie['images']['backdrops'] as $backdrops)
				$backdrops_file_path[] = isset($backdrops['file_path']) ? $backdrops['file_path'] : $backdrop_path;
				//$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				if (!empty($backdrops_file_path)) {
					$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				} else {
					$random_backdrops_file_path = $backdrop_path;
				}
			} else {
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $tmdb_movie_url,
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
					file_put_contents($file_movie, file_get_contents($tmdb_movie_url));
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
				$runtime = isset($tmdb_movie['runtime']) ? $tmdb_movie['runtime'] : rand(85,125);
				if ($runtime==0) { $runtime = rand(85,125); }
				$production_companies = array();
				foreach ($tmdb_movie['production_companies'] as $company) 
				$production_companies[] = $company['name'];
				$production_countries = array();
				foreach ($tmdb_movie['production_countries'] as $country) 
				$production_countries[] = $country['name'];
				$backdrops_file_path = array();
				foreach($tmdb_movie['images']['backdrops'] as $backdrops)
				$backdrops_file_path[] = $backdrops['file_path'];
				//$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				if (!empty($backdrops_file_path)) {
					$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				} else {
					$random_backdrops_file_path = $backdrop_path;
				}
			}
		} else {
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $tmdb_movie_url,
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
				file_put_contents($file_movie, file_get_contents($tmdb_movie_url));
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
			$runtime = isset($tmdb_movie['runtime']) ? $tmdb_movie['runtime'] : rand(85,125);
			if ($runtime==0) { $runtime = rand(85,125); }
			$production_companies = array();
			foreach ($tmdb_movie['production_companies'] as $company) 
			$production_companies[] = $company['name'];
			$production_countries = array();
			foreach ($tmdb_movie['production_countries'] as $country) 
			$production_countries[] = $country['name'];
			$backdrops_file_path = array();
			foreach($tmdb_movie['images']['backdrops'] as $backdrops)
			$backdrops_file_path[] = $backdrops['file_path'];
			//$random_backdrops_file_path = array_rand($backdrops_file_path,1);
			if (!empty($backdrops_file_path)) {
				$random_backdrops_file_path = array_rand($backdrops_file_path,1);
			} else {
				$random_backdrops_file_path = $backdrop_path;
			}
		}
		$type = "movie";
		$params = "movie/".$movieid;
		$title_site = "Watch " . $title . " for free - ";
	} else if (!empty($_GET['tv']) && empty($_GET['season']) && empty($_GET['episode']) && empty($_GET['movie'])) {
		$tvid = isset($_GET['tv']) ? trim($_GET['tv']) : NULL;
		$css_style = "tv-".$tvid;
		$tmdb_tv_url = "https://api.themoviedb.org/3/tv/".$tvid."?api_key=".$tmdb_api."&append_to_response=images,videos";
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $tmdb_tv_url,
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
				$tmdb_tv = json_decode(file_get_contents($tmdb_tv_url), true);
			} else {
				$tmdb_tv = json_decode($response, true);
			}
			$tmdb_id = $tmdb_tv['id'];
			$backdrop_path = isset($tmdb_tv['backdrop_path']) ? "//image.tmdb.org/t/p/w780".$tmdb_tv['backdrop_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no-backdrop.jpg";
			$poster_path = isset($tmdb_tv['poster_path']) ? "//image.tmdb.org/t/p/w500".$tmdb_tv['poster_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
			$title = @$tmdb_tv['name'];
			$title_tv = $title;
			$tagline = @$tmdb_tv['tagline'];
			$overview = @$tmdb_tv['overview'];
			$first_air_date = @$tmdb_tv['first_air_date'];
			$last_air_date = @$tmdb_tv['last_air_date'];
			$release_date = $last_air_date;
			$number_of_episodes = @$tmdb_tv['number_of_episodes'];
			$number_of_seasons = @$tmdb_tv['number_of_seasons']; 
			$runtime = @$tmdb_tv['episode_run_time'][0];
			$production_companies = array();
			foreach ($tmdb_tv['production_companies'] as $company) 
			$production_companies[] = $company['name'];
			if (!empty($tmdb_tv['production_countries'])) {
				@$production_countries = array();
				foreach (@$tmdb_tv['production_countries'] as $country) 
				@$production_countries[] = $country['name'];
			}
			$backdrops_file_path = array();
			foreach($tmdb_tv['images']['backdrops'] as $backdrops)
			$backdrops_file_path[] = $backdrops['file_path'];
			//$random_backdrops_file_path = array_rand($backdrops_file_path,1);
			if (!empty($backdrops_file_path)) {
				$random_backdrops_file_path = array_rand($backdrops_file_path,1);
			} else {
				$random_backdrops_file_path = $backdrop_path;
			}		
		$type = "tv";
		$params = "tv/".$tvid;
		$cache_file = "tv-".$tvid."-".slugUri($title);
		$title_site = "Watch " . $title . " for free - ";
	} else if (!empty($_GET['tv']) && !empty($_GET['season']) && empty($_GET['episode']) && empty($_GET['movie'])) {
		$tvid = isset($_GET['tv']) ? $_GET['tv'] : NULL;
		$seasonid = isset($_GET['season']) ? $_GET['season'] : NULL;
		// Tv API
		$tmdb_tv_url = "https://api.themoviedb.org/3/tv/".$tvid."?api_key=".$tmdb_api."&append_to_response=images,videos";
		$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $tmdb_tv_url,
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
			$tmdb_tv = json_decode(file_get_contents($tmdb_tv_url), true);
		} else {
			$tmdb_tv = json_decode($response, true);
		}
		$title_tv = @$tmdb_tv['name'];
		//$overview = @$tmdb_tv['overview'];
		$backdrop_path = isset($tmdb_tv['backdrop_path']) ? "//image.tmdb.org/t/p/w780".$tmdb_tv['backdrop_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no-backdrop.jpg";
		$runtime = @$tmdb_tv['episode_run_time'][0];
		$production_companies = array();
		foreach ($tmdb_tv['production_companies'] as $company) 
		$production_companies[] = $company['name'];
		$seasons_episode = array();
		foreach ($tmdb_tv['seasons'] as $season) 
		$seasons_episode[] = $season['episode_count'];
		$season_episode_count = @$seasons_episode[$seasonid];

		$backdrops_file_path = array();
		foreach($tmdb_tv['images']['backdrops'] as $backdrops)
		$backdrops_file_path[] = $backdrops['file_path'];
		//$random_backdrops_file_path = array_rand($backdrops_file_path,1);
		if (!empty($backdrops_file_path)) {
			$random_backdrops_file_path = array_rand($backdrops_file_path,1);
		} else {
			$random_backdrops_file_path = $backdrop_path;
		}
		
		// Season API
		$tmdb_season_url = "https://api.themoviedb.org/3/tv/".$tvid."/season/".$seasonid."?api_key=".$tmdb_api;
		$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $tmdb_season_url,
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
			$tmdb_season = json_decode(file_get_contents($tmdb_season_url), true);
		} else {
			$tmdb_season = json_decode($response, true);
		}
		$imdb_id = @$tmdb_season['imdb_id'];
		$tmdb_id = @$tmdb_season['id'];
		$overview = @$tmdb_season['overview'];
		$poster_path = isset($tmdb_season['poster_path']) ? "//image.tmdb.org/t/p/w500".$tmdb_season['poster_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
			$title = @$tmdb_tv['name'];
		$title_sea = @$tmdb_season['name'];
		$tagline = @$tmdb_season['tagline'];
		$air_date = @$tmdb_season['air_date'];	
		$release_date = $air_date;	
		$type = "season";
		$title = $title_tv . " - " . $title_sea;
		$title_site = "Watch " . $title . " for free - ";
		$params = "tv/".$tvid."/season/".$seasonid;
		$cache_file = "tv_".$tvid."_season_".$seasonid;
		$css_style = "season-".$tvid."-".$seasonid;
	} else if (!empty($_GET['tv']) && !empty($_GET['season']) && !empty($_GET['episode']) && empty($_GET['movie'])) {
		$tvid = isset($_GET['tv']) ? $_GET['tv'] : NULL;
		$seasonid = isset($_GET['season']) ? $_GET['season'] : NULL;
		$episodeid = isset($_GET['episode']) ? $_GET['episode'] : NULL;
		// Tv API
		$tmdb_tv_url = "https://api.themoviedb.org/3/tv/".$tvid."?api_key=".$tmdb_api;
		$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $tmdb_tv_url,
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
			$tmdb_tv = json_decode(file_get_contents($tmdb_tv_url), true);
		} else {
			$tmdb_tv = json_decode($response, true);
		}
		$title_tv = @$tmdb_tv['name'];
		$runtime = @$tmdb_tv['episode_run_time'][0];
		$production_companies = array();
		foreach ($tmdb_tv['production_companies'] as $company) 
		$production_companies[] = $company['name'];
		$seasons = array();
		foreach ($tmdb_tv['seasons'] as $season) 
		$seasons[] = $season['poster_path'];
		$poster_path = isset($seasons[$seasonid]) ? "//image.tmdb.org/t/p/w500".$seasons[$seasonid] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
		// Episode API
		$cache_file = "tv-".$tvid."-season-".$seasonid."-episode-".$episodeid."-".$title_uri;
		$tmdb_epi_url = "https://api.themoviedb.org/3/tv/".$tvid."/season/".$seasonid."/episode/".$episodeid."?api_key=".$tmdb_api."&append_to_response=images,video";
		$file_epis = dirname(__file__)."/../cache/".$cache_file.".json";

		if (file_exists($file_epis)) {
			$tmdb_epi = json_decode(file_get_contents($file_epis), true);
			if (!empty($tmdb_epi)) { 
				$tmdb_id = $tmdb_epi['id'];
				$backdrop_path = isset($tmdb_epi['still_path']) ? "//image.tmdb.org/t/p/w780".$tmdb_epi['still_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no-backdrop.jpg";
				$title_epi = @$tmdb_epi['name'];
				$tagline = @$tmdb_epi['tagline'];
				$overview = @$tmdb_epi['overview'];
				$release_date = @$tmdb_epi['air_date'];
				$backdrops_file_path = array();
				foreach($tmdb_epi['images']['stills'] as $backdrops_still)
				$backdrops_file_path[] = $backdrops_still['file_path'];
				//$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				if (!empty($backdrops_file_path)) {
					$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				} else {
					$random_backdrops_file_path = $backdrop_path;
				}
				$type = "episode";
				$title = $title_tv . " - " . $title_epi;
				$title_site = "Watch " . $title_tv . " - Season " . $seasonid . " - Episode " . $episodeid . ": " . $title_epi . " for free - ";
				$params = "tv/".$tvid."/season/".$seasonid."/episode/".$episodeid;
			} else {
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => $tmdb_epi_url,
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
					file_put_contents($file_epis, file_get_contents($tmdb_epi_url));
					$tmdb_epi = json_decode(file_get_contents($file_epis), true);
				} else {
					file_put_contents($file_epis, $response);
					$tmdb_epi = json_decode(file_get_contents($file_epis), true);
				}
				$tmdb_id = $tmdb_epi['id'];
				$backdrop_path = isset($tmdb_epi['still_path']) ? "//image.tmdb.org/t/p/w780".$tmdb_epi['still_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no-backdrop.jpg";
				$title_epi = @$tmdb_epi['name'];
				$tagline = @$tmdb_epi['tagline'];
				$overview = @$tmdb_epi['overview'];
				$release_date = @$tmdb_epi['air_date'];
				$backdrops_file_path = array();
				foreach($tmdb_epi['images']['stills'] as $backdrops_still)
				$backdrops_file_path[] = $backdrops_still['file_path'];
				//$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				if (!empty($backdrops_file_path)) {
					$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				} else {
					$random_backdrops_file_path = $backdrop_path;
				}
				$type = "episode";
				$title = $title_tv . " - " . $title_epi;
				$title_site = "Watch " . $title_tv . " - Season " . $seasonid . " - Episode " . $episodeid . ": " . $title_epi . " for free - ";
				$params = "tv/".$tvid."/season/".$seasonid."/episode/".$episodeid;
			}
		} else {
			$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => $tmdb_epi_url,
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
					file_put_contents($file_epis, file_get_contents($tmdb_epi_url));
					$tmdb_epi = json_decode(file_get_contents($file_epis), true);
				} else {
					file_put_contents($file_epis, $response);
					$tmdb_epi = json_decode(file_get_contents($file_epis), true);
				}
				$tmdb_id = $tmdb_epi['id'];
				$backdrop_path = isset($tmdb_epi['still_path']) ? "//image.tmdb.org/t/p/w780".$tmdb_epi['still_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no-backdrop.jpg";
				$title_epi = @$tmdb_epi['name'];
				$tagline = @$tmdb_epi['tagline'];
				$overview = @$tmdb_epi['overview'];
				$release_date = @$tmdb_epi['air_date'];
				$backdrops_file_path = array();
				foreach($tmdb_epi['images']['stills'] as $backdrops_still)
				$backdrops_file_path[] = $backdrops_still['file_path'];
				//$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				if (!empty($backdrops_file_path)) {
					$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				} else {
					$random_backdrops_file_path = $backdrop_path;
				}
				$type = "episode";
				$title = $title_tv . " - " . $title_epi;
				$title_site = "Watch " . $title_tv . " - Season " . $seasonid . " - Episode " . $episodeid . ": " . $title_epi . " for free - ";
				$params = "tv/".$tvid."/season/".$seasonid."/episode/".$episodeid;
		}
		$css_style = "episode-".$tvid."-".$seasonid."-".$episodeid."-".$title_uri;
	} else {
		$movieid = trim($MOVIE_ID_IMDB_OR_TMDB[$randomMovies]);
		$cache_file = "movie-".$movieid."-".$title_uri;
		$tmdb_movie_url = "https://api.themoviedb.org/3/movie/".$movieid."?api_key=".$tmdb_api."&append_to_response=images,videos";
		$file_movie = dirname(__file__)."/../cache/".$cache_file.".json";
		$css_style = "movie-".$movieid."-".$title_uri;
		
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
				$runtime = isset($tmdb_movie['runtime']) ? $tmdb_movie['runtime'] : rand(85,125);
				if ($runtime==0) { $runtime = rand(85,125); }
				$production_companies = array();
				foreach ($tmdb_movie['production_companies'] as $company) 
				$production_companies[] = $company['name'];
				$production_countries = array();
				foreach ($tmdb_movie['production_countries'] as $country) 
				$production_countries[] = $country['name'];
				$backdrops_file_path = array();
				foreach($tmdb_movie['images']['backdrops'] as $backdrops)
				$backdrops_file_path[] = $backdrops['file_path'];
				//$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				if (!empty($backdrops_file_path)) {
					$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				} else {
					$random_backdrops_file_path = $backdrop_path;
				}
				$type = "movie";
				$params = "movie/".$movieid;
				$title_site = "Watch " . $title . " for free - ";
			} else {
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => $tmdb_movie_url,
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
					file_put_contents($file_movie, file_get_contents($tmdb_movie_url));
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
				$runtime = isset($tmdb_movie['runtime']) ? $tmdb_movie['runtime'] : rand(85,125);
				if ($runtime==0) { $runtime = rand(85,125); }
				$production_companies = array();
				foreach ($tmdb_movie['production_companies'] as $company) 
				$production_companies[] = $company['name'];
				$production_countries = array();
				foreach ($tmdb_movie['production_countries'] as $country) 
				$production_countries[] = $country['name'];
				$backdrops_file_path = array();
				foreach($tmdb_movie['images']['backdrops'] as $backdrops)
				$backdrops_file_path[] = $backdrops['file_path'];
				//$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				if (!empty($backdrops_file_path)) {
					$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				} else {
					$random_backdrops_file_path = $backdrop_path;
				}
				$type = "movie";
				$params = "movie/".$movieid;
				$title_site = "Watch " . $title . " for free - ";
			}
		} else {
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $tmdb_movie_url,
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
				file_put_contents($file_movie, file_get_contents($tmdb_movie_url));
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
			$runtime = isset($tmdb_movie['runtime']) ? $tmdb_movie['runtime'] : rand(85,125);
			if ($runtime==0) { $runtime = rand(85,125); }
			$production_companies = array();
			foreach ($tmdb_movie['production_companies'] as $company) 
			$production_companies[] = $company['name'];
			$production_countries = array();
			foreach ($tmdb_movie['production_countries'] as $country) 
			$production_countries[] = $country['name'];
			$backdrops_file_path = array();
			foreach($tmdb_movie['images']['backdrops'] as $backdrops)
			$backdrops_file_path[] = $backdrops['file_path'];
			if (!empty($backdrops_file_path)) {
				$random_backdrops_file_path = array_rand($backdrops_file_path,1);
			} else {
				$random_backdrops_file_path = $backdrop_path;
			}
			$type = "movie";
			$params = "movie/".$movieid;
			$title_site = "Watch " . $title . " for free - ";
		}
	} 
?>