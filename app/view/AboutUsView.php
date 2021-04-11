<?php
/**
 * 
 */
class AboutUsView extends Database
{
	public $id;
	public $name;
	public $description;
	public $email_address;
	public $mobile_number;
	public $telephone_number;
	public $location;
	public $status;
	public $created_at;
	public $updated_at;

	function __construct()
	{
		$this->mysql = $this->connect('localhost', 'jacrlshn_root', 'hre_microlending', 'jacrlshn_hre');
	}

	public function about_section($id)
	{
		$sql = "SELECT * FROM about_us WHERE id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $id);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows == 1) {
				$row = $stmt_result->fetch_assoc();

				extract($row);

				$description = nl2br($description);
				$location = nl2br($location);

				$html = <<<HTML
				<section class="about-section py-0">
					<div class="container">
						<div class="row align-items-sm-center align-items-lg-stretch">
							<div class="col-md-7 col-lg-7">
								<div class="learning_img">
									<img src="dist/img/learning_img.png" alt="">
								</div>
							</div>
							<div class="col-md-5 col-lg-5">
								<div class="learning_member_text">
									<h5>About us</h5>
									<h2>$name</h2>
									<p>$description</p>
									<ul class="mb-0">
										<li class="mt-3">
											<span class="ti-envelope mr-2"></span>$email_address
										</li>
										<li class="mt-3">
											<span class="ti-map mr-2"></span>$location
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</section>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function update_form($id)
	{
		$sql = "SELECT * FROM about_us WHERE id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $id);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows == 1) {
				$row = $stmt_result->fetch_assoc();

				extract($row);

				$html = <<<HTML
				<form action="../../app/controller/AboutUsController.php" method="post">
					<input type="hidden" name="id" value="$id">
					<div class="form-group row">
						<label class="col-lg-3 col-form-label text-muted">Company Name</label>
						<div class="col-lg-6">
							<input type="text" name="name" class="form-control" placeholder="Company Name" value="$name">
						</div>
						<!-- /.col -->
					</div>
					<!-- /.form-group -->
					<div class="form-group row">
						<label class="col-lg-3 col-form-label text-muted">Company Description</label>
						<div class="col-lg-6">
							<textarea name="description" class="form-control" rows="3" placeholder="Company Description">$description</textarea>
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
						<label class="col-lg-3 col-form-label text-muted">Contact Number</label>
						<div class="col-lg-6">
							<div class="row">
								<div class="col-6">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">+63</span>
										</div>
										<input type="text" name="mobile_number" class="form-control" placeholder="XXX-XXXX-XXX" maxlength="10" value="$mobile_number">
									</div>
								</div>
								<!-- /.col -->
								<div class="col-6">
									<input type="text" name="telephone_number" class="form-control" placeholder="Telephone Number" value="$telephone_number">
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.form-group -->
					<div class="form-group row">
						<label class="col-lg-3 col-form-label text-muted">Location</label>
						<div class="col-lg-6">
							<textarea name="location" class="form-control" rows="5" placeholder="Location">$location</textarea>
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