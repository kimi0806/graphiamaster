<?php
require_once '../core/Session.php';
require_once '../core/Define.php';
require_once '../core/Database.php';
require_once '../core/Controller.php';

if (isset($_POST['load_notifications'])) {
	$obj = new Controller;

	$model = $obj->model('Users');
	$result = $model->findById($_POST['to_user_id']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 1) {
			$view = $obj->view('NotificationsView');
			$view_result = $view->load_notifications($_POST['to_user_id']);

			extract($view_result);

			$title = ($count > 0) ? "You have $count new notification(s)." : '';
			$type = 'info';

			echo json_encode([
				'alert' => ['title' => $title, 'type' => $type],
				'count' => $count,
				'view' => $html
			]);

			exit();
		}
		else {
			$title = 'Your account id doesn’t match any record.';
			$type = 'error';
		}
	}
	else{
		$title = 'Failed to load notifications, an error has occured.';
	    $type = 'error';
	}

	echo json_encode([
		'alert' => ['title' => $title, 'type' => $type],
		'count' => 0,
		'view' => 'No data to show.'
	]);

	exit();
}
elseif (isset($_POST['seen_notifications'])) {
	$obj = new Controller;

	$model = $obj->model('Users');
	$result = $model->findById($_POST['to_user_id']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 1) {
			$model = $obj->model('Notifications');
			$result = $model->findByToUserId($_POST['to_user_id']);

			if ($result['execute'] == 'success') {

				if ($result['num_rows'] > 0) {
					$error = 0;

					foreach ($result['fetch_assoc'] as $key => $value) {
						$array = [
							'enable' => $_POST['enable'],
							'updated_at' => date('Y-m-d H:i:s')
						];

						$result = $model->update($value['id'], $array);

						if ($result['error'] > 0) {
							$count = $count + $result['error'];
						}
					}

					if ($error == 0) {
						$title = 'Notification seen successfully.';
						$type = 'success';
					}
					else {
						$title = 'Notification seen successfully with ' . $error . ' error(s).';
				    	$type = 'warning';
					}

					echo json_encode(['alert' => ['title' => $title, 'type' => $type]]);

					exit();
				}
				else {
					$title = 'The notifications you’ve seen doesn’t match any record.';
					$type = 'error';
				}
			}
			else{
				$title = 'Failed to seen notifications, an error has occured.';
	    		$type = 'error';
			}
		}
		else {
			$title = 'Your account id doesn’t match any record.';
			$type = 'error';
		}
	}
	else{
		$title = 'Failed to seen notifications, an error has occured.';
	    $type = 'error';
	}

	echo json_encode(['alert' => ['title' => $title, 'type' => $type]]);

	exit();
}
?>