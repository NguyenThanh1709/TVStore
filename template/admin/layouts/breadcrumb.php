<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark font-weight-bold"><?php echo $data['pageTitle'] = !empty($data) ? $data['pageTitle'] : null; ?></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo _WEB_HOST_ROOT_ADMIN ?>">Trang chủ</a></li>
          <li class="breadcrumb-item active"><?php echo $data['pageTitle'] = !empty($data) ? $data['pageTitle'] : null; ?></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->