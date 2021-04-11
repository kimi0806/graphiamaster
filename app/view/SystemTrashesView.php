<?php
/**
 * 
 */
class SystemTrashesView extends Database
{
	public $id;
	public $user_id;
	public $module_primary_id;
	public $module_type;
	public $status;
	public $created_at;
	public $updated_at;

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function delete_modal($return_url, $status)
	{
		$sql = "SELECT * FROM system_trashes WHERE status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("s", $status);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) {
				extract($row);

				$html .= <<<HTML
				<div class="modal fade" id="modal-delete-$id">
					<div class="modal-dialog modal-sm modal-dialog-centered">
						<div class="modal-content">
							<form action="../../app/controller/SystemTrashesController.php" method="post">
								<div class="modal-header">
									<label class="mb-0">Delete</label>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<input type="hidden" name="id" value="$id">
									<input type="hidden" name="return_url" value="$return_url">
									<p class="text-muted text-center mb-0">Are you sure you want to delete this record permanently?</p>
								</div>
								<div class="modal-footer py-1">
									<button type="submit" name="delete" class="btn btn-block btn-link text-danger">Yes, delete it!</button>
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

	public function recover_modal($return_url, $status)
	{
		$sql = "SELECT * FROM system_trashes WHERE status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("s", $status);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) {
				extract($row);

				$html .= <<<HTML
				<div class="modal fade" id="modal-recover-$id">
					<div class="modal-dialog modal-sm modal-dialog-centered">
						<div class="modal-content">
							<form action="../../app/controller/SystemTrashesController.php" method="post">
								<div class="modal-header">
									<label class="mb-0">Recover</label>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<input type="hidden" name="id" value="$id">
									<input type="hidden" name="return_url" value="$return_url">
									<p class="text-muted text-center mb-0">Are you sure you want to recover this record?</p>
								</div>
								<div class="modal-footer py-1">
									<button type="submit" name="recover" class="btn btn-block btn-link text-primary">Yes, recover it!</button>
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
		$sql = "SELECT *, system_trashes.id AS system_trash_id, system_trashes.created_at AS system_trash_created_at FROM system_trashes LEFT JOIN users ON system_trashes.user_id=users.id WHERE system_trashes.status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("s", $status);

		$html = <<<HTML
		<table class="table table-bordered table-hover dt-default">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Module type</th>
					<th>Date</th>
					<th width="100">Action</th>
				</tr>
			</thead>
			<tbody>
		HTML;

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			while ($row = $stmt_result->fetch_assoc()) {
				extract($row);

				$sql = "SELECT * FROM $module_type WHERE id=?";

				$inner_stmt = $this->mysql->prepare($sql);
				$inner_stmt->bind_param("i", $module_primary_id);
				$inner_stmt->execute();

				$inner_stmt_result = $inner_stmt->get_result();

				$inner_row = $inner_stmt_result->fetch_assoc();

				switch ($module_type) {
					case 'activities':
						$name = $inner_row['title'];
						break;

					case 'activity_items':
						$name = $inner_row['problem'];
						break;

					case 'users':
						$name = $inner_row['given_name'] . ' ' . $inner_row['family_name'];
						break;

					case 'sections':
						$name = $inner_row['name'];
						break;

					case 'lessons':
						$name = $inner_row['name'];
						break;
					
					default:
						# code...
						break;
				}

				$display = ($module_type == 'users') ? 'd-none' : '';
				$module_type = ucwords(str_replace('_', ' ', $module_type));

				$html .= <<<HTML
				<tr>
					<td>$given_name $family_name</td>
					<td>$name</td>
					<td>$module_type</td>
					<td>$system_trash_created_at</td>
					<td align="center">
						<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-recover-$system_trash_id">
							<i class="fas fa-recycle"></i>
						</button>
						<button class="btn btn-sm btn-danger $display" data-toggle="modal" data-target="#modal-delete-$system_trash_id">
							<i class="far fa-trash-alt"></i>
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
}
?>