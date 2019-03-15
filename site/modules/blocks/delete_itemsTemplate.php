<form class="form-horizontal" method="post">
 <input type="hidden" name="do" value="login"/>
 <div class="heading">
  <h4 class="form-heading">Вход</h4>
 </div>                          
 <div class="control-group">
  <label class="control-label" for="inputUsername">Емеил</label>
  <div class="controls">
   <input type="text" name="user" id="inputUsername" placeholder="Емели">
  </div>
 </div>
 <div class="control-group">
  <label class="control-label" for="inputPassword">Пароль</label>
  <div class="controls">
   <input type="password" name="pass" id="inputPassword" placeholder="Мин. <?php echo $site_variables["min_pass_len"]; ?> символов">
  </div>
 </div>
 <div class="control-group">
  <div class="controls">           
   <button type="submit" class="btn btn-success">Войти</button>
  </div>
 </div>	
 <?php if( $site_variables["login_error"] ){ ?>
 <div class="alert alert-error">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Доступ запрещен. </strong> Неверный логин или пароль.
 </div>
 <?php } ?>
</form>

