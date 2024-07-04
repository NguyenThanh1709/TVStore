<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Danh sách người dùng'
];
layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id'];

// Xử lý lọc, tìm kiếm
$filter = "";
if (isGET()) {
  $body = getBody();
  // echo "<pre>";
  // print_r($body);
  // echo "</pre>";
  if (!empty($body['status'])) {
    $status = $body['status'];
    if ($status == 2) {
      $statusSql = 0;
    } else {
      $statusSql = $status;
    }

    //Kiểm tra chuổi đã có WHERE hay chưa
    if (!empty($filter) && strpos($filter, "WHERE") >= 0) {
      $oparator = "AND";
    } else {
      $oparator = "WHERE";
    }

    $filter .= "WHERE status = '$statusSql'";
  }

  // Xử lý lọc theo từ khóc
  if (!empty($body['key'])) {
    $keyword = $body['key'];
    //Kiểm tra chuổi đã có WHERE hay chưa
    if (!empty($filter) && strpos($filter, "WHERE") >= 0) {
      $oparator = "AND";
    } else {
      $oparator = "WHERE";
    }

    $filter .= " $oparator `fullname` LIKE '%$keyword%'";
  }

  // Xử lý lọc theo nhóm người dùng
  if (!empty($body['group_id'])) {
    $group_id = $body['group_id'];
    //Kiểm tra chuổi đã có WHERE hay chưa
    if (!empty($filter) && strpos($filter, "WHERE") >= 0) {
      $oparator = "AND";
    } else {
      $oparator = "WHERE";
    }

    $filter .= " $oparator `group_id` = '$group_id'";
  }
}

//Xử lý phân trang
$allUserNum = getRows("SELECT id FROM `users` $filter");
// echo $allUserNum;
// 1. Xác định số lượng bản ghi 1 trang
$perPage = _PER_PAGE;

// 2. Tính số trang
$maxPage = ceil($allUserNum / $perPage);

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
  $queryString = str_replace('module=users', '', $queryString);
  $queryString = str_replace("&page=$page", '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = "&$queryString";
}

//Lấy danh sách người dùng
$listUser = getRaw("SELECT `users`.*, `groups`.name FROM `users` INNER JOIN `groups` ON `users`.group_id=`groups`.id $filter ORDER BY `create_at` LIMIT $offset, $perPage");

// Lấy danh sách nhóm người dùng
$listGroups = getRaw("SELECT `id`, `name` FROM `groups`");

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
        <a href="<?php echo getLinkAdmin('users', 'add') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
        <!-- Form search -->
        <form method="GET">
          <input type="hidden" name="module" value="users">
          <div class="input-group input-group-sm">
            <!-- Nhóm -->
            <select name="group_id" id="" class="form-control">
              <option value="0">--Chọn nhóm người dùng--</option>
              <?php
              if (!empty($listGroups)) {
                foreach ($listGroups as $group) {
              ?>
                  <option <?php echo !empty($group_id) && !empty($group['id']) && $group['id'] == $group_id ? "selected" : false ?> value="<?php echo $group['id'] ?>"><?php echo $group['name'] ?></option>
              <?php
                }
              }
              ?>
            </select>
            <!-- Trạng thái -->
            <select name="status" id="" class="form-control">
              <option value="0">--Chọn trạng thái--</option>
              <option value="1" <?php echo (!empty($status) && $status == 1) ? "Selected" : false ?>>Kích hoạt</option>
              <option value="2" <?php echo (!empty($status) && $status == 2) ? "Selected" : false ?>>Chưa kích hoạt</option>
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
      </div>
    </div>
    <div class="card-body">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th width="5%" scope="col">#</th>
            <th scope="col">Tên người dùng</th>
            <th scope="col">Email</th>
            <th scope="col">Nhóm</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Thời gian</th>
            <th width="15%" rowspan="2" scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($listUser)) :
            $temp = $offset;
            foreach ($listUser as $key => $value) : ?>
              <tr>
                <th scope="row"><?php echo ++$temp ?></th>
                <td><a href="<?php echo getLinkAdmin('users', 'edit', ['id' => $value['id']]) ?>"><?php echo $value['fullname'] ?></a></td>
                <td><?php echo $value['email'] ?></td>
                <td><span class="badge badge-primary"><?php echo getName($value['group_id'], 'groups', 'name') ?></span></td>
                <td><?php echo $value['status'] == 1 ? "<button class='btn btn-success btn-sm text-center'>Kích hoạt</button>" : "<button class='btn btn-danger btn-sm'>Chưa kích hoạt</button>" ?></td>

                <td><?php echo $value['create_at'] ?></td>

                <td colspan="2" class="text-center">
                  <a href="<?php echo getLinkAdmin('users', 'edit', ['id' => $value['id']]) ?>" class="btn btn-sm btn-warning mr-2">
                    <i class="fa fa-edit"></i> Sửa</a>
                  <?php if ($value['id'] != $userID) : ?>
                    <a onclick="return confirm('Bạn chắc chắn xoá dữ liệu này!')" href="<?php echo getLinkAdmin('users', 'delete', ['id' => $value['id']]) ?>" class="btn btn-sm btn-danger">
                      <i class="fa fa-trash"></i> Xoá</a>
                  <?php endif ?>
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
      <?php echo getPaging($page, 'users', $queryString, $maxPage) ?>
    </div>
  </div>
  <!-- Pagination -->
  <!-- <nav aria-label="Page navigation example">
    <ul class="pagination">
      <?php
      if ($page > 1) :
        $prevPage = $page - 1;
      ?>
        <li class="page-item"><a class="page-link" href="<?php echo _WEB_HOST_ROOT . "?module=users$queryString" . "&page=$prevPage" ?>">Trước</a></li>
      <?php endif; ?>

      <?php
      $begin = $page - 4;
      if ($begin < 1) {
        $begin = 1;
      }
      $end = $page + 4;
      if ($end > $maxPage) {
        $end = $maxPage;
      }
      for ($index = $begin; $index <= $end; $index++) {
      ?>
        <li class="page-item <?php echo $index == $page ? 'active' : ''; ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT . "?module=users$queryString" . "&page=$index" ?>"><?php echo $index ?></a></li>
      <?php
      }
      ?>

      <?php
      if ($page < $maxPage) :
        $nextPage = $page + 1;
        if ($page > $maxPage) {
          $page = 1;
        }
      ?>
        <li class="page-item"><a class="page-link" href="<?php echo _WEB_HOST_ROOT . "?module=users$queryString" . "&page=$nextPage" ?>">Sau</a></li>
      <?php endif; ?>
    </ul>
  </nav> -->
  <!-- End Pagination -->
</div>
<?php
layout('footer', 'admin', $data);
?>