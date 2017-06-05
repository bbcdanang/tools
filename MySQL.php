<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if(!isset($_POST['Submit']))
{
	_func('editor');
	$config = array(
		'id'=>'sql'
	,	'height'=>'250px'
	,	'syntax'=>'sql'
	);
	?>
	<form action="" method="POST" enctype="multipart/form-data" id="form" target="output">
		<table width="100%" height="100%" border=0 cellpadding="0" cellspacing="0">
			<tr>
				<td valign="top" align="left" style="height:100px;">
					<?php echo editor_code($config, '', array(), false);?>
				</td>
			</tr>
			<tr bgcolor=#f0f0f0>
				<td style="height:10px;">
					<input type=submit name="Submit" value="Submit">
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
}else{
	$db->debug=1;
	$sys->stop(false);
	$r = @$db->getAll($_POST['sql']);
	if($db->resid){
		echo msg('eksekusi SQL telah berhasil dijalankan dengan affect: '.items($db->Affected_rows(), 'row'), 'info');
	}else{
		echo msg('eksekusi SQL telah GAGAL dijalankan', 'danger');
	}
	if(count($r) > 0)
	{
		echo table($r, array_keys($r[0]));
	}
}