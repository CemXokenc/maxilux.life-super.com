<?php
if(strval(date('m')) > 3 && strval(date('m'))< 12)
date_default_timezone_set("Asia/Muscat");
else date_default_timezone_set("Europe/Kiev");
define('main_img_domain','/');
define('main_img_path','/');
define('images_path','/files/');

$act = new actions();
$act->r_v('main_img_domain','/');

function calc_price($price, $currency_in,$currency_out){
  $db = new active_records();
  $info_in = $db->where("kod_valuty",$currency_in)->get("currencies")->result();
  $info_out = $db->where("kod_valuty",$currency_out)->get("currencies")->result();
  $price_result = 0;
  $price = floatval($price);  

  if($info_out[0]['rate']!=""){
    $price_result = $price*$info_in[0]['rate'] / $info_out[0]['rate'];
  }
 $price = number_format($price_result, 2, '.', ' ');
  $price_result = number_format($price_result, 2, ',', ' ');
$price = str_replace(' ','',$price );
  $valuta_name = $info_out[0]['name'];
  if($currency_out=="UAH"){
     $valuta_name="грн.";
  }

   if($currency_out=="USD"){
     $valuta_name="y.e.";
  }

  $view = "<span class='class_price'>".$price_result." ".$valuta_name."</span>";

  return array("price"=>$price, "view"=>$view);
}
function generate_categories_list($category_id){
  $db = new active_records();
  $categories_list = "";

  $info = $db->where("parent_id", $category_id)->get("categories")->result();

  if(count($info) > 0){
    for($z=0;$z<count($info);$z++){
      $category_id = $info[$z]['id'];

      if($categories_list != "") $categories_list .=", ";
      $categories_list .= $category_id;

      $categories_list .= generate_categories_list($category_id);
    }
  }

  if($categories_list != ""){$categories_list = ", ".$categories_list;}
  return $categories_list ;
}

function generate_sklads_list($sklad_id){
  $db = new active_records();
  $sklads_list = "";

  $info = $db->where("parent_id", $sklad_id)->get("sklads")->result();

  if(count($info) > 0){
    for($z=0;$z<count($info);$z++){
      $sklad_id = $info[$z]['id'];

      if($sklads_list != "") $sklads_list .=", ";
      $sklads_list .= $sklad_id;

      $sklads_list .= generate_categories_list($sklad_id);
    }
  }

  if($sklads_list != ""){$sklads_list = ", ".$sklads_list;}
  return $sklads_list ;
}

function eval_disable_func($formula){
  $disable_list = array();
  $disable_list[] = 'exit';
  $disable_list[] = 'eval';
  $disable_list[] = 'exit';
  $disable_list[] = 'mysql_affected_rows';
  $disable_list[] = 'mysql_client_encoding';
  $disable_list[] = 'mysql_close';
  $disable_list[] = 'mysql_connect';
  $disable_list[] = 'mysql_create_db';
  $disable_list[] = 'mysql_data_seek';
  $disable_list[] = 'mysql_db_name';
  $disable_list[] = 'mysql_db_query';
  $disable_list[] = 'mysql_drop_db';
  $disable_list[] = 'mysql_errno';
  $disable_list[] = 'mysql_error';
  $disable_list[] = 'mysql_escape_string';
  $disable_list[] = 'mysql_fetch_array';
  $disable_list[] = 'mysql_fetch_assoc';
  $disable_list[] = 'mysql_fetch_field';
  $disable_list[] = 'mysql_fetch_lengths';
  $disable_list[] = 'mysql_fetch_object';
  $disable_list[] = 'mysql_fetch_row';
  $disable_list[] = 'mysql_field_flags';
  $disable_list[] = 'mysql_field_len';
  $disable_list[] = 'mysql_field_name';
  $disable_list[] = 'mysql_field_seek';
  $disable_list[] = 'mysql_field_table';
  $disable_list[] = 'mysql_field_type';
  $disable_list[] = 'mysql_free_result';
  $disable_list[] = 'mysql_get_client_info';
  $disable_list[] = 'mysql_get_host_info';
  $disable_list[] = 'mysql_get_proto_info';
  $disable_list[] = 'mysql_get_server_info';
  $disable_list[] = 'mysql_info';
  $disable_list[] = 'mysql_insert_id';
  $disable_list[] = 'mysql_list_dbs';
  $disable_list[] = 'mysql_list_fields';
  $disable_list[] = 'mysql_list_processes';
  $disable_list[] = 'mysql_list_tables';
  $disable_list[] = 'mysql_num_fields';
  $disable_list[] = 'mysql_num_rows';
  $disable_list[] = 'mysql_pconnect';
  $disable_list[] = 'mysql_ping';
  $disable_list[] = 'mysql_query';
  $disable_list[] = 'mysql_real_escape_string';
  $disable_list[] = 'mysql_result';
  $disable_list[] = 'mysql_select_db';
  $disable_list[] = 'mysql_set_charset';
  $disable_list[] = 'mysql_stat';
  $disable_list[] = 'mysql_tablename';
  $disable_list[] = 'mysql_thread_id';
  $disable_list[] = 'mysql_unbuffered_query';
  $disable_list[] = 'basename';
  $disable_list[] = 'chgrp';
  $disable_list[] = 'chmod';
  $disable_list[] = 'chown';
  $disable_list[] = 'clearstatcache';
  $disable_list[] = 'copy';
  $disable_list[] = 'delete';
  $disable_list[] = 'dirname';
  $disable_list[] = 'disk_free_space';
  $disable_list[] = 'disk_total_space';
  $disable_list[] = 'diskfreespace';
  $disable_list[] = 'fclose';
  $disable_list[] = 'feof';
  $disable_list[] = 'fflush';
  $disable_list[] = 'fgetc';
  $disable_list[] = 'fgetcsv';
  $disable_list[] = 'fgets';
  $disable_list[] = 'fgetss';
  $disable_list[] = 'file_exists';
  $disable_list[] = 'file_get_contents';
  $disable_list[] = 'file_put_contents';
  $disable_list[] = 'file';
  $disable_list[] = 'fileatime';
  $disable_list[] = 'filectime';
  $disable_list[] = 'filegroup';
  $disable_list[] = 'fileinode';
  $disable_list[] = 'filemtime';
  $disable_list[] = 'fileowner';
  $disable_list[] = 'fileperms';
  $disable_list[] = 'filesize';
  $disable_list[] = 'filetype';
  $disable_list[] = 'flock';
  $disable_list[] = 'fnmatch';
  $disable_list[] = 'fopen';
  $disable_list[] = 'fpassthru';
  $disable_list[] = 'fputcsv';
  $disable_list[] = 'fputs';
  $disable_list[] = 'fread';
  $disable_list[] = 'fscanf';
  $disable_list[] = 'fseek';
  $disable_list[] = 'fstat';
  $disable_list[] = 'ftell';
  $disable_list[] = 'ftruncate';
  $disable_list[] = 'fwrite';
  $disable_list[] = 'glob';
  $disable_list[] = 'is_dir';
  $disable_list[] = 'is_executable';
  $disable_list[] = 'is_file';
  $disable_list[] = 'is_link';
  $disable_list[] = 'is_readable';
  $disable_list[] = 'is_uploaded_file';
  $disable_list[] = 'is_writable';
  $disable_list[] = 'is_writeable';
  $disable_list[] = 'lchgrp';
  $disable_list[] = 'lchown';
  $disable_list[] = 'link';
  $disable_list[] = 'linkinfo';
  $disable_list[] = 'lstat';
  $disable_list[] = 'mkdir';
  $disable_list[] = 'move_uploaded_file';
  $disable_list[] = 'parse_ini_file';
  $disable_list[] = 'parse_ini_string';
  $disable_list[] = 'pathinfo';
  $disable_list[] = 'pclose';
  $disable_list[] = 'popen';
  $disable_list[] = 'readfile';
  $disable_list[] = 'readlink';
  $disable_list[] = 'realpath_cache_get';
  $disable_list[] = 'realpath_cache_size';
  $disable_list[] = 'realpath';
  $disable_list[] = 'rename';
  $disable_list[] = 'rewind';
  $disable_list[] = 'rmdir';
  $disable_list[] = 'set_file_buffer';
  $disable_list[] = 'stat';
  $disable_list[] = 'symlink';
  $disable_list[] = 'tempnam';
  $disable_list[] = 'tmpfile';
  $disable_list[] = 'touch';
  $disable_list[] = 'umask';
  $disable_list[] = 'unlink';

  $disable_list[] = 'posix_access';
  $disable_list[] = 'posix_ctermid';
  $disable_list[] = 'posix_errno';
  $disable_list[] = 'posix_get_last_error';
  $disable_list[] = 'posix_getcwd';
  $disable_list[] = 'posix_getegid';
  $disable_list[] = 'posix_geteuid';
  $disable_list[] = 'posix_getgid';
  $disable_list[] = 'posix_getgrgid';
  $disable_list[] = 'posix_getgrnam';
  $disable_list[] = 'posix_getgroups';
  $disable_list[] = 'posix_getlogin';
  $disable_list[] = 'posix_getpgid';
  $disable_list[] = 'posix_getpgrp';
  $disable_list[] = 'posix_getpid';
  $disable_list[] = 'posix_getppid';
  $disable_list[] = 'posix_getpwnam';
  $disable_list[] = 'posix_getpwuid';
  $disable_list[] = 'posix_getrlimit';
  $disable_list[] = 'posix_getsid';
  $disable_list[] = 'posix_getuid';
  $disable_list[] = 'posix_initgroups';
  $disable_list[] = 'posix_isatty';
  $disable_list[] = 'posix_kill';
  $disable_list[] = 'posix_mkfifo';
  $disable_list[] = 'posix_mknod';
  $disable_list[] = 'posix_setegid';
  $disable_list[] = 'posix_seteuid';
  $disable_list[] = 'posix_setgid';
  $disable_list[] = 'posix_setpgid';
  $disable_list[] = 'posix_setsid';
  $disable_list[] = 'posix_setuid';
  $disable_list[] = 'posix_strerror';
  $disable_list[] = 'posix_times';
  $disable_list[] = 'posix_ttyname';
  $disable_list[] = 'posix_uname';

  $disable_list[] = 'shmop_close';
  $disable_list[] = 'shmop_delete';
  $disable_list[] = 'shmop_open';
  $disable_list[] = 'shmop_read';
  $disable_list[] = 'shmop_size';
  $disable_list[] = 'shmop_write';

  $disable_list[] = 'ftok';
  $disable_list[] = 'msg_get_queue';
  $disable_list[] = 'msg_queue_exists';
  $disable_list[] = 'msg_receive';
  $disable_list[] = 'msg_remove_queue';
  $disable_list[] = 'msg_send';
  $disable_list[] = 'msg_set_queue';
  $disable_list[] = 'msg_stat_queue';
  $disable_list[] = 'sem_acquire';
  $disable_list[] = 'sem_get';
  $disable_list[] = 'sem_release';
  $disable_list[] = 'sem_remove';
  $disable_list[] = 'shm_attach';
  $disable_list[] = 'shm_detach';
  $disable_list[] = 'shm_get_var';
  $disable_list[] = 'shm_has_var';
  $disable_list[] = 'shm_put_var';
  $disable_list[] = 'shm_remove_var';
  $disable_list[] = 'shm_remove';
  $disable_list[] = 'Threaded';
  $disable_list[] = 'Thread';
  $disable_list[] = 'Worker';
  $disable_list[] = 'Modifiers';
  $disable_list[] = 'Mutex';
  $disable_list[] = 'Cond';
  $disable_list[] = 'escapeshellarg';
  $disable_list[] = 'escapeshellcmd';
  $disable_list[] = 'exec';
  $disable_list[] = 'passthru';
  $disable_list[] = 'proc_close';
  $disable_list[] = 'proc_get_status';
  $disable_list[] = 'proc_nice';
  $disable_list[] = 'proc_open';
  $disable_list[] = 'proc_terminate';
  $disable_list[] = 'shell_exec';
  $disable_list[] = 'system';
  $disable_list[] = 'pcntl_alarm';
  $disable_list[] = 'pcntl_errno';
  $disable_list[] = 'pcntl_exec';
  $disable_list[] = 'pcntl_fork';
  $disable_list[] = 'pcntl_get_last_error';
  $disable_list[] = 'pcntl_getpriority';
  $disable_list[] = 'pcntl_setpriority';
  $disable_list[] = 'pcntl_signal_dispatch';
  $disable_list[] = 'pcntl_signal';
  $disable_list[] = 'pcntl_sigprocmask';
  $disable_list[] = 'pcntl_sigtimedwait';
  $disable_list[] = 'pcntl_sigwaitinfo';
  $disable_list[] = 'pcntl_strerror';
  $disable_list[] = 'pcntl_wait';
  $disable_list[] = 'pcntl_waitpid';
  $disable_list[] = 'pcntl_wexitstatus';
  $disable_list[] = 'pcntl_wifexited';
  $disable_list[] = 'pcntl_wifsignaled';
  $disable_list[] = 'pcntl_wifstopped';
  $disable_list[] = 'pcntl_wstopsig';
  $disable_list[] = 'pcntl_wtermsig';

  $disable_list[] = 'event_add';
  $disable_list[] = 'event_base_free';
  $disable_list[] = 'event_base_loop';
  $disable_list[] = 'event_base_loopbreak';
  $disable_list[] = 'event_base_loopexit';
  $disable_list[] = 'event_base_new';
  $disable_list[] = 'event_base_priority_init';
  $disable_list[] = 'event_base_set';
  $disable_list[] = 'event_buffer_base_set';
  $disable_list[] = 'event_buffer_disable';
  $disable_list[] = 'event_buffer_enable';
  $disable_list[] = 'event_buffer_fd_set';
  $disable_list[] = 'event_buffer_free';
  $disable_list[] = 'event_buffer_new';
  $disable_list[] = 'event_buffer_priority_set';
  $disable_list[] = 'event_buffer_read';
  $disable_list[] = 'event_buffer_set_callback';
  $disable_list[] = 'event_buffer_timeout_set';
  $disable_list[] = 'event_buffer_watermark_set';
  $disable_list[] = 'event_buffer_write';
  $disable_list[] = 'event_del';
  $disable_list[] = 'event_free';
  $disable_list[] = 'event_new';
  $disable_list[] = 'event_set';

  $disable_list[] = 'expect_expectl';
  $disable_list[] = 'expect_popen';

  $disable_list[] = 'eio_busy';
  $disable_list[] = 'eio_cancel';
  $disable_list[] = 'eio_chmod';
  $disable_list[] = 'eio_chown';
  $disable_list[] = 'eio_close';
  $disable_list[] = 'eio_custom';
  $disable_list[] = 'eio_dup2';
  $disable_list[] = 'eio_event_loop';
  $disable_list[] = 'eio_fallocate';
  $disable_list[] = 'eio_fchmod';
  $disable_list[] = 'eio_fchown';
  $disable_list[] = 'eio_fdatasync';
  $disable_list[] = 'eio_fstat';
  $disable_list[] = 'eio_fstatvfs';
  $disable_list[] = 'eio_fsync';
  $disable_list[] = 'eio_ftruncate';
  $disable_list[] = 'eio_futime';
  $disable_list[] = 'eio_get_event_stream';
  $disable_list[] = 'eio_get_last_error';
  $disable_list[] = 'eio_grp_add';
  $disable_list[] = 'eio_grp_cancel';
  $disable_list[] = 'eio_grp_limit';
  $disable_list[] = 'eio_grp';
  $disable_list[] = 'eio_init';
  $disable_list[] = 'eio_link';
  $disable_list[] = 'eio_lstat';
  $disable_list[] = 'eio_mkdir';
  $disable_list[] = 'eio_mknod';
  $disable_list[] = 'eio_nop';
  $disable_list[] = 'eio_npending';
  $disable_list[] = 'eio_nready';
  $disable_list[] = 'eio_nreqs';
  $disable_list[] = 'eio_nthreads';
  $disable_list[] = 'eio_open';
  $disable_list[] = 'eio_poll';
  $disable_list[] = 'eio_read';
  $disable_list[] = 'eio_readahead';
  $disable_list[] = 'eio_readdir';
  $disable_list[] = 'eio_readlink';
  $disable_list[] = 'eio_realpath';
  $disable_list[] = 'eio_rename';
  $disable_list[] = 'eio_rmdir';
  $disable_list[] = 'eio_sendfile';
  $disable_list[] = 'eio_set_max_idle';
  $disable_list[] = 'eio_set_max_parallel';
  $disable_list[] = 'eio_set_max_poll_reqs';
  $disable_list[] = 'eio_set_max_poll_time';
  $disable_list[] = 'eio_set_min_parallel';
  $disable_list[] = 'eio_stat';
  $disable_list[] = 'eio_statvfs';
  $disable_list[] = 'eio_symlink';
  $disable_list[] = 'eio_sync_file_range';
  $disable_list[] = 'eio_sync';
  $disable_list[] = 'eio_syncfs';
  $disable_list[] = 'eio_truncate';
  $disable_list[] = 'eio_unlink';
  $disable_list[] = 'eio_utime';
  $disable_list[] = 'eio_write';
  $disable_list[] = '$$';
  $disable_list[] = '$($';

  for($z=0;$z<count($disable_list);$z++){
    $formula = str_replace($disable_list[$z], '', $formula);
  }

  $formula = str_replace('<br>',  "\n", $formula);
  $formula = str_replace('<br/>', "\n", $formula);
  $formula = str_replace('
',"\n", $formula);

  $formula = str_replace('$',  '$'.'system_', $formula);

  return $formula;
}



function generate_review_and_price($session_data, $main_tovar_id, $prod_name, $order_id){
  $product_prices = array();

  global $gl_session;
  $html_page = "";
  $db = new active_records();
  $products_all = $db->where("id", $main_tovar_id)->get("products")->result();

	
  $current_tovar = $db->where("id",$main_tovar_id)->get("products")->result();
  $current_cat =  $db->where("id",$current_tovar[0]['category_id'])->get("categories")->result();

  /*
  $product_category = $current_cat[0]['name'];
  $parent_id = $current_cat[0]['parent_id'];
  while($parent_id>0){
    $cat_id= $db->where("id",$parent_id)->get("categories")->result();
    $product_category = $cat_id[0]['name']."=>".$product_category;
    $parent_id = $cat_id[0]['parent_id'];
  }
*/
  $izdeliya_info = "";
  
  if(count($session_data[$main_tovar_id]['option'])>0){
    $html_page .= "Поля:<br>";
	
	//print_r($session_data[$main_tovar_id]['option']);
    foreach ($session_data[$main_tovar_id]['option'] as $kod=>$opt_id){
      $cur_opt = $db->where("kod",$kod)->where("products_id",$main_tovar_id)->get("products_options")->result();

      if($cur_opt[0]['formula'] != ""){
        $formula = "<?php ";
        foreach ($session_data[$main_tovar_id]['option'] as $k=>$o){
          $c_o = $db->where("kod",$k)->where("products_id",$main_tovar_id)->get("products_options")->result();
          if($c_o[0]['formula'] == ""){
            $formula .= '$'.$k."=".$o.";";
          }
        }
        $formula .= $cur_opt[0]['formula'].' echo $'.$kod.';'." ?>";

        $formula = eval_disable_func($formula);

        echo $formula;

        ob_start();
        eval('?'.'>'.$formula);
        $opt_id = ob_get_contents();
        ob_end_clean();
      }else{
        $kod = 'system_'.$kod;
        $$kod = $opt_id;
      }

      $izdeliya_info .= "<strong>".$cur_opt[0]['name']." : ".$$kod."</strong>"."<br>";

    }
  }

  $summa = 0;
  $summa_rozniza=0;
  $details = "";
  $products_list = array();



  if(count($session_data[$main_tovar_id]['category'])>0){
    foreach ($session_data[$main_tovar_id]['category'] as $item=>$tovar_id){
      if($tovar_id>0){
        $cur_tovar = $db->where("id",$tovar_id)->get("izdelie_categories")->result();
        $parent_id = $cur_tovar[0]['parent_id'];

        do{
          $category_info = $db->where("id",$parent_id)->get("izdelie_categories")->result();
          $parent_id = $category_info[0]['parent_id'];

          if($parent_id == 0){
            $products_list[$category_info[0]['id']][] = $tovar_id;
            break;
          }
        }while(1);
      }
    }

    foreach($products_list as $category_id=>$products){
      $category_info = $db->where("id",$category_id)->get("izdelie_categories")->result();
      $details .= "<tr><th></th><th><strong>".$category_info[0]['name']."</strong></th><th></th><th></th><th></th></tr>";

      $num = 1;
      for($z=0;$z<count($products);$z++){
        if(isset($session_data[$main_tovar_id]['product'][$products[$z]])){
          $product_id = $session_data[$main_tovar_id]['product'][$products[$z]][0];
          if($product_id > 0){
            $info = $db->where("id",$product_id)->get("products")->result();
            $category_data = $db->where("id",$products[$z])->get("izdelie_categories")->result();


            $category_1 = $db->where("id",$info[0]['category_id'])->get("categories")->result();
            $nacenka = $category_1[0]['nacenka'];
            if($category_1[0]['nacenka']=="" || $category_1[0]['nacenka']==0){
              $category_2 = $db->where("id",$category_1[0]['parent_id'])->get("categories")->result();
              $nacenka = $category_2[0]['nacenka'];

              if($category_2[0]['nacenka']=="" || $category_2[0]['nacenka']==0){
                $category_3 = $db->where("id",$category_2[0]['parent_id'])->get("categories")->result();
                $nacenka = $category_3[0]['nacenka'];
                if($category_3[0]['nacenka']=="" || $category_3[0]['nacenka']==0){
                  $category_4 = $db->where("id",$category_3[0]['parent_id'])->get("categories")->result();
                  $nacenka = $category_4[0]['nacenka'];
                  if($category_4[0]['nacenka']=="" || $category_4[0]['nacenka']==0){
                    $nacenka = 1;
                  }
                }
              }
            }

            $category_list = "";
            $category_izdeliya_id = $parent_id = $products[$z];
            do{
              $category_info = $db->where("id",$parent_id)->get("izdelie_categories")->result();
              $parent_id = $category_info[0]['parent_id'];

              if($parent_id != 0){
                if($category_list != "") $category_list = ">".$category_list;

                $category_list = $category_info[0]['name'].$category_list;
              }
            }while($parent_id != 0);


            if(strpos($category_data[0]["kolichestvo"], '$') !== false){
              $kol_formula = "<?php ";
              $kol_formula .= $category_data[0]["kolichestvo"].' echo $kol;'." ?>";

              $kol_formula = eval_disable_func($kol_formula);

              ob_start();
              eval('?'.'>'.$kol_formula);
              $category_data[0]["kolichestvo"] = ob_get_contents();
              ob_end_clean();
            }



            $rozn_cena = $info[0]['price']+$info[0]['price']*$nacenka/100;
            /*$rozn_cena_2 = $info[0]['price']*$category_data[0]["kolichestvo"]+$info[0]['price']*$category_data[0]["kolichestvo"]*$nacenka/100;*/

            if($zakaz == 1){
              $db->set("zakazano +",$category_data[0]["kolichestvo"])->where("id", $product_id)->update("products");
            }
            if($zakaz == 2){
              $db->set('cnt -', $category_data[0]["kolichestvo"])->set("zakazano -",$category_data[0]["kolichestvo"])->where("id", $product_id)->update("products");
            }

            $i = calc_price($info[0]['price'], $info[0]['currency'],$gl_session["session_data"]['valyta']);
            $price = $i['price'];

            $i = calc_price($rozn_cena, $info[0]['currency'],$gl_session["session_data"]['valyta']);
            $rozn_cena = $i['price'];
            $rozn_cena_2 = $rozn_cena * $category_data[0]["kolichestvo"];

            $product_prices["data"][$info[0]['id']] = array("z"=>$price,"r"=>$rozn_cena,"v"=>$gl_session["session_data"]['valyta']);
            if(isset($session_data['product_prices']['data'][$info[0]['id']])){
              $price = $session_data['product_prices']['data'][$info[0]['id']]['z'];
              $rozn_cena = $session_data['product_prices']['data'][$info[0]['id']]['r'];
              $gl_session["session_data"]['valyta'] = $session_data['product_prices']['data'][$info[0]['id']]['v'];
            }


            $zak_price = "";
            $zak_total = "";
            if($gl_session["session_data"]['zak_price']==1){
              $zak_price = "Зак: ".(round($price,2))."<br>";
              $zak_total = "Зак: ".(round($price*$category_data[0]["kolichestvo"],2))."<br>";
            }

            /*del category path*/
            $category_list = "";

            $details .=
              "<tr>
               <th>".($num++)."</th>
 <th>".$category_list.$info[0]['name']."</th>
 <th>".$category_data[0]["kolichestvo"]."</th>
 <th>".$zak_price.(round($rozn_cena,2))."</th>
 <th>".$zak_total.(round($rozn_cena_2,2))."</th>
</tr>";

            $summa += $price*$category_data[0]["kolichestvo"];
            $summa_rozniza += $rozn_cena_2;
          }
        }
      }
    }
	
    if($products_all[0]['izdelie_type'] != 0){
      $details .=
        "<tr>
         <th colspan='5' style='text-align:center;'>Изделия</th>
    </tr>";

	
      $num = 1;
      for($n=0;$n<count($session_data[$main_tovar_id]['izdelie']);$n++){
        $info = $db->where("id",$session_data[$main_tovar_id]['izdelie'][$n])->get("products")->result();

        $category_list = "";
        $parent_id = $info[0]['izdelie_categories_id'];
        do{
          $category_info = $db->where("id",$parent_id)->get("izdelie_categories")->result();
          $parent_id = $category_info[0]['parent_id'];

          if($parent_id != 0){
            if($category_list != "") $category_list = ">".$category_list;

            $category_list = $category_info[0]['name'].$category_list;
          }
        }while($parent_id != 0);

        $info = calc_price($info[0]['price'], $info[0]['currency'],$gl_session["session_data"]['valyta']);
        $price = $info['price'];

		/*
        $details .=
          "<tr>
           <th>".($num++)."</th>
			 <th>".$category_list.">".$info[0]['name']."</th>
			 <th>1</th>
			 <th>".(round($price,2))."</th>
			 <th>".(round($price,2))."</th>
			</tr>";
		*/
      }

      $zak_price = "";
      if($gl_session["session_data"]['zak_price']==1){
        $zak_price = "Зак.".$summa."<br>";
      }

      $details .=
        "<tr>
         <th>-</th>
         <th>-</th>
         <th>-</th>
         <th>Итого:</th>
         <th>".$zak_price."Розн.".(round($summa_rozniza,2))."</th>
</tr>";
    }

  }

  $info = calc_price($current_tovar[0]['price'], $current_tovar[0]['currency'],$gl_session["session_data"]['valyta']);
  $total = $summa + $info['price'];

  $client_info = "";
  if(arg(2) == "1"){
    $tovar_id = arg(1);
    $client_db = $db->where("order_products.id",$tovar_id)->where("order_products.order_id","orders.id",1)->where("orders.client_id","clients.id",1)->select("clients.fio as fio,clients.email as email,clients.telephone1 as telephone1,clients.telephone as telephone,clients.telephone2 as telephone2,order_products.product_id as product_id")->get("order_products, orders,clients")->result();
    $client_info = "<br><br>".$client_db[0]['fio']."<br>".$client_db[0]['email']."<br>".$client_db[0]['telephone']."<br>".$client_db[0]['telephone1']."<br>".$client_db[0]['telephone1'];
  }
  $product = $db->where("id",$main_tovar_id)->get("products")->result();

  $category_1 = $db->where("id",$product[0]['category_id'])->get("categories")->result();
  $nacenka = $category_1[0]['nacenka'];
  if($category_1[0]['nacenka']=="" || $category_1[0]['nacenka']==0){
    $category_2 = $db->where("id",$category_1[0]['parent_id'])->get("categories")->result();
    $nacenka = $category_2[0]['nacenka'];

    if($category_2[0]['nacenka']=="" || $category_2[0]['nacenka']==0){
      $category_3 = $db->where("id",$category_2[0]['parent_id'])->get("categories")->result();
      $nacenka = $category_3[0]['nacenka'];
      if($category_3[0]['nacenka']=="" || $category_3[0]['nacenka']==0){
        $category_4 = $db->where("id",$category_3[0]['parent_id'])->get("categories")->result();
        $nacenka = $category_4[0]['nacenka'];
        if($category_4[0]['nacenka']=="" || $category_4[0]['nacenka']==0){
          $nacenka = 1;
        }
      }
    }
  }
  $current_rozniza = $current_tovar[0]['price']+$current_tovar[0]['price']*$nacenka/100;
  $info = calc_price($current_rozniza, $current_tovar[0]['currency'],$gl_session["session_data"]['valyta']);
  $current_rozniza = $info['price'];

  $rozn_cena = $current_rozniza + $summa_rozniza;

  $info = calc_price($current_tovar[0]['price'], $current_tovar[0]['currency'],$gl_session["session_data"]['valyta']);
  $current_tovar[0]['price'] = $info['price'];

  if($zakaz == 1 && $product[0]['izdelie'] == 0){
    $db->set("zakazano +",$session_data[$main_tovar_id]['qty'])->where("id", $main_tovar_id)->update("products");
  }
  if($zakaz == 2 && $product[0]['izdelie'] == 0){
    $db->set('cnt -', $session_data[$main_tovar_id]['qty'])->set("zakazano -",$session_data[$main_tovar_id]['qty'])->where("id", $main_tovar_id)->update("products");
/*
    $data = array(
      'company_id' => $gl_session["session_data"]['company_id'],
      'product_id' => $main_tovar_id,
      'quantity' => $session_data[$main_tovar_id]['qty'],
      'operation_date' => date('Y-m-d H:i:s'),
      'user_id' => $gl_session["session_data"]['user_id'],
      'order_id' => $order_id,
      'price' => $current_rozniza,
    );
    $this->db->insert("spisanie",$data);
*/
  }

  $product_prices["header"] = array("z"=>$current_tovar[0]['price'],"r"=>$current_rozniza,"v"=>$gl_session["session_data"]['valyta']);

  if(isset($session_data['product_prices']['header'])){
    $current_tovar[0]['price'] = $session_data['product_prices']['header']['z'];
    $current_rozniza = $session_data['product_prices']['header']['r'];
    $gl_session["session_data"]['valyta'] = $session_data['product_prices']['header']['v'];
  }

  $zak_price = "";
  $zak_total = "";
  if($gl_session["session_data"]['zak_price']==1){
    $zak_price = " (".$current_tovar[0]['price']." ".$gl_session["session_data"]['valyta'].")<br>";
    $zak_total = $total." ".$gl_session["session_data"]['valyta'];
  }

  $outlet_name = $db->select("torgovye_tochki.name")->where("orders.id", $order_id)->where("orders.torgovaya_tochka_id","torgovye_tochki.id",1)->get('orders,torgovye_tochki')->result();
  $manager = $db->where("orders.id",$order_id)->where("orders.manager_id","users.id",1)->select("users.first_name,users.last_name")->get("orders,users")->result();
  $order_date = $db->select("order_date")->where("id", $order_id)->get('orders')->result();

  
  $html_page = "<table class='table table-bordered' style='width:600px;'>
	<tr>
		<th>№</th>
		<th colspan='2'>Торговая Точка</th>
		<th>Пользователь</th>
		<th>Дата</th>
	</tr>
	<tr>
		<th>$order_id</th>
		<th colspan='2'>".$outlet_name[0]['name']."</th>
		<th>".$manager[0]['first_name']." ".$manager[0]['last_name']."</th>
		<th>".$order_date[0]['order_date']."</th>
	</tr>
 <tr>
  <td colspan='3'><strong>Контакты Клиента:</strong>".$client_info."</td>
  <td colspan='2'><b>".$prod_name.$zak_price."<br>Стоимость: ".$current_rozniza."</b></td>
 </tr>
 <tr>
  <td colspan='3'><strong>Данные о изделии:</strong><br><br>".$izdeliya_info."</td>
  <td colspan='2'><strong>Описание Товара:</strong><br>".$current_tovar[0]['description']."</td>
 </tr>
 <tr>
	<th>№</th>
	<th>Наименование</th>
	<th>Кол-во</th>
	<th>Цена</th>
	<th>Сумма</th>
 </tr>
 ".$details."
  <tr>
  <td colspan='5'><strong>Итого к оплате: : ".(round($zak_total,2))." Розничная цена: ".(round($rozn_cena,2))." ".$gl_session["session_data"]['valyta']."</strong></td>
 </tr>
</table>";

  return array("html_page"=>$html_page, "total"=>$total, "rozn_total"=>$rozn_cena, "product_prices"=>$product_prices);
}
?>