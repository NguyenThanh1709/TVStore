<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Thông tin bài viết'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id']; //lấy id user đang login

if (!empty(getBody('get')['id'])) {
  $blog_id = getBody('get')['id'];

  $blogRow = firstRaw("SELECT * FROM `blog` WHERE `id`='$blog_id'");
  if (empty($blogRow)) {
    redirect(getLinkAdmin('blogs'));
  } else {
  }
} else {
  redirect(getLinkAdmin('blogs'));
}

$oldData = $blogRow;

// Lấy danh sách danh mục
$listCatBogs = getRaw("SELECT `id`, `name` FROM `blog_categories`");


$linkUrl = _WEB_HOST_ROOT . '/' . getPremaLink(getBody()['module']) . '/' . old('slug', $oldData) . ".html";
?>
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <form action="" method="post">
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="">Tiêu đề</label>
                <input type="text" readonly class="form-control name" value="<?php echo old('title', $oldData) ?>" name="title" placeholder="Nhập tên bài viết....">

              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Đường dẫn tĩnh <span id="auto-slug" class="text-info text-13">[Tự động điền]</span></label>
                <input type="text" readonly class="form-control" value="<?php echo old('slug', $oldData) ?>" name="slug" placeholder="Nhập slug bài viết....">
                <span>Link: <a href="<?php echo $linkUrl  ?>" class="text-url"><?php echo $linkUrl  ?></a></span>

              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Ngày khởi tạo</label>
                <input type="text" readonly class="form-control" value="<?php echo old('create_at', $oldData) ?>" name="create_at" placeholder="Nhập link video dự án....">

              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Ngày cập nhật</label>
                <input type="text" readonly class="form-control" value="<?php echo old('update_at', $oldData) ?>" name="update_at" placeholder="Nhập link video dự án....">

              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="">Danh mục</label>
                <select readonly name="category_id" id="" class="form-control">
                  <?php
                  if (!empty($listCatBogs)) {
                    foreach ($listCatBogs as $item) {
                  ?>
                      <option <?php echo old('category_id', $oldData) == $item['id'] ? "selected" : false;  ?> value="<?php echo $item['id'] ?>"><?php echo $item['name']; ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label for="" class="form-label">Mô tả ngắn</label>
                <textarea readonly name="dscription" id="" class="form-control" placeholder="Nhập mô tả ngắn..."><?php echo old('dscription', $oldData) ?></textarea>

              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="" class="form-label">Nội dung</label>
                <textarea readonly name="content" class="form-control editor" placeholder="Nhập nội dung bài viết..."><?php echo old('content', $oldData) ?></textarea>

              </div>
            </div>
            <div class="col-12">
              <div class="form-group ">
                <label for="">Hình ảnh đại diện</label>
                <div class="row">
                  <div class="card ml-2" style="width: 18rem;">
                    <img src="<?php echo $oldData['thumbnail'] ?>" title="Ảnh đã tải lên" alt="Ảnh tải lên" class="img-thumbnail">
                  </div>
                  <div class="col-10">
                    <input readonly type="text" readonly class="form-control thumbnail" value="<?php echo old('thumbnail', $oldData) ?>" name="thumbnail" placeholder="Nhập hình ảnh bài viết....">
                  </div>
                  <div class="col-2">
                    <button disabled type="button" class="btn btn-success choose-image w-100"><i class="fa fa-image"></i> Chọn hình ảnh</button>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <a href="<?php echo getLinkAdmin('blogs', 'edit', ['id' => $blog_id]) ?>" class="btn btn-primary mr-1">Cập nhật bài viết</a>
          <a href="<?php echo getLinkAdmin('blogs') ?>" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
