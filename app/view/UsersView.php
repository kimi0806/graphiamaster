<?php
/**
 * 
 */
class UsersView extends Database
{
	public $id;
	public $user_type_id;
	public $family_name;
	public $given_name;
	public $middle_name;
	public $email_address;
	public $password;
	public $status;
	public $created_at;
	public $updated_at;

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function list_login_info($id)
	{
		$sql = "SELECT * FROM users WHERE id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $id);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows > 0) {
				$row = $stmt_result->fetch_assoc();

				extract($row);

				$html = <<<HTML
				<li class="d-none d-lg-block">
					<a class="btn btn_1 ml-3" href="user_acc.php">$given_name $family_name</a>
					<a class="btn btn_1 ml-0" href="#" data-toggle="modal" data-target="#modal-logout">Logout</a>
				</li>
				HTML;
			}
			else {
				$html = <<<HTML
				<li class="d-none d-lg-block">
					<a class="btn btn_1 ml-3" href="login.php">Login</a>
					<a class="btn btn_1 ml-0" href="register.php">Register</a>
				</li>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function remove_modal($status)
	{
		$sql = "SELECT * FROM users WHERE status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("s", $status);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) {
				extract($row);

				$html .= <<<HTML
				<div class="modal fade" id="modal-remove-$id">
					<div class="modal-dialog modal-sm modal-dialog-centered">
						<div class="modal-content">
							<form action="../../app/controller/UsersController.php" method="post">
								<div class="modal-header">
									<label class="mb-0">Remove</label>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<input type="hidden" name="id" value="$id">
									<p class="text-muted text-center mb-0">Are you sure you want to remove this $given_name $family_name?</p>
								</div>
								<div class="modal-footer py-1">
									<button type="submit" name="remove" class="btn btn-block btn-link text-danger">Yes, remove it!</button>
								</div>
							</form>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function table($status)
	{
		$sql = "SELECT * FROM users WHERE status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("s", $status);

		$html = <<<HTML
		<table class="table table-bordered table-hover table-sm dt-default">
			<thead>
				<tr>
					<th>User ID</th>
					<th>Name</th>
					<th>Email</th>
					<th colspan="2">Date created</th>
					<th width="100">Action</th>
				</tr>
			</thead>
			<tbody>
		HTML;

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) {
				extract($row);

				$encrypted_id = md5($id);
				$display = ($id == 1) ? 'd-none' : '';
				$parsed_date = date_parse($created_at);
				$year_and_month = $parsed_date['year'] . '-' . $parsed_date['month'];
				$badge_type = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'badge-success' : 'badge-secondary';
				$date_status = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'New' : 'Old';

				$html .= <<<HTML
				<tr>
					<td>$encrypted_id</td>
					<td>$family_name, $given_name $middle_name</td>
					<td>$email_address</td>
					<td>$created_at</td>
					<td align="center">
						<label class="badge badge-pill $badge_type">$date_status</label>
					</td>
					<td align="center">
						<button class="btn btn-sm btn-danger $display" data-toggle="modal" data-target="#modal-remove-$id">
							<i class="fas fa-user-times"></i>
						</button>
					</td>
				</tr>
				HTML;
			}
		}

		$html .= <<<HTML
			</tbody>
		</table>
		HTML;

		$stmt->close();

		return $html;
	}

	public function update_form($id)
	{
		$sql = "SELECT * FROM users WHERE id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $id);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows == 1) {
				$row = $stmt_result->fetch_assoc();

				extract($row);

				$html = <<<HTML
				<form action="" method="">
					<div class="form-group row">
						<label class="col-lg-3 col-form-label text-muted">Full Name</label>
						<div class="col-lg-6">
							<div class="row mb-3">
								<div class="col-6">
									<input type="text" name="given_name" class="form-control" placeholder="First Name" value="$given_name">
								</div>
								<!-- /.col -->
								<div class="col-6">
									<input type="text" name="middle_name" class="form-control" placeholder="Middle Name" value="$middle_name">
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
							<input type="text" name="family_name" class="form-control" placeholder="Last Name" value="$family_name">
						</div>
						<!-- /.col -->
					</div>
					<!-- /.form-group -->
					<div class="form-group row">
						<label class="col-lg-3 col-form-label text-muted">Email Address</label>
						<div class="col-lg-6">
							<input type="email" name="email_address" class="form-control" placeholder="Email Address" value="$email_address">
						</div>
						<!-- /.col -->
					</div>
					<!-- /.form-group -->
					<div class="form-group row">
						<label class="col-lg-3 col-form-label text-muted">Change Password</label>
						<div class="col-lg-6">
							<div class="row">
								<div class="col-6">
									<input type="password" name="new_password" class="form-control" placeholder="New Password">
								</div>
								<!-- /.col -->
								<div class="col-6">
									<input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.form-group -->
					<div class="form-group row mb-0">
						<div class="offset-lg-3 col-lg-2">
							<button type="button" id="update-user" name="update" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-password">Save changes</button>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.form-group -->
				</form>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function student_name($student_id)
	{
		$query = "SELECT * FROM users WHERE id = ?";

		$stmt = $this->mysql->prepare($query);

		$stmt->bind_param("i", $student_id);

		$html = '';

		if ($stmt->execute()) 
		{
			$result = $stmt->get_result();

			while ($data = $result->fetch_assoc()) 
			{
				extract($data);

				$html .= <<<HTML
				<h5 class="card-title p-1" style="text-decoration: underline;">$given_name $middle_name $family_name - All Activities</h5>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function public_login_details($user_id)
	{
		$sql = "SELECT * FROM users WHERE id = ?";

		$stmt = $this->mysql->prepare($sql);

		$stmt->bind_param("i", $user_id);

		$html = '';

		if ($stmt->execute()) 
		{
			$result = $stmt->get_result();

			while ($data = $result->fetch_assoc()) 
			{
				extract($data);

				$html .= <<<HTML
				<input type="hidden" name="given_name" value="$given_name">
				<input type="hidden" name="middle_name" value="$middle_name">
				<input type="hidden" name="family_name" value="$family_name">
				<div class="input-group p-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Email & Username</span>
					</div>
					<input type="email" aria-label="Email" class="form-control" id="email_address" name="email_address" value="$email_address">
					<input type="text" aria-label="Username" class="form-control" id="username" name="username" value="$username">
				</div>
				<div class="input-group p-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Security Password</span>
					</div>
					<input type="password" aria-label="New Password" class="form-control" id="new_password" name="new_password"  placeholder="New Password">
					<input type="password" aria-label="Confirm Password" class="form-control" id="confirm_password" name="confirm_password" onblur="ConfirmNewPassword();" placeholder="Confirm Password">
					<div class="input-group-text" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
						<input type="checkbox" onclick="showNewPassword();" aria-label="Checkbox for following text input">
					</div>
				</div>
				<div class="input-group p-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Current Password</span>
					</div>
					<input type="password" aria-label="Current Password" class="form-control" id="current_password" name="current_password" placeholder="Enter Current Password">
					<div class="input-group-text" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
						<input type="checkbox" onclick="showCurrentPassword();" aria-label="Checkbox for following text input">
					</div>
				</div>
				<div class="p-4">
					<button type="button" class="genric-btn primary float-right" name="update_login_details" id="update_login_details">Update</button>
				</div>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function public_personal_details($user_id)
	{
		$sql = "SELECT * FROM users WHERE id = ?";

		$stmt = $this->mysql->prepare($sql);

		$stmt->bind_param("i", $user_id);

		$html = '';

		if ($stmt->execute()) 
		{
			$result = $stmt->get_result();

			while ($data = $result->fetch_assoc()) 
			{
				extract($data);

				$html .= <<<HTML
				<input type="hidden" name="users_id" value="$id">
				<div class="row p-4">
					<div class="col-lg-4">
						<label>First Name</label>
						<input type="text" name="given_name" id="given_name" class="single-input border" value="$given_name">
					</div>
					<div class="col-lg-4">
						<label>Middle Name</label>
						<input type="text" name="middle_name" id="middle_name" class="single-input border" value="$middle_name">
					</div>
					<div class="col-lg-4">
						<label>Last Name</label>
						<input type="text" name="family_name" id="family_name" class="single-input border" value="$family_name">
					</div>
				</div>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}
}
?>