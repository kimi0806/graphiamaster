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
            <legend class="m-0 text-dark">Lesson Details</legend>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Lesson Details</li>
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
         <form action="../../app/controller/LessonsController.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-lg-5">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title text-muted">Lesson Details</h5>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="profile_photo_file" required>
                      <label class="custom-file-label" for="customFile">Choose Image</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter ..." required>
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" name="description" placeholder="Enter ..." required></textarea>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select class="custom-select" name="status" required>
                      <option value="" disabled selected>Select</option>
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- col-lg-5 -->

            <div class="col-lg-7">
              <div class="card">
                <div class="card-header">
                 <div class="row">
                    <div class="col-sm-9 col-lg-9 d-flex align-items-center">
                      <h5 class="card-title text-muted p-2">Lesson Files</h5>
                    </div>
                    <div class="col-sm-3 col-lg-3">
                      <a href="lessons.php" class="btn btn-block btn-outline-info btn-sm w-100"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                  </div>
                </div>
                <div class="card-body" style="max-height: 340px; overflow-y: auto;">
                  <div id="accordion">
                    <div class="card card-default">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        <div class="card-header">
                          <h4 class="card-title">
                            Video Files
                          </h4>
                        </div>
                      </a>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="card-body">
                          <label>Video Description <small>(optional)</small></label>
                            <div class="form-group">
                              <textarea class="form-control" rows="3" name="video_description" placeholder="Type here..."></textarea>
                            </div>
                            <div class="row">
                              <div class="col-lg-10">
                                <div class="form-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="video_file[0]" required>
                                    <label class="custom-file-label" for="customFile">Choose Video File</label>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-2">
                                <div class="form-group">
                                  <button type="button" class="btn btn-success w-100 add_video"><i class="fas fa-plus fa-lg"></i></button>
                                </div>
                              </div>
                              <div class="col-lg-12 another_video_slot"></div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="card card-default">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        <div class="card-header">
                          <h4 class="card-title">
                            Presentation Files
                          </h4>
                        </div>
                      </a>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="card-body">
                          <label>Presentation Description <small>(optional)</small></label>
                            <div class="form-group">
                              <textarea class="form-control" rows="3" name="presentation_description"></textarea>
                            </div>
                            <div class="row">
                              <div class="col-lg-10">
                                <!-- <div class="form-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="presentation_file[0]" multiple>
                                    <label class="custom-file-label" for="customFile" style="overflow-y: auto;">Choose Image File</label>
                                  </div>
                                </div> -->
                              </div>
                              <div class="col-lg-2">
                                <div class="form-group">
                                  <button type="button" class="btn btn-success w-100 add_image"><i class="fas fa-plus fa-lg"></i></button>
                                </div>
                              </div>
                              <div class="col-lg-12 another_image_slot"></div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  <div class="form-group">
                    <button type="submit" name="save" class="btn btn-success float-right">Save &nbsp;<i class="fa fa-save"></i></button>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- col-lg-7 -->
           </div>
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

  <?php include 'dist/layout/script.php'; ?>

  <?php  
    $obj = new Controller;

    $last_set = $obj->view('LessonPresentationsView');
  ?>

  <!-- Script -->
  <!-- DataTables -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
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
        "lengthMenu": [[5, 10, 20], [5, 10, 20]]
      });

      bsCustomFileInput.init();      
    });

    var video_count = 0;
    var presentation_count = 0;
    var last_set_no = '<?php echo $last_set->get_last_no_set(); ?>';

    $(".add_video").click(function() {
      video_count++;
      
      $(".another_video_slot").append('<div class="col-lg-12"><div class="form-group"><div class="custom-file"><input type="file" class="custom-file-input" name="video_file['+video_count+']" required><label class="custom-file-label" for="customFile">Choose Video File</label></div></div></div>');

      bsCustomFileInput.init();
    });

    $(".add_image").click(function() {
      presentation_count++;
      last_set_no++;

      $(".another_image_slot").append('<div class="row"><div class="col-lg-10"><div class="form-group"><div class="custom-file"><input type="file" class="custom-file-input" name="presentation_file['+last_set_no+'][]" id="presentation_file" required multiple><label class="custom-file-label" style="overflow-y: auto;" for="customFile">Choose Multiple Files '+presentation_count+'</label></div></div></div><div class="col-lg-2"><input type="text" class="form-control" name="set_id[]" value="'+last_set_no+'" style="text-align: center;" maxlength="2" required readonly></div></div>');

      bsCustomFileInput.init();
    });
  </script>

</body>
</html>
