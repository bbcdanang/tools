<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$sys->stop(false);
if (!empty($_POST['module']))
{
	$cfg = array();
	$r   = get_config($_POST['module']);
	if (!empty($_POST['config']))
	{
		$cfg = explode(',', trim(preg_replace('~([^a-z0-9_\-]+)~is', ',', trim(@$_POST['config'])), ','));
		$r   = call_user_func_array('config', $cfg);
	}
	if (!empty($r) && !empty($cfg))
	{
		$cfgs = implode("', '", $cfg);
		?>
		<form class="form-horizontal" role="form">
			<h3>Copy This:</h3>
			<div class="form-group">
				<input type="text" class="form-control" onclick="this.select();" value="get_config('<?php echo $_POST['module']; ?>', '<?php echo $cfgs; ?>');" readonly />
			</div>
			<div class="form-group">
				<input type="text" class="form-control" onclick="this.select();" value="config('<?php echo $cfgs; ?>');" readonly />
			</div>
		</form>
		<?php
	}
	pr($r);
	die();
}else{
	?>
	<div class="container-fluid">
		<form action="" id="config-form" method="POST" class="form-inline" role="form">
			<div class="form-group">
				<select name="module" id="module" class="form-control">
					<?php echo createOption(array_keys($sys->module_array)); ?>
				</select>
			</div>
			<div class="form-group">
				<input type="text" name="config" class="form-control" id="config" autocomplete="OFF" placeholder="Contoh: site,url">
			</div>
		</form>
		<div id="output"></div>
	</div>
	<script type="text/javascript">
		_Bbc(function($){
			$('#config-form').on("submit", function(e){
				e.preventDefault();
				var a = $("#config").val();
				$.ajax({
				  type: "POST",
				  url: document.location.href,
				  data: {"module":$("#module").val(), "config":$("#config").val()},
				  success: function(data){
				  	$("#output").html(data)
				  }
				});
			});
			$("#module").on("change", function(e){
				// e.preventDefault();
				$("#config-form").submit();
			}).trigger("change");
			$("#config").on("keyup", function(e){
				e.preventDefault();
				$("#config-form").submit();
			});
		});
	</script>
	<?php
}