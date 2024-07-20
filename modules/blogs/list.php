<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'titlePage' => getOptions('blogs_title')
];
layout('header', 'client', $data);

layout('breadcrumbs', 'client', $data);

//Xử lý phân trang
$allBlogs = getRows("SELECT id FROM blog");
// echo $allBlogs;
// 1. Xác định số lượng bản ghi 1 trang
$perPage = _PER_PAGE;

// 2. Tính số trang
$maxPage = ceil($allBlogs / $perPage);

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
}

//Lấy danh sách bài viết
$listBlogs = getRaw("SELECT `blog`.*, `blog_categories`.name as portfolio_categories_name, `blog_categories`.slug as portfolio_categories_slug
FROM `blog` INNER JOIN `blog_categories` ON `blog`.category_id = `blog_categories`.id ORDER BY `create_at` LIMIT $offset, $perPage");

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
                  <h4><a href="<?php echo getLinkModule('blogs', $item['slug']) ?>"><?php echo !empty($item['title']) ? $item['title'] : false ?></a></h4>
                  <p class="three-lines"><?php echo !empty($item['dscription']) ? $item['dscription'] : false ?></p>
                  <div class="meta">
                    <span><i class="fa fa-bolt"></i><a href="<?php echo getLinkModule('blog_categories', $item['portfolio_categories_slug']) ?>"><?php echo $item['portfolio_categories_name'] ?></a></span>
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
                <li class="prev"><a href="<?php echo _WEB_HOST_ROOT . '/bai-viet/trang-' . $page - 1; ?>"><i class="fa fa-angle-double-left"></i></a></li>
              <?php endif; ?>
              <?php for ($index = 1; $index <= $maxPage; $index++) : ?>
                <li class="<?php echo $index == $page ? 'active' : false; ?>"><a href="<?php echo _WEB_HOST_ROOT . '/bai-viet/trang-' . $index; ?>"><?php echo $index; ?></a></li>
              <?php endfor; ?>
              <?php if ($page < $maxPage) : ?>
                <li class="next"><a href="<?php echo _WEB_HOST_ROOT . '/bai-viet/trang-' . $page + 1; ?>"><i class="fa fa-angle-double-right"></i></a></li>
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