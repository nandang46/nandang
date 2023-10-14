<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php if (!empty($_GET['movie']) || !empty($_GET['tv']) || !empty($_GET['season']) || !empty($_GET['episode'])) { echo $title_site; } if (!empty($static_page)) { echo $static_page . " - "; } else { echo TITLE_SITE; } ?></title>
		<?php include dirname(__FILE__)."/../../includes/metatag.php"; ?>
		<link rel="profile" href="//gmpg.org/xfn/11">
<?php if (empty($_GET['title'])) { ?>
		<script type="text/javascript">
		window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/72x72\/","ext":".png","source":{"concatemoji":"\/\/<?=$_SERVER['HTTP_HOST']?>\/assets\/js\/emoji-release.min.js?ver=4.5.7"}};    !function(a,b,c){function d(a){var c,d,e,f=b.createElement("canvas"),g=f.getContext&&f.getContext("2d"),h=String.fromCharCode;if(!g||!g.fillText)return!1;switch(g.textBaseline="top",g.font="600 32px Arial",a){case"flag":return g.fillText(h(55356,56806,55356,56826),0,0),f.toDataURL().length>3e3;case"diversity":return g.fillText(h(55356,57221),0,0),c=g.getImageData(16,16,1,1).data,d=c[0]+","+c[1]+","+c[2]+","+c[3],g.fillText(h(55356,57221,55356,57343),0,0),c=g.getImageData(16,16,1,1).data,e=c[0]+","+c[1]+","+c[2]+","+c[3],d!==e;case"simple":return g.fillText(h(55357,56835),0,0),0!==g.getImageData(16,16,1,1).data[0];case"unicode8":return g.fillText(h(55356,57135),0,0),0!==g.getImageData(16,16,1,1).data[0]}return!1}function e(a){var c=b.createElement("script");c.src=a,c.type="text/javascript",b.getElementsByTagName("head")[0].appendChild(c)}var f,g,h,i;for(i=Array("simple","flag","unicode8","diversity"),c.supports={everything:!0,everythingExceptFlag:!0},h=0;h<i.length;h++)c.supports[i[h]]=d(i[h]),c.supports.everything=c.supports.everything&&c.supports[i[h]],"flag"!==i[h]&&(c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&c.supports[i[h]]);c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&!c.supports.flag,c.DOMReady=!1,c.readyCallback=function(){c.DOMReady=!0},c.supports.everything||(g=function(){c.readyCallback()},b.addEventListener?(b.addEventListener("DOMContentLoaded",g,!1),a.addEventListener("load",g,!1)):(a.attachEvent("onload",g),b.attachEvent("onreadystatechange",function(){"complete"===b.readyState&&c.readyCallback()})),f=c.source||{},f.concatemoji?e(f.concatemoji):f.wpemoji&&f.twemoji&&(e(f.twemoji),e(f.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>
		<style type="text/css">
		img.wp-smiley,
		img.emoji { display: inline !important; border: none !important;    box-shadow: none !important;    height: 1em !important; width: 1em !important;  margin: 0 .07em !important; vertical-align: -0.1em !important;  background: none !important;    padding: 0 !important;
		}
		</style>
<?php } ?>
		<link rel='stylesheet' id='bootstrap-css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' type='text/css' media='all' />
		<link rel='stylesheet' id='awesome-css' href='//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' type='text/css' media='all' />
		<link rel='stylesheet' id='roboto-css' href='//fonts.googleapis.com/css?family=Roboto%3A400%2C300%2C700' type='text/css' media='all' />
		<link rel='stylesheet' id='default-css' href='//<?=$_SERVER['HTTP_HOST']?>/assets/css/default.min.css' type='text/css' media='all' />
		<link rel='stylesheet' id='default-css' href='//<?=$_SERVER['HTTP_HOST']?>/assets/css/vegas.min.css' type='text/css' media='all' />
		<link href='//fonts.googleapis.com/css?family=Oswald%3A400%2C700&#038;ver=4.5.7' id='oswald-css' media='all' rel='stylesheet' type='text/css'>
		<?php 
			$backdrop_path_style = isset($backdrops_file_path[$random_backdrops_file_path]) ? "//image.tmdb.org/t/p/w1280".trim($backdrops_file_path[$random_backdrops_file_path]) : "//".$_SERVER['HTTP_HOST']."/assets/img/warnerbros.jpg";
		?>

		<style type="text/css">
			#video-player {
				top: 0;
				padding: 15px 0;
				background: url(<?=$backdrop_path_style?>) no-repeat fixed;
				background-size: cover
			}
		</style>
		<link rel="stylesheet" id="magelo-css" href="//<?=$_SERVER['HTTP_HOST']?>/assets/css/style.min.css" type="text/css" media="screen,projection" />
	</head>
	<body class="home single single-movie postid-3078 desktop subdo single-movie-offer">
		
		<?php
			//if (!empty($_GET['title']) || ($style=="lp")) {
			if (!empty($_GET['movie']) || !empty($_GET['tv']) || !empty($_GET['season']) || !empty($_GET['episode']) || ($style=="lp")) {
				include dirname(__FILE__)."/../../includes/player.php"; 
			}
		?>

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
										<a title="People" href="//<?=$_SERVER['HTTP_HOST']?>/people.php">People</a>
									</li>
								</ul>
								<form method="get" class="navbar-form navbar-right" role="search" action="//<?=$_SERVER['HTTP_HOST']?>/search.php">
									<div class="input-group">
										<input type="text" name="s" class="form-control" placeholder="Search">
										<span class="input-group-btn">
											<button type="submit" class="btn btn-primary">
												<span class="glyphicon glyphicon-search"></span>
											</button>
										</span>
									</div>
								</form>
							</div>
						</div>
					</div>
				</nav>

