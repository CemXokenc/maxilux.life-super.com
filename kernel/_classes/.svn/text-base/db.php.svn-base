<?php
 if(!defined('debug_mode')){
   define('debug_mode','0');
 }
 /* universal database class */
 $table_columns = array();
 function register_column($name,$key){
   global $table_columns;
   $num = count($table_columns);
   $table_columns[$num]['name'] = $name;
   $table_columns[$num]['key']  = $key;
 }
 class db_ext{
   private $error = '';
   /*
      - fields - array with list of fields for select
        fields[$i]['name']     - name of column
        fields[$i]['new_name'] - name of column in select result
      - criteria - array for where
        $criteria[$i]['name']  - name of column
        $criteria[$i]['type']  - type of column
        $criteria[$i]['value'] - column value
   */
   public function execute_query($query_type,$query, $criteria,$fields, $option='disabled'){   	
     $tables_list = get_alternative_db_list();

   	 $db_host = db_host;
     $db_user = db_user;
     $db_pass = db_pass;
     $db_name = db_name;

     foreach($tables_list as $table=>$settings){      
       $pos1 = strpos($query," ".$table." ");
       $pos2 = strpos($query," ".$table.",");
       $pos3 = strpos($query,",".$table.",");
       $pos4 = strpos($query,",".$table." ");
       $pos5 = strpos($query," ".$table."(");
       $pos6 = strpos($query,"`".$table."`");
       if($pos1>0 || $pos2>0 || $pos3>0 || $pos4>0 || $pos5>0 || $pos6>0){       	
         $db_host = $settings['db_host'];
       	 $db_user = $settings['user_name'];
       	 $db_pass = $settings['user_pass'];
       	 $db_name = $settings['db_name'];
       }    
     }
     

   	 $list_where   = "";

   	 try{
       $db = new MysqlDB($db_host,$db_user,$db_pass);
       $db->OpenDB($db_name);

       $systemdb_lang = "utf8";
       if(isset($_SESSION['systemdb_lang']) && !empty($_SESSION['systemdb_lang']))
         $systemdb_lang = $_SESSION['systemdb_lang'];

       $db->Free();
       $db->query->Clear();
       $db->query->setQuery("SET NAMES ".$systemdb_lang.";");
       $db->ExecuteSQL();

       $db->Free();
       $db->query->Clear();


       $db->query->setQuery($query);

       if(is_array($criteria) && count($criteria)>0){
   	     for($i=0;$i<count($criteria);$i++){
   	       switch($criteria[$i]['type']){
   	       	 case 'int':
   	       	   $db->query->setIntValue($criteria[$i]['name'],$criteria[$i]['value']);
   	       	   break;
   	       	 case 'float':
   	       	   $db->query->setFloatValue($criteria[$i]['name'],$criteria[$i]['value']);
   	       	   break;
   	       	 case 'string':
   	       	   $status = "";
               if(isset($criteria[$i]['status'])) $status = $criteria[$i]['status'];

   	       	   $pref  = '';
   	       	   $postf = '';
   	           if($status == "%like") $pref = '%';
   	           if($status == "like%") $postf = '%';
                  if($status == "%like%"){
   	       	   $pref  = '%';
   	       	   $postf = '%';
                  }


   	           if($status == "between()"){ $status = 'between'; }
   	     	   if($status == "between(]"){ $status = 'between'; }
      	       if($status == "between[)"){ $status = 'between'; }
   	           if($status == "between[]"){ $status = 'between'; }
               $type = '';
   	           if($status == "date_between()"){ $type = 'date';$status = 'between'; }
   	           if($status == "date_between(]"){ $type = 'date';$status = 'between'; }
   	           if($status == "date_between[)"){ $type = 'date';$status = 'between'; }
   	           if($status == "date_between[]"){ $type = 'date';$status = 'between'; }
               if($status == 'between'){
                 $val_start = 0;
                 $val_stop = 0;
                 $ar = explode("|",$pref.$criteria[$i]['value']);
                 if(isset($ar[0])) $val_start = $ar[0];
                 if(isset($ar[1])) $val_stop  = $ar[1];
                 if($type == 'date'){
   	       	       $db->query->setStringValue($criteria[$i]['name'].'_start',date("Y-m-d", strtotime($val_start)));
                   $db->query->setStringValue($criteria[$i]['name'].'_stop' ,date("Y-m-d", strtotime($val_stop)));
                 }else{
                   $db->query->setStringValue($criteria[$i]['name'].'_start',$val_start);
                   $db->query->setStringValue($criteria[$i]['name'].'_stop' ,$val_stop);
                 }
               }else{
   	       	     $db->query->setStringValue($criteria[$i]['name'],$pref.$criteria[$i]['value'].$postf);
   	       	   }
   	       	   break;
   	       	 case 'date':
   	       	   $criteria[$i]['value'] = date("Y-m-d", strtotime($criteria[$i]['value']));
   	       	   $db->query->setStringValue($criteria[$i]['name'],$criteria[$i]['value']);
   	       	   break;
   	       	 case 'password':
   	       	   $db->query->setStringValue($criteria[$i]['name'],md5($criteria[$i]['value']));
   	       	   break;
   	       }
   	     }
   	   }

   	   if(is_array($fields) && count($fields)>0){
   	     for($i=0;$i<count($fields);$i++){
   	       switch($fields[$i]['type']){
   	       	 case 'int':
   	       	   $db->query->setIntValue($fields[$i]['name'],$fields[$i]['value']);
   	       	   break;
   	       	 case 'float':
   	       	   $db->query->setFloatValue($fields[$i]['name'],$fields[$i]['value']);
   	       	   break;
   	       	 case 'string':
   	       	   $db->query->setStringValue($fields[$i]['name'],$fields[$i]['value']);
   	       	   break;
   	       	 case 'date':
   	       	   $db->query->setStringValue($fields[$i]['name'],date("Y-m-d", strtotime($fields[$i]['value'])));
   	       	   break;
   	       	 case 'password':
   	       	   $db->query->setStringValue($fields[$i]['name'],md5($fields[$i]['value']));
   	       	   break;
   	       }
   	     }
   	   }

       switch($option){
       	 case 'print_query':
       	   echo $db->query->sql;
       	   exit;
       	   break;
       	 default:
       	   break;
       }

       $db->ExecuteSQL();
       if($query_type == 'select'){
         $db->FetchAll();
         return $db->results;
       }
       if($query_type == 'insert'){
       	 return mysql_insert_id();
       }
       return TRUE;
     }catch(Exception $e){
       $this->error = $e->getMessage();

       if(debug_mode == 1){
         echo $db->query->sql."<hr />".$this->error;
         exit;
       }

       return FALSE;
     }
   }


   public function select_rows_count($from, $criteria, $option='disabled'){
     $tables_list = get_alternative_db_list();

   	 $db_host = db_host;
     $db_user = db_user;
     $db_pass = db_pass;
     $db_name = db_name;

     foreach($tables_list as $table=>$settings){
       if($from == $table || $from == "`".$table."`"){
       	 $db_host = $settings['db_host'];
       	 $db_user = $settings['user_name'];
       	 $db_pass = $settings['user_pass'];
       	 $db_name = $settings['db_name'];
       }
     }

   	 $list_where   = "";

   	 if(is_array($criteria) && count($criteria)>0){
   	   for($i=0;$i<count($criteria);$i++){
   	     $status = $criteria[$i]['status'];
   	     if($status == "%like") $status = 'like';
   	     if($status == "like%") $status = 'like';
                  if($status == "%like%"){
   	       	   $pref  = '%';
   	       	   $postf = '%';
                  }

   	     $between_type = 0;

   	     if($status == "between()"){ $status = 'between'; $between_type = 1;}
   	     if($status == "between(]"){ $status = 'between'; $between_type = 2;}
   	     if($status == "between[)"){ $status = 'between'; $between_type = 3;}
   	     if($status == "between[]"){ $status = 'between'; $between_type = 0;}

   	     if($status == "date_between()"){ $status = 'between'; $between_type = 1;}
   	     if($status == "date_between(]"){ $status = 'between'; $between_type = 2;}
   	     if($status == "date_between[)"){ $status = 'between'; $between_type = 3;}
   	     if($status == "date_between[]"){ $status = 'between'; $between_type = 0;}

   	     $status = ' '.$status.' ';
   	     if($status == ' between '){
   	       $list_where  .= ' AND '.$criteria[$i]['name'].$status.':'.$criteria[$i]['name'].'_start AND '.':'.$criteria[$i]['name'].'_stop ';
   	       switch($between_type){
   	       	 case 1:
   	       	   $list_where  .= ' AND '.$criteria[$i]['name'].' <> :'.$criteria[$i]['name'].'_start ';
   	       	   $list_where  .= ' AND '.$criteria[$i]['name'].' <> :'.$criteria[$i]['name'].'_stop ';
   	       	   break;
   	       	 case 2:
   	       	   $list_where  .= ' AND '.$criteria[$i]['name'].' <> :'.$criteria[$i]['name'].'_start ';
   	       	   break;
   	       	 case 3:
   	       	   $list_where  .= ' AND '.$criteria[$i]['name'].' <> :'.$criteria[$i]['name'].'_stop ';
   	       	   break;
   	       }
   	     }else{
   	       //$list_where  .= ' AND '.$criteria[$i]['name'].$status.':'.$criteria[$i]['name'];
   	       if($status == ' like '){
   	         $list_where  .= ' AND upper('.$criteria[$i]['name'].')'.$status.'upper(:'.$criteria[$i]['name'].')';
   	       }else{
   	         $list_where  .= ' AND '.$criteria[$i]['name'].$status.':'.$criteria[$i]['name'];
   	       }
   	     }
   	   }
   	 }

   	 try{
       $db = new MysqlDB($db_host,$db_user,$db_pass);
       $db->OpenDB($db_name);

       $systemdb_lang = "utf8";
       if(isset($_SESSION['systemdb_lang']) && !empty($_SESSION['systemdb_lang']))
         $systemdb_lang = $_SESSION['systemdb_lang'];

       $db->Free();
       $db->query->Clear();
       $db->query->setQuery("SET NAMES ".$systemdb_lang.";");
       $db->ExecuteSQL();

       $db->Free();
       $db->query->Clear();

       $db->query->setQuery("select count(*) as rows_count from {$from} where  1 {$list_where};");

       if(is_array($criteria) && count($criteria)>0){
   	     for($i=0;$i<count($criteria);$i++){
   	       switch($criteria[$i]['type']){
   	       	 case 'int':
   	       	   $db->query->setIntValue($criteria[$i]['name'],$criteria[$i]['value']);
   	       	   break;
   	       	 case 'float':
   	       	   $db->query->setFloatValue($criteria[$i]['name'],$criteria[$i]['value']);
   	       	   break;
   	       	 case 'string':
   	       	   $status = $criteria[$i]['status'];
   	       	   $pref  = '';
   	       	   $postf = '';
   	           if($status == "%like") $pref = '%';
   	           if($status == "like%") $postf = '%';
                  if($status == "%like%"){
   	       	   $pref  = '%';
   	       	   $postf = '%';
                  }

   	           if($status == "between()"){ $status = 'between'; }
   	     	   if($status == "between(]"){ $status = 'between'; }
      	       if($status == "between[)"){ $status = 'between'; }
   	           if($status == "between[]"){ $status = 'between'; }
               $type = '';
   	           if($status == "date_between()"){ $type = 'date';$status = 'between'; }
   	           if($status == "date_between(]"){ $type = 'date';$status = 'between'; }
   	           if($status == "date_between[)"){ $type = 'date';$status = 'between'; }
   	           if($status == "date_between[]"){ $type = 'date';$status = 'between'; }
               if($status == 'between'){
                 $val_start = 0;
                 $val_stop = 0;
                 $ar = explode("|",$pref.$criteria[$i]['value']);
                 if(isset($ar[0])) $val_start = $ar[0];
                 if(isset($ar[1])) $val_stop  = $ar[1];
                 if($type == 'date'){
   	       	       $db->query->setStringValue($criteria[$i]['name'].'_start',date("Y-m-d", strtotime($val_start)));
                   $db->query->setStringValue($criteria[$i]['name'].'_stop' ,date("Y-m-d", strtotime($val_stop)));
                 }else{
                   $db->query->setStringValue($criteria[$i]['name'].'_start',$val_start);
                   $db->query->setStringValue($criteria[$i]['name'].'_stop' ,$val_stop);
                 }
               }else{
   	       	     $db->query->setStringValue($criteria[$i]['name'],$pref.$criteria[$i]['value'].$postf);
   	       	   }
   	       	   break;
   	       	 case 'date':
   	       	   $criteria[$i]['value'] = date("Y-m-d", strtotime($criteria[$i]['value']));
   	       	   $db->query->setStringValue($criteria[$i]['name'],$criteria[$i]['value']);
   	       	   break;
   	       	 case 'password':
   	       	   $db->query->setStringValue($criteria[$i]['name'],md5($criteria[$i]['value']));
   	       	   break;
   	       }
   	     }
   	   }

       switch($option){
       	 case 'print_query':
       	   echo $db->query->sql;
       	   exit;
       	   break;
       	 default:
       	   break;
       }
   	   //echo $db->query->sql;

       $db->ExecuteSQL();
       $db->FetchAll();

       return $db->results[0]['rows_count'];

     }catch(Exception $e){
       $this->error = $e->getMessage();

       if(debug_mode == 1){
         echo $db->query->sql."<hr />".$this->error;
         exit;
       }

       return FALSE;
     }
   }

   public function select_rows($from,$fields,$criteria,$option='disabled', $limit_start="not_use",$limit_count = "not_use",$order_by = "not_use"){   	
     $tables_list = get_alternative_db_list();

   	 $db_host = db_host;
     $db_user = db_user;
     $db_pass = db_pass;
     $db_name = db_name;

     foreach($tables_list as $table=>$settings){
       if($from == $table || $from == "`".$table."`"){
       	 $db_host = $settings['db_host'];
       	 $db_user = $settings['user_name'];
       	 $db_pass = $settings['user_pass'];
       	 $db_name = $settings['db_name'];
       }
     }

   	 if(!is_array($fields)){
   	   $this->error = 'select fields array is not set correct';
   	   return FALSE;
   	 }
   	 $list_columns = "";
   	 $list_where   = "";
     $sql_limit    = "";

     if(strval($limit_start) != "not_use"
        && strval($limit_count) != "not_use"){

        $sql_limit = 'limit '.$limit_start.','.$limit_count;
     }
     $order = "";
     if($order_by != "not_use"){
       $order = "order by {$order_by}";
     }

   	 if(count($fields)>0){
   	   for($i=0;$i<count($fields)-1;$i++){
   	     $list_columns .= ' '.$fields[$i]['name'].' as '.$fields[$i]['new_name'].',';
   	   }
   	   $list_columns .= ' '.$fields[count($fields)-1]['name'].' as '.$fields[count($fields)-1]['new_name'];
   	 }

   	 if(is_array($criteria) && count($criteria)>0){
   	   for($i=0;$i<count($criteria);$i++){
   	     $status = $criteria[$i]['status'];
   	     if($status == "%like") $status = 'like';
   	     if($status == "like%") $status = 'like';
                  if($status == "%like%"){
   	       	   $pref  = '%';
   	       	   $postf = '%';
                  }

   	     $between_type = 0;

   	     if($status == "between()"){ $status = 'between'; $between_type = 1;}
   	     if($status == "between(]"){ $status = 'between'; $between_type = 2;}
   	     if($status == "between[)"){ $status = 'between'; $between_type = 3;}
   	     if($status == "between[]"){ $status = 'between'; $between_type = 0;}

   	     if($status == "date_between()"){ $status = 'between'; $between_type = 1;}
   	     if($status == "date_between(]"){ $status = 'between'; $between_type = 2;}
   	     if($status == "date_between[)"){ $status = 'between'; $between_type = 3;}
   	     if($status == "date_between[]"){ $status = 'between'; $between_type = 0;}

   	     $status = ' '.$status.' ';
   	     if($status == ' between '){
   	       $list_where  .= ' AND '.$criteria[$i]['name'].$status.':'.$criteria[$i]['name'].'_start AND '.':'.$criteria[$i]['name'].'_stop ';
   	       switch($between_type){
   	       	 case 1:
   	       	   $list_where  .= ' AND '.$criteria[$i]['name'].' <> :'.$criteria[$i]['name'].'_start ';
   	       	   $list_where  .= ' AND '.$criteria[$i]['name'].' <> :'.$criteria[$i]['name'].'_stop ';
   	       	   break;
   	       	 case 2:
   	       	   $list_where  .= ' AND '.$criteria[$i]['name'].' <> :'.$criteria[$i]['name'].'_start ';
   	       	   break;
   	       	 case 3:
   	       	   $list_where  .= ' AND '.$criteria[$i]['name'].' <> :'.$criteria[$i]['name'].'_stop ';
   	       	   break;
   	       }
   	     }else{
   	       if($status == ' like '){
   	         $list_where  .= ' AND upper('.$criteria[$i]['name'].')'.$status.'upper(:'.$criteria[$i]['name'].')';
   	       }else{
   	         $list_where  .= ' AND '.$criteria[$i]['name'].$status.':'.$criteria[$i]['name'];
   	       }
   	     }
   	   }
   	   //$list_where = ' '.$criteria[$i]['name'].'=:'.$criteria[count($criteria)-1];
   	 }

   	 try{
       $db = new MysqlDB($db_host,$db_user,$db_pass);
       $db->OpenDB($db_name);

       $systemdb_lang = "utf8";
       if(isset($_SESSION['systemdb_lang']) && !empty($_SESSION['systemdb_lang']))
         $systemdb_lang = $_SESSION['systemdb_lang'];

       $db->Free();
       $db->query->Clear();
       $db->query->setQuery("SET NAMES ".$systemdb_lang.";");
       $db->ExecuteSQL();

       $db->Free();
       $db->query->Clear();

       $db->query->setQuery("select {$list_columns} from {$from} where  1 {$list_where} {$order} {$sql_limit};");

       if(is_array($criteria) && count($criteria)>0){
   	     for($i=0;$i<count($criteria);$i++){
   	       switch($criteria[$i]['type']){
   	       	 case 'int':
   	       	   $db->query->setIntValue($criteria[$i]['name'],$criteria[$i]['value']);
   	       	   break;
   	       	 case 'float':
   	       	   $db->query->setFloatValue($criteria[$i]['name'],$criteria[$i]['value']);
   	       	   break;
   	       	 case 'string':
   	       	   $status = $criteria[$i]['status'];
   	       	   $pref  = '';
   	       	   $postf = '';
   	           if($status == "%like") $pref = '%';
   	           if($status == "like%") $postf = '%';
                  if($status == "%like%"){
   	       	   $pref  = '%';
   	       	   $postf = '%';
                  }
   	           if($status == "between()"){ $status = 'between'; }
   	     	   if($status == "between(]"){ $status = 'between'; }
      	       if($status == "between[)"){ $status = 'between'; }
   	           if($status == "between[]"){ $status = 'between'; }
               /*
   	           if($status == "date_between()"){ $status = 'between'; }
   	           if($status == "date_between(]"){ $status = 'between'; }
   	           if($status == "date_between[)"){ $status = 'between'; }
   	           if($status == "date_between[]"){ $status = 'between'; }
               if($status == 'between'){
                 $val_start = 0;
                 $val_stop = 0;
                 $ar = explode("|",$criteria[$i]['value']);
                 if(isset($ar[0])) $val_start = $ar[0];
                 if(isset($ar[1])) $val_stop  = $ar[1];
                 $db->query->setStringValue($criteria[$i]['name'].'_start',$val_start);
                 $db->query->setStringValue($criteria[$i]['name'].'_stop' ,$val_stop);
               }else{
               	 $db->query->setStringValue($criteria[$i]['name'],$pref.$criteria[$i]['value'].$postf);
               }
               */
               $type = '';
   	           if($status == "date_between()"){ $type = 'date';$status = 'between'; }
   	           if($status == "date_between(]"){ $type = 'date';$status = 'between'; }
   	           if($status == "date_between[)"){ $type = 'date';$status = 'between'; }
   	           if($status == "date_between[]"){ $type = 'date';$status = 'between'; }
               if($status == 'between'){
                 $val_start = 0;
                 $val_stop = 0;
                 $ar = explode("|",$pref.$criteria[$i]['value']);
                 if(isset($ar[0])) $val_start = $ar[0];
                 if(isset($ar[1])) $val_stop  = $ar[1];
                 if($type == 'date'){
   	       	       $db->query->setStringValue($criteria[$i]['name'].'_start',date("Y-m-d", strtotime($val_start)));
                   $db->query->setStringValue($criteria[$i]['name'].'_stop' ,date("Y-m-d", strtotime($val_stop)));
                 }else{
                   $db->query->setStringValue($criteria[$i]['name'].'_start',$val_start);
                   $db->query->setStringValue($criteria[$i]['name'].'_stop' ,$val_stop);
                 }
               }else{
               	 $db->query->setStringValue($criteria[$i]['name'],$pref.$criteria[$i]['value'].$postf);
               }
   	       	   break;
   	       	 case 'date':
   	       	   $criteria[$i]['value'] = date("Y-m-d", strtotime($criteria[$i]['value']));
   	       	   $db->query->setStringValue($criteria[$i]['name'],$criteria[$i]['value']);
   	       	   break;
   	       	 case 'password':
   	       	   $db->query->setStringValue($criteria[$i]['name'],md5($criteria[$i]['value']));
   	       	   break;
   	       }
   	     }
   	   }

   	   //echo $db->query->sql;

       switch($option){
       	 case 'print_query':
       	   echo $db->query->sql;
       	   exit;
       	   break;
       	 default:
       	   break;
       }
   	   //echo $db->query->sql;

       $db->ExecuteSQL();
       $db->FetchAll();

       return $db->results;

     }catch(Exception $e){
       $this->error = $e->getMessage();

	if(debug_mode == 1){
         echo $db->query->sql."<hr />".$this->error;
         exit;
       }

       return FALSE;
     }
   }
   public function delete_rows($from,$criteria,$option = 'disabled'){
     $tables_list=get_alternative_db_list();

   	 $db_host = db_host;
     $db_user = db_user;
     $db_pass = db_pass;
     $db_name = db_name;

     foreach($tables_list as $table=>$settings){
       if($from == $table || $from == "`".$table."`"){
       	 $db_host = $settings['db_host'];
       	 $db_user = $settings['user_name'];
       	 $db_pass = $settings['user_pass'];
       	 $db_name = $settings['db_name'];
       }
     }

   	 $list_where = "";
   	 if(is_array($criteria) && count($criteria)>0){
   	   for($i=0;$i<count($criteria);$i++){
   	     $status = $criteria[$i]['status'];
   	     if($status == "%like") $status = 'like';
   	     if($status == "like%") $status = 'like';
                  if($status == "%like%"){
   	       	   $pref  = '%';
   	       	   $postf = '%';
                  }
   	     $status = ' '.$status.' ';
   	     $list_where  = ' AND '.$criteria[$i]['name'].$status.':'.$criteria[$i]['name'].' ';
   	   }
   	 }

   	 try{
       $db = new MysqlDB($db_host,$db_user,$db_pass);
       $db->OpenDB($db_name);

       $systemdb_lang = "utf8";
       if(isset($_SESSION['systemdb_lang']) && !empty($_SESSION['systemdb_lang']))
         $systemdb_lang = $_SESSION['systemdb_lang'];

       $db->Free();
       $db->query->Clear();
       $db->query->setQuery("SET NAMES ".$systemdb_lang.";");
       $db->ExecuteSQL();

       $db->Free();
       $db->query->Clear();

       $db->query->setQuery("delete from {$from} where 1 {$list_where};");

       if(is_array($criteria) && count($criteria)>0){
   	     for($i=0;$i<count($criteria);$i++){
   	       switch($criteria[$i]['type']){
   	       	 case 'int':
   	       	   $db->query->setIntValue($criteria[$i]['name'],$criteria[$i]['value']);
   	       	   break;
   	       	 case 'float':
   	       	   $db->query->setFloatValue($criteria[$i]['name'],$criteria[$i]['value']);
   	       	   break;
   	       	 case 'string':
   	       	   $status = $criteria[$i]['status'];
   	       	   $pref  = '';
   	       	   $postf = '';
   	           if($status == "%like") $pref = '%';
   	           if($status == "like%") $postf = '%';
                  if($status == "%like%"){
   	       	   $pref  = '%';
   	       	   $postf = '%';
                  }
   	       	   $db->query->setStringValue($criteria[$i]['name'],$pref.$criteria[$i]['value'].$postf);
   	       	   break;
   	       	 case 'date':
   	       	   $criteria[$i]['value'] = date("Y-m-d", strtotime($criteria[$i]['value']));
   	       	   $db->query->setStringValue($criteria[$i]['name'],$criteria[$i]['value']);
   	       	   break;
   	       	 case 'password':
   	       	   $db->query->setStringValue($criteria[$i]['name'],md5($criteria[$i]['value']));
   	       	   break;
   	       }
   	     }
   	   }

       switch($option){
       	 case 'print_query':
       	   echo $db->query->sql;
       	   exit;
       	   break;
       	 default:
       	   break;
       }

       $db->ExecuteSQL();

       return TRUE;

     }catch(Exception $e){
       $this->error = $e->getMessage();

	if(debug_mode == 1){
         echo $db->query->sql."<hr />".$this->error;
         exit;
       }

       return FALSE;
     }
   }
   public function update_rows($from,$fields,$criteria,$option='disabled'){
     $tables_list=get_alternative_db_list();

   	 $db_host = db_host;
     $db_user = db_user;
     $db_pass = db_pass;
     $db_name = db_name;

     foreach($tables_list as $table=>$settings){
       if($from == $table || $from == "`".$table."`"){
       	 $db_host = $settings['db_host'];
       	 $db_user = $settings['user_name'];
       	 $db_pass = $settings['user_pass'];
       	 $db_name = $settings['db_name'];
       }
     }

     if(!is_array($fields)){
   	   $this->error = 'update fields array is not set correct';
   	   return FALSE;
   	 }

   	 $update_columns = "";
   	 $list_where     = "";

   	 if(count($fields)>0){
   	   for($i=0;$i<count($fields)-1;$i++){
   	     $update_columns .= ' '.$fields[$i]['name'].'=:'.$fields[$i]['name'].',';
   	   }
   	   $update_columns .= ' '.$fields[count($fields)-1]['name'].'=:'.$fields[count($fields)-1]['name'];
   	 }

   	 if(is_array($criteria) && count($criteria)>0){
   	   for($i=0;$i<count($criteria);$i++){
   	     $status = $criteria[$i]['status'];
   	     if($status == "%like") $status = 'like';
   	     if($status == "like%") $status = 'like';
                  if($status == "%like%"){
   	       	   $pref  = '%';
   	       	   $postf = '%';
                  }

   	     $status = ' '.$status.' ';
   	     $list_where  .= ' AND '.$criteria[$i]['name'].$status.':'.$criteria[$i]['name'].' ';
   	   }
   	 }

   	 try{
       $db = new MysqlDB($db_host,$db_user,$db_pass);
       $db->OpenDB($db_name);

       $systemdb_lang = "utf8";
       if(isset($_SESSION['systemdb_lang']) && !empty($_SESSION['systemdb_lang']))
         $systemdb_lang = $_SESSION['systemdb_lang'];

       $db->Free();
       $db->query->Clear();
       $db->query->setQuery("SET NAMES ".$systemdb_lang.";");
       $db->ExecuteSQL();

       $db->Free();
       $db->query->Clear();

       $db->query->setQuery("update {$from} set {$update_columns} where 1 {$list_where};");

       if(is_array($criteria) && count($criteria)>0){
   	     for($i=0;$i<count($criteria);$i++){
   	       switch($criteria[$i]['type']){
   	       	 case 'int':
   	       	   $db->query->setIntValue($criteria[$i]['name'],$criteria[$i]['value']);
   	       	   break;
   	       	 case 'float':
   	       	   $db->query->setFloatValue($criteria[$i]['name'],$criteria[$i]['value']);
   	       	   break;
   	       	 case 'string':
   	       	   $status = $criteria[$i]['status'];
   	       	   $pref  = '';
   	       	   $postf = '';
   	           if($status == "%like") $pref = '%';
   	           if($status == "like%") $postf = '%';
                  if($status == "%like%"){
   	       	   $pref  = '%';
   	       	   $postf = '%';
                  }
   	       	   $db->query->setStringValue($criteria[$i]['name'],$pref.$criteria[$i]['value'].$postf);
   	       	   break;
   	       	 case 'date':
   	       	   $db->query->setStringValue($criteria[$i]['name'],date("Y-m-d", strtotime($criteria[$i]['value'])));
   	       	   break;
   	       	 case 'password':
   	       	   $db->query->setStringValue($criteria[$i]['name'],md5($criteria[$i]['value']));
   	       	   break;
   	       }
   	     }
   	   }
   	   if(is_array($fields) && count($fields)>0){
   	     for($i=0;$i<count($fields);$i++){
   	       switch($fields[$i]['type']){
   	       	 case 'int':
   	       	   $db->query->setIntValue($fields[$i]['name'],$fields[$i]['value']);
   	       	   break;
   	       	 case 'float':
   	       	   $db->query->setFloatValue($fields[$i]['name'],$fields[$i]['value']);
   	       	   break;
   	       	 case 'string':
   	       	   $db->query->setStringValue($fields[$i]['name'],$fields[$i]['value']);
   	       	   break;
   	       	 case 'date':
   	       	   $db->query->setStringValue($fields[$i]['name'],date("Y-m-d", strtotime($fields[$i]['value'])));
   	       	   break;
   	       	 case 'password':
   	       	   $db->query->setStringValue($fields[$i]['name'],md5($fields[$i]['value']));
   	       	   break;
   	       }
   	     }
   	   }

       switch($option){
       	 case 'print_query':
       	   echo $db->query->sql;
       	   exit;
       	   break;
       	 default:
       	   break;
       }

       $db->ExecuteSQL();

       return TRUE;

     }catch(Exception $e){
       $this->error = $e->getMessage();

	if(debug_mode == 1){
         echo $db->query->sql."<hr />".$this->error;
         exit;
       }

       return FALSE;
     }
   }
   public function insert_rows($table,$fields,$option='disabled'){
     $tables_list=get_alternative_db_list();

   	 $db_host = db_host;
     $db_user = db_user;
     $db_pass = db_pass;
     $db_name = db_name;

     foreach($tables_list as $t=>$settings){
       if($t == $table || $table == "`".$t."`"){
       	 $db_host = $settings['db_host'];
       	 $db_user = $settings['user_name'];
       	 $db_pass = $settings['user_pass'];
       	 $db_name = $settings['db_name'];
       }
     }
   	 if(!is_array($fields)){
   	   $this->error = 'insert fields array is not set correct';
   	   return FALSE;
   	 }

   	 $insert_columns       = "";
   	 $insert_columns_value = "";

   	 if(count($fields)>0){
   	   for($i=0;$i<count($fields)-1;$i++){
   	     $insert_columns       .=     $fields[$i]['name'].',';
   	     $insert_columns_value .= ':'.$fields[$i]['name'].',';
   	   }
   	   $insert_columns .= $fields[count($fields)-1]['name'];
   	   $insert_columns_value .= ':'.$fields[$i]['name'];
   	 }

   	 try{
       $db = new MysqlDB($db_host,$db_user,$db_pass);
       $db->OpenDB($db_name);

       $systemdb_lang = "utf8";
       if(isset($_SESSION['systemdb_lang']) && !empty($_SESSION['systemdb_lang']))
         $systemdb_lang = $_SESSION['systemdb_lang'];

       $db->Free();
       $db->query->Clear();
       $db->query->setQuery("SET NAMES ".$systemdb_lang.";");
       $db->ExecuteSQL();

       $db->Free();
       $db->query->Clear();

       $db->query->setQuery("insert into {$table} ({$insert_columns}) values({$insert_columns_value});");

   	   if(is_array($fields) && count($fields)>0){
   	     for($i=0;$i<count($fields);$i++){
   	       switch($fields[$i]['type']){
   	       	 case 'int':
   	       	   $db->query->setIntValue($fields[$i]['name'],$fields[$i]['value']);
   	       	   break;
   	       	 case 'float':
   	       	   $db->query->setFloatValue($fields[$i]['name'],$fields[$i]['value']);
   	       	   break;
   	       	 case 'string':
   	       	   $db->query->setStringValue($fields[$i]['name'],$fields[$i]['value']);
   	       	   break;
   	       	 case 'date':
   	       	   $fields[$i]['value'] = date("Y-m-d", strtotime($fields[$i]['value']));
   	       	   $db->query->setStringValue($fields[$i]['name'],$fields[$i]['value']);
   	       	   break;
   	       	 case 'password':
   	       	   $db->query->setStringValue($fields[$i]['name'],md5($fields[$i]['value']));
   	       	   break;
   	       }
   	     }
   	   }

       switch($option){
       	 case 'print_query':
       	   echo $db->query->sql;
       	   exit;
       	   break;
       	 default:
       	   break;
       }

       $db->ExecuteSQL();

       return TRUE;

     }catch(Exception $e){
       $this->error = $e->getMessage();

	if(debug_mode == 1){
         echo $db->query->sql."<hr />".$this->error;
         exit;
       }

       return FALSE;
     }
   }
   public function getError(){
   	 return $this->error;
   }
 }
?>