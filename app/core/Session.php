<?php
session_start();

$request_uri = trim($_SERVER['REQUEST_URI'], '/');
$url = explode('/', $request_uri);

if (isset($url[2]) && $url[2] === 'cms') {
	
	if (empty($_SESSION['USER_INFO'])) {
		header('location: ../index.php?title=Session expired!&type=error');
		exit();
	}
}
elseif (isset($url[3]) && $url[3] === 'controller') {

	if (empty($_SESSION['USER_INFO'])) {
		header('location: ../../index.php?title=Session expired!&type=error');
		exit();
	}
}
?>