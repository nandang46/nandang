<?php 
include dirname(__FILE__)."/includes/config.php";
include dirname(__FILE__)."/includes/function_slug.php";
$static_page = "DMCA Policy";
$style = isset($_GET['style']) ? $_GET['style'] : NULL;
include dirname(__FILE__)."/templates/".TEMPLATE."/header.php";
?>

		</header>


		<div class="site-content clearfix" id="content">
			<div class="container">
				<div class="row">
					<div class="content-area col-md-12 sidebar-" id="primary">
						<main class="site-main" id="main" role="main">
							<article class="post-7 page type-page status-publish hentry" id="post-7">
								<header class="page-header">
									<h1 class="page-title">DMCA Policy</h1>
								</header>
								<!-- .page-header -->

								<div class="page-content">
									<p><strong><?=$_SERVER['HTTP_HOST']?></strong> respects the intellectual property of others. <strong><?=$_SERVER['HTTP_HOST']?></strong> takes matters of Intellectual Property very seriously and is committed to meeting the needs of content owners while helping them manage publication of their content online. It should be noted that <strong><?=$_SERVER['HTTP_HOST']?></strong> is a simple search engine of TV series available at a wide variety of third party websites.</p>


									<p>If you believe that your copyrighted work has been copied in a way that constitutes copyright infringement and is accessible on this site, you may notify our copyright agent, as set forth in the <strong>Digital Millennium Copyright Act</strong> of 1998 (DMCA). For your complaint to be valid under the DMCA, you must provide the following information when providing notice of the claimed copyright infringement:</p>


									<ul>
										<li>A physical or electronic signature of a person authorized to act on behalf of the copyright owner Identification of the copyrighted work claimed to have been infringed</li>


										<li>Identification of the material that is claimed to be infringing or to be the subject of the infringing activity and that is to be removed</li>


										<li>Information reasonably sufficient to permit the service provider to contact the complaining party, such as an address, telephone number, and, if available, an electronic mail address</li>


										<li>A statement that the complaining party "in good faith believes that use of the material in the manner complained of is not authorized by the copyright owner, its agent, or law"</li>


										<li>A statement that the "information in the notification is accurate", and "under penalty of perjury, the complaining party is authorized to act on behalf of the owner of an exclusive right that is allegedly infringed"</li>
									</ul>


									<p>The above information must be submitted as a written, faxed or emailed notification using <span class="pointer" data-target="#modal-dmca" data-toggle="modal"><strong>this form</strong></span></p>


									<div class="modal fade" id="modal-dmca">
										<div class="modal-dialog">
											<div class="modal-content">
												<form action="" id="dmca-form" method="post" name="dmca-form">
													<input name="dmca-post" type="hidden" value="1">

													<div class="modal-header bg-primary">
														<button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>

														<h3 class="text-shadow text-center"><strong>DMCA Notice</strong>
														</h3>
													</div>


													<div class="modal-body">
														<div class="input-group">
															<span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-user"></span> Name</span><input aria-describedby="sizing-addon1" class="form-control" name="dmca-name" placeholder="Real Name" type="text">
														</div>


														<div class="input-group">
															<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-envelope"></span> Email</span><input aria-describedby="sizing-addon2" class="form-control" name="dmca-email" placeholder="Valid Email Address" type="text">
														</div>


														<div class="input-group">
															<span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-copyright-mark"></span> IMDB ID</span><input aria-describedby="sizing-addon3" class="form-control" name="dmca-imdb" placeholder="ex. tt1234567" type="text">
														</div>


														<div class="input-group">
															<textarea class="form-control" name="dmca-reason" placeholder="State your claims here..." rows="5"></textarea>
														</div>


														<div class="input-group">
															<div class="checkbox">
																<label><input name="dmca-agree" type="checkbox"> I have read and agree with <strong>Privacy</strong> and <strong>DMCA Policy</strong></label>
															</div>
														</div>
													</div>


													<div class="modal-footer">
														<div class="pull-right">
															<button aria-hidden="true" class="btn btn-default" data-dismiss="modal">Cancel</button><button class="btn btn-primary" type="submit">Submit</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>


									<p class="alert alert-warning">WE CAUTION YOU THAT UNDER FEDERAL LAW, IF YOU KNOWINGLY MISREPRESENT THAT ONLINE MATERIAL IS INFRINGING, YOU MAY BE SUBJECT TO HEAVY CIVIL PENALTIES. THESE INCLUDE MONETARY DAMAGES, COURT COSTS, AND ATTORNEYS' FEES INCURRED BY US, BY ANY COPYRIGHT OWNER, OR BY ANY COPYRIGHT OWNER'S LICENSEE THAT IS INJURED AS A RESULT OF OUR RELYING UPON YOUR MISREPRESENTATION. YOU MAY ALSO BE SUBJECT TO CRIMINAL PROSECUTION FOR PERJURY.</p>


									<p>This information should not be construed as legal advice, for further details on the information required for valid DMCA notifications, see 17 U.S.C. 512(c)(3).</p>
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