<?php
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

//Check login
if (isLogin()) {
  $userID = isLogin()['user_id']; //lấy id user đang login
  $userDetail = userDetail($userID);
}

if (!defined('_INCODE')) die('Access Deined...');

if (!empty(getBody('get')['slug'])) {
  $slug = getBody('get')['slug'];

  setView('slug');

  if (!empty($slug)) {
    // Truy vấn lại dữ liệu blog sau khi đã cập nhật view_count
    $infoBlog = firstRaw("SELECT `blog`.*, `blog_categories`.name as portfolio_categories_name, 
   `blog_categories`.slug as slug_cat, `groups`.name as groupName,
   `users`.fullname, `users`.id as user_id, `users`.about_content, `users`.contact_facebook, `users`.contact_x, `users`.contact_linkedin, `users`.contact_pinterest,
    (SELECT COUNT(id) FROM `blog` WHERE `users`.id=`blog`.user_id) as count_blog
    FROM `blog` INNER JOIN `blog_categories` ON `blog`.category_id = `blog_categories`.id 
    INNER JOIN `users` ON `users`.id = `blog`.user_id
    INNER JOIN `groups` ON `users`.group_id = `groups`.id
    WHERE `blog`.`slug`='$slug'");
    // Blog id 
    $blog_id = $infoBlog['id'];
    // user_id
    $user_id = $infoBlog['user_id'];
  }
}

// Lấy tất cả danh sách bài viết xử lý chức năng bài trước bài sau của module bài viết
$allBlogs = getRaw("SELECT * FROM `blog` ORDER BY `create_at`");

$currentKey = array_search($infoBlog['id'], array_column($allBlogs, 'id'));
// end 

$parentBreadcrumds = "<li><a href='" . _WEB_HOST_ROOT . "/bai-viet'><i class='fa fa-clone'></i>" . getOptions('blogs_title') . "</a></li>";
$parentBreadcrumds .= "<li><a href='" . getLinkModule('blog_categories', $infoBlog['slug_cat']) . "'><i class='fa fa-clone'></i>" . $infoBlog['portfolio_categories_name'] . "</a></li>";

$data = [
  'titlePage' => $infoBlog['title'],
  'namePage' => getOptions('blogs_title'),
  'itemParent' => $parentBreadcrumds,
];

layout('header', 'client', $data);

layout('breadcrumbs', 'client', $data);


// Lấy danh sách comment
$commentList = getRaw("SELECT * FROM `comment` WHERE `blog_id` = $infoBlog[id] AND `status` = 1  ORDER BY `create_at` DESC");

?>
<!-- Blogs Area -->
<section class="blogs-main archives single section">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 offset-lg-1 col-12">
        <div class="row">
          <div class="col-12">
            <!-- Single Blog -->
            <div class="single-blog">
              <div class="blog-head">
                <?php if (!empty($infoBlog['thumbnail'])) : ?>
                  <img src="<?php echo $infoBlog['thumbnail'] ?>" alt="#">
                <?php endif; ?>
              </div>
              <div class="blog-inner">
                <div class="blog-top">
                  <div class="meta">
                    <span><i class="fa fa-bolt"></i><a href="?module=blogs&action=category&slug=<?php echo $infoBlog['slug_cat'] ?>"><?php echo !empty($infoBlog['portfolio_categories_name']) ? $infoBlog['portfolio_categories_name'] : false;  ?></a></span>
                    <span><i class="fa fa-calendar"></i><?php echo !empty($infoBlog['create_at']) ? formatDate($infoBlog['create_at'], 'dmy') : false;  ?></span>
                    <span><i class="fa fa-eye"></i><?php echo $infoBlog['view_count']; ?></span>
                  </div>
                  <ul class="social-share">
                    <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo _WEB_HOST_ROOT . '?module=blogs&action=detail&slug=' . $infoBlog['slug'];  ?>"><i class="fa fa-facebook"></i></a></li>
                    <li><a target="_blank" href="http://twitter.com/share?text=&url=http://url=<?php echo _WEB_HOST_ROOT . '?module=blogs&action=detail&slug=' . $infoBlog['slug'];  ?>"><i class="fa fa-x"></i>X</a></li>
                    <li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo _WEB_HOST_ROOT . '?module=blogs&action=detail&slug=' . $infoBlog['slug'];  ?>"><i class="fa fa-linkedin"></i></a></li>
                    <li><a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo _WEB_HOST_ROOT . '?module=blogs&action=detail&slug=' . $infoBlog['slug'];  ?>"><i class="fa fa-pinterest"></i></a></li>
                  </ul>
                </div>
                <?php
                echo html_entity_decode($infoBlog['content']);
                ?>
                <div class="bottom-area">
                  <!-- Next Prev -->
                  <ul class="arrow">
                    <?php if ($currentKey > 0) : ?>
                      <li class="prev"><a href="<?php echo getLinkModule('blogs', $allBlogs[$currentKey - 1]['slug'])  ?>"><i class="fa fa-angle-double-left"></i>Bài trước</a></li>
                    <?php endif; ?>
                    <?php if ($currentKey < count($allBlogs) - 1) : ?>
                      <li class="next"><a href="<?php echo getLinkModule('blogs', $allBlogs[$currentKey + 1]['slug']) ?>">Bài sau<i class="fa fa-angle-double-right"></i></a></li>
                    <?php endif; ?>
                  </ul>
                  <!--/ End Next Prev -->
                </div>
              </div>
            </div>
            <!-- End Single Blog -->
          </div>
          <div class="col-12">
            <div class="author-details">
              <div class="author-left">
                <img src="<?php echo _WEB_HOST_TEMPLATE ?>/images/avt-123.jpg" alt="#">
                <h4><?php echo $infoBlog['fullname'] ?><span><?php echo $infoBlog['groupName'] ?></span></h4>
                <p><a href="#"><i class="fa fa-pencil"></i><?php echo $infoBlog['count_blog'] ?> bài viết</a></p>
              </div>
              <div class="author-content">
                <p><?php echo $infoBlog['about_content'] ?></p>
                <ul class="social-share">
                  <?php if (!empty($infoBlog['contact_facebook'])) : ?>
                    <li><a target="_blank" href="<?php echo $infoBlog['contact_facebook'] ?>"><i class="fa fa-facebook"></i></a></li>
                  <?php endif; ?>
                  <?php if (!empty($infoBlog['contact_x'])) : ?>
                    <li><a target="_blank" href="<?php echo $infoBlog['contact_x'] ?>"><i class="fa "></i>X</a></li>
                  <?php endif; ?>
                  <?php if (!empty($infoBlog['contact_linkedin'])) : ?>
                    <li><a target="_blank" href="<?php echo $infoBlog['contact_linkedin'] ?>"><i class="fa fa-linkedin"></i></a></li>
                  <?php endif; ?>
                  <?php if (!empty($infoBlog['contact_pinterest'])) : ?>
                    <li><a target="_blank" href="<?php echo $infoBlog['contact_pinterest'] ?>"><i class="fa fa-pinterest"></i></a></li>
                  <?php endif; ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="blog-comments">
              <h2 class="title"><?php echo count($commentList) ?> Bình luận!</h2>
              <div class="comments-body">
                <?php
                if (!empty($commentList)) :
                  foreach ($commentList as $item) :
                    $commentData[$item['id']] = $item;
                    if ($item['parent_id'] == 0) : ?>
                      <!-- Single Comments -->
                      <div class="single-comments">
                        <div class="main">
                          <div class="head">
                            <img src="<?php echo _WEB_HOST_TEMPLATE ?>/images/avt-123.jpg" alt="#">
                          </div>
                          <div class="body body-comment">
                            <h5 class="text-15 name-<?php echo $item['id'] ?>">
                              <?php echo !empty($item) ? $item['name'] : false; ?>
                              <?php echo !empty($item['user_id']) ? userDetail($item['user_id'])['fullname'] . " <span class='badge badge-warning'>(Quản trị viên)</span>"  : false; ?>
                            </h5>
                            <div class="comment-info">
                              <p>
                                <span><?php echo !empty($item) ? formatDate($item['create_at'], 'dmy') : false; ?><i class="fa fa-clock-o"></i> vào lúc <?php echo !empty($item) ? formatDate($item['create_at'], '', 'his') : false; ?></span>
                                <a href="#" class="reply" data-id="<?php echo $item['id'] ?>"><i class="fa fa-comment-o"></i>Trả lời</a>
                              </p>
                            </div>
                            <p><?php echo !empty($item['content']) ? $item['content'] : false; ?></p>
                            <i class="fa fa-ellipsis-h custom-icon"></i>
                            <ul class="list-menu">
                              <li class="reply" data-id="<?php echo $item['id'] ?>"><a href=""><i class="fa fa-comment-o"></i> Trả lời</a></li>
                              <li><a href=""><i class="fa fa-trash"></i> Xoá</a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="reply-comment-form-<?php echo $item['id'] ?>" data-id="<?php echo $item['id'] ?>"></div>
                        <?php getCommentList($commentList, $item['id']); ?>
                      </div>
                <?php
                    endif;
                  endforeach;
                endif;
                ?>
              </div>
            </div>
          </div>

          <!-- Bình luận -->
          <input type="hidden" name="parent-id" value="0">
          <input type="hidden" name="blog_id" value="<?php echo $blog_id ?>">
          <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
          <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
          <input type="hidden" name="fullname" value="<?php echo !empty($userDetail['fullname']) ? $userDetail['fullname'] : false; ?>">
          <input type="hidden" name="email" value="<?php echo !empty($userDetail['email']) ? $userDetail['email'] : false;; ?>">
          <?php require_once 'comment_form.php'; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Blogs Area -->
<?php
layout('footer', 'client', $data);
?>