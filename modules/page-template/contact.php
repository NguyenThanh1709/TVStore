<?php
ob_start();
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'titlePage' => getOptions('contact_title')
];

$title_desc = getOptions('contact_desc');
$title_bg = getOptions('contact_title_bg');

layout('header', 'client', $data);

layout('breadcrumbs', 'client', $data);

// Mạng xã hội
$x = getOptions('general_x');
$facebook = getOptions('general_facebook');
$linkedin = getOptions('general_linkedin');
$behance = getOptions('general_behance');

// Danh sách contact_type
$listContactType = getRaw("SELECT * FROM `contact_type`");

//Xử lý gửi thông tin
if (isPost()) {

  $body = getBody();
  //Khởi tạo biến 
  $errors = array();
  // Validate name
  if (empty(trim($body['fullname']))) {
    $errors['fullname']['required'] = "Họ và tên không được để trống!";
  } else {
    if (strlen(trim($body['fullname'])) < 5) {
      $errors['fullname']['min'] = "Tên phải lớn hơn hoặc bằng 5 ký tự!";
    }
  }
  // --Validate email
  if (empty(trim($body['email']))) {
    $errors['email']['required'] = "Email bắt buộc nhập!";
  } else {
    if (isEmail(trim($body['email']))) {
      $errors['email']['isEmail'] = "Vui lòng nhập Email đúng định dạng!";
    }
  }

  //Validate content
  if (empty(trim($body['message']))) {
    $errors['message']['required'] = "Nội dung bắt buộc nhập!";
  }

  if (empty($errors)) {
    //Xử lý thêm vào database
    $dataInsert = array(
      'fullname' => trim(strip_tags($body['fullname'])),
      'email' => trim(strip_tags($body['email'])),
      'message' => trim(strip_tags($body['message'])),
      'type_id' => trim(strip_tags($body['type_id'])),
      'status' => 0
    );
    //insert 
    $insertStatus = insert('contacts', $dataInsert);
    //check insert
    if ($insertStatus) {
      setFlashData('msg', 'Thông tin của bạn đã được gửi, Vui lòng chờ Email trả lời từ chúng tôi!');
      setFlashData('msg_style', 'success');

      //Gửi email cho khách hàng
      $siteName = getOptions('general_sitename');
      $contactType = getContactType($dataInsert['type_id']);
      $subjectCustomer = "[" . $siteName . "]" . "Cảm ơn bạn đã liên hệ";
      $contentCustomer = "<p>Chào mừng <strong>$dataInsert[fullname]</strong></p>";
      $contentCustomer .= "<p>Cảm ơn bạn đã liên hệ với chúng tôi! Dưới đây là thông tin của bạn</p>";
      $contentCustomer .= "<p><strong>Họ và tên: </strong>$dataInsert[fullname]</p>
                           <p><strong>Email: </strong>$dataInsert[email]</p>
                           <p><strong>Nội dung: </strong>$dataInsert[message]</p>
                           <p><strong>Phòng ban: </strong>$contactType[name]</p>
                           <p><strong>Thời gian: </strong>" . date('Y-m-d H:i:s') . "</p>
                           <hr>
                           <p>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất! </p>
                           <p>Trân trọng</p>";
      sendMail($dataInsert['email'], $subjectCustomer, $contentCustomer);

      //Gửi email cho admin
      $emailAdmin = getOptions('general_email');
      $siteName = getOptions('general_sitename');
      $contactType = getContactType($dataInsert['type_id']);
      $subjectAdmin = "[" . $siteName . "]" . " $dataInsert[fullname]";
      $contentAdmin .= "<p>Thông tin khách hàng</p>";
      $contentAdmin .= "<p><strong>Họ và tên: </strong>$dataInsert[fullname]</p>
                           <p><strong>Email: </strong>$dataInsert[email]</p>
                           <p><strong>Nội dung: </strong>$dataInsert[message]</p>
                           <p><strong>Phòng ban: </strong>$contactType[name]</p>
                           <p><strong>Thời gian: </strong>" . date('Y-m-d H:i:s') . "</p>
                           <p>Thông tin được gửi tử " . _WEB_HOST_ROOT . "</p>";
      sendMail($emailAdmin, $subjectAdmin, $contentAdmin);
      sendMail($dataInsert['email'], $subjectAdmin, $contentAdmin);
    } else {
      setFlashData('msg', 'Hệ thống chúng tôi đang gặp sự cố. Vui lòng thử lại sau!');
      setFlashData('msg_style', 'danger');
    }
  } else {
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('error', $errors);
    setFlashData('old_data', $body);
  }
  redirect(_WEB_HOST_ROOT . '?module=page-template&action=contact');
}

$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');
$errors = getFlashData('error');
$olData = getFlashData('old_data');
ob_end_flush(); // Kết thúc bộ đệm đầu ra
?>
<section id="contact-us" class="contact-us section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <?php
          if (!empty($title_bg)) :
          ?>
            <span class="title-bg"><?php echo $title_bg ?></span>
          <?php
          endif;
          ?>
          <?php
          if (!empty($title_desc)) :
            echo html_entity_decode($title_desc);
          endif;
          ?>
        </div>
      </div>
    </div>
    <?php
    getMsg($msg, $msg_style);
    ?>
    <div class="row">
      <div class="col-12">
        <div class="contact-main">
          <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-8 col-12">
              <div class="form-main">
                <div class="text-content">
                  <h2>Gửi thông tin cho chúng tôi</h2>
                </div>
                <form class="form" method="POST">
                  <div class="row">
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <input type="text" name="fullname" value="<?php echo old('fullname', $olData) ?>" placeholder="Họ và tên của bạn..." required="required">
                        <?php echo form_error('fullname', $errors) ?>
                      </div>
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <input type="email" name="email" value="<?php echo old('email', $olData) ?>" placeholder="Email của bạn..." required="required">
                        <?php echo form_error('email', $errors) ?>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <select name="type_id">
                          <?php
                          if (!empty(!empty($listContactType))) :
                            foreach ($listContactType as $item) : ?>
                              <option class="option" value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
                          <?php
                            endforeach;
                          endif; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-12 col-12">
                      <div class="form-group">
                        <textarea name="message" rows="6" placeholder="Nhập nội dung"><?php echo old('message', $olData) ?></textarea>
                        <?php echo form_error('message', $errors) ?>
                      </div>
                    </div>
                    <div class="col-lg-12 col-12">
                      <div class="form-group button">
                        <button type="submit" class="btn primary btn-send">Gửi thông tin</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!--/ End Contact Form -->
            <!-- Contact Address -->
            <div class="col-lg-4 col-12">
              <div class="contact-address">
                <!-- Address -->
                <div class="contact">
                  <h2><?php echo getOptions('contact_title') ?></h2>
                  <ul class="address">
                    <li><i class="fa fa-paper-plane"></i><span>Địa chỉ: </span> <?php echo !empty(getOptions('general_address')) ? getOptions('general_address') : false; ?></li>
                    <li><i class="fa fa-phone"></i><span>Điện thoại: </span><?php echo !empty(getOptions('general_hotline')) ? getOptions('general_hotline') : false; ?></li>
                    <li class="email"><i class="fa fa-envelope"></i><span>Email: </span><a href="mailto:info@youremail.com"><?php echo !empty(getOptions('general_email')) ? getOptions('general_email') : false; ?></a></li>
                  </ul>
                </div>
                <!--/ End Address -->
                <!-- Social -->
                <ul class="social">
                  <?php if (!empty($facebook)) : ?>
                    <li class="active"><a target="_blank" href="<?php echo $facebook ?>"><i class="fa fa-facebook"></i>Theo dõi chúng tôi facebook</a></li>
                  <?php endif; ?>
                  <?php if (!empty($x)) : ?>
                    <li><a target="_blank" href="<?php echo $x ?>"><i class="fa fa-twitter"></i>Theo dõi chúng tôi x</a></li>
                  <?php endif; ?>
                  <?php if (!empty($linkedin)) : ?>
                    <li><a target="_blank" href="<?php echo $linkedin ?>"><i class="fa fa-linkedin"></i>Theo dõi chúng tôi linkedin</a></li>
                  <?php endif; ?>
                  <?php if (!empty($behance)) : ?>
                    <li><a target="_blank" href="<?php echo $behance ?>"><i class="fa fa-behance"></i>Theo dõi chúng tôi bahance</a></li>
                  <?php endif; ?>
                </ul>
                <!--/ End Social -->
              </div>
            </div>
            <!--/ End Contact Address -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Contact -->

<?php
require_once _WEB_PATH_ROOT . '/modules/home/contents/partners.php';

layout('footer', 'client', $data);
?>