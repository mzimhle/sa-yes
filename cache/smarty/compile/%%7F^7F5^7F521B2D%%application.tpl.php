<?php /* Smarty version 2.6.20, created on 2014-06-11 12:41:43
         compiled from users/menteeapplications/application.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'users/menteeapplications/application.tpl', 53, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http:/www.w3.org/1999/xhtml">
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
    <!-- Start Content recruiter -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/users/" title="">Users</a></li>
			<li><a href="/users/menteeapplications/" title="">Mentee Application</a></li>
			<li>Edti Application - <?php echo $this->_tpl_vars['menteeappData']['menteeapp_name']; ?>
 <?php echo $this->_tpl_vars['menteeappData']['menteeapp_surname']; ?>
</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>Edti Application - <?php echo $this->_tpl_vars['menteeappData']['menteeapp_name']; ?>
 <?php echo $this->_tpl_vars['menteeappData']['menteeapp_surname']; ?>
</h2>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10 fr">
          <a href="/users/menteeapplications/details.php?code=<?php echo $this->_tpl_vars['menteeappData']['menteeapp_code']; ?>
" class="blue_button mrg_left_20 fl"><span>Mentee Details</span></a>   
		  <a href="#" class="button mrg_left_20 fl"><span>Mentee Application</span></a>   
		  <a href="/users/menteeapplications/documents.php?code=<?php echo $this->_tpl_vars['menteeappData']['menteeapp_code']; ?>
" class="blue_button mrg_left_20 fl"><span>Mentee Documents</span></a>   
        </div>		
    <div class="clearer"><!-- --></div>
	<br />
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/users/menteeapplications/application.php?code=<?php echo $this->_tpl_vars['menteeappData']['menteeapp_code']; ?>
" method="post"  enctype="multipart/form-data">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">	         		  	  
          <tr>
			<td>
				<h4 <?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_file'] )): ?>class="error"<?php endif; ?>>Application File:</h4><br />
				<input type="file" name="menteeapp_file" id="menteeapp_file" /><br />
				Only upload pdf, docx, doc, txt files only
				<?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_file'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['menteeapp_file']; ?>
</span><?php endif; ?>
				<?php if ($this->_tpl_vars['menteeappData']['menteeapp_file'] != ''): ?>
				<br /><br />
				<a href="<?php echo $this->_tpl_vars['menteeappData']['menteeapp_file']; ?>
" target="_blank" class="success">Click here to download the application file.</a>
				<?php endif; ?>
			</td>					
			<td>
				<h4 <?php if (isset ( $this->_tpl_vars['errorArray']['applicationstatus_code'] )): ?>class="error"<?php endif; ?>>Status:</h4><br />
				<select id="applicationstatus_code" name="applicationstatus_code">
					<option value=""> --- </option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['applicationstatusData'],'selected' => $this->_tpl_vars['menteeappData']['applicationstatus_code']), $this);?>

				</select>
			</td>					
          </tr>
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_presentation'] )): ?>class="error"<?php endif; ?>>Attended Presentation:</h4><br /><input type="checkbox" name="menteeapp_presentation" id="menteeapp_presentation" value="1" <?php if ($this->_tpl_vars['menteeappData']['menteeapp_presentation'] == '1'): ?>checked<?php endif; ?> /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_presentationAcc'] )): ?>class="error"<?php endif; ?>>Presentation - Provisionally Accepted:</h4><br /><input type="checkbox" name="menteeapp_presentationAcc" id="menteeapp_presentationAcc" value="1" <?php if ($this->_tpl_vars['menteeappData']['menteeapp_presentationAcc'] == '1'): ?>checked<?php endif; ?> /></td>							
		  </tr>	
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_application'] )): ?>class="error"<?php endif; ?>>Application:</h4><br /><input type="text" name="menteeapp_application" id="menteeapp_application" size="10" value="<?php echo $this->_tpl_vars['menteeappData']['menteeapp_application']; ?>
" /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_applicationAcc'] )): ?>class="error"<?php endif; ?>>Application - Provisionally Accepted:</h4><br /><input type="checkbox" name="menteeapp_applicationAcc" id="menteeapp_applicationAcc" value="1" <?php if ($this->_tpl_vars['menteeappData']['menteeapp_applicationAcc'] == '1'): ?>checked<?php endif; ?> /></td>							
		  </tr>
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_interview'] )): ?>class="error"<?php endif; ?>>Attended Interview:</h4><br /><input type="text" name="menteeapp_interview" id="menteeapp_interview" size="10" value="<?php echo $this->_tpl_vars['menteeappData']['menteeapp_interview']; ?>
" /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_interviewAcc'] )): ?>class="error"<?php endif; ?>>Interview - Provisionally Accepted:</h4><br /><input type="checkbox" name="menteeapp_interviewAcc" id="menteeapp_interviewAcc" value="1" <?php if ($this->_tpl_vars['menteeappData']['menteeapp_interviewAcc'] == '1'): ?>checked<?php endif; ?> /></td>							
		  </tr>	
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_training'] )): ?>class="error"<?php endif; ?>>Attended Training:</h4><br /><input type="text" name="menteeapp_training" id="menteeapp_training" size="10" value="<?php echo $this->_tpl_vars['menteeappData']['menteeapp_training']; ?>
" /></td>				
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_trainingAcc'] )): ?>class="error"<?php endif; ?>>Training - Provisionally Accepted:</h4><br /><input type="checkbox" name="menteeapp_trainingAcc" id="menteeapp_trainingAcc" value="1" <?php if ($this->_tpl_vars['menteeappData']['menteeapp_trainingAcc'] == '1'): ?>checked<?php endif; ?> /></td>							
		  </tr>
		  <tr>
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_matchingSession'] )): ?>class="error"<?php endif; ?>>Attended Matching Session:</h4><br /><input type="checkbox" name="menteeapp_matchingSession" id="menteeapp_matchingSession" value="1" <?php if ($this->_tpl_vars['menteeappData']['menteeapp_matchingSession'] == '1'): ?>checked<?php endif; ?> /></td>					
			<td><h4 <?php if (isset ( $this->_tpl_vars['errorArray']['menteeapp_matchDate'] )): ?>class="error"<?php endif; ?>>Match Date (1st compulsory teambuilding):</h4><br /><input type="text" name="menteeapp_matchDate" id="menteeapp_matchDate" size="10" value="<?php echo $this->_tpl_vars['menteeappData']['menteeapp_matchDate']; ?>
" /></td>									
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
$(document).ready(function() {		
	
	$( "#menteeapp_application" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#menteeapp_interview" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#menteeapp_training" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});
	$( "#menteeapp_matchDate" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true});

});

function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
'; ?>

<!-- End Main Container -->
</body>
</html>