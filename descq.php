<?php
	include dirname(__FILE__)."/includes/config.php";
	include dirname(__FILE__)."/includes/function_slug.php";
	$tmdb_api = trim($TMDB_API[$randomTMDB_API]);
	$title_uri = isset($_GET['title']) ? $_GET['title'] : NULL;
	$sub_id = isset($_GET['sub_id']) ? $_GET['sub_id'] : SUB_ID;

	if (!empty($_GET['movie']) && empty($_GET['tv']) && empty($_GET['season']) && empty($_GET['episode'])) {
		$movieid = isset($_GET['movie']) ? $_GET['movie'] : NULL;
		//$cache_file = "movie_".$movieid."_".$title_uri;
		$cache_file = "movie-".$movieid."-".$title_uri;
		$tmdb_movie_url = "https://api.themoviedb.org/3/movie/".$movieid."?api_key=".$tmdb_api."&append_to_response=images,videos";
		$file_movie = dirname(__file__)."/cache/".$cache_file.".json";

		if (file_exists($file_movie)) {
			$tmdb_movie = json_decode(file_get_contents($file_movie), true);
			if (!empty($tmdb_movie)) { 
				$imdb_id = @$tmdb_movie['imdb_id'];
				$tmdb_id = $tmdb_movie['id'];
				$backdrop_path = $tmdb_movie['backdrop_path'];
				$poster_path = $tmdb_movie['poster_path'];
				$title = @$tmdb_movie['title'];
				$original_title = @$tmdb_movie['original_title'];
				$tagline = @$tmdb_movie['tagline'];
				$overview = @$tmdb_movie['overview'];
				$release_date = @$tmdb_movie['release_date'];
				$year = @current(explode('-', $release_date));
				$runtime = @$tmdb_movie['runtime'];
				$genres = array();
				foreach ($tmdb_movie['genres'] as $genre) 
				$genres[] = $genre['name'];
				$production_companies = array();
				foreach ($tmdb_movie['production_companies'] as $company) 
				$production_companies[] = $company['name'];
				$production_countries = array();
				foreach ($tmdb_movie['production_countries'] as $country) 
				$production_countries[] = $country['name'];
				$backdrops_file_path = array();
				foreach($tmdb_movie['images']['backdrops'] as $backdrops)
				$backdrops_file_path [] = $backdrops['file_path'];
				//$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				if (!empty($backdrops_file_path)) {
					$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				} else {
					$random_backdrops_file_path = $backdrop_path;
				}
				$type = "movie";
				$params = "movie/".$movieid;
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
				$backdrop_path = $tmdb_movie['backdrop_path'];
				$poster_path = $tmdb_movie['poster_path'];
				$title = @$tmdb_movie['title'];
				$original_title = @$tmdb_movie['original_title'];
				$tagline = @$tmdb_movie['tagline'];
				$overview = @$tmdb_movie['overview'];
				$release_date = @$tmdb_movie['release_date'];
				$year = @current(explode('-', $release_date));
				$runtime = @$tmdb_movie['runtime'];
				$genres = array();
				foreach ($tmdb_movie['genres'] as $genre) 
				$genres[] = $genre['name'];
				$production_companies = array();
				foreach ($tmdb_movie['production_companies'] as $company) 
				$production_companies[] = $company['name'];
				$production_countries = array();
				foreach ($tmdb_movie['production_countries'] as $country) 
				$production_countries[] = $country['name'];
				$backdrops_file_path = array();
				foreach($tmdb_movie['images']['backdrops'] as $backdrops)
				$backdrops_file_path [] = $backdrops['file_path'];
				//$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				if (!empty($backdrops_file_path)) {
					$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				} else {
					$random_backdrops_file_path = $backdrop_path;
				}
				$type = "movie";
				$params = "movie/".$movieid;
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
				file_put_contents($file_movie, $tmdb_movie_url);
				$tmdb_movie = json_decode(file_get_contents($file_movie), true);
			} else {
				file_put_contents($file_movie, $response);
				$tmdb_movie = json_decode(file_get_contents($file_movie), true);
			}
			$imdb_id = @$tmdb_movie['imdb_id'];
			$tmdb_id = $tmdb_movie['id'];
			$backdrop_path = $tmdb_movie['backdrop_path'];
			$poster_path = $tmdb_movie['poster_path'];
			$title = @$tmdb_movie['title'];
			$original_title = @$tmdb_movie['original_title'];
			$tagline = @$tmdb_movie['tagline'];
			$overview = @$tmdb_movie['overview'];
			$release_date = @$tmdb_movie['release_date'];
			$year = @current(explode('-', $release_date));
			$runtime = @$tmdb_movie['runtime'];
			$genres = array();
			foreach ($tmdb_movie['genres'] as $genre) 
			$genres[] = $genre['name'];
			$production_companies = array();
			foreach ($tmdb_movie['production_companies'] as $company) 
			$production_companies[] = $company['name'];
			$production_countries = array();
			foreach ($tmdb_movie['production_countries'] as $country) 
			$production_countries[] = $country['name'];
			$backdrops_file_path = array();
			foreach($tmdb_movie['images']['backdrops'] as $backdrops)
			$backdrops_file_path [] = $backdrops['file_path'];
			//$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				if (!empty($backdrops_file_path)) {
					$random_backdrops_file_path = array_rand($backdrops_file_path,1);
				} else {
					$random_backdrops_file_path = $backdrop_path;
				}
			$type = "movie";
			$params = "movie/".$movieid;
		}
	} else if (!empty($_GET['tv']) && empty($_GET['season']) && empty($_GET['episode']) && empty($_GET['movie'])) {
		$tvid = isset($_GET['tv']) ? trim($_GET['tv']) : NULL;
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
			$backdrop_path = $tmdb_tv['backdrop_path'];
			$poster_path = $tmdb_tv['poster_path'];
			$title = @$tmdb_tv['name'];
			$original_title = @$tmdb_movie['original_name'];
			$title_tv = $title;
			$tagline = @$tmdb_tv['tagline'];
			$overview = @$tmdb_tv['overview'];
			$first_air_date = @$tmdb_tv['first_air_date'];
			$last_air_date = @$tmdb_tv['last_air_date'];
			$release_date = $last_air_date;
			$year = @current(explode('-', $last_air_date));
			$number_of_episodes = @$tmdb_tv['number_of_episodes'];
			$number_of_seasons = @$tmdb_tv['number_of_seasons']; 
			$runtime = @$tmdb_tv['episode_run_time'][0];
			$genres = array();
			foreach ($tmdb_tv['genres'] as $genre) 
			$genres[] = $genre['name'];
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
		$cache_file = "tv_".$tvid."_".slugUri($title);
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
		$original_title = @$tmdb_movie['original_name'];
		$overview = @$tmdb_tv['overview'];
		$backdrop_path = $tmdb_tv['backdrop_path'];
		$genres = array();
		foreach ($tmdb_tv['genres'] as $genre) 
		$genres[] = $genre['name'];
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
		$tmdb_id = $tmdb_season['id'];
		$poster_path = $tmdb_season['poster_path'];
		$title_sea = @$tmdb_season['name'];
		$tagline = @$tmdb_season['tagline'];
		$air_date = @$tmdb_season['air_date'];	
		$year = @current(explode('-', $air_date));	
		$type = "season";
		$title = $title_tv . " - " . $title_sea;
		$title_site = $title . " Season " . $seasonid;
		$params = "tv/".$tvid."/season/".$seasonid;
		$cache_file = "tv_".$tvid."_season_".$seasonid;

		$type = "season";
		$title = $title_tv . " - " . $title_sea;
		$title_site = "Watch " . $title . " for free - ";
		$params = "tv/".$tvid."/season/".$seasonid;
		$cache_file = "tv_".$tvid."_season_".$seasonid;

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
		$genres = array();
		foreach ($tmdb_tv['genres'] as $genre) 
		$genres[] = $genre['name'];
		$production_companies = array();
		foreach ($tmdb_tv['production_companies'] as $company) 
		$production_companies[] = $company['name'];
		$seasons = array();
		foreach ($tmdb_tv['seasons'] as $season) 
		$seasons[] = $season['poster_path'];
		$poster_path = @$seasons[$seasonid];

		// Episode API
		$cache_file = "tv-".$tvid."-season-".$seasonid."-episode-".$episodeid."-".$title_uri;
		$tmdb_epi_url = "https://api.themoviedb.org/3/tv/".$tvid."/season/".$seasonid."/episode/".$episodeid."?api_key=".$tmdb_api."&append_to_response=images,video";
		$file_epis = dirname(__file__)."/cache/".$cache_file.".json";

		if (file_exists($file_epis)) {
			$tmdb_epi = json_decode(file_get_contents($file_epis), true);
			if (!empty($tmdb_epi)) { 
				$tmdb_id = $tmdb_epi['id'];
				$backdrop_path = isset($tmdb_epi['still_path']) ? "//image.tmdb.org/t/p/w780".$tmdb_epi['still_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no-backdrop.jpg";
				$title_epi = @$tmdb_epi['name'];
				$tagline = @$tmdb_epi['tagline'];
				$overview = @$tmdb_epi['overview'];
				$release_date = @$tmdb_epi['air_date'];
				$year = @current(explode('-', $release_date));
				$runtime = @$tmdb_epi['runtime'];
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
					file_put_contents($file_epis, $tmdb_epi_url);
					$tmdb_epi = json_decode(file_get_contents($file_epis), true);
				} else {
					file_put_contents($file_epis, $response);
					$tmdb_epi = json_decode(file_get_contents($file_epis), true);
				}
				$tmdb_id = $tmdb_epi['id'];
				$backdrop_path = @$tmdb_epi['still_path'];
				$title_epi = @$tmdb_epi['name'];
				$tagline = @$tmdb_epi['tagline'];
				$overview = @$tmdb_epi['overview'];
				$release_date = @$tmdb_epi['air_date'];
				$year = @current(explode('-', $release_date));
				$runtime = @$tmdb_epi['runtime'];
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
					file_put_contents($file_epis, $tmdb_epi_url);
					$tmdb_epi = json_decode(file_get_contents($file_epis), true);
				} else {
					file_put_contents($file_epis, $response);
					$tmdb_epi = json_decode(file_get_contents($file_epis), true);
				}
				$tmdb_id = $tmdb_epi['id'];
				$backdrop_path = @$tmdb_epi['still_path'];
				$title_epi = @$tmdb_epi['name'];
				$tagline = @$tmdb_epi['tagline'];
				$overview = @$tmdb_epi['overview'];
				$release_date = @$tmdb_epi['air_date'];
				$year = @current(explode('-', $release_date));
				$runtime = @$tmdb_epi['runtime'];
				$type = "episode";
				$title = $title_tv . " - " . $title_epi;
				$title_site = "Watch " . $title_tv . " - Season " . $seasonid . " - Episode " . $episodeid . ": " . $title_epi . " for free - ";
				$params = "tv/".$tvid."/season/".$seasonid."/episode/".$episodeid;
		}
	} 
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php if ($type == "episode") { echo $title_site; } else { echo $title; } ?> Description - <?=TITLE_SITE?></title>
		<meta name="author" content="<?=$_SERVER['HTTP_HOST']?>">
		<meta name="copyright" content="<?=$_SERVER['HTTP_HOST']?>">
		<meta name="description" content="<?=str_replace(array('"', "'"), '', $overview)?>">
		<link rel="profile" href="//gmpg.org/xfn/11">
		<link rel='stylesheet' id='bootstrap-css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' type='text/css' media='all' />
		<link rel='stylesheet' id='awesome-css' href='//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' type='text/css' media='all' />
		<link rel='stylesheet' id='roboto-css' href='//fonts.googleapis.com/css?family=Roboto%3A400%2C300%2C700' type='text/css' media='all' />
		<link rel='stylesheet' id='default-css' href='//<?=$_SERVER['HTTP_HOST']?>/assets/css/default.min.css' type='text/css' media='all' />
		<link rel='stylesheet' id='magelo-css' href='//<?=$_SERVER['HTTP_HOST']?>/assets/css/style.min.css' type='text/css' media='all' />
		<script type='text/javascript' src="//<?=$_SERVER['HTTP_HOST']?>/assets/js/clipboard.min.js"></script>
	</head>
	<body class="single single-movie postid-3078 desktop subdo single-movie-offer">
		
		<div id="page">
			<header id="masthead" class="site-header" role="banner">
				<nav id="site-navigation" class="navbar navbar-fixed-top navbar-default main-navigation" role="navigation">
					<div class="container">
						<div class="row">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-menu" aria-expanded="false">
									<span class="sr-only">Primary Menu</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<div class="site-branding">
									<h1 class="site-title"><a href="//<?=$_SERVER['HTTP_HOST']?>/desc/" rel="home"><span class="text-color glyphicon glyphicon-facetime-video"></span> <?=MENU_NAME?></a></h1>
								</div>
							</div>
							<div id="primary-menu" class="collapse navbar-collapse">
								<!--<ul id="menu-pages" class="nav navbar-nav nav-menu" aria-expanded="false">
									<li id="menu-item-1033" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1033">
										<a title="Toprated Movies" href="//<?=$_SERVER['HTTP_HOST']?>/toprated.php">Toprated Movies</a>
									</li>
									<li id="menu-item-1034" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1034">
										<a title="Popular Movies" href="//<?=$_SERVER['HTTP_HOST']?>/popular.php">Popular Movies</a>
									</li>
									<li id="menu-item-1035" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1035">
										<a title="New Realese Movies" href="//<?=$_SERVER['HTTP_HOST']?>/upcoming.php">Upcoming Movies</a>
									</li>
								</ul>-->
								<form method="get" class="navbar-form navbar-right" role="search" action="//<?=$_SERVER['HTTP_HOST']?>/desc/">
									<div class="input-group">
										<input type="text" name="s" class="form-control" placeholder="Search">
										<span class="input-group-btn">
											<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
										</span>
									</div>
								</form>
							</div>
						</div>
					</div>
				</nav>
			</header>
			<div id="content" class="site-content clearfix">
				<div class="container" itemscope itemtype="//schema.org/Movie">
					<div class="row">
						<div class="content-area col-md-12" id="primary">
							<main class="site-main" id="main" role="main">
								<div class="row">
									<div class="col-md-12">
									<div class="margin-bottom-20 clearfix"></div>
										<ul class="breadcrumb" id="crumbs" typeof="BreadcrumbList" vocab="//schema.org/">
											<li itemprop="itemListElement" itemscope itemtype="//schema.org/ListItem">
												<span itemprop="name">
													<a href="//<?=$_SERVER['HTTP_HOST']?>/" itemprop="item">
														<i class="glyphicon glyphicon-home"></i>
													</a>
												</span>
											</li>
											<li itemprop="itemListElement" itemscope itemtype="//schema.org/ListItem">
												<span itemprop="name">
													<a href="//<?=$_SERVER['HTTP_HOST']?>/desc/" itemprop="item">Desc</a>
												</span>
											</li>
											<li class="active"><?=$title?></li>
										</ul>
									</div>
								</div>
								<?php $generalID = isset($_GET['movie']) ? $_GET['movie'] : $_GET['tv']; ?>
								<article class="landing_page post-<?=$movieid?>" id="post-<?=$movieid?>">
									<header class="entry-header">
										<h1 class="entry-title text-ellipsis"><span itemprop="name"><?=$title?></span></h1>
									</header>
									<!-- .entry-header 
									<div class="entry-content col-md-12">-->
										<div class="tab-content">
											<div class="tab-pane fade in active" role="tabpanel">
												<ul class="nav nav-tabs">
													<li class="active"><a href="#"><h3>INFORMATION</h3></a></li>
												</ul>
												<div class="margin-bottom-10 clearfix"></div>

												<table class="table table-condensed table-bordered table-hover">
													<tbody>
														<tr>
															<th width="150px">
																<h5>Title</h5>
															</th>
															<td data-clipboard-text="<?=$title?>">
																<h5><?=$title?></h5>
															</td>
														</tr>
														<tr>
															<th width="150px"><h5>URL Movie/TV Show w/o sub_id</h5></th>
															
															<td data-clipboard-text="<?=SSL_URI?>://<?=$_SERVER['HTTP_HOST']?>/<?=$type?>/<?=$generalID?>/<?=slugUri($title)?>"><h5><?=SSL_URI?>://<?=$_SERVER['HTTP_HOST']?>/<?=$type?>/<?=$generalID?>/<?=slugUri($title)?></h5></td>
														</tr>
														<tr>
															<th><h5>URL Movie/TV Show with sub_id</h5></th>
															
															<td data-clipboard-text="<?=SSL_URI?>://<?=$_SERVER['HTTP_HOST']?>/<?=$type?>=<?=$generalID?>/<?=slugUri($title)?>/<?=$sub_id?>"><h5><?=SSL_URI?>://<?=$_SERVER['HTTP_HOST']?>/<?=$type?>/<?=$generalID?>/<?=slugUri($title)?>/<?=$sub_id?></h5></td>
														</tr>
														<?php
														$bitly_url = "https://api-ssl.bitly.com/v3/user/link_save?access_token=".BITLY_ACCESS_TOKEN."&longUrl=".SSL_URI."://".$_SERVER['HTTP_HOST']."/".$type."/".$generalID."/".slugUri($title);
														$bitly_short = json_decode(file_get_contents($bitly_url), true);
														$bitly_short_url = $bitly_short['data']['link_save']['link'];
														echo '
														<tr>
															<th><h5>Short Link w/o sub_id</h5></th>
															<td data-clipboard-text="'.$bitly_short_url.'"><h5>'.$bitly_short_url.'</h5></td>
														</tr>';
														?>
														<?php
														$bitly_url_sub = "https://api-ssl.bitly.com/v3/user/link_save?access_token=".BITLY_ACCESS_TOKEN."&longUrl=".SSL_URI."://".$_SERVER['HTTP_HOST']."/".$type."/".$generalID."/".slugUri($title)."/".$sub_id;
														$bitly_short_sub = json_decode(file_get_contents($bitly_url_sub), true);
														$bitly_short_url_sub = $bitly_short_sub['data']['link_save']['link'];
														echo '
														<tr>
															<th><h5>Short Link with sub_id</h5></th>
															<td data-clipboard-text="'.$bitly_short_url_sub.'"><h5>'.$bitly_short_url_sub.'</h5></td>
														</tr>';
														?>
													</tbody>
												</table>

												<?php if (!empty($_GET['tv']) || !empty($_GET['season']) || !empty($_GET['episode'])) { ?>
												<ul class="nav nav-tabs">
													<li class="active"><a href="#"><h3>SEASON LISTS</h3></a></li>
												</ul>
												<div class="margin-bottom-10 clearfix"></div>

												<table class="table table-condensed table-bordered table-hover">
													<tbody>
													<?php 
													foreach ($tmdb_tv['seasons'] as $season) {
													$season_number = $season['season_number'];
													$season_episode_count = $season['episode_count'];
													$season_air_date = $season['air_date']; 
													
														if ($season_number!==0) { 

														echo '
														<tr>
															<th width="150px"><a href="//'.$_SERVER['HTTP_HOST'].'/spam/?tv='.$generalID.'&season='.$season_number.'&title='.slugUri($title).'&sub_id='.$sub_id.'"><h5>Season ' . $season_number . '</h5></a></th>
															<td>
																<h5><a href="//'.$_SERVER['HTTP_HOST'].'/spam/?tv='.$generalID.'&season='.$season_number.'&title='.slugUri($title).'&sub_id='.$sub_id.'">' . $season_episode_count . ' Episode(s) - ' . $season_air_date . '</a></h5>
															</td>
														</tr>
														';
														} 
													} 
													?>
													</tbody>
												</table>
												<?php } ?>

												<?php if (!empty($_GET['tv']) && !empty($_GET['season']) && empty($_GET['episode']) && empty($_GET['movie'])) { ?>
												<ul class="nav nav-tabs">
													<li class="active"><a href="#"><h3>EPISODE LISTS</h3></a></li>
												</ul>
												<div class="margin-bottom-10 clearfix"></div>
												<table class="table table-condensed table-bordered table-hover">
													<tbody>
													<?php 
														foreach ($tmdb_season['episodes'] as $episode) {
														$episode_number = $episode['episode_number'];
														$episode_name = $episode['name'];
														$episode_still_path = $episode['still_path'];
														$episode_air_date = $episode['air_date']; 
													
														if ($episode_name) {
															echo '
														<tr>
															<th width="100px">
																<h5>Episode '.$episode_number.'</h5>
															</th>
															<td>
																<h5><a href="//'.$_SERVER['HTTP_HOST'].'/spam/?tv='.$generalID.'&season='.$season_number.'&episode='.$episode_number.'&title='.slugUri($episode_name).'&sub_id='.$sub_id.'">' . $episode_name . ' - ' . $episode_air_date . '</a></h5>
															</td>
														</tr>';
														}
													}
													?>
													</tbody>
												</table>
												<?php } ?>


												<ul class="nav nav-tabs">
													<li class="active"><a href="#"><h3>Title Generator</h3></a></li>
												</ul>
												<div class="margin-bottom-10 clearfix"></div>
												<table class="table table-condensed table-bordered table-hover">
													<tbody>
														<tr>
															<th width="100px">
																<h5>Title 1</h5>
															</th>
															<td data-clipboard-text="<?=$title?> Full Movie">
																<h5><?=$title?> Full Movie</h5>
															</td>
														</tr>
														<tr>
															<th width="100px">
																<h5>Title 2</h5>
															</th>
															<td data-clipboard-text="Watch <?=$title?> <?=$year?> Full Movie Online">
																<h5>Watch <?=$title?> <?=$year?> Full Movie Online</h5>
															</td>
														</tr>
														<tr>
															<th width="100px">
																<h5>Title 3</h5>
															</th>
															<td data-clipboard-text="<?=$title?> <?=$year?> Full Movie Streaming Online in HD-720p Video Quality">
																<h5><?=$title?> <?=$year?> Full Movie Streaming Online in HD-720p Video Quality</h5>
															</td>
														</tr>
														<tr>
															<th width="100px">
																<h5>Title 4</h5>
															</th>
															<td data-clipboard-text="<?=$title?> <?=$year?> Full Movie">
																<h5><?=$title?> <?=$year?> Full Movie</h5>
															</td>
														</tr>
														<tr>
															<th width="100px">
																<h5>Title 5</h5>
															</th>
															<td data-clipboard-text="Where to Download <?=$title?> <?=$year?> Full Movie ?">
																<h5>Where to Download <?=$title?> <?=$year?> Full Movie ?</h5>
															</td>
														</tr>
														<tr>
															<th width="100px">
																<h5>Title 6</h5>
															</th>
															<td data-clipboard-text="Watch <?=$title?> Full Movie">
																<h5>Watch <?=$title?> Full Movie</h5>
															</td>
														</tr>
														<tr>
															<th width="100px">
																<h5>Title 7</h5>
															</th>
															<td data-clipboard-text="Watch <?=$title?> Full Movie Online">
																<h5>Watch <?=$title?> Full Movie Online</h5>
															</td>
														</tr>
														<tr>
															<th width="100px">
																<h5>Title 8</h5>
															</th>
															<td data-clipboard-text="Watch <?=$title?> Full Movie HD 1080p">
																<h5>Watch <?=$title?> Full Movie HD 1080p</h5>
															</td>
														</tr>
														<tr>
															<th width="100px">
																<h5>Title 9</h5>
															</th>
															<td data-clipboard-text="<?=$title?> <?=$year?> Full Movie">
																<h5><?=$title?> <?=$year?> Full Movie</h5>
															</td>
														</tr>
													</tbody>
												</table>
												<?php
												$casturl = "https://api.themoviedb.org/3/".$params."/credits?api_key=".$tmdb_api;
												$file_credits = dirname(__file__).'/cache/'.$cache_file."_credits.json";
												if (file_exists($file_credits)) {
													$castcrew = json_decode(file_get_contents($file_credits), true);
													if (!empty($castcrew)) { 
														$name = array();
														foreach ($castcrew['cast'] as $cast)  
														$name[] = $cast['name'];
														
													} else {
														$curl = curl_init();
														curl_setopt_array($curl, array(
															CURLOPT_URL => $casturl,
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
															file_put_contents($file_credits, file_get_contents($casturl));
															$castcrew = json_decode(file_get_contents($file_credits), true);
														} else {
															file_put_contents($file_credits, $response);
															$castcrew = json_decode(file_get_contents($file_credits), true);
														}
														$name = array();
														foreach ($castcrew['cast'] as $cast)  
														$name[] = $cast['name'];														
													}
												} else {
													$curl = curl_init();
													curl_setopt_array($curl, array(
														CURLOPT_URL => $casturl,
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
														file_put_contents($file_credits, file_get_contents($casturl));
														$castcrew = json_decode(file_get_contents($file_credits), true);
													} else {
														file_put_contents($file_credits, $response);
														$castcrew = json_decode(file_get_contents($file_credits), true);
													}
													$name = array();
													foreach ($castcrew['cast'] as $cast)  
													$name[] = $cast['name'];

												}
												?>
												<ul class="nav nav-tabs">
													<li class="active"><a href="#"><h3>Description Generator - Deskripsi Nyepam FB & Situs</h3></a></li>
												</ul>
												<div class="margin-bottom-10 clearfix"></div>
												<table class="table table-condensed table-bordered table-hover">
													<tbody>
														<tr>
															<th width="150px">
																<h5>Description 1</h5>
															</th>
															<td data-clipboard-text="Watch <?=$title?> Full Movie Online
»»» <?=$bitly_short_url_sub?>

<?=$title?> Official Teaser Trailer #1 (2017) - <?=$name[0]?> <?=$production_companies[0]?> Movie HD

<?=$title?> Synopsis:
<?=$overview?>


Instructions to Download <?=$title?> Full Movie:
1. Click the link »» <?=$bitly_short_url_sub?>

2. Create you free account/NO-Ads/No Charge!!! & you will be redirected to your movie!!

Watch <?=$title?> Online, <?=$title?> Full Movie, <?=$title?> in HD 1080p, Watch <?=$title?> Full Movie Free Online Streaming, Watch <?=$title?> in HD.

#<?=str_replace(" ", "", $title)?>Movie
#<?=str_replace(" ", "", $title)?>FullMovie
#<?=str_replace(" ", "", $title)?>Streaming
#watch<?=str_replace(" ", "", $title)?>">
																	<h5><strong>Watch <?=$title?> Full Movie Online</strong><br />
»»» <?=$bitly_short_url_sub?><br />
<?=$title?> Official Teaser Trailer #1 (2017) - <?=$name[0]?> <?=$production_companies[0]?> Movie HD<br /><br />

<strong><?=$title?> Synopsis:</strong><br />
<?=$overview?><br /><br />

<strong>Instructions to Download <?=$title?> Full Movie:</strong><br />
1. Click the link »» <?=$bitly_short_url_sub?><br />
2. Create you free account/NO-Ads/No Charge!!! & you will be redirected to your movie!!<br /><br />

Watch <?=$title?> Online, <?=$title?> Full Movie, <?=$title?> in HD 1080p, Watch <?=$title?> Full Movie Free Online Streaming, Watch <?=$title?> in HD.<br /><br />

#<?=str_replace(" ", "", $title)?>Movie<br />
#<?=str_replace(" ", "", $title)?>FullMovie<br />
#<?=str_replace(" ", "", $title)?>Streaming<br />
#watch<?=str_replace(" ", "", $title)?></h5>
															</td>
														</tr>
														<tr>
															<th width="150px">
																<h5>Description 2</h5>
															</th>
															<td data-clipboard-text="Oh, my God.... TOOK ME HOURS TO FIND, FINALLY GOT THE LINK,
☛ <?=$title?> Full Movie Streaming
Playnow ➡ <?=$bitly_short_url_sub?>

Release : <?=$release_date?>

Runtime : <?=hour_min($runtime)?>

Genre : <?=implode(', ', $genres)?>

Stars: <?=implode(", ", $name)?>

Overview : <?=$overview?>

✂UNCUT Don’t miss this, enjoy it now
Thank you very much
Good Movie be Happy enjoy to Watch...">
																<h5>
																	Oh, my God.... TOOK ME HOURS TO FIND, FINALLY GOT THE LINK,<br />
																	☛ <?=$title?> Full Movie Streaming<br />
																	Playnow ➡ <?=$bitly_short_url_sub?><br />
																	Release : <?=$release_date?><br />
																	Runtime : <?=hour_min($runtime)?><br />
																	Genre : <?=implode(', ', $genres)?><br />
																	Stars: <?=implode(", ", $name)?><br />
																	Overview : <?=$overview?>.<br />
																	✂UNCUT Don’t miss this, enjoy it now<br />
																	Thank you very much<br />
																	Good Movie be Happy enjoy to Watch...
																</h5>
															</td>
														</tr>
														<tr>
															<th width="150px"><h5>Description 3</h5></th>
															<td data-clipboard-text="Watch <?=$title?> Full Movies Online Free HD @ <?=$bitly_short_url_sub?>


<?=$title?> Official Teaser Trailer #1 (<?=$year?>) - <?=$name[0]?> <?=$production_companies[0]?> Movie HD

Movie Synopsis:
<?=$overview?>


<?=$title?> in HD 1080p, Watch <?=$title?> in HD, Watch <?=$title?> Online, <?=$title?> Full Movie, Watch <?=$title?> Full Movie Free Online Streaming">
																	<h5>Watch <?=$title?> Full Movies Online Free HD @ <?=$bitly_short_url_sub?><br /><br />
<?=$title?> Official Teaser Trailer #1 (<?=$year?>) - <?=$name[0]?> <?=$production_companies[0]?> Movie HD<br /><br />
Movie Synopsis:<br />
<?=$overview?><br /><br />
<?=$title?> in HD 1080p, Watch <?=$title?> in HD, Watch <?=$title?> Online, <?=$title?> Full Movie, Watch <?=$title?> Full Movie Free Online Streaming</h5>
															</td>
														</tr>
													</tbody>
												</table>
												<table class="table table-condensed table-bordered table-hover">
													<tr>
														<th><div class="text-center"><h3>Deskripsi Nyepam Posting pakai akun Pertama (Pancingan)</h3></div></th>
													</tr>
													<tr>
														<td data-clipboard-text="help me guys, where can I download and watch <?=$title?> Full Movie Streaming ?">
															<h5>help me guys, where can I download and watch <?=$title?> Full Movie Streaming ?</h5>
														</td>
													</tr>
												</table>
												<table class="table table-condensed table-bordered table-hover">
													<tr>
														<th><div class="text-center"><h3>Deskripsi Nyepam komen pakai akun kedua (jawab dengan nyepam)</h3></div></th>
													</tr>	
													<tr>
														<td data-clipboard-text="Sure, visit here to watch and download <?=$title?> Full movie ☛ <?=$bitly_short_url_sub?>">
															<h5>Sure, visit here to watch and download <?=$title?> Full movie ☛ <?=$bitly_short_url_sub?></h5>
															</div>
														</td>
													</tr>
												</table>
												<table class="table table-condensed table-bordered table-hover">
													<tr>
														<th><div class="text-center"><h3>Deskripsi Nyepam komen pakai akun ketiga (jawab dengan nyepam)</h3></div></th>
													</tr>
													<tr>
														<td data-clipboard-text="To watch and download <?=$title?> Full movie click here please ☛ <?=$bitly_short_url_sub?>">
															<h5>To watch and download <?=$title?> Full movie click here please ☛ <?=$bitly_short_url_sub?></h5>
														</td>
													</tr>
												</table>
												<table class="table table-condensed table-bordered table-hover">
													<tr>
														<th><div class="text-center"><h3>Deskripsi Nyepam Inbok Pancingan (inbok manual, masukan nama yg diinbok di FULLNAME)</h3></div></th>
													</tr>
													<tr>
														<td data-clipboard-text="Hi Guy's, <?=$title?>, Release at <?=$release_date?>, tell me if you want to watch it online streaming, and I will tell you how to watch ;)">
															<h5>Hi Guy's, <?=$title?>, Release at <?=$release_date?>, tell me if you want to watch it online streaming, and I will tell you how to watch ;)</h5>
														</td>
													</tr>

												</table>
												<table class="table table-condensed table-bordered table-hover">
													<tr>
														<th><div class="text-center"><h3>Deskripsi Nyepam Inbok Balesan</h3></div></th>
													</tr>
													<tr>
														<td data-clipboard-text="ah ok, Please request the ticket of <?=$title?> here >> <?=$bitly_short_url_sub?>">
															<h5>ah ok, Please request the ticket of <?=$title?> here >> <?=$bitly_short_url_sub?></h5>
														</td>
													</tr>
												</table>
												<ul class="nav nav-tabs">
													<li class="active"><a href="#"><h3>Desc Facebook Marketing Tool 1</h3></a></li>
												</ul>
												<div class="margin-bottom-10 clearfix"></div>
												<table class="table table-condensed table-bordered table-hover">
													<tbody>
														<tr>
															<th width="100px"><h5>Title</h5></th>
															<td data-clipboard-text="<?=$title?> High Quality">
																<h5><?=$title?> High Quality</h5>
															</td>
														</tr>
														<?php
														$backdrop_path_style = isset($backdrops_file_path[$random_backdrops_file_path]) ? "//image.tmdb.org/t/p/original".trim($backdrops_file_path[$random_backdrops_file_path]) : "//".$_SERVER['HTTP_HOST']."/assets/img/warnerbros.jpg";
														?>
														<tr>
															<th width="100px"><h5>URL img</h5></th>
															<td data-clipboard-text="<?=$backdrop_path_style?>">
																<h5><?=$backdrop_path_style?></h5>
															</td>
														</tr>
														<tr>
															<th width="100px"><h5>Web Manipulasi</h5></th>
															<td data-clipboard-text="Netflix.com">
																<h5>Netflix.com</h5>
															</td>
														</tr>
														<tr>
															<th width="100px"><h5>Url Manipulasi</h5></th>
															<td data-clipboard-text="<?=$bitly_short_url_sub?>">
																<h5><?=$bitly_short_url_sub?></h5>
															</td>
														</tr>
														<tr>
															<th width="100px"><h5>Pesan</h5></th>
															<td data-clipboard-text="Good Movie">
																<h5>Good Movie</h5>
															</td>
														</tr>
														<tr>
															<th width="100px"><h5>Deskripsi</h5></th>
															<td data-clipboard-text="<?=$overview?>">
																<h5><?=$overview?></h5>
															</td>
														</tr>
													</tbody>
												</table>
												<ul class="nav nav-tabs">
													<li class="active"><a href="#"><h3>Desc Facebook Marketing Tool 2</h3></a></li>
												</ul>
												<div class="margin-bottom-10 clearfix"></div>
												<table class="table table-condensed table-bordered table-hover">
													<tbody>
														<tr>
															<th width="100px"><h5>Title</h5></th>
															<td data-clipboard-text="<?=$title?> Full Movie">
																<h5><?=$title?> Full Streaming</h5>
															</td>
														</tr>
														<tr>
															<th width="100px"><h5>URL img</h5></th>
															<td data-clipboard-text="<?=$backdrop_path_style?>">
																<h5><?=$backdrop_path_style?></h5>
															</td>
														</tr>
														<tr>
															<th width="100px"><h5>Web Manipulasi</h5></th>
															<td data-clipboard-text="Netflix.com">
																<h5>Netflix.com</h5>
															</td>
														</tr>
														<tr>
															<th width="100px"><h5>Url Manipulasi</h5></th>
															<td data-clipboard-text="<?=$bitly_short_url_sub?>">
																<h5><?=$bitly_short_url_sub?></h5>
															</td>
														</tr>
														<tr>
															<th width="100px"><h5>Pesan</h5></th>
															<td data-clipboard-text="Good Movie">
																<h5>Good Movie</h5>
															</td>
														</tr>
														<tr>
															<th width="100px"><h5>Deskripsi</h5></th>
															<td data-clipboard-text="<?=implode(", ", $name)?>">
																<h5><?=implode(", ", $name)?></h5>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									<!--</div>
									 .entry-content -->
								</article>
							<!-- #post-## -->
							</main>
							<!-- #main -->
						</div>
						<!-- #primary -->
						<!-- #secondary -->
					</div>
				</div>
			</div>
			<footer id="colophon" class="site-footer" role="contentinfo">
				<div id="movie-genre-list">
					<div class="container">
						<div class="row">
							<ul class="clearfix">
							<?php
							if (!empty($_GET['tv']) || !empty($_GET['season']) || !empty($_GET['episode'])) { $type = "tv"; } else { $type = "movie"; }
							$genres_list = dirname(__file__) . '/genres/genres_' . $type . '.json';
							$genres = json_decode(file_get_contents($genres_list), true);
							foreach ($genres['genres'] as $genre) {
							echo '
								<li class="col-md-3 col-sm-4 col-xs-6"><a href="//'.$_SERVER['HTTP_HOST'].'/genre-'.$type.'/'.$genre['id'].'/'.slugUri($genre['name']).'"><span class="fa fa-circle-o"></span> '.$genre['name'].'</a></li>';
							}
							?>
							</ul>
						</div>
					</div>
				</div>

				<div class="site-info clearfix">
					<div class="container text-center">
						<div class="disclaimer"><?=TITLE_SITE?> is in no way intended to support illegal activity. We uses Search API to find the overview of movie over the internet, but we don't host any files. All movie files are the property of their respective owners, please respect their copyrighted creations. If you find movie that should not be here please report them. Read our DMCA Policies and Disclaimer for more details.</div>
					</div>
					<div class="menu-footer-menu-container">
						<ul id="footer-menu" class="footer-navigation text-center">
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1039"><a href="#">Privacy Policy</a></li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1040"><a href="#">Disclaimer</a></li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1041"><a href="#">DMCA</a></li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1042"><a href="#">Contact</a></li>
						</ul>
					</div>
					<div class="container text-center">Copyright &copy; 2016 <?=TITLE_SITE?>. All rights reserved.<br></div>
				</div>
			</footer>
		</div>

		<script>
		var divs = document.querySelectorAll('div');
    	var clipboard = new Clipboard(divs);

    	var tds = document.querySelectorAll('td');
    	var clipboard = new Clipboard(tds);

	    clipboard.on('success', function(e) {
	        console.log(e);
	    });
	
	    clipboard.on('error', function(e) {
	        console.log(e);
	    });
	    </script>

		<script type='text/javascript' src='//code.jquery.com/jquery-2.2.0.min.js'></script>
		<script type='text/javascript' src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/cycle.min.js'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/carousel.min.js'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/preloader.min.js'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/scripts.min.js'></script>
		<?php include dirname(__FILE__)."/includes/histats.php"; ?>

	</body>
</html>