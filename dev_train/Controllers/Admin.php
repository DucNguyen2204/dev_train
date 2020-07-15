<?php
	class Admin {
		private static $action;
		
		function set_action($action){
			self::$action = $action;
		}

		public function show($db){
				$table = "php_table";
				$limit = 5;
				$page = isset($_GET['page']) ? $_GET['page'] : 1;
				$previous = $page-1;
				$next  = $page+1;
				$count = mysqli_fetch_array($db->getCount($table))['num'];
				if($page == 0 || $count == 0){
					$pages = 0;
					$table = "php_table";
					$data = $db->showData($table);
					require_once('Views/pages/admin.php');
				}else{

					$start = ($page - 1)*$limit;

					if($db->showDataLimit($table, $start, $limit)){
						$data = $db->showDataLimit($table, $start, $limit);
						$pages = ceil($count/$limit);
						require_once('Views/pages/admin.php');
					}else{
						require_once('Views/pages/error.php');
						}
					}
		}

		public function act($db){
			switch (self::$action) {
			case 'add':
				# code...
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
								if($db->insert($title,$des,$file,$status,$current_time)){
									echo "<p style = 'color:green'>Added Successfully</p>";
								}
							}
						}else{
							echo "<p style = 'color:red'>No File Included</p>";
						}
				}
				require_once('Views/pages/add.php');
				break;
			case 'show':
				$id = $_GET['id'];
				$d = $db->getRecordById($id);
				require_once('Views/pages/show.php');
				break;

			case 'edit':
				$id = $_GET['id'];
				$d = $db->getRecordById($id);
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
								if($db->update($title,$des,$file,$status,$current_time,$id)){
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
				break;
			case 'delete':
				$id = $_GET['id'];
				if(isset($_POST['yes-button'])){
					if($db->deleteById($id)){
						require_once('Views/pages/doneDelete.php');
					}else{
						echo "<p style = 'color:red'>Cannot Delete</p>";
					}
				}else{
					require_once('Views/pages/delete.php');
				}
				break;
			default:
				// require_once('Views/pages/admin.php');
				self::show($db);
				break;
			}
		}
	}
?>