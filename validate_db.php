<?php
$error_text = "";
function get_database_struct($host, $database, $user, $pass){
  global $error_text;

  //connection to the database
  $conn = mysql_connect($host, $user, $pass);
  if(!$conn){
    $error_text = 'cannot connect to the database: '.mysql_error();
    return false;
  }

  //select the database
  if(!mysql_select_db($database, $conn)){
    $error_text = 'cannot select database: ' . mysql_error();
    return false;
  }


  $loop = mysql_query("SHOW tables FROM $database");
  if(!$loop){
    $error_text = 'cannot select tables';
    return false;
  }

  $tables = array();
  $columns = array();

  while($table = mysql_fetch_array($loop))
  {
    $tables[] = $table[0];

    $row = mysql_query("SHOW columns FROM ".$table[0]);
    if(!$row){
      $error_text = 'cannot select table fields';
      return false;
    }

    while ($col = mysql_fetch_array($row))
    {
      $columns[$table[0]][] = $col[0];
    }
  }

  return array("tables" => $tables, "columns" => $columns);
}

/*
$struct_dev = get_database_struct("localhost", "dev_insurancetruck", "dev"             , "HK2LxSQjZBqxYcKK");
$struct_pro = get_database_struct("localhost", "insurancetruck"    , "insurancetruck_u", "bMFKPLQpAZdBL4xy");
*/

$struct_dev = get_database_struct("localhost", "avega_dveri", "root", "SuperPassword");
$struct_pro = get_database_struct("localhost", "maxilux_site", "root", "SuperPassword");

echo "validate tables:";
for($i=0;$i<count($struct_dev['tables']);$i++){
  $status = "<span style='color:red;'>error</span>";
  if(in_array($struct_dev['tables'][$i], $struct_pro['tables'])){$status = "on";}

  echo "{$struct_dev['tables'][$i]} - {$status} <br />";

  for($x=0;$x<count($struct_dev['columns'][$struct_dev['tables'][$i]]);$x++){
    $status = 0;
    if(in_array($struct_dev['columns'][$struct_dev['tables'][$i]][$x], $struct_pro['columns'][$struct_dev['tables'][$i]])){$status = 1;}
    if($status == 0){
      echo "<span style='color:red;'> - {$struct_dev['columns'][$struct_dev['tables'][$i]][$x]}</span><br />";
    }
  }
}
?>