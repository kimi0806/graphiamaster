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
                            <h2>Lessons</h2>
                            <p>Home<span>/</span>Lessons</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <div class="padding_top"></div>

    <!--::review_part start::-->
    <?php
    $obj = new Controller;

    $view = $obj->view('LessonsView');
    echo $view->lessons_section('Active', 30);
    ?>
    <!--::blog_part end::-->

    <div class="padding_top"></div>

    <!-- footer part start-->
    <?php include 'include/footer.php'; ?>
    <!-- footer part end-->

    <!-- Script -->
    <?php include 'include/script.php'; ?>
</body>

</html>