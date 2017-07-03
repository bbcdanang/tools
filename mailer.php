<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if(!isset($_POST['Submit']))
{
	$sys->stop(false);
	$sys->set_layout('blank');
	$q = "SELECT id, name FROM bbc_module ORDER BY name";
	?>
	<form action="" method="POST" enctype="multipart/form-data" target="output">
		<table class="table">
			<tr>
				<td width="100px">Template</td>
				<td><input type=text name="template" value="" class="form-control"></td>
			</tr>
			<tr>
				<td>Module</td>
				<td><select name="module_id" class="form-control"><?php echo createOption($db->getAssoc($q), '');?></select></td>
			</tr>
			<tr>
				<td>Mail to</td>
				<td><input type=text name="mail_to" value="" class="form-control"></td>
			</tr>
			<tr>
				<td>Params</td>
				<td style="height:100px;">
					<textarea name="params" class="form-control" rows=3><?php echo "\$params = array(\n\n);"; ?></textarea>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type=submit name="Submit" value="Execute" class="btn btn-default">
				</td>
			</tr>
			<tr>
				<td colspan=2>
					<iframe src="" name="output" width="100%" height="100%" frameborder=0></iframe>
				</td>
			</tr>
		</table>
	</form>
	<?php
} else {
	@eval($_POST['params']);
	$sys->module_id = $_POST['module_id'];
	$to = array();
	$r = explode(',', $_POST['mail_to']);
	foreach($r AS $t) {
		$r = explode(';', $t);
		foreach($r AS $t) {
			if(is_email($t))
				$to[] = $t;
		}
	}
	@extract($params);
	$sys->mail_send($to
	, $_POST['template']
	, $debug = true);
}