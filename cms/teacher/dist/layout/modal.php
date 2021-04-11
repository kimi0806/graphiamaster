<div class="modal fade" id="modal-logout">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <form action="../../app/controller/UsersController.php" method="post">
        <div class="modal-header">
          <label class="mb-0">Logout</label>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="text-muted text-center mb-0">Are you sure you want to logout now?</p>
        </div>
        <div class="modal-footer py-1">
          <button type="submit" name="logout" class="btn btn-block btn-link text-danger">Logout</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modal-password">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <label class="mb-0">Password</label>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-muted text-center">Your account password is required to perform this action.</p>
        <div class="form-group mb-0">
          <input type="password" name="current_password" class="form-control" placeholder="Current Password">
        </div>
      </div>
      <div class="modal-footer py-1">
        <button type="button" id="confirm-password" class="btn btn-block btn-link">Confirm</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->