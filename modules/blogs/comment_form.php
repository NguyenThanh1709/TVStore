<div class="col-12 wp-comment-form">
  <div class="comments-form">

    <h2 class="title">Bình luận bài viết</h2>
    <?php
    if (!empty($userDetail)) {
      echo "Trả lời với tư cách Quản trị viên: " . '<strong class="nameReply">' . $userDetail['fullname'] . '</strong> -' . '- <a href="' . _WEB_HOST_ROOT_ADMIN . '?module=auth&action=logout">Thoát</a>';
    }
    ?>
    <!-- Contact Form -->

    <form class="form" method="post" id="comments-form" action="">
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <input type="text" name="name" data-id="<?php echo !empty($userID) ? $userID : false;  ?>" value="<?php echo !empty($userDetail['fullname']) ? $userDetail['fullname'] : false;  ?>" placeholder="Nhập họ và tên của bạn..." required="required">
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <input type="email" name="email" value="<?php echo !empty($userDetail['email']) ? $userDetail['email'] : false;  ?>" placeholder="Nhập email của bạn..." required="required">
          </div>
        </div>
        <div class="col-12">
          <div class="form-group">
            <textarea name="content" rows="5" placeholder="Nhập bình luận của bạn vào đây..."></textarea>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group button">
            <button type="submit" id="btn-comment" class="btn primary">
              <span class="" id="loading" aria-hidden="true"></span>
              Gửi bình luận
            </button>
          </div>
        </div>
      </div>
    </form>
    <!--/ End Contact Form -->
  </div>
</div>