<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-dark elevation-3">
  <!-- Brand Logo -->
  <a href="#" class="brand-link bg-dark d-flex justify-content-between">
    <span class="brand-text font-weight-light" style="margin-left: 12.8px;">EssayGear</span>
    <span class="mx-3" data-widget="pushmenu" href="#" role="button"><i class="fas fa-times"></i></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../../storage/pictures/users/default-m.png" class="elevation-1 mt-2" alt="User Image">
      </div>
      <div class="info">
        <?php
        $obj = new Controller;

        $teacher_id = (isset($_SESSION['USER_INFO']['user_id'])) ? $_SESSION['USER_INFO']['user_id'] : 0;

        $view = $obj->view('TeachersView');
        echo $view->list_login_info($teacher_id);
        ?>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Menu
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="users.php" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Students</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="sections.php" class="nav-link">
                <i class="nav-icon fas fa-door-open"></i>
                <p>Sections</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="lessons.php" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>Lessons</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="activities.php" class="nav-link">
                <i class="nav-icon fas fa-tasks"></i>
                <p>Activities</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="per_students.php" class="nav-link">
                <i class="nav-icon fas fa-folder-open"></i>
                <p>My Student Activities</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="recycle_bin.php" class="nav-link">
                <i class="nav-icon fas fa-trash"></i>
                <p>Recycle Bin</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>