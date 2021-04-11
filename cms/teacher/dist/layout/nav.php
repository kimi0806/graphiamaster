<nav class="main-header navbar navbar-expand-md navbar-dark navbar-dark">
  <div class="container">
    <a href="dashboard.php" class="navbar-brand">
      <!-- <img src="../../dist/img/logo/essay_gear.png" alt="cms logo" class="brand-image img-circle elevation-3"> -->
      <span class="brand-text font-weight-light"> CMS</span>
    </a>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </div>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <!-- <?php 
        // $obj = new Controller;

        // $view = $obj->view('NotificationsView');
        // $view_result = $view->load_notifications(1);

        // extract($view_result);

        // echo <<<HTML
        // <a class="nav-link" id="notification-link" data-toggle="dropdown" href="#">
        //   <i class="far fa-bell"></i>
        //   <span id="notification-count" class="badge badge-warning navbar-badge">$count</span>
        // </a>
        // <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
        //   <span class="dropdown-header pt-1 pb-0"></span>
        //   <div id="notification-container">$html</div>
        //   <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        // </div>
        // HTML;
        ?> -->
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right m-0">
          <span class="dropdown-header pt-1 pb-0"></span>
          <a href="settings.php#" class="dropdown-item">
            Account Settings
            <span class="float-right text-muted text-sm">
              <i class="fas fa-user-circle mt-1"></i>
            </span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-logout">
            Logout
            <span class="float-right text-muted text-sm">
              <i class="fas fa-sign-out-alt mt-1"></i>
            </span>
          </a><div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Close</a>
        </div>
      </li>
    </ul>
  </div>
</nav>