<?php /* Smarty version 2.6.20, created on 2015-05-30 13:33:13
         compiled from calendar/default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Calendar</title>
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
			<li><a href="/calendar/" title="Calendar">Calendar</a></li>
        </ul>
	</div><!--breadcrumb--> 	
  <div class="inner">  
   <h2>Manage Calendar</h2>	

  <div class="section">
  	<a href="/calendar/schedules/" title="Manage Schedules"><img src="/images/users.gif" alt="Manage Schedules" height="50" width="50" /></a>
  	<a href="/calendar/schedules/" title="Manage Schedules" class="title">Manage  Schedules</a>
  </div>
  <div class="section mrg_left_50">
  	<a href="/calendar/types/" title="Manage Schedule Types"><img src="/images/projects.gif" alt="Manage Schedule Types" height="50" width="50" /></a>
  	<a href="/calendar/types/" title="Manage Schedule Types" class="title">Manage Schedule Types</a>
  </div>
  <div class="section mrg_left_50">
  	<a href="/calendar/display/" title="Manage Calendar Display"><img src="/images/projects.gif" alt="Manage Calendar Display" height="50" width="50" /></a>
  	<a href="/calendar/display/" title="Manage Calendar Display" class="title">Manage Calendar Display</a>
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