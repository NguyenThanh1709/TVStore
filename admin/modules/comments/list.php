<?php
//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}

if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Danh sách bình luận'
];
layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id'];

// ---- Dữ liệu hiển thị ở SELECT OPTION -----///
// Lấy danh sách Users
$listUsers = getRaw("SELECT id, fullname, email FROM `users` WHERE `status` = 1 ORDER BY `fullname`");

// ---------- end ------------------

// Xử lý lọc, tìm kiếm
$filter = "";
if (isGET()) {
  $body = getBody();

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

    $filter .= "WHERE `comment`.status = '$statusSql'";
  }


  // Xử lý lọc theo email
  if (!empty($body['email'])) {
    $email = $body['email'];
    // die($category_id);
    //Kiểm tra chuổi đã có WHERE hay chưa
    if (!empty($filter) && strpos($filter, "WHERE") >= 0) {
      $oparator = "AND";
    } else {
      $oparator = "WHERE";
    }

    $filter .= " $oparator `comment`.email = '$email'";
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

    $filter .= " $oparator `comment`.content LIKE '%$keyword%'";
  }
}

//Xử lý phân trang
$allPortlios = getRows("SELECT id FROM comment $filter");
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
  $queryString = str_replace('module=comments', '', $queryString);
  $queryString = str_replace("&page=$page", '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = '&' . $queryString;
}

//Lấy danh sách bài viết
$listComment = getRaw("SELECT `comment`.*, `blog`.title as blog_title, `blog`.slug as blog_slug
FROM `comment` INNER JOIN `blog` ON `blog`.id = `comment`.blog_id $filter ORDER BY `create_at` DESC LIMIT $offset, $perPage");

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
        <a></a>
        <!-- Form search -->
        <form method="GET">
          <input type="hidden" name="module" value="comments">
          <div class="input-group input-group-sm">
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
            <!-- Trạng thái -->
            <select name="status" id="" class="form-control">
              <option value="0">--Chọn trạng thái--</option>
              <option value="1" <?php echo (!empty($status) && $status == 1) ? "Selected" : false ?>>Đã duyệt</option>
              <option value="2" <?php echo (!empty($status) && $status == 2) ? "Selected" : false ?>>Chờ duyệt</option>
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
            <th scope="col">Thông tin</th>
            <th scope="col">Nội dung</th>
            <th width="15%" scope="col">Trạng thái</th>
            <th scope="col">Bài viết</th>
            <th width="10%" scope="col">Thời gian</th>
            <th width="20%" rowspan="2" scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($listComment)) :
            $temp = $offset;
            foreach ($listComment as $item) :
              if (!empty($item['user_id'])) {
                $item['name'] = userDetail($item['user_id'])['fullname'];
                $item['email'] = userDetail($item['user_id'])['email'];
              }
          ?>
              <tr>
                <th class="align-middle" scope="row"><?php echo ++$temp ?></th>
                <td class="align-middle">
                  <span><strong>- Họ tên: </strong><?php echo !empty($item['name']) ? $item['name'] : false; ?></span><br>
                  <span><strong>- Email: </strong><?php echo !empty($item['email']) ? $item['email'] : false; ?></span><br>
                  <span>
                    <?php
                    $commentData = getComment($item['id']);
                    if (!empty($commentData['name'])) {
                    ?>
                      <?php echo "<strong>- Trả lời: </strong>" . "<span class='badge badge-primary'>" . $commentData['name'] . "</span>" ?>
                    <?php
                    }
                    ?>
                  </span>
                </td>
                <td class="align-middle">
                  <a href="<?php echo getLinkAdmin('comments', 'edit', ['id' => $item['id']]) ?>"><?php echo $item['content'] ?></a>
                </td>
                <td class="align-middle wp-status text-center">
                  <span class="">
                    <?php
                    if ($item['status'] == 0) {
                      echo "<span class='btn btn-sm btn-warning btn-status' data-id='$item[id]'><i class='fa fa-eye'></i> Hiển thị</span>";
                    } else {
                      echo "<span class='btn btn-sm btn-success'><i class='fa fa-check'></i> Đã duyệt</span> <span class='btn btn-sm btn-danger btn-hide' data-id='$item[id]'><i class='fa fa-eye-slash'></i> Ẩn</span>";
                    }
                    ?>
                    <span class="noti-success noti-success-<?php echo $item['id'] ?>"><i class="fas fa-check"></i> Đã duyệt</span>
                    <span class="noti-hide noti-hide-<?php echo $item['id'] ?>"><i class="fa fa-times"></i> Tạm ẩn</span>
                  </span>

                </td>
                <td class="align-middle"><a target="_blank" href="<?php echo getLinkModule('blogs', $item['blog_slug']) ?>"><?php echo getLimitText($item['blog_title'], 5) ?></a></td>
                <td class="align-middle"><?php echo $item['create_at'] ?></td>
                <td colspan="3" class="text-center align-middle">
                  <?php if ($checkRoleEdit) : ?>
                    <a href="<?php echo getLinkAdmin('comments', 'edit', ['id' => $item['id']]) ?>" class="btn btn-sm btn-warning mr-2">
                      <i class="fa fa-edit"></i> Sửa</a>
                  <?php endif; ?>
                  <?php if ($checkRoleDelete) : ?>
                    <a onclick="return confirm('Bạn chắc chắn xoá dữ liệu này!')" href="<?php echo getLinkAdmin('comments', 'delete', ['id' => $item['id']]) ?>" class="btn btn-sm btn-danger">
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
      <?php echo getPaging($page, 'comments', $queryString, $maxPage) ?>
    </div>
  </div>
</div>

<?php
layout('footer', 'admin', $data);
?>