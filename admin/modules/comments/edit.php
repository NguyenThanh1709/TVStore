<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Cập nhật bình luận'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$id = getBody('get')['id'];
//Check tồn tại id trong csdl 
$check = getRows("SELECT id FROM `comment` WHERE `id` = '$id'");
if ($check <= 0) {
  redirect(getLinkAdmin("comments"));
}

$comment = firstRaw("SELECT `comment`.*, `blog`.title as blog_title, `users`.id as user_id, `users`.fullname as user_fullname, `users`.email as user_email, `groups`.name as group_name 
FROM `comment` LEFT JOIN `blog` ON `comment`.blog_id = `blog`.id  
LEFT JOIN `users` ON `comment`.user_id = `users`.id 
LEFT JOIN `groups` ON `groups`.id = `users`.group_id WHERE `comment`.id = '$id'");

//Xử lý cập nhật
if (isPost()) {

  $body = getBody(); //lấy dữ liệu từ form

  $errors = array();

  //Validation fullname
  if (empty(trim($body['content']))) {
    $errors['content']['required'] = "Nội dung bình luận bắt buộc nhập!";
  }
  //Nếu dữ liệu đầu vào đúng
  if (empty($errors)) {
    $dataInsert = [
      "content" => $body['content'],
    ];

    $updateStatus = update('comment', $dataInsert, "id='$id'");
    if ($updateStatus) {
      setFlashData('msg', 'Cập nhật bình luận mới thành công !');
      setFlashData('msg_style', 'success');
      redirect(getLinkAdmin('comments'));
    } else {
      setFlashData('msg', 'Đã xảy ra lỗi khi chỉnh sửa!');
      setFlashData('msg_style', 'danger');
      redirect(getLinkAdmin('comments', 'edit', ['id' => $id]));
    }
  } else {
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old_data', $body);
    redirect(getLinkAdmin('comments', 'edit', ['id' => $id]));
  }
}
$error = getFlashData('errors');
$oldData = getFlashData('old_data');
if (empty($oldData)) {
  $oldData = $comment;
}

$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');

?>
<section class="content">
  <div class="container-fluid">
    <?php
    getMsg($msg, $msg_style);
    ?>
    <?php
    if (!empty($comment['blog_title'])) {
    ?>
      <?php echo "<strong>Trả lời bình luận bài viết: </strong>" . "<a href='#' class='d-inline-block mb-3'>" . $comment['blog_title'] . "</a>" ?>
    <?php
    }
    ?>
    <div class="card">
      <form action="" method="post">
        <div class="card-body">
          <div class="row">
            <?php if (empty($oldData['user_id'])) : ?>
              <div class="col-6">
                <div class="form-group">
                  <label for="">Tên bình luận</label>
                  <input type="text" class="form-control name" disabled value="<?php echo old('name', $oldData) ?>" name="name" placeholder="Nhập tên bình luận....">
                  <?php echo form_error('name', $error); ?>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="">Email bình luận</label>
                  <input type="text" class="form-control" disabled value="<?php echo old('email', $oldData) ?>" name="email" placeholder="Nhập email bình luận....">
                  <?php echo form_error('email', $error); ?>
                </div>
              </div>
            <?php else : ?>
              <div class="col-6">
                <div class="form-group">
                  <h5>Thông tin người dùng</h5>
                  <p class="text-info ml-2"><strong>Tên: </strong><?php echo $comment['user_fullname'] ?></p>
                  <p class="text-info ml-2"><strong>Email: </strong><?php echo $comment['user_email'] ?></p>
                  <p class="text-info ml-2"><strong>Nhóm: </strong><?php echo $comment['group_name'] ?></p>
                </div>
              </div>
            <?php endif; ?>
            <div class="col-12">
              <div class="form-group">
                <label for="" class="form-label">Nội dung bình luận</label>
                <textarea name="content" id="" class="form-control" placeholder="Nhập Nội dung bình luận..."><?php echo old('content', $oldData) ?></textarea>
                <?php echo form_error('content', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Ngày bình luận</label>
                <input type="text" readonly class="form-control" value="<?php echo old('create_at', $oldData) ?>" name="create_at" placeholder="Nhập ngày bình luận....">
                <?php echo form_error('create_at', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Ngày cập nhật</label>
                <input type="text" readonly class="form-control" value="<?php echo old('update_at', $oldData) ?>" name="update_at" placeholder="Nhập ngày cập nhật....">
                <?php echo form_error('update_at', $error); ?>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-1">Cập nhật bình luận</button>
          <a href="<?php echo getLinkAdmin('comments') ?>" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
