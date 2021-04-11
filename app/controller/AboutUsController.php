<?php
require_once '../core/Session.php';
require_once '../core/Define.php';
require_once '../core/Database.php';
require_once '../core/Controller.php';

if (isset($_POST['update'])) {
	$obj = new Controller;

	$model = $obj->model('AboutUs');
	$result = $model->findById($_POST['id']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 1) {
			$array = [
				'name' => $_POST['name'],
				'description' => $_POST['description'],
				'email_address' => $_POST['email_address'],
				'mobile_number' => $_POST['mobile_number'],
				'telephone_number' => $_POST['telephone_number'],
				'location' => $_POST['location'],
				'updated_at' => date('Y-m-d H:i:s')
			];

			$result = $model->update($_POST['id'], $array);

			if ($result['success'] == 7 && $result['error'] == 0) {
				$title = 'Content updated successfully.';
				$type = 'success';
			}
			else {
				$title = 'Content updated successfully with ' . $result['error'] . 'error(s).';
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

	$obj->redirect('cms/administrator/about_us.php', ['title' => $title, 'type' => $type]);
}
?>