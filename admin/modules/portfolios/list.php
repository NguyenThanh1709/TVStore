<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Danh sách dự án'
];
layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}


$userID = isLogin()['user_id'];
// ---- Dữ liệu hiển thị ở SELECT OPTION -----///
// Lấy danh sách Users
$listUsers = getRaw("SELECT id, fullname, email FROM `users` WHERE `status` = 1 ORDER BY `fullname`");

// Lấy danh sách danh mục
$listPortfliosCategories = getRaw("SELECT `id`, `name` FROM `portfolio_categories`");


// ---------- end ------------------
// Xử lý lọc, tìm kiếm
$filter = "";
if (isGET()) {
  $body = getBody();

  // Xử lý lọc theo danh mục
  if (!empty($body['portfolio_categories_id'])) {
    $portfolio_categories_id = $body['portfolio_categories_id'];
    // die($portfolio_categories_id);
    //Kiểm tra chuổi đã có WHERE hay chưa
    if (!empty($filter) && strpos($filter, "WHERE") >= 0) {
      $oparator = "AND";
    } else {
      $oparator = "WHERE";
    }

    $filter .= " $oparator `portfolios`.portfolio_categories_id = '$portfolio_categories_id'";
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

    $filter .= " $oparator `portfolios`.user_id = '$user_id'";
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

    $filter .= " $oparator `portfolios`.name LIKE '%$keyword%'";
  }
}

// echo $filter;
//Xử lý phân trang
$allPortlios = getRows("SELECT id FROM portfolios $filter");
// echo $allPortlios;
// 1. Xác định số lượng bản ghi 1 trang
$perPage = _PER_PAGE;

// 2. Tính số trang
$maxPage = ceil($allPortlios / $perPage);

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
  $queryString = str_replace('module=portfolios', '', $queryString);
  $queryString = str_replace("&page=$page", '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = '&' . $queryString;
}

//Lấy danh sách dự án
$listPortflios = getRaw("SELECT `portfolios`.*, `users`.fullname, `users`.id as user_id, `portfolio_categories`.name as portfolio_categories_name
FROM `portfolios` INNER JOIN `users` ON `portfolios`.user_id = `users`.id 
INNER JOIN `portfolio_categories` ON `portfolios`.portfolio_categories_id = `portfolio_categories`.id $filter ORDER BY `create_at` LIMIT $offset, $perPage");




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
        <a href="<?php echo getLinkAdmin('portfolios', 'add') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
        <!-- Form search -->
        <form method="GET">
          <input type="hidden" name="module" value="portfolios">
          <div class="input-group input-group-sm">
            <select name="portfolio_categories_id" id="" class="form-control">
              <option value="0">--Chọn danh mục--</option>
              <?php
              if (!empty($listPortfliosCategories)) {
                foreach ($listPortfliosCategories as $item) {
              ?>
                  <option <?php echo !empty($portfolio_categories_id) && !empty($item['id']) && $item['id'] == $portfolio_categories_id ? "selected" : false ?> value="<?php echo $item['id'] ?>"><?php echo $item['name']; ?></option>
              <?php
                }
              }
              ?>
            </select>
            <select name="user_id" id="" class="form-control">
              <option value="0">--Chọn người đăng--</option>
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
            <th width="10%" scope="col">Ảnh</th>
            <th width="30%" scope="col">Tên dự án</th>
            <th scope="col">Danh mục</th>
            <th scope="col">Người khởi tạo</th>
            <th width="10%" scope="col">Thời gian</th>
            <th width="20%" rowspan="2" scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($listPortflios)) :
            $temp = $offset;
            foreach ($listPortflios as $keyword => $value) : ?>
              <tr>
                <th class="align-middle" scope="row"><?php echo ++$temp ?></th>
                <td class="align-middle"><img src="<?php echo $value['thumbnail'] ?>" class="w-100" alt=""></td>
                <td class="align-middle">
                  <a href="<?php echo getLinkAdmin('portfolios', 'edit', ['id' => $value['id']]) ?>"><?php echo $value['name'] ?></a>
                  <a href="<?php echo getLinkAdmin('portfolios', 'duplicate', ['id' => $value['id']]) ?>" class="ml-3 btn btn-sm btn-outline-success p-0 px-1">Nhân bản</a>
                </td>
                <td class="align-middle"><a href="?module=portfolios&portfolio_categories_id=<?php echo $value['portfolio_categories_id'] ?>"><span class="badge badge-pill badge-success"><?php echo $value['portfolio_categories_name'] ?></span></a></td>
                <td class="align-middle"><a href="?module=portfolios&user_id=<?php echo $value['user_id'] ?>"><?php echo $value['fullname'] ?></a></td>
                <td class="align-middle"><?php echo $value['create_at'] ?></td>
                <td colspan="3" class="text-center align-middle">
                  <a target="_blank" href="<?php echo getLinkModule('portfolios', $value['slug'])  ?>" class="btn btn-sm btn-primary mr-2">
                    <i class="fa fa-eye"></i> Xem</a>
                  <a href="<?php echo getLinkAdmin('portfolios', 'edit', ['id' => $value['id']]) ?>" class="btn btn-sm btn-warning mr-2">
                    <i class="fa fa-edit"></i> Sửa</a>
                  <a onclick="return confirm('Bạn chắc chắn xoá dữ liệu này!')" href="<?php echo getLinkAdmin('portfolios', 'delete', ['id' => $value['id']]) ?>" class="btn btn-sm btn-danger">
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
      <?php echo getPaging($page, 'portfolios', $queryString, $maxPage) ?>
    </div>
  </div>
</div>

<?php
layout('footer', 'admin', $data);
?>