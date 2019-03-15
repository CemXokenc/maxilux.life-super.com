<div id="sidebar-wrapper" class="collapse sidebar-collapse">
  <div id="search">
    <form>
      <input class="form-control input-sm" type="text" name="search" placeholder="Search..." />
      <button type="submit" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
    </form>
  </div> <!-- #search -->
  <nav id="sidebar">
    <ul id="main-nav" class="open-active">
      <!--
      <?php if( isset($site_variables["manage_categories"]) ){ ?><li><a href="<?php echo $site_variables["manage_categories"]; ?>"><i class="fa fa-dashboard"></i> Управление категориями</a></li><?php } ?>
      <?php if( isset($site_variables["manage_users"]) ){ ?><li><a href="<?php echo $site_variables["manage_users"]; ?>"><i class="fa fa-dashboard"></i> Пользователи</a></li><?php } ?>
      <?php if( isset($site_variables["all_categories"]) ){ ?><li><a href="<?php echo $site_variables["all_categories"]; ?>"><i class="fa fa-dashboard"></i> Все категории</a></li><?php } ?>
      <?php if( isset($site_variables["left_categories"]) && is_array($site_variables["left_categories"])){ ?>
      //-->
      <?php foreach($site_variables["left_categories"] as $site_variables["category"]){ ?>
      <?php if( $site_variables["category"]["hidden"] != 1){ ?>
      <li <?php if( isset($site_variables["category"]["child"]) && is_array($site_variables["category"]["child"]) && count($site_variables["category"]["child"])>0){ ?>class="dropdown"<?php } ?>>
      <a  <?php if( isset($site_variables["category"]["child"]) && is_array($site_variables["category"]["child"]) && count($site_variables["category"]["child"])>0){ ?>href="javascript:;"<?php }else{ ?>href="<?php echo $site_variables["category"]["url"]; ?>"<?php } ?>>
      <i class="fa fa-file-text"></i> <?php echo $site_variables["category"]["name"]; ?>
      </a>
      <?php if( isset($site_variables["category"]["child"]) && is_array($site_variables["category"]["child"]) && count($site_variables["category"]["child"])>0){ ?>
      <ul class="sub-nav">
        <?php foreach($site_variables["category"]["child"] as $site_variables["child"]){ ?>
        <li>
          <a href="<?php echo $site_variables["child"]["url"]; ?>"><i class="fa fa-file-text"></i> <?php echo $site_variables["child"]["name"]; ?></a>
        </li>
        <?php } ?>
      </ul>
      <?php } ?>
      </li>
      <?php } ?>
      <?php } ?>
      <?php } ?>
    </ul>
  </nav> <!-- #sidebar -->
</div> <!-- /#sidebar-wrapper -->

