<?php
	class Admin {
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
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$previous = $page-1;
			$next  = $page+1;
			$count = mysqli_fetch_array(self::$db->getCount($table))['num'];
			if($page == 0 || $count == 0){
				$pages = 0;
				$table = "php_table";
				$data = self::$db->showData($table);
				require_once('Views/pages/admin.php');
			}else{

				$start = ($page - 1)*$limit;

				if(self::$db->showDataLimit($table, $start, $limit)){
					$data = self::$db->showDataLimit($table, $start, $limit);
					$pages = ceil($count/$limit);
					require_once('Views/pages/admin.php');
				}else{
					require_once('Views/pages/error.php');
				}
			}
		}

		public function add(){
			if(isset($_POST['save-button'])){
			// if(isset($_POST['title'])){
				$title = $_POST['title'];
				$des = $_POST['description'];
				$status = $_POST['status'];
				if($status == "Enabled") $status =1;
				else $status = 0;
				date_default_timezone_set("Asia/Ho_Chi_Minh");
				$current_time = date("Y/m/d h:i:s", time());
				if($_FILES['image']['name'] != ""){ 
					$file = $_FILES['image']['name'];
					$target = "Images/".$_FILES['image']['name'];
					if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
						if(self::$db->insert($title,$des,$file,$status,$current_time)){
							echo "<p style = 'color:green'>Added Successfully</p>";
						}
					}
				}else{
					echo "<p style = 'color:red'>No File Included</p>";
				}
			}
				require_once('Views/pages/add.php');
		}

		public function show(){
			$id = $_GET['id'];
			$d = self::$db->getRecordById($id);
			require_once('Views/pages/show.php');
		}

		public function edit(){
			$id = $_GET['id'];
			$d = self::$db->getRecordById($id);
			if(isset($_POST['edit-save-button'])){
				$title = $_POST['title'];
				$des = $_POST['description'];
				$status = $_POST['status'];
				if($status == "Enabled") $status =1;
				else $status = 0;
				date_default_timezone_set("Asia/Ho_Chi_Minh");
				$current_time = date("Y/m/d h:i:s", time());
				if($_FILES['image']['name'] != ""){
						$file = $_FILES['image']['name'];
						$target = "Images/".$_FILES['image']['name'];
						if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
							if(self::$db->update($title,$des,$file,$status,$current_time,$id)){
							}
						}
					require_once('Views/pages/doneEdit.php');
					}else{
						echo "<p style = 'color:red'>No File Included</p>";
						require_once('Views/pages/edit.php');
					}
				
				}
			else{
				require_once('Views/pages/edit.php');
			}
		}

		public function delete(){
			$id = $_GET['id'];
			if(isset($_POST['yes-button'])){
				if(self::$db->deleteById($id)){
					require_once('Views/pages/doneDelete.php');
				}else{
					echo "<p style = 'color:red'>Cannot Delete</p>";
				}
			}else{
				require_once('Views/pages/delete.php');
			}
		}
	}
?>