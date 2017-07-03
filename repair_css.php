<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$_URL = _URL.'tools/repair_css';
if(!empty($_POST['delete_css']))
{
  redirect($_URL);
}
meta_title('Ubah style CSS', 2);
$path = @$_GET['path'];
$sys->stop(false);
$sys->set_layout(_ROOT.'templates/admin/blank.php');
if (!empty($path))
{
	$path = preg_replace('~^'.preg_quote(_ROOT, '~').'~is', '', $path);
	if (file_exists(_ROOT.$path))
	{
		$path = _ROOT.$path;
	}
	if (!file_exists($path))
	{
		redirect($_URL);
	}
}
if (empty($path))
{
	?>
	<div class="container">
		<form action="" method="GET" class="form-inline" role="form">
			<div class="form-group">
				<input type="text" name="path" class="form-control" placeholder="File Path CSS / HTML" />
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
	<?php
}else{
	$text = file_read($path);
	if(!empty($_POST['save_css']))
	{
	  $result = $text;
	  foreach($_POST AS $key => $value)
	  {
	    if($key != 'save_css')
	    {
	    	$result = preg_replace('~(#'.$key.'(;)?)~s', '#'.$value.'$2', $result);
	    }
	  }
	  file_write($path, $result);
	}
	if (preg_match_all('~#([0-9a-f]{2,6})~is', $text, $match))
	{
		?>
		<div class="container">
			<form action="" method="POST" class="form-horizontal" role="form">
				<div class="form-group">
					<legend>Change CSS Color</legend>
				</di>
				<?php
				$arr = array();
				foreach((array)@$match[1] AS $txt)
				{
					if(empty($arr[$txt]))
					{
						$arr[$txt] = 1;
					}else{
						$arr[$txt]++;
					}
				}
				foreach($arr AS $color => $number)
				{
					?>
					<div class="form-group">
						<div class="form-inline">
							<input type="text" class="form-control" value="<?php echo $color; ?>" style="background-color: #<?php echo $color; ?>" readonly />
							<div class="input-group colorpicker-component">
								<input type="text" name="<?php echo $color; ?>" value="<?php echo $color; ?>" class="form-control colors" />
								<span class="input-group-addon"><i></i></span>
							</div>
							<?php echo items($number); ?>
						</div>
					</div>
					<?php
				}
				?>
				<div class="form-group">
					<button type="submit" name="save_css" value="Save Change" class="btn btn-primary">Save Change</button>
					<button type="submit" name="delete_css" value="Change CSS File"" class="btn btn-default">Change CSS File</button>
				</div>
			</form>
		</div>
		<style type="text/css">
			.input-group-addon {
				background-color: transparent;
			}
		</style>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			_Bbc(function($){
				$.getScript(
					"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/js/bootstrap-colorpicker.min.js",
					function(){
						$(".colors").colorpicker().on("changeColor", function(e){
							$(this).closest(".colorpicker-component").find(".input-group-addon").get(0).style.backgroundColor=e.color.toString("rgba");
						});
					});
			});
		</script>
		<?php
	}
}
