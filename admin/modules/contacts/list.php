<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Danh sách liên hệ'
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
// Lấy danh sách phongg ban
$listContactType = getRaw("SELECT `id`, `name` FROM `contact_type` ORDER BY `name`");
// echo "<pre>";
// print_r($listContactType);
// ---------- end ------------------
// Xử lý lọc, tìm kiếm
$filter = "";
if (isGET()) {
  $body = getBody();

  if (!empty($body['status'])) {
    $status = $body['status'];

    //Kiểm tra chuổi đã có WHERE hay chưa
    if (!empty($filter) && strpos($filter, "WHERE") >= 0) {
      $oparator = "AND";
    } else {
      $oparator = "WHERE";
    }

    $filter .= "WHERE `contacts`.status = '$status'";
  }


  // Xử lý lọc theo danh mục
  if (!empty($body['type_id'])) {
    $type_id = $body['type_id'];
    // die($type_id);
    //Kiểm tra chuổi đã có WHERE hay chưa
    if (!empty($filter) && strpos($filter, "WHERE") >= 0) {
      $oparator = "AND";
    } else {
      $oparator = "WHERE";
    }

    $filter .= " $oparator `contacts`.type_id = '$type_id'";
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

    $filter .= " $oparator `contacts`.message LIKE '%$keyword%' OR `contacts`.fullname LIKE '%$keyword%' OR `contacts`.email LIKE '%$keyword%'";
  }
}

// echo $filter;
//Xử lý phân trang
$allPortlios = getRows("SELECT id FROM contacts $filter");
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
  $queryString = str_replace('module=contacts', '', $queryString);
  $queryString = str_replace("&page=$page", '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = '&' . $queryString;
}

//Lấy danh sách bài viết
$listContacts = getRaw("SELECT `contacts`.*, `contact_type`.id as type_id, `contact_type`.name
FROM `contacts` INNER JOIN `contact_type` ON `contacts`.type_id = `contact_type`.id $filter ORDER BY `contacts`.create_at LIMIT $offset, $perPage");

// echo "<pre>";
// print_r($listContacts);
// echo "</pre>";

// echo $queryString;
$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');

//Check từng chức năng
$checkRoleEdit = checkCurrentPermission('edit');
$checkRoleDelete = checkCurrentPermission('delete');
?>

<div class="container-fluid">
  <?php
  getMsg($msg, $msg_style);
  ?>
  <div class="card ">
    <div class="card-header ">
      <div class="d-flex algin-items-center justify-content-between">
        <h6 class="font-weight-bold p-0 m-0">Liên hệ đã gửi đến</h6>
        <!-- Form search -->
        <form method="GET">
          <input type="hidden" name="module" value="contacts">
          <div class="input-group input-group-sm">
            <select name="type_id" id="" class="form-control">
              <option value="0">--Chọn phòng ban--</option>
              <?php
              if (!empty($listContactType)) {
                foreach ($listContactType as $item) {
              ?>
                  <option <?php echo !empty($type_id) && !empty($item['id']) && $item['id'] == $type_id ? "selected" : false ?> value="<?php echo $item['id'] ?>"><?php echo $item['name'];  ?></option>
              <?php
                }
              }
              ?>
            </select>
            <!-- Trạng thái -->
            <select name="status" id="" class="form-control">
              <option value="">--Chọn trạng thái--</option>
              <option value="0" <?php echo (!empty($status) && $status == 0) ? "Selected" : false ?>>Chưa xử lý</option>
              <option value="1" <?php echo (!empty($status) && $status == 1) ? "Selected" : false ?>>Đang xử lý</option>
              <option value="2" <?php echo (!empty($status) && $status == 2) ? "Selected" : false ?>>Đã xử lý</option>
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
            <th width="24%" scope="col">Thông tin</th>
            <th scope="col">Nội dung</th>
            <th scope="col">Ghi chú</th>
            <th scope="col">Trạng thái</th>
            <th width="10%" scope="col">Thời gian</th>
            <th width="20%" rowspan="2" scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($listContacts)) :
            $temp = $offset;
            foreach ($listContacts as $keyword => $value) : ?>
              <tr>
                <th class="align-middle" scope="row"><?php echo ++$temp ?></th>
                <td class="align-middle">
                  <a href="<?php echo getLinkAdmin('contacts', 'edit', ['id' => $value['id']]) ?>">Họ tên: <?php echo $value['fullname'] ?></a>
                  <p class="p-0 m-0"><strong>Email:</strong> <?php echo $value['email'] ?></p>
                  <p class="p-0 m-0"><strong>Phòng ban:</strong> <?php echo $value['name'] ?></p>
                </td>
                <td class="align-middle"><?php echo $value['message'] ?></td>
                <td class="align-middle"><a href="?module=contacts&type_id=<?php echo $value['type_id'] ?>"><?php echo $value['note'] ?></a></td>
                <td class="align-middle">
                  <?php
                  if ($value['status'] == 0) {
                    echo "<span class='badge badge-pill badge-warning'>Chưa xử lý </span>";
                  } elseif ($value['status'] == 1) {
                    echo "<span class='badge badge-pill badge-danger'>Đang xử lý</span>";
                  } else {
                    echo "<span class='badge badge-pill badge-success'>Đã xử lý</span>";
                  }
                  ?>
                </td>
                <td class="align-middle"><?php echo $value['create_at'] ?></td>
                <td colspan="2" class="text-center align-middle">
                  <?php if ($checkRoleEdit) : ?>
                    <a href="<?php echo getLinkAdmin('contacts', 'edit', ['id' => $value['id']]) ?>" class="btn btn-sm btn-warning mr-2">
                      <i class="fa fa-edit"></i> Sửa</a>
                  <?php endif; ?>
                  <?php if ($checkRoleDelete) : ?>
                    <a onclick="return confirm('Bạn chắc chắn xoá dữ liệu này!')" href="<?php echo getLinkAdmin('contacts', 'delete', ['id' => $value['id']]) ?>" class="btn btn-sm btn-danger">
                      <i class="fa fa-trash"></i> Xoá</a>
                  <?php endif; ?>
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
      <?php echo getPaging($page, 'contacts', $queryString, $maxPage) ?>
    </div>
  </div>
</div>

<?php
layout('footer', 'admin', $data);
?>