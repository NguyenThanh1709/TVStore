<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);

$data = [
  'titlePage' => 'Quản lý người dùng'
];

layout('header', $data);

// Xử lý lọc, tìm kiếm
$filter = "";
if (isGET()) {
  $dataForm = getBody();
  // echo "<pre>";
  // print_r($dataForm);
  // echo "</pre>";
  if (!empty($dataForm['status'])) {
    $status = $dataForm['status'];
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
  if (!empty($dataForm['search'])) {
    $keyword = $dataForm['search'];
    //Kiểm tra chuổi đã có WHERE hay chưa
    if (!empty($filter) && strpos($filter, "WHERE") >= 0) {
      $oparator = "AND";
    } else {
      $oparator = "WHERE";
    }

    $filter .= " $oparator `fullname` LIKE '%$keyword%'";
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

//Lấy danh sách người dùng
$listUser = getRaw("SELECT * FROM `users` $filter ORDER BY `createAt` LIMIT $offset, $perPage");

//Xử lý tìm kiếm phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
  $queryString = $_SERVER['QUERY_STRING'];
  $queryString = str_replace('module=users', '', $queryString);
  $queryString = str_replace("&page=$page", '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = "&$queryString";
}

// echo $queryString;
$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');
?>
<div class="container-fluid">
  <hr>
  <h3>Quản lý người dùng</h3>
  <a href="?module=users&action=add" class="btn btn-success mb-2">Thêm người dùng mới <i class="fas fa-plus"></i></a>
  <form action="" method="get" class="mb-3">
    <div class="row">
      <div class="col-3">
        <select name="status" id="" class="form-control">
          <option value="0">--Chọn trạng thái--</option>
          <option value="1" <?php echo (!empty($status) && $status == 1) ? "Selected" : false ?>>Kích hoạt</option>
          <option value="2" <?php echo (!empty($status) && $status == 2) ? "Selected" : false ?>>Chưa kích hoạt</option>
        </select>
      </div>
      <div class="col-8">
        <input type="search" placeholder="Nhập từ khoá tìm kiếm..." value="<?php echo (!empty($keyword) ? $keyword : false) ?>" name="search" class="form-control">
      </div>
      <div class="col-1">
        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
      </div>
      <input type="hidden" name="module" value="users">
    </div>
  </form>
  <hr />
  <?php
  getMsg($msg, $msg_style);
  ?>
  <table class="table table-bordered">
    <thead>
      <th class="" style="width: 5%;">#</th>
      <th class="">Họ tên</th>
      <th class="">Email</th>
      <th class="">Số điện thoại</th>
      <th class="">Trạng thái</th>
      <th class="" style="width: 10%;">Tác vụ</th>
    </thead>
    <tbody>
      <?php
      if (!empty($listUser)) :
        $temp = $offset;
        foreach ($listUser as $item) : $temp++ ?>
          <tr>
            <td><strong><?php echo $temp ?></strong></td>
            <td><?php echo $item['fullname'] ?></td>
            <td><?php echo $item['email'] ?></td>
            <td><?php echo $item['phone'] ?></td>
            <td>
              <?php echo $item['status'] == 1 ?
                "<span class='badge badge-pill badge-success'>Kích hoạt</span>" :
                "<span class='badge badge-pill badge-warning'>Chưa kích hoạt</span>" ?>
            </td>
            <td rowspan="1">
              <a href="<?php echo _WEB_HOST_ROOT . '?module=users&action=edit&id=' . $item['id']; ?>" class="btn btn-warning">Sửa</a>
              <a onclick="return confirm('Bạn chắc chắn xoá dữ liệu này?')" href="<?php echo _WEB_HOST_ROOT . '?module=users&action=delete&id=' . $item['id']; ?>" class="btn btn-danger">Xoá</a>
            </td>
          </tr>
        <?php
        endforeach;
      else : ?>
        <tr>
          <td colspan="7">
            <p class="alert alert-danger w-100 text-center">Không có dữ liệu nào!</p>
          </td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
  <!-- Pagination -->
  <nav aria-label="Page navigation example">
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
  </nav>
  <!-- End Pagination -->
</div>
<?php
layout('footer');
?>