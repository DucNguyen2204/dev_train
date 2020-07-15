<?php
	include_once __DIR__.'\Models\Database.php';
	Database::create_database();
	$db = new Database;
	$db->connect();

	require_once('Controllers\Admin.php');
	$admin = new Admin();

	require_once('Controllers\User.php');
	$user = new User();

	if(isset($_GET['controller'])){
		$controller = $_GET['controller'];
	}
	else{
		$controller = '';
	}

	switch ($controller) {
		case 'admin':
			# code...
			
			if(!isset($_GET['action'])){
				$admin->show($db);
			}
			else{		
				$admin->set_action($_GET['action']);
				$admin->act($db);
			}
			break;

		// case 'admin_add':
		// 	require_once('Controllers/add_controller.php');
		// 	break;
		case 'user';

			if(!isset($_GET['action'])){
				$user->show($db);
			}else{
				$user->set_action($_GET['action']);
				$user->act($db);
			}
			break;
		
		default:
			require_once('Views/pages/index.php');
	}