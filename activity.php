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
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Form Wizard -->
    <link rel="stylesheet" href="plugins/formwizard/css/style.css">
    <!-- Custom -->
    <style type="text/css">
        .other-lessons {
            margin-top: 0;
        }

        #progressbar li {
            width: unset;
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background-image: linear-gradient(to top, #ee390f 0%, #f9b700 50%, #ee390f 100%);
        }
    </style>
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
                            <h2>Essay</h2>
                            <p>Home<span>/</span>Essay</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!-- feature_part start-->
    <section class="feature_part single_feature_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <?php
                    $obj = new Controller;

                    $view = $obj->view('ActivitiesView');

                    if (isset($_GET['activity_id'])) {
                        echo $view->info_card($_GET['activity_id']);

                        $view = $obj->view('ActivityItemsView');
                        echo $view->card_items($_GET['activity_id'], 'Active');
                    }
                    ?>
                    
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <?php
                        $obj = new Controller;

                        $view = $obj->view('TeachersView');
                        echo $view->other_teachers('Active', 10);
                        ?>
                    </div>
                    <div class="blog_right_sidebar">
                        <?php
                        $obj = new Controller;

                        $view = $obj->view('LessonsView');
                        echo $view->other_lessons('Active', 5);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- upcoming_event part start-->

    <div class="padding_top"></div>

    <!-- footer part start-->
    <?php include 'include/footer.php'; ?>
    <!-- footer part end-->
    <!-- Script -->
    <?php include 'include/script.php'; ?>
    <!-- Form Wizard -->
    <script src="plugins/formwizard/js/main.js"></script>
</body>

</html>