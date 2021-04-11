<?php require_once 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- Title -->
  <?php include 'dist/layout/title.php'; ?>
  <!-- Link -->
  <?php include 'dist/layout/link.php'; ?>
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
  <div class="wrapper">
    <!-- Nav -->
    <?php include 'dist/layout/nav.php'; ?>
    <!-- Aside -->
    <?php include 'dist/layout/aside.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Settings</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Settings</li>
              </ol>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Main content -->
      <div class="content">
        <div class="container">
          <div class="card">
            <div class="card-header">
              <h5 class="text-muted mb-0">Account Settings</h5>
            </div>
            <div class="card-body">
             <?php
              $obj = new Controller;

              $user_id = (isset($_SESSION['USER_INFO']['user_id'])) ? $_SESSION['USER_INFO']['user_id'] : 0;

              $view = $obj->view('UsersView');
              echo $view->update_form($user_id);
              ?>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Footer -->
    <?php include 'dist/layout/footer.php'; ?>
    <!-- Modal -->
    <?php include 'dist/layout/modal.php'; ?>
  </div>
  <!-- ./wrapper -->
  <!-- Script -->
  <?php include 'dist/layout/script.php'; ?>
  <!-- bs-custom-file-input -->
  <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- Bootstrap Switch -->
  <script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- Custom -->
  <script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();

      $('#bootstrap-switch').each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });
    });

    $('input[name=new_password], input[name=confirm_password]').on('keyup', function () {
      var new_password = $('input[name=new_password]').val();
      var confirm_password = $('input[name=confirm_password]').val();

      if (new_password != '' || confirm_password != '') {
        (new_password != confirm_password) ? $('#update-user').prop('disabled', true) : $('#update-user').prop('disabled', false) 
      }
    });

    $('#confirm-password').on('click', function () {
      $.ajax_request(
        controller = 'UsersController', 
        data = {
          update_self: '',
          given_name: $('input[name=given_name]').val(),
          middle_name: $('input[name=middle_name]').val(),
          family_name: $('input[name=family_name]').val(),
          email_address: $('input[name=email_address]').val(),
          current_password: $('input[name=current_password]').val(),
          new_password: $('input[name=new_password]').val(),
          confirm_password: $('input[name=confirm_password]').val()
        },
        callback = load_sweet_alert
      );
    });

    var load_sweet_alert = function (response) {
      result = JSON.parse(response);

      $('input[name=current_password]').val('');
      $('input[name=new_password]').val('');
      $('input[name=confirm_password]').val('');
      $('#modal-password').modal('hide');

      $.swal({
        title: result.title,
        type: result.type
      });
    }
  </script>
</body>
</html>
