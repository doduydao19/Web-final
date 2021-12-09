<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/room_edit_input.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Room edit input</title>
</head>
<body>
	<div class="form_center">
		<table class="table_form">
			<form method="POST" action="room_edit_input.php" enctype='multipart/form-data'>
				<tr>
					<td class="text_color">Tên phòng học</td>
					<td><input type="text" name="" class="input_form"></td>
				</tr>

				<tr>
					<td class="text_color">Tòa nhà</td>
					<td>
						<select name="" class="selectbox_color">
							<option value="" selected disabled hidden></option>
							<option></option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
						</select>
					</td>
				</tr>

				<tr>
					<td class="text_color">Mô tả chi tiết</td>
					<td><input type="text" name="" class="input_form_1"></td>
				</tr>

				<tr>
					<td class="text_color">Avatar</td>
					<td><img src="" alt="image"></td>
				</tr>

				<tr>
					<td><td>
					<input type="file" id="myFile" name="filename" accept="image/*" class="upload_color">
					

				</tr>

				<tr>
					<td colspan="2" align="center">
					
					<input class="form_submit" type="submit" method ="post" name ="submit" value="Xác Nhận">
					
					</td>
				</tr>
			</form>

		</table>

	</div>
</body>
</html>