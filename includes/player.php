<?php
include dirname(__FILE__)."/opening.php";
?>

		<div id="video-player">
			<div class="container">
				<div id="magelo-player">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe id="intro" class="embed-responsive-item" src="https://www.youtube.com/embed/<?=$opening_video?>?hd=1&amp;autoplay=0&amp;rel=0&amp;controls=0&amp;showinfo=0&amp;modestbranding=1" data-duration="27000" frameborder="0"></iframe>
						<div id="cover-top"></div>
						<div id="cover-bottom"></div>
						<video id="videoPlayer" class="embed-responsive-item" preload="none" poster="<?=$backdrop_path_style?>">
						<p>Your browser doesn't support HTML5 video.</p>
						</video>
						<span class="play-wrapper ease">
							<span id="play" class="fa fa-youtube-play ease"></span>
						</span>
						<div class="media-controls">
							<div id="leftControls">
								<button type="button" name="Play" class="btn glyphicon glyphicon-play" id="play_btn"></button>
								<button id="volumeInc_btn" name="Volume" class="btn glyphicon glyphicon-volume-up"></button>
								<button id="timeContainer" class="btn"><?php echo str_replace(array(" Hours ", " Minutes"), array(":", ""), hour_min($runtime)); ?>:<span class="timer">00</span></button>
							</div>

							<div id="progressContainer">
								<span id="progress-bar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" data-count="0.387931034483%"></span>
							</div>
							<div id="rightControls">
								<div id="sliderContainer">
									<div id="slider" class="ui-slider ui-slider-vertical ui-widget ui-widget-content ui-corner-all">
										<div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="height: 50%;"></div>
										<span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="bottom: 50%;"></span>
									</div>
								</div>
								<div id="setting_btn" class="btn-group dropup">
									<button name="Setting" class="btn glyphicon glyphicon-cog dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-hd-video"></span></button>
									<ul class="dropdown-menu dropdown-menu-right">
										<li class="hq active">HD 1080p</li>
										<li class="hq">HD 720p</li>
									</ul>
								</div>
								<button id="fullscreen_btn" name="Fullscreen" class="btn glyphicon glyphicon-resize-full"></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="modal-offer" data-domain="#" data-campaign="" data-movie="<?=$tmdb_id?>" data-title="<?=$title?>" class="modal fade pointer" onclick="window.location.href='//<?=$_SERVER['HTTP_HOST']?>/register.php';">
			<div class="modal-dialog">
				<div id="login" class="modal-content">
					<div class="top-content" style="background-image:url(<?=str_replace("w1280", "w780", $backdrop_path_style)?>)">
						<p class="text-center top"><?=$title?></p>
						<p class="text-center bottom">Released Date: <?=$release_date?></p>
					</div>
					<div class="bottom-content">
						<img class="img-responsive" src="//<?=$_SERVER['HTTP_HOST']?>/assets/img/offer.png" width="614" height="275">
						<p class="text-center"><span class="btn btn-offer btn-primary btn-lg" data-title="<?=$title?>">Register Free Account</span></p>
					</div>
				</div>
			</div>
		</div>