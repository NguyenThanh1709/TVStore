<?php
$homeSlide = getOptions('home_slide');
if (!empty($homeSlide)) {
	$homeSlideArr = json_decode($homeSlide, true);
	if (!empty($homeSlideArr)) {
		// echo "<pre>";
		// print_r($homeSlideArr);
		// echo "</pre>";
?>
		<!-- Hero Area -->
		<section id="hero-area" class="hero-area">
			<!-- Slider -->
			<div class="slider-area">
				<?php
				foreach ($homeSlideArr as $item) {
					$classItemSlide = '';
					if (!empty($item['position_slide'])) {
						if ($item['position_slide'] == 'midle') {
							$classItemSlide = 'slider-center';
						} elseif ($item['position_slide'] == 'right') {
							$classItemSlide = 'slider-right';
						}
					}

					// die();


				?>
					<!-- Single Slider -->
					<div class="single-slider <?php echo !empty($classItemSlide) ? $classItemSlide : false; ?>" style="background-image:url('<?php echo $item['slide_bg'] ?>')">
						<div class="container">
							<div class="row">
								<?php
								$allowTwoCol = false;
								$classCol = 'col-lg-10 offset-lg-1 col-12';
								if (!empty($item['image_silde_1']) || !empty($item['image_silde_2'])) {
									$allowTwoCol = true;
									$classCol = 'col-lg-7 col-md-6 col-12';
								}
								?>
								<div class="<?php echo $classCol ?>">
									<!-- Slider Text -->
									<div class="slider-text">
										<h1><?php echo !empty($item['title_slider']) ? html_entity_decode($item['title_slider']) : '' ?></h1>
										<p><?php echo !empty($item['desc_slider']) ? $item['desc_slider'] : '' ?></p>
										<div class="button">
											<a href="portfolio-3-column.html" class="btn"><?php echo $item['button_slider'] ?></a>
											<a href="<?php echo $item['video_slider'] ?>" class="btn video video-popup mfp-fade"><i class="fa fa-play"></i>Play Now</a>
										</div>
									</div>
									<!--/ End Slider Text -->
								</div>
								<?php if ($allowTwoCol) : ?>
									<div class="col-lg-5 col-md-6 col-12">
										<!-- Image Gallery -->
										<div class="image-gallery">
											<div class="single-image">
												<img src="<?php echo $item['image_silde_1'] ?>" alt="#">
											</div>
											<div class="single-image two">
												<img src="<?php echo $item['image_silde_2'] ?>" alt="#">
											</div>
										</div>
										<!--/ End Image Gallery -->
									</div>
								<?php endif ?>
							</div>
						</div>
					</div>
					<!--/ End Single Slider -->
				<?php } ?>

			</div>
			<!--/ End Slider -->
		</section>
		<!--/ End Hero Area -->
<?php
	}
}
?>