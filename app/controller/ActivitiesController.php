<?php
require_once '../core/Session.php';
require_once '../core/Define.php';
require_once '../core/Database.php';
require_once '../core/Controller.php';

if (isset($_POST['remove'])) {
	$obj = new Controller;

	$model = $obj->model('Activities');
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
				$model->module_type = 'activities';
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

	$obj->redirect('cms/teacher/activities.php', ['title' => $title, 'type' => $type]);
}
elseif (isset($_POST['save'])) {
	$obj = new Controller;

	$model = $obj->model('Activities');
	$result = $model->findByLessonId($_SESSION['USER_INFO']['user_id'], $_POST['lesson_id']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 0) {
			$result = $model->findByTitle($_SESSION['USER_INFO']['user_id'], $_POST['lesson_id'], $_POST['title']);

			if ($result['execute'] == 'success' && $result['num_rows'] == 0) {
				$model->user_id = $_SESSION['USER_INFO']['user_id'];
				$model->lesson_id = $_POST['lesson_id'];
				$model->title = $_POST['title'];
				$model->description = $_POST['description'];
				$model->instruction = $_POST['instruction'];
				$model->status = 'Active';

				$result = $model->save();

				if ($result['execute'] == 'success') {
					$activity_id = $result['insert_id'];
					$count = count($_POST['problem']);

					$model = $obj->model('ActivityItems');

					foreach ($_POST['problem'] as $key => $row) {
						$result = $model->findByProblem($activity_id, $_POST['problem'][$key]);

						if ($result['execute'] == 'success' && $result['num_rows'] == 0) {
							$model->activity_id = $activity_id;
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
					$title = 'Opps, something went wrong.';
		    		$type = 'error';
				}
			}
			else {
				$title = 'Activity already exist.';
	        	$type = 'warning';
			}
		}
		else {
			$title = 'Lesson already have an activity.';
	        $type = 'warning';
		}
	}
	else{
		$title = 'Sorry, an error has occured.';
	    $type = 'error';
	}

	$obj->redirect('cms/teacher/activities.php', ['title' => $title, 'type' => $type]);
}
elseif (isset($_POST['update'])) {
	$obj = new Controller;

	$model = $obj->model('Activities');
	$result = $model->findById($_POST['id']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 1) {	
			$result = $model->findByTitle($_SESSION['USER_INFO']['user_id'], $_POST['lesson_id'], $_POST['title']);

			if ($result['execute'] == 'success' && $result['num_rows'] == 1) {

				if ($result['fetch_assoc']['id'] != $_POST['id']) {
					$title = 'Activity title already exist.';
		        	$type = 'warning';

		        	$activity_id = $_POST['id'];

		        	$obj->redirect('cms/teacher/edit_activity.php', ['title' => $title, 'type' => $type, 'other' => "activity_id=$activity_id"]);
				}
			}

			$array = [
				'lesson_id' => $_POST['lesson_id'],
				'title' => $_POST['title'],
				'description' => $_POST['description'],
				'instruction' => $_POST['instruction'],
				'updated_at' => date('Y-m-d H:i:s')
			];

			$result = $model->update($_POST['id'], $array);

			if ($result['success'] == 5 && $result['error'] == 0) {
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

	$activity_id = $_POST['id'];

	$obj->redirect('cms/teacher/edit_activity.php', ['title' => $title, 'type' => $type, 'other' => "activity_id=$activity_id"]);
}
?>