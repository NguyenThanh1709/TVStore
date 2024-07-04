<!-- Breadcrumbs -->
<section class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2><i class="fa fa-pencil"></i><?php echo !empty($data) ? $data['titlePage'] : false; ?></h2>
        <ul>
          <li><a href="<?php echo _WEB_HOST_ROOT; ?>"><i class="fa fa-home"></i>Trang chủ</a></li>
          <!-- <li><a href="index.html"><i class="fa fa-clone"></i>Pages</a></li> -->
          <li class="active"><a><i class="fa fa-clone"></i><?php echo !empty($data) ? $data['titlePage'] : false; ?></a></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!--/ End Breadcrumbs -->