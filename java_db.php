<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$sys->stop(false);
link_js(_URL.'includes/lib/pea/includes/formIsRequire.js');
?>
<form action="" method="POST" role="form" class="formIsRequire">
	<legend>Create JAVA Class for SQLite</legend>
	<div class="form-group">
		<label for="">Class Name & Package</label>
		<div class="form-inline">
			<input type="text" class="form-control input-group" name="class" value="<?php echo @$_POST['class']; ?>" placeholder="Class Name" req="any">
			<input type="text" class="form-control input-group" name="package" value="<?php echo @$_POST['package']; ?>" placeholder="Package Name">
		</div>
	</div>
	<div class="form-group">
		<label for="">Fields Name / tablename of your database</label>
		<textarea name="fields" class="form-control" placeholder="Fields Name (comma delimiter) or just insert your table name in MySQL" req="any"><?php echo @$_POST['fields']; ?></textarea>
	</div>
	<!-- <div class="form-group">
		<label for="">Table Name (in JAVA Class)</label>
		<input type="text" class="form-control" name="table" value="<?php echo @$_POST['table']; ?>" placeholder="Table Name">
		<div class="help-block">Leave it blank if it is the same as Class Name</div>
	</div> -->
	<button type="submit" name="submit" value="submit" class="btn btn-primary">Create Class</button>
</form>
<?php
if (!empty($_POST['submit']))
{
	if (!empty($_POST['class']) && !empty($_POST['fields']))
	{
		$class  = ucwords(trim($_POST['class']));
		$table  = !empty($_POST['table']) ? strtolower(trim($_POST['table'])) : strtolower($class);
		$fields = array_map('trim', explode(',', $_POST['fields']));
		$types  = array();

		if (count($fields) == 1)
		{
			$r_field = $db->getAll("SHOW FIELDS FROM ".$fields[0]);
			$fields  = array();
			$r_type  = array(
				'int'  => 'INTEGER',
				'text' => 'TEXT'
				);
			foreach ($r_field as $field)
			{
				$type     = 'VARCHAR';
				foreach ($r_type as $my_type => $lite_type)
				{
					if (preg_match('~'.$my_type.'~is', $field['Type']))
					{
						$type = $lite_type;
						break;
					}
				}
				if (preg_match('~pri~is', $field['Key']))
				{
					$type .= ' PRIMARY KEY';
				}
				if (preg_match('~auto_increment~is', $field['Extra']))
				{
					$type .= ' AUTOINCREMENT';
				}
				if (preg_match('~no~is', $field['Null']))
				{
					$type .= ' NOT NULL';
				}
				if (!empty($field['Default']) || $field['Default']=='0')
				{
					if (preg_match('~^([0-9]+)$~is', $field['Default'], $m))
					{
						$type .= ' DEFAULT('.$m[1].')';
					}else{
						$type .= ' DEFAULT(\''.$field['Default'].'\')';
					}
				}
				$fields[] = $field['Field'];
				$types[]  = $type;
			}
		}
		$colums = implode(', ', $fields);
		$vars   = '';
		$args   = '';
		$vals   = '';
		$sqls   = '';
		foreach ($fields as $i => $field)
		{
			$vars .= "\n\t".'public static final String '.$field.' = "'.$field.'";';
    	$sqls .= ' +'."\n\t\t\t"; if ($i)
			{
				$args .= 'String _'.$field.', ';
				$vals .= "\n\t\t".'cv.put('.$field.', _'.$field.');';
			}
      if (!empty($types[$i]))
      {
      	$type = $types[$i];
      }else{
	    	if ($i)
	    	{
	      	$type = preg_match('~(_id|status|active)$~is', $field) ? 'INTEGER' : 'VARCHAR';
	    	}else{
	    		$type = 'INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL';
	    	}
      }
  		$sqls .= "\"'\" + {$field} + \"' {$type},\"";
		}
		$args = trim(trim($args), ',');
		$sqls = preg_replace('~(,")$~s', '" + ', $sqls);
		$pkg  = !empty($_POST['package']) ? 'package '.$_POST['package'].';'."\n" : '';
		$txt  = $pkg.'
import android.content.ContentValues;
import android.content.Context;
import android.database.sqlite.SQLiteDatabase;

import net.fisip.master.db.Helper;

/**
 * Created by danang on '.date('n/j/y').'.
 */
public class '.$class.' extends Helper {

	private static final int DB_VERSION = 1;
	public static final String table = "'.$table.'";'.$vars.'

	public '.$class.'(Context context) {
		super(context, table, null, DB_VERSION);
	}

	public String[] getColumn() {
		return new String[]{'.$colums.'};
	}

	public boolean Insert('.$args.') {
		ContentValues cv = new ContentValues();'.$vals.'
		return Insert(cv);
	}

	@Override
	public void onCreate(SQLiteDatabase db) {
		db.execSQL(sql());
	}
	@Override
	public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
		db.execSQL("DROP TABLE IF EXISTS \'" + table + "\'");
		db.execSQL(sql());
	}
	@Override
	public String sql() {
		return "CREATE TABLE \'" + table + "\' ("'.$sqls.'
			")";
	}
}
';
		$rows = count(explode("\n", $txt));
		?>
		<div class="form-group">
			<textarea class="form-control" onclick="this.select();" rows="<?php echo $rows;?>"><?php echo $txt; ?></textarea>
		</div>
		<?php
	}else{
		echo msg('please Insert Class Name and Fields Name', 'danger');
	}
}
