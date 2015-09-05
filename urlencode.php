<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$arr = array(
	'urlencode' => ''
,	'urldecode' => ''
);
$_POST['methodQuery'] = isset($_POST['methodQuery']) ? $_POST['methodQuery'] : 'urlencode';
?>
<form method="post" enctype="multipart/data">
	<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
	  <tr>
	    <td><textarea name="sql_query" class="text" style="width: 100%;height: 105px;"><?php echo @stripslashes($_POST['sql_query']);?></textarea></td>
	  </tr>
	  <tr>
	    <td><?php echo createRadio($arr, 'methodQuery', $_POST['methodQuery']);?></td>
	  </tr>
	  <tr>
	    <td style="padding-left: 35px;"><input type="submit" name="Submit" value="submit" class="button"></td>
	  </tr>
	</table>
</form>
<?php
if(!empty($_POST['sql_query']))
{
	echo "<div style='background-color:#ccc;width: 100%;'>";
	if($_POST['methodQuery']=='urlencode'){
		$output = urlencode($_POST['sql_query']);
	}else{
		$output = urldecode($_POST['sql_query']);
	}
	pr($output);
	echo "</div>";
}

function createRadio($arr, $name, $default = '')
{
	$output = '';
	foreach($arr AS $value => $caption)
	{
		$checked = '';
		if(!empty($default)){
			if(!is_array($default)){
				$checked = ($value==$default) ? ' checked="checked"' : '';
			}else{
				$checked = (in_array($value, $default)) ? ' checked="checked"' : '';
			}
		}
		if(empty($caption)) $caption = $value;
		$output .= "<label for='label$name$value'><input type='radio' id='label$name$value' name='$name' value='$value'$checked>";
		$output .= " $caption</label>\n";
	}
	return $output;
}
?>