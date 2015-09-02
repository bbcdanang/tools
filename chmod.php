<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if(!isset($_POST['Submit']))
{
?>
<form action="" method="POST" enctype="multipart/form-data" target="output">
	<table width="100%" height="100%" border=0 cellpadding="0" cellspacing="0">
		<tr>
			<td width="50">file</td>
			<td>:<input type="text" name="file" value="644" maxlength="3" /></td>
		</tr>
		<tr>
			<td>directory</td>
			<td>:<input type="text" name="directory" value="755" maxlength="3" /></td>
		</tr>
		<tr>
			<td>path</td>
			<td>:<input type="text" name="path" value="<?=dirname(__FILE__);?>" size="80"></td>
		</tr>
		<tr>
			<td colspan=2>
				<input type=submit name="Submit" value="Execute">
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
	$file= intval(0 . intval( $_POST['file'], 10),8);//'0'.intval($_POST['file']);
	$dir = intval(0 . intval( $_POST['directory'], 10),8);//'0'.intval($_POST['directory']);
	$path= is_dir($_POST['path']) ? $_POST['path'] : dirname(__FILE__);
	$text= '';
	if ( ! function_exists('path_chmod'))
	{
		function path_chmod($source_dir, $c_dir, $c_file, $top_level_only = FALSE)
		{
			if ($fp = @opendir($source_dir))
			{
				$source_dir = rtrim($source_dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;		
				$filedata = array();
				while (FALSE !== ($file = readdir($fp)))
				{
					if (strncmp($file, '.', 1) == 0)
					{
						continue;
					}
					$mode = @is_dir($source_dir.$file) ? $c_dir : $c_file;
					if ($top_level_only == FALSE && @is_dir($source_dir.$file))
					{
						$temp_array = array();
						$temp_array = path_chmod($source_dir.$file.DIRECTORY_SEPARATOR, $c_dir, $c_file);
						ob_start();
							chmod($source_dir.$file, $mode);
#							echo "chmod($source_dir.$file, $mode)";
							$o = ob_get_contents();
						ob_end_clean();
						if(!empty($o))
							$filedata[] = $o;
						$filedata   = array_merge($filedata, $temp_array);
					}
					else
					{
						ob_start();
							chmod($source_dir.$file, $mode);
#							echo "chmod($source_dir.$file, $mode)";
							$o = ob_get_contents();
						ob_end_clean();
						if(!empty($o))
							$filedata[] = $o;
					}
				}
				closedir($fp);
				return $filedata;
			}
		}
	}
	$r = path_chmod($path, $dir, $file);
	echo '<textarea style="width:100%;height: 90%;border: 0px;">'.print_r($r, 1).'</textarea>';
}
