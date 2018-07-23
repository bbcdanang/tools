<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$sys->stop(false);
link_js(_URL.'includes/lib/pea/includes/formIsRequire.js');
$t_func = '
alert_add
alert_view
seo_uri
site_url
url_parse
user_change
user_create
user_create_validate
user_delete
user_login
user_logout
';
if (empty($_SESSION['r_func']))
{
	$_SESSION['r_func'] = array();
}
$r_func = explode("\n", $t_func);
sort($r_func);
$r_func = array_merge($r_func, $_SESSION['r_func']);
?>
<form action="" method="GET" role="form" class="formIsRequire">
	<legend>Check possible function that has been hooked</legend>
	<div class="form-group">
		<label for="">Function Name</label>
		<input type="text" class="form-control" name="func" value="<?php echo @$_GET['func']; ?>" placeholder="Function Name" req="any" />
	</div>
	<button type="submit" name="submit" value="submit" class="btn btn-primary">Check Function</button>
</form>
<div class="container-fluid" style="padding:15px;">
	<ul class="list-inline">
		<?php
		foreach ($r_func as $d)
		{
			$d = trim($d);
			if (!empty($d))
			{
				$cls = '';
				if (!empty($_GET['func']))
				{
					if ($_GET['func']==$d)
					{
						$cls = ' active';
					}
				}
				?>
				<li>
					<a href="" class="btn btn-sm btn-default function<?php echo $cls; ?>" title="<?php echo $d; ?>"><?php echo $d; ?></a>
				</li>
				<?php
			}
		}
		?>
	</ul>
</div>
<script type="text/javascript">
	_Bbc(function($){
		$(".function").on("click", function(e){
			e.preventDefault();
			$('input[name="func"]').val($(this).text());
			$(".btn-primary").trigger("click");
		});
	});
</script>
<?php
if (!empty($_GET['submit']))
{
	global $r_func;
	$func = $_GET['func'];
	$path = _ROOT.'modules/';
	$mods = user_modules();
	$out  = array();
	foreach ($mods as $mod)
	{
		if (function_exists($mod.'_'.$func))
		{
			$out[] = array(
				'module'   => $mod,
				'path'     => 'modules/'.$mod.'/_function.php',
				'function' => $mod.'_'.$func
			);
		}
	}
	if (!empty($out))
	{
		if (!in_array($func, $r_func))
		{
			if (!in_array($func, $_SESSION['r_func']))
			{
				$_SESSION['r_func'][] = $func;
			}
		}
	}
	pr($func, $out);
}