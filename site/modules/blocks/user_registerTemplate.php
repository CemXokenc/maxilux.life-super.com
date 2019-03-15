<div id="logo">
		<a href="http://preview.jumpstartthemes.com/canvas-admin/login.html">
			<img src="http://preview.jumpstartthemes.com/canvas-admin/img/logos/logo-login.png" alt="Logo" />
		</a>
	</div>

	<div id="login">

		<h3>Система управления цехом.</h3>

		<h5>Введите данные для регистрации.</h5> 
		
		<?php if( $site_variables["register_ok"] == 1){ ?>	
		 <div class="alert alert-info">
		     <button type="button" class="close" data-dismiss="alert">×</button>
		     <strong>Поздравляем!</strong> Спасибо за регистрацию.
		 </div>
		<?php } ?>
		<?php if( count($site_variables["register_errors"]) != 0){ ?>
		  <?php if( is_array($site_variables["register_errors"])){ ?>
		   <?php foreach($site_variables["register_errors"] as $site_variables["errortext"]){ ?>
		    <div class="alert alert-error">
		     <button type="button" class="close" data-dismiss="alert">×</button>
		     <strong>Ошибка. </strong> <?php echo $site_variables["errortext"]; ?>.
		    </div>
		   <?php } ?>
		  <?php } ?>
		<?php } ?>

		<form id="login-form" action="" class="form" method="post">
            <input type="hidden" name="do" value="register"/>
            
			<div class="form-group">
				<label for="login-username">Имя</label>
				<input <?php if( !empty($site_variables["first_name"]) && $site_variables["register_ok"] != 1){ ?>value="<?php echo $site_variables["first_name"]; ?>"<?php } ?> type="text" name="first_name" type="text" class="form-control" id="login-username" placeholder="Имя">
			</div>    
			
			<div class="form-group">
				<label for="login-username">Фамилия</label>
				<input <?php if( !empty($site_variables["last_name"]) && $site_variables["register_ok"] != 1){ ?>value="<?php echo $site_variables["last_name"]; ?>"<?php } ?> type="text" name="last_name" class="form-control" id="login-username" placeholder="Фамилия">
			</div> 

            <div class="form-group">
				<label for="login-username">Емеил</label>
				<input <?php if( !empty($site_variables["email"]) && $site_variables["register_ok"] != 1){ ?>value="<?php echo $site_variables["email"]; ?>"<?php } ?> type="text" id="inputEmail" name="email" class="form-control" id="login-username" placeholder="Емеил/Имя пользователя">
			</div>                     

			<div class="form-group">
				<label for="login-password">Пароль</label>
				<input type="password" name="pass" class="form-control" id="login-password" placeholder="Пароль">
			</div>
			
			<div class="form-group">
				<label for="login-password">Подтверждение пароля</label>
				<input type="password" name="pass_repeat" class="form-control" id="login-password" placeholder="Подтверждение пароля">
			</div>                                
                       	<div class="form-group">
				<label for="login-password">Название компании</label>
				<input type="text" name="company" class="form-control" placeholder="Название компании">
			</div>     
                     
			<div class="form-group">

				<button type="submit" id="login-btn" class="btn btn-primary btn-block">Регистрация   <i class="fa fa-play-circle"></i></button>

			</div>
		</form>

	</div> <!-- /#login -->

