<?php
require_once '../core/Session.php';
require_once '../core/Define.php';
require_once '../core/Database.php';
require_once '../core/Controller.php';

if (isset($_POST['save'])) {
	$obj = new Controller;

	$model = $obj->model('StudentActivities');
	$result = $model->findByActivityId($_SESSION['USER_INFO']['user_id'], $_POST['activity_id']);

	if ($result['execute'] == 'success' && $result['num_rows'] == 0) {
		$count = count($_POST['answer']);

		foreach ($_POST['answer'] as $key => $row) {
			$model->user_id = $_SESSION['USER_INFO']['user_id'];
			$model->activity_id = $_POST['activity_id'];
			$model->activity_item_id = $_POST['activity_item_id'][$key];
			$model->answer = $_POST['answer'][$key];
			$model->checked = 0;
			$model->status = 'Active';

			$result = $model->save();

			if ($result['execute'] == 'success') {
				$count--;
			}
		}

		if ($count == 0) {
			$title = 'Submitted successfully.';
			$type = 'success';
		}
		else {
			$title = 'Submitted successfully with ' . $count . 'error(s)';
			$type = 'warning';
		}
	}
	else {
		$title = 'You\'ve already answered this activity.';
		$type = 'warning';
	}

	$activity_id = $_POST['activity_id'];

	$obj->redirect('activity.php', ['title' => $title, 'type' => $type, 'other' => "activity_id=$activity_id"]);
}
?>