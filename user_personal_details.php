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

    <!-- nice select -->
    <link rel="stylesheet" href="dist/css/nice-select.css">
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
                            <h2>Personal Details</h2>
                            <p>Home<span>/</span>Personal Details</p>
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
                  <a href="user_acc.php"><li class="list-group-item" style="border-top-left-radius: 0; border-top-right-radius: 0; border-bottom-left-radius: 0; border-bottom-right-radius: 0; font-size: 16px;">Login Details</li></a>
                  <a href="user_personal_details.php"><li class="list-group-item" style="background-color: #FF6500; color: white; border-top-left-radius: 0; border-top-right-radius: 0; border-bottom-left-radius: 0; border-bottom-right-radius: 0; font-size: 16px;">Personal Details</li></a>
                  <a href="#"><li class="list-group-item" style="border-top-left-radius: 0; border-top-right-radius: 0; border-bottom-left-radius: 0; border-bottom-right-radius: 0; font-size: 16px;">Activity Details</li></a>
                </ul>
            </div>

            <div class="col-lg-9">
                <div class="card">
                  <div class="card-body">
                    <form method="post" action="app/controller/StudentsController.php">
                        <?php  
                        $obj = new Controller;

                        $view = $obj->view('UsersView');
                        echo $view->public_personal_details($user_id);
                        ?>

                        <?php  
                        $obj = new Controller;

                        $view = $obj->view('StudentsView');
                        echo $view->public_personal_details($user_id);
                        ?>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <!--::blog_part start::-->
    <?php
    // $obj = new Controller;

    // $view = $obj->view('TeachersView');
    // echo $view->teachers_section();
    ?>
    <!--::blog_part end::-->

    <div class="padding_top"></div>

    <!-- footer part start-->
    <?php include 'include/footer.php'; ?>
    <!-- footer part end-->

    <!-- Script -->
    <?php include 'include/script.php'; ?>

    <script src="dist/js/jquery.nice-select.min.js"></script>
</body>

</html>