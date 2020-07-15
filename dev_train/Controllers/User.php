<?php
	class User{
		private static $db;

		function __construct($db){
			self::$db = $db;
		}

		function run($action){
			try{
				self::$action();
			}catch (Error $e){
				echo "<p style='color:red;font-size:35px'>Wrong Action</p>";
				echo "<button onclick = 'window.history.back()'>GET BACK</button>";
			}
		}

		public function list(){
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
				$data = self::$db->showData($table);
				require_once('Views/pages/user.php');
			}else{
				$start = ($page - 1)*$limit;
				if(self::$db->showDataLimit($table, $start, $limit)){
					$data = self::$db->showDataLimit($table, $start, $limit);
					$count = mysqli_fetch_array(self::$db->getCount($table))['num'];
					$pages = ceil($count/$limit);
					require_once('Views/pages/user.php');
				}else{
				require_once('Views/pages/error.php');
				}
			}
		}

		public function show(){
			$id = $_GET['id'];
			$d = self::$db->getRecordById($id);
			require_once('Views/pages/show.php');
		}
	}
?>