<?php  
/**
 * 
 */
class SectionsView extends Database
{
	// Variable

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function list_of_sections($teacher_user_id, $status)
	{
		$sqlone = "SELECT * FROM users WHERE id = ? AND status = ?";

		$stmtone = $this->mysql->prepare($sqlone);

		$stmtone->bind_param("is", $teacher_user_id, $status);

		$html = '';

		$html = <<<HTML
		<table class="table table-bordered table-hover table-sm dt-default">
		<thead>
		<tr>
		<th>Section</th>
		<th>Status</th>
		<th colspan="2">Date created</th>
		<th width="120">Action</th>
		</tr>
		</thead>
		<tbody>
		HTML;

		if ($stmtone->execute()) 
		{
			$resultone = $stmtone->get_result();

			$dataone = $resultone->fetch_assoc();

			$teacher_user_id = $dataone['id'];

			$sqltwo = "SELECT * FROM sections WHERE user_id = ? AND status = ?";

			$stmttwo = $this->mysql->prepare($sqltwo);

			$stmttwo->bind_param("is", $teacher_user_id, $status);

			if ($stmttwo->execute()) 
			{
				$resulttwo = $stmttwo->get_result();

				while ($datatwo = $resulttwo->fetch_assoc()) 
				{
					extract($datatwo);

					$display = ($id == 1) ? 'd-none' : '';
					$parsed_date = date_parse($created_at);
					$year_and_month = $parsed_date['year'] . '-' . $parsed_date['month'];
					$badge_type = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'badge-success' : 'badge-secondary';
					$date_status = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'New' : 'Old';

					$html .= <<<HTML
					<tr>
					<td>$name</td>
					<td>$status</td>
					<td>$created_at</td>
					<td align="center">
					<label class="badge badge-pill $badge_type">$date_status</label>
					</td>
					<td align="center">
					<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-details-$id">
					<i class="fas fa-info-circle"></i>
					</button>
					<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit-details-$id">
					<i class="fas fa-edit"></i>
					</button>
					<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-remove-$id">
					<i class="fas fa-times-circle"></i>
					</button>
					</td>
					</tr>
					HTML;
				}
			}

			$stmttwo->close();
		}

		$html .= <<<HTML
			</tbody>
		</table>
		HTML;

		$stmtone->close();

		return $html;
	}

	public function mdl_section_details($user_id, $status)
	{
		$sql = "SELECT * FROM sections WHERE user_id=? AND status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $user_id, $status);

		$html = '';

		if ($stmt->execute())
		{
			$result = $stmt->get_result();

			while ($data = $result->fetch_assoc()) 
			{
				extract($data);

				$html .= <<<HTML
				<div class="modal fade" id="modal-details-$id">
				<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">$name Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
				<div class="card card-widget widget-user-2">
				<div class="widget-user-header bg-info">
				<div>
				<h3 class="widget-user-username ml-0"><i class="fas fa-door-open fa-xl" style='font-size:48px;'></i> $name</h3>
				</div>
				<!-- /.widget-user-image -->
				</div>
				<div class="card-footer p-0">
				<ul class="nav flex-column">
				<li class="nav-item">
				<label class="text-muted nav-link">Description</label> 
				<p class="nav-link">$description</p>
				</li>
				<li class="nav-item">
				<label class="text-muted nav-link">Status</label> 
				<span class="badge bg-warning ml-3 mb-3">$status</span>
				</li>
				</ul>
				</div>
				</div>
				<!-- /.widget-user -->
				</div>
				<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
				</div>
				</div>
				</div>
				</div>
				HTML;
			}
		}
		$stmt->close();

		return $html;
	}

	public function mdl_update_section_data($user_id, $status)
	{
		$sql = "SELECT * FROM sections WHERE user_id=? AND status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $user_id, $status);

		$html = '';

		if ($stmt->execute())
		{
			$result = $stmt->get_result();

			while ($data = $result->fetch_assoc()) 
			{
				extract($data);

				$html .= <<<HTML
				<div class="modal fade" id="modal-edit-details-$id">
				<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Edit Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<form method="post" action="../../app/controller/SectionsController.php">
				<div class="modal-body">
				<input type="hidden" name="id" value="$id">
				<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="section_name" placeholder="Enter ..." value="$name">
				</div>
				<div class="form-group">
				<label>Description</label>
				<textarea class="form-control" rows="3" name="section_desc" placeholder="Enter ...">$description</textarea>
				</div>
				<div class="form-group">
				<label>Status</label>
				<select class="custom-select" name="section_status" required>
				<option value="$status" readonly selected>$status</option>
				<option value="Active">Active</option>
				<option value="Inactive">Inactive</option>
				</select>
				</div>
				</div>
				<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" name="section_update" class="btn btn-primary">Save changes</button>
				</div>
				</form>
				</div>
				</div>
				</div>
				HTML;
			}
		}
		$stmt->close();

		return $html;
	}

	public function remove_modal($user_id, $status)
	{
		$sql = "SELECT * FROM sections WHERE user_id=? AND status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $user_id, $status);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) {
				extract($row);

				$html .= <<<HTML
				<div class="modal fade" id="modal-remove-$id">
					<div class="modal-dialog modal-sm modal-dialog-centered">
						<div class="modal-content">
							<form action="../../app/controller/SectionsController.php" method="post">
								<div class="modal-header">
									<label class="mb-0">Remove</label>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<input type="hidden" name="id" value="$id">
									<p class="text-muted text-center mb-0">Are you sure you want to remove this $name?</p>
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

	public function sections_select($user_id, $status)
	{
		$sql = "SELECT * FROM sections WHERE user_id=? AND status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $user_id, $status);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			$html .= <<<HTML
			<select name="section_id" class="form-control" required="">
				<option selected="" disabled="">Select your Section</option>
			HTML;

			if ($stmt_result->num_rows > 0) {

				while ($row = $stmt_result->fetch_assoc()) {
					extract($row);

					$html .= <<<HTML
					<option value="$id">$name</option>
					HTML;
				}
			}

			$html .= <<<HTML
			</select>
			HTML;
		}

		$stmt->close();

		return $html;
	}

	// Unused Function Dont delete
	public function select_section($status)
	{
		$sql = "SELECT * FROM sections WHERE status = ?";

		$stmt = $this->mysql->prepare($sql);

		$stmt->bind_param("s", $status);

		$html = '';

		if ($stmt->execute()) 
		{
			$result = $stmt->get_result();

			while ($data = $result->fetch_assoc()) 
			{
				extract($data);

				$html .= <<<HTML
				<option value="$id">$name</option>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function class_by_section($user_id, $status)
	{
		$sql = "SELECT *, sections.id AS section_id, sections.status AS section_status, sections.created_at AS section_created_at, COUNT(students.id) AS student_count FROM sections LEFT JOIN students ON sections.id=students.section_id WHERE sections.user_id=? AND sections.status=? GROUP BY sections.id";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $user_id, $status);

		$html = <<<HTML
		<table class="table table-bordered table-hover table-sm dt-default">
			<thead>
				<tr>
					<th>Section</th>
					<th>Total Student</th>
					<th>Status</th>
					<th colspan="2">Date created</th>
					<th width="100">Action</th>
				</tr>
			</thead>
			<tbody>
		HTML;

		if ($stmt->execute()) 
		{
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) 
			{
				extract($row);

				$parsed_date = date_parse($section_created_at);
				$year_and_month = $parsed_date['year'] . '-' . $parsed_date['month'];
				$badge_type = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'badge-success' : 'badge-secondary';
				$date_status = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'New' : 'Old';

				$html .= <<<HTML
				<tr>
					<td>$name</td>
					<td><label class="badge badge-pill $badge_type">$student_count</label> &nbsp;Students</td>
					<td>$section_status</td>
					<td>$section_created_at</td>
					<td align="center">
						<label class="badge badge-pill $badge_type">$date_status</label>
					</td>
					<td align="center">
						<a class="btn btn-sm btn-info" href="students.php?sections_id=$section_id"><i class="fas fa-users"></i></a>
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

	public function dashboard_sections($teacher_user_id, $status)
	{
		$sqlone = "SELECT * FROM users WHERE id = ? AND status = ?";

		$stmtone = $this->mysql->prepare($sqlone);

		$stmtone->bind_param("is", $teacher_user_id, $status);

		$html = '';

		if ($stmtone->execute()) 
		{
			$resultone = $stmtone->get_result();

			$dataone = $resultone->fetch_assoc();

			$teacher_user_id = $dataone['id'];

			$sqltwo = "SELECT * FROM sections WHERE user_id = ? AND status = ?";

			$stmttwo = $this->mysql->prepare($sqltwo);

			$stmttwo->bind_param("is", $teacher_user_id, $status);

			if ($stmttwo->execute())
			{
				$resulttwo = $stmttwo->get_result();

				$count = $resulttwo->num_rows;
				
				$html .= <<<HTML
				<div class="inner">
				<h3>$count</h3>
				<p>Sections</p>
				</div>
				HTML;
			}

			$stmttwo->close();
		}

		$stmtone->close();

		return $html;
	}

}
?>