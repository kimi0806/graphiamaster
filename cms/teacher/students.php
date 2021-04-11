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
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Students</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Students</li>
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
              <h5 class="text-muted mb-0">Master List</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <?php
                $obj = new Controller;

                $teacher_user_id = (isset($_SESSION['USER_INFO']['user_id'])) ? $_SESSION['USER_INFO']['user_id'] : 0;

                if (isset($_GET['sections_id'])) {
                  $view = $obj->view('StudentsView');
                  echo $view->students_by_section($teacher_user_id, $_GET['sections_id']);
                }                
                ?>
              </div>
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

    $teacher_user_id = (isset($_SESSION['USER_INFO']['user_id'])) ? $_SESSION['USER_INFO']['user_id'] : 0;

    if (isset($_GET['sections_id'])) {
      $view = $obj->view('StudentsView');
      echo $view->change_my_section($teacher_user_id, $_GET['sections_id']);
    }
    ?>
  </div>
  <!-- ./wrapper -->
  <!-- Script -->
  <?php include 'dist/layout/script.php'; ?>
  <!-- bs-custom-file-input -->
  <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- DataTables -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- Select2 -->
  <script src="../../plugins/select2/js/select2.full.min.js"></script>
  <!-- Custom -->
  <script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();

      $(".dt-default").DataTable({
        "responsive": true,
        "autoWidth": false,
      });

       $('.select2').select2()

      $('.select2bs4').select2({
        theme: 'bootstrap4'
      });
    });
  </script>
</body>
</html>
