<?php /* Smarty version 2.6.20, created on 2014-11-07 10:16:08
         compiled from reports/default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Reports</title>

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
			<li><a href="/reports/" title="Reports">Reports</a></li>
        </ul>
	</div><!--breadcrumb--> 	
	<div class="inner">  
   <h2>Reports</h2>	
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
  <div class="section">
  	<a href="/reports/programme/" title="programme"><img src="/images/users.gif" alt="programme" height="50" width="50" /></a>
  	<a href="/reports/programme/" title="programme" class="title">Programme Report</a>
  </div> 
<div class="clearer"><!-- --></div>  
  </div>
</div>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
</body>
</html>