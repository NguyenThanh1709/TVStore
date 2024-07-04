<?php
$content = getOptions('home_cta_content');
$buttonLink = getOptions('home_cta_button_link');
$buttonName = getOptions('home_cta_button');
?>
<!-- Call To Action -->
<section class="call-to-action section" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-12 wow fadeInUp">
        <div class="call-to-main">
          <?php echo !empty($content) ? html_entity_decode($content) : ''; ?>
          <?php if (!empty($buttonLink)) : ?>
            <a href="<?php echo $buttonLink ?>" class="btn"><?php echo $buttonName ?></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Call To Action -->