<?php /* Smarty version 2.6.20, created on 2015-05-30 13:30:11
         compiled from default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Home</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
 
<link rel="stylesheet" type="text/css" href="/library/javascript/fullcalendar-1.6.2/fullcalendar.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/library/javascript/fullcalendar-1.6.2/fullcalendar.print.css" media="screen" />
<script type="text/javascript" language="javascript" src="/library/javascript/fullcalendar-1.6.2/fullcalendar.min.js"></script>
<script type="text/javascript" language="javascript" src="/feeds/calendar.php"></script>
</head>

<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div class="inner">  
   <h2>SA-YES Online Meeting Tracker</h2>	
  <div class="section">
  	<a href="/reports/meetings/" title="Meeting reports"><img src="/images/users.gif" alt="Meeting reports" height="50" width="50" /></a>
  	<a href="/reports/meetings/" title="Meeting reports" class="title">Meeting reports</a>
  </div>
  <div class="section mrg_left_50">
  	<a href="/reports/matches/" title="Matches reports"><img src="/images/projects.gif" alt="Matches reports" height="50" width="50" /></a>
  	<a href="/reports/matches/" title="Matches reports" class="title">Matches reports</a>
  </div>
    <div class="section mrg_left_50">
  	<a href="/reports/notlogin/" title="Did not login"><img src="/images/projects.gif" alt="Did not login reports" height="50" width="50" /></a>
  	<a href="/reports/notlogin/" title="Did not login" class="title">Did not login report</a>
  </div>  
  <div class="clearer"><!-- --></div>

  </div>
</div>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<!-- End Main Container -->
</body>
</html>