<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Danh sách đăng ký'
];
layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id'];

// Xử lý lọc, tìm kiếm
$filter = "";
if (isGET()) {
  $body = getBody();

  if (!empty($body['status'])) {
    $status = $body['status'];
    if ($status == 1) {
      $status = 0;
    }
    //Kiểm tra chuổi đã có WHERE hay chưa
    if (!empty($filter) && strpos($filter, "WHERE") >= 0) {
      $oparator = "AND";
    } else {
      $oparator = "WHERE";
    }

    $filter .= "WHERE `status` = '$status'";
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

    $filter .= " $oparator `fullname` LIKE '%$keyword%' OR `email` LIKE '%$keyword%'";
  }
}

//Xử lý phân trang
$allServiceNum = getRows("SELECT id FROM `subscibe` $filter");
// echo $allServiceNum;
// 1. Xác định số lượng bản ghi 1 trang
$perPage = _PER_PAGE;

// 2. Tính số trang
$maxPage = ceil($allServiceNum / $perPage);

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
  $queryString = str_replace('module=services', '', $queryString);
  $queryString = str_replace("&page=$page", '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = '&' . $queryString;
}

//Lấy danh sách đăng ký
$subscribes = getRaw("SELECT * FROM `subscibe` $filter ORDER BY `create_at` LIMIT $offset, $perPage");

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
        <div></div>
        <!-- Form search -->
        <form method="GET">
          <input type="hidden" name="module" value="subscribes">
          <div class="input-group input-group-sm">
            <!-- Trạng thái -->
            <select name="status" id="" class="form-control">
              <option value="0">--Chọn trạng thái--</option>
              <option value="1" <?php echo (!empty($status) && $status == 1) ? "Selected" : false ?>>Chưa xử lý</option>
              <option value="2" <?php echo (!empty($status) && $status == 2) ? "Selected" : false ?>>Đang xử lý</option>
              <option value="3" <?php echo (!empty($status) && $status == 3) ? "Selected" : false ?>>Đã xử lý</option>
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
            <th scope="col">Họ và tên</th>
            <th scope="col">Email</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Thời gian</th>
            <th width="15%" rowspan="2" scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($subscribes)) :
            $temp = $offset;
            foreach ($subscribes as $item) : ?>
              <tr>
                <th class="align-middle" scope="row"><?php echo ++$temp ?></th>
                <td class="align-middle"><?php echo $item['fullname'] ?></td>
                <td class="align-middle"><?php echo $item['email'] ?></td>
                <td class="align-middle"><?php if ($item['status'] == 0) {
                                            echo "<span class='badge badge-danger'>Chưa xử lý</span>";
                                          } elseif ($item['status'] == 1) {
                                            echo "<span class='badge badge-warning'>Đang xử lý</span>";
                                          } else {
                                            echo "<span class='badge badge-success'>Đã xử lý</span>";
                                          } ?></td>
                <td class="align-middle"><?php echo $item['create_at'] ?></td>
                <td colspan="3" class="text-center align-middle">
                  <a href="<?php echo getLinkAdmin('subscribes', 'edit', ['id' => $item['id']]) ?>" class="btn btn-sm btn-warning mr-2">
                    <i class="fa fa-edit"></i> Sửa</a>
                  <a onclick="return confirm('Bạn chắc chắn xoá dữ liệu này!')" href="<?php echo getLinkAdmin('subscribes', 'delete', ['id' => $item['id']]) ?>" class="btn btn-sm btn-danger">
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
      <?php echo getPaging($page, 'services', $queryString, $maxPage) ?>
    </div>
  </div>
</div>

<?php
layout('footer', 'admin', $data);
?>