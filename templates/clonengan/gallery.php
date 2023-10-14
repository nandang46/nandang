			</header>

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
										$search_url = "https://api.themoviedb.org/3/movie/popular?api_key=".$tmdb_api."&language=en-US&limit=18&offset=18&page=".$page;
										//$search_url = "https://api.themoviedb.org/3/search/movie?api_key=".$tmdb_api."&language=en-US&query=".urlencode($search)."&page=".$page."&include_adult=false";
										$search_movie = json_decode(file_get_contents($search_url), true);
										$total_pages = $search_movie['total_pages'];
										$total_results = $search_movie['total_results'];
										//$movie_count = 0;
											foreach ($search_movie['results'] as $result) {
												$poster_path = isset($result['poster_path']) ? "//image.tmdb.org/t/p/w342".$result['poster_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
												$overview = $result['overview'];
												$release_date = isset($result['release_date']) ? $result['release_date'] : $result['first_air_date'];
												$year = @current(explode('-', $release_date));

												$genre_ids = @$result['genre_ids'];
												$arr_genre = count($genre_ids);

												$search_movie_id = $result['id'];
												$title = isset($result['title']) ? $result['title'] : $result['name'];
												$backdrop_path = $result['backdrop_path'];
												$popularity = $result['popularity'];
												$vote_count = $result['vote_count'];
												$vote_average_all = $result['vote_average'];
												if ($vote_average_all==0) { $vote_average_all = "Not Rated Yet"; }
												$voteAverage = explode(".", $vote_average_all);
												$vote_average = isset($voteAverage[0]) ? $voteAverage[0] : NULL;
												//$movie_count++;
												if (SEO_FRIENDLY=="yes") { 
													if (SHOW_TITLE_PARAMETER=="yes") {
														$seoFriendlyGal = $_SERVER['HTTP_HOST'] . "/movie/".$search_movie_id."/".slugUri($title); 
													} else {
														$seoFriendlyGal = $_SERVER['HTTP_HOST'] . "/movie/".$search_movie_id;
													}
												} else {
													if (SHOW_TITLE_PARAMETER=="yes") {
														$seoFriendlyGal = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?movie='.$search_movie_id.'&title='.slugUri($title);
													} else {
														$seoFriendlyGal = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?movie='.$search_movie_id;
													}
												}
												echo '
												<div class="col-md-3 col-sm-4 col-xs-6">
													<a href="//'.$seoFriendlyGal.'" target="_blank" data-toggle="tooltip" data-placement="top" title="'.$title.'">
														<img class="img-responsive cover-container" src="'.$poster_path.'" alt="'.$title.'" />
														<div class="list-title">'.$title.'</div>
													</a>
												</div>
												';
												//if ($movie_count >= 18) { break; }
											}
										?>
										</div>
										<?php $page_param = isset($_GET['style']) ? "?style=gallery&page=" : "?page="; ?>
										<div class="text-center">
											<nav>
												<ul class="pagination">
													<?php if (!empty($search_movie_id)) { ?>
														<li class="disabled hidden-xs"><span><span aria-hidden="true">Page <?=$page?> of <?=$total_pages?></span></span></li>
													<?php } if (($page==1) || ($page==2)) { ?>
														<li><a aria-label="Prev" href="//<?=$_SERVER['HTTP_HOST']?>"><span class='hidden-xs'>Prev</span> &lsaquo;</a></li>
													<?php } if ($page>=3) { ?>
														<li><a aria-label="Prev" href="//<?=$_SERVER['HTTP_HOST']?>/<?=$page_param?><?=$page-1?>"><span class='hidden-xs'>Prev</span> &lsaquo;</a></li>
													<?php } ?>
													<?php 
													if ($total_results>=20) {
														$pagination = "";
														$limit = 5;
														if ($total_pages >=1 && $page <= $total_pages) {
															$count = 1;
															$pagination = "";
															if ($page > ($limit/2)) { 
																$pagination .= '<li><a aria-label="First" href="//' . $_SERVER['HTTP_HOST'] . '">1</a></li>
																	<li><span><span aria-hidden="true">...</span></span></li>';
															}
															for ($x=$page; $x<=$total_pages;$x++) {
															if ($count < $limit)
																if ($x==1) {
																	$pagination .= "<li class=\"active\"><span>".$page."<span class=\"sr-only\">(current)</span></span></li>";
																} else if ($x==$page) {
																	$pagination .= "<li class=\"active\"><span>".$page."<span class=\"sr-only\">(current)</span></span></li>";

																} else { 
																	$pagination .= "<li><a href=\"//" . $_SERVER['HTTP_HOST'] . $page_param . $x . "\">" . $x . " </a></li>";
																}
																$count++;
															}
															if ($page < $total_pages - ($limit/2)) { 
																$pagination .= '<li><span><span aria-hidden="true">...</span></span></li><li><a href="//' . $_SERVER['HTTP_HOST'] . $page_param . $total_pages . '">' . $total_pages . '</a></li><li><a aria-label="Next" href="//' . $_SERVER['HTTP_HOST'] . $page_param . ($page+1) . '"><span class="hidden-xs">Next</span> &rsaquo;</a></li>'; 
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
										$search_tv_url = "https://api.themoviedb.org/3/tv/popular?api_key=".$tmdb_api."&language=en-US&page=".$page;
										$search_tv = json_decode(file_get_contents($search_tv_url), true);
										$total_pages = $search_tv['total_pages'];
										$total_results = $search_tv['total_results'];
										//$tv_count = 0;
											foreach ($search_tv['results'] as $result) {
												$poster_path_tv = isset($result['poster_path']) ? "//image.tmdb.org/t/p/w342".$result['poster_path'] : "//".$_SERVER['HTTP_HOST']."/assets/img/no_poster_available.png";
												$overview_tv = $result['overview'];
												$release_date_tv = isset($result['release_date']) ? $result['release_date'] : $result['first_air_date'];
												$year_tv = @current(explode('-', $release_date));

												$genre_ids_tv = @$result['genre_ids'];
												$arr_genre_tv = count($genre_ids);

												$search_tv_id = $result['id'];
												$title_tv = isset($result['title']) ? $result['title'] : $result['name'];
												$backdrop_path_tv = $result['backdrop_path'];
												$popularity_tv = $result['popularity'];
												$vote_count_tv = $result['vote_count'];
												$vote_average_all_tv = $result['vote_average'];
												if ($vote_average_all_tv==0) { $vote_average_all_tv = "Not Rated Yet"; }
												$voteAverage_tv = explode(".", $vote_average_all_tv);
												$vote_average_tv = isset($voteAverage_tv[0]) ? $voteAverage_tv[0] : NULL;
												//$tv_count++; //col-md-2 width="265" height="350"
												if (SEO_FRIENDLY=="yes") {
													if (SHOW_TITLE_PARAMETER=="yes") { 
														$seoFriendlyGalTv = $_SERVER['HTTP_HOST'] . "/tv/".$search_tv_id."/".slugUri($title_tv); 
													} else {
														$seoFriendlyGalTv = $_SERVER['HTTP_HOST'] . "/tv/".$search_tv_id; 
													}
												} else {
													if (SHOW_TITLE_PARAMETER=="yes") {
														$seoFriendlyGalTv = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?tv='.$search_tv_id.'&title='.slugUri($title_tv);
													} else {
														$seoFriendlyGalTv = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?tv='.$search_tv_id;
													}
												}
												echo '
													<div class="col-md-3 col-sm-4 col-xs-6">
														<a href="//'.$seoFriendlyGalTv.'" target="_blank" data-toggle="tooltip" data-placement="top" title="'.$title_tv.'">
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

													<?php if (($page==1) || ($page==2)) { ?>
														<li><a aria-label="Prev" href="//<?=$_SERVER['HTTP_HOST']?>"><span class='hidden-xs'>Prev</span> &lsaquo;</a></li>
													<?php } if ($page>=3) { ?>
														<li><a aria-label="Prev" href="//<?=$_SERVER['HTTP_HOST']?>/?<?=$page_param?><?=$page-1?>"><span class='hidden-xs'>Prev</span> &lsaquo;</a></li>
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
																$pagination .= '<li><a aria-label="First" href="//' . $_SERVER['HTTP_HOST'] . '">1</a></li>
																	<li><span><span aria-hidden="true">...</span></span></li>';
															}
															for ($x=$page; $x<=$total_pages;$x++) {
															if ($count < $limit)
																if ($x==1) {
																	$pagination .= "<li class=\"active\"><span>".$page."<span class=\"sr-only\">(current)</span></span></li>";
																} else if ($x==$page) {
																	$pagination .= "<li class=\"active\"><span>".$page."<span class=\"sr-only\">(current)</span></span></li>";

																} else { 
																	$pagination .= "<li><a href=\"//" . $_SERVER['HTTP_HOST'] . $page_param . $x . "\">" . $x . " </a></li>";
																}
																$count++;
															}
															if ($page < $total_pages - ($limit/2)) { 
																$pagination .= '<li><span><span aria-hidden="true">...</span></span></li><li><a href="//'.$_SERVER['HTTP_HOST'] . '/' . $page_param . $total_pages . '">'.$total_pages.'</a></li><li><a aria-label="Next" href="//' . $_SERVER['HTTP_HOST'] . '/' . $page_param . ($page+1) . '"><span class="hidden-xs">Next</span> &rsaquo;</a></li>'; 
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