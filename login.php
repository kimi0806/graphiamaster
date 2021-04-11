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

    <div class="padding_top"></div>

    <!-- feature_part start-->
    <section class="feature_part py-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="single_feature shadow">
                        <div class="single_feature_part">
                            <span class="single_feature_icon"><i class="ti-user"></i></span>
                            <h4>Login</h4>
                            <p>Login to start your session.</p>
                            <form class="form-contact mt-4" action="app/controller/UsersController.php" method="post">
                                <div class="form-group">
                                    <input type="email" name="email_address" class="form-control" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <a href="register.php">
                                            <button type="button" class="btn btn-block btn_2 border-0 rounded-0">Register</button>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" name="login" class="btn btn-block btn_1 rounded-0">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block d-xl-block">
                    <img src="dist/img/advance_feature_img.png" class="img-fluid" alt="">
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
</body>

</html>