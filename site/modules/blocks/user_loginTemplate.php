<div id="login" style='background-image: url("http://maxilux.life-super.com//site/templates//logo.jpg");'>

		<h3>Компания Maxilux приветствует Вас!</h3>

		<h5>Введите данные для входа.</h5> 
		
		<?php if( !empty($site_variables["login_error"])){ ?>
	    <div class="alert-danger">
	     <button type="button" class="close" data-dismiss="alert">×</button>
	     <strong>Доступ запрещен. </strong> Неверный логин или пароль.
	    </div>
	    <?php } ?>

		<form id="login-form" action="" class="form" method="post">
            <input type="hidden" name="do" value="login" />
            
			<div class="form-group">
				<label for="login-username">E-mail</label>
				<input name="user" type="text" class="form-control" id="login-username" placeholder="E-mail / Имя Пользователя">
			</div>

			<div class="form-group">
				<label for="login-password">Пароль</label>
				<input name="pass" type="password" class="form-control" id="login-password" placeholder="Пароль">
			</div>

			<div class="form-group">

				<button type="submit" id="login-btn" class="btn btn-primary btn-block">Войти   <i class="fa fa-play-circle"></i></button>

			</div>
		</form>


		<a href="javascript:;" class="btn btn-default">Восстановить пароль?</a>

	</div> <!-- /#login -->

	<a href="register.html" id="signup-btn" class="btn btn-lg btn-block">
		Зарегистрироваться
	</a>

