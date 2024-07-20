<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Danh sách trang'
];
layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id'];

// Xử lý lọc, tìm kiếm
$filter = "";
if (isGET()) {
  $body = getBody();

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

    $filter .= " $oparator `title` LIKE '%$keyword%'";
  }
}

//Xử lý phân trang
$allPageNum = getRows("SELECT id FROM `pages` $filter");
// echo $allPageNum;
// 1. Xác định số lượng bản ghi 1 trang
$perPage = _PER_PAGE;

// 2. Tính số trang
$maxPage = ceil($allPageNum / $perPage);

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

//Xử lý tìm kiếm phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
  $queryString = $_SERVER['QUERY_STRING'];
  $queryString = str_replace('module=pages', '', $queryString);
  $queryString = str_replace("&page=$page", '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = '&' . $queryString;
}

//Lấy danh sách trang
$listPages = getRaw("SELECT `pages`.*, `users`.fullname, `users`.id as user_id FROM `pages` INNER JOIN `users` ON `pages`.user_id = `users`.id $filter ORDER BY `create_at` LIMIT $offset, $perPage");

// Lấy danh sách Users
$listUsers = getRaw("SELECT id, fullname, email FROM `users` WHERE `status` = 1 ORDER BY `fullname`");

// echo $queryString;
$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');

?>

<div class="container-fluid">
  <?php
  getMsg($msg, $msg_style);
  ?>
  <div class="card ">
    <div class="card-header ">
      <div class="d-flex algin-items-center justify-content-between">
        <a href="<?php echo getLinkAdmin('pages', 'add') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
        <!-- Form search -->
        <form method="GET">
          <input type="hidden" name="module" value="pages">
          <div class="input-group input-group-sm">
            <select name="user_id" id="" class="form-control">
              <option value="0">--Chọn người đăng--</option>
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
    </div>
    <div class="card-body">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th width="5%" scope="col">#</th>
            <th scope="col">Tên tiêu đề</th>
            <th scope="col">Người đăng</th>
            <th scope="col">Thời gian</th>
            <th width="25%" rowspan="2" scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($listPages)) :
            $temp = $offset;
            foreach ($listPages as $keyword => $value) : ?>
              <tr>
                <th class="align-middle" scope="row"><?php echo ++$temp ?></th>
                <td class="align-middle">
                  <a href="<?php echo getLinkAdmin('pages', 'edit', ['id' => $value['id']]) ?>"><?php echo $value['title'] ?></a>
                  <a href="<?php echo getLinkAdmin('pages', 'duplicate', ['id' => $value['id']]) ?>" class="ml-3 btn btn-sm btn-outline-success p-0 px-1">Nhân bản</a>
                </td>
                <td class="align-middle"><a href="?module=pages&user_id=<?php echo $value['user_id'] ?>"><?php echo $value['fullname'] ?></a></td>
                <td class="align-middle"><?php echo $value['create_at'] ?></td>
                <td colspan="3" class="text-center align-middle">
                  <a target="_blank" href="<?php echo getLinkModule('pages', $value['slug'])  ?>" class="btn btn-sm btn-primary mr-2">
                    <i class="fa fa-eye"></i> Xem</a>
                  <a href="<?php echo getLinkAdmin('pages', 'edit', ['id' => $value['id']]) ?>" class="btn btn-sm btn-warning mr-2">
                    <i class="fa fa-edit"></i> Sửa</a>
                  <a onclick="return confirm('Bạn chắc chắn xoá dữ liệu này!')" href="<?php echo getLinkAdmin('pages', 'delete', ['id' => $value['id']]) ?>" class="btn btn-sm btn-danger">
                    <i class="fa fa-trash"></i> Xoá</a>
                </td>
              </tr>
            <?php
            endforeach;
          else : ?>
            <tr>
              <th colspan="7" class="text-center font-weight-light">Không có dữ liệu !</th>
            </tr>
          <?php
          endif
          ?>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <?php echo getPaging($page, 'pages', $queryString, $maxPage) ?>
    </div>
  </div>
</div>

<?php
layout('footer', 'admin', $data);
?>