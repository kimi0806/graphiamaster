<?php  
/**
 * 
 */
class StudentsView extends Database
{
	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function students($teacher_user_id, $status)
	{
		$sqlone = "SELECT * FROM users WHERE id = ? AND status = ?";

		$stmtone = $this->mysql->prepare($sqlone);

		$stmtone->bind_param("is", $teacher_user_id, $status);

		$html = '';

		$html = <<<HTML
		<table class="table table-bordered table-hover table-sm dt-default">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Status</th>
					<th colspan="2">Date created</th>
					<th width="100">Action</th>
				</tr>
			</thead>
			<tbody>
		HTML;

		if ($stmtone->execute()) 
		{
			$resultone = $stmtone->get_result();

			$dataone = $resultone->fetch_assoc();

			$teacher_user_id = $dataone['id'];

			$sqltwo = "SELECT *, students.id AS student_id FROM students LEFT JOIN users ON students.user_id = users.id WHERE students.teacher_user_id = ?";

			$stmttwo = $this->mysql->prepare($sqltwo);

			$stmttwo->bind_param("i", $teacher_user_id);

			if ($stmttwo->execute()) 
			{
				$resulttwo = $stmttwo->get_result();

				while ($datatwo = $resulttwo->fetch_assoc()) 
				{
					extract($datatwo);

					$parsed_date = date_parse($created_at);
					$year_and_month = $parsed_date['year'] . '-' . $parsed_date['month'];
					$badge_type = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'badge-success' : 'badge-secondary';
					$date_status = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'New' : 'Old';

					$html .= <<<HTML
					<tr>
					<td>$given_name $middle_name $family_name</td>
					<td>$email_address</td>
					<td>$status</td>
					<td>$created_at</td>
					<td align="center">
					<label class="badge badge-pill $badge_type">$date_status</label>
					</td>
					<td align="center">
					<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-student-info-$student_id">
					<i class="fas fa-info-circle"></i>
					</button>
					<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-remove-$student_id">
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

			$stmttwo->close();
		}

		$stmtone->close();

		return $html;
	}

	public function student_information_mdl($teacher_user_id, $status)
	{
		$sql = "SELECT *, students.id AS student_id, students.created_at AS student_created, students.status AS student_status FROM students LEFT JOIN users ON students.user_id = users.id LEFT JOIN user_types ON user_types.id = users.user_type_id LEFT JOIN teachers ON students.teacher_user_id = teachers.user_id LEFT JOIN sections ON students.section_id = sections.id LEFT JOIN photos ON students.profile_photo_id = photos.id WHERE students.teacher_user_id=? AND users.status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $teacher_user_id, $status);

		$html = '';

		if ($stmt->execute())
		{
			$result = $stmt->get_result();

			while ($data = $result->fetch_assoc()) 
			{
				extract($data);

				$html .= <<<HTML
				<div class="modal fade" id="modal-student-info-$student_id">
				<div class="modal-dialog modal-lg">
				<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Student Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
				<!-- Widget: user widget style 2 -->
				<div class="card card-widget widget-user-2">
				<!-- Add the bg color to the header using any of the bg-* classes -->
				<div class="widget-user-header bg-warning">
				<div class="widget-user-image">
				<img class="img-circle elevation-2" src="../../$file_path/$file_name" alt="User Avatar">
				</div>
				<!-- /.widget-user-image -->
				<h3 class="widget-user-username">$given_name $middle_name $family_name | $sex</h3>
				<h5 class="widget-user-desc">Section: Athena</h5>
				</div>
				<div class="card-footer p-0">
				<ul class="nav flex-column">
				<li class="nav-item">
				<a href="#" class="nav-link">
				Email Address: &nbsp;$email_address<span class="float-right"><i class="fas fa-envelope"></i></span>
				</a>
				</li>
				<li class="nav-item">
				<a href="#" class="nav-link">
				Mobile Number: &nbsp;+63 $mobile_number<span class="float-right"><i class="fas fa-mobile"></i></span>
				</a>
				</li>
				<li class="nav-item">
				<a href="#" class="nav-link">
				Date of Birth: &nbsp;$date_of_birth<span class="float-right"><i class="fas fa-calendar"></i></span>
				</a>
				</li>
				<li class="nav-item">
				<a href="#" class="nav-link">
				Educational Attainment: &nbsp;$educational_attainment<span class="float-right"><i class="fas fa-graduation-cap"></i></span>
				</a>
				</li>
				<li class="nav-item">
				<a href="#" class="nav-link">
				School: &nbsp;$school_attended<span class="float-right"><i class="fas fa-school"></i></span>
				</a>
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

	public function remove_modal($teacher_user_id, $status)
	{
		$sql = "SELECT *, students.id AS student_id, students.user_id AS student_user_id FROM students LEFT JOIN users ON students.user_id=users.id WHERE students.teacher_user_id=? AND users.status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $teacher_user_id, $status);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) {
				extract($row);

				$html .= <<<HTML
				<div class="modal fade" id="modal-remove-$student_id">
					<div class="modal-dialog modal-sm modal-dialog-centered">
						<div class="modal-content">
							<form action="../../app/controller/StudentsController.php" method="post">
								<div class="modal-header">
									<label class="mb-0">Remove</label>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<input type="hidden" name="id" value="$student_user_id">
									<p class="text-muted text-center mb-0">Are you sure you want to remove this $given_name?</p>
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

	public function check_student_voice_records()
	{
		$sql = "SELECT *, students.id AS students_id FROM students LEFT JOIN users ON students.user_id = users.id";

		$stmt = $this->mysql->prepare($sql);

		$html = '';

		if ($stmt->execute())
		{
			$result = $stmt->get_result();

			while ($data = $result->fetch_assoc()) 
			{
				extract($data);

				$html .= <<<HTML
				<div class="modal fade" id="modal-check-voice_records-$students_id">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header bg-warning">
								<h4 class="modal-title">$given_name $middle_name $family_name - Essay</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body" style="height: 450px; overflow-y: auto;">
								<div id="accordion">
									<!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
									<div class="card card-default">
										<div class="card-header">
											<h4 class="card-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
													<h5><u>Speak Spanish</u></h5>
													<p><b>Student Remarks:</b> <i>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.</i></p>
												</a>
											</h4>
										</div>
										<div id="collapseOne" class="panel-collapse collapse in">
											<div class="card-body">
												<form name="checkform" action="http://community.languagetool.org" method="post">
													<p id="checktextpara" class="border rounded">
														<textarea id="checktext" name="text" class="border" style="width: 100%" rows="5"></textarea>
													</p>
													<div id="feedbackErrorMessage" class="text-danger"></div>
													<div class="row">
														<div class="col-4">
															<div class="form-group">
																<select name="lang" class="form-control" id="lang">
																	<option value="en-US">English</option>
																	<option value="de-DE">German</option>
																	<option value="it">Italian</option>
																</select>
															</div>
														</div>
														<div class="col-4">
															<button type="submit" name="_action_checkText" class="btn btn-block btn-success" onClick="doit();return false;">Check</button>
														</div>
													</div>
													<p>Powered by <a href="https://languagetool.org">languagetool.org</a></p>
													<div class="form-group">
														<label>Remarks</label>
														<input class="form-control" placeholder="Enter ...">
													</div>
												</form>
											</div>
										</div>
									</div>
									<hr>
									<div class="card card-default">
										<div class="card-header">
											<h4 class="card-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
													<h5><u>Speak English</u></h5>
													<p><b>Student Remarks:</b> <i>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.</i></p>
												</a>
											</h4>
										</div>
										<div id="collapseTwo" class="panel-collapse collapse in">
											<div class="card-body">
												<div class="form-group">
													<textarea class="form-control" rows="2" name="student_compose"></textarea>
												</div>
												<div class="form-group">
													<label>Remarks</label>
													<textarea class="form-control" rows="1" placeholder="Enter ..."></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- / accordion -->
							</div>
							<!-- / modal-body -->
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary" data-dismiss="modal">Submit</button>
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

	public function students_by_section($teacher_user_id, $section_id)
	{
		$sql = "SELECT *, students.id AS students_id, students.status AS student_status, students.created_at AS student_created_at, sections.name AS section_name FROM students LEFT JOIN sections ON students.section_id=sections.id LEFT JOIN users ON students.user_id=users.id WHERE students.teacher_user_id=? AND students.section_id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("ii", $teacher_user_id, $section_id);

		$html = <<<HTML
		<table class="table table-bordered table-hover table-sm dt-default">
			<thead>
				<tr>
					<th>Name</th>
					<th>Section</th>
					<th>Status</th>
					<th colspan="2">Date created</th>
					<th width="100">Action</th>
				</tr>
			</thead>
			<tbody>
		HTML;

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) 
			{
				extract($row);

				// $display = ($student_id == 1) ? 'd-none' : '';
				$parsed_date = date_parse($student_created_at);
				$year_and_month = $parsed_date['year'] . '-' . $parsed_date['month'];
				$badge_type = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'badge-success' : 'badge-secondary';
				$date_status = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'New' : 'Old';

				$html .= <<<HTML
				<tr>
					<td>$given_name $middle_name $family_name</td>
					<td>$section_name</td>
					<td>$student_status</td>
					<td>$student_created_at</td>
					<td align="center">
						<label class="badge badge-pill $badge_type">$date_status</label>
					</td>
					<td align="center">
						<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit-details-$students_id">
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

	public function change_my_section($teacher_user_id, $section_id)
	{
		$sql = "SELECT *, students.id AS students_id FROM students LEFT JOIN sections ON sections.id = students.section_id WHERE students.teacher_user_id=? AND students.section_id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("ii", $teacher_user_id, $section_id);

		if ($stmt->execute()) 
		{
			$result = $stmt->get_result();

			while ($row = $result->fetch_assoc())
			{
				extract($row);

				$html .= <<<HTML
				<div class="modal fade" id="modal-edit-details-$students_id">
				<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Transfer in other section</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<form method="post" action="../../app/controller/StudentsController.php">
				<div class="modal-body">
				<input type="hidden" name="students_id" value="$students_id">
				<div class="form-group">
				<label>Section</label>
				<select class="form-control select2bs4" name="sections" style="width: 100%;">
				HTML;

				$query = "SELECT * FROM sections";

				$stmts = $this->mysql->prepare($query);

				$stmts->execute();

				$results = $stmts->get_result();

				while ($data = $results->fetch_assoc()) 
				{	
					extract($data);

					$selected = ($section_id == $id) ? 'selected=""' : '';

					$html .= <<<HTML
					<option value="$id" $selected>$name</option>
					HTML;
				}
				
				$html .= <<<HTML
				</select>
				</div>
				</div>
				<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" name="transfer" class="btn btn-primary">Save changes</button>
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

	public function dashboard_students($teacher_user_id, $status)
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

			$sqltwo = "SELECT * FROM students WHERE teacher_user_id = ? AND status = ?";

			$stmttwo = $this->mysql->prepare($sqltwo);

			$stmttwo->bind_param("is", $teacher_user_id, $status);

			if ($stmttwo->execute())
			{
				$resulttwo = $stmttwo->get_result();

				$count = $resulttwo->num_rows;
				
				$html .= <<<HTML
				<div class="inner">
				<h3>$count</h3>
				<p>Students</p>
				</div>
				HTML;
			}

			$stmttwo->close();
		}

		$stmtone->close();

		return $html;
	}

	public function public_dashboard_students($status)
	{
		$sql = "SELECT * FROM students WHERE status = ?";

		$stmt = $this->mysql->prepare($sql);

		$stmt->bind_param("s", $status);

		$html = '';

		if ($stmt->execute())
		{
			$result = $stmt->get_result();

			$count = $result->num_rows;

			$html .= <<<HTML
			<p>$count</p>
			HTML;
		}

		$stmt->close();

		return $html;
	}

	public function students_to_activities($teacher_id)
	{
		$sql = "SELECT *, teachers.id AS teacher_id FROM users LEFT JOIN teachers ON users.id = teachers.user_id WHERE users.id=?";

		$stmt = $this->mysql->prepare($sql);

		$stmt->bind_param("i", $teacher_id);

		$html = '';

		$html = <<<HTML
		<table class="table table-bordered table-hover dt-default">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Status</th>
					<th colspan="2">Date created</th>
					<th width="100">Action</th>
				</tr>
			</thead>
			<tbody>
		HTML;

		if ($stmt->execute()) 
		{
			$result = $stmt->get_result();

			$row = $result->fetch_assoc();
			
			extract($row);

			$query = "SELECT *, students.id AS students_id, students.status AS student_status, students.created_at AS student_created FROM students LEFT JOIN users ON users.id = students.user_id LEFT JOIN teachers ON teachers.id = students.teacher_id WHERE students.teacher_id = ?";

			$stmts = $this->mysql->prepare($query);

			$stmts->bind_param("i", $teacher_id);

			$stmts->execute();

			$stmts_result = $stmts->get_result();

			while ($data = $stmts_result->fetch_assoc()) 
			{
				extract($data);

				// $display = ($id == 1) ? 'd-none' : '';
				$parsed_date = date_parse($created_at);
				$year_and_month = $parsed_date['year'] . '-' . $parsed_date['month'];
				$badge_type = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'badge-success' : 'badge-secondary';
				$date_status = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'New' : 'Old';

				$html .= <<<HTML
				<tr>
					<td>$given_name $middle_name $family_name</td>
					<td>$email_address</td>
					<td>$student_status</td>
					<td>$student_created</td>
					<td align="center">
						<label class="badge badge-pill $badge_type">$date_status</label>
					</td>
					<td align="center">
						<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-student-summary-result-$students_id">
							<i class="fas fa-list-alt"></i>
						</button>
						<a href="activities.php?students_id=$students_id" class="btn btn-sm btn-primary"><i class="fas fa-tasks"></i></a>
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

	public function student_name($students_id)
	{
		$sql = "SELECT *, students.id AS students_id FROM students LEFT JOIN users ON users.id = students.user_id WHERE students.id = ?";

		$stmt = $this->mysql->prepare($sql);

		$stmt->bind_param("i", $students_id);

		$html = '';

		if ($stmt->execute()) 
		{
			$result = $stmt->get_result();

			while ($data = $result->fetch_assoc()) 
			{
				extract($data);

				$html .= <<<HTML
				<p>$given_name $middle_name $family_name</p>
				HTML;	
			}
		}

		$stmt->close();

		return $html;
	}

	public function per_student($teacher_user_id, $status)
	{
		$sqlone = "SELECT * FROM users WHERE id = ? AND status = ?";

		$stmtone = $this->mysql->prepare($sqlone);

		$stmtone->bind_param("is", $teacher_user_id, $status);

		$html = '';

		$html = <<<HTML
		<table class="table table-bordered table-hover table-sm dt-default">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Status</th>
					<th colspan="2">Date created</th>
					<th width="100">Action</th>
				</tr>
			</thead>
			<tbody>
		HTML;

		if ($stmtone->execute()) 
		{
			$resultone = $stmtone->get_result();

			$dataone = $resultone->fetch_assoc();

			$teacher_user_id = $dataone['id'];

			$sqltwo = "SELECT *, users.id AS student_id FROM students LEFT JOIN users ON students.user_id = users.id WHERE students.teacher_user_id = ? AND students.status = ?";

			$stmttwo = $this->mysql->prepare($sqltwo);

			$stmttwo->bind_param("is", $teacher_user_id, $status);

			if ($stmttwo->execute()) 
			{
				$resulttwo = $stmttwo->get_result();

				while ($datatwo = $resulttwo->fetch_assoc()) 
				{
					extract($datatwo);

					$parsed_date = date_parse($created_at);
					$year_and_month = $parsed_date['year'] . '-' . $parsed_date['month'];
					$badge_type = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'badge-success' : 'badge-secondary';
					$date_status = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'New' : 'Old';

					$html .= <<<HTML
					<tr>
					<td>$given_name $middle_name $family_name</td>
					<td>$email_address</td>
					<td>$status</td>
					<td>$created_at</td>
					<td align="center">
					<label class="badge badge-pill $badge_type">$date_status</label>
					</td>
					<td align="center">
					<a href="per_lessons.php?student_id=$student_id" class="btn btn-sm btn-primary w-100">
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

			$stmttwo->close();
		}

		$stmtone->close();

		return $html;
	}

	public function public_personal_details($user_id)
	{
		$sql = "SELECT *, students.id AS students_id FROM students LEFT JOIN users ON students.user_id = users.id WHERE students.user_id = ?";

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
				<input type="hidden" name="students_id" value="$students_id">
				<div class="row p-4">
					<div class="col-lg-4">
						<label>Gender</label>
						<div class="default-select" id="default-select">
							<select class="w-100 border" name="sex" id="sex">
								<option value="$sex" readonly>$sex <small>(current)</small></option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<label>Birth Date</label>
						<input type="date" name="date_of_birth" id="date_of_birth" class="single-input border" value="$date_of_birth">
					</div>
					<div class="col-lg-4">
						<label>Mobile Number (+63)</label>
						<input type="text" name="mobile_number" id="mobile_number" class="single-input border" maxlength="10" value="$mobile_number">
					</div>
				</div>
				<div class="p-4">
					<button type="submit" name="update_acc_details" class="genric-btn primary float-right">Update</button>
				</div>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}
}
?>