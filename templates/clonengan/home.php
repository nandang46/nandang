			<div class="home-search">
				<div class="row">
					<div class="container">
						<div class="col-md-8 col-md-offset-2">
							<div class="site-description">
								<?=TITLE_SITE?>
							</div>
							<form action="//<?=$_SERVER['HTTP_HOST']?>/search.php" class="form-search" method="get">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group">
											<input class="form-control search-query" name="s" placeholder="Search Movie by Title Here..." type="text">
											<span class="input-group-btn">
												<button type="submit" class="btn btn-primary">
													<span class="glyphicon glyphicon-search"></span>
												</button>
											</span>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div class="site-content clearfix" id="content">
			<div data-images="<?php echo implode('|', $slide); ?>" data-overlay="//<?=$_SERVER['HTTP_HOST']?>/assets/img/overlay-2.png" id="big-slider">
			</div>
			<div class="container">
				<div class="row">
					<div class="content-area col-md-12" id="primary">
						<main class="site-main" id="main" role="main">
							<div class="row">
								<div class="col-md-12">
									<h3 class="sub-section"><span>Now Playing</span></h3>
									<div class="clearfix"></div>

									<ul class="cycle-slideshow cycle-list" data-cycle-fx="carousel" data-cycle-next="#next-latest" data-cycle-prev="#prev-latest" data-cycle-slides="&gt; li" data-cycle-timeout="0" id="movie-latest">
									
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
										foreach ($now_result['results'] as $result) { 
										$now_poster = $result['poster_path'];
										$now_title = isset($result['title']) ? $result['title'] : $result['name'];
										$now_vote_average = $result['vote_average'];

											if ($now_vote_average==0) { $now_vote_average = "Not Rated Yet"; }
											$now_voteAverage = explode(".", $now_vote_average);
											$nowVoteAverage = isset($now_voteAverage[0]) ? $now_voteAverage[0] : NULL;

											$now_release_date = $result['release_date'];
											$now_id = $result['id'];
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
										<li>
											<a data-placement="top" data-toggle="tooltip" href="//'.$seoFriendlyNow.'" target="_blank" title="'.$now_title.'"><img alt="'.$now_title.'" height="195" src="http://image.tmdb.org/t/p/w130'.$now_poster.'" width="130">
												<div class="list-title">
													'.$now_title.' ('.$now_release_date.')
												</div>
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
											</a>
										</li>';
									} ?>
									</ul>
									<div class="lrnav">
										<a href="#" id="prev-latest"><span class="glyphicon glyphicon-chevron-left"></span></a>
										<a href="#" id="next-latest"><span class="glyphicon glyphicon-chevron-right"></span></a>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<h3 class="sub-section"><span>TV Airing Today</span></h3>
									<div class="clearfix"></div>
									<ul class="cycle-slideshow cycle-list" data-cycle-fx="carousel" data-cycle-next="#next" data-cycle-prev="#prev" data-cycle-slides="&gt; li" data-cycle-timeout="0" id="movie-top">
									<?php
									$airing_url = "https://api.themoviedb.org/3/tv/airing_today?api_key=".$tmdb_api."&language=en-US&page=1";
									if (false !== ($html = @file_get_contents($airing_url))) {	
											$airing_result = json_decode($html, true);
										} else {
											$curl = curl_init();
											curl_setopt_array($curl, array(
												CURLOPT_URL => $airing_url,
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
												$airing_result = json_decode($response, true);
											}
										}
									//$airing_result = json_decode(file_get_contents($airing_url), true);
									$airingcount = 0;
									foreach ($airing_result['results'] as $airing) { 
									$airing_id = $airing['id'];
									$airing_poster = $airing['poster_path'];
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
											$seoFriendlyAiring = $_SERVER['HTTP_HOST'] . "/tv/".$airing_id."/".slugUri($airing_title); 
										} else {
											$seoFriendlyAiring = $_SERVER['HTTP_HOST'] . "/tv/".$airing_id;
										}
									} else {
										if (SHOW_TITLE_PARAMETER=="yes") {
											$seoFriendlyAiring = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?tv='.$airing_id.'&title='.slugUri($airing_title);
										} else {
											$seoFriendlyAiring = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?tv='.$airing_id;
										}
									}
									echo '
										<li>
											<a data-placement="top" data-toggle="tooltip" href="//'.$seoFriendlyAiring.'" target="_blank" title="'.$airing_title.'"><img alt="'.$airing_title.'" height="195" src="http://image.tmdb.org/t/p/w130'.$airing_poster.'" width="130">
												<div class="list-title">
													'.$airing_title.' ('.$airing_date.')
												</div>
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
											</a>
										</li>';
									} ?>
									</ul>
									<div class="lrnav">
										<a href="#" id="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
										<a href="#" id="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<h3 class="sub-section"><span>TV On The Air</span></h3>
									<div class="clearfix"></div>
									<ul class="cycle-slideshow cycle-list" data-cycle-fx="carousel" data-cycle-next="#next-2" data-cycle-prev="#prev-2" data-cycle-slides="&gt; li" data-cycle-timeout="0" id="tv-ota">
									<?php
									$ota_url = "https://api.themoviedb.org/3/tv/on_the_air?api_key=".$tmdb_api."&language=en-US&page=1";

									if (false !== ($html = @file_get_contents($ota_url))) {	
											$ota_result = json_decode($html, true);
										} else {
											$curl = curl_init();
											curl_setopt_array($curl, array(
												CURLOPT_URL => $ota_url,
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
												$ota_result = json_decode($response, true);
											}
										}
										foreach ($ota_result['results'] as $tv_ota) { 
										$ota_id = $tv_ota['id'];
										$ota_poster = $tv_ota['poster_path'];
										$ota_title = $tv_ota['name'];
										$ota_date = $tv_ota['first_air_date'];
										$ota_overview = $tv_ota['overview'];
										$ota_vote_average = isset($tv_ota['vote_average']) ? $tv_ota['vote_average'] : NULL;
										if ($ota_vote_average==0) { $ota_vote_average = "Not Rated Yet"; }
										$ota_votes = explode(".", $ota_vote_average);
										$ota_vote = isset($ota_votes[0]) ? $ota_votes[0] : NULL;
										if (SEO_FRIENDLY=="yes") { 
											if (SHOW_TITLE_PARAMETER=="yes") {
												$seoFriendlyOta = $_SERVER['HTTP_HOST'] . "/tv/".$ota_id."/".slugUri($ota_title); 
											} else {
												$seoFriendlyOta = $_SERVER['HTTP_HOST'] . "/tv/".$ota_id; 
											}
										} else {
											if (SHOW_TITLE_PARAMETER=="yes") {
												$seoFriendlyOta = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?tv='.$ota_id.'&title='.slugUri($ota_title);
											} else {
												$seoFriendlyOta = $_SERVER['HTTP_HOST'].'/'.FILE_NAME.'?tv='.$ota_id;
											}
										}
									echo '
										<li>
											<a data-placement="top" data-toggle="tooltip" href="//'.$seoFriendlyOta.'" target="_blank" title="'.$ota_title.'"><img alt="'.$ota_title.'" height="195" src="http://image.tmdb.org/t/p/w130'.$ota_poster.'" width="130">
												<div class="list-title">
													'.$ota_title.' ('.$ota_date.')
												</div>
												<div class="rating" data-placement="right" data-toggle="tooltip" title="'.$ota_vote_average.'">'; ?>
												<?php 
												if ($ota_vote==10) {
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
												} else if ($ota_vote==9) { 
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
												} else if ($ota_vote==8) { 
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
												} else if ($ota_vote==7) { 
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
												} else if ($ota_vote==6) { 
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
												} else if ($ota_vote==5) { 
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
												} else if ($ota_vote==4) { 
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
												} else if ($ota_vote==3) { 
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
												} else if ($ota_vote==2) { 
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
												} else if ($ota_vote==1) { 
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
												} else if ($ota_vote==0) { 
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
											</a>
										</li>';
									} ?>
									</ul>
									<div class="lrnav">
										<a href="#" id="prev-2"><span class="glyphicon glyphicon-chevron-left"></span></a>
										<a href="#" id="next-2"><span class="glyphicon glyphicon-chevron-right"></span></a>
									</div>
								</div>
							</div>
						</main>
						<!-- #main -->
					</div>
					<!-- #primary -->
				</div>
			</div>
		</div>
		<!-- #content -->