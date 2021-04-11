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
              <h1 class="m-0 text-dark">Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
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
                <div class="col-sm-9 col-lg-10 d-flex align-items-center">
                  <h5 class="text-muted mb-0">Table</h5>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-lg-2">
                  <button class="btn btn-block btn-success" data-toggle="modal" data-target="#modal-new">Create</button>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <?php
                $obj = new Controller;

                $view = $obj->view('UsersView');
                echo $view->table('Active');
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
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <label class="mb-0">New</label>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="../../app/controller/UsersController.php" method="post" enctype="multipart/form-data" class="form-contact text-left">
              <input type="hidden" name="user_type_id" value="2">
              <div class="form-group">
                <label class="text-uppercase text-secondary">Photo<span class="text-danger ml-1">*</span></label>
                <div class="custom-file">
                  <input type="file" id="profile-file" name="photo" class="custom-file-input" required="">
                  <label class="custom-file-label" for="profile-file">Choose file</label>
                </div>
              </div>
              <!-- /.form-group -->
              <label class="text-uppercase text-secondary">Personal Details<span class="text-danger ml-1">*</span></label>
              <div class="row">
                <div class="col-4">
                  <div class="form-group mb-3">
                    <input type="text" name="given_name" class="form-control" placeholder="First Name" required="">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group mb-3">
                    <input type="text" name="middle_name" class="form-control" placeholder="Middle Name">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group mb-3">
                    <input type="text" name="family_name" class="form-control" placeholder="Last Name" required="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group mb-0">
                    <label class="text-uppercase text-secondary">Mobile Number<span class="text-danger ml-1">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text text-white bg-gradient-warning">+63</label>
                      </div>
                      <input type="text" name="mobile_number" class="form-control" data-inputmask='"mask": "999 9999 999"' data-mask required="">
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group mb-0">
                    <label class="text-uppercase text-secondary">Birth Date<span class="text-danger ml-1">*</span></label>
                    <input type="date" name="date_of_birth" class="form-control" placeholder="Birth Date" required="">
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="form-group form-select mb-0">
                    <label class="text-uppercase text-secondary">Sex<span class="text-danger ml-1">*</span></label>
                    <select name="sex" class="form-control select2bs4" style="width: 100%;" required="">
                      <option>Male</option>
                      <option>Female</option>
                    </select>
                  </div>
                </div>
              </div>
              <hr>
              <div class="form-group mb-3">
                <label class="text-uppercase text-secondary">Create your login details<span class="text-danger ml-1">*</span></label>
                <input type="email" name="email_address" class="form-control" placeholder="Email Address" required="">
                <small class="text-muted">Make sure that the email used is existing and active.</small>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group mb-0">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                    <small class="text-muted">Enter at least 8 characters.</small>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group mb-0">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required="">
                    <small class="text-muted">Re-type your password.</small>
                  </div>
                </div>
              </div>
              <hr>
              <label class="text-uppercase text-secondary">School Background<span class="text-danger ml-1">*</span></label>
              <div class="form-group form-select">
                <select name="type_of_school" class="form-control select2bs4 mb-3" style="width: 100%;" required="">
                  <option selected="" disabled="">Type of School</option>
                  <option>Public</option>
                  <option>Private</option>
                  <option>Semi-Private</option>
                </select>
              </div>
              <div class="form-group mb-3">
                <input name="school_name" class="form-control" placeholder=" School Name" required="">
              </div>
              <div class="form-group mb-3">
                <textarea name="school_address" class="form-control" rows="3" placeholder="Please Input Your Complete School Address" required=""></textarea>
              </div>
              <hr>
              <label class="text-uppercase text-secondary">Requirements<span class="text-danger ml-1">*</span></label>
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-3">
                      <img src="../../storage/pictures/identity_cards/Test-ID 1.jpg" class="img-thumbnail">
                    </div>
                    <div class="col-9">
                      <div class="form-group">
                        <label class="text-sm text-uppercase text-muted font-weight-bold">ID Copy</label>
                        <span class="text-sm text-muted font-weight-bold">(Scanned or Picture)</span>
                        <div class="custom-file">
                          <input type="file" id="first-valid-id" name="identity_photo" class="custom-file-input" required="">
                          <label class="custom-file-label" for="first-valid-id">Choose file</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between py-1">
                <button type="button" class="btn btn-link text-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" name="create" class="btn btn-link text-success"><i class="fas fa-save mr-2"></i>Save</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <?php
    $obj = new Controller;

    $view = $obj->view('UsersView');
    echo $view->remove_modal('Active');
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
  <!-- bs-custom-file-input -->
  <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- Custom -->
  <script type="text/javascript">
    $(document).ready(function () {
      $(".dt-default").DataTable({
        "responsive": true,
        "autoWidth": false,
      });

      $('.select2bs4').select2({
        theme: 'bootstrap4'
      });

      bsCustomFileInput.init();
    });

    $('#confirm-password').on('click', function () {
      $.ajax_request(
        controller = 'UsersController', 
        data = {
          remove: '',
          id: $('input[name=id]').val(),
          current_password: $('input[name=current_password]').val()
        },
        callback = load_sweet_alert
      );
    });

    var load_sweet_alert = function (response) {
      result = JSON.parse(response);

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
