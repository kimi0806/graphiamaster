<?php
/**
 * 
 */
class ActivityItemsView extends Database
{

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function card_items($activity_id, $status)
	{
		$sql = "SELECT * FROM activity_items WHERE activity_id=? AND status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $activity_id, $status);

		$html = <<<HTML
		<div class="card">
			<div class="card-body">
				<form id="msform" action="app/controller/StudentActivitiesController.php" method="post">
					<input type="hidden" name="activity_id" value="$activity_id">
		HTML;

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();
			$count = $stmt_result->num_rows;

			if ($stmt_result->num_rows > 0) {
				$active = true;

				$html .= <<<HTML
				<!-- progressbar -->
				<ul id="progressbar" class="d-flex justify-content-between">
				HTML;

				for ($i=0; $i < $count; $i++) { 
					$current = ($active == true) ? 'active' : '';

					$html .= <<<HTML
					<li class="text-center fas fa-check-circle $current"></li>
					HTML;

					$active = false;
				}

				$html .= <<<HTML
				</ul>
				<!-- fieldsets -->
				HTML;

				$first = true;

				while ($row = $stmt_result->fetch_assoc()) {
					extract($row);

					$problem = nl2br($problem);

					$html .= <<<HTML
					<fieldset>
						<div class="title-wrap d-flex justify-content-between pb-0">
							<div class="title-box">
								<h3 class="font-weight-bold">Problem</h3>
								<p>$problem</p>
							</div>
							<!-- /.title-box -->
						</div>
						<!-- /.title-wrap -->
						<hr>
						<h4 class="mb-3">Your Answer</h4>
						<div class="form-group">
							<input type="hidden" name="activity_item_id[$id]" value="$id">
							<textarea name="answer[$id]" class="form-control" placeholder="Enter your answer ..." rows="7"></textarea>
						</div>
					HTML;

					if ($first == false) {
						$html .= <<<HTML
						<button type="button" name="previous" class="previous btn btn-block btn-flat btn_2">Previous</button>
						HTML;
					}

					if ($count > 1) {
						$html .= <<<HTML
						<button type="button" name="next" class="next btn btn-block btn-flat btn_1 pull-right">Next</button>
						HTML;
					}
					else {
						$html .= <<<HTML
						<button type="submit" name="save" class="submit btn btn-block btn-flat btn_1">Submit</button>
						HTML;
					}

					$html .= <<<HTML
					</fieldset>
					HTML;

					$first = false;
					$count--;
				}
			}
		}

		$html .= <<<HTML
				</form>
			</div>
		</div>
		HTML;

		$stmt->close();

		return $html;
	}

	public function new_items($activity_id)
	{
		$sql = "SELECT * FROM activity_items WHERE activity_id=? GROUP BY activity_id";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $activity_id);

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows == 1) {
				$row = $stmt_result->fetch_assoc();

				extract($row);

				$html = <<<HTML
				<form action="../../app/controller/ActivityItemsController.php" method="post">
					<input type="hidden" name="activity_id" value="$activity_id">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th width="100">No.</th>
								<th>Problem</th>
								<th>Solution</th>
								<th width="100">Action</th>
							</tr>
						</thead>
						<tbody id="tbody">
							<tr id="tr-0">
								<td>
									<input type="number" name="arrangement[0]" class="form-control" placeholder="No.">
								</td>
								<td>
									<textarea name="problem[0]" class="form-control" rows="1" placeholder="Problem"></textarea>
								</td>
								<td>
									<textarea name="solution[0]" class="form-control" rows="1" placeholder="Solution"></textarea>
								</td>
								<td class="text-center">
									<button type="button" name="remove" class="btn btn-danger" value="0"><i class="fas fa-times"></i></button>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3">
									<button type="submit" name="save" class="btn btn-block btn-success">Save All</button>
								</th>
								<th class="text-center">
									<button type="button" name="add" class="btn btn-outline-success" value=""><i class="fas fa-plus"></i></button>
								</th>
							</tr>
						</tfoot>
					</table>
				</form>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function remove_modal($activity_id, $status)
	{
		$sql = "SELECT * FROM activity_items WHERE activity_id=? AND status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $activity_id, $status);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) {
				extract($row);

				$html .= <<<HTML
				<div class="modal fade" id="modal-remove-$id">
					<div class="modal-dialog modal-sm modal-dialog-centered">
						<div class="modal-content">
							<form action="../../app/controller/ActivityItemsController.php" method="post">
								<div class="modal-header">
									<label class="mb-0">Remove</label>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<input type="hidden" name="id" value="$id">
									<p class="text-muted text-center mb-0">Are you sure you want to remove this activity item?</p>
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

	public function table($activity_id, $status)
	{
		$sql = "SELECT *, activity_items.id AS activity_item_id, lessons.name AS lesson_name FROM activity_items LEFT JOIN activities ON activity_items.activity_id=activities.id LEFT JOIN lessons ON activities.lesson_id=lessons.id WHERE activity_items.activity_id=? AND activity_items.status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $activity_id, $status);

		$html = <<<HTML
		<table class="table table-bordered table-hover dt-default">
			<thead>
				<tr>
					<th>Lesson</th>
					<th width="100">No.</th>
					<th>Problem</th>
					<th>Solution</th>
					<th width="100">Action</th>
				</tr>
			</thead>
			<tbody>
		HTML;

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) {
				extract($row);

				$problem = nl2br($problem);
				$solution = nl2br($solution);

				$html .= <<<HTML
				<tr>
					<td>$lesson_name</td>
					<td>$arrangement</td>
					<td>$problem</td>
					<td>$solution</td>
					<td align="center">
						<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-update-$activity_item_id">
							<i class="fas fa-edit"></i>
						</button>
						<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-remove-$activity_item_id" style="padding-right: 11px; padding-left: 11px;">
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

	public function update_modal($activity_id, $status)
	{
		$sql = "SELECT * FROM activity_items WHERE activity_id=? AND status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $activity_id, $status);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();
				
			while ($row = $stmt_result->fetch_assoc()) {
				extract($row);

				$html .= <<<HTML
				<div class="modal fade" id="modal-update-$id">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<form action="../../app/controller/ActivityItemsController.php" method="post">
								<div class="modal-header">
									<label class="mb-0">Remove</label>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<input type="hidden" name="id" value="$id">
									<div class="form-group">
										<label>Arrangement</label>
										<input type="number" name="arrangement" class="form-control" value="$arrangement">
									</div>
									<div class="form-group">
										<label>Problem</label>
										<textarea name="problem" class="form-control" rows="3">$problem</textarea>
									</div>
									<div class="form-group">
										<label>Solution</label>
										<textarea name="solution" class="form-control" rows="3">$solution</textarea>
									</div>
								</div>
								<div class="modal-footer justify-content-between py-1">
									<button type="button" class="btn btn-link text-danger" data-dismiss="modal">Cancel</button>
									<button type="submit" name="update" class="btn btn-link">Save Changes</button>
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
}
?>