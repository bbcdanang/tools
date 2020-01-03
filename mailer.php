<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if(!isset($_POST['module_id']))
{
	$sys->stop(false);
	$sys->set_layout('blank');
	_func('editor');
	$q = "SELECT id, name FROM bbc_module ORDER BY name";
	?>
	<form id="mailform" method="POST" enctype="multipart/form-data">
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
					<?php echo editor_code('params', "\$params = array(\n\n);");?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type=submit name="Submit" value="Execute" class="btn btn-default">
				</td>
			</tr>
		</table>
	</form>
	<div id="output"></div>
	<script type="text/javascript">
	_Bbc(function($){
		$("#mailform").on("submit", function(e){
			e.preventDefault();
			var x = document.location.href;
			x += x.indexOf("?") >= 0 ? "&" : "?";
			x += "is_ajax=1";
			$.ajax({
				url: x,
				method:"POST",
				data:$("#mailform").serialize(),
				global:true,
				success: function(a){
					$("#output").html(a);
				}
			});
		})
	});
	</script>
	<?php
} else {
	echo date('r')."<br />";
	@eval($_POST['params']);
	$sys->module_id = $_POST['module_id'];
	$to             = array();
	$r              = explode(',', $_POST['mail_to']);
	foreach($r AS $t)
	{
		$r = explode(';', $t);
		foreach($r AS $t)
		{
			if(is_email($t))
			{
				$to[] = $t;
			}
		}
	}
	pr($params, __FILE__.':'.__LINE__);
	@extract($params);
	$sys->mail_send($to, $_POST['template'], $debug = true);
}