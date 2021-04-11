<?php
require_once '../core/Session.php';
require_once '../core/Define.php';
require_once '../core/Database.php';
require_once '../core/Controller.php';

if (isset($_POST['remove'])) {
	$obj = new Controller;

	$model = $obj->model('ActivityItems');
	$result = $model->findById($_POST['id']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 1) {
			$array = [
				'status' => 'Removed',
				'updated_at' => date('Y-m-d H:i:s')
			];

			$result = $model->update($_POST['id'], $array);

			if ($result['success'] == 2 && $result['error'] == 0) {
				$model = $obj->model('SystemTrashes');
				$model->user_id = $_SESSION['USER_INFO']['user_id'];
				$model->module_primary_id = $_POST['id'];
				$model->module_type = 'activity_items';
				$model->status = 'Active';
				$model->save();

				$title = 'Removed successfully.';
				$type = 'success';
			}
			else {
				$title = 'Removed successfully with ' . $result['error'] . ' error(s).';
		    	$type = 'warning';
			}
		}
		else {
			$title = 'The data you’ve submitted doesn’t match any record.';
			$type = 'error';
		}
	}
	else{
		$title = 'Sorry, an error has occured.';
	    $type = 'error';
	}

	$http_referer = $_SERVER['HTTP_REFERER'];

	header("Location: $http_referer&title=$title&type=$type");
	exit();
}
elseif (isset($_POST['save'])) {
	$obj = new Controller;

	$model = $obj->model('ActivityItems');
	$result = $model->findByActivityId($_POST['activity_id']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] > 0) {
			$count = count($_POST['problem']);

			$model = $obj->model('ActivityItems');

			foreach ($_POST['problem'] as $key => $row) {

				if (!empty($_POST['problem'][$key])) {
					$result = $model->findByProblem($_POST['activity_id'], $_POST['problem'][$key]);

					if ($result['execute'] == 'success' && $result['num_rows'] == 0) {
						$model->activity_id = $_POST['activity_id'];
						$model->arrangement = $_POST['arrangement'][$key];
						$model->problem = $_POST['problem'][$key];
						$model->solution = $_POST['solution'][$key];
						$model->status = 'Active';

						$result = $model->save();

						if ($result['execute'] == 'success') {
							$count--;
						}
					}
				}
			}

			if ($count == 0) {
				$title = 'Saved successfully.';
				$type = 'success';
			}
			else {
				$title = 'Failed to save ' . $count . ' activity item(s).';
				$type = 'success';
			}
		}
		else {
			$title = 'The data you’ve submitted doesn’t match any record.';
			$type = 'error';
		}
	}
	else{
		$title = 'Sorry, an error has occured.';
	    $type = 'error';
	}

	$activity_id = $_POST['activity_id'];

	$obj->redirect('cms/teacher/edit_activity.php', ['title' => $title, 'type' => $type, 'other' => "activity_id=$activity_id"]);
}
elseif (isset($_POST['update'])) {
	$obj = new Controller;

	$model = $obj->model('ActivityItems');
	$result = $model->findById($_POST['id']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 1) {	
			$activity_id = $result['fetch_assoc']['activity_id'];

			$result = $model->findByProblem($activity_id, $_POST['problem']);

			if ($result['execute'] == 'success' && $result['num_rows'] == 1) {

				if ($result['fetch_assoc']['id'] != $_POST['id']) {
					$title = 'Activity title already exist.';
		        	$type = 'warning';

		        	$http_referer = $_SERVER['HTTP_REFERER'];

					header("Location: $http_referer&title=$title&type=$type");
					exit();
				}
			}

			$array = [
				'arrangement' => $_POST['arrangement'],
				'problem' => $_POST['problem'],
				'solution' => $_POST['solution'],
				'updated_at' => date('Y-m-d H:i:s')
			];

			$result = $model->update($_POST['id'], $array);

			if ($result['success'] == 4 && $result['error'] == 0) {
				$title = 'Updated successfully.';
				$type = 'success';
			}
			else {
				$title = 'Updated successfully with ' . $result['error'] . 'error(s).';
		    	$type = 'warning';
			}
		}
		else {
			$title = 'The data you’ve submitted doesn’t match any record.';
			$type = 'error';
		}
	}
	else{
		$title = 'Sorry, an error has occured.';
	    $type = 'error';
	}

	$http_referer = $_SERVER['HTTP_REFERER'];

	header("Location: $http_referer&title=$title&type=$type");
	exit();
}
?>