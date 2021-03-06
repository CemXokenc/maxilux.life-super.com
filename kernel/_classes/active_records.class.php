<?php
 if(!defined("log_queries")) define("log_queries","0");
 $hooks = array();
 function db_hook($table_name,$action,$function_name){
   global $hooks;
   $hooks[] = array('table_name'=>$table_name,'action'=>$action,'function_name'=>$function_name);
 }
 
 class active_records{
   private $m_table_name = '';
   private $m_select_str = ' * ';
   private $m_select_distinct_str = '  ';
   private $m_where_str  = '';
   private $m_group_by = '';
   private $m_order_by = '';
   private $m_values = array();
   private $m_db = null;
   private $m_result = null;
   private $m_print_query = 'disabled';
   private $init_or = 0;

   public function __construct(){     $this->m_db = new db_ext();
   }
   function order_by($name,$value = ""){     
     if(!empty($this->m_order_by)) $this->m_order_by .= ", ";

     if(empty($value)){
       $this->m_order_by .= $name;     
     }else{
       $this->m_order_by .= " ".$name." ".$value." ";     }

     return $this;
   }
   function rand_data(){     
     if(!empty($this->m_order_by)) $this->m_order_by .= ", ";

     $this->m_order_by .= " rand() ";     
     
     return $this;
   }
   function count_all($table_name){
     $query = 'SELECT count(*) as cnt FROM '.$this->m_table_name;
     if($this->m_print_query == "return_query"){
       $this->_reset();
       
       return $query;
     }
     if(log_queries == 1){
       global $log;
       $log->lwrite($query);
     }
     $result = $this->m_db->execute_query('select',$query,array(),array(),$this->m_print_query);

     $this->_reset();

     return $result[0]['cnt'];
   }
   function count_all_results($table_name = '', $clear = true){
     if($table_name != ''){
   	   $this->m_table_name = $table_name;
   	 }

   	 $where_str = "";
   
   	 if(!empty($this->m_where_str)) $where_str = " WHERE ";

     $columns = '*';
     if($this->m_select_str != ""){
         $columns = $this->m_select_distinct_str.$this->m_select_str;
     }
     
     $query = 'SELECT count('.$columns.') as cnt FROM '.$this->m_table_name.$where_str.$this->m_where_str;
     if($this->m_print_query == "return_query"){
       $this->_reset();
       
       return $query;
     }
     if(log_queries == 1){
       global $log;
       $log->lwrite($query);
     }
     
     $result = $this->m_db->execute_query('select',$query,array(),array(),$this->m_print_query);
                           
     //$result = $this->m_db->execute_query('select','SELECT count(*) as cnt FROM '.$this->m_table_name.$where_str.$this->m_where_str,array(),array(),$this->m_print_query);

     if($clear){$this->_reset();}
     
     return $result[0]['cnt'];
   }
   function print_query($bPrint = true){
     if($bPrint){
       $this->m_print_query = "print_query";
     }else{
       $this->m_print_query = "disabled";
     }
     
     return $this;
   }
   function return_query($bPrint = true){
     if($bPrint){
       $this->m_print_query = "return_query";
     }else{
       $this->m_print_query = "disabled";
     }
     
     return $this;
   }
   function get($table_name='',$limit='', $offset='', $clear = true){
     if($table_name != ''){   	   $this->m_table_name = $table_name;
   	 }

   	 if(!empty($limit)){
   	   $limit = " LIMIT ";
   	   if(!empty($offset)){   	     $limit .= $offset.", ";
   	   }
   	   //$limit .= $limit;
   	 }else{   	   $limit = $this->m_limit;
   	 }

   	 $where_str = "";
   	 if(!empty($this->m_where_str)){
   	   $where_str = " WHERE ";
   	   if($this->init_or == '1'){
   	     $this->m_where_str .= ") ";
   	     $this->init_or = 0;
   	   }
   	 }

     $order_by_str = "";
   	 if(!empty($this->m_order_by)) $order_by_str = " ORDER BY ";

   	 $group_by_str = "";
   	 if(!empty($this->m_group_by)) $group_by_str = " GROUP BY ";

     $query = 'SELECT '.$this->m_select_distinct_str.$this->m_select_str.' FROM '.$this->m_table_name.$where_str.$this->m_where_str.$order_by_str.$this->m_order_by.$group_by_str.$this->m_group_by.$limit;

     if(log_queries == 1){
       global $log;
       $log->lwrite($query);
     }
     
     if($this->m_print_query == "return_query"){

       $this->_reset();
       
       return $query;
     }
     
     $this->m_result = $this->m_db->execute_query('select',$query,array(),array(),$this->m_print_query);
     
     global $hooks;
     
     foreach($hooks as $info){
       $table = $info["table_name"];
       
       if($info['action'] == 'select'){
         $pos = strpos($this->m_table_name, $table);
         if($pos !== false){
          if(strlen($this->m_table_name) == $pos + strlen($table)
             || $this->m_table_name[$pos + strlen($table)+1] == ' '
             || $this->m_table_name[$pos + strlen($table)+1] == ','
             || $this->m_table_name[$pos + strlen($table)+1] == '`'){
               if($this->m_table_name[$pos-1] == '`'
                 || $this->m_table_name[$pos-1] == ' '
                 || $this->m_table_name[$pos-1] == ','
                 || $pos == 0){
                   //global $log;
                   //$log->lwrite("hook:".$query);
                   $info['function_name']($this->m_result);
              }
           }
         }
       }
     }
     
     if($clear){$this->_reset();}
     
     return $this;
   }

   function query($query,$type='insert'){
     if(log_queries == 1){
       global $log;
       $log->lwrite($query);
     }
     
     $this->m_result = $this->m_db->execute_query($type,$query,array(),array(),$this->m_print_query);
     
     $this->_reset();
     
     return $this;
   }

   function get_where($table_name, $criteria, $limit="", $offset=""){
   	 $limit = $this->m_limit;
   	 if(!empty($limit)){
   	   $limit = "LIMIT ";
   	   if(!empty($offset)){
   	     $limit .= $offset.", ";
   	   }
   	   $limit .= $limit;
   	 }

   	 $where_str = '';
   	 foreach($criteria as $key=>$val){
   	   if(!empty($where_str)) $where_str .= ' AND ';
   	   $where_str .= $key." = '".mysql_escape_string($val)."'";   	 }
   	 if(!empty($where_str)) $where_str = " WHERE ".$where_str;

   	 $order_by_str = "";
   	 if(!empty($this->m_order_by)) $order_by_str = " ORDER BY ";

   	 $group_by_str = "";
   	 if(!empty($this->m_group_by)) $group_by_str = " GROUP BY ";

     $this->m_result = $this->m_db->execute_query('select','SELECT '.$this->m_select_str.' FROM '.$table_name.$where_str.$limit.$order_by_str.$this->m_order_by.$group_by_str.$this->m_group_by,array(),array(),$this->m_print_query);

     $this->_reset();

     return $this;   }

   function select($select_str){     $this->m_select_str = $select_str;

     return $this;
   }

   function select_max($name, $aliace=''){     $this->m_select_str = ' MAX('.$name.') ';
     if(!empty($aliace)) $this->m_select_str .= 'AS '.$aliace;
     else $this->m_select_str .= 'AS '.$name;
     return $this;
   }

   function select_min($name, $aliace=''){
     $this->m_select_str = ' MIN('.$name.') ';
     if(!empty($aliace)) $this->m_select_str .= 'AS '.$aliace;
     else $this->m_select_str .= 'AS '.$name;

     return $this;
   }

   function select_avg($name, $aliace=''){
     $this->m_select_str = ' AVG('.$name.') ';
     if(!empty($aliace)) $this->m_select_str .= 'AS '.$aliace;
     else $this->m_select_str .= 'AS '.$name;

     return $this;
   }

   function select_sum($name, $aliace=''){
     $this->m_select_str = ' SUM('.$name.') ';
     if(!empty($aliace)) $this->m_select_str .= 'AS '.$aliace;
     else $this->m_select_str .= 'AS '.$name;

     return $this;
   }

   function from($table_name){
     $this->m_table_name = $table_name;

     return $this;
   }

   function join($table_name,$relantship,$type=''){
     if(!empty($table_name)){
       $this->m_table_name .= ' '.$type.' JOiN '.$table_name.' ON '.$relantship;
     }

     return $this;
   }
   
   function skobki($type){
     $prefix = "";
     $sufix  = "";
     if($type == "and"){
       if($this->init_or == 1){
         $this->init_or = 0;
         $prefix = " )";
       }
       if(!empty($this->m_where_str)) $this->m_where_str .= $prefix." and ";
     }
     if($type == "or"){
       if($this->init_or == 0){
         $this->init_or = 1;
         $prefix = "((";
         $sufix  = ")";
       }
       if(!empty($this->m_where_str)) $this->m_where_str = " ".$prefix.$this->m_where_str.$sufix." or ( ";
     }
   }

   function where($name, $value="", $literal = false){
     if(!is_array($name)){   	   
       $this->skobki("and");
       //if(!empty($this->m_where_str)) $this->m_where_str .= " AND ";
   	   //if(empty($this->m_where_str)) $this->m_where_str .= " WHERE ";

       $operator = " = ";
       $pos = strpos($name,' ');
       if($pos!== false) $operator = '';
       if($literal){
        $this->m_where_str .= " ".$name.$operator."".$value." ";
       }else{
        $this->m_where_str .= " ".$name.$operator."'".mysql_escape_string($value)."' ";
       }

       return $this;
     }else{       $criteria = $name;
   	   $this->skobki("and");
   	   //if(!empty($this->m_where_str)) $this->m_where_str .= " AND ";
   	   //if(empty($this->m_where_str)) $this->m_where_str .= " WHERE ";

       $item_str = '';
       if(is_array($criteria)){
         foreach($criteria as $name=>$value){
           $operator = " = ";
           if($name[strlen($name)-1] == ' ') $operator = '';

           if(!empty($item_str)) $item_str .= " AND ";
           $item_str .= $name.$operator."'".mysql_escape_string($value)."' ";
         }
       }else{         $item_str = $criteria;
       }

       $this->m_where_str .= $item_str;

       return $this;
     }
   }

   function or_where($name, $value=""){
   	 if(!is_array($name)){
   	   //if(!empty($this->m_where_str)) $this->m_where_str ="(( ".$this->m_where_str." ) OR ( ";
   	   $this->skobki("or");

       $operator = " = ";
       if($name[strlen($name)-1] == ' ') $operator = '';

       $this->m_where_str .= $name.$operator."'".mysql_escape_string($value)."')";

       return $this;
     }else{
       $criteria = $name;
   	   $this->skobki("or");
   	   //if(!empty($this->m_where_str)) $this->m_where_str ="(( ".$this->m_where_str." ) OR ( ";
   	   //if(empty($this->m_where_str)) $this->m_where_str .= " WHERE ";

       $item_str = '';
       if(is_array($criteria)){
         foreach($criteria as $name=>$value){
           $operator = " = ";
           if($name[strlen($name)-1] == ' ') $operator = '';

           if(!empty($item_str)) $item_str .= " AND ";

           $item_str .= $name.$operator."'".mysql_escape_string($value)."' ";
         }
       }else{
         $item_str = $criteria;
       }
       $this->m_where_str .= $item_str." )) ";

       return $this;
     }
   }
   function relantship($relantship){
     if(!empty($this->m_where_str)) $this->m_where_str .= " AND ";

     $this->m_where_str .= " ".$relantship;

     return $this;   
   }



   function where_in($name,$values){
   	 $this->skobki("and");
   	 //if(!empty($this->m_where_str)) $this->m_where_str .=" AND ";

     $item_str = '';
     if(is_array($values)){
       foreach($values as $key=>$value){
         if(!empty($item_str)) $item_str .= ", ";

         $item_str .= "'".mysql_escape_string($value)."'";
       }
     }else{
       $item_str = $values;
     }
     $this->m_where_str .= " ".$name." IN ( ".$item_str." ) ";

     return $this;   }

   function where_not_in($name,$values){
   	 $this->skobki("and");
   	 //if(!empty($this->m_where_str)) $this->m_where_str .= " AND ";

     $item_str = '';
     if(is_array($values)){
       foreach($values as $n=>$value){
         if(!empty($item_str)) $item_str .= ", ";

         $item_str .= "'".mysql_escape_string($value)."'";
       }
     }else{
       $item_str = $values;
     }
     $this->m_where_str .= " ".$name." NOT IN ( ".$item_str." ) ";

     return $this;
   }

   function or_where_in($name,$values){
     $this->skobki("or");
     //if(!empty($this->m_where_str)) $this->m_where_str = " ( ".$this->m_where_str." ) OR ";

     $item_str = '';
     if(is_array($values)){
       foreach($values as $n=>$value){
         if(!empty($item_str)) $item_str .= ", ";

         $item_str .= "'".mysql_escape_string($value)."'";
       }
     }else{
       $item_str = $values;
     }
     $this->m_where_str .= " ".$name." IN ( ".$item_str." )) ";

     return $this;
   }

   function or_where_not_in($name,$values){
   	 $this->skobki("or");
   	 //if(!empty($this->m_where_str)) $this->m_where_str = " ( ".$this->m_where_str." ) OR ";

     $item_str = '';
     if(is_array($values)){
       foreach($values as $name=>$value){
         if(!empty($item_str)) $item_str .= ", ";

         $item_str .= "'".mysql_escape_string($value)."'";
       }
     }else{
       $item_str = $values;
     }
     $this->m_where_str .= " NOT ".$name." IN ( ".$item_str." ) )";

     return $this;
   }
   /*
         type:
               - befor
               - after
               - both
   */
   function like($name,$match='',$type='both') {   	 
   if(!is_array($name)){
   	   $this->skobki("and");
   	   //if(!empty($this->m_where_str)) $this->m_where_str .= " AND ";

       $o_befor = '%';
       $o_after = '%';
       if($type == 'befor') $o_befor = '';
       if($type == 'after') $o_after  = '';

       $this->m_where_str .= " ".$name." LIKE '".$o_befor.mysql_escape_string($match).$o_after."' ";

       return $this;     }else{
       $items = $name;
   	   foreach($items as $key=>$value){
         $o_befor = '%';
         $o_after = '%';

         if(!empty($this->m_where_str)) $this->m_where_str .= " AND ";
         $this->m_where_str = " ".$key." LIKE '".$o_befor.mysql_escape_string($value).$o_after."' ";
       }

       return $this;
     }
   }

   function or_like($name,$match,$type='both') {
   	 $this->skobki("or");
   	 //if(!empty($this->m_where_str)) $this->m_where_str = " (".$this->m_where_str.") OR (";

     $o_befor = '%';
     $o_after = '%';
     if($type == 'befor') $o_befor = '';
     if($type == 'after') $o_after  = '';

     $this->m_where_str .= " ".$name." LIKE '".$o_befor.mysql_escape_string($match).$o_after."' ) ";

     return $this;
   }

   function not_like($name,$match,$type='both') {
   	 $this->skobki("and");
   	 //if(!empty($this->m_where_str)) $this->m_where_str = " AND ";

     $o_befor = '%';
     $o_after = '%';
     if($type == 'befor') $o_befor = '';
     if($type == 'after') $o_after  = '';

     $this->m_where_str = " ".$name." NOT LIKE '".$o_befor.mysql_escape_string($value).$o_after."' ";

     return $this;
   }

   function or_not_like($name,$match,$type='both') {
   	 $this->skobki("or");
   	 //if(!empty($this->m_where_str)) $this->m_where_str = " (".$this->m_where_str.") OR (";

     $o_befor = '%';
     $o_after = '%';
     if($type == 'befor') $o_befor = '';
     if($type == 'after') $o_after  = '';

     $this->m_where_str = " ".$name." NOT LIKE '".$o_befor.mysql_escape_string($value).$o_after."' ) ";

     return $this;
   }

   function group_by($name){
     if(!empty($this->m_group_by)) $this->m_group_by .= ", ";

     if(!is_array($name)){       
       $this->m_group_by .= $name;
     }else{
       $items = $name;

       $item_str = '';
       foreach($items as $value){         if(!empty($item_str)) $item_str .= ", ";
         $item_str .= $value;
       }
       $this->m_group_by .= $item_str;
     }
     
     return $this;
   }

   function distinct(){     $this->m_select_distinct_str = " DISTINCT ";

     return $this;
   }
   function limit($limit, $offset = ''){   	 if($offset == ''){   	   $this->m_limit = " limit ".$limit;     }else{   	   $this->m_limit = " limit ".$offset.",".$limit;
   	 }
   	 return $this;
   }

   public function _reset(){
     $this->m_select_str = ' * ';
     $this->m_where_str  = "";
     $this->m_group_by   = "";
     $this->m_order_by   = "";
     $this->m_values     = array();
     $this->m_select_distinct_str = "";
     $this->m_limit      = "";
     $this->m_print_query = "disabled";
   }

   function result(){     return $this->m_result;
   }

   function set($name,$value=''){
     if(!empty($name)){
       $this->m_values[$name] = $value;
     }

     return $this;
   }

   function insert($table_name, $values = array())
   {
	 global $hooks;
	 if(count($values)<=0) $values = $this->m_values;
         
         $sys_values = array();
         foreach($values as $k=>$v){
           $sys_values[$k] = $v;
         }
         
         foreach($hooks as $info){
           $table = $info['table_name'];
           if($table == $table_name && $info['action'] == 'insert'){
             $info['function_name']($sys_values);
           }
         }
         
         $values = array();
         foreach($sys_values as $k=>$v){
           $values[$k] = $v;
         }
         
         $columns_str = '';
         $values_str  = '';
         foreach($values as $key=>$val)
         {
                if(!empty($columns_str)) $columns_str .= ' , ';
                if(!empty($values_str)) $values_str .= ' , ';

                $columns_str .= "`".$key."`";
                $values_str .= "'".mysql_escape_string($val)."'";
         }
         
         $query = 'INSERT into '.$table_name.' ('.$columns_str.') VALUES ('.$values_str.')';
         
         if($this->m_print_query == "return_query"){
           
           $this->_reset();
       
           return $query;
         }
        
         if(log_queries == 1){
           global $log;
           $log->lwrite($query);
         }

         $this->m_result = $this->m_db->execute_query('insert',$query,array(),array(),$this->m_print_query);

         $this->_reset();

         return $this;
   }

   function update($table_name, $values = array(),$criteria = array())
   {
         global $hooks;
         if(count($values)<=0) $values = $this->m_values;

         $sys_values= array();
         foreach($values as $k=>$v){
           $sys_values[$k] = $v;
         }
         
         foreach($hooks as $info){
           $table = $info['table_name'];
           if($table == $table_name && $info['action'] == 'update'){
             $info['function_name']($sys_values);
             //print_r($sys_values);
           }
         }
         
         $values = array();
         foreach($sys_values as $k=>$v){
           $values[$k] = $v;
         }
        
         $values_str  = '';
         foreach($values as $key=>$val){
           if(!empty($values_str)) $values_str .= ' , ';
          
           $sub_op = "";
           if($key[strlen($key)-1] == "+" || $key[strlen($key)-1] == "-" || $key[strlen($key)-1] == "*" || $key[strlen($key)-1] == "/"){
             $sub_op = substr($key,strlen($key) - 1);
             $key = substr($key,0,strlen($key) - 1);
             $sub_op = $key." ".$sub_op;
           }
           $values_str .= $key." = ".$sub_op." '".mysql_escape_string($val)."'";
         }

         $criteria_str = '';
         if(count($criteria)<=0){
             $criteria_str = $this->m_where_str;
         }else{
             foreach($criteria as $key=>$val)
             {
                if(!empty($criteria_str)) $criteria_str .= ' AND ';
                $criteria_str .= $key." = '".mysql_escape_string($val)."'";
             }
         }
         
         if($criteria_str != "") $criteria_str = ' WHERE '.$criteria_str;
         
         $query = 'UPDATE '.$table_name.' SET '.$values_str.$criteria_str;

         if($this->m_print_query == "return_query"){
           
           $this->_reset();
       
           return $query;
         }
         
         if(log_queries == 1){
           global $log;
           $log->lwrite($query);
         }
         
         $this->m_result = $this->m_db->execute_query('update',$query,array(),array(),$this->m_print_query);

         $this->_reset();

        return $this;
   }

   function delete($table_name, $criteria = array())
   {
     global $hooks;
     
     $sys_values= array();
     foreach($criteria as $k=>$v){
       $sys_values[$k] = $v;
     }
                           
     foreach($hooks as $info){
       $table = $info['table_name'];
       if($table == $table_name && $info['action'] == 'delete'){
         $info['function_name']($sys_values);
       }
     }

         $criteria_str = '';
         if(count($criteria)<=0){
             $criteria_str = $this->m_where_str;
         }else{
             foreach($criteria as $key=>$val)
             {
                if(!empty($criteria_str)) $criteria_str .= ' AND ';
                $criteria_str .= $key." = '".mysql_escape_string($val)."'";
             }
         }

         $query = 'DELETE FROM '.$table_name.' WHERE '.$criteria_str;
         if($this->m_print_query == "return_query"){
           $this->_reset();
       
           return $query;
         }
         if(log_queries == 1){
           global $log;
           $log->lwrite($query);
         }
         
         $this->m_result = $this->m_db->execute_query('delete',$query,array(),array(),$this->m_print_query);

         $this->_reset();

         return mysql_affected_rows();
   }

   function empty_table($table_name)
   {
         $this->m_result = $this->m_db->execute_query('delete','DELETE FROM '.$table_name,array(),array(),$this->m_print_query);
         $this->_reset();
         return $this;
   }
   function affected_rows(){
     return mysql_affected_rows();
   }
 }
?>