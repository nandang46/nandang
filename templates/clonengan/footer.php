			<footer id="colophon" class="site-footer" role="contentinfo">
				<div id="movie-genre-list">
					<div class="container">
						<div class="row">
							<ul class="clearfix">
							<?php
							if (!empty($_GET['tv']) || !empty($_GET['season']) || !empty($_GET['episode'])) { $type = "tv"; } else { $type = "movie"; }
							$genres_list = dirname(__file__) . '/../../genres/genres_' . $type . '.json';
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
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1039"><a href="//<?=$_SERVER['HTTP_HOST']?>/policy.php">Privacy Policy</a></li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1040"><a href="//<?=$_SERVER['HTTP_HOST']?>/disclaimer.php">Disclaimer</a></li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1041"><a href="//<?=$_SERVER['HTTP_HOST']?>/dmca.php">DMCA</a></li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1042"><a href="//<?=$_SERVER['HTTP_HOST']?>/contact.php">Contact</a></li>
						</ul>
					</div>
					<div class="container text-center">Copyright &copy; 2016 <?=TITLE_SITE?>. All rights reserved.<br></div>
				</div>
			</footer>
		</div>
		<script type='text/javascript' src='//code.jquery.com/jquery-2.2.0.min.js'></script>
		<script type='text/javascript' src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/navigation.min.js'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/skip-link-focus-fix.min.js'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/cycle.min.js'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/carousel.min.js'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/preloader.min.js'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/vegas.min.js?ver=4.5.7'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/scripts.min.js'></script>
		<script type='text/javascript' src='//<?=$_SERVER['HTTP_HOST']?>/assets/js/embed.min.js'></script>
		
		<?php include dirname(__FILE__)."/../../includes/histats.php"; ?>

	</body>
</html>