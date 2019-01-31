<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if(!isset($_POST['script']))
{
	if (!empty($_GET['wait']))
	{
		echo 'please wait...';
		die();
	}else{
		$sys->stop(false);
		$sys->set_layout('blank');
		_func('editor');
		$config = array(
			'id'         => 'script',
			'syntax'     => 'php',
			'syntaxes'   => 'php,html',
			// 'fullscreen' => true,
			);
		?>
		<table class="table" style="height: 100%;position: absolute;top: 0;left: 0;right: 0;bottom: 0;">
			<tr>
				<td>
					<form action="" method="POST" enctype="multipart/form-data" id="form" target="output">
						<?php echo editor_code($config, @$_SESSION['tools_script'], array());?>
						<div class="form-inline checkbox">
							<input type="submit" name="Submit" value="Execute" class="btn btn-default" />
							<select name="actionscript" class="form-control">
								<option>php</option>
								<option>html</option>
							</select>
							<label><input type="checkbox" name="use_template" value="1" title="use template" /> Use Template</label>
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
			_Bbc(function($){
				$("select[name=actionscript]").on("change", function(){
					var a = $(this).val();
					if (a=="php") {
						editor1.getSession().setMode("ace/mode/php");
					}else{
						editor1.getSession().setMode("ace/mode/html");
					}
					editor1.focus();
				});
			});
		</script>
		<?php
	}
} else {
	if (!empty($_POST['use_template']))
	{
		$sys->stop(false);
	}
	$_SESSION['tools_script'] = $_POST['script'];
	switch($_POST['actionscript'])
	{
		case 'html':
			echo $_POST['script'];
		break;
		case 'php':
		default:
			eval($_POST['script']);
		break;
	}
}
?>