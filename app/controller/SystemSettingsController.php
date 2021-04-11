<?php
require_once '../core/Session.php';
require_once '../core/Define.php';
require_once '../core/Database.php';
require_once '../core/Controller.php';

if (isset($_POST['update'])) {
	$obj = new Controller;

	$model = $obj->model('SystemSettings');
	$result = $model->findById($_POST['id']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 1) {

			if (empty($_FILES['image']['name'])) {
				$image_name = $result['fetch_assoc']['image_name'];
				$image_path = $result['fetch_assoc']['image_path'];
			}
			else {
				$filename_with_ext = $_FILES['image']['name'];
				$filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
				$extension = pathinfo($filename_with_ext, PATHINFO_EXTENSION);

				$image_name = substr($filename, 0, 15) . '_' . time() . '.' . $extension;
				$image_path = 'storage/pictures/system';

				$path = "../../$image_path/$image_name";

				move_uploaded_file($_FILES['image']['tmp_name'], $path);
			}
			
			$array = [
				'image_path' => $image_path,
				'image_name' => $image_name,
				'name' => $_POST['name'],
				'description' => $_POST['description'],
				'enable' => $_POST['enable'],
				'updated_at' => date('Y-m-d H:i:s')
			];

			$result = $model->update($_POST['id'], $array);

			if ($result['success'] == 6 && $result['error'] == 0) {
				$title = 'System updated successfully.';
				$type = 'success';
			}
			else {
				$title = 'System updated successfully with ' . $result['error'] . 'error(s).';
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

	$obj->redirect('cms/administrator/settings.php', ['title' => $title, 'type' => $type]);
}
?>