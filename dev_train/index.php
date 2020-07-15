<?php
	include_once __DIR__.'\Models\Database.php';
	Database::create_database();
	$db = new Database;
	$db->connect();


	if(isset($_GET['controller'])){
		$controller = ucfirst($_GET['controller']);
		require_once("Controllers/".$controller.".php");
		$controller_obj = new $controller($db);
		if(isset($_GET['action'])){
			$action = $_GET['action'];
			$controller_obj->run($action);
		}else{
			$controller_obj->run("list");
		}
	}else{
		require_once('Controllers/Index.php');
		Index::run();
	}