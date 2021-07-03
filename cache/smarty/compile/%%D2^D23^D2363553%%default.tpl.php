<?php /* Smarty version 2.6.20, created on 2014-11-04 13:21:10
         compiled from program/default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Programme</title>
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
			<li><a href="/program/" title="Programme">Programme</a></li>
        </ul>
	</div><!--breadcrumb--> 
  <div class="inner">  
   <h2>Manage Programme</h2>	

  <div class="section">
  	<a href="/program/view/" title="Add / Update Programmes"><img src="/images/users.gif" alt="Add / Update Programmes" height="50" width="50" /></a>
  	<a href="/program/view/" title="Add / Update Programmes" class="title">Add / Update Programmes</a>
  </div>
  <div class="section mrg_left_50">
  	<a href="/program/allmentor/" title="All Mentors"><img src="/images/users.gif" alt="All Mentors" height="50" width="50" /></a>
  	<a href="/program/allmentor/" title="All Mentors" class="title">All Mentors</a>
  </div> 
  <div class="section mrg_left_50">
  	<a href="/program/allmentee/" title="All Mentees"><img src="/images/users.gif" alt="All Mentees" height="50" width="50" /></a>
  	<a href="/program/allmentee/" title="All Mentees" class="title">All Mentees</a>
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