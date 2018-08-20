<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$txt = file_read(_ROOT.'config.php');
$server = $username = $password = $database = '';
if (preg_match('~SERVER\'\s{0,}=>\s{0,}\'([^\']+)~s', $txt, $m))
{
	$server = $m[1];
	if (preg_match('~USERNAME\'\s{0,}=>\s{0,}\'([^\']+)~s', $txt, $m))
	{
		$username = $m[1];
		if (preg_match('~PASSWORD\'\s{0,}=>\s{0,}\'([^\']+)~s', $txt, $m))
		{
			$password = $m[1];
			if (preg_match('~DATABASE\'\s{0,}=>\s{0,}\'([^\']+)~s', $txt, $m))
			{
				$database = $m[1];
			}
		}
	}
}
$sys->stop(false);
if (!empty($username) && !empty($password))
{
	if (!empty($_POST['database1']) && !empty($_POST['database2']))
	{
		extract($_POST);
	}
	if (empty($database1))
	{
		$database1 = $database;
	}
	?>
	<form action="" method="POST" class="form" role="form">
		<div class="container-fluid">
			<div class="panel-group" id="accordion1">
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h4 class="panel-title" data-toggle="collapse" data-parent="#accordion1" href="#pea_isHideToolOn1" style="cursor: pointer;">
				    	Compare 2 Databases
				    </h4>
				  </div>
				  <div id="pea_isHideToolOn1" class="panel-collapse collapse {$display}">
				    <div class="panel-body">
							<div class="col-md-6">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" value="<?php echo $username; ?>" class="form-control" placeholder="Username">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Password</label>
									<input type="text" name="password" value="<?php echo $password; ?>" class="form-control" placeholder="Password">
								</div>
							</div>
						</div>
				  </div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label>Database 1 (goal)</label>
					<input type="text" name="database1" value="<?php echo @$database1; ?>" class="form-control" placeholder="Database 1">
				</div>
			</div>
			<div class="col-md-1">
				<h1><a href="#" onclick="return sdfsdfsd();"><?php echo icon('transfer'); ?></a></h1>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Database 2 (refinement)</label>
					<input type="text" name="database2" value="<?php echo @$database2 ?>" class="form-control" placeholder="Database 2">
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary" name="submit" value="submit">compare</button>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		function sdfsdfsd() {
			var a = $('input[name="database1"]');
			var b = $('input[name="database2"]');
			var c = a.val();
			var d = b.val();
			a.val(d);
			b.val(c);
			return false;
		};
	</script>
	<?php
	if (!empty($database2))
	{
		$err = array();
		$DB1 = new bbcSQL();
		$cc  = $DB1->PConnect($server, $username, $password, $database1);
		if (!$cc)
		{
			$err[] = 'Error while connecting to Database "'.$database1.'" on Server';
		}
		$DB2 = new bbcSQL();
		$cc  = $DB2->PConnect($server, $username, $password, $database2);
		if (!$cc)
		{
			$err[] = 'Error while connecting to Database "'.$database2.'" on Server';
		}
		if (!empty($err))
		{
			pr($err);
		}else{
			$r1  = $DB1->getCol("SHOW TABLES");
			$r2  = $DB2->getCol("SHOW TABLES");
			$SQL = array();
			$tbl = array(
				'exist' => array(), // sama2 ada
				'add'   => array(), // table di db-goal ada tp tidak ada di db-refine
				'del'   => array()	// table di db-refine ada tp tidak ada di db-goal
				);

			/* CARI TABLE YANG TIDAK ADA DI DATABASE 2 */
			foreach ($r1 as $table)
			{
				if (!in_array($table, $r2))
				{
					$tbl['add'][] = $table;
				}else{
					if (!in_array($table, $tbl['exist']))
					{
						$tbl['exist'][] = $table;
					}
				}
			}
			/* CARI TABLE YANG TIDAK ADA DI DATABASE 1 */
			foreach ($r2 as $table)
			{
				if (!in_array($table, $r1))
				{
					$tbl['del'][] = $table;
				}else{
					if (!in_array($table, $tbl['exist']))
					{
						$tbl['exist'][] = $table;
					}
				}
			}

			/* BANDINGKAN FIELD2 YANG SAMA2 ADA DI DUA DATABASE */
			foreach ($tbl['exist'] as $table)
			{
				$fields1 = $DB1->getAssoc("SHOW FULL COLUMNS FROM `{$table}`");
				$fields2 = $DB2->getAssoc("SHOW FULL COLUMNS FROM `{$table}`");
				/* SESUAIKAN SEMUA VALUE FIELD TABLE */
				foreach ($fields1 as $name => $fields)
				{
					$fields1[$name]['Null']   = ($fields1[$name]['Null'] == 'NO') ? 'NOT NULL' : '';
					$fields1[$name]['Default']= !empty($fields1[$name]['Default']) ? "DEFAULT '{$fields1[$name]['Default']}'" : '';
					$fields1[$name]['Comment']= !empty($fields1[$name]['Comment']) ? "COMMENT '{$fields1[$name]['Comment']}'" : '';
				}
				foreach ($fields2 as $name => $fields)
				{
					$fields2[$name]['Null']   = ($fields2[$name]['Null'] == 'NO') ? 'NOT NULL' : '';
					$fields2[$name]['Default']= !empty($fields2[$name]['Default']) ? "DEFAULT '{$fields2[$name]['Default']}'" : '';
					$fields2[$name]['Comment']= !empty($fields2[$name]['Comment']) ? "COMMENT '{$fields2[$name]['Comment']}'" : '';
				}
				// /* UBAH URUTAN FIELD JIKA TIDAK SAMA */
				// $col1    = array_keys($fields1);
				// $col2    = array_keys($fields2);
				// foreach ($col1 as $i => $name)
				// {
				// 	if ($name!=$col2[$i])
				// 	{
				// 		$field = $fields1[$name];
				// 		$SQL[] = "ALTER TABLE `{$table}` MODIFY COLUMN `{$name}` {$field['Type']} {$field['Null']} {$field['Default']} {$field['Extra']} {$field['Comment']}";
				// 	}
				// }
				foreach ($fields1 as $name => $field)
				{
					/* TAMBAHKAN FIELD JIKA TIDAK ADA */
					if (empty($fields2[$name]))
					{
						$SQL[] = "ALTER TABLE `{$table}` ADD `{$name}` `{$name}` {$field['Type']} {$field['Null']} {$field['Default']} {$field['Extra']} {$field['Comment']}  AFTER `{$lastname}`";
					}else
					/* UBAH FIELD JIKA TIDAK SAMA */
					if ($field != $fields2[$name])
					{
						$SQL[] = "ALTER TABLE `{$table}` CHANGE `{$name}` `{$name}` {$field['Type']} {$field['Null']} {$field['Default']} {$field['Extra']} {$field['Comment']}";
					}
					$lastname = $name;
				}
				/* HAPUS FIELD JIKA TIDAK ADA DI $fields1 */
				foreach ($fields2 as $name => $field)
				{
					if (empty($fields1[$name]))
					{
						$SQL[] = "ALTER TABLE `{$table}` DROP `{$name}`";
					}
				}
				/* MASUKKAN SEMUA INDEX FIELD */
				$index1 = $DB1->getAll("SHOW INDEX FROM `{$table}`");
				$index2 = $DB2->getAll("SHOW INDEX FROM `{$table}`");
				$indexes1 = $indexes2 = array();
				foreach ($index1 as $data)
				{
					if (empty($indexes1[$data['Key_name']]))
					{
						$dt = array(
							'unique' => $data['Non_unique'] ? '' : 'UNIQUE',
							'type'   => $data['Index_type'],
							'fields' => array()
							);
						$dt['fields'][] = $data['Column_name'];
						$indexes1[$data['Key_name']] = $dt;
					}else{
						$indexes1[$data['Key_name']]['fields'][] = $data['Column_name'];
					}
				}
				foreach ($index2 as $data)
				{
					if (empty($indexes2[$data['Key_name']]))
					{
						$dt = array(
							'unique' => $data['Non_unique'] ? '' : 'UNIQUE',
							'type'   => $data['Index_type'],
							'fields' => array()
							);
						$dt['fields'][] = $data['Column_name'];
						$indexes2[$data['Key_name']] = $dt;
					}else{
						$indexes2[$data['Key_name']]['fields'][] = $data['Column_name'];
					}				}
				// HAPUS YANG TIDAK ADA DI DATABASE 1
				foreach ($indexes2 as $key => $data)
				{
					if (empty($indexes1[$key]))
					{
						$SQL[] = "ALTER TABLE `{$table}` DROP INDEX `{$key}`";
					}
				}
				// EDIT JIKA DI DATABASE 1 DAN 2 ADA PERBEDAAN
				foreach ($indexes2 as $key => $data)
				{
					if (!empty($indexes1[$key]) && $indexes1[$key]!=$data)
					{
						$SQL[] = "ALTER TABLE `{$table}` DROP INDEX `{$key}`";
						unset($indexes2[$key]);
					}
				}
				// TAMBAHKAN JIKA TIDAK ADA DI DATABASE 2
				foreach ($indexes1 as $key => $data)
				{
					if (empty($indexes2[$key]))
					{
						$fields = "(`".implode('`, `', $data['fields'])."`)";
						switch ($key)
						{
							case 'PRIMARY':
								$SQL[] = "ALTER TABLE `{$table}` PRIMARY KEY {$fields}";
								break;
							default:
								switch ($data['type'])
								{
									case 'FULLTEXT':
										$SQL[] = "ALTER TABLE `{$table}` ADD FULLTEXT INDEX {$fields}";
										break;
									default:
										$SQL[] = "ALTER TABLE `{$table}` ADD {$data['unique']} INDEX {$fields}";
										break;
								}
								break;
						}
					}
				}
				if (!empty($SQL) && end($SQL) != '')
				{
					$SQL[] = '';
				}
			}
			/* HAPUS TABLE YANG TIDAK ADA DI DATABASE 1 */
			foreach ($tbl['del'] as $table)
			{
				$SQL[] = "DROP TABLE `{$table}`";
			}

			if (!empty($SQL) && end($SQL) != '')
			{
				$SQL[] = '';
			}

			/* TAMBAHKAN TABLE YANG YANG TIDAK ADA DI DATABASE 2 */
			foreach ($tbl['add'] as $table)
			{
				$data  = $DB1->getAssoc("SHOW CREATE TABLE `{$table}`");
				$SQL[] = preg_replace(["~\n~s", '~\s+AUTO_INCREMENT=[0-9]+~'], ['\n', ''], $data[$table]);
				$SQL[] = '';
			}


			/* TAMPILKAN HASIL */
			if (!empty($SQL))
			{
				$SQL = array_map('dbsync', $SQL);
				?>
				<div class="container-fluid">
					<br class="clearfix" />
					<div class="form-group">
						<textarea class="form-control" style="min-height: 350px;" onclick="this.select();">SET foreign_key_checks = 0;<?php echo "\n\n".implode("\n", $SQL); ?>SET foreign_key_checks = 1;</textarea>
					</div>
				</div>
				<?php
			}else{
				echo '<div class="container-fluid">'.msg('Tidak ada perbedaan struktur dari ke database `'.$database1.'` dan `'.$database2.'`', 'success').'</div>';
			}
		}
	}
}
function dbsync($a)
{
	$a = preg_replace('~\s{2,}~', ' ', $a);
	$a = str_replace('\n', "\n", $a);
	$a = trim($a);
	$a.= !empty($a) ? ';' : '';

	return $a;
}
