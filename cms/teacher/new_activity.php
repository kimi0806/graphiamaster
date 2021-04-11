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
          <form action="../../app/controller/ActivitiesController.php" method="post">
            <div class="card">
              <div class="card-header bg-dark">
                <h5 class="mb-0">Activity Details</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="">Lessons</label>
                      <?php
                      $obj = new Controller;

                      $user_id = (isset($_SESSION['USER_INFO']['user_id'])) ? $_SESSION['USER_INFO']['user_id'] : 0;

                      $view = $obj->view('LessonsView');
                      echo $view->select($user_id, 'Active');
                      ?>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">Title</label>
                      <input type="text" name="title" class="form-control" placeholder="Enter ...">
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label for="">Description</label>
                      <textarea name="description" class="form-control" rows="1" placeholder="Enter ..."></textarea>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="form-group">
                  <label for="">Instructions</label>
                  <textarea name="instruction" class="form-control summernote" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <!-- /.form-group -->
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
                  <table class="table table-bordered table-hover mb-0">
                    <thead>
                      <tr>
                        <th width="100">No.</th>
                        <th>Problem</th>
                        <th>Solution <small>(Optional)</small></th>
                        <th width="100">Action</th>
                      </tr>
                    </thead>
                    <tbody id="tbody">
                      <tr id="tr-0">
                        <td>
                          <input type="number" name="arrangement[0]" class="form-control" placeholder="No.">
                        </td>
                        <td>
                          <textarea name="problem[0]" class="form-control" rows="1" placeholder="Problem"></textarea>
                        </td>
                        <td>
                          <textarea name="solution[0]" class="form-control" rows="1" placeholder="Solution"></textarea>
                        </td>
                        <td class="text-center">
                          <button type="button" name="remove" class="btn btn-danger" value="0"><i class="fas fa-times"></i></button>
                        </td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="3"></th>
                        <th class="text-center">
                          <button type="button" name="add" class="btn btn-outline-success" value=""><i class="fas fa-plus"></i></button>
                        </th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-2">
                    <a id="btn-back" href="activities.php" class="btn btn-block btn-dark">Back</a>
                  </div>
                  <!-- /.col -->
                  <div class="offset-lg-8 col-lg-2">
                    <button type="submit" name="save" class="btn btn-block btn-success">Save</button>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </form>
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
