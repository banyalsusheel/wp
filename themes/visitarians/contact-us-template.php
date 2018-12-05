<?php /* Template Name: Contact us */
get_header();?>
    <?php while (have_posts()): the_post();?>
		<div class="middle-content no-margin">
			<div class="advertise container">
				<h2 class="top-heading">Choose which package is best suited for you.</h2>
				<!-- Nav tabs -->
				<ul class="nav nav-tabs">
					<li class="nav-item"><a class="nav-link active" href="#featured-event" data-toggle="tab">Rs.0/Month
						Featured Event Listing</a>
					</li>
					<li class="nav-item"><a class="nav-link" href="#free-event" data-toggle="tab">Rs.0/Month
						Free Event Listing</a>
					</li>
					<li class="nav-item"><a class="nav-link" href="#banner-ads" data-toggle="tab">Rs.59/Month
						Banner Ads</a>
					</li>
					<li class="nav-item"><a class="nav-link" href="#back-link" data-toggle="tab">Rs.80/Month
						Back Link</a>
					</li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<div id="featured-event" class="tab-pane container active">
						<div class="form-table">
							<div class="content-sec">
								<h3 class="heading">You Will Get</h3>
								<ol>
									<li>Event will be listed on Homepage.</li>
									<li>Shared on Visitarians Social Pages.</li>
								</ol>
								<h3 class="heading">Requirements We Need:</h3>
								<ol>
									<li>Banner Dimension</li>
									<li>Event Name.</li>
									<li>Event Start and End Date/Time.</li>
									<li>Event Venue</li>
									<li>Event Description</li>
								</ol>
							</div>
							<div class="form-section">
								<h3 class="heading">We'd love to hear from you.</h3>
								<?php echo do_shortcode('[contact-form-7 id="287" title="advertise with us"]'); ?>
							</div>
						</div>
					</div>
					<div id="free-event" class="tab-pane container fade">
						<div class="form-table">
							<div class="content-sec">
								<h3 class="heading">You Will Get</h3>
								<ol>
									<li>Event will be listed on Homepage.</li>
									<li>Shared on Visitarians Social Pages.</li>
								</ol>
								<h3 class="heading">Requirements We Need:</h3>
								<ol>
									<li>Banner Dimension</li>
									<li>Event Name.</li>
									<li>Event Start and End Date/Time.</li>
									<li>Event Venue</li>
									<li>Event Description</li>
								</ol>
							</div>
							<div class="form-section">
								<h3 class="heading">We'd love to hear from you.</h3>
								<?php echo do_shortcode('[contact-form-7 id="287" title="advertise with us"]'); ?>
							</div>
						</div>
					</div>
					<div id="banner-ads" class="tab-pane container fade">
						<div class="form-table">
							<div class="content-sec">
								<h3 class="heading">You Will Get</h3>
								<ol>
									<li>Event will be listed on Homepage.</li>
									<li>Shared on Visitarians Social Pages.</li>
								</ol>
								<h3 class="heading">Requirements We Need:</h3>
								<ol>
									<li>Banner Dimension</li>
									<li>Event Name.</li>
									<li>Event Start and End Date/Time.</li>
									<li>Event Venue</li>
									<li>Event Description</li>
								</ol>
							</div>
							<div class="form-section">
								<h3 class="heading">We'd love to hear from you.</h3>
								<?php echo do_shortcode('[contact-form-7 id="287" title="advertise with us"]'); ?>
							</div>
						</div>
					</div>
					<div id="back-link" class="tab-pane container fade">
						<div class="form-table">
							<div class="content-sec">
								<h3 class="heading">You Will Get</h3>
								<ol>
									<li>Event will be listed on Homepage.</li>
									<li>Shared on Visitarians Social Pages.</li>
								</ol>
								<h3 class="heading">Requirements We Need:</h3>
								<ol>
									<li>Banner Dimension</li>
									<li>Event Name.</li>
									<li>Event Start and End Date/Time.</li>
									<li>Event Venue</li>
									<li>Event Description</li>
								</ol>
							</div>
							<div class="form-section">
								<h3 class="heading">We 'd love to hear from you.</h3>
								<?php echo do_shortcode('[contact-form-7 id="287" title="advertise with us"]'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; // End of the loop.?>
<?php get_footer();
