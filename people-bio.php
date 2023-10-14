<?php
	include dirname(__FILE__)."/includes/config.php";
	include dirname(__FILE__)."/includes/function_slug.php";
	$tmdb_api = trim($TMDB_API[$randomTMDB_API]);
	$pid = isset($_GET['pid']) ? $_GET['pid'] : NULL;
	$pname_uri = isset($_GET['pname']) ? $_GET['pname'] : NULL;
	$cache_file = "people_".$pid."_".$pname_uri;
	$tmdb_people_url = "https://api.themoviedb.org/3/person/".$pid."?api_key=".$tmdb_api."&language=en-US";
	$file_people = dirname(__file__)."/cache/".$cache_file.".json";

	if (file_exists($file_people)) {
		$tmdb_people = json_decode(file_get_contents($file_people), true);
		if (!empty($tmdb_people)) { 
			$also_known_as = $tmdb_people['also_known_as'];
			$known_as_length = count($also_known_as);
			$biography = @$tmdb_people['biography'];
			$birthday = $tmdb_people['birthday'];
			$deathday = $tmdb_people['deathday'];
			$gender = $tmdb_people['gender'];
			$homepage = $tmdb_people['homepage'];
			$imdb_id = $tmdb_people['imdb_id'];
			$name = $tmdb_people['name'];
			$place_of_birth = $tmdb_people['place_of_birth'];
			$popularity = $tmdb_people['popularity'];
			$profile_path = $tmdb_people['profile_path'];				
		} else {
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $tmdb_people_url,
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
				file_put_contents($file_people, file_get_contents($tmdb_people_url));
				$tmdb_people = json_decode(file_get_contents($file_people), true);
			} else {
				file_put_contents($file_people, $response);
				$tmdb_people = json_decode(file_get_contents($file_people), true);
			}
			$also_known_as = $tmdb_people['also_known_as'];
			$known_as_length = count($also_known_as);
			$biography = @$tmdb_people['biography'];
			$birthday = $tmdb_people['birthday'];
			$deathday = $tmdb_people['deathday'];
			$gender = $tmdb_people['gender'];
			$homepage = $tmdb_people['homepage'];
			$imdb_id = $tmdb_people['imdb_id'];
			$name = $tmdb_people['name'];
			$place_of_birth = $tmdb_people['place_of_birth'];
			$popularity = $tmdb_people['popularity'];
			$profile_path = $tmdb_people['profile_path'];
		}
	} else {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $tmdb_people_url,
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
			file_put_contents($file_people, file_get_contents($tmdb_people_url));
			$tmdb_people = json_decode(file_get_contents($file_people), true);
		} else {
			file_put_contents($file_people, $response);
			$tmdb_people = json_decode(file_get_contents($file_people), true);
		}
		$also_known_as = $tmdb_people['also_known_as'];
		$known_as_length = count($also_known_as);
		$biography = @$tmdb_people['biography'];
		$birthday = $tmdb_people['birthday'];
		$deathday = $tmdb_people['deathday'];
		$gender = $tmdb_people['gender'];
		$homepage = $tmdb_people['homepage'];
		$imdb_id = $tmdb_people['imdb_id'];
		$name = $tmdb_people['name'];
		$place_of_birth = $tmdb_people['place_of_birth'];
		$popularity = $tmdb_people['popularity'];
		$profile_path = $tmdb_people['profile_path'];	
	}
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$name?> - <?=TITLE_SITE?></title>
		<meta name="author" content="<?=$_SERVER['HTTP_HOST']?>">
		<meta name="copyright" content="<?=$_SERVER['HTTP_HOST']?>">
		<meta name="description" content="<?=str_replace(array('"', "'"), '', $overview)?>">
		<meta property="og:title" content="Watch <?php if ($type == "episode") { echo $title_site; } else { echo $title; } ?> for free">
		<meta property="og:description" content="<?=str_replace(array('"', "'"), '', $overview)?>">
		<meta property="og:url" content="<?=$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']?>">	
		<meta property="og:type" content="website">
		<meta property="og:site_name" content="<?=$_SERVER['HTTP_HOST']?>">
		<meta property="og:image" content="//image.tmdb.org/t/p/w780<?=$backdrop_path?>">
		<meta name="twitter:card" content="summary">
		<meta name="twitter:title" content="Watch <?php if ($type == "episode") { echo $title_site; } else { echo $title; } ?> for free">
		<meta name="twitter:description" content="<?=str_replace(array('"', "'"), '', $overview)?>">
		<meta name="twitter:url" content="<?=$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']?>">
		<meta name="twitter:image" content="//image.tmdb.org/t/p/w780<?=$backdrop_path?>">
		<link rel="profile" href="//gmpg.org/xfn/11">
		<link rel='stylesheet' id='bootstrap-css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' type='text/css' media='all' />
		<link rel='stylesheet' id='awesome-css' href='//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' type='text/css' media='all' />
		<link rel='stylesheet' id='roboto-css' href='//fonts.googleapis.com/css?family=Roboto%3A400%2C300%2C700' type='text/css' media='all' />
		<link rel='stylesheet' id='default-css' href='//<?=$_SERVER['HTTP_HOST']?>/assets/css/default.min.css' type='text/css' media='all' />
		<link rel='stylesheet' id='magelo-css' href='//<?=$_SERVER['HTTP_HOST']?>/assets/css/style.min.css' type='text/css' media='all' />
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
										<a title="New Realese Movies" href="//<?=$_SERVER['HTTP_HOST']?>/people.php">People</a>
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
													<a href="//<?=$_SERVER['HTTP_HOST']?>" itemprop="item">People</a>
												</span>
											</li>
											<li class="active"><?=$name?></li>
										</ul>
									</div>
								</div>
								<article class="landing_page post-3078" id="post-3078">
									<header class="entry-header">
										<h1 class="entry-title text-ellipsis"><span itemprop="name"><?=$name?></span></h1>
										<meta content="2016-06-30">
										<div itemprop="aggregateRating" itemscope itemtype=	"//schema.org/AggregateRating">
											<meta content="1">
											<meta content="10">
											<meta content="4.03">
											<meta content="10">
										</div>
									</header>
									<!-- .entry-header -->
									<?php
									if (SEO_FRIENDLY=="yes") {
										if (SHOW_TITLE_PARAMETER=="yes") {
											$seoFriendlyPost = $_SERVER['HTTP_HOST'] . "/people/".$pid."/".slugUri($name); 
										} else {
											$seoFriendlyPost = $_SERVER['HTTP_HOST'] . "/people/".$pid; 
										}
									} else {
										if (SHOW_TITLE_PARAMETER=="yes") {
											$seoFriendlyPost = $_SERVER['HTTP_HOST'].'/people-bio.php?pid='.$pid.'&pname='.slugUri($name);
										} else {
											$seoFriendlyPost = $_SERVER['HTTP_HOST'].'/people-bio.php?pid='.$pid;
										}
									}
									?>
									<div class="entry-content">
										<div class="row">
											<div class="col-md-3 text-center poster-container">
												<a href="//<?=$seoFriendlyPost?>"><img itemprop="image" alt="<?=$title?>" class="img-responsive main-poster" src="//image.tmdb.org/t/p/w500<?=$profile_path?>"  height="278" width="185" /></a>
											</div>
											<div class="col-md-9 lead" itemprop="description"><?=$biography?></div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<ul class="nav nav-tabs">
													<li class="active"><a href="#details">Details</a></li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane fade in active" id="details" role="tabpanel">
														<div class="table-responsive">
															<table class="table table-condensed table-bordered table-hover">
																<tbody>
																	<tr>
																		<th width="15%">Name</th>
																		<td>
																			<strong><?=$name?></strong>
																		</td>
																	</tr>
																	<tr>
																		<th>Also Known As</th>
																		<td><?php $separator = ''; for($x = 0; $x < $known_as_length; $x++) { echo $separator; echo $also_known_as[$x]; if (!$separator) $separator = ', '; } ?></td>
																	</tr>
																	<tr>
																		<th>Birthday</th>
																		<td>
																			<?=$birthday?>
																		</td>
																	</tr>
																	<?php if (!empty($deathday)) { ?>
																	<tr>
																		<th>Deathday</th>
																		<td>
																			<?=$deathday?>
																		</td>
																	</tr>
																	<?php } ?>
																	<?php if ($gender==1) { $gender_type = "Female"; } else { $gender_type = "Male"; } ?>
																	<tr>
																		<th>Gender</th>
																		<td>
																			<strong><?=$gender_type?></strong>
																		</td>
																	</tr>
																	<?php if (!empty($homepage)) { ?>
																	<tr>
																		<th>Homepage</th>
																		<td><?=$homepage?></td>
																	</tr>
																	<?php } ?>
																	<?php if (!empty($imdb_id)) { ?>
																	<tr>
																		<th>IMDB</th>
																		<td><a href="http://www.imdb.com/name/<?=$imdb_id?>" target="_blank" rel="nofollow"><?=$name?> profile on IMDB</a></td>
																	</tr>
																	<?php } ?>
																	<tr>
																		<th>Place of Birth</th>
																		<td><?=$place_of_birth?></td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- .entry-content -->
									<footer class="entry-footer"></footer>
									<!-- .entry-footer -->
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
		</div>
		<script type='text/javascript' src='//code.jquery.com/jquery-2.2.0.min.js'></script>
		<script type='text/javascript' src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/cycle.min.js'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/carousel.min.js'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/preloader.min.js'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/scripts.min.js'></script>
		
		<?php include dirname(__FILE__)."/includes/histats.php"; ?>

	</body>
</html>