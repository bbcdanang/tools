<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed'); ?>
<form action="" method="POST" enctype="multipart/form-data" >
	<table width="100%" border=0 cellpadding="4" cellspacing="2" class="body">
		<tr>
			<td valign="top" align="left">
				words : <input type="text" name="words" value="<?php echo @$_POST['words'];?>">
			</td>
			<td valign="top" align="left">
				salt : <input type="text" name="salt" value="<?php echo @$_POST['salt'];?>">
			</td>
		</tr>
		<tr bgcolor=#f0f0f0>
			<td valign="middle" width="200px">
				<input type="radio" name="enc" value="enc" id="actionsql1"<?php  if(@$_POST['enc']!='dec') echo ' checked="checked"'; ?>><label for="actionsql1"> Encrypt</label>
				<input type="radio" name="enc" value="dec" id="actionsql2"<?php  if(@$_POST['enc']=='dec') echo ' checked="checked"'; ?>><label for="actionsql2"> Decrypt</label>
			</td>
			<td>
				<input type=submit name="Submit" value="Submit">
				</td>
			</tr>
	</table>
</form>
<?php

if(isset($_POST['enc']))
{
	if($_POST['enc']=='enc'){
		echo "Encrypt :<br /><textarea style=\"width: 100%; border:0px\">".encode($_POST['words'], $_POST['salt'])."</textarea>";
	}else{
		echo "Decrypt :<br /><textarea style=\"width: 100%; border:0px\">".decode($_POST['words'], $_POST['salt'])."</textarea>";
	}
}

?>