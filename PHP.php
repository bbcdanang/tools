<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if(!isset($_POST['Submit']))
{
	_func('editor');
	$config = array(
		'id'=>'script'
	,	'height'=>'250px'
	,	'syntax'=>'php'
	);
?>
<form action="" method="POST" enctype="multipart/form-data" id="form" target="output">
	<table width="100%" height="100%" border=0 cellpadding="0" cellspacing="0">
		<tr>
			<td style="height:100px;">
				<?php echo editor_code($config, '', array(), false);?>
			</td>
		</tr>
		<tr bgcolor=#f0f0f0>
			<td style="height:10px;">
				<input type=submit name="Submit" value="Execute">
				<select name="actionscript">
					<option>php</option>
					<option>none</option>
				</select>
				<label><input type="checkbox" name="use_template" value="1" title="use template"> Use Template</label>
				<label><input type="checkbox" title="New Window" onclick="document.getElementById('form').target = this.checked ? '_blank' : 'output';"> New Window</label>
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
	$_POST['script'] = stripslashes($_POST['script']);
	if(isset($_POST['use_template']) && $_POST['use_template'] == '1') $sys->stop(false);
	switch($_POST['actionscript'])
	{
		case 'none':
			echo $_POST['script'];
		break;
		case 'php':
		default:
			eval($_POST['script']);
		break;
	}
}
?>