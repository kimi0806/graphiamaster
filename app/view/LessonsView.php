<?php
/**
 * 
 */
class LessonsView extends Database
{
	public $id;
	public $teacher_id;
	public $photo_id;
	public $name;
	public $description;
	public $audio_desc;
	public $video_desc;
	public $presentation_desc;
	public $status;
	public $created_at;
	public $updated_at;

	function __construct()
	{
		$this->mysql = $this->connect();
	}

	public function lesson_navigation($preview_id, $next_id)
	{
		$sql = "SELECT *, lessons.id AS lesson_id FROM lessons LEFT JOIN photos ON lessons.photo_id=photos.id WHERE lessons.id=? OR lessons.id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("ii", $preview_id, $next_id);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows > 0) {
				$html = <<<HTML
				<h4 class="title">Up Next</h4>
				<div class="navigation-area">
					<div class="row">
				HTML;

				while ($row = $stmt_result->fetch_assoc()) {
					extract($row);

					if (($preview_id != 0) && ($preview_id == $lesson_id)) {
						$html .= <<<HTML
						<div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
							<div class="thumb">
								<a href="lesson.php?lesson_id=$preview_id">
									<img class="img-fluid" src="$file_path/$file_name" style="width: 100px;" alt="">
								</a>
							</div>
							<div class="arrow">
								<a href="lesson.php?lesson_id=$preview_id">
									<span class="lnr text-white ti-arrow-left"></span>
								</a>
							</div>
							<div class="detials">
								<p>Prev Post</p>
								<a href="lesson.php?lesson_id=$preview_id">
									<h4>$name</h4>
								</a>
							</div>
						</div>
						HTML;
					}

					if (isset($next_id) && ($next_id == $lesson_id)) {
						$offset = ($preview_id == 0) ? 'offset-6' : '';

						$html .= <<<HTML
						<div class="$offset col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
							<div class="detials">
								<p>Next Post</p>
								<a href="lesson.php?lesson_id=$next_id">
									<h4>$name</h4>
								</a>
							</div>
							<div class="arrow">
								<a href="lesson.php?lesson_id=$next_id">
									<span class="lnr text-white ti-arrow-right"></span>
								</a>
							</div>
							<div class="thumb">
								<a href="lesson.php?lesson_id=$next_id">
									<img class="img-fluid" src="$file_path/$file_name" style="width: 100px;" alt="">
								</a>
							</div>
						</div>
						HTML;
					}
				}

				$html .= <<<HTML
					</div>
				</div>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function lesson_sidebar_info($id)
	{
		$sql = "SELECT *, lessons.id AS lesson_id, lessons.created_at AS lesson_created_at, activities.id AS activity_id, COUNT(activities.id) AS activity_count FROM lessons LEFT JOIN teachers ON lessons.user_id=teachers.user_id LEFT JOIN users ON teachers.user_id=users.id LEFT JOIN photos ON teachers.profile_photo_id=photos.id LEFT JOIN activities ON lessons.id=activities.lesson_id WHERE lessons.id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $id);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows == 1) {
				$row = $stmt_result->fetch_assoc();

				extract($row);

				$given_name = ucfirst($given_name);
				$family_name = ucfirst($family_name);

				$date_created = date_format(date_create($lesson_created_at), 'd');
				$month_created = date_format(date_create($lesson_created_at), 'M');
				$year_created = date_format(date_create($lesson_created_at), 'Y');

				$html = <<<HTML
				<ul class="lesson-sidebar-info">
					<li>
						<img src="$file_path/$file_name" class="border mb-3" style="height: 70px;">
						<a class="justify-content-between d-flex" href="#">
							<p>Teacher’s Name</p>
							<span class="color">$given_name $family_name</span>
						</a>
					</li>
					<li>
						<a class="justify-content-between d-flex" href="#">
							<p>Activity</p>
							<span>$activity_count</span>
						</a>
					</li>
					<li>
						<a class="justify-content-between d-flex" href="#">
							<p>Date</p>
							<span>$month_created $date_created, $year_created</span>
						</a>
					</li>
				</ul>
				<a href="activity.php?activity_id=$activity_id"><input type="button" class="btn btn_1 d-block w-100" value="Take Assesment"/></a>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function lesson_tab_content($id)
	{
		$sql = "SELECT *, lessons.id AS lessons_id FROM lessons WHERE id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $id);

		$html = '';

		if ($stmt->execute()) {

			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows == 1) {

				while ($row = $stmt_result->fetch_assoc())
				{
					$lessons_id = $row['lessons_id'];

					extract($row);

					$description = nl2br($description);
					$video_desc = nl2br($video_desc);
					$presentation_desc = nl2br($presentation_desc);

					$html .= <<<HTML
					<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
					<h4 class="title_top">Overview</h4>
					<div class="content">$description</div>
					</div>
					HTML;

					$html .= <<<HTML
						<div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">
							<h4 class="title_top">Description</h4>
							<div class="content">$video_desc</div>
					HTML;
					$query = "SELECT * FROM lesson_videos WHERE lesson_id = ?";

					$stmts = $this->mysql->prepare($query);

					$stmts->bind_param("i", $lessons_id);

					$stmts->execute();
					
					$results = $stmts->get_result();

					while ($rows = $results->fetch_assoc()) 
					{
						$file_path = $rows['file_path'];
						$file_name = $rows['file_name'];
						
						$html .= <<<HTML
						<h5>$file_name</h5>
						<video class="w-100 rounded mb-5" controls>
						<source src="$file_path/$file_name" type="video/mp4">
						<source src="$file_path/$file_name" type="video/ogg">
						</video>
						HTML;
					}
					$html .= <<<HTML
						</div>
					HTML;

					$html .= <<<HTML
					<div class="tab-pane fade" id="nav-presentation" role="tabpanel" aria-labelledby="nav-presentation-tab">
					<h4 class="title_top">Description</h4>
					<div class="content">$presentation_desc</div>
					<div class="reveal w-100">
					<div class="slides">
					<section data-transition-speed="fast">
					<a href="#/grand-finale"><h1>Go to the last slide</h1></a>
					<h4>Press 'F' to enter fullscreen</h4>
					</section>
					HTML;
					$queryy = "SELECT * FROM lesson_presentations WHERE lesson_id = ?";

					$stmtss = $this->mysql->prepare($queryy);

					$stmtss->bind_param("i", $lessons_id);

					$stmtss->execute();
					
					$resultss = $stmtss->get_result();

					while ($rowss = $resultss->fetch_assoc()) 
					{
						$file_path = $rowss['file_path'];
						$file_name = $rowss['file_name'];

						$html .= <<<HTML
						<section data-transition-speed="fast"><img class="r-stretch r-frame" src="$file_path/$file_name"></section>
						HTML;
					}
					$html .= <<<HTML
					<section data-transition-speed="fast" id="grand-finale">
					<h2>The end</h2>
					<a href="#"><h1>Back to the first</h1></a>
					</section>
					</div>
					</div>
					</div>
					</div>
					HTML;
				}
			}
		}

		$stmt->close();

		return $html;
	}

	public function lesson_top_info($id)
	{
		$sql = "SELECT *, lessons.created_at AS lesson_created_at FROM lessons LEFT JOIN teachers ON lessons.user_id=teachers.user_id LEFT JOIN users ON teachers.user_id=users.id LEFT JOIN photos ON lessons.photo_id=photos.id WHERE lessons.id=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("i", $id);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows == 1) {
				$row = $stmt_result->fetch_assoc();

				extract($row);

				$given_name = ucfirst($given_name);
				$family_name = ucfirst($family_name);

				$date_created = date_format(date_create($lesson_created_at), 'd');
				$month_created = date_format(date_create($lesson_created_at), 'M');
				$year_created = date_format(date_create($lesson_created_at), 'Y');

				$html = <<<HTML
				<div class="lesson-top-info main_image">
					<div class="border" style="background-image: url('$file_path/$file_name'); background-repeat: no-repeat; background-position: center; background-size: cover; height: 400px;"></div>
					<div class="mt-3">
						<h3>$name</h3>
						<ul class="d-flex justify-content-between">
							<li class="text-muted mr-0"><span class="ti-user mr-2"></span>$given_name $family_name</li>
							<li class="text-muted mr-0"><span class="ti-calendar mr-2"></span>$lesson_created_at</li>
						</ul>
					</div>
				</div>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function lessons_section($status, $limit)
	{
		$sql = "SELECT *, lessons.id AS lesson_id, lessons.name AS lesson_name, lessons.description AS lesson_description, user_types.name AS user_type_name, teachers.id AS teacher_id FROM lessons LEFT JOIN teachers ON lessons.user_id=teachers.user_id LEFT JOIN users ON teachers.user_id=users.id LEFT JOIN user_types ON users.user_type_id=user_types.id LEFT JOIN photos ON lessons.photo_id=photos.id WHERE lessons.status=? ORDER BY lessons.created_at DESC LIMIT ?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("si", $status, $limit);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows > 0) {
				$html = <<<HTML
				<section class="lessons-section special_cource py-0">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-xl-5">
								<div class="section_tittle text-center">
									<p>our lessons</p>
									<h2>Lessons</h2>
								</div>
							</div>
						</div>
						<div class="row justify-content-center">
				HTML;

				while ($row = $stmt_result->fetch_assoc()) {
					extract($row);

					$given_name = ucfirst($given_name);
					$family_name = ucfirst($family_name);
					$lesson_description = nl2br(substr($lesson_description, 0, 100));

					$html .= <<<HTML
					<div class="col-sm-6 col-lg-4">
						<div class="single_special_cource">
							<div class="border" style="background-image: url('$file_path/$file_name'); background-repeat: no-repeat; background-position: center; background-size: cover; height: 200px;"></div>
							<div class="special_cource_text">
								<a href="lesson.php?lesson_id=$lesson_id"><h3 class="mt-0">$lesson_name</h3></a>
								<p>$lesson_description &hellip;</p>
								<div class="author_info">
									<div class="author_img">
										<img src="dist/img/author/author_1.png" alt="">
										<div class="author_info_text">
											<p>$user_type_name</p>
											<h5><a href="teacher_lessons.php?teacher_user_id=$user_id">$given_name $family_name</a></h5>
										</div>
									</div>
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

	public function select($user_id, $status)
	{
		$sql = "SELECT * FROM lessons WHERE user_id=? AND status=?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("is", $user_id, $status);

		$html = <<<HTML
		<select name="lesson_id" class="form-control select2bs4" style="width: 100%;">
			<option value="0">None</option>
		HTML;

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

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

		$stmt->close();

		return $html;
	}

	public function other_lessons($status, $limit)
	{
		$sql = "SELECT *, lessons.id AS lesson_id, lessons.created_at AS lesson_created_at FROM lessons LEFT JOIN photos ON lessons.photo_id=photos.id WHERE lessons.status=? ORDER BY lessons.created_at DESC LIMIT ?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("si", $status, $limit);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows > 0) {
				$html = <<<HTML
				<aside class="other-lessons single_sidebar_widget popular_post_widget mt-5 mb-0">
					<h3 class="widget_title">Other Lessons</h3>
				HTML;

				while ($row = $stmt_result->fetch_assoc()) {
					extract($row);

					$html .= <<<HTML
					<div class="media post_item">
						<img src="$file_path/$file_name" class="border" style="height: 75px;" alt="">
						<div class="media-body">
							<a href="lesson.php?lesson_id=$lesson_id">
								<h3>$name</h3>
							</a>
							<p>$lesson_created_at</p>
						</div>
					</div>
					HTML;
				}

				$html .= <<<HTML
				</aside>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	public function teacher_lessons($user_id, $status, $limit)
	{
		$sql = "SELECT *, lessons.id AS lesson_id, lessons.created_at AS lesson_created_at FROM lessons LEFT JOIN teachers ON lessons.user_id=teachers.user_id LEFT JOIN users ON teachers.user_id=users.id LEFT JOIN photos ON lessons.photo_id=photos.id WHERE lessons.user_id=? AND lessons.status=? ORDER BY lessons.created_at DESC LIMIT ?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("isi", $user_id, $status, $limit);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows > 0) {

				while ($row = $stmt_result->fetch_assoc()) {
					extract($row);

					$date_created = date_format(date_create($lesson_created_at), 'd');
					$month_created = date_format(date_create($lesson_created_at), 'M');
					$description = nl2br(substr($description, 0, 250));

					$html .= <<<HTML
					<article class="teacher-lessons blog_item">
						<div class="blog_item_img">
							<div class="border" style="background-image: url('$file_path/$file_name'); background-repeat: no-repeat; background-position: center; background-size: cover; height: 350px;"></div>
							<a href="#" class="blog_item_date">
								<h3>$date_created</h3>
								<p>$month_created</p>
							</a>
						</div>
						<div class="blog_details">
							<a class="d-inline-block" href="lesson.php?lesson_id=$lesson_id">
								<h2>$name</h2>
							</a>
							<p>$description &hellip;</p>
							<ul class="blog-info-link">
								<li><a href="#"><i class="ti-user"></i>$given_name $family_name</a></li>
							</ul>
						</div>
					</article>
					HTML;
				}
			}
		}

		$stmt->close();

		return $html;
	}

	public function teacher_recent_lessons($user_id, $status, $limit)
	{
		$sql = "SELECT *, lessons.id AS lesson_id FROM lessons LEFT JOIN photos ON lessons.photo_id=photos.id WHERE lessons.user_id=? AND lessons.status=? ORDER BY lessons.created_at DESC LIMIT ?";

		$stmt = $this->mysql->prepare($sql);
		$stmt->bind_param("isi", $user_id, $status, $limit);

		$html = '';

		if ($stmt->execute()) {
			$stmt_result = $stmt->get_result();

			if ($stmt_result->num_rows > 0) {
				$html = <<<HTML
				<aside class="teacher-recent-lessons single_sidebar_widget popular_post_widget">
					<h3 class="widget_title">Recent Lessons</h3>
				HTML;

				while ($row = $stmt_result->fetch_assoc()) {
					extract($row);

					$description = nl2br(substr($description, 0, 50));

					$html .= <<<HTML
					<div class="media post_item">
						<img src="$file_path/$file_name" class="border" style="height: 75px;" alt="">
						<div class="media-body">
							<a href="lesson.php?lesson_id=$lesson_id">
								<h3>$name</h3>
							</a>
							<p>$description &hellip;</p>
						</div>
					</div>
					HTML;
				}

				$html .= <<<HTML
				</aside>
				HTML;
			}
		}

		$stmt->close();

		return $html;
	}

	// Mga nilipat ni arjay

	public function list_of_category_lessons($teacher_user_id, $status)
	{
		$sqlone = "SELECT * FROM users WHERE id = ? AND status = ?";

		$stmtone = $this->mysql->prepare($sqlone);

		$stmtone->bind_param("is", $teacher_user_id, $status);

		$html = '';

		$html = <<<HTML
		<table class="table table-bordered table-hover table-sm dt-default">
		<thead>
		<tr>
		<th>Lesson</th>
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

			$sqltwo = "SELECT * FROM lessons WHERE user_id = ? AND status = ?";

			$stmttwo = $this->mysql->prepare($sqltwo);

			$stmttwo->bind_param("is", $teacher_user_id, $status);

			if ($stmttwo->execute())
			{
				$resulttwo = $stmttwo->get_result();

				while ($datatwo = $resulttwo->fetch_assoc()) 
				{
					extract($datatwo);

					// $display = ($id == 1) ? 'd-none' : '';
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

	public function mdl_category_lesson_details($user_id, $status)
	{
		$sql = "SELECT * FROM lessons WHERE user_id=? AND status=?";

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
				<h4 class="modal-title">Category Lesson Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
				<div class="card card-widget widget-user-2">
				<div class="widget-user-header bg-warning">
				<div>
				<h3 class="widget-user-username ml-0"><i class="fas fa-book fa-xl" style='font-size:48px;'></i> $name</h3>
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
				<span class="badge bg-success ml-3 mb-3">$status</span>
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

	public function mdl_update_category_lesson_data($user_id, $status)
	{
		$sql = "SELECT *, lessons.id AS lessons_id FROM lessons WHERE user_id = ? AND status = ?";

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
				<div class="modal-dialog modal-lg">
				<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Edit Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<form method="post" action="../../app/controller/LessonsController.php" enctype="multipart/form-data">
				<div class="modal-body">
				<div class="row">
				HTML;

				$html .= <<<HTML
				<div class="col-lg-5">
				<input type="hidden" name="id" value="$lessons_id">
				HTML;

				$img_sql = "SELECT *, photos.id AS img_id FROM photos LEFT JOIN lessons ON photos.id = lessons.photo_id WHERE lessons.id = ?";

				$img_stmt = $this->mysql->prepare($img_sql);

				$img_stmt->bind_param("i", $lessons_id);

				if ($img_stmt->execute()) 
				{
					$img_result = $img_stmt->get_result();

					while ($img_data = $img_result->fetch_assoc())
					{
						extract($img_data);

						$html .= <<<HTML
						<input type="hidden" name="img_id" value="$img_id">
						<div class="form-group">
						<label>Lesson Image</label>
						<div class="custom-file">
						<input type="file" class="custom-file-input" name="img_name">
						<label class="custom-file-label" for="customFile">$file_name</label>
						</div>
						</div>
						HTML;
					}
				}

				$html .= <<<HTML
				<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="lessons_name" placeholder="Enter ..." value="$name">
				</div>
				<div class="form-group">
				<label>Description</label>
				<textarea class="form-control" rows="3" name="lessons_desc" placeholder="Enter ...">$description</textarea>
				</div>
				<div class="form-group">
				<label>Status</label>
				<select class="custom-select" name="lessons_status" required>
				<option value="$status" readonly selected>$status</option>
				<option value="Active">Active</option>
				<option value="Inactive">Inactive</option>
				</select>
				</div>
				</div>
				<div class="col-lg-7">
				<div class="card">
				<div class="card-header">
				<h3 class="card-title"><label>Files</label></h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body" style="height: 320px; overflow-y: auto;">
				<div id="accordion">
				<!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
				HTML;

				$html .= <<<HTML
				<div class="card card">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" aria-expanded="false">
						<div class="card-header">
							<h4 class="card-title">
								Video Files
							</h4>
						</div>
					</a>
					<div id="collapseOne" class="panel-collapse in collapse">
						<div class="card-body">
				HTML;

				$video_query = "SELECT *, lesson_videos.id AS video_lesson_id FROM lesson_videos WHERE lesson_id = ?";

				$video_stmt = $this->mysql->prepare($video_query);

				$video_stmt->bind_param("i", $lessons_id);

				if ($video_stmt->execute()) 
				{
					$video_result = $video_stmt->get_result();

					while ($video_data = $video_result->fetch_assoc()) 
					{
						extract($video_data);

						$html .= <<<HTML
						<div class="form-group">
						<label>Video File No. $video_lesson_id</label>
						<div class="custom-file">
						<input type="file" class="custom-file-input" name="video_lesson_file[$video_lesson_id]">
						<label class="custom-file-label" for="customFile" style="overflow-y: auto;">$file_name</label>
						</div>
						</div>
						HTML;
					}
				}

				$html .= <<<HTML
						</div>
					</div>
				</div>
				HTML;

				$html .= <<<HTML
				<div class="card card">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
						<div class="card-header">
							<h4 class="card-title">
								Presentation Files
							</h4>
						</div>
					</a>
					<div id="collapseThree" class="panel-collapse collapse">
						<div class="card-body">
				HTML;

				$presentation_query = "SELECT *, lesson_presentations.id AS lesson_presentation_id FROM lesson_presentations WHERE lesson_id = ? GROUP BY set_id";

				$presentation_stmt = $this->mysql->prepare($presentation_query);

				$presentation_stmt->bind_param("i", $lessons_id);

				if ($presentation_stmt->execute()) 
				{
					$presentation_result = $presentation_stmt->get_result();

					while ($presentation_data = $presentation_result->fetch_assoc()) 
					{
						extract($presentation_data);

						$html .= <<<HTML
						<div class="form-group">
						<label>Presentation File</label>
						<div class="custom-file">
						<input type="file" class="custom-file-input" name="presentation_lesson_file[$set_id][]" value="0" multiple>
						<label class="custom-file-label" for="customFile" style="overflow-y: auto;">Presentation No. $set_id</label>
						</div>
						</div>
						HTML;
					}
				}

				$html .= <<<HTML
						</div>
					</div>
				</div>
				HTML;

				$html .= <<<HTML
				</div>
				</div>
				<!-- /.card-body -->
				</div>
				</div>
				</div>
				</div>
				<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" name="category_lesson_update" class="btn btn-primary">Save changes</button>
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
		$sql = "SELECT * FROM lessons WHERE user_id=? AND status=?";

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
							<form method="post" action="../../app/controller/LessonsController.php">
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

	public function dashboard_lessons($teacher_user_id, $status)
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

			$sqltwo = "SELECT * FROM lessons WHERE user_id = ? AND status = ?";

			$stmttwo = $this->mysql->prepare($sqltwo);

			$stmttwo->bind_param("is", $teacher_user_id, $status);

			if ($stmttwo->execute())
			{
				$resulttwo = $stmttwo->get_result();

				$count = $resulttwo->num_rows;
				
				$html .= <<<HTML
				<div class="inner">
				<h3>$count</h3>
				<p>Lessons</p>
				</div>
				HTML;
			}

			$stmttwo->close();
		}

		$stmtone->close();

		return $html;
	}

	public function public_dashboard_lessons($status)
	{
		$sql = "SELECT * FROM lessons WHERE status = ?";

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

	public function students_taken_lesson($teacher_user_id, $status)
	{
		$queryone = "SELECT *, lessons.id AS lesson_id FROM lessons WHERE user_id = ? AND status = ?";

		$stmtone = $this->mysql->prepare($queryone);

		$stmtone->bind_param("is", $teacher_user_id, $status);

		$html = '';

		$html = <<<HTML
		<table class="table table-bordered table-hover table-sm table-sm dt-default">
			<thead>
				<tr>
					<th>Name</th>
					<th>Total Activities</th>
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

				$querytwo = "SELECT COUNT(activities.lesson_id) AS total_act FROM activities LEFT JOIN lessons ON lessons.id = activities.lesson_id WHERE activities.lesson_id = ? GROUP BY activities.lesson_id";

				$stmttwo = $this->mysql->prepare($querytwo);

				$stmttwo->bind_param("i", $id);

				if ($stmttwo->execute()) 
				{
					$resulttwo = $stmttwo->get_result();

					$datatwo = $resulttwo->fetch_assoc();

					$total_act = $datatwo['total_act'];

					$student_id = $_GET['student_id'];

					$html .= <<<HTML
					<tr>
					<td>$name</td>
					<td align="center"><span class="right badge badge-primary">$total_act</span></td>
					<td>$status</td>
					<td>$created_at</td>
					<td align="center">
					<label class="badge badge-pill $badge_type">$date_status</label>
					</td>
					<td align="center">
					<a href="per_students.php" class="btn btn-sm btn-primary mr-2"><i class="fas fa-arrow-left fa-lg"></i>
					<a href="per_activities.php?student_id=$student_id&lesson_id=$lesson_id" class="btn btn-sm btn-primary"><i class="fas fa-arrow-right fa-lg"></i>
					</a>
					</td>
					</tr>
					HTML;
				}
			}
		}

		$html .= <<<HTML
			</tbody>
		</table>
		HTML;

		$stmtone->close();

		return $html;
	}

	// public function students_taken_lesson($teacher_user_id, $student_id, $lesson_status)
	// {
	// 	$queryone = "SELECT *, activities.id AS activity_id, activities.lesson_id AS lessons_id FROM activities";

	// 	$stmtone = $this->mysql->prepare($queryone);

	// 	$html = '';

	// 	if ($stmtone->execute()) 
	// 	{
	// 		$resultone = $stmtone->get_result();

	// 		while ($dataone = $resultone->fetch_assoc()) 
	// 		{
	// 			extract($dataone);

	// 			$querytwo = "SELECT * FROM student_activities WHERE activity_id = ? AND user_id = ?";

	// 			$stmttwo = $this->mysql->prepare($querytwo);

	// 			$stmttwo->bind_param("ii", $activity_id, $student_id);

	// 			if ($stmttwo->execute()) 
	// 			{
	// 				$querythree = "SELECT *, lessons.id AS lesson_id, lessons.status AS lesson_status FROM lessons WHERE id = ? AND lesson_status = ? AND user_id = ?";

	// 				$stmtthree = $this->mysql->prepare($querythree);

	// 				$stmtthree->bind_param("isi", $lessons_id, $lesson_status, $teacher_user_id);

					// $html = <<<HTML
					// <table class="table table-bordered table-hover dt-default">
					// 	<thead>
					// 		<tr>
					// 			<th>Name</th>
					// 			<th>Status</th>
					// 			<th>Created</th>
					// 			<th colspan="2">Updated</th>
					// 			<th width="100">Action</th>
					// 		</tr>
					// 	</thead>
					// 	<tbody>
					// HTML;

	// 				if ($stmtthree->execute()) 
	// 				{
	// 					$resulthree = $stmtthree->get_result();

	// 					while ($datathree = $resulthree->fetch_assoc()) 
	// 					{
	// 						extract($datathree);

							// $parsed_date = date_parse($lesson_status);
							// $year_and_month = $parsed_date['year'] . '-' . $parsed_date['month'];
							// $badge_type = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'badge-success' : 'badge-secondary';
							// $date_status = (strtotime($year_and_month) == strtotime(date('Y-m'))) ? 'New' : 'Old';

							// $html .= <<<HTML
							// <tr>
							// <td>$name</td>
							// <td>$status</td>
							// <td>created_at</td>
							// <td>$updated_at</td>
							// <td align="center">
							// <label class="badge badge-pill $badge_type">$date_status</label>
							// </td>
							// <td align="center">
							// <a href="#?lesson_id=$lesson_id" class="btn btn-sm btn-primary w-100">
							// <i class="fas fa-arrow-right fa-lg"></i>
							// </a>
							// </td>
							// </tr>
							// HTML;
	// 					}
	// 				}

	// 				$html .= <<<HTML
	// 					</tbody>
	// 				</table>
	// 				HTML;

	// 				$stmtthree->close();
	// 			}

	// 			$stmttwo->close();
	// 		}
	// 	}

	// 	$stmtone->close();

	// 	return $html;
	// }
}
?>