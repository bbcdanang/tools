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
// $sys->stop(false);
if (!empty($username) && !empty($password))
{
	if (!empty($_POST['database1']) && !empty($_POST['database2']))
	{
		extract($_POST);
		$_SESSION['database1'] = $database1;
		$_SESSION['database2'] = $database2;
	}
	if (empty($database1))
	{
		$database1 = !empty($_SESSION['database1']) ? $_SESSION['database1'] : $database;
	}
	if (empty($_POST))
	{
		$sys->stop(false);
		$dbs = $db->getCol("SHOW DATABASES");
		$exc = array('information_schema', 'performance_schema', 'mysql');
		foreach ($dbs as $i => $d)
		{
			if (in_array($d, $exc))
			{
				unset($dbs[$i]);
			}
		}
		$dbs = array_values($dbs);
		?>
		<form action="" method="POST" class="form" role="form" id="input_form">
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
						<select name="database1" id="database1" class="form-control"><?php echo createOption($dbs, $database1); ?></select>
					</div>
				</div>
				<div class="col-md-1">
					<h1><a href="#" id="input_reverse"><?php echo icon('transfer'); ?></a></h1>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Database 2 (refinement)</label>
						<select name="database2" id="database2" class="form-control"><?php echo createOption($dbs, @$_SESSION['database2']); ?></select>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-12">
					<button type="submit" class="btn btn-primary" name="submit" value="submit">compare</button>
				</div>
			</div>
		</form>
		<div class="container-fluid">
			<br class="clearfix" />
			<div id="output_msg"></div>
			<div class="form-group">
				<textarea class="form-control" style="min-height: 350px;" onclick="this.select();" id="output_query"></textarea>
			</div>
		</div>
		<script type="text/javascript">
			_Bbc(function($){
				$( document ).ajaxStart(function() {
					$("#loading").show();
					$("#output_msg").html('');
					$("#output_query").val('');
				}).ajaxStop(function() {
					$("#loading").hide();
				});
				$("#input_reverse").on("click", function(e){
					e.preventDefault();
					var a = $('#database1');
					var b = $('#database2');
					var c = a.val();
					var d = b.val();
					a.val(d).trigger("change");
					b.val(c).trigger("change");
					return false;
				});
				$("input, select, button", $("#input_form")).on("keyup change", function(e){
					$("#output_msg").html('');
					$("#output_query").val('');
				});
				$("#input_form").on("submit", function(e){
					e.preventDefault();
					var x = document.location.href;
					x += x.indexOf("?") >= 0 ? "&" : "?";
					x += "is_ajax=1";
					$.ajax({
						url: x,
						method:"POST",
						data:$(this).serialize(),
						global:true,
						dataType:"json",
						success: function(a){
							var b = '';
							var c = '';
							if (a.ok) {
								if (a.message) {
									b = '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" title="success"></span> '+a.message+'</div>';
								}
								if (a.result) {
									c = a.result;
								}
							}else{
								b = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-minus-sign" title="failed"></span> '+a.message+'</div>';
							}
							$("#output_msg").html(b);
							$("#output_query").val(c);
						}
					});
				});
			});
		</script>
		<div id="loading">Loading...</div>
		<?php
	}
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
			$output = array(
				'ok'      => 0,
				'message' => implode(' AND ', $err),
				'result'  => ''
				);
		}else{
			$r1  = $DB1->getCol("SHOW TABLES");
			$r2  = $DB2->getCol("SHOW TABLES");
			$SQL = $SQL1 = $SQL2 = $SQL3 = array(); // 1 = DROP, 2 = CREATE, 3 = ALTER
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
					$fields1[$name]['Null']    = ($fields1[$name]['Null'] == 'NO') ? 'NOT NULL' : '';
					$fields1[$name]['Comment'] = !empty($fields1[$name]['Comment']) ? "COMMENT '{$fields1[$name]['Comment']}'" : '';
					// JIKA DEFAULT VALUE BERUPA FUNCTION MAKA TIDAK PERLU DIKASIH TANDA PETIK
					if (!empty($fields1[$name]['Default']) && preg_match('~^([A-Z_]+)$~s', $fields1[$name]['Default']))
					{
						$fields1[$name]['Default'] = "DEFAULT {$fields1[$name]['Default']}";
					}else{
						$fields1[$name]['Default']= !empty($fields1[$name]['Default']) ? "DEFAULT '{$fields1[$name]['Default']}'" : '';
					}
				}
				foreach ($fields2 as $name => $fields)
				{
					$fields2[$name]['Null']    = ($fields2[$name]['Null'] == 'NO') ? 'NOT NULL' : '';
					$fields2[$name]['Comment'] = !empty($fields2[$name]['Comment']) ? "COMMENT '{$fields2[$name]['Comment']}'" : '';
					// JIKA DEFAULT VALUE BERUPA FUNCTION MAKA TIDAK PERLU DIKASIH TANDA PETIK
					if (!empty($fields2[$name]['Default']) && preg_match('~^([A-Z_]+)$~s', $fields2[$name]['Default']))
					{
						$fields2[$name]['Default'] = "DEFAULT {$fields2[$name]['Default']}";
					}else{
						$fields2[$name]['Default']= !empty($fields2[$name]['Default']) ? "DEFAULT '{$fields2[$name]['Default']}'" : '';
					}
				}
				// /* UBAH URUTAN FIELD JIKA TIDAK SAMA */
				// $col1    = array_keys($fields1);
				// $col2    = array_keys($fields2);
				// foreach ($col1 as $i => $name)
				// {
				// 	if ($name!=$col2[$i])
				// 	{
				// 		$field = $fields1[$name];
				// 		$SQL3[] = "ALTER TABLE `{$table}` MODIFY COLUMN `{$name}` {$field['Type']} {$field['Null']} {$field['Default']} {$field['Extra']} {$field['Comment']}";
				// 	}
				// }
				foreach ($fields1 as $name => $field)
				{
					/* TAMBAHKAN FIELD JIKA TIDAK ADA */
					if (empty($fields2[$name]))
					{
						$SQL3[] = "ALTER TABLE `{$table}` ADD `{$name}` {$field['Type']} {$field['Null']} {$field['Default']} {$field['Extra']} {$field['Comment']}  AFTER `{$lastname}`";
					}else
					/* UBAH FIELD JIKA TIDAK SAMA */
					if ($field != $fields2[$name])
					{
						$SQL3[] = "ALTER TABLE `{$table}` CHANGE `{$name}` `{$name}` {$field['Type']} {$field['Null']} {$field['Default']} {$field['Extra']} {$field['Comment']}";
					}
					$lastname = $name;
				}
				/* HAPUS FIELD JIKA TIDAK ADA DI $fields1 */
				foreach ($fields2 as $name => $field)
				{
					if (empty($fields1[$name]))
					{
						$SQL3[] = "ALTER TABLE `{$table}` DROP `{$name}`";
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
				/* HAPUS YANG TIDAK ADA DI DATABASE 1 */
				foreach ($indexes2 as $key => $data)
				{
					if (empty($indexes1[$key]))
					{
						$SQL3[] = "ALTER TABLE `{$table}` DROP INDEX `{$key}`";
					}
				}
				/* EDIT JIKA DI DATABASE 1 DAN 2 ADA PERBEDAAN */
				foreach ($indexes2 as $key => $data)
				{
					if (!empty($indexes1[$key]) && $indexes1[$key]!=$data)
					{
						$SQL3[] = "ALTER TABLE `{$table}` DROP INDEX `{$key}`";
						unset($indexes2[$key]);
					}
				}
				/* TAMBAHKAN JIKA TIDAK ADA DI DATABASE 2 */
				foreach ($indexes1 as $key => $data)
				{
					if (empty($indexes2[$key]))
					{
						$fields = "(`".implode('`, `', $data['fields'])."`)";
						switch ($key)
						{
							case 'PRIMARY':
								$SQL3[] = "ALTER TABLE `{$table}` PRIMARY KEY {$fields}";
								break;
							default:
								switch ($data['type'])
								{
									case 'FULLTEXT':
										$SQL3[] = "ALTER TABLE `{$table}` ADD FULLTEXT INDEX {$fields}";
										break;
									default:
										$SQL3[] = "ALTER TABLE `{$table}` ADD {$data['unique']} INDEX {$fields}";
										break;
								}
								break;
						}
					}
				}
			}

			/* MASUKKAN SEMUA CONSTRAINT RELATION TABLE */
			$index1 = $index2 = array();

			$r = $DB1->getAll("SELECT * FROM `INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE` WHERE `CONSTRAINT_SCHEMA`=SCHEMA() AND `REFERENCED_TABLE_NAME` IS NOT NULL");
			foreach ($r as $d)
			{
				$index1[$d['TABLE_NAME']][$d['CONSTRAINT_NAME']] = $d;
			}
			$r = $DB2->getAll("SELECT * FROM `INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE` WHERE `CONSTRAINT_SCHEMA`=SCHEMA() AND `REFERENCED_TABLE_NAME` IS NOT NULL");
			foreach ($r as $d)
			{
				$index2[$d['TABLE_NAME']][$d['CONSTRAINT_NAME']] = $d;
			}
			if ($index1 != $index2)
			{
				/* HAPUS CONSTRAINT YANG ADA DI DATABASE 2 JIKA DI DATABASE 1 TIDAK DITEMUKAN*/
				foreach ($index2 as $table => $fields)
				{
					// Jika table yang dihapus index nya tidak masuk dalam daftar table yang dihapus
					// krn jika termasuk dalam table delete, table tersebut toh nantinya akan terhapus beserta relation schema nya
					if (!in_array($table, $tbl['del']))
					{
						foreach ($fields as $field => $d)
						{
							if (empty($index1[$table][$field]))
							{
								$SQL3[] = "ALTER TABLE `{$table}` DROP FOREIGN KEY `{$d['CONSTRAINT_NAME']}`";
							}
						}
					}
				}
				/* MASUKKAN CONSTRAINT KE DATABASE 2 JIKA ADA DI DATABASE 1 TAPI TIDAK DITEMUKAN DI DATABASE 2 */
				foreach ($index1 as $table => $fields)
				{
					// Jika table yang akan ditambahkan relation tidak masuk ke dalam table yang di create
					// krn jika termasuk table create, maka relation tsb sudah masuk dalam query create table beserta relation schema nya
					if (!in_array($table, $tbl['add']))
					{
						foreach ($fields as $field => $d)
						{
							if (empty($index2[$table][$field]))
							{
								$DEL  = 'CASCADE';
								$UPT  = 'CASCADE';
								$data = $DB1->getRow("SELECT * FROM `INFORMATION_SCHEMA`.`REFERENTIAL_CONSTRAINTS` WHERE `CONSTRAINT_SCHEMA`=SCHEMA() AND `CONSTRAINT_NAME`='{$d['CONSTRAINT_NAME']}'");
								if (!empty($data['DELETE_RULE']))
								{
									$DEL = $data['DELETE_RULE'];
									$UPT = $data['UPDATE_RULE'];
								}
								$SQL3[] = "ALTER TABLE `{$table}` ADD CONSTRAINT `{$d['CONSTRAINT_NAME']}` FOREIGN KEY (`{$d['COLUMN_NAME']}`) REFERENCES `{$d['REFERENCED_TABLE_NAME']}` (`{$d['REFERENCED_COLUMN_NAME']}`) ON DELETE {$DEL} ON UPDATE {$UPT}";
							}
						}
					}
				}
			}
			/* MASUKKAN SEMUA TRIGGERS */
			$index1 = $index2 = array();

			$r = $DB1->getAll("SELECT * FROM `INFORMATION_SCHEMA`.`TRIGGERS` WHERE `TRIGGER_SCHEMA`=SCHEMA()");
			foreach ($r as $d)
			{
				$index1[$d['EVENT_OBJECT_TABLE']][$d['TRIGGER_NAME']] = $d;
			}
			$r = $DB2->getAll("SELECT * FROM `INFORMATION_SCHEMA`.`TRIGGERS` WHERE `TRIGGER_SCHEMA`=SCHEMA()");
			foreach ($r as $d)
			{
				$index2[$d['EVENT_OBJECT_TABLE']][$d['TRIGGER_NAME']] = $d;
			}
			if ($index1 != $index2)
			{
				/* HAPUS TRIGGERS YANG ADA DI DATABASE 2 JIKA DI DATABASE 1 TIDAK DITEMUKAN*/
				foreach ($index2 as $table => $triggers)
				{
					// Jika table yang dihapus trigger nya tidak masuk dalam daftar table yang dihapus
					// krn jika termasuk dalam table delete, table tersebut toh nantinya akan terhapus beserta trigger nya
					if (!in_array($table, $tbl['del']))
					{
						foreach ($triggers as $trigger => $d)
						{
							if (empty($index1[$table][$trigger]))
							{
								$SQL3[] = "DROP TRIGGER `{$trigger}`";
							}
						}
					}
				}
				/* MASUKKAN TRIGGERS KE DATABASE 2 JIKA ADA DI DATABASE 1 TAPI TIDAK DITEMUKAN DI DATABASE 2 */
				$SQL4 = array();
				foreach ($index1 as $table => $triggers)
				{
					foreach ($triggers as $trigger => $d)
					{
						if (empty($index2[$table][$trigger]))
						{
							$SQL4[] = "CREATE TRIGGER `{$trigger}` {$d['ACTION_TIMING']} {$d['EVENT_MANIPULATION']} ON `{$table}` FOR EACH {$d['ACTION_ORIENTATION']} {$d['ACTION_STATEMENT']};;";
						}
					}
				}
			}
			if (!empty($SQL4))
			{
				$SQL3[] = "DELIMITER ;;";
				$SQL3[] = implode('\n', $SQL4);
				$SQL3[] = "DELIMITER ;";
			}
			/* HAPUS TABLE YANG TIDAK ADA DI DATABASE 1 */
			foreach ($tbl['del'] as $table)
			{
				$SQL1[] = "DROP TABLE `{$table}`";
			}

			/* TAMBAHKAN TABLE YANG YANG TIDAK ADA DI DATABASE 2 */
			foreach ($tbl['add'] as $table)
			{
				$data  = $DB1->getAssoc("SHOW CREATE TABLE `{$table}`");
				$SQL2[] = preg_replace(["~\n~s", '~\s+AUTO_INCREMENT=[0-9]+~'], ['\n', ''], $data[$table]);
			}

			if (!empty($SQL1))
			{
				$SQL = array_merge($SQL, array(''), $SQL1);
			}
			if (!empty($SQL2))
			{
				$SQL = array_merge($SQL, array(''), $SQL2);
			}
			if (!empty($SQL3))
			{
				$SQL = array_merge($SQL, array(''), $SQL3);
			}

			/* TAMPILKAN HASIL */
			$output = array(
				'ok'      => 1,
				'message' => '',
				'result'  => ''
				);
			if (!empty($SQL))
			{
				$SQL = array_map('dbsync', $SQL);
				$output['result'] = 'SET foreign_key_checks = 0;'."\n".implode("\n", $SQL)."\n\n".'SET foreign_key_checks = 1;';
			}else{
				$output['message'] = 'Tidak ada perbedaan struktur dari ke database `'.$database1.'` dan `'.$database2.'`';
			}
		}
		output_json($output);
	}
}
function dbsync($a)
{
	$a = preg_replace('~\s{2,}~', ' ', $a);
	$a = str_replace('\n', "\n", $a);
	$a = trim($a);
	if (!empty($a))
	{
		$a .= (substr($a, -1) != ';') ? ';' : '';
	}
	return $a;
}
