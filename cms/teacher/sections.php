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
              <h1 class="m-0 text-dark">Section</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Section</li>
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
            <div class="card-header" style="padding-top: 5px; padding-bottom: 5px;">
              <div class="row">
                <div class="col-sm-6 col-lg-8 d-flex align-items-center">
                  <h5 class="text-muted mb-0">Table</h5>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-lg-2">
                  <button class="btn btn-block btn-success" data-toggle="modal" data-target="#modal-new">New</button>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-lg-2">
                  <a href="section_students.php" class="btn btn-block btn-dark">Section Students</a>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <?php
                $obj = new Controller;

                $teacher_user_id = (isset($_SESSION['USER_INFO']['user_id'])) ? $_SESSION['USER_INFO']['user_id'] : 0;

                $view = $obj->view('SectionsView');
                echo $view->list_of_sections($teacher_user_id, 'Active');
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
    <div class="modal fade" id="modal-new">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form action="../../app/controller/SectionsController.php" method="post">
            <div class="modal-header">
              <label class="mb-0">New</label>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="section_name" placeholder="Enter ...">
              </div>
              <div class="form-group">
                <label for="">Description</label>
                <textarea class="form-control" rows="3" name="section_desc" placeholder="Enter ..."></textarea>
              </div>
              <div class="form-group">
                <label>Status</label>
                <select class="custom-select select2bs4" name="section_status" required>
                  <option value="" disabled selected>Select</option>
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>
            </div>
            <div class="modal-footer justify-content-between py-1">
              <button type="button" class="btn btn-link text-danger" data-dismiss="modal">Cancel</button>
              <button type="submit" name="save" class="btn btn-link text-success">Save Now</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <?php
    $obj = new Controller;

    $user_id = (isset($_SESSION['USER_INFO']['user_id'])) ? $_SESSION['USER_INFO']['user_id'] : 0;

    $view = $obj->view('SectionsView');
    echo $view->mdl_section_details($user_id, 'Active');
    echo $view->mdl_update_section_data($user_id, 'Active');
    echo $view->remove_modal($user_id, 'Active');
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
  <!-- Custom -->
  <script type="text/javascript">
    $(document).ready(function () {
      $('.select2').select2()

      $('.select2bs4').select2({
        theme: 'bootstrap4'
      });

      $(".dt-default").DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength ": 5,
        "lengthMenu": [[5, 10, 20, -1], [5, 10, 20]]
      });
    });
  </script>

</body>
</html>
