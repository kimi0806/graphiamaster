<?php
/**
 * 
 */
class StudentActivitiesView extends Database
{
	public $Spelling;

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function taker_table($activity_id, $user_id, $status)
	{
		$sql = "SELECT *, student_activities.id AS student_activity_id, student_activities.updated_at AS student_activity_updated_at, student_activities.id AS student_activities_id FROM student_activities LEFT JOIN users ON student_activities.user_id=users.id LEFT JOIN activities ON student_activities.activity_id=activities.id LEFT JOIN activity_items ON student_activities.activity_item_id=activity_items.id LEFT JOIN student_activity_points ON student_activities.id=student_activity_points.student_activity_id WHERE activity_items.activity_id=? AND student_activities.user_id=? AND activity_items.status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("iis", $activity_id, $user_id, $status);

		$html = <<<HTML
		<table class="table table-bordered table-hover table-sm dt-default">
			<thead>
				<tr>
					<th width="50">No.</th>
					<th>Student</th>
					<th>Problem</th>
					<th>Point</th>
					<th colspan="2">Checked</th>
					<th width="100">Action</th>
				</tr>
			</thead>
			<tbody>
		HTML;

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) {

				$student_user_id = $_GET['student_user_id'];

				extract($row);

				$problem = nl2br($problem);
				$item_status = ($checked == 1) ? 'Yes' : 'No';
				$badge_type = ($checked == 1) ? 'badge-success' : 'badge-secondary';
				$disable_view = ($checked == 1) ? 'disabled=""' : '';
				$disable_edit = ($checked == 1) ? '' : 'disabled=""';
				$student_activity_updated_at = (isset($student_activity_updated_at)) ? $student_activity_updated_at : '0000-00-00 00:00:00';
				$point = (isset($point)) ? $point : 0;

				$html .= <<<HTML
				<tr>
					<td>#$arrangement</td>
					<td>$family_name, $given_name $middle_name</td>
					<td>$problem</td>
					<td>$point</td>
					<td>
						<label class="badge badge-pill $badge_type">$item_status</label>
					</td>
					<td>$student_activity_updated_at</td>
					<td align="center">
						<button class="btn btn-sm btn-success" onclick="window.location.href='evaluate.php?student_activities_id=$student_activities_id&activity_id=$activity_id&student_user_id=$student_user_id';" $disable_view><i class="fas fa-star"></i>
						</button>
						<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit-$student_activity_id" $disable_edit>
							<i class="fas fa-edit"></i>
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
		$sql = "SELECT *, student_activities.user_id AS student_user_id, COUNT(student_activities.activity_item_id) AS total_activity_items, student_activities.created_at AS student_activity_created_at, SUM(student_activity_points.point) AS total_points FROM student_activities LEFT JOIN users ON student_activities.user_id=users.id LEFT JOIN activities ON student_activities.activity_id=activities.id LEFT JOIN student_activity_points ON student_activities.id=student_activity_points.student_activity_id WHERE student_activities.activity_id=? AND users.status=? GROUP BY student_activities.user_id";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $activity_id, $status);

		$html = <<<HTML
		<table class="table table-bordered table-hover table-sm dt-default">
			<thead>
				<tr>
					<th>Activity</th>
					<th>Student</th>
					<th>Answered Items</th>
					<th>Total Points</th>
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
					<td>$total_points</td>
					<td>$student_activity_created_at</td>
					<td>
						<label class="badge badge-pill $badge_type">$date_status</label>
					</td>
					<td align="center">
						<a href="student_activities.php?activity_id=$activity_id&student_user_id=$student_user_id" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
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

	public function update_modal($activity_id, $user_id, $status)
	{
		$sql = "SELECT *, student_activities.id AS student_activity_id, student_activities.updated_at AS student_activity_updated_at, students.created_at AS student_created_at, sections.name AS section_name, student_activity_points.id AS student_activity_point_id FROM student_activities LEFT JOIN users ON student_activities.user_id=users.id LEFT JOIN students ON student_activities.user_id=students.user_id LEFT JOIN sections ON students.section_id=sections.id LEFT JOIN activities ON student_activities.activity_id=activities.id LEFT JOIN activity_items ON student_activities.activity_item_id=activity_items.id LEFT JOIN student_activity_points ON student_activities.id=student_activity_points.student_activity_id WHERE activity_items.activity_id=? AND student_activities.user_id=? AND activity_items.status=? GROUP BY student_activity_points.id";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("iis", $activity_id, $user_id, $status);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) {
				extract($row);

				$problem = nl2br($problem);
				$answer = nl2br($answer);

				$html .= <<<HTML
				<div class="modal fade" id="modal-edit-$student_activity_id">
					<div class="modal-dialog modal-lg modal-dialog-centered">
						<div class="modal-content">
							<form action="../../app/controller/StudentActivityPointsController.php" method="post">
								<div class="modal-header">
									<label class="mb-0">Update</label>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<input type="hidden" name="id" value="$student_activity_point_id">
									<div class="form-group row">
										<label class="col-sm-3 col-lg-3 col-form-label">Student</label>
										<div class="col-sm-9 col-lg-6">
											<h4 class="mb-0">$family_name, $given_name $middle_name</h4>
											<small>($section_name - $student_created_at)</small>
										</div>
										<!-- /.col -->
									</div>
									<!-- /.form-group -->
									<div class="form-group row">
										<label class="col-sm-3 col-lg-3 col-form-label">Problem</label>
										<div class="col-sm-9 col-lg-6" style="padding: 7px 7.5px">
											<p class="mb-0">$arrangement.) $problem</p>
										</div>   
										<!-- /.col -->
									</div>
									<!-- /.form-group -->
									<div class="form-group row">
										<label class="col-sm-3 col-lg-3 col-form-label">Answer</label>
										<div class="col-sm-9 col-lg-6" style="padding: 7px 7.5px">
											<p class="mb-0">$answer</p>
										</div>
										<!-- /.col -->
									</div>
									<!-- /.form-group -->
									<div class="form-group">
										<label>Correction</label>
										<textarea class="form-control summernote correctarea" name="correction" id="correction" rows="5">$correction</textarea>
									</div>
									<div class="form-group">
										<label>Recommendation</label>
										<textarea name="recommendation" class="form-control summernote" rows="5">$recommendation</textarea>
									</div>
									<div class="form-group mb-0">
										<label>Point</label>
										<input type="number" name="point" class="form-control" placeholder="Point" value="$point">
									</div>
								</div>
								<div class="modal-footer justify-content-between py-1">
									<button type="button" class="btn btn-link text-secondary" data-dismiss="modal">Close</button>
									<button type="submit" name="update" class="btn btn-link text-primary">Save changes</button>
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

	public function view_page($student_activities_id, $activity_id, $student_user_id, $status)
	{
		$sql = "SELECT *, student_activities.id AS student_activity_id, student_activities.updated_at AS student_activity_updated_at, students.created_at AS student_created_at, sections.name AS section_name FROM student_activities LEFT JOIN users ON student_activities.user_id=users.id LEFT JOIN students ON student_activities.user_id=students.user_id LEFT JOIN sections ON students.section_id=sections.id LEFT JOIN activities ON student_activities.activity_id=activities.id LEFT JOIN activity_items ON student_activities.activity_item_id=activity_items.id WHERE student_activities.id = ? AND activity_items.activity_id=? AND student_activities.user_id=? AND activity_items.status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("iiis", $student_activities_id, $activity_id, $student_user_id, $status);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) {

				extract($row);

				$problem = nl2br($problem);
				$answer = nl2br($answer);

				$html .= <<<HTML
				<form action="../../app/controller/StudentActivityPointsController.php" method="post">
				<input type="hidden" name="student_activity_id" value="$student_activity_id">
				<div class="form-group row">
					<label class="col-sm-3 col-lg-3 col-form-label">Student</label>
					<div class="col-sm-9 col-lg-6">
						<h4 class="mb-0">$family_name, $given_name $middle_name</h4>
						<small>($section_name - $student_created_at)</small>
					</div>
					<!-- /.col -->
				</div>
				<!-- /.form-group -->
				<div class="form-group row">
					<label class="col-sm-3 col-lg-3 col-form-label">Problem</label>
					<div class="col-sm-9 col-lg-6" style="padding: 7px 7.5px">
						<p class="mb-0">$arrangement.) $problem</p>
					</div>
					<!-- /.col -->
				</div>
				<!-- /.form-group -->
				<div class="form-group row">
					<label class="col-sm-3 col-lg-3 col-form-label">Answer</label>
					<div class="col-sm-9 col-lg-6" style="padding: 7px 7.5px">
						<p class="mb-0">$answer</p>
					</div>
					<!-- /.col -->
				</div>
				<!-- /.form-group -->
				<div class="form-group">
					<label>Grammarization</label>
					<div id="editor">
						<p class="form-control">$answer</p>
					</div>
				</div>
				<div class="form-group">
					<label>Correction</label>
					<textarea name="correction" class="form-control" spellcheck="true" rows="5" placeholder="Paste the correct grammar here..."></textarea>
				</div>
				<!--<div class="card">
					<div class="card-header">
						<label class="card-title mb-0"><i class="fa fa-info-circle mr-2"></i>Suggestions</label>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
				</div>-->
				<div class="form-group">
					<label>Recommendation</label>
					<textarea name="recommendation" class="form-control" spellcheck="true" rows="5"></textarea>
				</div>
				<div class="form-group mb-0">
					<label>Point</label>
					<input type="number" name="point" class="form-control" placeholder="Point">
				</div>
				<div class="col-12 mt-5">
				<button type="button" class="btn btn-link text-secondary">_</button>
				<button type="submit" name="save" class="btn btn-link text-success float-right">Save</button>
				</div>
				</form>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function my_activities($student_id, $activity_id, $status)
	{
		$queryone = "SELECT *, student_activities.id AS student_activity_id FROM student_activities LEFT JOIN activities ON student_activities.activity_id = activities.id LEFT JOIN activity_items ON student_activities.activity_item_id = activity_items.id WHERE student_activities.user_id = ? AND activity_items.activity_id = ? AND student_activities.status = ?";

		$stmtone = $this->mysql->prepare($queryone);

		$stmtone->bind_param("iis", $student_id, $activity_id, $status);

		$html = '';

		$html = <<<HTML
		<table class="table table-bordered table-hover table-sm table-sm dt-default">
			<thead>
				<tr>
					<th>Title</th>
					<th>Status</th>
					<th colspan="2">Created</th>
					<th width="110">Action</th>
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
				HTML;

				// $querytwo = "SELECT *, activity_items.arrangement AS asc_order FROM activity_items WHERE activity_id = ? GROUP BY activity_id";

				// $stmttwo = $this->mysql->prepare($querytwo);

				// $stmttwo->bind_param("i", $my_activity_id);

				// if ($stmttwo->execute()) 
				// {
				// 	$resulttwo = $stmttwo->get_result();

				// 	while ($datatwo = $resulttwo->fetch_assoc()) 
				// 	{
				// 		extract($datatwo);

						$html .= <<<HTML
						<td>Item No. $arrangement</td>
						HTML;

				// 	}
				// }

				$html .= <<<HTML
				<td>$status</td>
				<td>$created_at</td>
				<td align="center">
				<label class="badge badge-pill $badge_type">$date_status</label>
				</td>
				<td align="center">
				<a href="#modal-default-$activity_item_id" class="btn btn-sm btn-primary mr-1" data-toggle="modal">
				<i class="far fa-question-circle fa-lg"></i>
				</a>
				<a href="#modal_activity_points_$student_activity_id" class="btn btn-sm btn-primary mr-1" data-toggle="modal">
				<i class="far fa-file fa-lg"></i>
				</a>
				<!--<a href="#" class="btn btn-sm btn-danger">
				<i class="fas fa-trash fa-lg"></i>
				</a>-->
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

	public function activity_item_info_mdl($student_id, $activity_id, $status)
	{
		$queryone = "SELECT *, student_activities.id AS student_activity_id FROM student_activities LEFT JOIN activities ON student_activities.activity_id = activities.id LEFT JOIN activity_items ON student_activities.activity_item_id = activity_items.id WHERE student_activities.user_id = ? AND activity_items.activity_id = ? AND student_activities.status = ?";

		$stmtone = $this->mysql->prepare($queryone);

		$stmtone->bind_param("iis", $student_id, $activity_id, $status);

		$html = '';

		if ($stmtone->execute()) 
		{
			$resultone = $stmtone->get_result();

			while ($dataone = $resultone->fetch_assoc()) 
			{
				extract($dataone);

				$html .= <<<HTML
				<div class="modal fade" id="modal-default-$activity_item_id">
				  <div class="modal-dialog modal-lg">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Activity Item No. $activity_item_id Details</h4>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      <!-- Post -->
				      <div class="post">
				      <span class="username">
				      <h3>Problem</h3>
				      </span>
				      <p>
				      $problem
				      </p>
				      <br>
				      <span class="username">
				      <h3>Solution</h3>
				      </span>
				      <p>
				      $solution
				      </p>
				      </div>
				      <!-- /.post -->
				      </div>
				      <div class="modal-footer justify-content-between">
				        <button type="button" class="btn btn-default">_</button>
				        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
				      </div>
				    </div>
				  </div>
				</div>
				HTML;
			}
		}

		$stmtone->close();

		return $html;
	}
}
?>