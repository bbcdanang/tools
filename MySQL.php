<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if(!isset($_POST['sql']))
{
	$sys->stop(false);
	$sys->set_layout('blank');
	_func('editor');
	$config = array(
		'id'     => 'sql',
		'syntax' => 'sql',
		'theme'  => 'esoftplay'
	);
	?>
	<table class="table" style="height: 100%;position: absolute;top: 0;left: 0;right: 0;bottom: 0;">
		<tr>
			<td>
				<form action="" method="POST" enctype="multipart/form-data" id="form" target="output">
					<?php echo editor_code($config, @$_SESSION['tools_sql'], array(), false);?>
					<div class="form-inline checkbox">
						<input type=submit name="Submit" value="Submit" class="form-control" />
						<label><input type="checkbox" title="New Window" onclick="document.getElementById('form').target = this.checked ? '_blank' : 'output';" /> New Window</label>
						<strong>(F1: Display Menu, F2: Toogle fullscreen, F3: Submit form)</strong>
					</div>
				</form>
			</td>
		</tr>
		<tr>
			<td style="height: 100%;">
				<iframe src="" name="output" style="width: 100%;height: 100%;border: 0;"></iframe>
			</td>
		</tr>
	</table>
	<script type="text/javascript">
		function focusnow() {
			window.setTimeout(function(){
				if (editor1.focus) {
					editor1.focus();
				}else{
					focusnow();
				}
			}, 1000);
		};
		focusnow();
	</script>
	<?php
}else{
	$db->debug=1;
	$sys->stop(false);
	$_SESSION['tools_sql'] = $_POST['sql'];
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