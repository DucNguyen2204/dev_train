<?php
	class User{
		private static $action;

		public function set_action($action){
			self::$action = $action;
		}

		public function show($db){
			$table = "php_table";
			$limit = 5;
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}else{
			  	$_GET['page'] = 1;
			  	$page = $_GET['page'];
			}
			$previous = $page-1;
			$next  = $page+1;
			if($page == 0){
				$table = "php_table";
				$data = $db->showData($table);
				require_once('Views/pages/user.php');
			}else{
				$start = ($page - 1)*$limit;
				if($db->showDataLimit($table, $start, $limit)){
					$data = $db->showDataLimit($table, $start, $limit);
					$count = mysqli_fetch_array($db->getCount($table))['num'];
					$pages = ceil($count/$limit);
					require_once('Views/pages/user.php');
				}else{
				require_once('Views/pages/error.php');
				}
			}
		}

		public function act($db){
			switch (self::$action) {
			case 'show':
				$id = $_GET['id'];
				$d = $db->getRecordById($id);
				require_once('Views/pages/show.php');
				break;
			default:
				$table = "php_table";
				$data = $db->showData($table);
				require_once('Views/pages/user.php');
				# code...
				break;
			}
		}
	}
?>