<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$p = _ROOT.'templates/';
if (empty($_POST))
{
	$r  = _func('path', 'list', $p);
	$ar = array();
	foreach ($r as $f)
	{
		if (!preg_match('~admin_?~is', $f) && is_file($p.$f.'/index.php'))
		{
			$ar[] = $f;
		}
	}
	?>
	<form id="demomatch" name="demomatch" method="POST" target="output">
		<table width="100%" height="100%" border=0 cellpadding="0" cellspacing="0">
			<tr>
				<td style="height:100px;">
					<p>
						<textarea name="files" style="width: 100%;height: 150px;border: 1px solid #ccc;" placeholder="copy files or path to create file .html.php to selected templates"></textarea>
					</p>
					<p>
						Template Name: <select name="template"><?php echo createoption($ar); ?></select>
						<input name=submit type=submit value="submit" />
					</p>
					<iframe src="" frameborder="0" style="width: 100%;height: 450px;border: 1px solid #ccc;" name="output"></iframe>
				</td>
			</tr>
		</table>
	</form>
	<?php
}else{
	_func('path');
	if ($_POST['submit'] == 'submit')
	{
		if (empty($_POST['files']))
		{
			echo 'Please insert the file or path and separate by new line';
		}else{
			$template = @$_POST['template'];
			$files    = array();
			$r = explode("\n", $_POST['files']);
			foreach ($r as $f)
			{
				$f = trim($f);
				if (!empty($f))
				{
					if (!file_exists($f))
					{
						$f = _ROOT.$f;
					}

					if (file_exists($f))
					{
						if (is_file($f))
						{
							if (preg_match('~\.html\.php$~s', $f))
							{
								$files[] = $f;
							}
						}else{
							$r2 = find_templates($f);
							if (!empty($r2))
							{
								$files = array_merge($files, $r2);
							}
						}
					}
				}
			}
			if (empty($files))
			{
				echo 'no file template is found!';
			}else{
				$header = array('<label><input type="checkbox" onclick="$(\'.fls\').prop(\'checked\', this.checked);" checked="checked"> Files</label>', '<label><input type="checkbox" onclick="$(\'.ovwt\').prop(\'checked\', this.checked);"> Overwrite</label>');
				$data   = array();
				$forms  = '';
				foreach ($files as $i => $file)
				{
					$f      = preg_replace('~^'.preg_quote(_ROOT, '~').'~s', '', $file);
					$line   = array();
					$f_temp = _ROOT.'templates/'.$template.'/'.$f;
					$forms .= '<input type="hidden" name="files['.$i.']" value="'._ROOT.$f.'">'.
										'<input type="hidden" name="temps['.$i.']" value="'.$f_temp.'">'.
										'<input type="hidden" name="exists['.$i.']" value="'.(file_exists($f_temp)?'1':'0').'">';
					if (!file_exists($f_temp)) {
						$f_temp = '';
					}
					$line[] = '<label><input type="checkbox" name="action['.$i.']" value="1" class="fls" checked="checked" /> '.$f.'</label>';
					if (!empty($f_temp))
					{
						$line[] = '<label><input type="checkbox" name="overwrite['.$i.']" value="1" class="ovwt" /> templates/'.$template.'/'.$f.'</label>';
					}else{
						$line[] = '';
					}
					$data[] = $line;
				}
				$sys->stop(false);
				$sys->set_layout('blank');
				echo '<form method="POST" action="" enctype="multipart/form-data" role="form" style="background-color: #fff;">';
				echo table($data, $header).$forms;
				echo '<button type="submit" class="btn btn-primary" name="submit" value="action">Copy those files</button>';
				echo '</form>';
			}
		}
	}else{
		$r = (array)@$_POST['action'];
		$o = array();
		foreach ($r as $i => $ok)
		{
			if (!empty($ok))
			{
				$file = @$_POST['files'][$i];
				$temp = @$_POST['temps'][$i];
				$exts = @$_POST['exists'][$i];
				if (!empty($exts) && empty($_POST['overwrite'][$i]))
				{
					$ok = false;
				}
				if ($ok)
				{
					$o[] = $file.'	=>	'.$temp;
					file_write($temp,'');
					copy($file, $temp);
					chmod($temp, 0644);
				}
			}
		}
		if (!empty($o))
		{
			pr($o);
		}else{
			echo "no file has been executed!";
		}
	}
}
function find_templates($dir, $prefix='')
{
	if (!empty($dir))
	{
		if (is_array($dir))
		{
			$output = array();
			foreach ($dir as $var => $val)
			{
				if (is_array($val))
				{
					$r = call_user_func(__FUNCTION__, $val, $prefix.$var.'/');
					if (!empty($r))
					{
						$output = array_merge($output, $r);
					}
				}else
				if(preg_match('~\.html\.php$~s', $val))
				{
					$output[] = $prefix.$val;
				}
			}
			return $output;
		}else
		if (file_exists($dir))
		{
			$dir .= substr($dir, -1)=='/' ? '' : '/';
			return call_user_func(__FUNCTION__, path_list_r($dir), $dir);
		}
	}
}