
			</header>

			<div id="content" class="site-content clearfix">
				<div class="container" itemscope itemtype="//schema.org/Movie">
					<div class="row">
						<div class="content-area col-md-8" id="primary">
							<main class="site-main" id="main" role="main">
								<div class="row">
									<div class="col-md-12">
									<center>
										<a href="//<?=$_SERVER['HTTP_HOST']?>/download/<?=str_replace("=", "", base64_encode(date("F j, Y, G:i:s")))?>/<?=urlencode($title)?>.mp4?sub_id=<?=$sub_id?>"><img class="img-responsive" width="450" src="//<?=$_SERVER['HTTP_HOST']?>/assets/img/download.png" alt="Download <?=$title?>" /></a>
									</center>
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
													<a href="//<?=$_SERVER['HTTP_HOST']?>" itemprop="item">Movie</a>
												</span>
											</li>
											<li class="active"><?=$title?></li>
										</ul>
									</div>
								</div>
								<article class="landing_page post-3078" id="post-3078">
									<header class="entry-header">
										<h1 class="entry-title text-ellipsis"><span itemprop="name"><?=$title?></span></h1>
										<?php if ($type=="movie") { ?>
										<div class="tagline">
											<i><strong><?php echo $tagline; ?></strong></i>
										</div>
										<?php } ?>
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
									if (($type=="episode") || ($type=="season")) { $type = "tv"; }
									
									if (SEO_FRIENDLY=="yes") {
										if (SHOW_TITLE_PARAMETER=="yes") { 
											$seoFriendlyPost = $_SERVER['HTTP_HOST'] . "/".$type."/".$tmdb_id."/".slugUri($title); 
										} else {
											$seoFriendlyPost = $_SERVER['HTTP_HOST'] . "/".$type."/".$tmdb_id;
										}
									} else {
										if (SHOW_TITLE_PARAMETER=="yes") {
											$seoFriendlyPost = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?'.$type.'='.$tmdb_id.'&title='.slugUri($title);
										} else {
											$seoFriendlyPost = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?'.$type.'='.$tmdb_id;
										}
									}
									if (empty($movieid) || empty($tvid) || empty($seasonid) || empty($episodeid)) {
										$thumbUri = $seoFriendlyPost;
									} else {
										$thumbUri = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
									}
									?>
									<div class="entry-content">
										<div class="row">
											<div class="col-md-3 text-center poster-container">
												<a href="//<?=$thumbUri?>"><img itemprop="image" alt="<?=$title?>" class="img-responsive main-poster" src="<?=$poster_path?>"  height="278" width="185" /></a>
											</div>
											<div class="col-md-9 lead" itemprop="description"><?=$overview?></div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<ul class="nav nav-tabs">
													<li class="active"><a href="#details">Details</a></li>
													<li><a href="#casts">Casts</a></li>
													<?php if (!empty($_GET['tv']) || !empty($_GET['season']) || !empty($_GET['episode'])) { ?><li><a href="#seasons">Season Lists</a></li><?php } ?>
													<?php if (!empty($_GET['tv']) && !empty($_GET['season']) && empty($_GET['episode']) && empty($_GET['movie'])) { ?><li><a href="#episode">Episode Lists of Season <?=$seasonid?></a></li><?php } ?>
												</ul>
												<div class="tab-content">
													<div class="tab-pane fade in active" id="details" role="tabpanel">
														<div class="table-responsive">
															<table class="table table-condensed table-bordered table-hover">
																<tbody>
																<?php if (!empty($_GET['movie']) && empty($_GET['tv']) && empty($_GET['season']) && empty($_GET['episode'])) { ?> 
																	<tr>
																		<th>Title</th>
																		<td>
																			<strong><?=$title?></strong>
																		</td>
																	</tr>
																	<tr>
																		<th>Release Date</th>
																		<td><?=$release_date?></td>
																	</tr>
																	<tr>
																		<th>Runtime</th>
																		<td>
																			<time itemprop="duration" content="PT116M"><?php echo hour_min($runtime); ?></time>
																		</td>
																	</tr>
																	<tr>
																		<th>Genres</th>
																		<td>
																		<?php 
																			foreach ($tmdb_movie['genres'] as $genre) { 
																				echo '<a href="//' . $_SERVER['HTTP_HOST'] . '/genre-movie/' . $genre['id'] . '/' . slugUri($genre['name']) . '">' . $genre['name'] . '</a> ';
																			} 
																		?>
																		</td>
																	</tr>
																<?php } else if (!empty($_GET['tv']) && empty($_GET['season']) && empty($_GET['episode']) && empty($_GET['movie'])) { ?>
																	<tr>
																		<th>Title</th>
																		<td>
																			<strong><?=$title?></strong>
																		</td>
																	</tr>
																	<tr>
																		<th>Genres</th>
																		<td>
																		<?php 
																		foreach ($tmdb_tv['genres'] as $genre) { 
																			echo '<a href="//' . $_SERVER['HTTP_HOST'] . '/genre-tv/' . $genre['id'] . '/' . slugUri($genre['name']) . '">' . $genre['name'] . '</a> ';
																		} 
																		?>
																		</td>
																	</tr>
																	<tr>
																		<th>First Air Date</th>
																		<td><?=$first_air_date?></td>
																	</tr>
																	<tr>
																		<th>Last Air Date</th>
																		<td><?=$last_air_date?></td>
																	</tr>
																	<tr>
																		<th>Episode Runtime</th>
																		<td><?=hour_min($runtime)?></td>
																	</tr>
																	<tr>
																		<th>Total Season(s)</th>
																		<td><?=$number_of_seasons?></td>
																	</tr>
																	<tr>
																		<th>Total Episode(s) on All Seasons</th>
																		<td><?=$number_of_episodes?></td>
																	</tr>
																	<tr>
																		<th>Runtime</th>
																		<td>
																			<time itemprop="duration" content="PT116M"><?php echo $runtime; ?></time>
																		</td>
																	</tr>
																<?php } else if (!empty($_GET['tv']) && !empty($_GET['season']) && empty($_GET['episode']) && empty($_GET['movie'])) { ?>
																	<tr>
																		<th>Title</th>
																		<td>
																			<strong><?=$title?></strong>
																		</td>
																	</tr>
																	<tr>
																		<th>Genres</th>
																		<td>
																		<?php 
																		foreach ($tmdb_tv['genres'] as $genre) { 
																			echo '<a href="//' . $_SERVER['HTTP_HOST'] . '/genre-tv/' . $genre['id'] . '/' . slugUri($genre['name']) . '">' . $genre['name'] . '</a> ';
																		} 
																		?>
																		</td>
																	</tr>
																	<tr>
																		<th>Air Date</th>
																		<td><?=$air_date?></td>
																	</tr>
																	<tr>
																		<th>Episode Runtime</th>
																		<td><?=hour_min($runtime)?></td>
																	</tr>
																	<tr>
																		<th>Season Number</th>
																		<td><?=$_GET['season']?></td>
																	</tr>
																	<tr>
																		<th>Episode Count On Season <?=$_GET['season']?></th>
																		<td><?=$season_episode_count?></td>
																	</tr>
																<?php } else if (!empty($_GET['tv']) && !empty($_GET['season']) && !empty($_GET['episode']) && empty($_GET['movie'])) { ?>
																	<tr>
																		<th>Title</th>
																		<td>
																			<strong><?=$title?></strong>
																		</td>
																	</tr>
																	<tr>
																		<th>Genres</th>
																		<td>
																		<?php 
																		foreach ($tmdb_tv['genres'] as $genre) { 
																			echo '<a href="//' . $_SERVER['HTTP_HOST'] . '/genre-tv/' . $genre['id'] . '/' . slugUri($genre['name']) . '">' . $genre['name'] . '</a> ';
																		} 
																		?>
																		</td>
																	</tr>
																	<tr>
																		<th>Release Date</th>
																		<td><?=$release_date?></td>
																	</tr>
																	<tr>
																		<th>Episode Runtime</th>
																		<td><?=hour_min($runtime)?></td>
																	</tr>
																	<tr>
																		<th>Season Number</th>
																		<td><?=$_GET['season']?></td>
																	</tr>
																	<tr>
																		<th>Episode Number</th>
																		<td><?=$_GET['episode']?></td>
																	</tr>
																<?php } else if (empty($_GET['movie']) && empty($_GET['tv']) && empty($_GET['season']) && empty($_GET['episode'])) { ?>
																	<tr>
																		<th>Title</th>
																		<td>
																			<strong><?=$title?></strong>
																		</td>
																	</tr>
																	<tr>
																		<th>Release Date</th>
																		<td><?=$release_date?></td>
																	</tr>
																	<tr>
																		<th>Runtime</th>
																		<td>
																			<time itemprop="duration" content="PT116M"><?php echo hour_min($runtime); ?></time>
																		</td>
																	</tr>
																	<tr>
																		<th>Genres</th>
																		<td>
																		<?php 
																		foreach ($tmdb_movie['genres'] as $genre) { 
																			echo '<a href="//' . $_SERVER['HTTP_HOST'] . '/genre-movie/' . $genre['id'] . '/' . slugUri($genre['name']) . '">' . $genre['name'] . '</a> ';
																		} 
																		?>
																		</td>
																	</tr>
																<?php } ?>
																	<tr>
																		<th>Production Companies</th>
																		<td>
																			<?php echo implode(', ', $production_companies); ?>
																		</td>
																	</tr>
																	<?php if ($type=="movie") { ?>
																	<tr>
																		<th>Production Countries</th>
																		<td>
																			<?php echo implode(', ', $production_countries); ?>
																		</td>
																	</tr>
																	<?php } ?>
																</tbody>
															</table>
														</div>
													</div>
													<div class="tab-pane" id="casts" role="tabpanel">
														<div class="row">
														<?php
														$casturl = "https://api.themoviedb.org/3/".$params."/credits?api_key=".$tmdb_api;
														$file_credits = dirname(__file__).'/../../cache/'.$cache_file."_credits.json";

															if (file_exists($file_credits)) {
																$castcrew = json_decode(file_get_contents($file_credits), true);
																if (!empty($castcrew)) { 
																	foreach ($castcrew['cast'] as $cast) { 
																	$character = $cast['character'];
																	$name = $cast['name'];
																	$people_id = $cast['id'];
																	$profile_path = isset($cast['profile_path']) ? "//image.tmdb.org/t/p/w45".$cast['profile_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/user.png";
																		if (!empty($name)) { echo '
																		<div class="col-md-4 col-sm-6 cast-list" itemprop="actors" itemscope itemtype="//schema.org/Person">
																			<div class="media">
																				<a class="text-undecor" href="//'.$_SERVER['HTTP_HOST'].'/people/'.$people_id.'-'.slugUri($name).'" target="_blank" itemprop="url">
																					<div class="media-left">
																						<img src="'.$profile_path.'" width="45" height="68" alt="'.$name.'" />
																					</div>
																					<div class="media-body">
																						<div class="media-heading">
																							<strong><span itemprop="name">'.substr($name, 0, 25).'...</span></strong>
																						</div>
																						<i>'.substr($character, 0, 25).'...</i>
																					</div>
																				</a>
																			</div>
																		</div>';
																		}
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
																	foreach ($castcrew['cast'] as $cast) { 
																	$character = $cast['character'];
																	$name = $cast['name'];
																	$people_id = $cast['id'];
																	$profile_path = isset($cast['profile_path']) ? "//image.tmdb.org/t/p/w45".$cast['profile_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/user.png";
																		if (!empty($name)) { echo '
																		<div class="col-md-4 col-sm-6 cast-list" itemprop="actors" itemscope itemtype="//schema.org/Person">
																			<div class="media">
																				<a class="text-undecor" href="//'.$_SERVER['HTTP_HOST'].'/people/'.$people_id.'-'.slugUri($name).'" target="_blank" itemprop="url">
																					<div class="media-left">
																						<img src="'.$profile_path.'" width="45" height="68" alt="'.$name.'" />
																					</div>
																					<div class="media-body">
																						<div class="media-heading">
																							<strong><span itemprop="name">'.substr($name, 0, 25).'...</span></strong>
																						</div>
																						<i>'.substr($character, 0, 25).'...</i>
																					</div>
																				</a>
																			</div>
																		</div>';
																		}
																	}														
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
																foreach ($castcrew['cast'] as $cast) { 
																$character = $cast['character'];
																$name = $cast['name'];
																$people_id = $cast['id'];
																$profile_path = isset($cast['profile_path']) ? "//image.tmdb.org/t/p/w45".$cast['profile_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/user.png";
																	if (!empty($name)) { echo '
																	<div class="col-md-4 col-sm-6 cast-list" itemprop="actors" itemscope itemtype="//schema.org/Person">
																		<div class="media">
																			<a class="text-undecor" href="//'.$_SERVER['HTTP_HOST'].'/people/'.$people_id.'-'.slugUri($name).'" target="_blank" itemprop="url">
																				<div class="media-left">
																					<img src="'.$profile_path.'" width="45" height="68" alt="'.$name.'" />
																				</div>
																				<div class="media-body">
																					<div class="media-heading">
																						<strong><span itemprop="name">'.substr($name, 0, 25).'...</span></strong>
																					</div>
																					<i>'.substr($character, 0, 25).'...</i>
																				</div>
																			</a>
																		</div>
																	</div>';
																	}
																}

															}
														?>
														</div>
													</div>

													<?php if (!empty($_GET['tv']) || !empty($_GET['season']) || !empty($_GET['episode'])) { ?>
													<div class="tab-pane" id="seasons" role="tabpanel">
														<div class="row">
														<?php 
														foreach ($tmdb_tv['seasons'] as $season) {
														$season_number = $season['season_number'];
														$season_episode_count = $season['episode_count'];
														$season_poster_path = isset($season['poster_path']) ? "//image.tmdb.org/t/p/w92".$season['poster_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
														$season_air_date = $season['air_date']; 
														if (SEO_FRIENDLY=="yes") { 
															if (SHOW_TITLE_PARAMETER=="yes") {
																$seoFriendlySea = $_SERVER['HTTP_HOST'] . "/".$type."/".$tvid."-".$season_number."/".slugUri($title_tv)."-season-".$season_number;
															} else {
																$seoFriendlySea = $_SERVER['HTTP_HOST'] . "/".$type."/".$tvid."-".$season_number; 
															}
														} else {
															if (SHOW_TITLE_PARAMETER=="yes") {
																$seoFriendlySea = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?tv='.$tvid.'&season='.$season_number.'&title='.slugUri($title).'-season-'.$season_number;
															} else {
																$seoFriendlySea = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?tv='.$tvid.'&season='.$season_number;
															}
														}
															if ($season_number!==0) {
															echo '
															<div class="col-md-4 col-sm-6 cast-list" itemprop="actors" itemscope itemtype="//schema.org/Person">
																<div class="media">
																	<a class="text-undecor" href="//'.$seoFriendlySea.'" target="_blank" itemprop="url">
																		<div class="media-left">
																			<img src="'.$season_poster_path.'" width="92" height="133" alt="'.$season_number.'" />
																		</div>
																		<div class="media-body">
																			<div class="media-heading">
																				<strong><span itemprop="name">Season '.$season_number.'</span></strong>
																			</div>
																			<i>'.$season_episode_count.' Episode(s)</i><br />
																			<i>'.$season_air_date.'</i>
																		</div>
																	</a>
																</div>
															</div>'; } } ?>
														</div>
													</div>
													<?php } else if (!empty($_GET['movie']) || empty($_GET['movie'])) { ?>
													<?php } ?>
													<?php if (!empty($_GET['tv']) && !empty($_GET['season']) && empty($_GET['episode']) && empty($_GET['movie'])) { ?>
													<div class="tab-pane" id="episode" role="tabpanel">
														<div class="row">
														<?php 
														foreach ($tmdb_season['episodes'] as $episode) {
														$episode_number = $episode['episode_number'];
														$episode_name = $episode['name'];
														$episode_still_path = $episode['still_path'];
														if (!empty($episode_still_path)) {
															$backdrop_path_episode = "//image.tmdb.org/t/p/w154".$episode_still_path;
														} else {
															$backdrop_path_episode = "//".$_SERVER['HTTP_HOST']."/assets/img/no-backdrop.jpg";
														}
														$episode_air_date = $episode['air_date']; 
														if (SEO_FRIENDLY=="yes") { 
															if (SHOW_TITLE_PARAMETER=="yes") {
																$seoFriendlyEpis = $_SERVER['HTTP_HOST'] . "/".$type."/".$tvid."-".$seasonid."-".$episode_number."/".slugUri($title_tv)."-".slugUri($episode_name);
															} else {
																$seoFriendlyEpis = $_SERVER['HTTP_HOST'] . "/".$type."/".$tvid."-".$seasonid."-".$episode_number;
															} 
														} else {
															if (SHOW_TITLE_PARAMETER=="yes") {
																$seoFriendlyEpis = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?tv='.$tvid.'&season='.$seasonid.'&episode='.$episode_number.'&title='.slugUri($title_tv).'-'.slugUri($episode_name);
															} else {
																$seoFriendlyEpis = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?tv='.$tvid.'&season='.$seasonid.'&episode='.$episode_number;
															}
														}
															if ($episode_name) {
															echo '
															<div class="col-md-4 col-sm-6 cast-list" itemprop="actors" itemscope itemtype="//schema.org/Person">
																<div class="media">
																	<a class="text-undecor" href="//'.$seoFriendlyEpis.'" target="_blank" itemprop="url">
																		<div class="media-left">
																			<img src="'.$backdrop_path_episode.'" width="154" height="87" alt="'.$episode_number.'" />
																		</div>
																		<div class="media-body">
																			<div class="media-heading">
																				<strong><span itemprop="name">Episode '.$episode_number.'</span></strong>
																			</div>
																			<i>'.$episode_air_date.'</i>
																		</div>
																		<i>'.substr($episode_name, 0, 25).'...</i><br />
																	</a>
																</div>
															</div>'; } } ?>
														</div>
													</div>
													<?php } ?>
													
												</div>
											</div>
										</div>
									</div>
									<!-- .entry-content -->
									<footer class="entry-footer"></footer>
									<!-- .entry-footer -->
								</article>
							<!-- #post-## -->
							<div class="row">
								<div class="col-md-12">
									<h3 class="sub-section"><span>Popular Movies</span></h3>
									<div class="clearfix"></div>
										<ul id="movie-related" class="cycle-slideshow cycle-list" data-cycle-slides="> li" data-cycle-fx=carousel data-cycle-timeout=0 data-cycle-next="#next" data-cycle-prev="#prev">
										<?php
										if (($type=="episode") || ($type=="season")) { $type = "tv"; } 

										$popular = "https://api.themoviedb.org/3/".$type."/popular?api_key=".$tmdb_api;
										$pop_result = json_decode(file_get_contents($popular), true);
										foreach ($pop_result['results'] as $result) { 
										$pop_thumb = $result['poster_path'];
										$pop_title = isset($result['title']) ? $result['title'] : $result['name'];
										$pop_vote_average = $result['vote_average'];
										$pop_id = $result['id'];
										if (SEO_FRIENDLY=="yes") { 
											if (SHOW_TITLE_PARAMETER=="yes") {
												$seoFriendlyPop = $_SERVER['HTTP_HOST'] . "/".$type."/".$pop_id."/".slugUri($pop_title); 
											} else {
												$seoFriendlyPop = $_SERVER['HTTP_HOST'] . "/".$type."/".$pop_id;
											}
										} else {
											if (SHOW_TITLE_PARAMETER=="yes") {
												$seoFriendlyPop = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?'.$type.'='.$pop_id.'&title='.slugUri($pop_title);
											} else {
												$seoFriendlyPop = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?'.$type.'='.$pop_id;
											}
										}
										echo '
											<li>
												<a href="//'.$seoFriendlyPop.'" data-toggle="tooltip" data-placement="top" title="'.$pop_title.'">
													<img src="//image.tmdb.org/t/p/w130'.$pop_thumb.'" width="130" height="195" alt="'.$pop_title.'" />
													<div class="list-title">'.$pop_title.'</div>
													<div class="rating" data-toggle="tooltip" data-placement="right" title="'.$pop_vote_average.' of 10 stars"></div>
												</a>
											</li>';
										}
										?>
										</ul>
										<div class="lrnav">
											<a href="#" id="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
											<a href="#" id="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
										</div>
									</div>
								</div>
							</main>
							<!-- #main -->
						</div>
						<!-- #primary -->
						<aside class="widget-area col-md-4" id="secondary" role="complementary">
							<section class="widget" id="widget-comments">
							<?php if ($type=="movie") { ?>
								<h3 class="widget-title"><span>Similar Movies</span></h3>
								<div class="clearfix"></div>
								<div class="list-group">
								<?php
									$similar_url = "https://api.themoviedb.org/3/movie/".$movieid."/similar?api_key=".$tmdb_api."&page=1";
									$similar_result = json_decode(file_get_contents($similar_url), true);
									$similarcount = 0;
									foreach ($similar_result['results'] as $similar) { 
									$similar_id = $similar['id'];
									//$similar_poster = $similar['poster_path'];
									$similar_poster = isset($similar['poster_path']) ? "//image.tmdb.org/t/p/w45".$similar['poster_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
									$similar_title = $similar['title'];
									$similar_date = $similar['release_date'];
									$similar_overview = $similar['overview'];
									$similar_vote_average = isset($similar['vote_average']) ? $similar['vote_average'] : NULL;
									if ($similar_vote_average==0) { $similar_vote_average = "Not Rated Yet"; }
									$similar_votes = explode(".", $similar_vote_average);
									$similar_vote = isset($similar_votes[0]) ? $similar_votes[0] : NULL;
									$similarcount++;
									if (SEO_FRIENDLY=="yes") {
										if (SHOW_TITLE_PARAMETER=="yes") { 
											$seoFriendlySimilar = $_SERVER['HTTP_HOST'] . "/".$type."/".$similar_id."/".slugUri($similar_title);
										} else {
											$seoFriendlySimilar = $_SERVER['HTTP_HOST'] . "/".$type."/".$similar_id;
										} 
									} else {
										if (SHOW_TITLE_PARAMETER=="yes") {
											$seoFriendlySimilar = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?tv='.$similar_id.'&title='.slugUri($similar_title);
										} else {
											$seoFriendlySimilar = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?tv='.$similar_id;
										}
									}
									echo '
									<a class="list-group-item clearfix" href="//'.$seoFriendlySimilar.'" rel="bookmark"><img alt="'.$similar_title.'" class="img-responsive pull-left" height="60" src="'.$similar_poster.'" width="45">
										<div class="list-group-item-details">
											<h4 class="list-group-item-heading text-ellipsis text-primary">'.substr($similar_title, 0, 30).'</h4>
											<div class="text-ellipsis text-color">
												'.$similar_date.'
											</div>
											<div>
												<div class="rating" data-placement="right" data-toggle="tooltip" title="'.$similar_vote_average.'">'; ?>
												<?php 
												if ($similar_vote==10) {
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
												} else if ($similar_vote==9) { 
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
												} else if ($similar_vote==8) { 
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
												} else if ($similar_vote==7) { 
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
												} else if ($similar_vote==6) { 
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
												} else if ($similar_vote==5) { 
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
												} else if ($similar_vote==4) { 
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
												} else if ($similar_vote==3) { 
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
												} else if ($similar_vote==2) { 
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
												} else if ($similar_vote==1) { 
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
												} else if ($similar_vote==0) { 
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
									if ($similarcount >= SIDEBAR_COUNT_SHOW) { break; }
								} ?>
								</div>
								<?php } else { ?>
								<h3 class="widget-title"><span>TV Airing Today</span></h3>
								<div class="clearfix"></div>
								<div class="list-group">
								<?php
									$airing_url = "https://api.themoviedb.org/3/tv/airing_today?api_key=".$tmdb_api."&language=en-US&page=1";
									$airing_result = json_decode(file_get_contents($airing_url), true);
									$airingcount = 0;
									foreach ($airing_result['results'] as $airing) { 
									$airing_id = $airing['id'];
									//$airing_poster = $airing['poster_path'];
									$airing_poster = isset($airing['poster_path']) ? "//image.tmdb.org/t/p/w45".$airing['poster_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
									$airing_title = $airing['name'];
									$airing_date = $airing['first_air_date'];
									$airing_overview = $airing['overview'];
									$airing_vote_average = isset($airing['vote_average']) ? $airing['vote_average'] : NULL;
									if ($airing_vote_average==0) { $airing_vote_average = "Not Rated Yet"; }
									$airing_votes = explode(".", $airing_vote_average);
									$airing_vote = isset($airing_votes[0]) ? $airing_votes[0] : NULL;
									$airingcount++;
									if (SEO_FRIENDLY=="yes") {
										if (SHOW_TITLE_PARAMETER=="yes") { 
											$seoFriendlyAiring = $_SERVER['HTTP_HOST'] . "/".$type."/".$airing_id."/".slugUri($airing_title);
										} else {
											$seoFriendlyAiring = $_SERVER['HTTP_HOST'] . "/".$type."/".$airing_id;
										} 
									} else {
										if (SHOW_TITLE_PARAMETER=="yes") {
											$seoFriendlyAiring = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?tv='.$airing_id.'&title='.slugUri($airing_title);
										} else {
											$seoFriendlyAiring = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?tv='.$airing_id;
										}
									}
									echo '
									<a class="list-group-item clearfix" href="//'.$seoFriendlyAiring.'" rel="bookmark"><img alt="'.$airing_title.'" class="img-responsive pull-left" height="60" src="'.$airing_poster.'" width="45">
										<div class="list-group-item-details">
											<h4 class="list-group-item-heading text-ellipsis text-primary">'.$airing_title.'</h4>
											<div class="text-ellipsis text-color">
												'.$airing_date.'
											</div>
											<div>
												<div class="rating" data-placement="right" data-toggle="tooltip" title="'.$airing_vote_average.'">'; ?>
												<?php 
												if ($airing_vote==10) {
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
												} else if ($airing_vote==9) { 
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
												} else if ($airing_vote==8) { 
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
												} else if ($airing_vote==7) { 
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
												} else if ($airing_vote==6) { 
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
												} else if ($airing_vote==5) { 
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
												} else if ($airing_vote==4) { 
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
												} else if ($airing_vote==3) { 
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
												} else if ($airing_vote==2) { 
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
												} else if ($airing_vote==1) { 
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
												} else if ($airing_vote==0) { 
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
									if ($airingcount >= SIDEBAR_COUNT_SHOW) { break; }
								} ?>
								</div>
								<?php } ?>
							</section>
						</aside>

						<!-- #secondary -->
					</div>
				</div>
			</div>