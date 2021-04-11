<?php
session_start();
require_once '../core/Define.php';
require_once '../core/Database.php';
require_once '../core/Controller.php';

if (isset($_POST['create'])) {
	$obj = new Controller;

	$model = $obj->model('Users');
	$result = $model->findByEmailAddress($_POST['email_address']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 0) {
			$model = $obj->model('Photos');

			$filename_with_ext = $_FILES['photo']['name'];
			$filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
			$extension = pathinfo($filename_with_ext, PATHINFO_EXTENSION);

			$file_path = 'storage/pictures/users';
			$file_name = substr($filename, 0, 15) . '_' . time() . '.' . $extension;

			$model->file_path = $file_path;
			$model->file_name = $file_name;
			$model->type = 'profile';
			$model->status = 'Active';

			$result = $model->save();

			if ($result['execute'] == 'success') {
				$path = "../../$file_path/$file_name";
				move_uploaded_file($_FILES['photo']['tmp_name'], $path);

				$profile_photo_id = $result['insert_id'];
			}
			else {
				$profile_photo_id = 0;
			}

			$model = $obj->model('Users');

			$model->user_type_id = $_POST['user_type_id'];
			$model->family_name = $_POST['family_name'];
			$model->given_name = $_POST['given_name'];
			$model->middle_name = '';
			$model->email_address = $_POST['email_address'];
			$model->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$model->status = 'Active';

			$users_result = $model->save();

			if ($result['execute'] == 'success') {
				$user_id = $users_result['insert_id'];

				$filename_with_ext = $_FILES['identity_photo']['name'];
				$filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
				$extension = pathinfo($filename_with_ext, PATHINFO_EXTENSION);

				$file_path = 'storage/pictures/identity_cards';
				$file_name = substr($filename, 0, 15) . '_' . time() . '.' . $extension;

				$path = "../../$file_path/$file_name";

				move_uploaded_file($_FILES['identity_photo']['tmp_name'], $path);

				$model = $obj->model('Photos');

				$model->file_path = $file_path;
				$model->file_name = $file_name;
				$model->type = 'identity_card';
				$model->status = 'Active';

				$photos_result = $model->save();

				$identity_photo_id = $photos_result['insert_id'];

				$model = $obj->model('Teachers');

				$model->user_id = $user_id;
				$model->profile_photo_id = $profile_photo_id;
				$model->identity_photo_id = $identity_photo_id;
				$model->sex = $_POST['sex'];
				$model->date_of_birth = date_format(date_create($_POST['date_of_birth']),'Y-m-d');
				$model->mobile_number = $_POST['mobile_number'];
				$model->type_of_school = $_POST['type_of_school'];
				$model->school_name = $_POST['school_name'];
				$model->school_address = $_POST['school_address'];
				$model->status = 'Active';

				$result = $model->save();

				if ($result['execute'] == 'success') {
					$title = 'Saved successfully.';
	    			$type = 'success';
				}
				else {
					$title = 'Opps, something went wrong.';
		    		$type = 'error';
				}
			}
			else {
				$title = 'Opps, something went wrong.';
	    		$type = 'error';
			}
		}
		else {
			$title = 'That email address is taken. Try another.';
	        $type = 'warning';
		}
	}
	else{
		$title = 'Sorry, an error has occured.';
	    $type = 'error';
	}

	
	$obj->redirect('cms/administrator/users.php', ['title' => $title, 'type' => $type]);
}
elseif (isset($_POST['login'])) {
	$obj = new Controller;

	$model = $obj->model('Users');
	$result = $model->findByEmailAddress($_POST['email_address']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 1 && $result['fetch_assoc']['status'] == 'Active') {

			if (password_verify($_POST['password'], $result['fetch_assoc']['password'])) {
			
				if ($result['fetch_assoc']['user_type_id'] == 1) {
					$obj->session(['USER_INFO' => ['user_id' => $result['fetch_assoc']['id']]]);
					$obj->redirect('cms/administrator/dashboard.php');
				}
				elseif ($result['fetch_assoc']['user_type_id'] == 2) {
					$obj->session(['USER_INFO' => ['user_id' => $result['fetch_assoc']['id']]]);
					$obj->redirect('cms/teacher/dashboard.php');
				}
				else {
					$obj->session(['USER_INFO' => ['user_id' => $result['fetch_assoc']['id']]]);
					$obj->redirect('index.php');
				}
			}
			else {
				$title = 'Password didn’t match. Try again.';
				$type = 'warning';
			}
		}
		else {
			$title = 'The email you’ve entered doesn’t match any account.';
			$type = 'error';
		}
	}
	else{
		$title = 'Sorry, an error has occured.';
	    $type = 'error';
	}

	$obj->redirect('index.php', ['title' => $title, 'type' => $type]);
}
elseif (isset($_POST['logout'])) {
	unset($_SESSION['USER_INFO']);

	$title = 'Thank you for visiting us! We look forward to seeing you again.';
	$type = 'success';

	$obj = new Controller;
	$obj->redirect('index.php', ['title' => $title, 'type' => $type]);
}
elseif (isset($_POST['register'])) {
	$obj = new Controller;

	$model = $obj->model('Users');
	$result = $model->findByEmailAddress($_POST['email_address']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 0) {
			$model = $obj->model('Users');

			$model->user_type_id = $_POST['user_type_id'];
			$model->family_name = $_POST['family_name'];
			$model->given_name = $_POST['given_name'];
			$model->middle_name = $_POST['middle_name'];
			$model->email_address = $_POST['email_address'];
			$model->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$model->status = 'Active';

			$users_result = $model->save();

			if ($users_result['execute'] == 'success') {
				$user_id = $users_result['insert_id'];

				$model = $obj->model('Photos');

				$model->file_path = 'storage/pictures/users';
				$model->file_name = ($_POST['sex'] == 'Male')? 'default-m.png' : 'default-f.png';
				$model->type = 'profile';
				$model->status = 'Active';

				$photos_result = $model->save();

				$profile_photo_id = $photos_result['insert_id'];

				switch ($_POST['user_type_id']) {
					case 2:
						$filename_with_ext = $_FILES['identity_photo']['name'];
						$filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
						$extension = pathinfo($filename_with_ext, PATHINFO_EXTENSION);

						$file_path = 'storage/pictures/identity_cards';
						$file_name = substr($filename, 0, 15) . '_' . time() . '.' . $extension;

						$path = "../../$file_path/$file_name";

						move_uploaded_file($_FILES['identity_photo']['tmp_name'], $path);

						$model = $obj->model('Photos');

						$model->file_path = $file_path;
						$model->file_name = $file_name;
						$model->type = 'identity_card';
						$model->status = 'Active';

						$photos_result = $model->save();

						$identity_photo_id = $photos_result['insert_id'];
				
						$model = $obj->model('Teachers');

						$model->user_id = $user_id;
						$model->profile_photo_id = $profile_photo_id;
						$model->identity_photo_id = $identity_photo_id;
						$model->sex = $_POST['sex'];
						$model->date_of_birth = date_format(date_create($_POST['date_of_birth']),'Y-m-d');
						$model->mobile_number = $_POST['mobile_number'];
						$model->type_of_school = $_POST['type_of_school'];
						$model->school_name = $_POST['school_name'];
						$model->school_address = $_POST['school_address'];
						$model->status = 'Active';
						$model->save();
						break;

					case 3:
						$model = $obj->model('Students');

						$model->user_id = $user_id;
						$model->teacher_user_id = $_POST['teacher_user_id'];
						$model->section_id = $_POST['section_id'];
						$model->profile_photo_id = $profile_photo_id;
						$model->sex = $_POST['sex'];
						$model->date_of_birth = date_format(date_create($_POST['date_of_birth']),'Y-m-d');
						$model->mobile_number = $_POST['mobile_number'];
						$model->educational_attainment = $_POST['educational_attainment'];
						$model->school_attended = $_POST['school_attended'];
						$model->status = 'Active';
						$model->save();

						$obj->session(['USER_INFO' => ['user_id' => $user_id]]);
						break;
					
					default:
						# code...
						break;
				}
				
				$obj->redirect('index.php');
			}
			else {
				$title = 'Opps, something went wrong.';
	    		$type = 'error';
			}
		}
		else {
			$title = 'That email address is taken. Try another.';
	        $type = 'warning';
		}
	}
	else{
		$title = 'Sorry, an error has occured.';
	    $type = 'error';
	}

	$obj->redirect('index.php', ['title' => $title, 'type' => $type]);
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
				$model->user_id = 1;
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

	$obj->redirect('cms/administrator/users.php', ['title' => $title, 'type' => $type]);
}
elseif (isset($_POST['update_self'])) {
	$obj = new Controller;

	$model = $obj->model('Users');
	$result = $model->findById($_SESSION['USER_INFO']['user_id']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 1) {

			if (password_verify($_POST['current_password'], $result['fetch_assoc']['password'])) {

				if ($result['fetch_assoc']['email_address'] != $_POST['email_address']) {
					$result = $model->findByEmailAddress($_POST['email_address']);

					if ($result['execute'] == 'success') {

						if ($result['num_rows'] == 1) {
							$title = 'That email address is taken. Try another.';
			        		$type = 'warning';

			        		echo json_encode(['title' => $title, 'type' => $type]);
							exit();
						}
					}
					else {
						$title = 'Opps, something went wrong.';
			    		$type = 'error';

			    		echo json_encode(['title' => $title, 'type' => $type]);
						exit();
					}
				}
				
				if (empty($_POST['new_password'])) {
					$array = [
						'family_name' => $_POST['family_name'],
						'given_name' => $_POST['given_name'],
						'middle_name' => $_POST['middle_name'],
						'email_address' => $_POST['email_address'],
						'username' => $_POST['username'],
						'updated_at' => date('Y-m-d H:i:s')
					];
				}
				else {
					$array = [
						'family_name' => $_POST['family_name'],
						'given_name' => $_POST['given_name'],
						'middle_name' => $_POST['middle_name'],
						'username' => $_POST['username'],
						'email_address' => $_POST['email_address'],
						'password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT),
						'updated_at' => date('Y-m-d H:i:s')
					];
				}

				$result = $model->update($_SESSION['USER_INFO']['user_id'], $array);

				if (($result['success'] == 5 || $result['success'] == 6) && $result['error'] == 0) {
					$title = 'Account updated successfully.';
					$type = 'success';
				}
				else {
					$title = 'Account updated successfully with ' . $result['error'] . ' error(s).';
			    	$type = 'warning';
				}
			}
			else {
				$title = 'Password didn’t match. Try again.';
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

	echo json_encode(['title' => $title, 'type' => $type]);
	exit();
}
?>