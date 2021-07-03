<?php /* Smarty version 2.6.20, created on 2014-08-11 18:48:20
         compiled from program/view/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SA-YES | <?php if (isset ( $this->_tpl_vars['mentorshipData'] )): ?>Edit Programme<?php else: ?>Add a Programme<?php endif; ?></title>
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
			<li><a href="/program/" title="">Programme</a></li>
			<li><a href="/program/view/" title="">View</a></li>
			<li><?php if (isset ( $this->_tpl_vars['mentorshipData'] )): ?>Edit Programme<?php else: ?>Add a new Programme<?php endif; ?></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2><?php if (isset ( $this->_tpl_vars['mentorshipData'] )): ?>Edit Programme<?php else: ?>Add a new Programme<?php endif; ?></h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/program/view/details.php<?php if (isset ( $this->_tpl_vars['mentorshipData'] )): ?>?code=<?php echo $this->_tpl_vars['mentorshipData']['mentorship_code']; ?>
<?php endif; ?>" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
		<?php if (isset ( $this->_tpl_vars['errorArray']['mentorship'] )): ?>
		<tr>
			<td colspan="2" style="color: red; font-weight: bold;"><?php echo $this->_tpl_vars['errorArray']['mentorship']; ?>
</td>
		</tr>
		<?php endif; ?>
		<?php if (isset ( $this->_tpl_vars['mentorshipData'] )): ?>
		<tr>
			<td class="left_col"><h4>Year:</h4></td>
			<td><?php echo $this->_tpl_vars['mentorshipData']['mentorship_code']; ?>
</td>
		</tr>
		<tr>
			<td class="left_col"><h4>From:</h4></td>
			<td><?php echo $this->_tpl_vars['mentorshipData']['mentorship_startdate']; ?>
</td>
		</tr>		
		<tr>
			<td class="left_col"><h4>To:</h4></td>
			<td><?php echo $this->_tpl_vars['mentorshipData']['mentorship_enddate']; ?>
</td>
		</tr>				
		<?php else: ?>
		<tr>
			<td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['mentorship_code'] )): ?>style="color: red; font-weight: bold;"<?php endif; ?>><h4>Year:</h4></td>
			<td>
				<select id="mentorship_code" name="mentorship_code">
					<option value=""> ---- </option>
					<option value="2009" <?php if ($this->_tpl_vars['mentorshipData']['mentorship_code'] == '2009'): ?>selected<?php endif; ?>> 2009 </option>
					<option value="2010" <?php if ($this->_tpl_vars['mentorshipData']['mentorship_code'] == '2010'): ?>selected<?php endif; ?>> 2010 </option>
					<option value="2011" <?php if ($this->_tpl_vars['mentorshipData']['mentorship_code'] == '2011'): ?>selected<?php endif; ?>> 2011 </option>
					<option value="2012" <?php if ($this->_tpl_vars['mentorshipData']['mentorship_code'] == '2012'): ?>selected<?php endif; ?>> 2012 </option>
					<option value="2013" <?php if ($this->_tpl_vars['mentorshipData']['mentorship_code'] == '2013'): ?>selected<?php endif; ?>> 2013 </option>
					<option value="2014" <?php if ($this->_tpl_vars['mentorshipData']['mentorship_code'] == '2014'): ?>selected<?php endif; ?>> 2014 </option>
					<option value="2015" <?php if ($this->_tpl_vars['mentorshipData']['mentorship_code'] == '2015'): ?>selected<?php endif; ?>> 2015 </option>
					<option value="2016" <?php if ($this->_tpl_vars['mentorshipData']['mentorship_code'] == '2016'): ?>selected<?php endif; ?>> 2016 </option>
					<option value="2017" <?php if ($this->_tpl_vars['mentorshipData']['mentorship_code'] == '2017'): ?>selected<?php endif; ?>> 2017 </option>
					<option value="2018" <?php if ($this->_tpl_vars['mentorshipData']['mentorship_code'] == '2009'): ?>selected<?php endif; ?>> 2018 </option>
					<option value="2019" <?php if ($this->_tpl_vars['mentorshipData']['mentorship_code'] == '2009'): ?>selected<?php endif; ?>> 2019 </option>
					<option value="2020" <?php if ($this->_tpl_vars['mentorshipData']['mentorship_code'] == '2009'): ?>selected<?php endif; ?>> 2020 </option>
				</select>
			</td>
		</tr>
		<?php endif; ?>		
		<tr>
			<td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['mentorship_name'] )): ?>style="color: red; font-weight: bold;"<?php endif; ?>><h4>Name:</h4></td>
			<td><input type="text" name="mentorship_name" id="mentorship_name" value="<?php echo $this->_tpl_vars['mentorshipData']['mentorship_name']; ?>
" size="60"/></td>
		</tr>			  
		<tr>
			<td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['mentorship_description'] )): ?>style="color: red; font-weight: bold;"<?php endif; ?>><h4>Description:</h4></td>
			<td><textarea name="mentorship_description" id="mentorship_description" rows="3" cols="50"><?php echo $this->_tpl_vars['mentorshipData']['mentorship_description']; ?>
</textarea></td>
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