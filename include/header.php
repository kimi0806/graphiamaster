<header class="main_menu home_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.php"><img src="dist/img/logo/essay_gear.png" alt="" height="50"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse main-menu-item justify-content-end"
                        id="navbarSupportedContent">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="teachers.php">Teachers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="lessons.php">Lessons</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.php">About</a>
                            </li>
                            <?php
                            $obj = new Controller;

                            $user_id = (isset($_SESSION['USER_INFO']['user_id'])) ? $_SESSION['USER_INFO']['user_id'] : 0;

                            $view = $obj->view('UsersView');
                            echo $view->list_login_info($user_id);
                            ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

<div class="modal fade" id="modal-logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="p-5">
                    <form action="app/controller/UsersController.php" method="post">
                        <div class="wow fadeInUp" data-wow-delay="250ms">
                            <h4 class="text-warning">Logout</h4>
                            <p class="font-weight-light text-secondary">Are you sure you want to logout now?</p>
                            <button type="submit" name="logout" class="btn btn_1 ml-0 shadow mt-3 w-100">Yes</button>
                            <button type="button" class="btn btn_1 ml-0 shadow mt-3 w-100" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>