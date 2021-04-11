<?php
/**
 * 
 */
class ActivitiesView extends Database
{

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function info_card($id)
	{
		$sql = "SELECT *, activities.description AS activity_description, activities.created_at AS activity_created_at FROM activities LEFT JOIN users ON activities.user_id=users.id LEFT JOIN lessons ON activities.lesson_id=lessons.id WHERE activities.id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $id);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows == 1) {
				$row = $stmt_result->fetch_assoc();

				extract($row);

				$html = <<<HTML
				<div class="card mb-3">
					<div class="card-body">
						<h2>$name</h2>
						<ul class="d-flex justify-content-between">
							<li class="text-muted mr-0"><span class="ti-user mr-2"></span>$given_name $family_name</li>
							<li class="text-muted mr-0"><span class="ti-calendar mr-2"></span>$activity_created_at</li>
						</ul>
						<hr>
						<h3>$title</h3>
						<p class="mb-3">$activity_description</p>
						<label class="font-weight-bold">Instruction:</label>
						<p>$instruction</p>
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
		$sql = "SELECT * FROM activities WHERE user_id=? AND status=?";

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
							<form action="../../app/controller/ActivitiesController.php" method="post">
								<div class="modal-header">
									<label class="mb-0">Remove</label>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<input type="hidden" name="id" value="$id">
									<p class="text-muted text-center mb-0">Are you sure you want to remove this activity?</p>
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

	public function activities($user_id, $status)
	{
		$sql = "SELECT *, activities.id AS activity_id, lessons.name AS lesson_name, COUNT(activity_items.id) AS total_activity_items FROM activities LEFT JOIN lessons ON activities.lesson_id=lessons.id LEFT JOIN activity_items ON activities.id=activity_items.activity_id WHERE activities.user_id=? AND activities.status=? AND activity_items.status='Active' GROUP BY activities.id";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $user_id, $status);

		$html = <<<HTML
		<table class="table table-bordered table-hover table-sm dt-default">
			<thead>
				<tr>
					<th>Lesson</th>
					<th>Title</th>
					<th>Description</th>
					<th>Items</th>
					<th width="100">Action</th>
				</tr>
			</thead>
			<tbody>
		HTML;

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) {
				extract($row);

				$description = substr($description, 0, 100);

				$html .= <<<HTML
				<tr>
					<td>$lesson_name</td>
					<td>$title</td>
					<td>$description &hellip;</td>
					<td><span class="badge badge-pill badge-success">$total_activity_items Item(s)</span></td>
					<td align="center">
						<a href="activity_takers.php?activity_id=$activity_id" class="btn btn-sm btn-info"><i class="fas fa-users"></i></a>
						<a href="edit_activity.php?activity_id=$activity_id" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
						<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-remove-$activity_id" style="padding-right: 11px; padding-left: 11px;">
							<i class="fas fa-times"></i>
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

	public function takers_table($activity_id, $status)
	{
		$sql = "SELECT *, student_activities.user_id AS student_user_id, COUNT(student_activities.activity_item_id) AS total_activity_items, student_activities.created_at AS student_activity_created_at FROM student_activities LEFT JOIN users ON student_activities.user_id=users.id LEFT JOIN activities ON student_activities.activity_id=activities.id WHERE student_activities.activity_id=? AND users.status=? GROUP BY student_activities.user_id";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $activity_id, $status);

		$html = <<<HTML
		<table class="table table-bordered table-hover table-sm dt-default">
			<thead>
				<tr>
					<th>Activity</th>
					<th>Student</th>
					<th>Answered Items</th>
					<th colspan="2">Date</th>
					<th width="100">Action</th>
				</tr>
			</thead>
			<tbody>
		HTML;

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) {
				extract($row);

				$parsed_date = date_parse($student_activity_created_at);
				$year_and_month = $parsed_date['year'] . '-' . $parsed_date['month'];
				$badge_type = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'badge-success' : 'badge-secondary';
				$date_status = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'New' : 'Old';

				$html .= <<<HTML
				<tr>
					<td>$title</td>
					<td>$family_name, $given_name $middle_name</td>
					<td>
						<span class="badge badge-pill badge-success">$total_activity_items Item(s)</span>
					</td>
					<td>$student_activity_created_at</td>
					<td>
						<label class="badge badge-pill $badge_type">$date_status</label>
					</td>
					<td align="center">
						<a href="student_activities.php?student_user_id=$student_user_id" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
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

	public function update_form($id, $user_id)
	{
		$sql = "SELECT * FROM activities WHERE id=? AND user_id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("ii", $id, $user_id);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows == 1) {
				$row = $stmt_result->fetch_assoc();

				extract($row);

				$html = <<<HTML
				<form action="../../app/controller/ActivitiesController.php" method="post">
					<input type="hidden" name="id" value="$id">
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="">Lessons</label>
								<select name="lesson_id" class="form-control select2bs4" style="width: 100%;">
				HTML;

				$inner_sql = "SELECT * FROM lessons WHERE user_id=? AND status=?";

				$inner_stmt = $this->mysql->prepare($inner_sql);
				$inner_stmt->bind_param("is", $user_id, $status);

				$status = 'Active';

				if ($inner_stmt->execute()) {
					$inner_stmt_result = $inner_stmt->get_result();

					while ($inner_row = $inner_stmt_result->fetch_assoc()) {
						extract($inner_row);

						$selected = ($lesson_id == $id) ? 'selected=""' : '';

						$html .= <<<HTML
						<option value="$id" $selected>$name</option>
						HTML;
					}
				}

				$html .= <<<HTML
								</select>
							</div>
							<!-- /.form-group -->
						</div>
						<!-- /.col -->
						<div class="col-lg-4">
							<div class="form-group">
								<label for="">Title</label>
								<input type="text" name="title" class="form-control" placeholder="Enter ..." value="$title">
							</div>
							<!-- /.form-group -->
						</div>
						<!-- /.col -->
						<div class="col-lg-5">
							<div class="form-group">
								<label for="">Description</label>
								<textarea name="description" class="form-control" rows="1" placeholder="Enter ...">$description</textarea>
							</div>
							<!-- /.form-group -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
					<div class="form-group">
						<label for="">Instructions</label>
						<textarea name="instruction" class="form-control summernote" rows="3" placeholder="Enter ...">$instruction</textarea>
					</div>
					<!-- /.form-group -->
					<div class="row">
						<div class="col-lg-2">
							<button type="submit" name="update" class="btn btn-block btn-primary">Save changes</button>
						</div>
					</div>
				</form>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function activities_per_lesson($teacher_user_id, $lesson_id, $status)
	{
		$queryone = "SELECT *, activities.id AS activity_id FROM activities WHERE user_id = ? AND lesson_id = ? AND status = ?";

		$stmtone = $this->mysql->prepare($queryone);

		$stmtone->bind_param("iis", $teacher_user_id, $lesson_id, $status);

		$html = '';

		$html = <<<HTML
		<table class="table table-bordered table-hover table-sm table-sm dt-default">
			<thead>
				<tr>
					<th>Title</th>
					<th>Status</th>
					<th colspan="2">Created</th>
					<th width="100">Action</th>
				</tr>
			</thead>
			<tbody>
		HTML;

		if ($stmtone->execute()) 
		{
			$resultone = $stmtone->get_result();

			while ($dataone = $resultone->fetch_assoc()) 
			{
				extract($dataone);

				$parsed_date = date_parse($status);
				$year_and_month = $parsed_date['year'] . '-' . $parsed_date['month'];
				$badge_type = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'badge-success' : 'badge-secondary';
				$date_status = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'New' : 'Old';

				$student_id = $_GET['student_id'];

				$html .= <<<HTML
				<tr>
				<td>$title</td>
				<td>$status</td>
				<td>$created_at</td>
				<td align="center">
				<label class="badge badge-pill $badge_type">$date_status</label>
				</td>
				<td align="center">
				<a href="per_lessons.php?student_id=$student_id&lesson_id=$lesson_id" class="btn btn-sm btn-primary mr-2">
				<i class="fas fa-arrow-left fa-lg"></i>
				<a href="my_activities.php?student_id=$student_id&lesson_id=$lesson_id&activity_id=$activity_id" class="btn btn-sm btn-primary">
				<i class="fas fa-arrow-right fa-lg"></i>
				</a>
				</td>
				</tr>
				HTML;
			}
		}

		$html .= <<<HTML
			</tbody>
		</table>
		HTML;

		$stmtone->close();

		return $html;
	}

	public function activity_name($activity_id)
	{
		$query = "SELECT * FROM activities WHERE id = ?";

		$stmt = $this->mysql->prepare($query);

		$stmt->bind_param("i", $activity_id);

		$html = '';

		if ($stmt->execute()) 
		{
			$result = $stmt->get_result();

			while ($data = $result->fetch_assoc()) 
			{
				extract($data);

				$html .= <<<HTML
				$title&nbsp;
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function get_again_activity_id($activity_id)
	{
		$query = "SELECT *, activities.id AS activity_id FROM activities WHERE id = ?";

		$stmt = $this->mysql->prepare($query);

		$stmt->bind_param("i", $activity_id);

		$html = '';

		if ($stmt->execute()) 
		{
			$result = $stmt->get_result();

			while ($data = $result->fetch_assoc()) 
			{
				extract($data);

				$student_id = $_GET['student_id'];
				$lesson_id = $_GET['lesson_id'];

				$html .= <<<HTML
				<div class="col-sm-3 col-lg-2">
				<a href="per_activities.php?student_id=$student_id&lesson_id=$lesson_id" class="btn btn-block btn-info btn-sm w-100"><i class="fas fa-arrow-left fa-md"></i> Back</a>
				</div>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}
}
?>