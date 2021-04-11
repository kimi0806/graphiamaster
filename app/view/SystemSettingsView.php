<?php
/**
 * 
 */
class SystemSettingsView extends Database
{
	public $id;
	public $image_path;
	public $image_name;
	public $name;
	public $description;
	public $enable;
	public $status;
	public $created_at;
	public $updated_at;

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function update_form($id)
	{
		$sql = "SELECT * FROM system_settings WHERE id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $id);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows == 1) {
				$row = $stmt_result->fetch_assoc();

				extract($row);

				$checked = ($enable == 1) ? 'checked=""' : '';

				$html = <<<HTML
				<form action="../../app/controller/SystemSettingsController.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="$id">
					<div class="form-group row">
						<label class="col-lg-3 col-form-label text-muted">System</label>
						<div class="col-lg-6">
							<input type="checkbox" id="bootstrap-switch" name="enable" data-on-color="primary" data-off-color="default" $checked value="1">
						</div>
						<!-- /.col -->
					</div>
					<!-- /.form-group -->
					<div class="form-group row">
						<label class="col-lg-3 col-form-label text-muted">System Logo</label>
						<div class="col-lg-2">
							<img src="../../$image_path/$image_name" class="img-thumbnail">
						</div>
						<!-- /.col -->
					</div>
					<!-- /.form-group -->
					<div class="form-group row">
						<div class="offset-lg-3 col-lg-6">
							<div class="custom-file">
								<input type="file" id="website-logo" name="image" class="custom-file-input">
								<label class="custom-file-label" for="website-logo">$image_name</label>
							</div>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.form-group -->
					<div class="form-group row">
						<label class="col-lg-3 col-form-label text-muted">System Name</label>
						<div class="col-lg-6">
							<input type="text" name="name" class="form-control" placeholder="System Name" value="$name">
						</div>
						<!-- /.col -->
					</div>
					<!-- /.form-group -->
					<div class="form-group row">
						<label class="col-lg-3 col-form-label text-muted">System Description</label>
						<div class="col-lg-6">
							<textarea name="description" class="form-control" rows="5" placeholder="System Description">$description</textarea>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.form-group -->
					<div class="form-group row mb-0">
						<div class="offset-lg-3 col-lg-2">
							<button type="submit" name="update" class="btn btn-block btn-primary">Save changes</button>
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
}
?>