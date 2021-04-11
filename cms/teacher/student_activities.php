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
              <h1 class="m-0 text-dark">Student Answers</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Student Answers</li>
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
              <h5 class="text-muted mb-0">Table</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <?php
                $obj = new Controller;

                if (isset($_GET['activity_id']) && isset($_GET['student_user_id'])) {
                  $view = $obj->view('StudentActivitiesView');
                  echo $view->taker_table($_GET['activity_id'], $_GET['student_user_id'], 'Active');
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

    if (isset($_GET['activity_id']) && isset($_GET['student_user_id'])) {
      $view = $obj->view('StudentActivitiesView');
      echo $view->update_modal($_GET['activity_id'], $_GET['student_user_id'], 'Active');
      // echo $view->view_modal($_GET['activity_id'], $_GET['student_user_id'], 'Active');
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

      // $('.summernote').summernote({
      //   height: 100
      // });
    });

    // $('button[name=check]').on('click', function () {
    //   var id = $(this).val();

    //   $.ajax({
    //     url: 'https://www.abbreviations.com/services/v2/grammar.php',
    //     method: 'get',
    //     data: {
    //       uid: '7904',
    //       tokenid: 'u2k98lXk6IHi9pou',
    //       text: $('#answer-' + id).val(),
    //       lang: 'en-US',
    //       format: 'json'
    //     },
    //     success: function (response) {
    //       var id = 1;
    //       var response = JSON.parse(response);
    //       var matches = response.matches;

    //       $('#recommendation-' + id).empty();

    //       if (matches == '') {
    //         $('#recommendation-' + id).append('<p class="text-center mb-0">No error found.</p>');
    //       }
    //       else {
    //         $.each(matches, function(matchesIndex, matchesValue) {
    //           $('#recommendation-' + id).append('<h5>'+id+'.) Error</h5>');

    //           $('#recommendation-' + id).append('<p>Sentence: <span id="sentence-'+id+'">'+matches[matchesIndex].sentence+'</span></p>');

    //           $('#recommendation-' + id).append('<p>Message: <span id="message-'+id+'">'+matches[matchesIndex].message+'</span></p>');

    //           $('#recommendation-' + id).append('<h6>Replacement(s)</h6>');

    //           $.each(matches[matchesIndex].replacements, function(replacementIndex, replacementValue) {
    //             $('#recommendation-' + id).append('<p>'+matches[matchesIndex].replacements[replacementIndex].value+'</p>');
    //           });

    //           id = id + 1;
    //         });
    //       }
    //     }
    //   });
    // })
  </script>

</body>
</html>
