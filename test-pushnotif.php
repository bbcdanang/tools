<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if (!empty($_POST['target']))
{
	$to   = array();
	$args = array();
	switch ($_POST['target'])
	{
		case 'username':
			if (empty($_POST['username']))
			{
				echo 'You must insert username!!';
				die();
			}
			if (!empty($_POST['group_id']))
			{
				foreach ($_POST['username'] as $username)
				{
					$to[] = $username.'-'.$_POST['group_id'];
				}
			}else{
				$to = $_POST['username'];
			}
			break;

		default:
			$to[] = $_POST['group'];
			break;
	}
	if (!empty($_POST['var']))
	{
		foreach ($_POST['var'] as $i => $var)
		{
			if (isset($_POST['val'][$i]))
			{
				$val  = $_POST['val'][$i];
				$test = json_decode($val, 1);
				if (!empty($test))
				{
					$val = $test;
				}
				$args[$var] = $val;
			}
		}
	}
	$post = array(
		$to,
		$_POST['title'],
		$_POST['message'],
		$_POST['module'],
		$args,
		$_POST['action'],
		);
	_func('alert');
	call_user_func_array('alert_push', $post);
	$txt = "\$args = '".json_encode($post, JSON_PRETTY_PRINT)."';\n_func('alert');\ncall_user_func_array('alert_push', json_decode(\$args, 1));";
	echo $txt;
	die();
}
$sys->stop(false);
$groups = $db->getAll("SELECT `id`, `name` FROM `bbc_user_group` WHERE 1");
link_js(_LIB.'pea/includes/formIsRequire.js');
?>
<form action="" method="POST" role="form" id="form" class="formIsRequire">
	<legend>Test Push Notification</legend>
	<div class="form-group">
		<label for="">Select target</label>
		<select name="target" id="target" class="form-control">
			<option value="username">username</option>
			<option value="group">group</option>
		</select>
	</div>
	<div class="form-group options" id="target_group">
		<label for="">Select User Group</label>
		<select name="group" id="group" class="form-control">
			<?php
			foreach ($groups as $group)
			{
				?>
				<option value="group:<?php echo $group['id']; ?>"><?php echo $group['name']; ?></option>
				<?php
			}
			?>
		</select>
	</div>
	<div id="target_username" class="options">
		<div class="form-group">
			<label for="">Insert Username</label>
			<?php
			link_js(_LIB.'pea/includes/FormTags.js');
			$token = encode(
				json_encode(
					array(
						'table'  => 'bbc_user',
						'field'  => 'username',
						'id'     => 'id',
						// 'format' => 'CONCAT(title, " (", content_id, ")")',
						'expire' => strtotime('+2 DAYS')
						)
					)
				);
			?>
			<div class="form-control tags">
				<span></span>
				<span data-token="<?php echo $token; ?>" data-isallowednew="0" name="username" req="any true" contenteditable></span>
			</div>
			<div class="btn-group" data-toggle="buttons">
				<label class="btn btn-default">
					<input type="radio" name="group_id" value="0"> --none--
				</label>
				<?php
				foreach ($groups as $group)
				{
					?>
					<label class="btn btn-default">
						<input type="radio" name="group_id" value="<?php echo $group['id']; ?>"> <?php echo $group['name']; ?>
					</label>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label>Title</label>
		<input type="text" name="title" class="form-control" placeholder="title of message" req="any true" />
	</div>
	<div class="form-group">
		<label>Message</label>
		<textarea name="message" class="form-control" placeholder="body of message" req="any true"></textarea>
	</div>
	<div class="form-group">
		<label>Module & Action</label>
		<div class="form-inline">
			<input type="text" name="module" class="form-control" value="content" placeholder="target module" req="any true" />
			<input type="text" name="action" class="form-control" value="default" placeholder="action" req="any true" />
		</div>
	</div>
	<?php
	link_js(_LIB.'pea/includes/FormMultiform.js');
	?>
	<div class="form-group">
		<div class="panel-group" id="accordion1">
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h4 class="panel-title" data-toggle="collapse" data-parent="#accordion1" href="#pea_isHideToolOn1" style="cursor: pointer;">
			    	Parameter
			    </h4>
			  </div>
			  <div id="pea_isHideToolOn1" class="panel-collapse collapse in">
			    <div class="panel-body">
			    	<div class="multiform">
			    		<div class="form-inline">
			    			<input type="text" name="var[]" class="form-control" placeholder="variable" />
			    			<input type="text" name="val[]" class="form-control" placeholder="value" />
			    			<button type="button" class="btn btn-default btn-multiform"><?php echo icon('plus'); ?></button>
			    		</div>
			    	</div>
					</div>
			  </div>
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-primary"><?php echo icon('send'); ?> Send</button>
</form>
<pre id="output"></pre>
<div id="loading"></div>
<script type="text/javascript">
	_Bbc(function($){
		$( document ).ajaxStart(function() {
			$("#loading").show();
		}).ajaxStop(function(){
			$("#loading").hide();
		});
		$("#target").on("change", function(){
			$(".options").hide();
			$("#output").html("");
			switch($(this).val()) {
				case 'username':
					$("#target_username").show();
					break;
				default:
					$("#target_group").show();
					break;
			}
		}).trigger("change");
		$("#form").on("submit", function(e){
			e.preventDefault();
			var x = document.location.href;
			x += x.indexOf("?") >= 0 ? "&" : "?";
			x += "is_ajax=1";
			$.ajax({
				url: x,
				method:"POST",
				data:$(this).serialize(),
				global:true,
				success: function(a){
					$("#output").html(a);
				}
			});
		});
	});
</script>