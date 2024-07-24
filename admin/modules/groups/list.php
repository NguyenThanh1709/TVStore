<?php
$data = [
  'pageTitle' => 'Danh sách nhóm người dùng'
];
layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}

//Xử lý tìm kiếm
$filter = "";
if (isGET()) {
  $body = getBody();

  if (!empty($body['key'])) {
    $keyword = $body['key'];
    $filter .= " WHERE `name` LIKE '%$keyword%'"; //Chuổi tìm kiếm
  }
}

//Xử lý phân trang
$listGroups = getRows("SELECT id FROM `groups` $filter");
// 1. Xác định số lượng bản ghi 1 trang
$perPage = _PER_PAGE;

// 2. Tính số trang
$maxPage = ceil($listGroups / $perPage);

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

$listGroups = getRaw("SELECT * FROM `groups` $filter ORDER BY `create_at` DESC LIMIT $offset, $perPage");

//Xử lý tìm kiếm phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
  $queryString = $_SERVER['QUERY_STRING'];
  $queryString = str_replace('module=groups', '', $queryString);
  $queryString = str_replace("&page=$page", '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = '&' . $queryString;
}

$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');
?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <?php
    getMsg($msg, $msg_style);
    ?>
    <div class="card ">
      <div class="card-header ">
        <div class="d-flex algin-items-center justify-content-between">
          <a href="<?php echo getLinkAdmin('groups', 'add') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
          <!-- Form search -->
          <form method="GET">
            <input type="hidden" name="module" value="groups">
            <div class="input-group input-group-sm">
              <input class="form-control" type="search" name="key" value="<?php echo $keyword = !empty($keyword) ? $keyword : false ?>" placeholder="Nhập từ khoá tìm kiếm..." aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar btn-search" type="submit">
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
              <th scope="col">Tên nhóm</th>
              <th scope="col">Thời gian</th>
              <th width="15%" scope="col">Quyền</th>
              <th width="15%" rowspan="2" scope="col">Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($listGroups)) :
              $temp = $offset;
              foreach ($listGroups as $key => $value) : ?>
                <tr>
                  <th scope="row"><?php echo ++$temp ?></th>
                  <td><a href="<?php echo getLinkAdmin('groups', 'edit', ['id' => $value['id']]) ?>"><?php echo $value['name'] ?></a></td>
                  <td><?php echo $value['create_at'] ?></td>
                  <td class="text-center btn "><a href="<?php echo getLinkAdmin('groups', 'permission', ['id' => $value['id']]) ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-users"></i> Phân quyền</a></td>
                  <td colspan="2" class="text-center">
                    <a href="<?php echo getLinkAdmin('groups', 'edit', ['id' => $value['id']]) ?>" class="btn btn-sm btn-warning mr-2">
                      <i class="fa fa-edit"></i> Sửa</a>
                    <a onclick="return confirm('Bạn chắc chắn xoá dữ liệu này!')" href="<?php echo getLinkAdmin('groups', 'delete', ['id' => $value['id']]) ?>" class="btn btn-sm btn-danger">
                      <i class="fa fa-trash"></i> Xoá</a>
                  </td>
                </tr>
              <?php
              endforeach;
            else : ?>
              <tr>
                <th colspan="6" class="text-center font-weight-light">Không có dữ liệu !</th>
              </tr>
            <?php
            endif
            ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        <?php echo getPaging($page, 'groups', $queryString, $maxPage) ?>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<?php
layout('footer', 'admin', $data);
?>