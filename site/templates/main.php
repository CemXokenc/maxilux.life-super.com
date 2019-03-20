<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    <title>Blank Page - Canvas Admin</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="">
	<meta name="author" content="" />

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,800italic,400,600,800" type="text/css">
	<link rel="stylesheet" href="<?php echo $site_variables["template_dir"]; ?>css/font-awesome.min.css" type="text/css" />		
	<link rel="stylesheet" href="<?php echo $site_variables["template_dir"]; ?>css/bootstrap.min.css" type="text/css" />	
	<link rel="stylesheet" href="<?php echo $site_variables["template_dir"]; ?>js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css" type="text/css" />		

	<link rel="stylesheet" href="<?php echo $site_variables["template_dir"]; ?>css/App.css" type="text/css" />

	<link rel="stylesheet" href="<?php echo $site_variables["template_dir"]; ?>css/custom.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $site_variables["template_dir"]; ?>js/plugins/datepicker/datepicker.css" type="text/css" />
	
	<script src="<?php echo $site_variables["template_dir"]; ?>js/libs/jquery-1.9.1.min.js"></script>
    <script src="<?php echo $site_variables["template_dir"]; ?>js/libs/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="<?php echo $site_variables["template_dir"]; ?>js/libs/bootstrap.min.js"></script>
        <script src="<?php echo $site_variables["template_dir"]; ?>chosen/prism.js"></script>
        <script src="<?php echo $site_variables["template_dir"]; ?>chosen/price.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>

    <link rel="stylesheet" href="<?php echo $site_variables["template_dir"]; ?>chosen/prism.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $site_variables["template_dir"]; ?>chosen/price.css" type="text/css" />
    <!--<link rel="stylesheet" href="<?php echo $site_variables["template_dir"]; ?>chosen/style.css" type="text/css" />..-->
	
</head>

<body style="margin:0px 0;">

<div id="wrapper">
	
	<header id="header">

		<h1 id="site-logo">
			<a href="./index.html">
				<img src="<?php echo $site_variables["template_dir"]; ?>img/logos/logo.png" alt="Site Logo" />
			</a>
		</h1>	

		<a href="javascript:;" data-toggle="collapse" data-target=".top-bar-collapse" id="top-bar-toggle" class="navbar-toggle collapsed">
			<i class="fa fa-cog"></i>
		</a>

		<a href="javascript:;" data-toggle="collapse" data-target=".sidebar-collapse" id="sidebar-toggle" class="navbar-toggle collapsed">
			<i class="fa fa-reorder"></i>
		</a>

	</header> <!-- header -->


	<nav id="top-bar" class="collapse top-bar-collapse">

		<ul class="nav navbar-nav pull-left">
			<li class="">
				<a href="<?php echo $site_variables["home_url"]; ?>">
					<i class="fa fa-home"></i> 
					Главная
				</a>
			</li>	
			<li class="">
				<a href="javascript:void(0);" onclick="history.go(-1);">
					<i class="fa fa-home"></i> 
					< Вернуться назад
				</a>
			</li>	
		    
		</ul>

        <?php if( isset($site_variables["session_var_user_id"]) ){ ?>
        	
         <ul class="nav navbar-nav pull-right">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
					<i class="fa fa-user"></i>
		        	<?php echo $site_variables["session_var_first_name"]; ?> <?php echo $site_variables["session_var_last_name"]; ?>
		        	<span class="caret"></span>
		    	</a>

		    	<ul class="dropdown-menu" role="menu">
			       
                                 <li>
			        	<a href="<?php echo $site_variables["profile_url"]; ?>">
			        		<i class="fa fa-user"></i> 
			        		  Мой профиль
			        	</a>
			        </li>
                                 <li>
			        	<a href="<?php echo $site_variables["messages_url"]; ?>">
			        		<i class="fa fa-envelope"></i>
			        		  Переписка
			        	</a>
			        </li>
                                 <li>
			        	<a href="<?php echo $site_variables["tasks_url"]; ?>">
			        		<i class="fa fa-check-square-o"></i>
			        		  Мои задачи
			        	</a>
			        </li>
			        <li>
			        	<a href="<?php echo $site_variables["create_article_url"]; ?>">
			        		<i class="fa fa-calendar"></i> 
			        		  Добавить статью
			        	</a>
			        </li>
			        <li>
			        	<a href="<?php echo $site_variables["edit_profile_url"]; ?>">
			        		<i class="fa fa-cogs"></i> 
			        		  Настройки
			        	</a>
			        </li>
			        <li class="divider"></li>
			        <li>
			        	<a href="<?php echo $site_variables["logout_url"]; ?>">
			        		<i class="fa fa-sign-out"></i> 
			        		  Выход
			        	</a>
			        </li>
		    	</ul>
		    </li>
		</ul>
        <?php if( count($site_variables["groups"])>0){ ?>        
         <ul class="nav navbar-nav pull-right">
                        <li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
					<i class="fa fa-user"></i>
		        	    Выбрать группу
		        	<span class="caret"></span>
		    	</a>

		    	<ul class="dropdown-menu" role="menu">
			       <?php foreach($site_variables["groups"] as $site_variables["group"]){ ?>
                                   <li><a href="javascript:void(0);" onclick="switch_group('<?php echo $site_variables["group"]["id"]; ?>');"><?php echo $site_variables["group"]["nikname"]; ?></a></li>
                                 <?php } ?>
		    	</ul>
		    </li>
		</ul>
<?php } ?>
        <?php }else{ ?>
      <ul class="nav navbar-nav pull-right">
			<li class="">
				<a href="<?php echo $site_variables["login_url"]; ?>">
					<i class="fa fa-user"></i> 
					 Зарегистрироваться/Войти на сайт
				</a>
			</li>	
        <?php } ?>
          <?php if( count($site_variables["admin_users"])>0){ ?>        
         <ul class="nav navbar-nav pull-right">
                        <li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
					<i class="fa fa-user"></i>
		        	Выбрать пользователя
		        	<span class="caret"></span>
		    	</a>

		    	<ul class="dropdown-menu" role="menu">
			       <?php foreach($site_variables["admin_users"] as $site_variables["user"]){ ?>
                               <li><a href="javascript:void(0);" onclick="switch_user('<?php echo $site_variables["user"]["id"]; ?>');"><?php if( $site_variables["user"]["is_group"] == 0){ ?><?php echo $site_variables["user"]["first_name"]; ?> <?php echo $site_variables["user"]["last_name"]; ?><?php }else{ ?><?php echo $site_variables["user"]["nikname"]; ?><?php } ?></a></li>
                                 <?php } ?>
		    	</ul>
		    </li>
		</ul>

<?php } ?>
     
	</nav> <!-- /#top-bar -->


    <?php echo $site_variables["site_smarty_content"]; ?>
	

	
</div> <!-- #wrapper -->

<footer id="footer">
	<ul class="nav pull-right">
		<li>
			Copyright © 2013, Jumpstart Themes.
		</li>
	</ul>
</footer>

<script type="text/javascript">
	 function switch_user(user_id){					    
         $('#switch_user_id').val(user_id);
	 $('#switch_user').submit();							   
	 }

         function switch_group(group_id){					    
         $('#switch_group_id').val(group_id);
	 $('#switch_group').submit();							   
	 }
</script>
<form id="switch_user" method="post" action="">
      <input type="hidden" name="do" value="switch_user" />
      <input type="hidden" id ="switch_user_id" name="switch_user_id" value="0" />
 </form>

<form id="switch_group" method="post" action="">
      <input type="hidden" name="do" value="switch_group" />
      <input type="hidden" id ="switch_group_id" name="switch_group_id" value="0" />
 </form>
</body>
</html>

<script src="<?php echo $site_variables["template_dir"]; ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo $site_variables["template_dir"]; ?>js/plugins/autosize/jquery.autosize.min.js"></script>
<script src="<?php echo $site_variables["template_dir"]; ?>js/plugins/textarea-counter/jquery.textarea-counter.js"></script>
<script src="<?php echo $site_variables["template_dir"]; ?>js/App.js"></script>
<script src="<?php echo $site_variables["template_dir"]; ?>js/demos/form-extended.js"></script>
<script type="text/javascript">
  $(".chosen-select").chosen({no_results_text: "Отсутствуют данные!"});
</script>

