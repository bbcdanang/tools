<?php

if (!defined('_VALID_BBC'))
{
	$Mpath = $_SESSION['Mpath'];
	$Bbc   = new stdClass();
	define( '_VALID_BBC', 1 );
	define( '_ADMIN', '' );
	include $Mpath.'config.php';
	include_once _ROOT.'_function.php';
	define('_INC'		, _ROOT.'includes/');
	define('_CLASS'	, _INC.'class/');
	define('_CONF'	, _INC.'config/');
	define('_FUNC'	, _INC.'function/');
	define('_LIB'		, _INC.'lib/');
	define('_SYS'		, _INC.'system/');
	include_once _SYS.'db.class.php';
	_func('config');
	_func('language');
	_func('file');
	_func('path');
}else{
	$Mpath = _ROOT;
	_func('config');
	_func('language');
	_func('file');
	_func('path');
	meta_title('Reset Website', 2);
}
/*
CREATE FUNCTION FOR OLD FRAMEWORK
*/
if (!function_exists('config_encode')) {
	function config_encode($array) {
		return @serialize(urlencode_r($array));
	}
}
if (!function_exists('config_decode')) {
	function config_decode($string) {
		return urldecode_r(@unserialize($string));
	}
}
$_URL      = _URL.'tools/repair';
$lang_r    = array_keys(lang_assoc());
$sys->stop(false);
$sys->set_layout(_ROOT.'templates/admin/blank.php');
$db->debug = 1;
switch(@$_GET['id'])
{
	case 'clean_cache':
		tools_clean_cache();
	break;
	case 'clean_menu':
		tools_clean_menu();
	break;
	case 'clean_block':
		tools_clean_block();
	break;
	case 'clean_module':
		tools_clean_module();
	break;
	case 'clean_template':
		tools_clean_template();
	break;
	case 'clean_content':
		tools_clean_content();
	break;
	case 'clean_category':
		tools_clean_category();
	break;
	case 'clean_language':
		tools_clean_language();
	break;
	case 'clean_tables':
		tools_clean_tables();
	break;
	case 'change_salt':
		tools_change_salt();
	break;
	case 'change_email':
		tools_change_email();
	break;
	case 'check_template':
	  tools_check_template();
	break;
	case 'logout':
		header('Location:'.$_SERVER['PHP_SELF'].'?path=old');
	break;
	default:
	 show_form();
	break;
}
echo implode('', (array)$Bbc->debug);
function tools_repair_table($tablename, $parfield = 'par_id', $ordered= '', $r_change = array(), $out_id='')
{
	global $db;
	if(!empty($tablename[1]) && is_array($tablename[1]))
	{
		$arr = $tablename[1];
		$tablename = $tablename[0];
	}else{
		$arr = $db->getAssoc("SELECT * FROM `$tablename` WHERE 1 $ordered");
		ksort($arr);	reset($arr);
	}
	$parfield = empty($parfield) ? 'par_id' : $parfield;
	if(empty($arr)) return false;
	$fields	= $db->getCol("EXPLAIN `$tablename`");
	$db->Execute("TRUNCATE TABLE `$tablename`");
	if(count($fields) > 2)
	{
		$p_field= $fields[0];unset($fields[0]);
		if(empty($out_id)) $out_id = $p_field;
		foreach($arr AS $i => $data)
		{
			$data = addslashes_r($data);
			$insert = array();
			foreach($fields AS $f)
			{
				if($f != $p_field)
				{
					if($f == $parfield)
					{
						$data[$f] = @intval($arr[$data[$f]][$out_id]);
					}else{
						if(!empty($r_change[$f][$data[$f]][$f]))
						{
							$data[$f] = @intval($r_change[$f][$data[$f]][$f]);
						}
					}
					$insert[] = "`$f`='".$data[$f]."'";
				}
			}
			$db->Execute("INSERT INTO `$tablename` SET ".implode(',', $insert));
			$arr[$i][$out_id] = $db->Insert_ID();
		}
		$output = $arr;
	}else{
		$output = array();
		foreach($arr AS $i => $data)
		{
			$data = addslashes_r($data);
			$db->Execute("INSERT INTO `$tablename` SET `".$fields[1]."`='$data'");
			$output[$i] = array($fields[0] => $db->Insert_ID(), $fields[1] => $data);
		}
	}
	return $output;
}
function tools_clean_cache()
{
	global $db;
	$r = $db->getCol("SHOW TABLES");
	$tables = '`'.implode('`, `', $r).'`';
	$db->Execute("REPAIR TABLE $tables");
	$db->Execute("FLUSH TABLE $tables");
	_func('path');
	path_delete(_ROOT.'images/cache');
	show_form();
}
function tools_clean_module()
{
	global $Bbc, $db, $lang_r;
	// FETCH ALL TABLES
	$db->debug=0;
	$r = $db->getCol("SHOW TABLES");
	$tables = array();
	foreach($r AS $t)
	{
	  $ft = $db->getCol("SHOW FIELDS FROM `$t`");
	  $fields		= array();
	  $is_found = false;
	  foreach($ft AS $f)
	  {
	    if(preg_match('~^module_id~is', $f))
	    {
	      $fields[] = $f;
	    }
	  }
	  if(!empty($fields))
	  {
	    $tables[] = array('table' => $t, 'fields' => $fields);
	  }
	}
	// REPAIR MODULES
	$db->debug=1;
	$r_module = $db->getAssoc("SELECT * FROM bbc_module WHERE 1 ORDER BY id ASC");
	$fields		= $db->getCol("EXPLAIN bbc_module");
	$db->Execute("TRUNCATE TABLE `bbc_module`");
	foreach($r_module AS $i => $module)
	{
		$module = addslashes_r($module);
		$insert = array();
		foreach($fields AS $f)
		{
			if($f != 'id')
			{
				$insert[] = "`$f`='".$module[$f]."'";
			}
		}
		$db->Execute("INSERT INTO bbc_module SET ".implode(',', $insert));
		$r_module[$i]['id'] = $db->Insert_ID();
	}
	// REPAIR TABLES
	foreach($tables AS $data)
	{
		$r_rows = $db->getAssoc("SELECT id, ".implode(',', $data['fields'])." FROM ".$data['table']);
		foreach($data['fields'] AS $field)
		{
			foreach($r_rows AS $i => $row)
			{
				if($field == 'module_id')
				{
					$module_id = @intval($r_module[$row]['id']);
					$db->Execute("UPDATE `".$data['table']."` SET `$field`=$module_id WHERE id=$i");
				}else{
					$r = repairExplode($row[$field]);
					if(!empty($r))
					{
						$r_new = array();
						foreach($r AS $m_id)
						{
							if(!empty($r_module[$m_id]['id']))
							{
								$r_new[] = $r_module[$m_id]['id'];
							}
						}
						if(!empty($r_new))
						{
							$db->Execute("UPDATE `".$data['table']."` SET `$field`='".repairImplode($r_new)."' WHERE id=$i");
						}
					}
				}
			}
		}
	}
	tools_clean_cache();
}
function tools_clean_block()
{
	global $Bbc, $db, $lang_r;

	// REPAIR TEMPLATES
	$templates = $db->getAssoc("SELECT * FROM bbc_template WHERE 1 ORDER BY id ASC");
	$fields		= $db->getCol("EXPLAIN bbc_template");
	$db->Execute("TRUNCATE TABLE `bbc_template`");
	foreach($templates AS $i => $template)
	{
		$template = addslashes_r($template);
		$insert = array();
		foreach($fields AS $f)
		{
			if($f != 'id')
			{
				$insert[] = "`$f`='".$template[$f]."'";
			}
		}
		$db->Execute("INSERT INTO bbc_template SET ".implode(',', $insert));
		$templates[$i]['id'] = $db->Insert_ID();
	}

	// REPAIR BLOCK REF
	$block_ref = $db->getAssoc("SELECT * FROM bbc_block_ref WHERE 1 ORDER BY id ASC");
	$fields		= $db->getCol("EXPLAIN bbc_block_ref");
	$db->Execute("TRUNCATE TABLE `bbc_block_ref`");
	foreach($block_ref AS $i => $name)
	{
		$insert = array();
		foreach($fields AS $f)
		{
			if($f != 'id')
			{
				$insert[] = "`$f`='".$name."'";
			}
		}
		$db->Execute("INSERT INTO bbc_block_ref SET ".implode(',', $insert));
		$block_ref[$i] = $db->Insert_ID();
	}

	// REPAIR BLOCK POSITION
	$block_position = $db->getAssoc("SELECT * FROM bbc_block_position WHERE 1 ORDER BY id ASC");
	$fields					= $db->getCol("EXPLAIN bbc_block_position");
	$db->Execute("TRUNCATE TABLE `bbc_block_position`");
	foreach($block_position AS $i => $position)
	{
		$insert = array();
		foreach($fields AS $f)
		{
			if($f != 'id')
			{
				$insert[] = "`$f`='".$position."'";
			}
		}
		$db->Execute("INSERT INTO bbc_block_position SET ".implode(',', $insert));
		$block_position[$i] = $db->Insert_ID();
	}

	// REPAIR BLOCK THEME
	$block_theme = $db->getAssoc("SELECT * FROM bbc_block_theme WHERE 1 ORDER BY id ASC");
	$fields		= $db->getCol("EXPLAIN bbc_block_theme");
	$db->Execute("TRUNCATE TABLE `bbc_block_theme`");
	foreach($block_theme AS $i => $theme)
	{
		$theme = addslashes_r($theme);
		$insert = array();
		foreach($fields AS $f)
		{
			if($f != 'id')
			{
				if($f == 'template_id') $theme[$f] = $templates[$theme[$f]]['id'];
				$insert[] = "`$f`='".$theme[$f]."'";
			}
		}
		$db->Execute("INSERT INTO bbc_block_theme SET ".implode(',', $insert));
		$block_theme[$i]['id'] = $db->Insert_ID();
	}

	// REPAIR BLOCK
	$blocks = $db->getAssoc("SELECT * FROM bbc_block WHERE 1 ORDER BY id ASC");
	$fields		= $db->getCol("EXPLAIN bbc_block");
	$db->Execute("TRUNCATE TABLE `bbc_block`");
	foreach($blocks AS $i => $block)
	{
		$block = addslashes_r($block);
		$insert = array();
		foreach($fields AS $f)
		{
			if($f != 'id')
			{
				switch($f)
				{
					case 'template_id':
						$block[$f] = @intval($templates[$block[$f]]['id']);
					break;
					case 'block_ref_id':
						$block[$f] = @intval($block_ref[$block[$f]]);
					break;
					case 'position_id':
						$block[$f] = @intval($block_position[$block[$f]]);
					break;
					case 'theme_id':
						$block[$f] = @intval($block_theme[$block[$f]]['id']);
					break;
				}
				$insert[] = "`$f`='".$block[$f]."'";
			}
		}
		$db->Execute("INSERT INTO bbc_block SET ".implode(',', $insert));
		$blocks[$i]['id'] = $db->Insert_ID();
	}

	// REPAIR BLOCK TEXT
	$block_text = $db->getAll("SELECT * FROM bbc_block_text WHERE 1 ORDER BY block_id, lang_id ASC");
	$fields		= $db->getCol("EXPLAIN bbc_block_text");
	$db->Execute("TRUNCATE TABLE `bbc_block_text`");
	foreach($block_text AS $text)
	{
		$text = addslashes_r($text);
		$insert = array();
		foreach($fields AS $f)
		{
			if($f != 'id')
			{
				if($f == 'block_id') $text[$f] = $blocks[$text[$f]]['id'];
				$insert[] = "`$f`='".$text[$f]."'";
			}
		}
		$db->Execute("INSERT INTO bbc_block_text SET ".implode(',', $insert));
	}
	tools_clean_cache();
}
function tools_clean_menu()
{
	global $Bbc, $db, $lang_r;
	// FETCH ALL TABLES
	$db->debug=0;
	$r = $db->getCol("SHOW TABLES");
	$tables = array();
	foreach($r AS $t)
	{
	  $ft = $db->getCol("SHOW FIELDS FROM `$t`");
	  $fields		= array();
	  $is_found = false;
	  foreach($ft AS $f)
	  {
	    if(preg_match('~^menu_id~is', $f))
	    {
	      $fields[] = $f;
	    }
	  }
	  if(!empty($fields))
	  {
	    $tables[] = array('table' => $t, 'fields' => $fields);
	  }
	}
	$db->Execute("UPDATE bbc_menu SET cat_id=1 WHERE is_admin=1");
	// REPAIR BBC_MENU

	$arr = array();
	_tools_clean_menu_fetch($arr , 1);
	_tools_clean_menu_fetch($arr , 0);
	$db->debug=1;
	$q = "SELECT * FROM `bbc_menu_cat` ORDER BY orderby ASC";
	$r = $db->getAll($q);
	$fields		= $db->getCol("EXPLAIN `bbc_menu_cat`");
	$db->Execute("TRUNCATE TABLE `bbc_menu_cat`");
	$cats = array();
	$i = 0;
	foreach($r AS $data)
	{
		$i++;
		$data = addslashes_r($data);
		$insert = array();
		foreach($fields AS $f)
		{
			if($f != 'id')
			{
				if($f == 'orderby') $data[$f] = $i;
				$insert[] = "`$f`='".$data[$f]."'";
			}
		}
		$db->Execute("INSERT INTO `bbc_menu_cat` SET ".implode(',', $insert));
		$cats[$data['id']] = $db->Insert_ID();
	}
	$fields		= $db->getCol("EXPLAIN bbc_menu");
	$db->Execute("TRUNCATE TABLE `bbc_menu`");
	foreach($arr AS $i => $data)
	{
		$data = addslashes_r($data);
		$insert = array();
		foreach($fields AS $f)
		{
			if($f != 'id')
			{
				if($f == 'par_id') $data[$f] = @intval($arr[$data[$f]]['id']);
				elseif($f == 'cat_id') $data[$f] = @intval($cats[$data[$f]]);
				$insert[] = "`$f`='".$data[$f]."'";
			}
		}
		$db->Execute("INSERT INTO bbc_menu SET ".implode(',', $insert));
		$arr[$i]['id'] = $db->Insert_ID();
	}
	$menus = $arr;
	// REPAIR BBC_MENU_TEXT
	$arr			= $db->getAll("SELECT * FROM bbc_menu_text WHERE 1 ORDER BY menu_id, lang_id ASC");
	$fields		= $db->getCol("EXPLAIN bbc_menu_text");
	$db->Execute("TRUNCATE TABLE `bbc_menu_text`");
	foreach($arr AS $i => $data)
	{
		$data = addslashes_r($data);
		$insert = array();
		foreach($fields AS $f)
		{
			switch($f)
			{
				case 'menu_id':
					$data[$f] = $menus[$data['menu_id']]['id'];
				break;
			}
			$insert[] = "`$f`='".$data[$f]."'";
		}
		$db->Execute("INSERT INTO bbc_menu_text SET ".implode(',', $insert));
	}
	// REPAIR ALL TABLES
	foreach($tables AS $data)
	{
		if(in_array('id', $data['fields']))
		{
			$r_rows = $db->getAssoc("SELECT id, ".implode(',', $data['fields'])." FROM ".$data['table']);
			foreach($data['fields'] AS $field)
			{
				foreach($r_rows AS $i => $row)
				{
					if($field == 'menu_id')
					{
						$menu_id = @intval($menus[$row]['id']);
						$db->Execute("UPDATE `".$data['table']."` SET `$field`=$menu_id WHERE id=$i");
					}else{
						$r = repairExplode($row[$field]);
						if(!empty($r))
						{
							$r_new = array();
							foreach($r AS $m_id)
							{
								if(!empty($menus[$m_id]['id']))
								{
									$r_new[] = $menus[$m_id]['id'];
								}
							}
							if(!empty($r_new))
							{
								$db->Execute("UPDATE `".$data['table']."` SET `$field`='".repairImplode($r_new)."' WHERE id=$i");
							}
						}
					}
				}
			}
		}
	}
	tools_clean_cache();
}
function _tools_clean_menu_fetch(&$output, $is_admin=0, $par_id = 0)
{
	global $db;
	$q = "SELECT * FROM bbc_menu WHERE par_id=$par_id AND is_admin=$is_admin ORDER BY orderby ASC";
	$r = $db->getAssoc($q);
	foreach($r AS $i => $d)
	{
		$output[$i] = $d;
		_tools_clean_menu_fetch($output, $is_admin, $i);
	}
}
function tools_clean_template()
{
	global $db;
	$q = "TRUNCATE `bbc_block`;TRUNCATE `bbc_block_text`;TRUNCATE `bbc_block_theme`;TRUNCATE `bbc_template`";
	$r = explode(';', $q);
	foreach($r AS $q)
	{
		// $db->Execute($q);
	}
}
function tools_clean_content()
{
	global $Bbc, $db, $lang_r;
	// FETCH ALL TABLES
	$db->debug=0;
	$r = $db->getCol("SHOW TABLES");
	$tables = array();
	foreach($r AS $t)
	{
	  $ft = $db->getCol("SHOW FIELDS FROM `$t`");
	  $fields		= array();
	  $is_found = false;
	  foreach($ft AS $f)
	  {
	    if(preg_match('~^content_id~is', $f))
	    {
	      $fields[] = $f;
	    }
	  }
	  if(!empty($fields))
	  {
	    $tables[] = array('table' => $t, 'fields' => $fields);
	  }
	}
	$db->debug=1;
	// REPAIR BBC_CONTENT
	$arr			= $db->getAssoc("SELECT * FROM bbc_content WHERE 1 ORDER BY id ASC");
	$fields		= $db->getCol("EXPLAIN bbc_content");
	$db->Execute("TRUNCATE TABLE `bbc_content`");
	foreach($arr AS $i => $data)
	{
		$insert = array();
		foreach($fields AS $f)
		{
			if($f != 'id')
			{
				if($f == 'par_id') $data[$f] = @intval($arr[$data[$f]]['id']);
				$insert[] = "`$f`='".addslashes($data[$f])."'";
			}
		}
		$db->Execute("INSERT INTO bbc_content SET ".implode(',', $insert));
		$arr[$i]['id'] = $db->Insert_ID();
	}
	$contents = $arr;
	// REPAIR BBC_MENU_TEXT
	$arr			= $db->getAll("SELECT * FROM bbc_content_text WHERE 1 ORDER BY content_id, lang_id ASC");
	$fields		= $db->getCol("EXPLAIN bbc_content_text");
	$db->Execute("TRUNCATE TABLE `bbc_content_text`");
	foreach($arr AS $i => $data)
	{
		$insert = array();
		foreach($fields AS $f)
		{
			switch($f)
			{
				case 'content_id':
					$data[$f] = $contents[$data['content_id']]['id'];
				break;
				case 'hits':
					$data[$f] = 0;
				break;
			}
			$insert[] = "`$f`='".addslashes($data[$f])."'";
		}
		$db->Execute("INSERT INTO bbc_content_text SET ".implode(',', $insert));
	}
	// REPAIR ALL TABLES
	foreach($tables AS $data)
	{
		$fields = $db->getCol("EXPLAIN `".$data['table']."`");
		if($data['table'] == 'bbc_content_related')
		{
			$db->Execute("TRUNCATE TABLE `".$data['table']."`");
		}else
		if(in_array('id', $fields))
		{
			$r_rows = $db->getAssoc("SELECT id, ".implode(',', $data['fields'])." FROM ".$data['table']);
			foreach($data['fields'] AS $field)
			{
				foreach($r_rows AS $i => $row)
				{
					if($field == 'content_id')
					{
						$content_id = @intval($contents[$row]['id']);
						$db->Execute("UPDATE `".$data['table']."` SET `$field`=$content_id WHERE id=$i");
					}else{
						$r = repairExplode($row[$field]);
						if(!empty($r))
						{
							$r_new = array();
							foreach($r AS $m_id)
							{
								if(!empty($contents[$m_id]['id']))
								{
									$r_new[] = $contents[$m_id]['id'];
								}
							}
							if(!empty($r_new))
							{
								$db->Execute("UPDATE `".$data['table']."` SET `$field`='".repairImplode($r_new)."' WHERE id=$i");
							}
						}
					}
				}
			}
		}else
		if($data['table'] == 'bbc_content_category')
		{
			$arr			= $db->getAssoc("SELECT * FROM `".$data['table']."` WHERE 1 ORDER BY content_id, cat_id ASC");
			$fields		= $db->getCol("EXPLAIN `".$data['table']."`");
			$db->Execute("TRUNCATE TABLE `".$data['table']."`");
			foreach($arr AS $i => $dt)
			{
				$dt = addslashes_r($dt);
				$insert = array();
				foreach($fields AS $f)
				{
					if($f != 'category_id')
					{
						if($f == 'content_id') $dt[$f] = @intval($contents[$dt[$f]]['id']);
						$insert[] = "`$f`='".$dt[$f]."'";
					}
				}
				$db->Execute("INSERT INTO `".$data['table']."` SET ".implode(',', $insert));
			}
		}else
		if( $data['table'] != 'bbc_content_text')
		{
			$arr			= $db->getAssoc("SELECT * FROM `".$data['table']."` WHERE 1");
			$fields		= $db->getCol("EXPLAIN `".$data['table']."`");
			$db->Execute("TRUNCATE TABLE `".$data['table']."`");
			foreach($arr AS $i => $dt)
			{
				$dt = addslashes_r($dt);
				$insert = array();
				foreach($fields AS $f)
				{
					if($f != 'id')
					{
						if($f == 'content_id') $dt[$f] = @intval($contents[$dt[$f]]['id']);
						$insert[] = "`$f`='".$dt[$f]."'";
					}
				}
				$db->Execute("INSERT INTO `".$data['table']."` SET ".implode(',', $insert));
			}
		}
	}
	// REPAIR BBC_MENU
	$r = $db->getAll("SELECT `id`, `content_id`, `link` FROM `bbc_menu` WHERE `is_content`=1");
	foreach($r AS $d)
	{
		$link = preg_replace('~&id=([0-9]+)&~s', '&id='.$d['content_id'].'&', $d['link']);
		if($d['link'] != $link)
		{
			$db->Execute("UPDATE bbc_menu SET `link`='$link' WHERE id=".$d['id']);
		}
	}
	// DELETE ALL TRASHES
	include_once _ROOT.'modules/content/_class.php';
	$q = "SELECT id FROM bbc_content_trash WHERE 1";
	$r = $db->getCol($q);
	content_trash_delete($r);
	$q = "TRUNCATE TABLE `bbc_content_trash`";
	$db->Execute($q);
	tools_clean_cache();
}
function tools_clean_category()
{
	global $Bbc, $db, $lang_r;
	$db->debug=1;
	// REPAIR BBC_CONTENT_CATEGORY
	$arr			= $db->getAssoc("SELECT * FROM bbc_content_cat WHERE 1 ORDER BY type_id, par_id, id ASC");
	$fields		= $db->getCol("EXPLAIN bbc_content_cat");
	$db->Execute("TRUNCATE TABLE `bbc_content_cat`");
	foreach($arr AS $i => $data)
	{
		$data = addslashes_r($data);
		$insert = array();
		foreach($fields AS $f)
		{
			if($f != 'id')
			{
				if($f == 'par_id') $data[$f] = @intval($arr[$data[$f]]['id']);
				$insert[] = "`$f`='".$data[$f]."'";
			}
		}
		$db->Execute("INSERT INTO bbc_content_cat SET ".implode(',', $insert));
		$arr[$i]['id'] = $db->Insert_ID();
	}
	$cats = $arr;
	// REPAIR BBC_CONTENT_CAT_TEXT
	$arr			= $db->getAll("SELECT * FROM bbc_content_cat_text WHERE 1 ORDER BY cat_id, lang_id ASC");
	$fields		= $db->getCol("EXPLAIN bbc_content_cat_text");
	$db->Execute("TRUNCATE TABLE `bbc_content_cat_text`");
	foreach($arr AS $i => $data)
	{
		$data = addslashes_r($data);
		$insert = array();
		foreach($fields AS $f)
		{
			switch($f)
			{
				case 'cat_id':
					$data[$f] = $cats[$data['cat_id']]['id'];
				break;
			}
			$insert[] = "`$f`='".$data[$f]."'";
		}
		$db->Execute("INSERT INTO bbc_content_cat_text SET ".implode(',', $insert));
	}
	// REPAIR BBC_MENU
	$q = "SELECT id, content_cat_id FROM bbc_menu WHERE is_content_cat=1";
	$r = $db->getAll($q);
	foreach($r AS $d)
	{
		$content_cat_id = @intval($cats[$d['content_cat_id']]['id']);
		$q = "UPDATE bbc_menu SET content_cat_id=$content_cat_id WHERE id=".$d['id'];
		$db->Execute($q);
	}
	// REPAIR BBC_CONTENT_CATEGORY
	$q = "SELECT category_id, cat_id FROM bbc_content_category WHERE 1";
	$r = $db->getAll($q);
	foreach($r AS $d)
	{
		$cat_id = @intval($cats[$d['cat_id']]['id']);
		$q = "UPDATE bbc_content_category SET cat_id=$cat_id WHERE category_id=".$d['category_id'];
		$db->Execute($q);
	}
	// REPAIR BBC_MENU
	$r = $db->getAll("SELECT `id`, `content_cat_id`, `link` FROM `bbc_menu` WHERE `is_content_cat`=1");
	foreach($r AS $d)
	{
		$link = preg_replace('~&id=([0-9]+)&~s', '&id='.$d['content_cat_id'].'&', $d['link']);
		if($d['link'] != $link)
		{
			$db->Execute("UPDATE bbc_menu SET `link`='$link' WHERE id=".$d['id']);
		}
	}
	tools_clean_cache();
}
function tools_clean_language()
{
	global $Bbc, $db, $lang_r;
	// REPAIR BBC_LANG_CODE
	$arr			= $db->getAssoc("SELECT * FROM `bbc_lang_code` WHERE 1 ORDER BY module_id, id ASC");
	$fields		= $db->getCol("EXPLAIN `bbc_lang_code`");
	$db->Execute("TRUNCATE TABLE `bbc_lang_code`");
	foreach($arr AS $i => $data)
	{
		$data = addslashes_r($data);
		$insert = array();
		foreach($fields AS $f)
		{
			if($f != 'id')
			{
				if($f == 'par_id') $data[$f] = @intval($arr[$data[$f]]['id']);
				$insert[] = "`$f`='".$data[$f]."'";
			}
		}
		$db->Execute("INSERT INTO `bbc_lang_code` SET ".implode(',', $insert));
		$arr[$i]['id'] = $db->Insert_ID();
	}
	$rows			= $arr;
	// REPAIR BBC_LANG_TEXT
	$arr			= $db->getAll("SELECT * FROM `bbc_lang_text` WHERE 1 ORDER BY code_id, lang_id ASC");
	$fields		= $db->getCol("EXPLAIN `bbc_lang_text`");
	$db->Execute("TRUNCATE TABLE `bbc_lang_text`");
	foreach($arr AS $i => $data)
	{
		$data = addslashes_r($data);
		$insert = array();
		foreach($fields AS $f)
		{
			if($f !='text_id')
			{
				switch($f)
				{
					case 'code_id':
						$data[$f] = $rows[$data['code_id']]['id'];
					break;
				}
				$insert[] = "`$f`='".addslashes($data[$f])."'";
			}
		}
		$db->Execute("INSERT INTO `bbc_lang_text` SET ".implode(',', $insert));
	}
	tools_clean_cache();
}
function tools_clean_tables($tmp='')
{
	global $Bbc, $db, $lang_r;
	$r_table = array();
	$arr = $db->getCol("SHOW TABLES");
	$db->debug=1;
	$r = is_array($tmp) ? $tmp : explode(';', @$_GET['table']);
	foreach($r AS $td)
	{
		preg_match('~([a-z0-9_]+)~', $td, $m);
		if(!empty($m[1]) && in_array($m[1], $arr))
		{
			$d				= $m[1];
			$text			= in_array($d.'_text', $arr) ? $d.'_text' : '';
			$category = in_array($d.'_category', $arr) ? $d.'_category' : '';
			$comment	= in_array($d.'_comment', $arr) ? $d.'_comment' : '';
			$related	= in_array($d.'_related', $arr) ? $d.'_related' : '';
			$r_table[]= array('table' => $td, 'main' => $d, 'text' => $text, 'cat' => $category, 'comment' => $comment, 'related' => $related);
		}
	}
	foreach((array)$r_table AS $table)
	{
		// REPAIR MAIN_TABLE
		$orderby	= '';
		if(strstr($table['table'], '@'))
		{
			$r = explode('@', $table['table']);
			if(!empty($r[1]))
			{
				$orderby= 'ORDER BY '.$r[1];
				if(!preg_match('~ (?:desc|asc)(?:[^\w]|$)~is', $orderby))
				{
					$orderby .= ' ASC';
				}
			}
		}
		$arr			= $db->getAssoc("SELECT * FROM `".$table['main']."` WHERE 1 $orderby");
		$fields		= $db->getCol("EXPLAIN `".$table['main']."`");
		$db->Execute("TRUNCATE TABLE `".$table['main']."`");
		foreach($arr AS $i => $data)
		{
			$data = addslashes_r($data);
			$insert = array();
			foreach($fields AS $f)
			{
				if($f != 'id')
				{
					if($f == 'par_id') $data[$f] = @intval($arr[$data[$f]]['id']);
					$insert[] = "`$f`='".$data[$f]."'";
				}
			}
			$db->Execute("INSERT INTO `".$table['main']."` SET ".implode(',', $insert));
			$arr[$i]['id'] = $db->Insert_ID();
		}
		if(!empty($table['text']))
		{
			$rows			= $arr;
			$field_id = preg_replace('~^bbc_~', '', $table['main']).'_id';
			// REPAIR BBC_CONTENT_CAT_TEXT
			$arr			= $db->getAll("SELECT * FROM `".$table['text']."` WHERE 1 ORDER BY {$field_id}, lang_id ASC");
			$fields		= $db->getCol("EXPLAIN `".$table['text']."`");
			$db->Execute("TRUNCATE TABLE `".$table['text']."`");
			foreach($arr AS $i => $data)
			{
				$data = addslashes_r($data);
				$insert = array();
				foreach($fields AS $f)
				{
					switch($f)
					{
						case $field_id:
							$data[$f] = $rows[$data[$field_id]]['id'];
						break;
					}
					$insert[] = "`$f`='".$data[$f]."'";
				}
				$db->Execute("INSERT INTO `".$table['text']."` SET ".implode(',', $insert));
			}
		}
		if(!empty($table['cat']) || !empty($table['comment']) || !empty($table['related']))
		{
			$field_id = preg_replace(array('~^bbc_~','~_category$~'), array('',''), $table['cat']).'_id';
			// REPAIR TABLES
			$r = array('cat','comment','related');
			foreach($r AS $i)
			{
				if(!empty($table[$i]))
				{
					$tbl		= $table[$i];
					$arr		= $db->getAll("SELECT * FROM `".$tbl."` WHERE 1");
					$fields = $db->getCol("EXPLAIN `".$tbl."`");
					$db->Execute("TRUNCATE TABLE `".$tbl."`");
					foreach($arr AS $i => $data)
					{
						$data = addslashes_r($data);
						$insert = array();
						$exec	= true;
						foreach($fields AS $f)
						{
							if($f != 'id')
							{
								switch($f)
								{
									case $field_id:
										$data[$f] = @intval($rows[$data[$field_id]]['id']);
										if(empty($data[$f]))	$exec	= false;
									break;
									case 'related_id':
										$data[$f] = @intval($rows[$data['related_id']]['id']);
									break;
								}
								$insert[] = "`$f`='".addslashes($data[$f])."'";
							}
						}
						if($exec)
						{
							$db->Execute("INSERT INTO `".$tbl."` SET ".implode(',', $insert));
						}
					}
				}
			}
		}
	}
	tools_clean_cache();
}
function tools_change_salt()
{
	global $db, $Mpath;
	$code = @trim($_POST['code']);
	if(empty($code) || $code==_SALT) return false;
	$q = "SELECT id, password FROM bbc_user WHERE 1";
	$r = $db->getAll($q);
	_func('password');
	foreach($r AS $d)
	{
		$p0= '123456';//decode($d['password'], _SALT);
		$p = encode($p0, $code);
		$q = "UPDATE bbc_user SET password='$p' WHERE id=".$d['id'];
		$db->Execute($q);
		$db->dbOutput .= "\n".'<hr />'.$p0.' -- '.$d['password'].' -- '.$p.' -- '.$q.'<br />';
	}
	$txt = file_read(_ROOT.'config.php');
	file_write(_ROOT.'config.php', str_replace(_SALT, $code, $txt));
	tools_clean_cache();
	return true;
}
function tools_change_email()
{
  global $db;
  $q = "SELECT user_id, username, email FROM bbc_account WHERE 1 LIMIT 1";
  $usr = $db->getRow($q);
  $q = "SELECT id, params FROM bbc_config WHERE module_id=0 AND name='email'";
  $eml = $db->getRow($q);
  $eml['params'] = config_decode($eml['params']);
  $q = "SELECT id, params FROM bbc_config WHERE module_id=0 AND name='site'";
  $site = $db->getRow($q);
  $site['params'] = config_decode($site['params']);
  $email    = $usr['email'];
  $is_change = false;
  if($email != $_POST['email'] && is_email($_POST['email']))
  {
    $email = strtolower($_POST['email']);
    $q = "UPDATE bbc_account SET `email`='{$email}' WHERE user_id=".$usr['user_id'];
    $db->Execute($q);
    $is_change = true;
  }
  if($eml['params'] != $_POST['eml'])
  {
    $r = array_merge($eml['params'], $_POST['eml']);
    $params = config_encode($r);
    $q = "UPDATE bbc_config SET params='{$params}' WHERE id=".$eml['id'];
    $db->Execute($q);
    $is_change = true;
  }
  if($site['params']['url'] != $_POST['url'])
  {
    $site['params']['url'] = $_POST['url'];
    $params = config_encode($site['params']);
    $q = "UPDATE bbc_config SET params='{$params}' WHERE id=".$site['id'];
    $db->Execute($q);
    $is_change = true;
  }

  if($is_change)
  {
    $q = "UPDATE bbc_user SET login_time=0 WHERE 1";
    $db->Execute($q);
  	tools_clean_cache();
  }else{
    show_form();
  }
	return true;
}
function show_form()
{
	global $db, $Bbc, $_URL;
	$arr = array(
		'clean_cache'    => 'Clean Cache',
		'clean_module'   => 'Module',
		'clean_block'    => 'Block',
		'clean_menu'     => 'Menu',
		'clean_content'  => 'Content',
		'clean_category' => 'Category',
		'clean_language' => 'Language'
	);
	if (!empty($_SESSION['Mpath']))
	{
		$arr['logout'] = 'Logout ('.$_SESSION['Mpath'].')';
	}
	?>
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-repair-tools" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
		  	<?php
		  	if (!empty($_GET['id']))
		  	{
		  		?>
		      <a class="navbar-brand" href="<?php echo $_URL; ?>"><?php echo icon('triangle-left'); ?> Reset</a>
		  		<?php
		  	}
		  	?>
	    </div>
	    <div class="collapse navbar-collapse" id="menu-repair-tools">
		    <ul class="nav navbar-nav">
		    	<?php
		    	foreach ($arr as $i => $d)
		    	{
		    		$cls = @$_GET['id']==$i ? ' class="active"' : '';
		    		?>
		    		<li<?php echo $cls; ?>><a href="<?php echo $_URL; ?>/<?php echo $i; ?>"><?php echo $d; ?></a></li>
		    		<?php
		    	}
		    	?>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		    	<li><a><?php echo date('r'); ?></a></li>
		    </ul>
		   </div>
	  </div>
	</nav>
	<div style="padding-top: 70px;"></div>
	<?php
	if(empty($_GET['id']))
	{
  	$db->debug=0;
    $q = "SELECT username, email FROM bbc_account WHERE 1 LIMIT 1";
    $usr = $db->getRow($q);
    $q = "SELECT params FROM bbc_config WHERE module_id=0 AND name='email'";
    $eml = config_decode($db->getOne($q));
    $q = "SELECT params FROM bbc_config WHERE module_id=0 AND name='site'";
    $site = config_decode($db->getOne($q));
    $q = "SELECT params FROM bbc_config WHERE module_id=0 AND name='template'";
    $template = config_decode($db->getOne($q));
    $db->debug=1;
		?>
		<div class="form-inline">
			<button class="btn btn-default" onclick="return clean_tables('<?php echo $_URL;?>/clean_tables');"><?php echo icon('hand-right'); ?> Repair Tables</button>
			<div class="form-group">
				<input type="text" id="clean_tables" class="form-control" value="bbc_account;bbc_account_temp;bbc_bank;bbc_config;bbc_email;bbc_log;bbc_user;bbc_user_field;bbc_user_group">
			</div>
			<div class="form-control-static">nama2 table pisahkan dengan ;</div>
		</div>
		<script type="text/javascript">
			function clean_tables(a)
			{
				document.location.href = a+'&table='+document.getElementById('clean_tables').value;
				return false;
			}
		</script>
		<br class="clearfix" />
		<form action="<?php echo $_URL;?>/change_salt" class="form-inline" method="post">
			<div class="form-group">
				<button class="btn btn-default" type="submit"><?php echo icon('hand-right'); ?> Change Salt</button>
				<input type="text" name="code" class="form-control" value="<?php echo md5(rand(0,255));?>" /> <?php echo _ROOT;?>
			</div>
		</form>
		<form action="<?php echo $_URL; ?>/change_email" method="POST" class="form-horizontal" role="form">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Default Data</h3>
				</div>
				<div class="panel-body">
					<div class="form-inline">
						<label>User Name : </label>
						<input type="text" name="username" value="<?php echo $usr['username'];?>" readonly class="form-control" />
					</div>
					<div class="form-inline">
						<label>User Email : </label>
						<input type="text" name="email" value="<?php echo $usr['email'];?>" class="form-control" />
					</div>
					<div class="form-inline">
						<label>Web Domain : </label>
						<input type="text" name="url" value="<?php echo $site['url'];?>" class="form-control" />
					</div>
					<div class="form-inline">
						<label>Email Name : </label>
						<input type="text" name="eml[name]" value="<?php echo $eml['name'];?>" class="form-control" />
					</div>
					<div class="form-inline">
						<label>Email Address : </label>
						<input type="text" name="eml[address]" value="<?php echo $eml['address'];?>" class="form-control" />
					</div>
					<div class="form-inline">
						<label>Email Subject : </label>
						<input type="text" name="eml[subject]" value="<?php echo $eml['subject'];?>" class="form-control" />
					</div>
				</div>
				<div class="panel-footer">
					<button type="submit" name="change_email" value="Change" class="btn btn-default"><?php echo icon('floppy-saved'); ?> Change</button>
				</div>
			</div>
		</form>
		<form action="<?php echo $_URL;?>/check_template" method="post">
			<h3>Template "<?php echo $template; ?>"</h3>
			<ul class="list-group">
				<?php
			  _func('path');
			  $path = _ROOT.'templates/'.$template.'/';
			  $r = path_list($path.'css');
			  foreach($r AS $i => $file)
			  {
			    if(preg_match('~\.css$~is', $file))
			    {
			      echo '<li class="list-group-item"><label><input type="checkbox" name="css['.$i.']" checked="checked" value="css/'.$file.'" /> ./css/'.$file.'</label></li>';
			    }
			  }
			  $r = path_list($path);
			  foreach($r AS $file)
			  {
			    if(preg_match('~\.(?:php|html?)$~is', $file))
			    {
			      $i++;
			      echo '<li class="list-group-item"><label><input type="checkbox" name="css['.$i.']" checked="checked" value="'.$file.'" /> ./'.$file.'</label></li>';
			    }
			  }
				?>
				<li class="list-group-item"><button type="submit" name="change_email" value="Check" class="btn btn-default"><?php echo icon('check'); ?> Check</button></li>
			</ul>
			<input type="hidden" name="path" value="<?php echo $path;?>" />
		</form>
		<?php
	}
}
function tools_check_template()
{
	global $_URL;
  show_form();
  _func('path');
  _func('file');
  function tools_check_template_image($arr, $add = '')
  {
    $output = array();
    if (!empty($arr))
    {
	    foreach($arr AS $i => $dt)
	    {
	      if(is_array($dt))
	      {
	        $output = array_merge($output, tools_check_template_image($dt, $add.$i.'/'));
	      }else{
	        $output[] = $add.$dt;
	      }
	    }
    }
    return $output;
  }
  if(!empty($_POST['path']))
  {
    $path = $_POST['path'];
    $notfound = array('css'=>array(), 'image'=>array());
    $data = array();
    $images = tools_check_template_image(path_list_r($path.'images/'), 'images/');
    foreach((array)$_POST['css'] AS $css)
    {
      $data[$css] = file_read($path.$css);
    }
    $is_check = 0;
    foreach($data AS $css => $text)
    {
      if($is_check)
      {
        $arr = $notfound['css'];
        $notfound['css'] = array();
      }else $arr = $images;
      $is_check++;
      foreach($arr AS $image)
      {
        if(!strstr($text, $image))
        {
          $notfound['css'][] = $image;
        }
      }
      preg_match_all('~(images/[^\"\'\s\)]+)~is', $text, $match);
      foreach((array)$match[1] AS $image)
      {
        if(!in_array($image, $notfound['image']) && !in_array($image, $images))
        {
          $notfound['image'][] = $image;
        }
      }
    }
    if(!empty($notfound['css']))
    {
      $line = count($notfound['css']);
      $width= strlen($line)-1;
      if (empty($width))
      {
      	$width = 1;
      }
      ?>
      <form action="<?php echo $_URL;?>/check_template" method="post">
        <legend>Files are exist, but not found in templates OR css style</legend>
        <textarea name="no" cols=<?php echo $width;?> rows="<?php echo $line;?>" class="pull-left" style="font-family: courier new; border-right: 0;" readonly><?php for($i=1;$i<=$line;$i++) echo "\n".$i;?></textarea>
        <textarea name="deletes" cols="120" rows="<?php echo $line;?>" class="pull-left" style="font-family: courier new;border-left: 1px dotted;"><?php echo implode("\n", $notfound['css']);?></textarea>
        <div class="clearfix"></div>
        <input type="hidden" name="inpath" value="<?php echo $path;?>" />
        <div class="form-group">
        	<button class="btn btn-danger" name="change_email" value="Delete Those Files"><?php echo icon('trash'); ?> Delete Those Files</button>
        </div>
      </form>
      <?php
    }
    if(!empty($notfound['image']))
    {
      $line  = count($notfound['image']);
      $width= strlen($line)-1;
      if (empty($width))
      {
      	$width = 1;
      }
      ?>
        <legend>Image name found in css style OR templates, files are not exists</legend>
        <textarea name="no" cols=<?php echo $width;?> rows="<?php echo $line;?>" class="pull-left" style="font-family: courier new; border-right: 0;" readonly><?php for($i=1;$i<=$line;$i++) echo "\n".$i;?></textarea>
        <textarea name="notexists" cols="120" rows="<?php echo $line;?>" class="pull-left" style="font-family: courier new;border-left: 1px dotted;"><?php echo implode("\n", $notfound['image']);?></textarea>
        <div class="clearfix"></div>
      <?php
    }
  }else{
    if(!empty($_POST['inpath']) AND !empty($_POST['deletes']))
    {
      $p = $_POST['inpath'];
      $r = explode("\n", $_POST['deletes']);
      $i = 0;
      foreach($r AS $file)
      {
        $file = $p.trim($file);
        if(is_file($file))
        {
          $i++;
          if(unlink($file))
            echo '<br />'.$i.' DELETE '.$file;
        }
      }
    }
  }
}
