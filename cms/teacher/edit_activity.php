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
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
  <!-- Custom -->
  <style type="text/css">
    @media (max-width: 991.98px) {
      #btn-back {
        margin-bottom: 1rem;
      }
    }
  </style>
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
  <div class="wrapper">
    <!-- Nav -->
    <?php include 'dist/layout/nav.php'; ?>
    <!-- Aside -->
    <?php include 'dist/layout/aside.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pb-1">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Create Activity</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="activities.php">Activities</a></li>
                <li class="breadcrumb-item active">Create Activity</li>
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
            <div class="card-header bg-dark">
              <h5 class="mb-0">Activity Details</h5>
            </div>
            <div class="card-body">
              <?php
              $obj = new Controller;

              $user_id = (isset($_SESSION['USER_INFO']['user_id'])) ? $_SESSION['USER_INFO']['user_id'] : 0;

              if (isset($_GET['activity_id'])) {
                $view = $obj->view('ActivitiesView');
                echo $view->update_form($_GET['activity_id'], $user_id);
              }
              ?>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div class="card">
            <div class="card-header bg-dark">
              <h5 class="mb-0">Activity Items</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <?php
                $obj = new Controller;

                $user_id = (isset($_SESSION['USER_INFO']['user_id'])) ? $_SESSION['USER_INFO']['user_id'] : 0;

                if (isset($_GET['activity_id'])) {
                  $view = $obj->view('ActivityItemsView');
                  echo $view->table($_GET['activity_id'], 'Active');
                }
                ?>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header bg-dark">
              <h5 class="mb-0">New Items</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <?php
                $obj = new Controller;

                $user_id = (isset($_SESSION['USER_INFO']['user_id'])) ? $_SESSION['USER_INFO']['user_id'] : 0;

                if (isset($_GET['activity_id'])) {
                  $view = $obj->view('ActivityItemsView');
                  echo $view->new_items($_GET['activity_id'], 'Active');
                }
                ?>
              </div>
              <!-- /.table-responsive -->
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
    <?php
    $obj = new Controller;

    $user_id = (isset($_SESSION['USER_INFO']['user_id'])) ? $_SESSION['USER_INFO']['user_id'] : 0;

    if (isset($_GET['activity_id'])) {
      $view = $obj->view('ActivityItemsView');
      echo $view->update_modal($_GET['activity_id'], 'Active');
      echo $view->remove_modal($_GET['activity_id'], 'Active');
    }
    ?>
  </div>
  <!-- ./wrapper -->
  <!-- Script -->
  <?php include 'dist/layout/script.php'; ?>
  <!-- DataTables -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- Select2 -->
  <script src="../../plugins/select2/js/select2.full.min.js"></script>
  <!-- Summernote -->
  <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
  <!-- Custom -->
  <script type="text/javascript">
    $(document).ready(function () {
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      });

      $('.summernote').summernote({
        height: 100
      });

      $(".dt-default").DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength ": 5,
        "lengthMenu": [[5, 10, 20, -1], [5, 10, 20]]
      });

      $.initialize({button: true});
    });

    $('button[name=add]').on('click', function () {
      var id = $.uniqueId(100);

      $('#tbody').append('<tr id="tr-' + id + '"><td><input type="number" name="arrangement[' + id + ']" class="form-control" placeholder="No."></td><td><textarea name="problem[' + id + ']" class="form-control" rows="1" placeholder="Problem"></textarea></td><td><textarea name="solution[' + id + ']" class="form-control" rows="1" placeholder="Solution"></textarea></td><td class="text-center"><button type="button" name="remove" class="btn btn-danger" value="' + id + '"><i class="fas fa-times"></i></button></td></tr>');

      $.initialize({button: true});
    });

    $.uniqueId = function (length) {
      return Math.floor(Math.random() * length);
    }

    $.initialize = function (array = {}) {
      $.each(array, function (key, value) {
        switch (key){
          case 'button':
            $('button[name=remove]').off().on('click', function () {
              $('#tr-' + $(this).val()).remove();
            });
            break;

          default:
            // code...
            break;
        }
      });
    }
  </script>
</body>
</html>
