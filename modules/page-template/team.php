<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'titlePage' => getOptions('team_title')
];
layout('header', 'client', $data);

layout('breadcrumbs', 'client', $data);

// $titlePage = getOptions('team_title');
$titleBg = getOptions('team_title_bg');
$content = getOptions('team_desc');

$teamList = getOptions('team_list');
$teamListArr = json_decode($teamList, true);
// echo "<pre>";
// print_r($teamListArr);
// echo "</pre>";
?>
<!-- Start Team -->
<section id="team" class="team section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <span class="title-bg"><?php echo !empty($titleBg) ? $titleBg : false; ?></span>
          <?php
          echo !empty($content) ? html_entity_decode($content) : false;
          ?>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
      if (!empty($teamListArr)) :
        foreach ($teamListArr as $item) :
      ?>
          <div class="col-lg-3 col-md-6 col-12">
            <!-- Single Team -->
            <div class="single-team">
              <div class="t-head">
                <img src="<?php echo !empty($item['image']) ? $item['image'] : false; ?>" alt="#">
                <!-- <div class="t-icon">
                  <a href="team-single.html"><i class="fa fa-plus"></i></a>
                </div> -->
              </div>
              <div class="t-bottom">
                <p><?php echo $item['position'] ?></p>
                <h2><?php echo $item['name'] ?></h2>
                <ul class="t-social">
                  <li><a href="<?php echo !empty($item['facebook']) ? $item['facebook'] : false; ?>"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="<?php echo !empty($item['x']) ? $item['x'] : false; ?>"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="<?php echo !empty($item['linkedin']) ? $item['linkedin'] : false; ?>"><i class="fa fa-linkedin"></i></a></li>
                  <li><a href="<?php echo !empty($item['behance']) ? $item['behance'] : false; ?>"><i class="fa fa-behance"></i></a></li>
                </ul>
              </div>
            </div>
            <!-- End Single Team -->
          </div>
      <?php
        endforeach;
      endif;
      ?>
    </div>
  </div>
</section>
<!--/ End Team -->
<?php
layout('footer', 'client', $data);
?>