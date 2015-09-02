<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

?>
<html>

<head>
<title>New Page 1</title>

</head>

<body style="margin: 0px; padding: 0px;">
<?	if(!isset($_POST['Submit'])) {	?>
	<form action="" method="POST" enctype="multipart/form-data" target="_blank" >
		<table width="100%" border=0 cellpadding="4" cellspacing="2" class="body">
			<tr>
				<td valign="top" align="left">
					<input type=text name="url" value="http://" size=80 style="border: 1px solid #ccc;">
				</td>
			</tr>
			<tr bgcolor=#f0f0f0>
				<td>
					<input type=submit name="Submit" value="Execute">
					</td>
			</tr>
		</table>
	</form>
<?	}else{	?>
		<iframe src="<?=$_POST['url'];?>" name="output" width="100%" height="100%" frameborder=0></iframe>
<?	}	?>
</body>
</html>
