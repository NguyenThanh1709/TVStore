<?php
$data = [
  'pageTitle' => 'Danh sách danh mục bài viết'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Kiểm tra quyền 
$groupID = getGroupID();
$permissionData = getPermissionData($groupID);

$checkPermission = checkPermission($permissionData, 'blog_categories', 'list', 'list');

if (!$checkPermission) {
  setFlashData('msg', 'Bạn không có quyền truy cập vào module này!');
  setFlashData('msg_style', 'danger');
  redirect(getLinkAdmin('dashboarh'));
}


$userID = isLogin()['user_id']; //lấy id user đang login

$view = 'add.php';

$id = 0;

//Xử lý tìm kiếm
$filter = "";

$body = getBody('get');

if (!empty($body['view'])) {
  $view = $body['view'];
}

if (!empty($body['id'])) {
  $id = $body['id'];
}

// Xử lý lọc theo người dùng
if (!empty($body['user_id'])) {
  $user_id = $body['user_id'];
  //Kiểm tra chuổi đã có WHERE hay chưa
  if (!empty($filter) && strpos($filter, "WHERE") >= 0) {
    $oparator = "AND";
  } else {
    $oparator = "WHERE";
  }

  $filter .= " $oparator `user_id` = '$user_id'";
}

// Xử lý lọc theo từ khoá
if (!empty($body['key'])) {
  $keyword = $body['key'];
  //Kiểm tra chuổi đã có WHERE hay chưa
  if (!empty($filter) && strpos($filter, "WHERE") >= 0) {
    $oparator = "AND";
  } else {
    $oparator = "WHERE";
  }

  $filter .= " $oparator `name` LIKE '%$keyword%'";
}


//Xử lý phân trang
$all_blog_categories = getRows("SELECT id FROM `blog_categories` $filter");
// 1. Xác định số lượng bản ghi 1 trang
$perPage = _PER_PAGE;

// 2. Tính số trang
$maxPage = ceil($all_blog_categories / $perPage);

// 3. Xử lý số trang dựa vào phương thức GET
if (!empty(getBody()['page'])) {
  $page = getBody()['page'];
  if ($page < 1 || $page > $maxPage) {
    $page = 1;
  }
} else {
  $page = 1;
}

//4. Tính offset
/*
$page = 1 => offset = 0 => ($page-1) * $perPage 
$page = 2 => offset = 3
$page = 3 => offset = 6
*/
$offset = ($page - 1) * $perPage;

$listCatBlog = getRaw("SELECT `blog_categories`.*, `users`.fullname, `users`.id as user_id, 
(SELECT COUNT(`blog`.id) FROM `blog` WHERE `blog_categories`.id = `blog`.category_id) as portfolioCount
 FROM `blog_categories` INNER JOIN `users` ON `blog_categories`.user_id = `users`.id $filter ORDER BY `create_at` DESC LIMIT $offset, $perPage");
// echo "<pre>";
// print_r($listCatBlog);
// echo "</pre>";
//Xử lý tìm kiếm phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
  $queryString = $_SERVER['QUERY_STRING'];
  $queryString = str_replace('module=blog_categories', '', $queryString);
  $queryString = str_replace("&page=$page", '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = '&' . $queryString;
}

// Lấy danh sách Users
$listUsers = getRaw("SELECT id, fullname, email FROM `users` WHERE `status` = 1 ORDER BY `fullname`");

$error = getFlashData('error');
$old_data = getFlashData('old_data');
$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');

//Check từng chức năng
$checkRoleAdd = checkCurrentPermission('add');
$checkRoleEdit = checkCurrentPermission('edit');
$checkRoleDelete = checkCurrentPermission('delete');
?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <?php
    getMsg($msg, $msg_style);
    ?>
    <div class="d-flex algin-items-center justify-content-end mb-2">
      <!-- Form search -->
      <form method="GET">
        <input type="hidden" name="module" value="blog_categories">
        <div class="input-group input-group-sm">
          <!-- <i class="fa fa-filter bg-white "></i> -->
          <select name="user_id" id="" class="form-control">
            <option value="0">--- Chọn người tạo ---</option>
            <?php
            if (!empty($listUsers)) {
              foreach ($listUsers as $user) {
            ?>
                <option <?php echo !empty($user_id) && !empty($user['id']) && $user['id'] == $user_id ? "selected" : false ?> value="<?php echo $user['id'] ?>"><?php echo $user['fullname'] . " (" . $user['email'] . ")"  ?></option>
            <?php
              }
            }
            ?>
          </select>
          <!-- Tìm kiếm -->
          <input class="form-control" type="search" name="key" value="<?php echo $keyword = !empty($keyword) ? $keyword : false ?>" placeholder="Nhập từ khoá tìm kiếm..." aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-info btn-search" type="submit">
              <i class="fas fa-search"></i> Tìm kiếm
            </button>
          </div>
        </div>
      </form>
      <!-- end - search -->
    </div>
    <div class="row">
      <div class="col-lg-4">
        <div class="card ">
          <?php
          if (!empty($view) && !empty($id)) {
            require $view . '.php';
          } else {
            require $view;
          }
          ?>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card ">
          <div class="card-header">
            <h3 class="card-title font-weight-light">Danh sách danh mục bài viết</h3>
          </div>
          <form role="form">
            <div class="card-body">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th width="5%" scope="col">#</th>
                    <th scope="col">Tên danh mục</th>
                    <th scope="col">Người khởi tạo</th>
                    <th scope="col">Thời gian</th>
                    <th rowspan="2" scope="col">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $temp = $offset;
                  if (!empty($listCatBlog)) :
                    foreach ($listCatBlog as $item) : ?>
                      <tr>
                        <th scope="row" class="align-middle"><?php echo ++$temp; ?></th>
                        <td class="align-middle">
                          <a href="<?php echo getLinkAdmin('blog_categories', '', ['id' => $item['id'], 'view' => 'edit']) ?>"><?php echo $item['name']; ?> </a>
                          <a href="<?php echo getLinkAdmin('blog_categories', 'duplicate', ['id' => $item['id']]) ?>" class="ml-3 btn btn-sm btn-outline-success p-0 px-1">Nhân bản</a>
                          <p class="m-1"><span class="badge badge-secondary">Dự án còn: <?php echo $item['portfolioCount'] ?></span></p>
                        </td>
                        <td class="align-middle"><a href="?module=blog_categories&user_id=<?php echo $item['user_id'] ?>"><?php echo $item['fullname'] ?></a></td>
                        <td class="align-middle"><?php echo $item['create_at']; ?></td>
                        <td colspan="2" class="text-center align-middle">
                          <?php if ($checkRoleEdit) : ?>
                            <a href="<?php echo getLinkAdmin('blog_categories', '', ['id' => $item['id'], 'view' => 'edit']) ?>" class="btn btn-sm btn-warning mr-2">
                              <i class="fa fa-edit"></i> Sửa</a>
                          <?php endif; ?>
                          <?php if ($checkRoleDelete) : ?>
                            <a onclick="return confirm('Bạn chắc chắn xoá dữ liệu này!')" href="<?php echo getLinkAdmin('blog_categories', 'delete', ['id' => $item['id']]) ?>" class="btn btn-sm btn-danger">
                              <i class="fa fa-trash"></i> Xoá</a>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach;
                  else : ?>
                    <tr>
                      <th colspan="5" class="text-center font-weight-light">Không có dữ liệu !</th>
                    </tr>
                  <?php
                  endif
                  ?>
                </tbody>
              </table>
            </div>
          </form>
          <div class="card-footer">
            <?php echo getPaging($page, 'blog_categories', $queryString, $maxPage); ?>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<?php
layout('footer', 'admin', $data);
?>