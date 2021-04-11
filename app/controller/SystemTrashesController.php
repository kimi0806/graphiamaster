<?php
require_once '../core/Session.php';
require_once '../core/Define.php';
require_once '../core/Database.php';
require_once '../core/Controller.php';

if (isset($_POST['delete'])) {
	$obj = new Controller;

	$model = $obj->model('SystemTrashes');
	$result = $model->findById($_POST['id']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 1) {

			switch ($result['fetch_assoc']['module_type']) {
				case 'activities':
					$model = $obj->model('Activities');
					break;

				case 'activity_items':
					$model = $obj->model('ActivityItems');
					break;

				case 'sections':
					$model = $obj->model('Sections');
					break;

				case 'lessons':
					$model = $obj->model('Lessons');
					break;

				default:
					# code...
					break;
			}

			$result = $model->delete($result['fetch_assoc']['module_primary_id']);

			if ($result['execute'] == 'success') {
				$model = $obj->model('SystemTrashes');
				$model->delete($_POST['id']);

				$title = 'Record deleted successfully.';
				$type = 'success';
			}
			else {
				$title = 'Failed to remove selected record.';
		    	$type = 'error';
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

	$obj->redirect($_POST['return_url'], ['title' => $title, 'type' => $type]);
}
elseif (isset($_POST['recover'])) {
	$obj = new Controller;

	$model = $obj->model('SystemTrashes');
	$result = $model->findById($_POST['id']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 1) {
			$array = [
				'status' => 'Active',
				'updated_at' => date('Y-m-d H:i:s')
			];

			switch ($result['fetch_assoc']['module_type']) {
				case 'activities':
					$model = $obj->model('Activities');
					break;

				case 'activity_items':
					$model = $obj->model('ActivityItems');
					break;

				case 'sections':
					$model = $obj->model('Sections');
					break;

				case 'lessons':
					$model = $obj->model('Lessons');
					break;

				case 'users':
					$model = $obj->model('Users');
					break;
				
				default:
					# code...
					break;
			}

			$result = $model->update($result['fetch_assoc']['module_primary_id'], $array);

			if ($result['success'] == 2 && $result['error'] == 0) {
				$model = $obj->model('SystemTrashes');
				$model->delete($_POST['id']);

				$title = 'Record recovered successfully.';
				$type = 'success';
			}
			else {
				$title = 'Record recovered successfully with ' . $result['error'] . ' error(s).';
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

	$obj->redirect($_POST['return_url'], ['title' => $title, 'type' => $type]);
}
?>