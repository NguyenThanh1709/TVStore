$(document).ready(function () {
  // Hàm comment dùng để gửi bình luận mới hoặc trả lời bình luận
  function comment(parent_id = "") {
    $("#comments-form").on("submit", function (event) {
      event.preventDefault(); // Ngăn chặn hành vi mặc định
      $("#loading").addClass("spinner-border spinner-border-sm"); // Thêm class tạo hiệu ứng loading button
      $("#btn-comment").attr("disabled", true);

      if (parent_id == "") {
        parent_id = $('input[name="parent-id"]').val();
      }

      // Lấy dữ liệu từ form
      var data = {
        name: $('input[name="name"]').val(),
        email: $('input[name="email"]').val(),
        content: $('textarea[name="content"]').val(),
        parent_id: parent_id,
        blog_id: $('input[name="blog_id"]').val(),
        csrf_token: $('input[name="csrf_token"]').val(),
      };

      console.log(data);

      // Gửi dữ liệu qua ajax
      $.ajax({
        url: "?module=blogs&action=server_ajax",
        method: "POST",
        data: data,
        dataType: "json",
        success: function (response) {
          console.log("Response:", response);
          if (response.str != "") {
            setTimeout(function () {
              $("#loading").removeClass("spinner-border spinner-border-sm");
              $("#btn-comment").attr("disabled", false);
              $('input[name="name"]').val("");
              $('input[name="email"]').val("");
              $('textarea[name="content"]').val("");
              if (parent_id == 0) {
                var wrappedResponse =
                  "<div class='single-comments'>" + response.str + "</div>";
                $(".comments-body").append(wrappedResponse);
              } else {
                localStorage.setItem("showNotification", "true");
                window.location.reload();
                // var wrappedResponse = `<div class="comment-list comment-list-${response.parent_id}">${response.str}</div>`;
                // $(".comment-children").append(wrappedResponse);
              }
            }, 2200);
          } else {
            setTimeout(function () {
              $("#loading").removeClass("spinner-border spinner-border-sm");
              $("#btn-comment").attr("disabled", false);
              $('input[name="name"]').val("");
              $('input[name="email"]').val("");
              $('textarea[name="content"]').val("");
              toastr.options = {
                closeButton: true,
              };
              toastr.success(
                "Bình luận của bạn đã được gửi đi !",
                "Thông báo!"
              );
            }, 3000);
          }
        },
        error: function (error) {
          console.error("Error:", error); // Log any error to the console
          $("#loading").removeClass("spinner-border spinner-border-sm");
          $("#btn-comment").attr("disabled", false);
        },
      });
    });
  }

  // Hàm quản lý sự kiện click trả lời bình luận
  function handleReplyClick(e) {
    e.preventDefault();
    const commentID = $(this).attr("data-id");
    const nameReply = $(".name-" + commentID).text();
    const user_id = $('input[name="user_id"]').val();
    var nameAdmin = "";
    var email = "";
    let titleName = "";
    if (user_id != undefined) {
      nameAdmin = $('input[name="fullname"]').val();
      email = $('input[name="email"]').val();
      titleName = `Bình luận với tư cách Quản trị viên: <strong class="">${nameAdmin} </strong> -- <a href="#">Thoát</a>`;
    }
    $(".wp-comment-form").remove();
    const str = `<div class="col-12 wp-comment-form">
                  <div class="comments-form">
                    ${titleName} 
                    <h2 class="title mt-2">Trả lời bình luận: <span class="nameReply">${nameReply} <i class="fa fa-close"></i> </span></h2>
                    <form class="form" method="post" id="comments-form" action="">
                      <div class="row">
                        <div class="col-lg-6 col-12">
                          <div class="form-group">
                            <input type="text" name="name" value="${nameAdmin}" placeholder="Nhập họ và tên của bạn..." required="required">
                          </div>
                        </div>
                        <div class="col-lg-6 col-12">
                          <div class="form-group">
                            <input type="email" name="email" value="${email}" placeholder="Nhập email của bạn..." required="required">
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
                </div>`;

    $(".reply-comment-form-" + commentID).html(str);
    comment(commentID);
  }

  // Gán sự kiện click sử dụng phương pháp delegated event
  $(document).on("click", ".reply", handleReplyClick);

  // Gọi hàm comment
  comment();

  $(document).ready(function () {
    if (localStorage.getItem("showNotification") === "true") {
      toastr.options = {
        closeButton: true,
      };
      toastr.success("Bình luận của bạn đã được gửi đi !", "Thông báo!");
      localStorage.removeItem("showNotification");
    }
  });

  // Xử lý sự kiện click cho biểu tượng tùy chỉnh
  $(document).on("click", ".custom-icon", function () {
    $(this).siblings(".list-menu").toggle();
  });

  //Xử lý gửi thông tin liên hệ
  $(document).on("click", ".btn-send", function () {
    Swal.fire({
      title: "<h4>Hệ thống đang xử lý!</h4>",
      html: "Vui lòng chờ trong giây lát...",
      timer: 8000,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading();
        setTimeout(function () {
          window.location.reload();
        }, 8000);
      },
      willClose: () => {
        clearInterval(timerInterval);
      },
    }).then((result) => {
      /* Read more about handling dismissals below */
      if (result.dismiss === Swal.DismissReason.timer) {
        console.log("I was closed by the timer");
      }
    });
  });
});
