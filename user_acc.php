<?php require_once 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->
    <?php include 'include/title.php'; ?>
    <!-- Link -->
    <?php include 'include/link.php'; ?>
</head>

<body>
    <!--::header part start::-->
    <?php include 'include/header.php'; ?>
    <!-- Header part end-->

    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Login Details</h2>
                            <p>Home<span>/</span>Login Details</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <div class="padding_top"></div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <ul class="list-group">
                  <a href="user_acc.php"><li class="list-group-item" style="background-color: #FF6500; color: white; border-top-left-radius: 0; border-top-right-radius: 0; border-bottom-left-radius: 0; border-bottom-right-radius: 0; font-size: 16px;">Login Details</li></a>
                  <a href="user_personal_details.php"><li class="list-group-item" style="border-top-left-radius: 0; border-top-right-radius: 0; border-bottom-left-radius: 0; border-bottom-right-radius: 0; font-size: 16px;">Personal Details</li></a>
                  <a href="#"><li class="list-group-item" style="border-top-left-radius: 0; border-top-right-radius: 0; border-bottom-left-radius: 0; border-bottom-right-radius: 0; font-size: 16px;">Activity Details</li></a>
                </ul>
            </div>

            <div class="col-lg-9">
                <div class="card" style="border-top-left-radius: 0; border-top-right-radius: 0; border-bottom-left-radius: 0; border-bottom-right-radius: 0;">
                  <div class="card-body">
                    <!-- <form method="post" action=""> -->
                        <?php  
                        $obj = new Controller;

                        $user_id = (isset($_SESSION['USER_INFO']['user_id'])) ? $_SESSION['USER_INFO']['user_id'] : 0;

                        $view = $obj->view('UsersView');
                        echo $view->public_login_details($user_id);
                        ?>
                    <!-- </form> -->
                  </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding_top"></div>

    <!-- footer part start-->
    <?php include 'include/footer.php'; ?>
    <!-- footer part end-->

    <!-- Script -->
    <?php include 'include/script.php'; ?>

    <script type="text/javascript">
        function showNewPassword() {
          var x = document.getElementById("new_password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }

          var y = document.getElementById("confirm_password");
          if (y.type === "password") {
            y.type = "text";
          } else {
            y.type = "password";
          }
        }

        function showCurrentPassword() {
          var z = document.getElementById("current_password");
          if (z.type === "password") {
            z.type = "text";
          } else {
            z.type = "password";
          }
        }

        function ConfirmNewPassword() {
            var password = document.getElementById("new_password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            if (password != confirmPassword) {
                  alert("Passwords does not match.");
                return false;
            }
            return true;
        }

        $('#update_login_details').on('click', function () {
          $.ajax_request(
            controller = 'UsersController', 
            data = {
              update_self: '',
              given_name: $('input[name=given_name]').val(),
              middle_name: $('input[name=middle_name]').val(),
              family_name: $('input[name=family_name]').val(),
              username: $('input[name=username]').val(),
              email_address: $('input[name=email_address]').val(),
              new_password: $('input[name=new_password]').val(),
              confirm_password: $('input[name=confirm_password]').val(),
              current_password: $('input[name=current_password]').val()
            },
            callback = load_sweet_alert
          );
        });

        var load_sweet_alert = function (response) {
          result = JSON.parse(response);

          $('input[name=new_password]').val('');
          $('input[name=confirm_password]').val('');
          $('input[name=current_password]').val('');
          $('#modal-password').modal('hide');

          $.swal({
            title: result.title,
            type: result.type
          });
        }
    </script>
</body>

</html>