<?php
if (!defined('_INCODE')) die('Access Deined...');

// Lấy thông tin danh mục
$condition = '';
if (!empty(getBody()['slug'])) {
  $slug = getBody()['slug'];

  $category = firstRaw("SELECT * FROM `blog_categories` WHERE `slug`='$slug'");
  if (!empty($category)) {
    // Thiết lập truy vấn nối vào $allBlogCat;
    $condition = "WHERE `blog`.`category_id` = '$category[id]'";
    // 
  }
}

$data = [
  'titlePage' => $category['name']
];
$data['itemParent'] = "<li><a href='" . _WEB_HOST_ROOT . "?module=blogs'><i class='fa fa-clone'></i>" . getOptions('blogs_title') . "</a></li>";

layout('header', 'client', $data);

layout('breadcrumbs', 'client', $data);

//Xử lý phân trang
$allBlogCat = getRows("SELECT id FROM blog $condition");

// die($allBlogCat);
// echo $allBlogCat;
// 1. Xác định số lượng bản ghi 1 trang
$perPage = _PER_PAGE;

// 2. Tính số trang
$maxPage = ceil($allBlogCat / $perPage);

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
  $queryString = str_replace('module=blogs', '', $queryString);
  $queryString = str_replace("&page=$page", '', $queryString);
  $queryString = trim($queryString, '&');
  $queryString = '&' . $queryString;
  // echo $queryString;
}

//Lấy danh sách bài viết
$listBlogs = getRaw("SELECT `blog`.*, `blog_categories`.name as portfolio_categories_name
FROM `blog` INNER JOIN `blog_categories` ON `blog`.category_id = `blog_categories`.id $condition ORDER BY `create_at` LIMIT $offset, $perPage");

?>
<!-- Blogs Area -->
<section class="blogs-main archives section">
  <div class="container">
    <div class="row">
      <!-- Kiểm tra biến $listBlog có dữ liệu hay không -->
      <?php if (!empty($listBlogs)) :
        // Duyệt phần tử trong mảng
        foreach ($listBlogs as $item) : ?>
          <div class="col-lg-4 col-md-6 col-12">
            <!-- Single Blog -->
            <div class="single-blog">
              <div class="blog-head">
                <img src="<?php echo !empty($item['thumbnail']) ? $item['thumbnail'] : false ?>" alt="Ảnh">
              </div>
              <div class="blog-bottom">
                <div class="blog-inner">
                  <h4><a href="?module=blogs&action=detail&slug=<?php echo $item['slug'] ?>"><?php echo !empty($item['title']) ? $item['title'] : false ?></a></h4>
                  <p class="three-lines"><?php echo !empty($item['dscription']) ? $item['dscription'] : false ?></p>
                  <div class="meta">
                    <span><i class="fa fa-bolt"></i><a href="#"><?php echo $item['portfolio_categories_name'] ?></a></span>
                    <span><i class="fa fa-calendar"></i><?php echo formatDate($item['create_at'], 'Y/m/d') ?></span>
                    <span><i class="fa fa-eye"></i><a href="#"><?php echo $item['view_count'] ?></a></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Single Blog -->
          </div>
      <?php
        endforeach;
      endif ?>
    </div>
    <!-- Phân trang -->
    <?php if (!empty($listBlogs)) : ?>
      <div class="row">
        <div class="col-12">
          <!-- Start Pagination -->
          <div class="pagination-main">
            <ul class="pagination">
              <?php if ($page > 1) : ?>
                <li class="prev"><a href="<?php echo _WEB_HOST_ROOT . '?module=blogs' . $queryString . '&page=' . $page - 1; ?>"><i class="fa fa-angle-double-left"></i></a></li>
              <?php endif; ?>
              <?php for ($index = 1; $index <= $maxPage; $index++) : ?>
                <li class="<?php echo $index == $page ? 'active' : false; ?>"><a href="<?php echo _WEB_HOST_ROOT . '?module=blogs' . $queryString . '&page=' . $index; ?>"><?php echo $index; ?></a></li>
              <?php endfor; ?>
              <?php if ($page < $maxPage) : ?>
                <li class="next"><a href="<?php echo _WEB_HOST_ROOT . '?module=blogs' . $queryString . '&page=' . $page + 1; ?>"><i class="fa fa-angle-double-right"></i></a></li>
              <?php endif ?>
            </ul>
          </div>
          <!--/ End Pagination -->
        </div>
      </div>
      <!-- end phân trang -->
    <?php endif; ?>
  </div>
</section>
<!--/ End Blogs Area -->
<?php
layout('footer', 'client', $data);
?>