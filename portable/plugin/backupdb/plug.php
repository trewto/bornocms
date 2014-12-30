<?php
	/*
	 *	Plugin Name : Backup DB
	 *	This is the backup page 
	 *	user can get backup of this site
	 *
	 */
function abcde(){	 
	 ob_start();
	if(user_can('back_up')){
		$output  = '<h2>Backup Your Database</h2><hr>';
		$output .='<a class="btn btn-primary" href="?pages=back_up&get=true&type=direct">Download The  Database Backup OF Your Site</a>';
		$output .='<p><small>Click the buttom to download the site database</small></p>';
		
		$output .= 'You can generate your full database . All table and all field with data';
		
		//echo '<a class="btn btn-primary" href="?pages=backup&get=true&type=save">Download The  Database Backup OF Your Site</a>';
		if(isset($_GET['get']) & isset($_GET['type']) ){
			if($_GET['get']=='true' and $_GET['type']=='direct'){
			
				/*
				 *
				 *
				 *	The Backup Script
				 *
				 *
				 */
				 global $dbconnect;
				define('HOST',		$dbconnect['DBHOST']);		// Host name
				define('USERNAME',	$dbconnect['DBUSER']);		// User name
				define('PASSWORD',	$dbconnect['DBPASS']);		// Password
				define('DATABASE',	$dbconnect['DBNAME']);			// DB Name
				define('PATH',		'./');		// Backup Directory
				class DBBackup
				{
				  private $con;
				  private $tables = array();
				  private $path;

				  function __construct($host = null, $username = null, $password = null, $database = null)
				  {
					/*
						Connect and select MySQL DB
					*/
					if( is_null($host) || is_null($username) || is_null($password) || is_null($database) ) throw new Exception("The host, username, password and database name arguments must be specified!");
					if( ! $this->con = @mysql_connect($host, $username, $password) ) throw new Exception("Could not connect MySQL server {$username}@{$host}");
					if( ! @mysql_select_db($database, $this->con) )throw new Exception("Could not select database: {$database}");
				  }


				  public function table( $table = 'all' )
				  {
					/*
						Get defined tables
					*/
					if( is_array( $table )){
					  // Cheque table validity
					  foreach($table as $t){
						if(in_array($t , $this->getAllTables())){
						  $this->tables[] = $t;
						}
						else{
						  throw new Exception("Table `{$t}` not exists in the DB");
						}
					  }
					}
					elseif( $table == 'all' ){
						$this->tables = $this->getAllTables();
					}
					else{
						throw new Exception("Please enter tables name as array");
					}
				  }

				  public function path($path = '')
				  { 
					/*
					Set upload path
					*/
					$this->path = $path;
				  }

				  public function backUp()
				  {
					/*
					Done backup
					*/
					$return = '';
					foreach($this->tables as $table){
						$return .= $this->tableStracture($table);
						
						foreach ($this->recode($table) as $result) {
							$return .= $result;
						}
					}
					ob_end_flush();
					ob_end_clean();
					//$this->writeToFile($return);
					header("Content-type: application/sql");
					header("Content-Disposition: attachment; filename= ".date('Y-m-d-H-i').".sql");
					header("Pragma: no-cache");
					header("Expires: 0");
					echo "
					
					--
					-- This is the database backup of Borno CMS
					-- 
					-- --------------------------------------------------
					-- ---------------------------------------------------

					";
					echo $return;

					exit; 
					
				//	echo $return;
				 //   print_r($return);
					return true;
				  }

				  private function getAllTables()
				  {
					/*
					Get tables list name from DB
					*/
					$sql = mysql_query("SHOW TABLES");
					while ($row = mysql_fetch_row($sql) )
					{
					  foreach ($row as $key => $value)
					  {
						$table[]  = $value;
					  }
					}
					return $table;
				  }

				  private function tableStracture($table)
				  {
					/*
					Get table stracture
					*/
					$return = "\nDROP TABLE IF EXISTS `{$table}`;\n\n";
					$row = ( mysql_fetch_row(mysql_query("SHOW CREATE TABLE {$table}")) );
					$return .= $row[1].";\n\n";
					return $return;
				  }

				  private function recode($table)
				  {
					/*
					Get data recodes
					*/
					$query = mysql_query("SELECT * FROM {$table} LIMIT 0, 1000");
					$num_fields = mysql_num_fields($query);
					$num_rows = mysql_num_rows($query);
					$results = array();
					if ($num_rows){
						
						while($row = mysql_fetch_row($query))
						{
							$return = "INSERT INTO {$table} VALUES(";
							for($i=0; $i<$num_fields; $i++) 
							{
						  $row[$i] = addslashes($row[$i]);
						  $row[$i] = str_replace("\n","\\n",$row[$i]);
						  $row[$i] = str_replace("\r","\\r",$row[$i]);

								$return .= ( isset($row[$i]) ) ? "'{$row[$i]}'" : "''";
								if ($i<($num_fields-1)) { $return.= ','; }
							}
							$return.= ");\n";
							$results[] = $return;
						}

					}
					return $results;
				  }

				  private function writeToFile($str)
				  {
					/*
					Write down backup file
					*/
					$path = (isset($this->path))? $this->path : '';
					$backupPath = $path . date('Y-m-d-H-i').'_'.md5(uniqid()).'.sql';
					if( ! $handle = @fopen( $backupPath ,'w+') ) throw new Exception("Could not save backup file at {$backupPath}");  
					fwrite($handle, $str);
					fclose($handle);
				  }

				  public function close()
				  {
					/*
					Close MySQL connection
					*/
					mysql_close($this->con);
				  }
				}
				ob_end_flush();
				try {
					$db = new DBBackup(HOST, USERNAME, PASSWORD, DATABASE);
					$db->table();
					$db->path(PATH);
					$db->backUp();
					$db->close();
					echo "Done!";
				} catch (Exception $e) {
					die($e->getMessage());
				}
				 
				 
				 /*
				  *	The backup script end
				  */
				  
		
			
			
			}
		}
	}
	else{
		return	('You can not visit this page');
	}
		return $output;
}
//abcde()
add_page('back_up','Back up' , 'abcde','back_up');
	