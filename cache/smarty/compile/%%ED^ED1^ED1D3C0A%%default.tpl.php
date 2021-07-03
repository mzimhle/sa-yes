<?php /* Smarty version 2.6.20, created on 2014-11-07 10:20:12
         compiled from reports/meetings/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'reports/meetings/default.tpl', 46, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http:/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | Reports</title>
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
			<li><a href="/reports/" title="">Reports</a></li>
			<li><a href="#" title="">Meetings</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Meetings</h2>	<br />
    <div class="clearer"><!-- --></div>    
     <!-- Start Search Form -->
    <div class="filter_double">
		<div id="searchBar" class="left">    				  
				<strong class="line fl">From Date:</strong>
				<input type="text" class="small_field"  id="from" name="from" size="10" value="<?php echo $this->_tpl_vars['from']; ?>
" />		                      
				 <strong class="line fl mrg_left_20">To Date:</strong>
				<input type="text" id="to" name="to" size="10"  value="<?php echo $this->_tpl_vars['to']; ?>
" />
				 <strong class="line fl mrg_left_20">Mentor:</strong>
				<input type="text" name="mentorsearch" id="mentorsearch" value="<?php echo $this->_tpl_vars['mentorsearch']; ?>
" size="20" /> &nbsp;
				<input type="hidden" name="smentorid" id="smentorid" value="<?php echo $this->_tpl_vars['smentorid']; ?>
" />
				<strong class="line fl mrg_left_20">Mentee:</strong>			
				<input type="text" name="menteesearch" id="menteesearch" value="<?php echo $this->_tpl_vars['menteesearch']; ?>
" size="20" /> &nbsp;
				<input type="hidden" name="smenteeid" id="smenteeid" value="<?php echo $this->_tpl_vars['smenteeid']; ?>
" />		
		 </div>
		<div class="clearer"><!-- --></div>	
		<div id="searchBar" class="right;"> 
			<strong class="line fl">Programme:</strong>		
			<select id="mentorship" name="mentorship">
				<option value=""> All </option>
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['mentorshipData']), $this);?>

			</select>		
			<strong class="line fl">Type:</strong>		
			<select id="type" name="type">
				<option value=""> All </option>
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['meetingtypeData']), $this);?>

			</select>
			<strong class="line fl">Status:</strong>		
			<select id="meetingstatus" name="meetingstatus">
				<option value=""> All </option>
				<option value="1"> Met </option>
				<option value="0"> Did not meet </option>
			</select>	
			<strong class="line fl">With Staff:</strong>		
			<select id="withstaff" name="withstaff">
				<option value=""> All </option>
				<option value="1"> With Staff </option>
				<option value="0"> Without Staff </option>
			</select>					
			<a  href="javascript:void(0);" onClick="downloadcvs();" class="button next fr"><span>Export to CVS</span></a>
			<a  href="javascript:void(0);" onClick="clearsearch();" class="button next fr"><span>Clear</span></a>			
			<a  href="javascript:void(0);" onClick="searchForm();" class="button next fr"><span>Search</span></a>						 
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