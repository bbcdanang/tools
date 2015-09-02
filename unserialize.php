<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if(!isset($_POST['Submit']))
{
?>
<form action="" method="POST" enctype="multipart/form-data" target="output">
	<table width="100%" height="100%" border=0 cellpadding="0" cellspacing="0">
		<tr>
			<td style="height:100px;">
				<textarea name="script" style="width: 100%;border: 1px solid #ccc;" rows=10></textarea>
			</td>
		</tr>
		<tr bgcolor=#f0f0f0>
			<td style="height:10px;">
				<input type=submit name="Submit" value="Submit">
				<input type="file" name="files">
			</td>
		</tr>
		<tr>
			<td>
				<iframe src="" name="output" width="100%" height="100%" frameborder=0></iframe>
			</td>
		</tr>
	</table>
</form>
<?php
} else {
	function readxvcgch($vars) {
		return is_array($vars) ? array_map('readxvcgch', $vars) : htmlentities($vars);
	}
	if(!empty($_POST['script'])) {
		pr(readxvcgch(@unserialize(stripslashes($_POST['script']))));
	}
	if(is_uploaded_file($_FILES['files']['tmp_name']))
	{
		_func('file');
		$_file = _ROOT.'images/tmp.jc';
		move_uploaded_file($_FILES['files']['tmp_name'], $_file);
		@chmod ($_file, 0777);
		$txt = file_read($_file);
		@unlink($_file);
		$r = readxvcgch(unserialize($txt));
		pr($r);
	}
}
?>