<!DOCTYPE html>
<html>
<head>
	<base href="http://localhost/dev_train/"/>
	<title>DELETE</title>
	<style type="text/css">
		.btn-group button{
			border: 1px solid black;
			color: white;
			background-color: royalblue;
			padding: 10px 24px;
			cursor: pointer;
			float: left;
		}
		.btn-group:after {
  			content: "";
  			clear: both;
  			display: table;
		}

		.btn-group button:nth-child(odd) {
  			border-right: 0; /* Prevent double borders */
			}
		/*
		.yes-button{
			float: left;
		}
		.back-button{
			margin-right: 20px;
			float:left;
		}*/
	</style>
</head>
<body>
	<p style = "color:red;font-size: 35px">ARE YOU SURE</p>
	<div class = "btn-group">
		<form action="" method="POST" enctype="multipart/form-data">
			<button type = "submit" class = "yes-button" name="yes-button">
			YES</button>
		</form>
		<button class = 'back-button' onclick="window.location.href = 'admin'">BACK</button>
	</div>
</body>
</html>