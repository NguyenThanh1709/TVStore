<!-- Breadcrumbs -->
<section class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2><i class="fa fa-pencil"></i>
          <?php
          // print_r($data);
          if (!empty($data['namePage'])) {
            echo $data['namePage'];
          } elseif ($data['titlePage']) {
            echo $data['titlePage'];
          } ?></h2>
        <ul class="list-breadcrumbs">
          <li><a href="<?php echo _WEB_HOST_ROOT; ?>"><i class="fa fa-home"></i>Trang chủ</a></li>
          <?php echo !empty($data['itemParent']) ? $data['itemParent'] : false; ?>
          <li class="active"><a title="<?php echo !empty($data['titlePage']) ? $data['titlePage'] : false; ?>"><i class="fa fa-clone"></i><?php echo !empty($data['titlePage']) ? getLimitText($data['titlePage'], 4)  : false; ?>
            </a></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!--/ End Breadcrumbs -->