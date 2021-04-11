<?php
require_once '../core/Session.php';
require_once '../core/Define.php';
require_once '../core/Database.php';
require_once '../core/Controller.php';

if (isset($_POST['save'])) {
	$obj = new Controller;

	$model = $obj->model('StudentActivityPoints');
	$result = $model->findByStudentActivityId($_POST['student_activity_id']);

	if ($result['execute'] == 'success' && $result['num_rows'] == 0) {
		$model->student_activity_id = $_POST['student_activity_id'];
		$model->point = $_POST['point'];
		$model->correction = $_POST['correction'];
		$model->recommendation = $_POST['recommendation'];
		$model->status = 'Active';

		$result = $model->save();

		if ($result['execute'] == 'success') {
			$model = $obj->model('StudentActivities');

			$array = [
				'checked' => 1,
				'updated_at' => date('Y-m-d H:i:s')
			];

			$result = $model->update($_POST['student_activity_id'], $array);

			if ($result['success'] == 2 && $result['error'] == 0) {
				$title = 'Saved successfully.';
				$type = 'success';
			}
			else {
				$title = 'Saved successfully with ' . $result['error'] . ' error(s).';
		    	$type = 'warning';
			}
		}
		else {
			$title = 'Sorry, an error has occured.';
	    	$type = 'error';
		}
	}
	else {
		$title = 'You\'ve already checked this item.';
		$type = 'warning';
	}

	$http_referer = $_SERVER['HTTP_REFERER'];

	header("Location: $http_referer&title=$title&type=$type");
	exit();
}
elseif (isset($_POST['update'])) {
	$obj = new Controller;

	$model = $obj->model('StudentActivityPoints');
	$result = $model->findById($_POST['id']);

	if ($result['execute'] == 'success' && $result['num_rows'] == 1) {
		$array = [
			'point' => $_POST['point'],
			'correction' => $_POST['correction'],
			'recommendation' => $_POST['recommendation'],
			'updated_at' => date('Y-m-d H:i:s')
		];

		$result = $model->update($_POST['id'], $array);

		if ($result['success'] == 4 && $result['error'] == 0) {
			$title = 'Updated successfully.';
			$type = 'success';
		}
		else {
			$title = 'Updated successfully with ' . $result['error'] . ' error(s).';
	    	$type = 'warning';
		}
	}
	else {
		$title = 'The data doesn’t match any record.';
		$type = 'error';
	}

	$http_referer = $_SERVER['HTTP_REFERER'];

	header("Location: $http_referer&title=$title&type=$type");
	exit();
}
?>