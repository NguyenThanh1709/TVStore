<?php
if (!defined('_INCODE')) die('Access Deined...');
//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}
$data = [
  'pageTitle' => 'Thiết lập trang chủ'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);


// updateOptions('home');
if (isPost()) {

  $homeSlideJson = '';
  if (!empty(getBody()['home_slide'])) {
    $homeSlide = getBody()['home_slide'];

    $homeSlideArr = [];

    /*
    Cấu trúc mảng cần chuyển
    [0] => [
      'slide_title => 'Tiêu đề 1',
      'slide_button' => 'Xem thêm',
      'slide_button_link => 'https://vothanhdevcv.online'
    ]
  */

    if (!empty($homeSlide['title_slider'])) {
      foreach ($homeSlide['title_slider'] as $key => $value) {
        $homeSlideArr[] = [
          'title_slider' => $value,
          'button_slider' => isset($homeSlide['button_slider'][$key]) ? $homeSlide['button_slider'][$key] : '',
          'link_slider' => isset($homeSlide['link_slider'][$key]) ? $homeSlide['link_slider'][$key] : '',
          'video_slider' => isset($homeSlide['video_slider'][$key]) ? $homeSlide['video_slider'][$key] : '',
          'image_silde_1' => isset($homeSlide['image_silde_1'][$key]) ? $homeSlide['image_silde_1'][$key] : '',
          'image_silde_2' => isset($homeSlide['image_silde_2'][$key]) ? $homeSlide['image_silde_2'][$key] : '',
          'slide_bg' => isset($homeSlide['slide_bg'][$key]) ? $homeSlide['slide_bg'][$key] : '',
          'desc_slider' => isset($homeSlide['desc_slider'][$key]) ? $homeSlide['desc_slider'][$key] : '',
          'position_slide' => isset($homeSlide['position_slide'][$key]) ? $homeSlide['position_slide'][$key] : 'left'
        ];
      }
    }
    //Chuyển mảng thành chuổi json
    $homeSlideJson = json_encode($homeSlideArr);

    // home about
    $homeAbout = [];
    if (!empty(getBody()['home_about'])) {
      $homeAbout['information'] = getBody()['home_about'];
      $homeAboutJson = json_encode($homeAbout);
    }

    $homeSkillJson = '';
    if (!empty(getBody()['home_about']['skill'])) {
      $skillArr = [];
      if (!empty(getBody()['home_about']['skill']['name'])) {
        foreach (getBody()['home_about']['skill']['name'] as $key => $value) {
          $skillArr[] = [
            'name' => $value,
            'value' => getBody()['home_about']['skill']['values'][$key]
          ];
        }
        $homeSkillJson = json_encode($skillArr);
      }
    }

    $homeAbout['skill'] = $homeSkillJson;

    $homeAboutJson = json_encode($homeAbout);

    // Xử lý option home partner
    $homePartnerArr = getBody()['home_partner_list'];
    $partnersArr = [];
    $homePartnerJson = '';
    // Kiểm tra mảng homePartNerArr có dữ liệu hay không
    if (!empty($homePartnerArr)) {
      foreach (getBody()['home_partner_list']['name'] as $key => $value) {
        $partnersArr[] = [
          'name' => $value,
          'link' => getBody()['home_partner_list']['link'][$key],
          'image' => getBody()['home_partner_list']['image'][$key],
        ];
      }
      $homePartnerJson = json_encode($partnersArr);
    }
    // die($homePartnerJson);
    $data = [
      'home_slide' => $homeSlideJson,
      'home_about' => $homeAboutJson,
      'home_partner_list' => $homePartnerJson
    ];

    updateOptions($data, 'home');
  }
}

$error = getFlashData('errors');
$oldData = getFlashData('old_data');
$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');
?>
<section class="content">
  <div class="container-fluid">
    <?php
    getMsg($msg, $msg_style);
    ?>
    <form action="" method="post">
      <div class="card card-secondary">
        <div class="card-header">
          <h4 class="text-bold m-0">Thiết lập slider</h4>
        </div>
        <div class="slide-item">
          <?php
          $homeSlideJson = getOptions('home_slide');
          if (!empty($homeSlideJson)) {
            $homeSlideArr = json_decode($homeSlideJson, true); //Tham số true để chuyển thành mảng
            foreach ($homeSlideArr as $item) {
          ?>
              <div class='wp-item-slider ver-${ver}'>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="close-icon">
                        <i class="fa fa-times p-2"></i>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="">Tiêu đề</label>
                        <input type="text" class="form-control name" value="<?php echo $item['title_slider'] ?>" name="home_slide[title_slider][]" placeholder="Tiêu đề slide... ">
                        <?php echo form_error('title_slider', $error); ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="">Nút xem thêm</label>
                        <input type="text" class="form-control name" value="<?php echo $item['button_slider'] ?>" name="home_slide[button_slider][]" placeholder="Chữ của nút... ">
                        <?php echo form_error('buuton_slider', $error); ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="">Link xem thêm</label>
                        <input type="text" class="form-control name" value="<?php echo $item['link_slider'] ?>" name="home_slide[link_slider][]" placeholder="Đường link liên kết... ">
                        <?php echo form_error('link_slider', $error); ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="">Link Youtube</label>
                        <input type="text" class="form-control name" value="<?php echo $item['video_slider'] ?>" name="home_slide[video_slider][]" placeholder="Đường link liên kết... ">
                        <?php echo form_error('video_slider', $error); ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group ">
                        <label for="">Ảnh 1</label>
                        <div class="row">
                          <div class="col-9">
                            <input type="text" class="form-control thumbnail" value="<?php echo $item['image_silde_1'] ?>" name="home_slide[image_silde_1][]" placeholder="Nhập ảnh slide....">
                          </div>
                          <div class="col-3">
                            <button type="button" class="btn btn-success choose-image w-100"><i class="fa fa-upload"></i> Tải ảnh</button>
                          </div>
                        </div>
                        <?php echo form_error('image_silde_1', $error); ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group ">
                        <label for="">Ảnh 2</label>
                        <div class="row">
                          <div class="col-9">
                            <input type="text" class="form-control thumbnail" value="<?php echo $item['image_silde_2'] ?>" name="home_slide[image_silde_2][]" placeholder="Nhập ảnh slide....">
                          </div>
                          <div class="col-3">
                            <button type="button" class="btn btn-success choose-image w-100"><i class="fa fa-upload"></i> Tải ảnh</button>
                          </div>
                        </div>
                        <?php echo form_error('image_silde_2', $error); ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group ">
                        <label for="">Ảnh nền</label>
                        <div class="row">
                          <div class="col-9">
                            <input type="text" class="form-control thumbnail" value="<?php echo $item['slide_bg'] ?>" name="home_slide[slide_bg][]" placeholder="Nhập ảnh nền....">
                          </div>
                          <div class="col-3">
                            <button type="button" class="btn btn-success choose-image w-100"><i class="fa fa-upload"></i> Tải ảnh</button>
                          </div>
                        </div>
                        <?php echo form_error('slide_bg', $error); ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="">Vị trí</label>
                        <select name="home_slide[position_slide][]" id="" class="form-control">
                          <option value="">Vị trí</option>
                          <option <?php echo !empty($item['position_slide']) && $item['position_slide'] == 'left' ? "selected" : false; ?> value="left">Trái</option>
                          <option <?php echo !empty($item['position_slide']) && $item['position_slide'] == 'right' ? "selected" : false; ?> value="right">Phải</option>
                          <option <?php echo !empty($item['position_slide']) && $item['position_slide'] == 'midle' ? "selected" : false; ?> value="midle">Giữa</option>
                        </select>
                        <?php echo form_error('position_slider', $error); ?>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea name="home_slide[desc_slider][]" rows="1" id="" class="form-control"><?php echo $item['desc_slider'] ?></textarea>
                        <?php echo form_error('link_slider', $error); ?>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
              </div>
          <?php
            }
          }
          ?>
        </div>
        <div class="card-footer">
          <div class="mb-3">
            <button type="button" class="btn btn-sm btn-warning btn-add-slide"><i class="fa fa-image"></i> Thêm slider</button>
          </div>
        </div>
      </div>
      <!-- Thiết lập giới thiệu -->
      <div class="card card-secondary">
        <div class="card-header">
          <h4 class="text-bold m-0"><?php echo getOptions('home_about', 'label') ?></h4>
          <?php

          $homeAboutJson = getOptions('home_about');

          $homeAboutInfo = [];
          $homeAboutInfo = [];
          $homeAboutSkill = [];

          // echo $homeAboutJson;
          if (!empty($homeAboutJson)) {
            $homeAboutArr = json_decode($homeAboutJson, true);
            $homeAboutInfo = $homeAboutArr['information'];
            $homeAboutSkill = json_decode($homeAboutArr['skill'], true);
            // echo "<pre>";
            // print_r($homeAboutSkill);
            // echo "</pre>";
          }
          ?>
        </div>
        <div class="slide-item">
          <div class='wp-item-slider ver-${ver}'>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="close-icon">
                    <i class="fa fa-times p-2"></i>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="">Tiêu đề nền</label>
                    <input type="text" class="form-control name" value="<?php echo !empty($homeAboutInfo['title_bg']) ? $homeAboutInfo['title_bg'] : '' ?>" name="home_about[title_bg]" placeholder="Tiêu đề nền... ">
                    <?php echo form_error('title_bg', $error); ?>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="">Tiêu đề - mô tả</label>
                    <textarea name="home_about[desc]" class="form-control editor" id="">
                    <?php echo !empty($homeAboutInfo['desc']) ? $homeAboutInfo['desc'] : '' ?>
                    </textarea>
                    <?php echo form_error('desc', $error); ?>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group ">
                    <label for="">Hình ảnh</label>
                    <div class="row">
                      <div class="col-10">
                        <input type="text" readonly class="form-control thumbnail" value="<?php echo !empty($homeAboutInfo['image']) ? $homeAboutInfo['image'] : '' ?>" name="home_about[image]" placeholder="Nhập ảnh nền....">
                      </div>
                      <div class="col-2">
                        <button type="button" class="btn btn-success choose-image w-100"><i class="fa fa-upload"></i> Tải ảnh</button>
                      </div>
                    </div>
                    <?php echo form_error('image', $error); ?>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="">Video</label>
                    <input type="text" value="<?php echo !empty($homeAboutInfo['video']) ? $homeAboutInfo['video'] : '' ?>" name="home_about[video]" class="form-control" placeholder="Link video">
                    <?php echo form_error('video', $error); ?>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="">Nội dung giới thiệu</label>
                    <textarea name="home_about[content]" class="form-control editor" id="">
                    <?php echo !empty($homeAboutInfo['content']) ? $homeAboutInfo['content'] : '' ?>
                    </textarea>
                    <?php echo form_error('content', $error); ?>
                  </div>
                </div>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
      <!-- end Giới thiệu -->

      <!-- Thiết lập kỹ năng -->
      <div class="card card-secondary">
        <div class="card-header">
          <h4 class="text-bold m-0">Thiết lập kỹ năng</h4>
        </div>
        <div class="card-body skill-wrapper pt-0">
          <?php
          if (!empty($homeAboutSkill)) {
            foreach ($homeAboutSkill as $item) {
          ?>
              <div class="skill-item">
                <div class="row">
                  <div class="col-12">
                    <div class="close-icon">
                      <i class="fa fa-times p-2"></i>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="">Tên năng lực</label>
                      <input type="text" class="form-control" name="home_about[skill][name][]" placeholder="Tên năng lực... " value="<?php echo $item['name'] ?>">
                      <?php echo form_error('title_slider', $error); ?>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="">Giá trị</label>
                      <input class="ranger" type="text" name="home_about[skill][values][]" value="<?php echo $item['value'] ?>">
                      <?php echo form_error('title_slider', $error); ?>
                    </div>
                  </div>
                </div>
              </div>
          <?php }
          } ?>
        </div>
        <div class="card-footer">
          <button type="button" class="btn btn-sm btn-warning btn-add-skill"><i class="fa fa-plus"></i> Thêm kỹ năng</button>
        </div>
      </div>
      <!-- End thiết lập kỹ năng  -->

      <!-- Thiết lập dịch vụ -->
      <div class="card card-secondary">
        <div class="card-header">
          <h4 class="text-bold p-0 m-0">Thiết lập dịch vụ</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_service_title_bg', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('home_service_title_bg') ?>" name="home_service_title_bg" placeholder="Tiêu đề nên dịch vụ... ">
                <?php echo form_error('home_service_title_bg', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_service_title', 'label') ?></label>
                <textarea name="home_service_title" class="form-control editor" id=""><?php echo getOptions('home_service_title') ?></textarea>
                <?php echo form_error('home_service_title', $error); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End thiết lập dịch vụ -->

      <!-- Thiết lập dịch vụ -->
      <div class="card card-secondary">
        <div class="card-header">
          <h4 class="text-bold p-0 m-0">Thiết lập thành tích</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_fact_title', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('home_fact_title') ?>" name="home_fact_title" placeholder="Tiêu đề chính... ">
                <?php echo form_error('home_fact_title', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_fact_sub_title', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('home_fact_sub_title') ?>" name="home_fact_sub_title" placeholder="Tiêu đề phụ... ">
                <?php echo form_error('home_fact_sub_title', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_fact_desc', 'label') ?></label>
                <textarea name="home_fact_desc" class="form-control editor" id=""><?php echo getOptions('home_fact_desc') ?></textarea>
                <?php echo form_error('home_fact_desc', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_fact_button_text', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('home_fact_button_text') ?>" name="home_fact_button_text" placeholder="Nội dung nút... ">
                <?php echo form_error('home_fact_button_text', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_fact_button_link', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('home_fact_button_link') ?>" name="home_fact_button_link" placeholder="Link nút... ">
                <?php echo form_error('home_fact_button_link', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_fact_year_number', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('home_fact_year_number') ?>" name="home_fact_year_number" placeholder="Năm thành lập... ">
                <?php echo form_error('home_fact_year_number', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <div class="row">
                  <div class="col-6">
                    <label for=""><?php echo getOptions('home_fact_project_number', 'label') ?></label>
                    <input type="text" class="form-control name" value="<?php echo getOptions('home_fact_project_number') ?>" name="home_fact_project_number" placeholder="Số lượng dự án... ">
                  </div>
                  <div class="col-6">
                    <label for=""><?php echo getOptions('home_fact_project_unit', 'label') ?></label>
                    <input type="text" class="form-control name" value="<?php echo getOptions('home_fact_project_unit') ?>" name="home_fact_project_unit" placeholder="Đơn vị đếm dự án... ">
                  </div>
                </div>
                <?php echo form_error('home_fact_project_unit', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <div class="row">
                  <div class="col-6">
                    <label for=""><?php echo getOptions('home_fact_total_number', 'label') ?></label>
                    <input type="text" class="form-control name" value="<?php echo getOptions('home_fact_total_number') ?>" name="home_fact_total_number" placeholder="Số lượng dự án... ">
                  </div>
                  <div class="col-6">
                    <label for=""><?php echo getOptions('home_fact_total_unit', 'label') ?></label>
                    <input type="text" class="form-control name" value="<?php echo getOptions('home_fact_total_unit') ?>" name="home_fact_total_unit" placeholder="Đơn vị đếm dự án... ">
                  </div>
                </div>
                <?php echo form_error('home_fact_total_unit', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_fact_awards_number', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('home_fact_awards_number') ?>" name="home_fact_awards_number" placeholder="Giải thưởng... ">
                <?php echo form_error('home_fact_awards_number', $error); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End thiết lập dịch vụ -->

      <!-- Thiết lập dự án -->
      <div class="card card-secondary">
        <div class="card-header">
          <h4 class="text-bold p-0 m-0">Thiết lập dự án</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_portfolio_title_bg', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('home_portfolio_title_bg') ?>" name="home_portfolio_title_bg" placeholder="Tiêu đề chính... ">
                <?php echo form_error('home_portfolio_title_bg', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_portfolio_button', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('home_portfolio_button') ?>" name="home_portfolio_button" placeholder="Nội dung nút... ">
                <?php echo form_error('home_portfolio_button', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_portfolio_button_link', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('home_portfolio_button_link') ?>" name="home_portfolio_button_link" placeholder="Nội dung nút... ">
                <?php echo form_error('home_portfolio_button_link', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="">Tiêu đề - mô tả</label>
                <textarea name="home_portfolio_title" class="form-control editor" id=""><?php echo getOptions('home_portfolio_title') ?></textarea>
                <?php echo form_error('home_portfolio_title', $error); ?>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- End thiết lập dự án -->

      <!-- Thiết lập lời kêu gọi-->
      <div class="card card-secondary">
        <div class="card-header">
          <h4 class="text-bold p-0 m-0">Thiết lập lời kêu gọi</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_cta_button', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('home_cta_button') ?>" name="home_cta_button" placeholder="Nội dung nút... ">
                <?php echo form_error('home_cta_button', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_cta_button_link', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('home_cta_button_link') ?>" name="home_cta_button_link" placeholder="Nội dung link nút... ">
                <?php echo form_error('home_cta_button_link', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_cta_content', 'label') ?></label>
                <textarea name="home_cta_content" class="form-control editor" id=""><?php echo getOptions('home_cta_content') ?></textarea>
                <?php echo form_error('home_cta_content', $error); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End thiết lập lời kêu gọi-->

      <!-- Thiết lập bài viết-->
      <div class="card card-secondary">
        <div class="card-header">
          <h4 class="text-bold p-0 m-0">Thiết lập bài viết</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_blog_title_bg', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('home_blog_title_bg') ?>" name="home_blog_title_bg" placeholder="Tiêu đề nền bài viết... ">
                <?php echo form_error('home_blog_title_bg', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_blog_content', 'label') ?></label>
                <textarea name="home_blog_content" class="form-control editor" placeholder="Nội dung" id=""><?php echo getOptions('home_blog_content') ?></textarea>
                <?php echo form_error('home_blog_content', $error); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End thiết lập bài viết-->

      <!-- Thiết lập đối tác-->
      <div class="card card-secondary">
        <div class="card-header">
          <h4 class="text-bold p-0 m-0">Thiết lập đối tác</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_partner_title_bg', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('home_partner_title_bg') ?>" name="home_partner_title_bg" placeholder="Tiêu đề nền đối tác... ">
                <?php echo form_error('home_partner_title_bg', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for=""><?php echo getOptions('home_partner_content', 'label') ?></label>
                <textarea name="home_partner_content" class="form-control editor" placeholder="Nội dung" id=""><?php echo getOptions('home_partner_content') ?></textarea>
                <?php echo form_error('home_partner_content', $error); ?>
              </div>
            </div>
          </div>
        </div>
        <?php
        $partners = getOptions('home_partner_list');
        $partners = json_decode($partners, true);
        ?>
        <div class="card-body pt-0 pb-0">
          <div class="partner-wrapper">
            <label for="">Danh sách đối tác</label>
            <?php
            if (!empty($partners)) :
              foreach ($partners as $item) :
            ?>
                <div class="partner-item">
                  <hr>
                  <div class="row">
                    <div class="col-12">
                      <div class="close-icon">
                        <i class="fa fa-times p-2"></i>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label for="">Tên đối tác</label>
                        <input type="text" class="form-control" value="<?php echo $item['name'] ?>" name="home_partner_list[name][]" placeholder="Tên đối tác... " value="">
                        <?php echo form_error('partners_name', $error); ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="">Link đối tác</label>
                        <input type="text" class="form-control" value="<?php echo $item['link'] ?>" name="home_partner_list[link][]" placeholder="Link đối tác... " value="">
                        <?php echo form_error('partners_link', $error); ?>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group ">
                        <label for="">Hình ảnh</label>
                        <div class="row">
                          <div class="col-10">
                            <input type="text" readonly class="form-control thumbnail" value="<?php echo $item['image'] ?>" name="home_partner_list[image][]" placeholder="Nhập ảnh nền....">
                          </div>
                          <div class="col-2">
                            <button type="button" class="btn btn-success choose-image w-100"><i class="fa fa-upload"></i> Tải ảnh</button>
                          </div>
                        </div>
                        <?php echo form_error('image', $error); ?>
                      </div>
                    </div>
                  </div>
                </div>
            <?php
              endforeach;
            endif; ?>
          </div>
        </div>
        <div class="card-footer">
          <button type="button" class="btn btn-sm btn-warning btn-add-partner"><i class="fa fa-plus"></i> Thêm đối tác</button>
        </div>
      </div>
      <!-- End thiết lập đối tác-->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary mr-1">Lưu thay đổi</button>
        <a href="<?php echo getLinkAdmin('blogs') ?>" class="btn btn-warning">Quay lại</a>
      </div>
    </form>
  </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);

?>