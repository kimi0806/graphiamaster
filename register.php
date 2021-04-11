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
    <!-- Custom -->
    <style type="text/css">
        .bg-gradient-warning {
            background-image: linear-gradient(to right, #ee390f 0%, #f9b700 100%, #ee390f 100%);
        }
        /* active */
        .nav-pills .nav-link.active {
            background-image: linear-gradient(to right, #ee390f 0%, #f9b700 100%, #ee390f 100%);
        }

        /* not active */
        .nav-pills .nav-link:not(.active) {
            color: #252525 !important;
        }

        /* line 82, E:/172 Etrain Education/172_Etrain_Education_html/sass/_feature_part.scss */
        .feature_part .single_feature_part span {
            margin-bottom: unset;
            display: unset;
            position: unset;
            z-index: unset;
            width: unset;
            height: unset;
            border-radius: unset;
            text-align: unset;
            background-color: unset;
            line-height: unset;
            -webkit-transition: unset;
            transition: unset;
        }

        .feature_part .single_feature:hover span {
            background-image: unset;
        }
    </style>
</head>

<body>
    <!--::header part start::-->
    <?php include 'include/header.php'; ?>
    <!-- Header part end-->

    <!-- feature_part start-->
    <section class="feature_part single_feature_padding section_padding">
        <div class="container">
            <div class="row">
                <div class="offset-lg-1 col-lg-10">
                    <div class="single_feature shadow">
                        <div class="single_feature_part px-5">
                            <h4>Register</h4>
                            <nav class="my-5">
                                <div class="nav nav-pills nav-justified" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link rounded-0 active" style="padding: 12px 0;" id="nav-student-tab" data-toggle="tab" href="#nav-student" role="tab" aria-controls="nav-student" aria-selected="true">Student</a>
                                    <a class="nav-item nav-link rounded-0" style="padding: 12px 0;" id="nav-teacher-tab" data-toggle="tab" href="#nav-teacher" role="tab" aria-controls="nav-teacher" aria-selected="false">Teacher</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-student" role="tabpanel" aria-labelledby="nav-student-tab">
                                    <form action="app/controller/UsersController.php" method="post" enctype="multipart/form-data" class="form-contact text-left">
                                        <input type="hidden" name="user_type_id" value="3">
                                        <label class="text-uppercase text-secondary">Personal Details<span class="text-danger ml-1">*</span></label>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group mb-3">
                                                    <input type="text" name="given_name" class="form-control" placeholder="First Name" required="">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group mb-3">
                                                    <input type="text" name="middle_name" class="form-control" placeholder="Middle Name">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group mb-3">
                                                    <input type="text" name="family_name" class="form-control" placeholder="Last Name" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="text-uppercase text-secondary">Mobile Number<span class="text-danger ml-1">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text text-white bg-gradient-warning">+63</label>
                                                        </div>
                                                        <input type="text" name="mobile_number" class="form-control" data-inputmask='"mask": "999 9999 999"' data-mask required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-0">
                                                    <label class="text-uppercase text-secondary">Birth Date<span class="text-danger ml-1">*</span></label>
                                                    <input type="date" name="date_of_birth" class="form-control" placeholder="Birth Date" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="text-uppercase text-secondary">Sex<span class="text-danger ml-1">*</span></label>
                                                <div class="form-group form-select mb-0">
                                                    <select name="sex" class="form-control" required="">
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group mb-3">
                                            <label class="text-uppercase text-secondary">Create your login details<span class="text-danger ml-1">*</span></label>
                                            <input type="email" name="email_address" class="form-control" placeholder="Email Address" required="">
                                            <small class="text-muted">Make sure that the email used is existing and active.</small>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                                                    <small class="text-muted">Enter at least 8 characters.</small>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required="">
                                                    <small class="text-muted">Re-type your password.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <label class="text-uppercase text-secondary">Educational Background<span class="text-danger ml-1">*</span></label>
                                        <div class="form-group form-select">
                                            <select name="educational_attainment" class="form-control mb-3" required="">
                                                <option selected="" disabled="">Highest Educational Attainment</option>
                                                <option>Elementary</option>
                                                <option>High School</option>
                                                <option>Post Secondary</option>
                                                <option>College</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-0">
                                            <textarea name="school_attended" class="form-control" rows="3" placeholder="Last School Attended"></textarea>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="text-uppercase text-secondary">Teacher<span class="text-danger ml-1">*</span></label>
                                                <div class="form-group form-select">
                                                    <?php
                                                    $obj = new Controller;

                                                    $view = $obj->view('TeachersView');
                                                    echo $view->teachers_select(2, 'Active');
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="text-uppercase text-secondary">Section<span class="text-danger ml-1">*</span></label>
                                                <div id="sections-select" class="form-group form-select">
                                                    <select name="section_id" class="form-control" required="">
                                                        <option selected="" disabled="">Select your Section</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                             <div class="offset-lg-8 col-lg-4">
                                                <button type="submit" name="register" class="button btn-block btn_1 shadow rounded-0">Register</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="nav-teacher" role="tabpanel" aria-labelledby="nav-teacher-tab">
                                     <form action="app/controller/UsersController.php" method="post" enctype="multipart/form-data" class="form-contact text-left">
                                        <input type="hidden" name="user_type_id" value="2">
                                        <label class="text-uppercase text-secondary">Personal Details<span class="text-danger ml-1">*</span></label>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group mb-3">
                                                    <input type="text" name="given_name" class="form-control" placeholder="First Name" required="">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group mb-3">
                                                    <input type="text" name="middle_name" class="form-control" placeholder="Middle Name">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group mb-3">
                                                    <input type="text" name="family_name" class="form-control" placeholder="Last Name" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="text-uppercase text-secondary">Mobile Number<span class="text-danger ml-1">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text text-white bg-gradient-warning">+63</label>
                                                        </div>
                                                        <input type="text" name="mobile_number" class="form-control" data-inputmask='"mask": "999 9999 999"' data-mask required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-0">
                                                    <label class="text-uppercase text-secondary">Birth Date<span class="text-danger ml-1">*</span></label>
                                                    <input type="date" name="date_of_birth" class="form-control" placeholder="Birth Date" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group form-select mb-0">
                                                    <label class="text-uppercase text-secondary">Sex<span class="text-danger ml-1">*</span></label>
                                                    <select name="sex" class="form-control form-select" style="width: 100%;" required="">
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group mb-3">
                                            <label class="text-uppercase text-secondary">Create your login details<span class="text-danger ml-1">*</span></label>
                                            <input type="email" name="email_address" class="form-control" placeholder="Email Address" required="">
                                            <small class="text-muted">Make sure that the email used is existing and active.</small>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                                                    <small class="text-muted">Enter at least 8 characters.</small>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required="">
                                                    <small class="text-muted">Re-type your password.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <label class="text-uppercase text-secondary">School Background<span class="text-danger ml-1">*</span></label>
                                        <div class="form-group form-select">
                                            <select name="type_of_school" class="form-control form-select mb-3" style="width: 100%;" required="">
                                                <option selected="" disabled="">Type of School</option>
                                                <option>Public</option>
                                                <option>Private</option>
                                                <option>Semi-Private</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input name="school_name" class="form-control" placeholder=" School Name" required="">
                                        </div>
                                        <div class="form-group mb-3">
                                            <textarea name="school_address" class="form-control" rows="3" placeholder="Please Input Your Complete School Address" required=""></textarea>
                                        </div>
                                        <hr>
                                         <label class="text-uppercase text-secondary">Requirements<span class="text-danger ml-1">*</span></label>
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <img src="storage/pictures/identity_cards/Test-ID 1.jpg" class="img-thumbnail">
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="form-group">
                                                            <label class="text-sm text-uppercase text-muted font-weight-bold">ID Copy</label>
                                                            <span class="text-sm text-muted font-weight-bold">(Scanned or Picture)</span>
                                                            <div class="custom-file">
                                                                <input type="file" id="first-valid-id" name="identity_photo" class="custom-file-input" required="">
                                                                <label class="custom-file-label" for="first-valid-id">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="offset-lg-8 col-lg-4">
                                                <button type="submit" name="register" class="button btn-block btn_1 shadow rounded-0">Register</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- upcoming_event part start-->

    <!-- footer part start-->
    <?php include 'include/footer.php'; ?>
    <!-- footer part end-->

    <!-- Script -->
    <?php include 'include/script.php'; ?>
    <!-- nice select -->
    <script src="dist/js/jquery.nice-select.min.js"></script>
    <!-- Custom -->
    <script type="text/javascript">
        $('select[name=teacher_user_id]').on('change', function () {
            var teacher_user_id = $(this).val();
            
            $.ajax({
                url: 'app/controller/SectionsController.php',
                method: 'post',
                data: {load_sections_select: '', teacher_user_id: teacher_user_id, status: 'Active'},
                success: function (response) {
                    var options = JSON.parse(response);

                    $('#sections-select').html(options);
                }
            });
        })
    </script>
</body>

</html>