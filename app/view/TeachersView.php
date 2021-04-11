<?php
/**
 * 
 */
class TeachersView extends Database
{
	public $id;
	public $user_id;
	public $profile_photo_id;
	public $identity_hoto_id;
	public $sex;
	public $date_of_birth;
	public $mobile_number;
	public $school_name;
	public $school_address;
	public $type_of_school;
	public $status;
	public $created_at;
	public $updated_at;

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function list_login_info($id)
	{
		$sql = "SELECT * FROM users LEFT JOIN teachers ON teachers.user_id = users.id WHERE users.id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $id);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows > 0) {
				$row = $stmt_result->fetch_assoc();

				extract($row);

				$html = <<<HTML
				<div class="info">
					<a href="settings.php#" class="d-block">$given_name $family_name</a>
				</div>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function other_teachers($status, $limit)
	{
		$sql = "SELECT *, teachers.id AS teacher_id, teachers.created_at AS teacher_created_at FROM teachers LEFT JOIN users ON teachers.user_id=users.id WHERE users.status=? LIMIT ?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("si", $status, $limit);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows > 0) {
				$html = <<<HTML
				<aside class="other-teachers single_sidebar_widget post_category_widget">
					<h4 class="widget_title">Other Teachers</h4>
					<ul class="list cat-list">
				HTML;

				while ($row = $stmt_result->fetch_assoc()) {
					extract($row);

					$teacher_created_at = date_format(date_create($teacher_created_at), 'Y-m-d');

					$html .= <<<HTML
					<li class="d-flex justify-content-between">
						<a href="teacher_lessons.php?teacher_user_id=$user_id">
							<p>$given_name $family_name</p>
						</a>
						<p class="ml-2">$teacher_created_at</p>
					</li>
					HTML;
				}

				$html .= <<<HTML
					</ul>
				</aside>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function teachers_section()
	{
		$sql = "SELECT *, teachers.user_id AS teacher_user_id, teachers.created_at AS teacher_created_at, user_types.name AS user_type_name FROM teachers LEFT JOIN users ON teachers.user_id=users.id LEFT JOIN user_types ON users.user_type_id=user_types.id LEFT JOIN photos ON teachers.profile_photo_id=photos.id WHERE users.user_type_id = ? AND users.status=? LIMIT ?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("isi", $user_type_id, $status, $limit);

		$user_type_id = 2;
		$status = 'Active';
		$limit = 30;

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows > 0) {
				$html = <<<HTML
				<section class="blog_part py-0">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-xl-5">
								<div class="section_tittle text-center">
									<p>Our Educator</p>
									<h2>Teachers</h2>
								</div>
							</div>
						</div>
						<div class="row justify-content-center">
				HTML;

				while ($row = $stmt_result->fetch_assoc()) {
					extract($row);

					$html .= <<<HTML
					<div class="col-sm-6 col-lg-4 col-xl-4">
						<div class="single-home-blog">
							<div class="card">
								<div class="border" style="background-image: url('$file_path/$file_name'); background-repeat: no-repeat; background-position: center; background-size: cover; height: 250px;"></div>
								<div class="card-body">
									<a href="#" class="btn_4">$user_type_name</a>
									<a href="teacher_lessons.php?teacher_user_id=$teacher_user_id">
										<h5 class="card-title">$given_name $family_name</h5>
									</a>
									<ul class="d-flex justify-content-between">
										<li class="mr-0"><span class="ti-user"></span>Joined</li>
										<li class="mr-0"><span></span>$teacher_created_at</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					HTML;
				}

				$html .= <<<HTML
						</div>
					</div>
				</section>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function teachers_select($user_type_id, $status)
	{
		$sql = "SELECT *, teachers.id AS teacher_id, teachers.user_id AS teacher_user_id FROM teachers LEFT JOIN users ON teachers.user_id=users.id WHERE users.user_type_id = ? AND users.status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $user_type_id, $status);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows > 0) {
				$html = <<<HTML
				<select name="teacher_user_id" class="form-control" required="">
					<option selected="" disabled="">Select a Teacher</option>
				HTML;

				while ($row = $stmt_result->fetch_assoc()) {
					extract($row);

					$html .= <<<HTML
					<option value="$teacher_user_id">$given_name $family_name</option>
					HTML;
				}

				$html .= <<<HTML
				</select>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function public_dashboard_teacher($user_type_id, $status)
	{
		$sql = "SELECT * FROM teachers LEFT JOIN users ON users.id = teachers.user_id WHERE users.user_type_id = ? AND teachers.status = ?";

		$stmt = $this->mysql->prepare($sql);

		$stmt->bind_param("is", $user_type_id, $status);

		$html = '';

		if ($stmt->execute()) 
		{
			$result = $stmt->get_result();

			$count = $result->num_rows;

			$html .= <<<HTML
			$count
			HTML;
		}

		$stmt->close();

		return $html;
	}
}
?>