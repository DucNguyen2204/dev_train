<?php

	class Database {
		public static $host = "localhost";
		public static $dbname = "dev_train";
		public static $username = "root";
		public static $password = '';

		public static $conn = NULL;
		public static $result = NULL;

		public static function create_database(){
			$conn = new mysqli(self::$host,self::$username, self::$password);
			if($conn->connect_error){
				echo "Cannot connect to database. Error: "  . $conn->connection_error;
			}
			else{
				$query = "CREATE DATABASE IF NOT EXISTS dev_train";
				$conn->query($query);
				$conn->close();
			}

			$new_conn = new mysqli(self::$host, self::$username, self::$password, self::$dbname);
			if($conn->connect_error){
				echo "Cannot connect to database. Error: "  . $conn->connection_error;
			}else{
				$s = "CREATE TABLE php_table (id int(11) NOT NULL AUTO_INCREMENT, title varchar(255) NOT NULL,description text NOT NULL,image varchar(255) DEFAULT NULL,status int(11) NOT NULL,create_at datetime DEFAULT NULL,update_at datetime DEFAULT NULL,PRIMARY KEY(id))";

				mysqli_query($new_conn,$s);
				$new_conn->close();
			}
		}

		public function connect(){
			self::$conn = new mysqli(self::$host, self::$username, self::$password, self::$dbname);
			if(self::$conn->connect_error){
				echo "Cannot connect to database. Error: "  . $conn->connection_error;
			}
			return self::$conn;
		}

		public function execute($sql){
			self::$result = self::$conn->query($sql);
			return self::$result;
		}

		public function getData(){
			if(self::$result){
				$data = mysqli_fetch_array(self::$result);
			}
			else{
				$data = 0;
			}
			return $data;
		}

		public function getRecordById($id){
			$sql = "SELECT * FROM php_table WHERE id = $id";
			return mysqli_fetch_array(self::$conn->query($sql));
		}

		public function showData($table){
			$sql = "SELECT * FROM $table";
			self::execute($sql);
			if(self::num_rows() == 0){
				$data = array();
			}
			else{
				while($datas = self::getData()){
					$data[]=$datas;
				}
			}
			return $data;
		}

		public function showDataLimit($table, $start, $limit){

			$sql = "SELECT * FROM $table LIMIT $start, $limit";
			self::execute($sql);
			if(self::num_rows() == 0){
				$data = 0;
			}
			else{
				while($datas = self::getData()){
					$data[]=$datas;
				}
			}
			return $data;
		}

		public function num_rows(){
			if(self::$result){
				$num = mysqli_num_rows(self::$result);
			}
			else{
				$num = 0;
			}
			return $num;
		}

		public function insert($title, $des, $thumb, $status, $created){
			$sql = "INSERT INTO php_table(title, description, image,status,create_at) VALUES ('$title', '$des','$thumb','$status', '$created')";
		

			return self::execute($sql);
		}

		public function getCount($table){
			$sql = "SELECT COUNT(id) AS num FROM $table";
			return self::execute($sql);

		}

		public function update($title, $des, $thumb, $status, $updated, $id){
			$sql = "UPDATE php_table SET title = '$title', description = '$des', image = '$thumb', status = '$status',update_at = '$updated' WHERE id = '$id'";
			// print_r($sql);
			return self::execute($sql);
		}

		public function deleteById($id){
			$sql = "DELETE FROM php_table WHERE id = '$id'";
			return self::execute($sql);
		}
	}
?>