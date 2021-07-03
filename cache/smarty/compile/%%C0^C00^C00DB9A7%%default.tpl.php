<?php /* Smarty version 2.6.20, created on 2015-05-30 13:32:40
         compiled from users/partners/default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Users</title>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
 

</head>

<body>
<!-- Start Main Container -->
<div id="container">

    <!-- Start Content Section -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/users/" title="Users">Users</a></li>
			<li><a href="/users/partners/" title="Users">Partners</a></li>
        </ul>
	</div><!--breadcrumb--> 	
  <div class="inner">  
   <h2>Manage Partners</h2>	

  <div class="section">
  	<a href="/users/partners/view/" title="Manage Partners"><img src="/images/users.gif" alt="Manage Partners" height="50" width="50" /></a>
  	<a href="/users/partners/view/" title="Manage Partners" class="title">Manage  Partners</a>
  </div>
  <div class="section mrg_left_50">
  	<a href="/users/partners/types/" title="Manage Partner Types"><img src="/images/projects.gif" alt="Manage Partner Types" height="50" width="50" /></a>
  	<a href="/users/partners/types/" title="Manage Partner Types" class="title">Manage Partner Types</a>
  </div>
  <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
	
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>



</div>
<!-- End Main Container -->
</body>
</html>