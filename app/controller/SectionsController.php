<?php  
session_start();
require_once '../core/Define.php';
require_once '../core/Database.php';
require_once '../core/Controller.php';

if (isset($_POST['load_sections_select'])) {
	$obj = new Controller;

	$view = $obj->view('SectionsView');
	echo json_encode($view->sections_select($_POST['teacher_user_id'], $_POST['status']));
}
elseif (isset($_POST['save'])) 
{
	$obj = new Controller;

	$model = $obj->model('Sections');
	$result = $model->findByName($_SESSION['USER_INFO']['user_id'], $_POST['section_name']);

	if ($result['execute'] == 'success' && $result['num_rows'] == 0) {
		$user_id = $_SESSION['USER_INFO']['user_id'];
		$section_name = $_POST['section_name'];
		$section_desc = $_POST['section_desc'];
		$section_status = $_POST['section_status'];

		$result = $model->save_new_section($user_id, $section_name, $section_desc, $section_status);

		if ($result == 'saved') 
		{
			$title = 'Successfully saved new section.';
		    $type = 'success';
		} else {
			$title = 'Sorry, an error has occured.';
		    $type = 'error';
		}
	}
	else {
		$title = 'Section name already exist.';
        $type = 'warning';
	}

	$obj->redirect('cms/teacher/sections.php', ['title' => $title, 'type' => $type]);
}
elseif (isset($_POST['section_update'])) {
	$obj = new Controller;

	$model = $obj->model('Sections');
	$result = $model->findById($_POST['id']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 1) {
			$user_id = $_SESSION['USER_INFO']['user_id'];			
			
			$result = $model->findByName($user_id, $_POST['section_name']);

			if ($result['execute'] == 'success' && $result['num_rows'] == 1) {

				if ($result['fetch_assoc']['id'] != $_POST['id']) {
					$title = 'Section name already exist.';
		        	$type = 'warning';

		        	$obj->redirect('cms/teacher/sections.php', ['title' => $title, 'type' => $type]);
				}
			}

			$id = $_POST['id'];
			$section_name = $_POST['section_name'];
			$section_desc = $_POST['section_desc'];
			$section_status = $_POST['section_status'];

			$result = $model->update_section($section_name, $section_desc, $section_status, $id);

			if ($result == 'updated') {
				$title = 'Updated successfully.';
			    $type = 'success';
			}
			else {
				$title = 'Failed to update.';
			    $type = 'error';
			}
		}
		else {
			$title = 'The data doesn’t match any record.';
			$type = 'error';
		}
	}
	else {
		$title = 'Sorry, an error has occured.';
	    $type = 'error';
	}

	$obj->redirect('cms/teacher/sections.php', ['title' => $title, 'type' => $type]);
}
elseif (isset($_POST['remove'])) {
	$obj = new Controller;

	$model = $obj->model('Sections');
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
				$model->module_type = 'sections';
				$model->status = 'Active';
				$model->save();

				$title = 'Section removed successfully.';
				$type = 'success';
			}
			else {
				$title = 'Section removed successfully with ' . $result['error'] . ' error(s).';
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

	$obj->redirect('cms/teacher/sections.php', ['title' => $title, 'type' => $type]);
}
?>