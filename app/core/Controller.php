<?php
/**
 * 
 */
class Controller
{
	
	public function model($model_name)
	{
		$filename = Model . $model_name . '.php';

		if (file_exists($filename)) {
			require_once $filename;

			return new $model_name;
		}
	}

	public function view($view_name)
	{
		$filename = View . $view_name . '.php';

		if (file_exists($filename)) {
			require_once $filename;

			return new $view_name;
		}
	}

	public function redirect($path, $params = ['title', 'type', 'other'])
	{	
		if (empty($params['title']) && empty($params['type']) && empty($params['other']))  {
			header("location: ../../$path");
		}
		elseif (isset($params['title']) && isset($params['type']) && isset($params['other'])) {
			$title = $params['title'];
			$type = $params['type'];
			$other = $params['other'];

			header("location: ../../$path?title=$title&type=$type&$other");
		}
		elseif (isset($params['title']) && isset($params['type']) && empty($params['other'])) {
			$title = $params['title'];
			$type = $params['type'];

			header("location: ../../$path?title=$title&type=$type");
		}
		else {
			$other = $params['other'];
			
			header("location: ../../$path?$other");
		}

		exit();
	}

	public function session($array = [])
	{
		foreach ($array as $key => $value) {
			$_SESSION[$key] = $value;
		}
	}
}
?>