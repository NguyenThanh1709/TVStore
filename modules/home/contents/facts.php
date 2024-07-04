<?php
$title = getOptions('home_fact_title');

$subTitle = getOptions('home_fact_sub_title');

$desc = getOptions('home_fact_desc');

$buttonText = getOptions('home_fact_button_text');

$buttonLink = getOptions('home_fact_button_link');

$yearNumber = getOptions('home_fact_year_number');
$yearNumberName = getOptions('home_fact_year_number', 'label');

$projectNumber = getOptions('home_fact_project_number');
$projectNumberName = getOptions('home_fact_project_number', 'label');
$projectUnit = getOptions('home_fact_project_unit');

$totalNumber = getOptions('home_fact_total_number');
$totalNumberName = getOptions('home_fact_total_number', 'label');
$totalUnit = getOptions('home_fact_total_unit');

$awardsNumber = getOptions('home_fact_awards_number');
$awardsNumberName = getOptions('home_fact_awards_number', 'label');



?>
<!-- Fun Facts -->
<section id="fun-facts" class="fun-facts section">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-12 wow fadeInLeft" data-wow-delay="0.5s">
        <div class="text-content">
          <div class="section-title">
            <?php if (!empty($title) || !empty($subTitle)) : ?>
              <h1><span><?php echo !empty($subTitle) ? $subTitle : false; ?></span><?php echo !empty($title) ? html_entity_decode($title) : false; ?></h1>
              <p><?php echo !empty($desc) ? html_entity_decode($desc) : false;  ?></p>
            <?php endif; ?>
            <a href="<?php echo !empty($buttonLink) ? $buttonLink : false;  ?>" class="btn primary"><?php echo !empty($buttonText) ? $buttonText : false;  ?></a>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-12">
        <div class="row">
          <?php if (!empty($yearNumber)) : ?>
            <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="0.6s">
              <!-- Single Fact -->
              <div class="single-fact">
                <div class="icon"><i class="fa fa-clock-o"></i></div>
                <div class="counter">
                  <p><span class="count"><?php echo !empty($yearNumber) ? $yearNumber : false; ?></span></p>
                  <h4><?php echo !empty($yearNumberName) ? $yearNumberName : false; ?></h4>
                </div>
              </div>
              <!--/ End Single Fact -->
            </div>
          <?php endif ?>
          <?php if (!empty($projectNumber)) : ?>
            <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="0.8s">
              <!-- Single Fact -->
              <div class="single-fact">
                <div class="icon"><i class="fa fa-bullseye"></i></div>
                <div class="counter">
                  <p><span class="count"><?php echo !empty($projectNumber) ? $projectNumber : false; ?></span> <?php echo $projectUnit ?></p>
                  <h4><?php echo !empty($projectNumberName) ? $projectNumberName : false; ?></h4>
                </div>
              </div>
              <!--/ End Single Fact -->
            </div>
          <?php endif ?>
          <?php if (!empty($totalNumber)) : ?>
            <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="1s">
              <!-- Single Fact -->
              <div class="single-fact">
                <div class="icon"><i class="fa fa-dollar"></i></div>
                <div class="counter">
                  <p><span class="count"><?php echo !empty($totalNumber) ? $totalNumber : false; ?></span> <?php echo $totalUnit ?></p>
                  <h4><?php echo !empty($totalNumberName) ? $totalNumberName : false; ?></h4>
                </div>
              </div>
              <!--/ End Single Fact -->
            </div>
          <?php endif ?>
          <?php if (!empty($awardsNumber)) : ?>
            <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="1.2s">
              <!-- Single Fact -->
              <div class="single-fact">
                <div class="icon"><i class="fa fa-trophy"></i></div>
                <div class="counter">
                  <p><span class="count"><?php echo !empty($awardsNumber) ? $awardsNumber : false; ?></span></p>
                  <h4><?php echo !empty($awardsNumberName) ? $awardsNumberName : false; ?></h4>
                </div>
              </div>
              <!--/ End Single Fact -->
            </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Fun Facts -->