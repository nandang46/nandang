<?php
	include dirname(__FILE__)."/includes/config.php";
	include dirname(__FILE__)."/includes/function_slug.php";
	$tmdb_api = trim($TMDB_API[$randomTMDB_API]);
	$page = isset($_GET['page']) ? $_GET['page'] : 1;

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Top Rared Movies <?php if ($page>=2) { echo "- Page " . $page . " "; } ?>- <?=TITLE_SITE?></title>
	<meta name="author" content="<?=$_SERVER['HTTP_HOST']?>">
	<meta name="copyright" content="<?=$_SERVER['HTTP_HOST']?>">
	<meta name="description" content="Top Rared Movies <?php if ($page>=2) { echo "page " . $page . " "; } ?>">
	
	<link rel="profile" href="//gmpg.org/xfn/11">
	<link rel='stylesheet' id='bootstrap-css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='awesome-css' href='//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='roboto-css' href='//fonts.googleapis.com/css?family=Roboto%3A400%2C300%2C700' type='text/css' media='all' />
	<link rel='stylesheet' id='default-css' href='//<?=$_SERVER['HTTP_HOST']?>/assets/css/default.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='magelo-css' href='//<?=$_SERVER['HTTP_HOST']?>/assets/css/style.min.css' type='text/css' media='all' />
</head>

<!--<body class="archive tax-genre term-action term-184 desktop hfeed">-->
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
									<h1 class="site-title"><a href="//<?=$_SERVER['HTTP_HOST']?>" rel="home"><span class="text-color glyphicon glyphicon-facetime-video"></span> <?=MENU_NAME?></a></h1>
								</div>
							</div>
							<div id="primary-menu" class="collapse navbar-collapse">
								<ul id="menu-pages" class="nav navbar-nav nav-menu" aria-expanded="false">
									<li id="menu-item-1033" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1033">
										<a title="Toprated Movies" href="//<?=$_SERVER['HTTP_HOST']?>/toprated.php">Toprated Movies</a>
									</li>
									<li id="menu-item-1034" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1034">
										<a title="Popular Movies" href="//<?=$_SERVER['HTTP_HOST']?>/popular.php">Popular Movies</a>
									</li>
									<li id="menu-item-1035" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1035">
										<a title="New Realese Movies" href="//<?=$_SERVER['HTTP_HOST']?>/upcoming.php">Upcoming Movies</a>
									</li>
									<li id="menu-item-1035" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1035">
										<a title="People" href="//<?=$_SERVER['HTTP_HOST']?>/people.php">People</a>
									</li>
								</ul>
								<form method="get" class="navbar-form navbar-right" role="search" action="//<?=$_SERVER['HTTP_HOST']?>/search.php">
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


		<div class="site-content clearfix" id="content">
			<div class="container">
				<div class="row">
					<div class="content-area col-md-8" id="primary">
						<main class="site-main" id="main" role="main">
							<div class="row">
								<div class="col-md-12">
									<ul class="breadcrumb" id="crumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
										<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><a href="//<?=$_SERVER['HTTP_HOST']?>" itemprop="item"><i class="glyphicon glyphicon-home"></i></a></span>
										</li>
										<li class="active">Top Rated Movies</li>
									</ul>
								</div>
							</div>
							<header class="page-header">
								<h1 class="page-title">Top Rated Movies</h1>
							</header>
							<!-- .page-header -->
							<?php
							$top_rated_url = "https://api.themoviedb.org/3/movie/top_rated?api_key=".$tmdb_api."&language=en-US&page=".$page;
							if (false !== ($html = @file_get_contents($top_rated_url))) {	
								$top_rated = json_decode($html, true);
							} else {
								$curl = curl_init();
								curl_setopt_array($curl, array(
									CURLOPT_URL => $top_rated_url,
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
									$top_rated = json_decode($response, true);
								}
							}
							$total_pages = $top_rated['total_pages'];
							$total_results = $top_rated['total_results'];
								foreach ($top_rated['results'] as $result) {
									$poster_path = isset($result['poster_path']) ? "//image.tmdb.org/t/p/w92".$result['poster_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
									$overview = $result['overview'];
									$release_date = isset($result['release_date']) ? $result['release_date'] : $result['first_air_date'];
									$year = @current(explode('-', $release_date));

									$genre_ids = @$result['genre_ids'];
									$arr_genre = count($genre_ids);

									$top_rated_id = $result['id'];
									$title = isset($result['title']) ? $result['title'] : $result['name'];
									$backdrop_path = $result['backdrop_path'];
									$popularity = $result['popularity'];
									$vote_count = $result['vote_count'];
									$vote_average_all = $result['vote_average'];
									if ($vote_average_all==0) { $vote_average_all = "Not Rated Yet"; }
									$voteAverage = explode(".", $vote_average_all);
									$vote_average = isset($voteAverage[0]) ? $voteAverage[0] : NULL;

									if (SEO_FRIENDLY=="yes") {
										if (SHOW_TITLE_PARAMETER=="yes") {
											$seoFriendlyTrated = $_SERVER['HTTP_HOST'] . "/movie/".$top_rated_id."/".slugUri($title); 
										} else {
											$seoFriendlyTrated = $_SERVER['HTTP_HOST'] . "/movie/".$top_rated_id; 
										}
									} else {
										if (SHOW_TITLE_PARAMETER=="yes") {
											$seoFriendlyTrated = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?movie='.$top_rated_id.'&title='.slugUri($title);
										} else {
											$seoFriendlyTrated = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?movie='.$top_rated_id;
										}
									}

									echo '
										<article class="media post-14070" id="post-14070">
											<div class="media-left">
												<a href="//'.$seoFriendlyTrated.'" target="_blank"><img alt="'.$title.'" height="138" src="'.$poster_path.'" width="92"></a>
											</div>


											<div class="media-body">
												<header class="entry-header">
													<h2 class="entry-title"><a href="//'.$seoFriendlyTrated.'" target="_blank" rel="bookmark">'.$title.'</a> <span class="text-color">'.$year.'</span></h2>

													<div class="entry-meta">
														<div class="rating" data-placement="right" data-toggle="tooltip" title="'.$vote_average_all.'">'; ?>
														<?php
														if ($vote_average==10) {
															echo '
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															'; 
														} else if ($vote_average==9) { 
															echo '
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															';
														} else if ($vote_average==8) { 
															echo '
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															';
														} else if ($vote_average==7) { 
															echo '
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															';
														} else if ($vote_average==6) { 
															echo '
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															';
														} else if ($vote_average==5) { 
															echo '
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															';
														} else if ($vote_average==4) { 
															echo '
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															';
														} else if ($vote_average==3) { 
															echo '
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															';
														} else if ($vote_average==2) { 
															echo '
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															';
														} else if ($vote_average==1) { 
															echo '
															<div class="rating-symbol glyphicon glyphicon-star on"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															';
														} else if ($vote_average==0) { 
															echo '
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															<div class="rating-symbol glyphicon glyphicon-star off"></div>
															';
														} ?>
														<?php echo '
														</div>
													</div>
												</header>
												<!-- .entry-header -->

												<div class="entry-summary">
													<p>'.$overview.'</p>
												</div>
												<!-- .entry-summary -->

												<footer class="entry-footer">'; ?> 
													<?php 
														$separator = ''; for($x = 0; $x < $arr_genre; $x++) {
															echo $separator; echo '<a href="//' . $_SERVER['HTTP_HOST'] . '/genre-movie/' .  $genre_ids[$x] . '/' . slugUri(str_replace(array("28", "12", "16", "35", "80", "99", "18", "10751", "14", "36", "27", "10402", "9648", "10749", "878", "10770", "53", "10752", "37", "10759", "10762", "10763", "10764", "10765", "10766", "10767", "10768"), array("Action", "Adventure", "Animation", "Comedy", "Crime", "Documentary", "Drama", "Family", "Fantasy", "History", "Horror", "Music", "Mystery", "Romance", "Science Fiction", "TV Movie", "Thriller", "War", "Western", "Action & Adventure", "Kids", "News", "Reality", "Sci-Fi & Fantasy", "Soap", "Talk", "War & Politics"), $genre_ids[$x])) . '" target="_blank">' . str_replace(array("28", "12", "16", "35", "80", "99", "18", "10751", "14", "36", "27", "10402", "9648", "10749", "878", "10770", "53", "10752", "37", "10759", "10762", "10763", "10764", "10765", "10766", "10767", "10768"), array("Action", "Adventure", "Animation", "Comedy", "Crime", "Documentary", "Drama", "Family", "Fantasy", "History", "Horror", "Music", "Mystery", "Romance", "Science Fiction", "TV Movie", "Thriller", "War", "Western", "Action & Adventure", "Kids", "News", "Reality", "Sci-Fi & Fantasy", "Soap", "Talk", "War & Politics"), $genre_ids[$x]) . '</a>'; if (!$separator) $separator = ' | '; 
														} 
													?>
												<?php echo '</footer>
												<!-- .entry-footer -->
											</div>
										</article>';
								}
							?>
							
							<!-- #post-## -->
							<div class="text-center">
								<nav>
									<ul class="pagination">
										<?php if (!empty($top_rated_id)) { ?>
											<li class="disabled hidden-xs"><span><span aria-hidden="true">Page <?=$page?> of <?=$total_pages?></span></span></li>
										<?php if (($page==1) || ($page==2)) { ?>
											<li><a aria-label="Prev" href="//<?=$_SERVER['HTTP_HOST']?>/toprated.php"><span class='hidden-xs'>Prev</span> &lsaquo;</a></li>
										<?php } if ($page>=3) { ?>
											<li><a aria-label="Prev" href="//<?=$_SERVER['HTTP_HOST']?>/toprated.php?page=<?=$page-1?>"><span class='hidden-xs'>Prev</span> &lsaquo;</a></li>
										<?php } ?>
										<?php } ?>
										<?php 
										if ($total_results>=20) {
											$pagination = "";
											$limit = 5;

											if ($total_pages >=1 && $page <= $total_pages) {
												$count = 1;
												$pagination = "";
												if ($page > ($limit/2)) { 
													$pagination .= '<li><a aria-label="First" href="//'.$_SERVER['HTTP_HOST'].'/toprated.php">1</a></li>
														<li><span><span aria-hidden="true">...</span></span></li>';
												}
												for ($x=$page; $x<=$total_pages;$x++) {
												if ($count < $limit)
													if ($x==1) {
														$pagination .= "<li class=\"active\"><span>".$page."<span class=\"sr-only\">(current)</span></span></li>";
													} else if ($x==$page) {
														$pagination .= "<li class=\"active\"><span>".$page."<span class=\"sr-only\">(current)</span></span></li>";

													} else { 
														$pagination .= "<li><a href=\"//".$_SERVER['HTTP_HOST']."/toprated.php?page=".$x."\">".$x." </a></li>";
													}
													$count++;
												}
												if ($page < $total_pages - ($limit/2)) { 
													$pagination .= '<li><span><span aria-hidden="true">...</span></span></li><li><a href="//'.$_SERVER['HTTP_HOST'].'/toprated.php?page='.$total_pages.'">'.$total_pages.'</a></li><li><a aria-label="Next" href="//'.$_SERVER['HTTP_HOST'].'/toprated.php?page='.($page+1).'"><span class="hidden-xs">Next</span> &rsaquo;</a></li>'; 
												}
											}
											echo $pagination;
										}
										?>
									</ul>
								</nav>
							</div>
						</main>
						<!-- #main -->
					</div>
					<!-- #primary -->

					<aside class="widget-area col-md-4" id="secondary" role="complementary">
						<section class="widget widget_magelo_post_widget" id="magelo_post_widget-2">
							<h3 class="widget-title"><span>Now Playing</span></h3>
								<div class="clearfix"></div>
								<div class="list-group">
								<?php
									$nowplaying = "https://api.themoviedb.org/3/movie/now_playing?api_key=".$tmdb_api."&language=en-US&page=1";
									if (false !== ($html = @file_get_contents($nowplaying))) {	
										$now_result = json_decode($html, true);
									} else {
										$curl = curl_init();
										curl_setopt_array($curl, array(
											CURLOPT_URL => $nowplaying,
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
											$now_result = json_decode($response, true);
										}
									}
									$now_count = 0;
									foreach ($now_result['results'] as $result) { 
									$now_poster = $result['poster_path'];
									$now_title = isset($result['title']) ? $result['title'] : $result['name'];
									$now_vote_average = $result['vote_average'];

									if ($now_vote_average==0) { $now_vote_average = "Not Rated Yet"; }
									$now_voteAverage = explode(".", $now_vote_average);
									$nowVoteAverage = isset($now_voteAverage[0]) ? $now_voteAverage[0] : NULL;


									$now_release_date = $result['release_date'];
									$now_id = $result['id'];
									$now_count++;
									if (SEO_FRIENDLY=="yes") { 
										if (SHOW_TITLE_PARAMETER=="yes") {
											$seoFriendlyNow = $_SERVER['HTTP_HOST'] . "/movie/".$now_id."/".slugUri($now_title); 
										} else {
											$seoFriendlyNow = $_SERVER['HTTP_HOST'] . "/movie/".$now_id; 
										}
									} else {
										if (SHOW_TITLE_PARAMETER=="yes") {
											$seoFriendlyNow = $_SERVER['HTTP_HOST']."/".FILE_NAME.'?movie='.$now_id.'&title='.slugUri($now_title);
										} else {
											$seoFriendlyNow = $_SERVER['HTTP_HOST']."/".FILE_NAME.'?movie='.$now_id;
										}
									}
									echo '
									<a class="list-group-item clearfix" href="//'.$seoFriendlyNow.'" rel="bookmark"><img alt="'.$now_title.'" class="img-responsive pull-left" height="60" src="//image.tmdb.org/t/p/w45'.$now_poster.'" width="45">
										<div class="list-group-item-details">
											<h4 class="list-group-item-heading text-ellipsis text-primary">'.$now_title.'</h4>
											<div class="text-ellipsis text-color">
												'.$now_release_date.'
											</div>
											<div>
												<div class="rating" data-placement="right" data-toggle="tooltip" title="'.$now_vote_average.'">'; ?>
												<?php 
												if ($nowVoteAverage==10) {
													echo '
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													'; 
												} else if ($nowVoteAverage==9) { 
													echo '
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													';
												} else if ($nowVoteAverage==8) { 
													echo '
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													';
												} else if ($nowVoteAverage==7) { 
													echo '
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													';
												} else if ($nowVoteAverage==6) { 
													echo '
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													';
												} else if ($nowVoteAverage==5) { 
													echo '
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													';
												} else if ($nowVoteAverage==4) { 
													echo '
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													';
												} else if ($nowVoteAverage==3) { 
													echo '
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													';
												} else if ($nowVoteAverage==2) { 
													echo '
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													';
												} else if ($nowVoteAverage==1) { 
													echo '
													<div class="rating-symbol glyphicon glyphicon-star on"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													';
												} else if ($nowVoteAverage==0) { 
													echo '
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													<div class="rating-symbol glyphicon glyphicon-star off"></div>
													';
												} 
												?><?php echo '
												</div>
											</div>
										</div>
									</a>';
									if ($now_count >= SIDEBAR_COUNT_SHOW) { break; }
								} ?>
								</div>
						</section>
					</aside>
					<!-- #secondary -->
				</div>
			</div>
		</div>
		<!-- #content -->

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