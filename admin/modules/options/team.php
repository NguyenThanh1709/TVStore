<?php
if (!defined('_INCODE')) die('Access Deined...');
//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}
$data = [
  'pageTitle' => 'Thiết lập đội ngũ'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Lấy danh sách Team
$teamListJson = getOptions('team_list');
$teamListArr = array();
if (!empty($teamListJson)) {
  $teamListArr = json_decode($teamListJson, true);
}
//Kết thúc - lấy danh sách team

if (isPost()) {
  $team = getBody()['team_list'];
  $teamArr = array();
  $teamJson = '';
  // Kiểm tra mảng team có dữ liệu hay không
  if (!empty($team)) {
    foreach (getBody()['team_list']['name'] as $key => $value) {
      $teamArr[] = [
        'name' => $value,
        'position' => getBody()['team_list']['position'][$key],
        'zalo' => getBody()['team_list']['zalo'][$key],
        'behance' => getBody()['team_list']['behance'][$key],
        'x' => getBody()['team_list']['x'][$key],
        'facebook' => getBody()['team_list']['facebook'][$key],
        'linkedin' => getBody()['team_list']['linkedin'][$key],
        'image' => getBody()['team_list']['image'][$key],
      ];
    }
    $teamJson = json_encode($teamArr);
  }

  $data = array(
    'team_list' => $teamJson
  );

  updateOptions($data, 'team');
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
    <form action="" method="post">
      <div class="card card-secondary">
        <div class="card-header">
          <h4 class="text-bold p-0 m-0">Thiết lập trang đội ngũ</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for=""><?php echo getOptions('team_title', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('team_title') ?>" name="team_title" placeholder="Thiết lập tiêu đề giới thiệu.. ">
                <?php echo form_error('team_title', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for=""><?php echo getOptions('team_title_bg', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('team_title_bg') ?>" name="team_title_bg" placeholder="Thiết lập tiêu đề giới thiệu.. ">
                <?php echo form_error('team_title_bg', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="team_desc" class="form-control editor" id="">
                    <?php echo !empty(getOptions('team_desc')) ? getOptions('team_desc') : '' ?>
                </textarea>
                <?php echo form_error('team_desc', $error); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="card card-secondary">
          <div class="card-header">
            <h4 class="text-bold m-0">Danh sách đội ngũ</h4>
          </div>
          <div class="card-body team-wrapper pt-0">
            <?php
            if (!empty($teamListArr)) :
              foreach ($teamListArr as $item) :
            ?>
            <hr>
                <div class="team-item">
                  <div class="row">
                    <div class="col-12">
                      <div class="close-icon">
                        <i class="fa fa-times p-2"></i>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="">Tên</label>
                        <input type="text" class="form-control"  name="team_list[name][]" placeholder="Tên đội ngũ... " value="<?php echo $item['name'] ?>">
                        <?php echo form_error('title_slider', $error); ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="">Tên chức vụ</label>
                        <input type="text" class="form-control" name="team_list[position][]" placeholder="Tên đội ngũ... " value="<?php echo $item['position'] ?>">
                        <?php echo form_error('title_slider', $error); ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group ">
                        <label for="">Hình ảnh</label>
                        <div class="row">
                          <div class="col-10">
                            <input type="text" readonly class="form-control thumbnail" value="<?php echo $item['image'] ?>" name="team_list[image][]" placeholder="Nhập ảnh nền....">
                          </div>
                          <div class="col-2">
                            <button type="button" class="btn btn-success choose-image w-100"><i class="fa fa-upload"></i></button>
                          </div>
                        </div>
                        <?php echo form_error('image', $error); ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="">Facebook</label>
                        <input type="text" class="form-control"  name="team_list[facebook][]" placeholder="Tên đội ngũ... " value="<?php echo $item['facebook'] ?>">
                        <?php echo form_error('title_slider', $error); ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="">X</label>
                        <input type="text" class="form-control" name="team_list[x][]" placeholder="Tên đội ngũ... " value="<?php echo $item['x'] ?>">
                        <?php echo form_error('title_slider', $error); ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="">Linkedin</label>
                        <input type="text" class="form-control" name="team_list[linkedin][]" placeholder="Tên đội ngũ... " value="<?php echo $item['linkedin'] ?>">
                        <?php echo form_error('title_slider', $error); ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="">Zalo</label>
                        <input type="text" class="form-control" name="team_list[zalo][]" placeholder="Tên đội ngũ... " value="<?php echo $item['zalo'] ?>">
                        <?php echo form_error('title_slider', $error); ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="">Behance</label>
                        <input type="text" class="form-control" name="team_list[behance][]" placeholder="Tên đội ngũ... " value="<?php echo $item['behance'] ?>">
                        <?php echo form_error('title_slider', $error); ?>
                      </div>
                    </div>
                  </div>
                </div>
            <?php
              endforeach;
            endif;
            ?>
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-sm btn-warning btn-add-team"><i class="fa fa-plus"></i> Thêm đối tác</button>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary mr-1">Lưu thay đổi</button>
        <a href="<?php echo getLinkAdmin('blogs') ?>" class="btn btn-warning">Quay lại</a>
      </div>
    </form>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
