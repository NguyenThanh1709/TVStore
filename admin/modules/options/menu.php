<?php
if (!defined('_INCODE')) die('Access Deined...');
//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}
$data = [
  'pageTitle' => 'Thiết lập menu'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

if (isPost()) {
  $body = getBody();
  $data = array(
    'header_menu' => $body['menu']
  );
  updateOptions($data, 'menu');
}

$error = getFlashData('errors');
$oldData = getFlashData('old_data');
$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');
?>
<section class="content">
  <div class="container-fluid">
    <?php
    getMsg($msg, $msg_style);
    ?>
    <form id="frmEdit" method="post" class="form-horizontal">
      <div class="row">
        <div class="col-lg-6">
          <ul id="myEditor" class="sortableLists list-group">
          </ul>
          <div class="card mt-5">
            <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-save-menu"><i class="fa fa-save"></i> Lưu cấu trúc Menu</button>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card border-primary mb-3">
            <div class="card-header bg-primary text-white">Thông tin</div>
            <div class="card-body">

              <div class="form-group">
                <label for="text">Tiêu đề</label>
                <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Tiêu đề..">
              </div>
              <div class="form-group">
                <label for="href">Link</label>
                <input type="text" class="form-control item-menu" id="href" name="href" placeholder="Link">
              </div>
              <div class="form-group">
                <label for="target">Target</label>
                <select name="target" id="target" class="form-control item-menu">
                  <option value="_self">Self</option>
                  <option value="_blank">Blank</option>
                  <option value="_top">Top</option>
                </select>
              </div>
              <div class="form-group">
                <label for="title">Tooltip</label>
                <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
              </div>

            </div>
            <div class="card-footer">
              <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Cập nhật</button>
              <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Thêm</button>
            </div>
          </div>
        </div>
      </div>
      <textarea name="menu" id="menu-content" style="display: none;"></textarea>
    </form>
  </div>
</section>
<script type="text/javascript">
  <?php
  $menuJson = getOptions('header_menu');
  $menuJson = !empty($menuJson) ? html_entity_decode($menuJson) : false;
  ?>
  var arrayJson = <?php echo $menuJson ?>
</script>
<?php
layout('footer', 'admin', $data);
