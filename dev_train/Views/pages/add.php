<!DOCTYPE html>
<html>
<head>
	<title>ADD</title>
	<base href="http://localhost/dev_train/"/>
	<style type="text/css">
			.manage{
				float: left;
				font-size: 75px;
				}

			.save-button{
				margin-top: 2%; 
				margin-right: 50px;
				padding-right: 20px;
				font-size: 30px;
				float: right;
				background-color: royalblue;
				color: white;
			}
			.cancel-button{
				margin-top: 2%; 
				margin-right: 50px;
				padding-right: 20px;
				font-size: 30px;
				float: right;
				background-color: royalblue;
				color: white;
			}
		</style>
</head>
<body>
	<div>
		<div class = "manage">
				<text>New</text>
		</div>
		<button type = "button" class = "cancel-button" onclick="window.location.href='admin'">Cancel</button>
		<form action="" method="POST" enctype="multipart/form-data">
			<button type = "submit" class = "save-button" name="save-button">Save</button>
		
		<div class = "new">
				<table style = "width: 100%">
					<tr style = "background-color: gainsboro">
						<td>Title</td>
						<td><input type="text" name="title" placeholder="Title"></td>
					</tr>
					<tr style="height: 200px;vertical-align: top">
						<td>Description</td>
						<td><input type="text" name="description" placeholder="Description" style= "width: 50%;
						height: 200px">
						</td>
					</tr>
					<tr style="height: 200px;vertical-align: top;background-color: gainsboro">
						<td>Image</td>
						<td><input type="file" name="image" id = "inpFile">
						<div class = "image-preview" id="imagePreview" style="width: 50%;min-height: 150px; border: 2px solid #dddddd;margin-top: 15px;display: flex;align-items: center;justify-content: center;font-weight: bold;color: black" id = "imagePreview">
							<img src="" alt="Image Preview" class = "image-preview__image" style="display: none;width: 100%">
							<span class = "image-preview__default" style="">Image Preview</span>
						</div>
						</td>
					</tr>
					<tr>
						<td>Status</td>
						<td><select id = "status" class = "status" name = "status">
							<option value="Enabled">Enabled</option>
							<option value="Disabled">Disabled</option>
						</select></td>
					</tr>
				</table>
		</div>
	</form>

	<script type="text/javascript">
		const inpFile = document.getElementById("inpFile");
		const pContainer = document.getElementById("imagePreview")
		const previewImage = pContainer.querySelector(".image-preview__image");
		const previewDefaultText = pContainer.querySelector(".image-preview__default");

		inpFile.addEventListener("change", function(){
			const file = this.files[0];
			if(file){
				const reader = new FileReader();
				previewDefaultText.style.display = "none";
				previewImage.style.display = "block";

				reader.addEventListener("load", function(){
					console.log(this)
					previewImage.setAttribute("src", this.result);
				});

				reader.readAsDataURL(file);
			} else {
				previewDefaultText.style.display = null;
				previewImage.style.display = null;
				previewImage.setAttribute("src","");
			}
		});
	</script>

</body>
</html>