<?php /* Smarty version 2.6.20, created on 2014-05-02 10:38:10
         compiled from calendar/types/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | <?php if (isset ( $this->_tpl_vars['calendartypeData'] )): ?>Edit Calendar Type<?php else: ?>Add a Calendar Type<?php endif; ?></title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content recruiter -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/calendar/" title="">Calendar</a></li>
			<li><a href="/calendar/types/" title="">Types</a></li>
			<li><?php if (isset ( $this->_tpl_vars['calendartypeData'] )): ?>Edit Calendar Type<?php else: ?>Add a Calendar Type<?php endif; ?></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2><?php if (isset ( $this->_tpl_vars['calendartypeData'] )): ?>Edit Calendar Type<?php else: ?>Add a Calendar Type<?php endif; ?></h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/calendar/types/details.php<?php if (isset ( $this->_tpl_vars['calendartypeData'] )): ?>?code=<?php echo $this->_tpl_vars['calendartypeData']['calendartype_code']; ?>
<?php endif; ?>" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
		<tr>
			<td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['calendartype_name'] )): ?> error<?php endif; ?>"><h4>Description:</h4></td>
			<td><input type="text" name="calendartype_name" id="calendartype_name" value="<?php echo $this->_tpl_vars['calendartypeData']['calendartype_name']; ?>
" size="60"/></td>
		</tr>			
		<tr>
			<td class="left_col<?php if (isset ( $this->_tpl_vars['errorArray']['calendartype_colour'] )): ?> error<?php endif; ?>"><h4>Colour:</h4></td>
			<td><input type="text" name="calendartype_colour" id="calendartype_colour" value="<?php echo $this->_tpl_vars['calendartypeData']['calendartype_colour']; ?>
" size="60"/><p>Please make this a one letter word with no capital letters.</td>
		</tr>			  				  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
		<a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content recruiter -->
 </div><!-- End Content recruiter -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<?php echo '
<script type="text/javascript">
function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
'; ?>

<!-- End Main Container -->
</body>
</html>