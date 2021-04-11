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

    <!-- Reveal CSS (dont move!) -->
    <link rel="stylesheet" href="reveal_JS/dist/reset.css">

    <!-- Link -->
    <?php include 'include/link.php'; ?>

    <!-- Reveal CSS -->
    <link rel="stylesheet" href="reveal_JS/dist/theme/league.css" id="theme">
    <!-- Theme used for syntax highlighted code -->
    <link rel="stylesheet" href="reveal_JS/plugin/highlight/monokai.css" id="highlight-theme">
    <link rel="stylesheet" href="reveal_JS/dist/reveal.css">

    <!-- Custom -->
    <style type="text/css">
        /* active */
        .nav-pills .nav-link.active {
            background-image: linear-gradient(to right, #ee390f 0%, #f9b700 100%, #ee390f 100%);
        }

        /* not active */
        .nav-pills .nav-link:not(.active) {
            color: #ffffff !important;
            background-color: #ee390f;
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
                            <h2>Lesson</h2>
                            <p>Home<span>/</span>Lesson</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================ Start Course Details Area =================-->
    <section class="course_details_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 course_details_left">
                    <?php
                    $obj = new Controller;

                    $view = $obj->view('LessonsView');

                    if (isset($_GET['lesson_id'])) {
                        echo $view->lesson_top_info($_GET['lesson_id']);
                    }
                    ?>
                    <div class="content_wrapper">
                        <nav class="my-5">
                            <div class="nav nav-pills nav-justified" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link rounded-0 active" style="padding: 14px 0;" id="nav-overview-tab" data-toggle="tab" href="#nav-overview" role="tab" aria-controls="nav-overview" aria-selected="true">Overview</a>
                                <a class="nav-item nav-link rounded-0" style="padding: 14px 0;" id="nav-video-tab" data-toggle="tab" href="#nav-video" role="tab" aria-controls="nav-video" aria-selected="false">Video Lessons</a>
                                <a class="nav-item nav-link rounded-0" style="padding: 14px 0;" id="nav-presentation-tab" data-toggle="tab" href="#nav-presentation" role="tab" aria-controls="nav-presentation" aria-selected="false">Presentation</a>
                            </div>
                        </nav>

                        <?php
                        $obj = new Controller;

                        $view = $obj->view('LessonsView');

                        if (isset($_GET['lesson_id'])) {
                            echo $view->lesson_tab_content($_GET['lesson_id']);

                            $preview_id = $_GET['lesson_id']- 1;
                            $next_id = $_GET['lesson_id'] + 1;

                            echo $view->lesson_navigation($preview_id, $next_id);
                        }
                        ?>
                    </div>
                </div>

                <div class="col-lg-4 right-contents">
                    <div class="sidebar_top">

                        <?php if (empty($_SESSION['USER_INFO']['user_id'])): ?>
                       <!--  <ul class="lesson-sidebar-info">
                            <li>
                                <img src="$file_path/$file_name" class="border mb-3" style="height: 70px;">
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Teacher’s Name</p>
                                    <span class="color">$given_name $family_name</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Activity</p>
                                    <span>$activity_count</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Date</p>
                                    <span>$month_created $date_created, $year_created</span>
                                </a>
                            </li>
                        </ul> -->
                        <a href="login.php"><input type="button" class="btn btn_1 d-block w-100" value="Sign In"/></a>

                        <?php else: ?>

                        <?php
                        $obj = new Controller;

                        $view = $obj->view('LessonsView');

                        if (isset($_GET['lesson_id'])) {
                        echo $view->lesson_sidebar_info($_GET['lesson_id']);
                        }
                        ?>

                        <?php endif; ?>
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
    <!--================ End Course Details Area =================-->

    <!-- footer part start-->
    <?php include 'include/footer.php'; ?>
    <!-- footer part end-->

    <!-- Script -->
    <?php include 'include/script.php'; ?>

    <script src="reveal_JS/dist/reveal.js"></script>
    <script src="reveal_JS/plugin/notes/notes.js"></script>
    <script src="reveal_JS/plugin/markdown/markdown.js"></script>
    <script src="reveal_JS/plugin/highlight/highlight.js"></script>
    <script>
    $(document).ready(function () {
        document.querySelector( '.reveal' ).style.width = '45vw';
        document.querySelector( '.reveal' ).style.height = '60vh';

        Reveal.initialize({
            hash: true,
            width: 800,
            height: 600,
            center: true,
            embedded: true,
            overview: true,
            controls: true,
            slideNumber: true,
            controlsTutorial: true,
            slideNumber: 'c/t',
            controlsLayout: 'bottom-left',
            backgroundTransition: 'zoom',

            plugins: [ RevealMarkdown, RevealHighlight, RevealNotes ]
        });

        Reveal.configure({ 
            autoSlide: 50000,
            mouseWheel: false,
        });

        Reveal.layout();
    });
    </script>
</body>

</html>