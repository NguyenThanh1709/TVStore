<?php
//Kiểm tra quyền 

//Lấy dữ liệu phân quyền
$body = getBody('get');

if (!empty($body['id'])) {
  $groupID = $body['id'];
  $groupsDetail = firstRaw("SELECT * FROM `groups` WHERE `id`='$groupID'");
  if (empty($groupsDetail)) { //Kiểm tra nếu không tồn tại
    redirect(getLinkAdmin('groups'));
  }
} else {
  redirect(getLinkAdmin('groups'));
}

$data = [
  'pageTitle' => 'Phân quyền: ' . $groupsDetail['name']
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);



// Xứ lý cập nhật
if (isPost()) {
  $body = getBody(); //lấy dữ liệu từ form

  $errors = array();

  if (empty($errors)) {
    $permissionsJson = json_encode($body['premissions']);

    $dataUpdate = array(
      'permission' => trim($permissionsJson) ?? ''
    );

    $condition = "id='$groupID'";

    $updateStatus = update('`groups`', $dataUpdate, $condition);
    // die();
    if ($updateStatus) {
      setFlashData('msg', 'Phân quyền - chức năng thành công!');
      setFlashData('msg_style', 'success');
      redirect(getLinkAdmin('groups', 'permission', ['id' => $groupID]));
    } else {
      setFlashData('msg', 'Lỗi hệ thống vui lòng thử lại sao!');
      redirect(getLinkAdmin('groups', 'permission', ['id' => $groupID]));
    }
  } else {
    setFlashData('msg', 'Cảnh báo: Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old_data', $body);
  }
}


$old_data = getFlashData('old_data');

if (empty($old_data) && !empty($groupsDetail)) {
  $old_data = $groupsDetail;
}

// showDataArr($old_data);

$errors = getFlashData('errors');

$msg = getFlashData('msg');

$msg_style = getFlashData('msg_style');

//Lấy danh sách module - chức năng
$modules = getRaw("SELECT * FROM `modules`");

if (!empty($old_data['permission'])) {
  $permissionJson = $old_data['permission'];
  $permissionArr = json_decode($permissionJson, true);
}
?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <?php
    getMsg($msg, $msg_style);
    ?>
    <div class="card">
      <form action="" method="post">
        <div class="card-body">
          <div class="row">
            <table class="table table-striped table-bordered permission_list">
              <thead>
                <tr>
                  <th width="25%">Module</th>
                  <th scope="col">Chức năng</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($modules)) :
                  foreach ($modules as $item) :
                    $actions = $item['actions'];
                    $actionArr = json_decode($actions, true);
                ?>
                    <tr>
                      <th>
                        <?php echo $item['title'] ?>
                      </th>
                      <td>
                        <div class="row">
                          <?php
                          if (!empty($actionArr)) :
                            foreach ($actionArr as $roleKey => $roleTitle) :
                          ?>
                              <div class="col-3">
                                <input <?php echo (!empty($permissionArr[$item['name']]) && in_array($roleKey, $permissionArr[$item['name']])) ? 'checked' : false; ?> id="<?php echo $item['name'] . '_' . $roleKey ?>" type="checkbox" value="<?php echo $roleKey ?>" name="<?php echo 'premissions[' . $item['name'] . "][]" ?>" class="hover">
                                <label for="<?php echo $item['name'] . '_' . $roleKey ?>" class="font-weight-normal hover"><?php echo $roleTitle ?></label>
                              </div>
                          <?php
                            endforeach;
                          endif;
                          ?>
                        </div>
                      </td>
                    </tr>
                <?php
                  endforeach;
                endif;
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Phân quyền người dùng">
          <a href="<?php echo getLinkAdmin('groups') ?>" class="btn btn-warning">Quay về</a>
        </div>
      </form>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<?php
layout('footer', 'admin', $data);
?>