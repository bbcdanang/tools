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
	$_POST['sql'] = stripslashes($_POST['sql']);
	$r = @$db->getAll($_POST['sql']);
	if($db->resid) echo "eksekusi SQL telah berhasil dijalankan dengan affect :".$db->Affected_rows();
	else echo "<font color='#ff0000'>eksekusi SQL telah GAGAL dijalankan</font>";
	if(count($r) > 0)
	{
		echo 	'<table width="100%" border="1px" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-color:#ccc;">'
					.	'<tr style="text-align:center;font-weight:bold;">'
					.		'<td>No.</td>';
		foreach((array)@$r[0] as $id=>$data)
		{
			echo '<td>'.$id.'</td>';
		}
		echo		'</tr>';
		$i = 0;
		foreach($r as $id => $data)
		{
			$i++;
			echo	'<tr>'
			 		.		'<td>'.$i.'</td>';
			foreach($data as $dt)
			{
				echo '<td>'.$dt.'</td>';
			}
			echo '</tr>';
		}
		echo	'</table>';
	}
}