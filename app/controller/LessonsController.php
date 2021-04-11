<?php  
session_start();
require_once '../core/Define.php';
require_once '../core/Database.php';
require_once '../core/Controller.php';

if (isset($_POST['save']))
{
	$obj = new Controller;

	$model = $obj->model('Lessons');
	$result = $model->findByName($_SESSION['USER_INFO']['user_id'], $_POST['name']);

	if ($result['execute'] == 'success') {

		if ($result['num_rows'] == 0) {

			$model = $obj->model('Photos');

			$filename_with_ext = $_FILES['profile_photo_file']['name'];
			$filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
			$extension = pathinfo($filename_with_ext, PATHINFO_EXTENSION);

			$file_path = 'storage/pictures/lessons';
			$file_name = substr($filename, 0, 15) . '_' . time() . '.' . $extension;

			$model->file_path = $file_path;
			$model->file_name = $file_name;
			$model->type = 'lesson';
			$model->status = 'Active';

			$result = $model->save();

			if ($result['execute'] == 'success') {
				$path = "../../$file_path/$file_name";

				move_uploaded_file($_FILES['profile_photo_file']['tmp_name'], $path);

				$photo_id = $result['insert_id'];
			}
			else {
				$photo_id = 0;
			}

			$model = $obj->model('Lessons');

			$model->user_id = $_SESSION['USER_INFO']['user_id'];
			$model->photo_id = $photo_id;
			$model->name = $_POST['name'];
			$model->description = $_POST['description'];
			$model->video_desc = $_POST['video_description'];
			$model->presentation_desc = $_POST['presentation_description'];
			$model->status = $_POST['status'];

			$result = $model->save();

			if ($result['execute'] == 'success') {

				$lesson_id = $result['insert_id'];

				if ($_FILES['video_file']['size'] > 0) {

					$model = $obj->model('LessonVideos');

					foreach ($_FILES['video_file']['name'] as $key => $value) {

						$filename_with_ext = $_FILES['video_file']['name'][$key];
						$filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
						$extension = pathinfo($filename_with_ext, PATHINFO_EXTENSION);

						$file_path = 'storage/videos/lesson_videos';
						$file_name = substr($filename, 0, 15) . '_' . uniqid() . '.' . $extension;

						$model->lesson_id = $lesson_id;
						$model->file_path = $file_path;
						$model->file_name = $file_name;
						$model->status = 'Active';

						$result = $model->save();

						if ($result['execute'] == 'success') {
							$path = "../../$file_path/$file_name";

							move_uploaded_file($_FILES['video_file']['tmp_name'][$key], $path);
						}
					}
				}

				if ($_FILES['presentation_file']['size'] > 0) {

					$model = $obj->model('LessonPresentations');

					foreach ($_POST['set_id'] as $set_key => $set_value) {

						foreach ($_FILES['presentation_file']['name'][$set_value] as $key => $value) {

							$filename_with_ext = $_FILES['presentation_file']['name'][$set_value][$key];
							$filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
							$extension = pathinfo($filename_with_ext, PATHINFO_EXTENSION);

							$file_path = 'storage/pictures/lesson_presentations';
							$file_name = substr($filename, 0, 15) . '_' . uniqid() . '.' . $extension;

							$model->lesson_id = $lesson_id;
							$model->set_id = $_POST['set_id'][$set_key];
							$model->file_path = $file_path;
							$model->file_name = $file_name;
							$model->status = 'Active';

							$result = $model->save();

							if ($result['execute'] == 'success') {
								$path = "../../$file_path/$file_name";

								move_uploaded_file($_FILES['presentation_file']['tmp_name'][$set_value][$key], $path);
							}
						}
					}
				}

				$title = 'Saved successfully';
		    	$type = 'success';
			}
			else {
				$title = 'Sorry, an error has occured.';
			    $type = 'error';
			}
		}
		else {
			$title = 'Lesson name already exist.';
	        $type = 'warning';
		}
	}
	else{
		$title = 'Failed an error has occured.';
	    $type = 'error';
	}
	
	$obj->redirect('cms/teacher/lessons.php', ['title' => $title, 'type' => $type]);
}
elseif (isset($_POST['category_lesson_update'])) 
{	
	$obj = new Controller;

	$lessons_name = $_POST['lessons_name'];
	$lessons_desc = $_POST['lessons_desc'];
	$lessons_status = $_POST['lessons_status'];
	$updated_at = date('Y-m-d H:i:s');
	$id = $_POST['id'];

	$img_id = $_POST['img_id'];

	$model = $obj->model('Lessons');

	if ($model->update_category_lesson($lessons_name, $lessons_desc, $lessons_status, $updated_at, $id) == 'updated') 
	{
		if ($_FILES['img_name']['size'] > 0) {

			$model = $obj->model('Photos');
			$result = $model->findById($img_id);

			if ($result['execute'] == 'success' && $result['num_rows'] > 0) 
			{
				$current_path = $result['fetch_assoc']['file_path'];
				$current_name = $result['fetch_assoc']['file_name'];

				$filename_with_ext = $_FILES['img_name']['name'];
				$filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
				$extension = pathinfo($filename_with_ext, PATHINFO_EXTENSION);

				$file_path = 'storage/pictures/lessons';
				$file_name = substr($filename, 0, 15) . '_' . uniqid() . '.' . $extension;

				$array = array(
					'file_path' => $file_path,
					'file_name' => $file_name,
					'updated_at' => date('Y-m-d H:i:s')
				);

				$result = $model->update($img_id, $array);

				if ($result['success'] == 3 && $result['error'] == 0) 
				{
					$path = "../../$file_path/$file_name";

					if (move_uploaded_file($_FILES['img_name']['tmp_name'], $path)) 
					{
						if (file_exists("../../$current_path/$current_name")) 
						{
							unlink("../../$current_path/$current_name");
						}
					}
				}
			}
		}

		foreach ($_FILES['video_lesson_file']['name'] as $key => $value)
		{
			if ($_FILES['video_lesson_file']['size'][$key] > 0) {

				$model = $obj->model('LessonVideos');
				$result = $model->findById($key);

				if ($result['execute'] == 'success' && $result['num_rows'] > 0) 
				{
					$current_path = $result['fetch_assoc']['file_path'];
					$current_name = $result['fetch_assoc']['file_name'];

					$filename_with_ext = $_FILES['video_lesson_file']['name'][$key];
					$filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
					$extension = pathinfo($filename_with_ext, PATHINFO_EXTENSION);

					$file_path = 'storage/videos/lesson_videos';
					$file_name = substr($filename, 0, 15) . '_' . uniqid() . '.' . $extension;

					$array = array(
						'file_path' => $file_path,
						'file_name' => $file_name,
						'updated_at' => date('Y-m-d H:i:s')
					);

					$result = $model->update($key, $array);

					if ($result['success'] == 3 && $result['error'] == 0) 
					{
						$path = "../../$file_path/$file_name";

						if (move_uploaded_file($_FILES['video_lesson_file']['tmp_name'][$key], $path)) 
						{
							if (file_exists("../../$current_path/$current_name")) 
							{
								unlink("../../$current_path/$current_name");
							}
						}
					}
				}
			}
		}

		foreach ($_FILES['presentation_lesson_file']['name'] as $set_key => $set_value)
		{
			if ($_FILES['presentation_lesson_file']['name'][$set_key][0] != '') 
			{
				$model = $obj->model('LessonPresentations');
				
				$result = $model->findBySetId($set_key);

				foreach ($result['fetch_assoc'] as $key => $value) {

					$current_path = $value['file_path'];
					$current_name = $value['file_name'];

					if (file_exists("../../$current_path/$current_name")) 
					{
						$result = $model->delete($value['id']);

						if ($result['execute'] == 'success') {

							unlink("../../$current_path/$current_name");
						}
					}
				}

				foreach($_FILES['presentation_lesson_file']['name'][$set_key] as $key => $value) {

					$filename_with_ext = $_FILES['presentation_lesson_file']['name'][$set_key][$key];
					$filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
					$extension = pathinfo($filename_with_ext, PATHINFO_EXTENSION);

					$file_path = 'storage/pictures/lesson_presentations';
					$file_name = substr($filename, 0, 15) . '_' . uniqid() . '.' . $extension;

					$model->set_id = $set_key;

					$model->lesson_id = $_POST['id'];
					$model->file_path = $file_path;
					$model->file_name = $file_name;
					$model->status = 'Active';

					$result = $model->save();

					if ($result['execute'] == 'success') {

						$path = "../../$file_path/$file_name";

						move_uploaded_file($_FILES['presentation_lesson_file']['tmp_name'][$set_key][$key], $path);
					}
				}
			}
		}
		$title = 'Successfully update the lesson details.';
		$type = 'success';
	} 
	else 
	{
		$title = 'Sorry, an error has occured.';
	    $type = 'error';
	}

	$obj->redirect('cms/teacher/lessons.php', ['title' => $title, 'type' => $type]);
}
elseif (isset($_POST['remove'])) 
{
	$obj = new Controller;

	$model = $obj->model('Lessons');
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
				$model->module_type = 'lessons';
				$model->status = 'Active';
				$model->save();

				$title = 'Category lesson removed successfully.';
				$type = 'success';
			}
			else {
				$title = 'Category lesson removed successfully with ' . $result['error'] . ' error(s).';
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

	$obj->redirect('cms/teacher/lessons.php', ['title' => $title, 'type' => $type]);
}
?>