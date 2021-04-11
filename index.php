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

    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-xl-6">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h5>Great Writing, Simplified</h5>
                            <h1>Making Yourself Better</h1>
                            <p>Compose bold, clear, mistake-free writing with Grammarly’s AI-powered writing assistant.</p>
                            <a href="lessons.php" class="btn_2 ml-0">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    <!-- feature_part start-->
    <!-- <section class="feature_part">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xl-3 align-self-center">
                    <div class="single_feature_text">
                        <h2>Awesome <br> Feature</h2>
                        <p>Set have great you male grass yielding an yielding first their you're
                            have called the abundantly fruit were man </p>
                        <a href="#" class="btn_1">Read More</a>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="single_feature">
                        <div class="single_feature_part">
                            <span class="single_feature_icon"><i class="ti-layers"></i></span>
                            <h4>Writing Assistant</h4>
                            <p>Use our AI-powered product to strengthen your writing and say what you really mean.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="single_feature">
                        <div class="single_feature_part">
                            <span class="single_feature_icon"><i class="ti-new-window"></i></span>
                            <h4>Cutting-Edge Tech</h4>
                            <p>Variety of innovative approaches — including advanced machine learning and deep learning.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="single_feature">
                        <div class="single_feature_part single_feature_part_2">
                            <span class="single_service_icon style_icon"><i class="ti-light-bulb"></i></span>
                            <h4>Job Oppurtunity</h4>
                            <p>Set have great you male grasses yielding yielding first their to called deep
                                abundantly Set have great you male</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- upcoming_event part start-->

    <!-- member_counter counter start -->
    <section class="member_counter">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="single_member_counter">
                        <span class="counter">
                        <?php
                        $obj = new Controller;

                        $view = $obj->view('TeachersView');
                        echo $view->public_dashboard_teacher(2, 'Active');
                        ?>
                        </span>
                        <h4>Teachers</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_member_counter">
                        <span class="counter">
                        <?php
                        $obj = new Controller;

                        $view = $obj->view('StudentsView');
                        echo $view->public_dashboard_students('Active');
                        ?>
                        </span>
                        <h4>Students</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_member_counter">
                        <span class="counter">
                        <?php
                        $obj = new Controller;

                        $view = $obj->view('LessonsView');
                        echo $view->public_dashboard_lessons('Active');
                        ?>
                        </span>
                        <h4>Online Lessons</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- member_counter counter end -->

    <div class="padding_top"></div>

    <!--::review_part start::-->
    <?php
    $obj = new Controller;

    $view = $obj->view('LessonsView');
    echo $view->lessons_section('Active', 3);
    ?>
    <!--::blog_part end::-->

    <div class="padding_top"></div>

    <!-- learning part start-->
    <?php
    $obj = new Controller;

    $view = $obj->view('AboutUsView');
    echo $view->about_section(1);
    ?>
    <!-- learning part end-->

    <!-- footer part start-->
    <?php include 'include/footer.php'; ?>
    <!-- footer part end-->

    <!-- Script -->
    <?php include 'include/script.php'; ?>
</body>

</html>