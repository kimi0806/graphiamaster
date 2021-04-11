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
    <!-- Language Tool -->
  <script type="text/javascript" src="https://www.languagetool.org/js/jquery-1.7.0.min.js"></script>
  <script type="text/javascript" src="https://www.languagetool.org/online-check/tiny_mce/tiny_mce.js"></script>
  <script type="text/javascript" src="https://www.languagetool.org/online-check/tiny_mce/plugins/atd-tinymce/editor_plugin2.js"></script>
  <script language="javascript" type="text/javascript">  
    tinyMCE.init({
      mode : "textareas",
      plugins : "AtD,paste",
      paste_text_sticky : true,
      setup : function(ed) {
        ed.onInit.add(function(ed) {
          ed.pasteAsPlainText = true;
        });
      },  
      /* translations: */
      languagetool_i18n_no_errors : {
      // "No errors were found.":
      "de-DE": "Keine Fehler gefunden."
      },
      languagetool_i18n_explain : {
      // "Explain..." - shown if there is an URL with a detailed description:
      "de-DE": "Mehr Informationen..."
      },
      languagetool_i18n_ignore_once : {
      // "Ignore this error":
      "de-DE": "Hier ignorieren"
      },
      languagetool_i18n_ignore_all : {
      // "Ignore this kind of error":
      "de-DE": "Fehler dieses Typs ignorieren"
      },
      languagetool_i18n_rule_implementation : {
      // "Rule implementation":
      "de-DE": "Implementierung der Regel"
      },

      languagetool_i18n_current_lang :
      
      function() { 
        return document.checkform.lang.value; 
      },
      /* The URL of your LanguageTool server.
      If you use your own server here and it's not running on the same domain 
      as the text form, make sure the server gets started with '--allow-origin ...' 
      and use 'https://your-server/v2/check' as URL: */
      languagetool_rpc_url               : "https://languagetool.org/api/v2/check",
      /* edit this file to customize how LanguageTool shows errors: */
      languagetool_css_url               : "https://www.languagetool.org/online-check/" + "tiny_mce/plugins/atd-tinymce/css/content.css",
      /* this stuff is a matter of preference: */
      theme                              : "advanced",
      theme_advanced_buttons1            : "",
      theme_advanced_buttons2            : "",
      theme_advanced_buttons3            : "",
      theme_advanced_toolbar_location    : "none",
      theme_advanced_toolbar_align       : "left",
      theme_advanced_statusbar_location  : "bottom",
      theme_advanced_path                : false,
      theme_advanced_resizing            : true,
      theme_advanced_resizing_use_cookie : false,
      gecko_spellcheck                   : false
    });

    function doit() {
      var langCode = document.checkform.lang.value;
      tinyMCE.activeEditor.execCommand("mceWritingImprovementTool", langCode);
    }
  </script>
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
              <h5 class="text-muted mb-0">My Students</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <?php
                $obj = new Controller;

                $teacher_user_id = (isset($_SESSION['USER_INFO']['user_id'])) ? $_SESSION['USER_INFO']['user_id'] : 0;

                $view = $obj->view('StudentsView');
                echo $view->students($teacher_user_id, 'Active');
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

    $view = $obj->view('StudentsView');
    echo $view->student_information_mdl($teacher_user_id, 'Active');
    echo $view->remove_modal($teacher_user_id, 'Active');
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
      $(".dt-default").DataTable({
        "responsive": true,
        "autoWidth": false,
      });

      $('.select2bs4').select2({
        theme: 'bootstrap4'
      });
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
