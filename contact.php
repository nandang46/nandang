<?php 
include dirname(__FILE__)."/includes/config.php";
include dirname(__FILE__)."/includes/function_slug.php";
$static_page = "Contact";
$style = isset($_GET['style']) ? $_GET['style'] : NULL;
include dirname(__FILE__)."/templates/".TEMPLATE."/header.php";
?>

		</header>


		<div class="site-content clearfix" id="content">
			<div class="container">
				<div class="row">
					<div class="content-area col-md-8 sidebar-" id="primary">
						<main class="site-main" id="main" role="main">
							<article class="post-13 page type-page status-publish hentry" id="post-13">
								<header class="page-header">
									<h1 class="page-title">Contact</h1>
								</header>
								<!-- .page-header -->

								<div class="page-content">
									<br>


									<form class="clearfix" id="contact-form" method="post" name="contact-form">
										<div class="input-group">
											<span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-user"></span> Name</span><input aria-describedby="sizing-addon1" class="form-control" name="contact-name" placeholder="Your Real Name" type="text">
										</div>


										<div class="input-group">
											<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-envelope"></span> Email</span><input aria-describedby="sizing-addon2" class="form-control" name="contact-email" placeholder="Your Valid Email Address" type="text">
										</div>


										<div class="input-group">
											<span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-asterisk"></span> Messsage Title</span><input aria-describedby="sizing-addon3" class="form-control" name="contact-title" placeholder="Give your message a title" type="text">
										</div>


										<div class="input-group">
											<textarea class="form-control" name="contact-message" placeholder="Your Message..." rows="5"></textarea>
										</div>


										<div class="pull-right">
											<button class="btn btn-primary" type="submit">Send Messsage</button>
										</div>
									</form>
								</div>
								<!-- .page-content -->

								<footer class="page-footer">
								</footer>
								<!-- .page-footer -->
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
		<!-- #content -->

<?php include dirname(__FILE__)."/templates/".TEMPLATE."/footer.php"; ?>