<?php  
session_start();
require_once '../core/Define.php';
require_once '../core/Database.php';
require_once '../core/Controller.php';

if (isset($_POST['update_student_class'])) 
{
	$sections_id = $_POST['sections_id'];
	$status = $_POST['status'];
	$students_id = $_POST['students_id'];

	$obj = new Controller;
	$model = $obj->model('Students');

	if ($model->update_student_class($sections_id, $status, $students_id) == 'success') 
	{
		$title = 'Successfully Update.';
		$type = 'success';
	}else{
		$title = 'Sorry, an error has occured.';
		$type = 'error';
	}

	$obj->redirect('cms/teacher/students.php', ['title' => $title, 'type' => $type, 'other' => "sections_id=$sections_id"]);
}
elseif (isset($_POST['remove'])) {
	$obj = new Controller;

	$model = $obj->model('Users');
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
				$model->module_type = 'users';
				$model->status = 'Active';
				$model->save();

				$title = 'User removed successfully.';
				$type = 'success';
			}
			else {
				$title = 'User removed successfully with ' . $result['error'] . ' error(s).';
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

	$obj->redirect('cms/teacher/users.php', ['title' => $title, 'type' => $type]);
}
elseif (isset($_POST['transfer'])) 
{
	$section_id = $_POST['sections'];
	$students_id = $_POST['students_id'];

	$obj = new Controller;
	$model = $obj->model('Students');

	if ($model->change_section($section_id, $students_id) == 'transfered') 
	{
		$title = 'Successfully Transfered.';
		$type = 'success';
	}else{
		$title = 'Failed to change.';
		$type = 'error';
	}

	$obj->redirect('cms/teacher/students.php', ['title' => $title, 'type' => $type, 'other' => "sections_id=$section_id"]);
}
elseif (isset($_POST['update_acc_details'])) 
{
	if (isset($_POST['users_id'])) 
	{
		$given_name = $_POST['given_name'];
		$middle_name = $_POST['middle_name'];
		$family_name = $_POST['family_name'];
		$id = $_POST['users_id'];

		$obj = new Controller;
		$model = $obj->model('Users');

		if ($model->update_student_fullname($given_name, $middle_name, $family_name, $id) == 'updated') 
		{
			$title = 'Successfully Updated Your Profile Details.';
			$type = 'success';
		}else{
			$title = 'Sorry, an error has occured.';
			$type = 'error';
		}
	}
	
	if (isset($_POST['students_id'])) 
	{
		$sex = $_POST['sex'];
		$date_of_birth = $_POST['date_of_birth'];
		$mobile_number = $_POST['mobile_number'];
		$id = $_POST['students_id'];

		$obj = new Controller;
		$model = $obj->model('Students');

		if ($model->update_student_info($sex, $date_of_birth, $mobile_number, $id) == 'updated') 
		{
			$title = 'Successfully Updated Your Profile Details.';
			$type = 'success';
		}else{
			$title = 'Sorry, an error has occured.';
			$type = 'error';
		}
	}
	
	$obj->redirect('user_personal_details.php', ['title' => $title, 'type' => $type]);
}
?>