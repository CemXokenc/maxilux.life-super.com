<?php
 $db = '';
 $connect_info = array();
 class Query
 {
   var $sql = '';

   function Clear(){
      $this->sql = '';
   }

   function Add($sql){
      $this->sql = $this->sql.$sql;
   }

   function getQuery(){            return $this->sql;   }

   function setQuery($query){            $this->Clear();
            $this->Add($query);   }
   function setStringValue($key,$value){            $value = mysql_escape_string($value);            $this->setQuery(str_replace(":".$key,"'".$value."'",$this->getQuery()));
   }
   function setIntValue($key,$value){            $value = intval($value);
            $this->setQuery(str_replace(":".$key,$value,$this->getQuery()));   }
   function setFloatValue($key,$value){
     $value = floatval($value);
            $this->setQuery(str_replace(":".$key,$value,$this->getQuery()));
   }
 }
 if(!defined('__DBTYPE__'))
   define('__DBTYPE__','mysql');

 class MysqlDB{
   var $con       = null;
   var $query     = null;
   var $res       = null;
   var $results   = null;
   var $bOpen     = false;
   var $insert_id = 0;

   function __construct($host='localhost',$user='root',$pwd='root'){            if(__DBTYPE__ == 'mysql'){
     //global $db;
     global $connect_info;

     $db = "";
     for($i=0;$i<count($connect_info);$i++){
       if($connect_info[$i]["host"] == $host
           && $connect_info[$i]["user"] == $user
           && $connect_info[$i]["pass"] == $pwd){
         $db = $connect_info[$i]['db_conn'];
       }
     }

     if($db === '') {
       $db = mysql_connect ($host,$user,$pwd);
       $connect_info[] = array("host"=>$host,"user"=>$user,"pass"=>$pwd,"db_conn"=>$db);
     }

     $this->con = $db;

     if(!$this->con)
       throw new Exception('Connection error!');
     }else{
       $this->bOpen = false;
     }

     $this->query = new Query();
   }

   function OpenDB($db_name){
     if(__DBTYPE__ == 'mysql'){
       if(!$this->con)
         throw new Exception('connection failed');

       $bres = mysql_select_db($db_name,$this->con);

       $err = mysql_error();

       if($bres == false)
         throw new Exception("can't open database".$err);
     }else{       $this->con = sqlite_open($db_name);

       $err = sqlite_error_string(sqlite_last_error($this->con));

       if($this->con == false)
         throw new Exception("can't open database".$err);
     }
     $this->bOpen = true;
   }

   function isOpenDB(){

     return $this->bOpen;

   }

   function ExecuteSQL(){
     if(__DBTYPE__ == 'mysql'){
       $this->res = mysql_query($this->query->sql,$this->con);

       $err = mysql_error();

       if($err != '')
         throw new Exception('Execute script error! :'.$err);
     }else{       $this->res = sqlite_query( $this->query->sql,$this->con);

       if($this->res === FALSE)
         throw new Exception('Execute script error! :'.sqlite_error_string(sqlite_last_error($this->con)));     }
   }

   function InsertId(){            if(__DBTYPE__ == 'mysql'){              return mysql_insert_id($this->con);
            }else{
              return sqlite_last_insert_rowid($this->con);
            }
   }

   function RowsCount(){
             if($this->res == null)
               throw new Exception('not valid result');
      if(__DBTYPE__ == 'mysql'){              return mysql_num_rows($this->res);      }else{
        return sqlite_num_rows($this->res);
      }

   }

   function Close(){
            $this->res = null;
   }

   function GetFieldValue($row,$field_num){
             return $this->results[$row]["{$field_num}"];
   }
   function FetchAll(){
      unset($this->results);
             $this->results = array();
      if(__DBTYPE__ == 'mysql'){
               while($r = mysql_fetch_array($this->res)){
                       $this->results[] = $r;
        }
      }else{              while($r = sqlite_fetch_array($this->res)){
                       $this->results[] = $r;
        }      }
   }
   function Free(){
             unset($this->results);
   }
 }
?>
