<?php /* Smarty version 2.6.20, created on 2014-06-21 09:41:02
         compiled from users/menteeapplications/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'users/menteeapplications/default.tpl', 37, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http:/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Users</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="default.js"></script>
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
			<li><a href="/users/" title="">Users</a></li>
			<li><a href="/users/menteeapplications/" title="">Mentee Applications</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Mentee Applications</h2>	<br />
    <div class="clearer"><!-- --></div>    
     <a href="/users/menteeapplications/details.php" title="Click to Add a new Mentee Application" class="blue_button fl mrg_bot_10"><span style="float:left;">Add a new Mentee Application</span></a> <br />
	 <!-- Start Search Form -->
    <div class="filter">
		<div id="searchBar" class="left">    				  
			<strong class="line fl mrg_left_20">Person:</strong>
			<input type="text" name="usersearch" id="usersearch" value="" size="20" /> &nbsp;
			<input type="hidden" name="usercode" id="usercode" value="" />
			<strong class="line fl">Mentee Status:</strong>		
			<select id="status" name="status">
				<option value=""> All </option>
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['applicationstatusData']), $this);?>

			</select>	
			<strong class="line fl">Programme:</strong>		
			<select id="programme" name="programme">
				<option value=""> All </option>
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['mentorshipData']), $this);?>

			</select>			
			<div class="fr">
			<a  href="javascript:void(0);" onClick="clearsearch();" class="button next fr"><span>Clear</span></a>&nbsp;&nbsp;&nbsp;
			<a  href="javascript:void(0);" onClick="searchForm();" class="button next fl"><span>Search</span></a>					
			</div>
		 </div>
    </div>
    <div class="clearer"><!-- --></div>	
    <div id="tableContent" align="center">
		<!-- Start Content Table -->
		<div class="content_table">
				<img src="/images/ajax-loader-2.gif" />			
		 </div>
		 <!-- End Content Table -->	
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