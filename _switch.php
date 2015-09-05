<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$notFile= array('_switch.php', 'index.php');
$M_DIR	= '/Users/danang/Documents/php/tools/';
if(!file_exists($M_DIR)){
echo $M_DIR;
die();
}else	chdir($M_DIR);
$sys->stop();
switch( $Bbc->mod['task'] )
{
	case 'main' :
	ob_start();
	?>
		<table>
		  <tr>
		    <td style="width:200px;">
		    	<IFRAME name="navigation" src="<?php echo site_url($Bbc->mod['circuit'].'.list');?>" frameBorder="0" width="100%" height="100%" scrolling="auto"></IFRAME>
		    </td>
		    <td>
		    	<IFRAME name="tasks" src="<?php echo site_url($Bbc->mod['circuit'].'.PHP');?>" frameBorder="0" width="100%" height="100%" scrolling="auto"></IFRAME>
		    </td>
		  </tr>
		</table>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	show_css($output);
	break;
	case 'list' :
	ob_start();
		echo '<div style="float: left;"><a href="" onClick="window.location.reload( true );return false" title="Refresh Left">V refresh</a></div>';
		echo '<div style="float:right;"><a href="" onClick=\'window.parent.frames["tasks"].window.location.reload( true );return false\' title="Refresh right"><b>&gt;</b> refresh</a></div>';
		echo '<br /><br />';
		if ($dir = @opendir($M_DIR))
		{
			$r_data = array();
			while (($data = readdir($dir)) !== false)
			{
				if(is_file($M_DIR.$data)
					&& !in_array($data, $notFile)
					&& substr(strtolower($data),-4)=='.php')
				{
					$r_data[] = preg_replace('~\.php$~is', '', $data);
				}
			}
			closedir($dir);
			asort ($r_data);
		}

		echo "<ul>";
		foreach((array)$r_data as $data)
		{
			echo "<li><a href=\"".$Bbc->mod['circuit'].".$data\" target=\"tasks\">$data</a></li>";
		}
		echo "</ul>";
	$output = ob_get_contents();
	ob_end_clean();
	show_css($output);
	break;
	default:
		$file = $Bbc->mod['task'].'.php';
		if(is_file($file)) {
			include $file;
		}
	break;
}

function show_css($data = '')
{
?>
<html>

<head>
<title>Test Script List</title>
<style type="text/css">
body{
margin: 0px;
padding: 0px;
font-family:verdana, arial, sans-serif;
font-size: 12px;
color: #666666
}
table{
margin: 0px;
padding: 0px;
width: 100%;
height: 100%;
border: 0px solid #307b9a;
}
td{
vertical-align:top;
}

ul {
clear: both;
list-style: dotted;
margin: 0px !important;
padding: 0px !important;
}
ul li{
padding-top: 5px !important;
padding-left: 2px !important;
}
a{
color: #666666;
text-decoration: none;
border-bottom: 1px #ccc dotted;
}
a:hover{
color: #a00000;
text-decoration: none;
}
a:active{
color: #ff0000;
text-decoration: none;
}
</style>
</head>
<body bgcolor="#ffffff">
	<?php echo $data;?>
</body>
</html>
<?php
}
