<?php
	include dirname(__FILE__)."/includes/config.php";
	include dirname(__FILE__)."/includes/function_slug.php";
	$tmdb_api = trim($TMDB_API[$randomTMDB_API]);
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$search = isset($_GET['s']) ? $_GET['s'] : NULL;
	$sub_id = isset($_GET['sub_id']) ? $_GET['sub_id'] : SUB_ID;
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=TITLE_SITE?> <?php if ($page>=2) { echo "- Page " . $page; } ?></title>
	<meta name="author" content="<?=$_SERVER['HTTP_HOST']?>">
	<meta name="copyright" content="<?=$_SERVER['HTTP_HOST']?>">
	<meta name="description" content="Search Result For <?=$search?> Movies and TV Show <?php if ($page>=2) { echo "page " . $page . " "; } ?>">
	
	<link rel="profile" href="//gmpg.org/xfn/11">
	<link rel='stylesheet' id='bootstrap-css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='awesome-css' href='//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='roboto-css' href='//fonts.googleapis.com/css?family=Roboto%3A400%2C300%2C700' type='text/css' media='all' />
	<link rel='stylesheet' id='default-css' href='//<?=$_SERVER['HTTP_HOST']?>/assets/css/default.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='magelo-css' href='//<?=$_SERVER['HTTP_HOST']?>/assets/css/style.min.css' type='text/css' media='all' />
</head>

<body class="archive tax-genre term-action desktop subdo single-movie-offer">
	<div class="site" id="page">
		<a class="skip-link screen-reader-text" href="#main">Skip to content</a>

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
								<ul id="menu-pages" class="nav navbar-nav nav-menu" aria-expanded="false">
									<!--<li id="menu-item-1033" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1033">
										<a title="Toprated Movies" href="//<?=$_SERVER['HTTP_HOST']?>/toprated.php">Toprated Movies</a>
									</li>
									<li id="menu-item-1034" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1034">
										<a title="Popular Movies" href="//<?=$_SERVER['HTTP_HOST']?>/popular.php">Popular Movies</a>
									</li>
									<li id="menu-item-1035" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1035">
										<a title="New Realese Movies" href="//<?=$_SERVER['HTTP_HOST']?>/upcoming.php">Upcoming Movies</a>
									</li>-->
								</ul>
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

		<?php if (empty($search)) { ?>
		<div class="site-content clearfix" id="content">
			<div class="container">
				<div class="row">
					<div class="content-area col-md-12" id="primary">
						<main class="site-main" id="main" role="main">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#movies">Movies</a></li>
								<li><a href="#tvshow">TV Show</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade in active" id="movies" role="tabpanel">
									<div id="movie-related" class="row text-center">
									<?php 
									$popular_movie_url = "https://api.themoviedb.org/3/movie/popular?api_key=".$tmdb_api."&language=en-US&limit=18&offset=18&page=".$page;
									if (false !== ($html = @file_get_contents($popular_movie_url))) {
										$popular_movie = json_decode($html, true);
									} else {
										$curl = curl_init();
										curl_setopt_array($curl, array(
											CURLOPT_URL => $popular_movie_url,
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
											$popular_movie = json_decode($response, true);
										}
									}	
									$total_pages = $popular_movie['total_pages'];
									$total_results = $popular_movie['total_results'];
										foreach ($popular_movie['results'] as $result) {
											$popular_movie_poster_path = isset($result['poster_path']) ? "//image.tmdb.org/t/p/w342".$result['poster_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
											$popular_movie_id = $result['id'];
											$popular_movie_title = isset($result['title']) ? $result['title'] : $result['name'];
											echo '
											<div class="col-md-3 col-sm-4 col-xs-6">
												<a href="//'.$_SERVER['HTTP_HOST'].'/spam/?movie='.$popular_movie_id.'&title='.slugUri($popular_movie_title).'&sub_id='.$sub_id.'" target="_blank" data-toggle="tooltip" data-placement="top" title="'.$popular_movie_title.'">
													<img class="img-responsive cover-container" src="'.$popular_movie_poster_path.'" alt="'.$popular_movie_title.'" />
													<div class="list-title">'.$popular_movie_title.'</div>
												</a>
											</div>
											';
										}
									?>
									</div>
									<div class="text-center">
										<nav>
											<ul class="pagination">
												<?php if (!empty($popular_movie_id)) { ?>
													<li class="disabled hidden-xs"><span><span aria-hidden="true">Page <?=$page?> of <?=$total_pages?></span></span></li>
												<?php } if (($page==1) || ($page==2)) { ?>
													<li><a aria-label="Prev" href="//<?=$_SERVER['HTTP_HOST']?>/desc/"><span class='hidden-xs'>Prev</span> &lsaquo;</a></li>
												<?php } if ($page>=3) { ?>
													<li><a aria-label="Prev" href="//<?=$_SERVER['HTTP_HOST']?>/desc/?page=<?=$page-1?>"><span class='hidden-xs'>Prev</span> &lsaquo;</a></li>
												<?php } ?>
												<?php 
												if ($total_results>=20) {
													$pagination = "";
													$limit = 5;

													if ($total_pages >=1 && $page <= $total_pages) {
														$count = 1;
														$pagination = "";
														if ($page > ($limit/2)) { 
															$pagination .= '<li><a aria-label="First" href="//'.$_SERVER['HTTP_HOST'].'/desc/">1</a></li>
																<li><span><span aria-hidden="true">...</span></span></li>';
														}
														for ($x=$page; $x<=$total_pages;$x++) {
														if ($count < $limit)
															if ($x==1) {
																$pagination .= "<li class=\"active\"><span>".$page."<span class=\"sr-only\">(current)</span></span></li>";
															} else if ($x==$page) {
																$pagination .= "<li class=\"active\"><span>".$page."<span class=\"sr-only\">(current)</span></span></li>";

															} else { 
																$pagination .= "<li><a href=\"//".$_SERVER['HTTP_HOST']."/desc/?page=".$x."\">".$x." </a></li>";
															}
															$count++;
														}
														if ($page < $total_pages - ($limit/2)) { 
															$pagination .= '<li><span><span aria-hidden="true">...</span></span></li><li><a href="//'.$_SERVER['HTTP_HOST'].'/desc/?page='.$total_pages.'">'.$total_pages.'</a></li><li><a aria-label="Next" href="//'.$_SERVER['HTTP_HOST'].'/desc/?page='.($page+1).'"><span class="hidden-xs">Next</span> &rsaquo;</a></li>'; 
														}
													}
													echo $pagination;
												}
												?>
											</ul>
										</nav>
									</div>

								</div>
								<div class="tab-pane" id="tvshow" role="tabpanel">
									<div id="movie-related" class="row text-center">
									<?php 
									$popular_tv_url = "https://api.themoviedb.org/3/tv/popular?api_key=".$tmdb_api."&language=en-US&page=".$page;
									if (false !== ($html = @file_get_contents($popular_tv_url))) {
										$popular_tv = json_decode($html, true);
									} else {
										$curl = curl_init();
										curl_setopt_array($curl, array(
											CURLOPT_URL => $popular_tv_url,
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
											$popular_tv = json_decode($response, true);
										}
									}
									$total_pages = $popular_tv['total_pages'];
									$total_results = $popular_tv['total_results'];
										foreach ($popular_tv['results'] as $result) {
											$popular_tv_poster_path = isset($result['poster_path']) ? "//image.tmdb.org/t/p/w342".$result['poster_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
											$popular_tv_id = $result['id'];
											$popular_tv_title = isset($result['title']) ? $result['title'] : $result['name'];
											echo '
												<div class="col-md-3 col-sm-4 col-xs-6">
													<a href="//'.$_SERVER['HTTP_HOST'].'/spam/?tv='.$popular_tv_id.'&title='.slugUri($popular_tv_title).'&sub_id='.$sub_id.'" target="_blank" data-toggle="tooltip" data-placement="top" title="'.$popular_tv_title.'">
														<img class="img-responsive cover-container" src="'.$popular_tv_poster_path.'" alt="'.$popular_tv_title.'" />
														<div class="list-title">'.$popular_tv_title.'</div>
													</a>
												</div>
												';
										}
									?>
									</div>
									<div class="text-center">
										<nav>
											<ul class="pagination">
												<?php if (!empty($popular_tv_id)) { ?>
													<li class="disabled hidden-xs"><span><span aria-hidden="true">Page <?=$page?> of <?=$total_pages?></span></span></li>
												<?php } if (($page==1) || ($page==2)) { ?>
													<li><a aria-label="Prev" href="//<?=$_SERVER['HTTP_HOST']?>/desc/"><span class='hidden-xs'>Prev</span> &lsaquo;</a></li>
												<?php } if ($page>=3) { ?>
													<li><a aria-label="Prev" href="//<?=$_SERVER['HTTP_HOST']?>/desc/?page=<?=$page-1?>"><span class='hidden-xs'>Prev</span> &lsaquo;</a></li>
												<?php } ?>
												<?php 
												if ($total_results>=20) {
													$pagination = "";
													$limit = 5;
													if ($total_pages >=1 && $page <= $total_pages) {
														$count = 1;
														$pagination = "";
														if ($page > ($limit/2)) { 
															$pagination .= '<li><a aria-label="First" href="//'.$_SERVER['HTTP_HOST'].'/desc/">1</a></li>
																<li><span><span aria-hidden="true">...</span></span></li>';
														}
														for ($x=$page; $x<=$total_pages;$x++) {
														if ($count < $limit)
															if ($x==1) {
																$pagination .= "<li class=\"active\"><span>".$page."<span class=\"sr-only\">(current)</span></span></li>";
															} else if ($x==$page) {
																$pagination .= "<li class=\"active\"><span>".$page."<span class=\"sr-only\">(current)</span></span></li>";

															} else { 
																$pagination .= "<li><a href=\"//".$_SERVER['HTTP_HOST']."/desc/?page=".$x."\">".$x." </a></li>";
															}
															$count++;
														}
														if ($page < $total_pages - ($limit/2)) { 
															$pagination .= '<li><span><span aria-hidden="true">...</span></span></li><li><a href="//'.$_SERVER['HTTP_HOST'].'/desc/?page='.$total_pages.'">'.$total_pages.'</a></li><li><a aria-label="Next" href="//'.$_SERVER['HTTP_HOST'].'/desc/?page='.($page+1).'"><span class="hidden-xs">Next</span> &rsaquo;</a></li>'; 
														}
													}
													echo $pagination;
												}
												?>
											</ul>
										</nav>
									</div>
								</div>
							</div>
						</main>
						<!-- #main -->
					</div>
					<!-- #primary -->
					<!-- #secondary -->
				</div>
			</div>
		</div>
		<!-- #content -->
		<?php } else { ?>
		<div class="site-content clearfix" id="content">
			<div class="container">
				<div class="row">
					<div class="content-area col-md-12" id="primary">
						<main class="site-main" id="main" role="main">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#movies">Movies</a></li>
								<li><a href="#tvshow">TV Show</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade in active" id="movies" role="tabpanel">
									<div id="movie-related" class="row text-center">
									<?php 
									$search_movie_url = "https://api.themoviedb.org/3/search/movie?api_key=".$tmdb_api."&language=en-US&query=".urlencode($search)."&page=".$page."&include_adult=false";
									if (false !== ($html = @file_get_contents($search_movie_url))) {	
										$search_movie = json_decode($html, true);
									} else {
										$curl = curl_init();
										curl_setopt_array($curl, array(
											CURLOPT_URL => $search_movie_url,
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
											$search_movie = json_decode($response, true);
										}
									}
									$total_pages = $search_movie['total_pages'];
									$total_results = $search_movie['total_results'];
									//$movie_count = 0;
										foreach ($search_movie['results'] as $result) {
											$poster_path = isset($result['poster_path']) ? "//image.tmdb.org/t/p/w342".$result['poster_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
											$search_movie_id = $result['id'];
											$search_movie_title = isset($result['title']) ? $result['title'] : $result['name'];
											//$movie_count++;
											echo '
											<div class="col-md-3 col-sm-4 col-xs-6">
												<a href="//'.$_SERVER['HTTP_HOST'].'/spam/?movie='.$search_movie_id.'&sub_id='.$sub_id.'" target="_blank" data-toggle="tooltip" data-placement="top" title="'.$search_movie_title.'">
													<img class="img-responsive cover-container" src="'.$poster_path.'" alt="'.$search_movie_title.'" />
													<div class="list-title">'.$search_movie_title.'</div>
												</a>
											</div>
											';
											//if ($movie_count >= 18) { break; }
										}
									?>
									</div>

									<div class="text-center">
										<nav>
											<ul class="pagination">
												<?php if (!empty($search_movie_id)) { ?>
													<li class="disabled hidden-xs"><span><span aria-hidden="true">Page <?=$page?> of <?=$total_pages?></span></span></li>
												<?php } if (($page==1) || ($page==2)) { ?>
													<li><a aria-label="Prev" href="//<?=$_SERVER['HTTP_HOST']?>/desc/?s=<?=$search?>"><span class='hidden-xs'>Prev</span> &lsaquo;</a></li>
												<?php } if ($page>=3) { ?>
													<li><a aria-label="Prev" href="//<?=$_SERVER['HTTP_HOST']?>/desc/?s=<?=$search?>&page=<?=$page-1?>"><span class='hidden-xs'>Prev</span> &lsaquo;</a></li>
												<?php } ?>
												<?php 
												if ($total_results>=20) {
													$pagination = "";
													$limit = 5;

													if ($total_pages >=1 && $page <= $total_pages) {
														$count = 1;
														$pagination = "";
														if ($page > ($limit/2)) { 
															$pagination .= '<li><a aria-label="First" href="//'.$_SERVER['HTTP_HOST'].'/desc/?s='.$search.'">1</a></li>
																<li><span><span aria-hidden="true">...</span></span></li>';
														}
														for ($x=$page; $x<=$total_pages;$x++) {
														if ($count < $limit)
															if ($x==1) {
																$pagination .= "<li class=\"active\"><span>".$page."<span class=\"sr-only\">(current)</span></span></li>";
															} else if ($x==$page) {
																$pagination .= "<li class=\"active\"><span>".$page."<span class=\"sr-only\">(current)</span></span></li>";

															} else { 
																$pagination .= "<li><a href=\"//".$_SERVER['HTTP_HOST']."/desc/?s=".$search."&page=".$x."\">".$x." </a></li>";
															}
															$count++;
														}
														if ($page < $total_pages - ($limit/2)) { 
															$pagination .= '<li><span><span aria-hidden="true">...</span></span></li><li><a href="//'.$_SERVER['HTTP_HOST'].'/desc/?s='.$search.'&page='.$total_pages.'">'.$total_pages.'</a></li><li><a aria-label="Next" href="//'.$_SERVER['HTTP_HOST'].'/desc/?s='.$search.'&page='.($page+1).'"><span class="hidden-xs">Next</span> &rsaquo;</a></li>'; 
														}
													}
													echo $pagination;
												}
												?>
											</ul>
										</nav>
									</div>

								</div>
								<div class="tab-pane" id="tvshow" role="tabpanel">
									<div id="movie-related" class="row text-center">
									<?php 
									$search_tv_url = "https://api.themoviedb.org/3/search/tv?api_key=".$tmdb_api."&language=en-US&query=".urlencode($search)."&page=".$page;
									if (false !== ($html = @file_get_contents($search_tv_url))) {	
										$search_tv = json_decode($html, true);
									} else {
										$curl = curl_init();
										curl_setopt_array($curl, array(
											CURLOPT_URL => $search_tv_url,
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
											$search_tv = json_decode($response, true);
										}
									}
									$search_tv = json_decode(file_get_contents($search_tv_url), true);
									$total_pages = $search_tv['total_pages'];
									$total_results = $search_tv['total_results'];
									//$tv_count = 0;
										foreach ($search_tv['results'] as $result) {
											$poster_path_tv = isset($result['poster_path']) ? "//image.tmdb.org/t/p/w342".$result['poster_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
											$search_tv_id = $result['id'];
											$title_tv = isset($result['title']) ? $result['title'] : $result['name'];
											//$tv_count++;
											echo '
												<div class="col-md-3 col-sm-4 col-xs-6">
													<a href="//'.$_SERVER['HTTP_HOST'].'/spam/?tv='.$search_tv_id.'&sub_id='.$sub_id.'" target="_blank" data-toggle="tooltip" data-placement="top" title="'.$title_tv.'">
														<img class="img-responsive cover-container" src="'.$poster_path_tv.'" alt="'.$title_tv.'" />
														<div class="list-title">'.$title_tv.'</div>
													</a>
												</div>
												';
											//if ($tv_count >= 18) { break; }
										}
									?>
									</div>
									<div class="text-center">
										<nav>
											<ul class="pagination">
												<?php if (!empty($search_tv_id)) { ?>
													<li class="disabled hidden-xs"><span><span aria-hidden="true">Page <?=$page?> of <?=$total_pages?></span></span></li>

												<?php } if (($page==1) || ($page==2)) { ?>
													<li><a aria-label="Prev" href="//<?=$_SERVER['HTTP_HOST']?>/desc/?s=<?=$search?>"><span class='hidden-xs'>Prev</span> &lsaquo;</a></li>
												<?php } if ($page>=3) { ?>
													<li><a aria-label="Prev" href="//<?=$_SERVER['HTTP_HOST']?>/desc/?s=<?=$search?>&page=<?=$page-1?>"><span class='hidden-xs'>Prev</span> &lsaquo;</a></li>
												<?php } ?>
												<?php 
												if ($total_results>=20) {
													$pagination = "";
													$limit = 5;

													if ($total_pages >=1 && $page <= $total_pages) {
														$count = 1;
														$pagination = "";
														if ($page > ($limit/2)) { 
															$pagination .= '<li><a aria-label="First" href="//'.$_SERVER['HTTP_HOST'].'/desc/?s='.$search.'">1</a></li>
																<li><span><span aria-hidden="true">...</span></span></li>';
														}
														for ($x=$page; $x<=$total_pages;$x++) {
														if ($count < $limit)
															if ($x==1) {
																$pagination .= "<li class=\"active\"><span>".$page."<span class=\"sr-only\">(current)</span></span></li>";
															} else if ($x==$page) {
																$pagination .= "<li class=\"active\"><span>".$page."<span class=\"sr-only\">(current)</span></span></li>";

															} else { 
																$pagination .= "<li><a href=\"//".$_SERVER['HTTP_HOST']."/desc/?s=".$search."&page=".$x."\">".$x." </a></li>";
															}
															$count++;
														}
														if ($page < $total_pages - ($limit/2)) { 
															$pagination .= '<li><span><span aria-hidden="true">...</span></span></li><li><a href="//'.$_SERVER['HTTP_HOST'].'/desc/?s='.$search.'&page='.$total_pages.'">'.$total_pages.'</a></li><li><a aria-label="Next" href="//'.$_SERVER['HTTP_HOST'].'/desc/?s='.$search.'&page='.($page+1).'"><span class="hidden-xs">Next</span> &rsaquo;</a></li>'; 
														}
													}
													echo $pagination;
												}
												?>
											</ul>
										</nav>
									</div>
								</div>
							</div>
						</main>
						<!-- #main -->
					</div>
					<!-- #primary -->
					<!-- #secondary -->
				</div>
			</div>
		</div>
		<!-- #content -->
		<?php } ?>

		<footer id="colophon" class="site-footer" role="contentinfo">
				<div id="movie-genre-list">
					<div class="container">
						<div class="row">
							<ul class="clearfix">
							<?php		
							$genres_list = dirname(__file__) . '/genres/genres_movie.json';
							$genres = json_decode(file_get_contents($genres_list), true);				
							foreach ($genres['genres'] as $genre) {
							echo '
								<li class="col-md-3 col-sm-4 col-xs-6"><a href="//'.$_SERVER['HTTP_HOST'].'/genre-movie/'.$genre['id'].'/'.slugUri($genre['name']).'"><span class="fa fa-circle-o"></span> '.$genre['name'].'</a></li>';
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
		<!-- #colophon -->
	</div>
	<!-- #page -->
	<script type='text/javascript' src='//code.jquery.com/jquery-2.2.0.min.js'></script>
	<script type='text/javascript' src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
	<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/navigation.min.js'></script>
	<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/skip-link-focus-fix.min.js'></script>
	<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/cycle.min.js'></script>
	<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/carousel.min.js'></script>
	<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/preloader.min.js'></script>
	<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/scripts.min.js'></script>
	<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/embed.min.js'></script>
	
	<?php include dirname(__FILE__)."/includes/histats.php"; ?>

</body>
</html>